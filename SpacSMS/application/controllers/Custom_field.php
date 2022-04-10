<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom school management system
 * @version : 2.0
 * @developed by : RamomCoder
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/RamomCoder
 * @filename : Custom_field.php
 * @copyright : Reserved RamomCoders Team
 */

class Custom_field extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('custom_field_model');
        $this->load->helpers('custom_fields');
    }

    public function index()
    {
        if (!get_permission('custom_field', 'is_view')) {
            access_denied();
        }
        $this->data['customfield'] = $this->app_lib->getTable('custom_field');
        $this->data['sub_page'] = 'custom_field/index';
        $this->data['main_menu'] = 'settings';
        $this->data['title'] = translate('custom_field');
        $this->load->view('layout/index', $this->data);
    }

    public function edit($id = '')
    {
        if (!get_permission('custom_field', 'is_edit')) {
            access_denied();
        }
        $this->data['customfield'] = $this->app_lib->getTable('custom_field', array('t.id' => $id), true);
        $this->data['sub_page'] = 'custom_field/edit';
        $this->data['main_menu'] = 'settings';
        $this->data['title'] = translate('custom_field');
        $this->load->view('layout/index', $this->data);
    }

    public function save()
    {
        if (isset($data['custom_field_id'])) {
            if (!get_permission('custom_field', 'is_edit')) {
                ajax_access_denied();
            }
        } else {
            if (!get_permission('custom_field', 'is_add')) {
                ajax_access_denied();
            }
        }
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('belongs_to', translate('belongs_to'), 'trim|required');
        $this->form_validation->set_rules('field_label', translate('field_label'), 'trim|required');
        $this->form_validation->set_rules('field_type', translate('field_type'), 'trim|required');
        $this->form_validation->set_rules('bs_column', translate('bs_column'), 'trim|required');
        $this->form_validation->set_rules('field_order', translate('field_order'), 'trim|required|numeric');
        $field_type = $this->input->post('field_type');
        $default_value = '';
        if ($field_type == 'dropdown') {
            $this->form_validation->set_rules('dropdown_default_value', translate('default_value'), 'trim|required');
            $defaultValue = $this->input->post('dropdown_default_value');
        } elseif ($field_type == 'checkbox') {
            $defaultValue = $this->input->post('checkbox_default_value');
        } else {
            $defaultValue = $this->input->post('com_default_value');
        }
        if ($this->form_validation->run() !== false) {
            $this->custom_field_model->save($this->input->post(), $defaultValue);
            set_alert('success', translate('information_has_been_saved_successfully'));
            $url = base_url('custom_field');
            $array = array('status' => 'success', 'url' => $url);
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail', 'error' => $error);
        }
        echo json_encode($array);
    }

    public function delete($id = '')
    {
        // check access permission
        if (get_permission('custom_field', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('custom_field');
            $this->db->where('field_id', $id);
            $this->db->delete('custom_fields_values');
        } else {
            set_alert('error', translate('access_denied'));
        }
    }

    public function getFieldsByBranch()
    {
        $belongs_to = $this->input->post('belongs_to');
        echo render_custom_Fields($belongs_to);
    }

    public function status()
    {
        if (!get_permission('custom_field', 'is_edit')) {
            ajax_access_denied();
        }
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        if ($status == 'true') {
            $arrayData['status'] = 1;
        } else {
            $arrayData['status'] = 0;
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->update('custom_field', $arrayData);
        $return = array('msg' => translate('information_has_been_updated_successfully'), 'status' => true);
        echo json_encode($return);
    }
}
