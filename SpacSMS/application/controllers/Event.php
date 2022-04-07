<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom school management system
 * @version : 2.0
 * @developed by : RamomCoder
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/RamomCoder
 * @filename : Accounting.php
 * @copyright : Reserved RamomCoders Team
 */

class Event extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // check access permission
        if (!get_permission('event', 'is_view')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('title', translate('title'), 'trim|required');
            if (!isset($_POST['holiday'])) {
                $this->form_validation->set_rules('type_id', translate('type'), 'trim|required');
            }
            $this->form_validation->set_rules('audition', translate('audition'), 'trim|required');
            $this->form_validation->set_rules('daterange', translate('date'), 'trim|required');
            $audition = $this->input->post('audition');
            if ($audition == 2) {
                $this->form_validation->set_rules('selected_audience[]', translate('class'), 'trim|required');
            } elseif ($audition == 3) {
                $this->form_validation->set_rules('selected_audience[]', translate('section'), 'trim|required');
            }
            if ($this->form_validation->run() !== false) {
                if ($audition != 1) {
                    $selectedList = array();
                    foreach ($this->input->post('selected_audience') as $user) {
                        array_push($selectedList, $user);
                    }
                } else {
                    $selectedList = null;
                }
                $holiday = $this->input->post('holiday');
                if (empty($holiday)) {
                    $type = $this->input->post('type_id');
                } else {
                    $type = 'holiday';
                }
                $daterange = explode(' - ', $this->input->post('daterange'));
                $start_date = date("Y-m-d", strtotime($daterange[0]));
                $end_date = date("Y-m-d", strtotime($daterange[1]));
                $arrayEvent = array(
                    'branch_id' => $branchID,
                    'title' => $this->input->post('title'),
                    'created_by' => get_loggedin_user_id(),
                    'remark' => $this->input->post('remarks'),
                    'type' => $type,
                    'audition' => $audition,
                    'selected_list' => json_encode($selectedList),
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'status' => 1,
                );
                $this->db->insert('event', $arrayEvent);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('event');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('events');
        $this->data['sub_page'] = 'event/index';
        $this->data['main_menu'] = 'event';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/summernote/summernote.css',
                'vendor/daterangepicker/daterangepicker.css',
            ),
            'js' => array(
                'vendor/summernote/summernote.js',
                'vendor/moment/moment.js',
                'vendor/daterangepicker/daterangepicker.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    public function delete($id = '')
    {
        // check access permission
        if (get_permission('event', 'is_delete')) {
            $event_db = $this->db->where('id', $id)->get('event')->row_array();
            if ($event_db['created_by'] == get_loggedin_user_id()) {
                $this->db->where('id', $id);
                $this->db->delete('event');
            } else {
                set_alert('error', 'You do not have permission to delete');
            }
        } else {
            set_alert('error', translate('access_denied'));
        }
    }

    /* types form validation rules */
    protected function types_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('type_name', translate('name'), 'trim|required|callback_unique_type');
    }

    // exam term information are prepared and stored in the database here
    public function types()
    {
        if (isset($_POST['save'])) {
            if (!get_permission('event_type', 'is_add')) {
                access_denied();
            }
            $this->types_validation();
            if ($this->form_validation->run() !== false) {
                //save information in the database file
                $data['name'] = $this->input->post('type_name');
                $data['icon'] = $this->input->post('event_icon');
                $data['branch_id'] = $this->application_model->get_branch_id();
                $this->db->insert('event_types', $data);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(current_url());
            }
        }
        $this->data['typelist'] = $this->app_lib->getTable('event_types');
        $this->data['sub_page'] = 'event/types';
        $this->data['main_menu'] = 'event';
        $this->data['title'] = translate('event_type');
        $this->load->view('layout/index', $this->data);
    }

    public function types_edit()
    {
        if ($_POST) {
            if (!get_permission('event_type', 'is_edit')) {
                ajax_access_denied();
            }
            $this->types_validation();
            if ($this->form_validation->run() !== false) {
                //save information in the database file
                $data['name'] = $this->input->post('type_name');
                $data['icon'] = $this->input->post('event_icon');
                $data['branch_id'] = $this->application_model->get_branch_id();
                $this->db->where('id', $this->input->post('type_id'));
                $this->db->update('event_types', $data);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('event/types');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function type_delete($id)
    {
        if (!get_permission('event_type', 'is_delete')) {
            access_denied();
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->delete('event_types');
    }

    /* unique valid type name verification is done here */
    public function unique_type($name)
    {
        $branchID = $this->application_model->get_branch_id();
        $type_id = $this->input->post('type_id');
        if (!empty($type_id)) {
            $this->db->where_not_in('id', $type_id);
        }
        $this->db->where(array('name' => $name, 'branch_id' => $branchID));
        $uniform_row = $this->db->get('event_types')->num_rows();
        if ($uniform_row == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_type", translate('already_taken'));
            return false;
        }
    }

    // the event is controlled from here published or unpublished
    public function status()
    {
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
        $this->db->update('event', $arrayData);
        $return = array('msg' => translate('information_has_been_updated_successfully'), 'status' => true);
        echo json_encode($return);
    }

    public function getDetails()
    {
        $id = $this->input->post('event_id');
        if (empty($id)) {
            redirect(base_url(), 'refresh');
        }

        $auditions = array("1" => "everybody", "2" => "class", "3" => "section");
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $ev = $this->db->get('event')->row_array();
        $type = $ev['type'] == 'holiday' ? translate('holiday') : get_type_name_by_id('event_types', $ev['type']);
        $remark = (empty($ev['remark']) ? 'N/A' : $ev['remark']);
        $html = "<tbody><tr>";
        $html .= "<td>" . translate('title') . "</td>";
        $html .= "<td>" . $ev['title'] . "</td>";
        $html .= "</tr><tr>";
        $html .= "<td>" . translate('type') . "</td>";
        $html .= "<td>" . $type . "</td>";
        $html .= "</tr><tr>";
        $html .= "<td>" . translate('date_of_start') . "</td>";
        $html .= "<td>" . _d($ev['start_date']) . "</td>";
        $html .= "</tr><tr>";
        $html .= "<td>" . translate('date_of_end') . "</td>";
        $html .= "<td>" . _d($ev['end_date']) . "</td>";
        $html .= "</tr><tr>";
        $html .= "<td>" . translate('audience') . "</td>";
        $audition = $auditions[$ev['audition']];
        $html .= "<td>" . translate($audition);
        if ($ev['audition'] != 1) {
            $selecteds = json_decode($ev['selected_list']);
            foreach ($selecteds as $selected) {
                $html .= "<br> <small> - " . $this->db->get_where($audition, array('id' => $selected))->row()->name . '</small>';
            }
        }
        $html .= "</td>";
        $html .= "</tr><tr>";
        $html .= "<td>" . translate('description') . "</td>";
        $html .= "<td>" . $remark . "</td>";
        $html .= "</tr></tbody>";
        echo $html;
    }

    /* generate section with class group */
    public function getSectionByBranch()
    {
        $html = "";
        $branchID = $this->application_model->get_branch_id();
        if (!empty($branchID)) {
            $result = $this->db->get_where('class', array('branch_id' => $branchID))->result_array();
            if (count($result)) {
                foreach ($result as $class) {
                    $html .= '<optgroup label="' . $class['name'] . '">';
                    $allocations = $this->db->get_where('sections_allocation', array('class_id' => $class['id']))->result_array();
                    if (count($allocations)) {
                        foreach ($allocations as $allocation) {
                            $section = $this->db->get_where('section', array('id' => $allocation['section_id']))->row_array();
                            $html .= '<option value="' . $allocation['section_id'] . '">' . $section['name'] . '</option>';
                        }
                    } else {
                        $html .= '<option value="">' . translate('no_selection_available') . '</option>';
                    }
                    $html .= '</optgroup>';
                }
            }
        }
        echo $html;
    }

    public function get_events_list($branchID = '')
    {
        if (is_loggedin()) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            } else {
                $this->db->where('branch_id', $branchID);
            }
            $this->db->where('status', 1);
            $events = $this->db->get('event')->result();
            foreach ($events as $row) {
                $arrayData = array(
                    'id' => $row->id,
                    'title' => $row->title,
                    'start' => $row->start_date,
                    'end' => date('Y-m-d', strtotime($row->end_date . "+1 days")),
                );
                if ($row->type == 'holiday') {
                    $arrayData['className'] = 'fc-event-danger';
                    $arrayData['icon'] = 'umbrella-beach';
                } else {
                    $icon = get_type_name_by_id('event_types', $row->type, 'icon');
                    $arrayData['icon'] = $icon;
                }
                $eventdata[] = $arrayData;
            }
            echo json_encode($eventdata);
        }
    }

}
