<?php
defined('BASEPATH') or exit('No direct script access allowed');

function render_custom_Fields($belongs_to, $branch_id = null, $edit_id = false, $col_sm = null)
{
    $CI = &get_instance();
    if (empty($branch_id)) {
    	$branch_id = $CI->application_model->get_branch_id();
    }
    $CI->db->from('custom_field');
    $CI->db->where('status', 1);
    $CI->db->where('form_to', $belongs_to);
    $CI->db->where('branch_id', $branch_id);
    $CI->db->order_by('field_order','asc');
    $fields = $CI->db->get()->result_array();
    if (count($fields)) {
    	$html = '';
    	foreach ($fields as $field_key => $field) {
            $fieldLabel = ucfirst($field['field_label']);
            $fieldType = $field['field_type'];
            $bsColumn = $field['bs_column'];
            $required = $field['required'];
            $formTo = $field['form_to'];
            $fieldID = $field['id'];

            if ($bsColumn == '' || $bsColumn == 0) {
            	$bsColumn == 12;
            }
            $value = $field['default_value'];

            if ($edit_id !== false) {
                $return = get_custom_field_value($edit_id, $fieldID, $formTo);
                if (!empty($return)) {
                    $value = $return;
                }
            }

	        if(isset($_POST['custom_fields'][$formTo][$fieldID])) {
	        	$value = $_POST['custom_fields'][$formTo][$fieldID];
	        }

	      	if ($fieldType != 'checkbox') {  
            	$html .= '<div class="col-md-' . $bsColumn . ' mb-sm"><div class="form-group">';
            	$html .= '<label class="control-label">' . $fieldLabel . ($required == 1 ? ' <span class="required">*</span>' : '') . '</label>';
	            if ($fieldType == 'text' || $fieldType == 'number' || $fieldType == 'email') {
	            	$html .= '<input type="' . $fieldType . '" class="form-control" name="custom_fields[' . $formTo . '][' . $fieldID . ']" value="' . $value . '" />';
	            }
	            if ($fieldType == 'textarea') {
	            	$html .= '<textarea type="' . $fieldType . '" class="form-control" name="custom_fields[' . $formTo . '][' . $fieldID . ']">' . $value . '</textarea>';
	            }
	            if ($fieldType == 'dropdown') {
	            	$html .= '<select class="form-control" data-plugin-selectTwo data-width="100%" data-minimum-results-for-search="Infinity" name="custom_fields[' . $formTo . '][' . $fieldID . ']">';
	            	$html .= dropdownField($field['default_value'], $value);
	            	$html .= '</select>';
	            }
	            if ($fieldType == 'date') {
	            	$html .= '<input type="text" class="form-control" data-plugin-datepicker name="custom_fields[' . $formTo . '][' . $fieldID . ']" value="' . $value . '" />';
	            }
	            $html .= '<span class="error">' . form_error('custom_fields[' . $formTo . '][' . $fieldID . ']') . '</span>';
	            $html .= '</div></div>';
	        } else {
            	$html .= '<div class="col-md-' . $bsColumn . ' mb-sm"><div class="checkbox-replace">';
            	$html .= '<label class="i-checks">';
            	$html .= '<input type="checkbox" name="[' . $formTo . '][' . $fieldID . ']" value="1" ' . ($value == 1 ? 'checked' : '') . ' ><i></i>';
            	$html .= $fieldLabel;
            	$html .= '</label>';
            	$html .= '</div></div>';
	        }
    	}
    	return $html;
    } 
}

function dropdownField($default, $value)
{
	$options = explode(',', $default);
	$input = '<option value="">Select</option>';
	foreach ($options as $option_key => $option_value) {
		$input .= '<option value="' . slugify($option_value) . '" '. (slugify($option_value) == $value ? 'selected' : '') .'>' . ucfirst($option_value) . '</option>';
	}
	return $input;
}

function getCustomFields($belong_to)
{
	$CI = &get_instance();
    $branchID = $CI->application_model->get_branch_id();
    $CI->db->from('custom_field');
    $CI->db->where('status', 1);
    $CI->db->where('form_to', $belong_to);
    $CI->db->where('branch_id', $branchID);
    $CI->db->order_by('field_order','asc');
    $fields = $CI->db->get()->result_array();
    return $fields;
}

function saveCustomFields($post, $userID)
{
	$CI = &get_instance();
	$arrayData = array();
	foreach ($post as $key => $value) {
		$insertData = array(
			'field_id' => $key, 
			'relid' => $userID, 
			'value' => $value, 
		);
        $CI->db->where('relid', $userID);
        $CI->db->where('field_id', $key);
        $query = $CI->db->get('custom_fields_values');
        if ($query->num_rows() > 0) {
            $results = $query->row();
            $CI->db->where('id', $results->id);
            $CI->db->update('custom_fields_values', $insertData);
        } else {
            $CI->db->insert('custom_fields_values', $insertData);
        }
	}
}

function get_custom_field_value($rel_id, $field_id, $belongs_to)
{
	$CI = &get_instance();
    $CI->db->select('custom_fields_values.value');
    $CI->db->from('custom_field');
    $CI->db->join('custom_fields_values', 'custom_fields_values.field_id = custom_field.id and custom_fields_values.relid = ' . $rel_id, 'inner');
    $CI->db->where('custom_field.form_to', $belongs_to);
    $CI->db->where('custom_fields_values.field_id', $field_id);
    $row = $CI->db->get()->row_array();
    return $row['value'];
}

function custom_form_table($belong_to, $branch_id)
{
    $CI = &get_instance();
    $CI->db->from('custom_field');
    $CI->db->where('status', 1);
    $CI->db->where('form_to', $belong_to);
    $CI->db->where('show_on_table', 1);
    $CI->db->where('branch_id', $branch_id);
    $CI->db->order_by('field_order','asc');
    $fields = $CI->db->get()->result_array();
    return $fields;
}

function get_table_custom_field_value($field_id, $rel_id)
{
    $CI = &get_instance();
    $CI->db->from('custom_fields_values');
    $CI->db->where('relid', $rel_id);
    $CI->db->where('field_id', $field_id);
    $row = $CI->db->get()->row_array();
    return $row['value'];
}