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

class Hostels extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('hostel_model');
    }

    /* hostel form validation rules */
    protected function hostel_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('name', translate('hostel_name'), 'trim|required');
        $this->form_validation->set_rules('category_id', translate('category'), 'required');
        $this->form_validation->set_rules('watchman_name', translate('watchman_name'), 'trim|required');
    }

    public function index()
    {
        if (!get_permission('hostel', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            if (!get_permission('hostel', 'is_add')) {
                ajax_access_denied();
            }
            $this->hostel_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save all hostel information in the database file
                $this->hostel_model->hostel_save($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('hostels');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['hostellist'] = $this->app_lib->getTable('hostel');
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['title'] = translate('hostel_master');
        $this->data['sub_page'] = 'hostels/index';
        $this->data['main_menu'] = 'hostels';
        $this->load->view('layout/index', $this->data);
    }

    // the hostel information is updated here
    public function edit($id = '')
    {
        if (!get_permission('hostel', 'is_edit')) {
            access_denied();
        }
        if ($_POST) {
            $this->hostel_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save all hostel information in the database file
                $this->hostel_model->hostel_save($post);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('hostels');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['hostel'] = $this->app_lib->getTable('hostel', array('t.id' => $id), true);
        $this->data['title'] = translate('hostel_master');
        $this->data['sub_page'] = 'hostels/edit';
        $this->data['main_menu'] = 'hostels';
        $this->load->view('layout/index', $this->data);
    }

    public function delete($id = '')
    {
        if (get_permission('hostel', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('hostel');
        }
    }

    /* category form validation rules */
    protected function category_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('category_name', translate('category'), 'trim|required|callback_unique_category');
        $this->form_validation->set_rules('type', translate('category_for'), 'required');
    }

    // category information are prepared and stored in the database here
    public function category()
    {
        if (isset($_POST['save'])) {
            if (!get_permission('hostel_category', 'is_add')) {
                access_denied();
            }
            $this->category_validation();
            if ($this->form_validation->run() !== false) {
                //save hostel type information in the database file
                $this->hostel_model->category_save($this->input->post());
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('hostels/category'));
            }
        }
        $this->data['categorylist'] = $this->app_lib->getTable('hostel_category');
        $this->data['title'] = translate('category');
        $this->data['sub_page'] = 'hostels/category';
        $this->data['main_menu'] = 'hostels';
        $this->load->view('layout/index', $this->data);
    }

    public function category_edit()
    {
        if ($_POST) {
            if (!get_permission('hostel_category', 'is_edit')) {
                ajax_access_denied();
            }
            $this->category_validation();
            if ($this->form_validation->run() !== false) {
                //update exam term information in the database file
                $this->hostel_model->category_save($this->input->post());
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('hostels/category');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function category_delete($id)
    {
        if (get_permission('hostel_category', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('hostel_category');
        }
    }

    // validate here, if the check type name
    public function unique_category($name)
    {
        $categoryID = $this->input->post('category_id');
        $type = $this->input->post('type');
        $branchID = $this->application_model->get_branch_id();
        if (!empty($categoryID)) {
            $this->db->where_not_in('id', $categoryID);
        }
        $this->db->where('name', $name);
        $this->db->where('type', $type);
        $this->db->where('branch_id', $branchID);
        $query = $this->db->get('hostel_category');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("unique_category", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }

    // room information are prepared and stored in the database here
    public function room()
    {
        if (!get_permission('hostel_room', 'is_view')) {
            ajax_access_denied();
        }

        if ($_POST) {
            if (!get_permission('hostel_room', 'is_add')) {
                ajax_access_denied();
            }
            $this->room_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save all hostel information in the database file
                $this->hostel_model->room_save($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $array = array('status' => 'success', 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }

        $this->data['roomlist'] = $this->app_lib->getTable('hostel_room');
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['title'] = translate('hostel_room');
        $this->data['sub_page'] = 'hostels/room';
        $this->data['main_menu'] = 'hostels';
        $this->load->view('layout/index', $this->data);
    }

    // the room information is updated here
    public function edit_room($id = '')
    {
        if (!get_permission('hostel_room', 'is_edit')) {
            access_denied();
        }
        if ($_POST) {
            $this->room_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save all hostel information in the database file
                $this->hostel_model->room_save($post);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('hostels/room');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['room'] = $this->app_lib->getTable('hostel_room', array('t.id' => $id), true);
        $this->data['title'] = translate('hostels_room_edit');
        $this->data['sub_page'] = 'hostels/room_edit';
        $this->data['main_menu'] = 'hostels';
        $this->load->view('layout/index', $this->data);
    }

    public function delete_room($id = '')
    {
        if (get_permission('hostel_room', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('hostel_room');
        }
    }

    // validate here, if the check room name
    public function unique_room_name($name)
    {
        $room_id = $this->input->post('room_id');
        $branchID = $this->application_model->get_branch_id();
        if (!empty($room_id)) {
            $this->db->where_not_in('id', $room_id);
        }
        $this->db->where('name', $name);
        $this->db->where('branch_id', $branchID);
        $query = $this->db->get('hostel_room');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("unique_room_name", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }

    // student allocation report is generated here
    public function allocation_report()
    {
        if (!get_permission('hostel_allocation', 'is_view')) {
            access_denied();
        }
        
        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $classID = $this->input->post('class_id');
            $sectionID = $this->input->post('section_id');
            $this->data['allocationlist'] = $this->hostel_model->allocation_report($classID, $sectionID, $branchID);
        }

        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('allocation_list');
        $this->data['sub_page'] = 'hostels/allocation';
        $this->data['main_menu'] = 'hostels';
        $this->load->view('layout/index', $this->data);
    }

    public function allocation_delete($id) {
        if (get_permission('hostel_allocation', 'is_delete')) {
            $this->db->select('student_id');
            $this->db->where('id', $id);
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $student_id = $this->db->get('enroll')->row()->student_id;
            if (!empty($student_id)) {
                $arrayData = array('hostel_id' => 0, 'room_id' => 0);
                $this->db->where('id', $student_id);
                $this->db->update('student', $arrayData);
            }
        }
    }

    // get a list of branch based information
    public function getCategoryByBranch()
    {
        $type = $this->input->post('type');
        $branchID = $this->application_model->get_branch_id();
        $html = '';
        if (!empty($branchID)) {
            $result = $this->db->select('id,name')->where(array('branch_id' => $branchID, 'type' => $type))->get('hostel_category')->result_array();
            if (count($result)) {
                echo '<option value="">' . translate('select') . '</option>';
                foreach ($result as $row) {
                    $html .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_branch_first') . '</option>';
        }
        echo $html;
    }

    /* get a list of branch based information */
    public function getRoomByHostel()
    {
        $html = '';
        $hostelID = $this->input->post('hostel_id');
        if (!empty($hostelID)) {
            $rooms = $this->db->select('id,name,category_id')->where('hostel_id', $hostelID)->get('hostel_room')->result_array();
            if (count($rooms)) {
                echo '<option value="">' . translate('select') . '</option>';
                foreach ($rooms as $row) {
                    $html .= '<option value="' . $row['id'] . '">' . $row['name'] . ' (' . get_type_name_by_id('hostel_category', $row['category_id']) . ')' . '</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_hostel_first') . '</option>';
        }
        echo $html;
    }

    public function getCategoryDetails()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $query = $this->db->get('hostel_category');
        $result = $query->row_array();
        echo json_encode($result);
    }

    protected function room_validation()
    {

        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('name', translate('hostel_name'), 'trim|required|callback_unique_room_name');
        $this->form_validation->set_rules('hostel_id', translate('hostel_name'), 'required');
        $this->form_validation->set_rules('category_id', translate('category'), 'trim|required');
        $this->form_validation->set_rules('number_of_beds', translate('no_of_beds'), 'trim|required|numeric');
        $this->form_validation->set_rules('bed_fee', translate('cost_per_bed'), 'trim|required|numeric');
    }
}
