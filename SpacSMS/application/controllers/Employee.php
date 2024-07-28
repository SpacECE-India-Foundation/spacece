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

class Employee extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helpers('custom_fields');
        $this->load->model('employee_model');
        $this->load->model('email_model');
        $this->load->model('crud_model');
    }

    public function index()
    {
        redirect(base_url('dashboard'));
    }

    /* staff form validation rules */
    protected function employee_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'trim|required');
        }
        $this->form_validation->set_rules('name', translate('name'), 'trim|required');
        $this->form_validation->set_rules('mobile_no', translate('mobile_no'), 'trim|required');
        $this->form_validation->set_rules('present_address', translate('present_address'), 'trim|required');
        $this->form_validation->set_rules('designation_id', translate('designation'), 'trim|required');
        $this->form_validation->set_rules('department_id', translate('department'), 'trim|required');
        $this->form_validation->set_rules('joining_date', translate('joining_date'), 'trim|required');
        $this->form_validation->set_rules('qualification', translate('qualification'), 'trim|required');
        $this->form_validation->set_rules('user_role', translate('role'), 'trim|required|callback_valid_role');
        $this->form_validation->set_rules('email', translate('email'), 'trim|required|valid_email|callback_unique_username');
        if (!isset($_POST['staff_id'])) {
            $this->form_validation->set_rules('password', translate('password'), 'trim|required|min_length[4]');
            $this->form_validation->set_rules('retype_password', translate('retype_password'), 'trim|required|matches[password]');
        }
        $this->form_validation->set_rules('facebook', 'Facebook', 'valid_url');
        $this->form_validation->set_rules('twitter', 'Twitter', 'valid_url');
        $this->form_validation->set_rules('linkedin', 'Linkedin', 'valid_url');
        $this->form_validation->set_rules('user_photo', 'profile_picture',array(array('handle_upload', array($this->application_model, 'profilePicUpload'))));
        // custom fields validation rules
        $class_slug = $this->router->fetch_class();
        $customFields = getCustomFields($class_slug);
        foreach ($customFields as $fields_key => $fields_value) {
            if ($fields_value['required']) {
                $fieldsID = $fields_value['id'];
                $fieldLabel = $fields_value['field_label'];
                $this->form_validation->set_rules("custom_fields[employee][" . $fieldsID . "]", $fieldLabel, 'trim|required');
            }
        }
    }


    /* getting all employee list */
    public function view($role = 2)
    {
        if (!get_permission('employee', 'is_view') || ($role == 1 || $role == 6 || $role == 7)) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        $this->data['act_role'] = $role;
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/view';
        $this->data['main_menu'] = 'employee';
        $this->data['stafflist'] = $this->employee_model->getStaffList($branchID, $role);
        $this->load->view('layout/index', $this->data);
    }

    /* bank form validation rules */
    protected function bank_validation()
    {
        $this->form_validation->set_rules('bank_name', translate('bank_name'), 'trim|required');
        $this->form_validation->set_rules('holder_name', translate('holder_name'), 'trim|required');
        $this->form_validation->set_rules('bank_branch', translate('bank_branch'), 'trim|required');
        $this->form_validation->set_rules('account_no',  translate('account_no'), 'trim|required');
    }

    /* employees all information are prepared and stored in the database here */
    public function add()
    {
        if (!get_permission('employee', 'is_add')) {
            access_denied();
        }
        if ($_POST) {
            $this->employee_validation();
            if (!isset($_POST['chkskipped'])) {
                $this->bank_validation();
            }
            if ($this->form_validation->run() !== false) {
                //save all employee information in the database
                $user_id = $this->employee_model->save($this->input->post());

                // handle custom fields data
                $class_slug = $this->router->fetch_class();
                $customField = $this->input->post("custom_fields[$class_slug]");
                if (!empty($customField)) {
                    saveCustomFields($customField, $studentID);
                }

                set_alert('success', translate('information_has_been_saved_successfully'));
                //send account activate email
                $this->email_model->sentStaffRegisteredAccount($post);
                redirect(base_url('employee/view/' . $post['user_role']), 'refresh');
            }
        }
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['title'] = translate('add_employee');
        $this->data['sub_page'] = 'employee/add';
        $this->data['main_menu'] = 'employee';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'js/employee.js',
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    /* profile preview and information are controlled here */
    public function profile($id = '')
    {
        if (!get_permission('employee', 'is_edit')) {
            access_denied();
        }
        if ($this->input->post('submit') == 'update') {
            $this->employee_validation();
            if ($this->form_validation->run() == true) {
                //save all employee information in the database
                $this->employee_model->save($this->input->post());

                // handle custom fields data
                $class_slug = $this->router->fetch_class();
                $customField = $this->input->post("custom_fields[$class_slug]");
                if (!empty($customField)) {
                    saveCustomFields($customField, $id);
                }
                set_alert('success', translate('information_has_been_updated_successfully'));
                $this->session->set_flashdata('profile_tab', 1);
                redirect(base_url('employee/profile/' . $id));
            } else {
                $this->session->set_flashdata('profile_tab', 1);
            }
        }
        $this->data['categorylist'] = $this->app_lib->get_document_category();
        $this->data['staff'] = $this->employee_model->getSingleStaff($id);
        $this->data['title'] = translate('employee_profile');
        $this->data['sub_page'] = 'employee/profile';
        $this->data['main_menu'] = 'employee';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'js/employee.js',
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    // user interface and employees all information are prepared and stored in the database here
    public function delete($id = '')
    {
        if (!get_permission('employee', 'is_delete')) {
            access_denied();
        }
        // check student restrictions
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->delete('staff', array('id' => $id));
        if ($this->db->affected_rows() > 0) {
            $this->db->where('user_id', $id);
            $this->db->where_not_in('role', array(1, 6, 7));
            $this->db->delete('login_credential');
        }
    }

    // unique valid username verification is done here
    public function unique_username($username)
    {
        if ($this->input->post('staff_id')) {
            $staff_id = $this->input->post('staff_id');
            $login_id = $this->app_lib->get_credential_id($staff_id);
            $this->db->where_not_in('id', $login_id);
        }
        $this->db->where('username', $username);
        $query = $this->db->get('login_credential');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("unique_username", translate('username_has_already_been_used'));
            return false;
        } else {
            return true;
        }
    }

    public function valid_role($id)
    {
        $restrictions = array(1, 6, 7);
        if (in_array($id, $restrictions)) {
            $this->form_validation->set_message("valid_role", translate('selected_role_restrictions'));
            return false;
        } else {
            return true;
        }
    }

    // employee login password change here by admin
    public function change_password()
    {
        if (!get_permission('employee', 'is_edit')) {
            ajax_access_denied();
        }
        if (!isset($_POST['authentication'])) {
            $this->form_validation->set_rules('password', translate('password'), 'trim|required|min_length[4]');
        } else {
            $this->form_validation->set_rules('password', translate('password'), 'trim');
        }
        if ($this->form_validation->run() !== false) {
            $studentID = $this->input->post('staff_id');
            $password = $this->input->post('password');
            if (!isset($_POST['authentication'])) {
                $this->db->where_not_in('role', array(1, 6, 7));
                $this->db->where('user_id', $studentID);
                $this->db->update('login_credential', array('password' => $this->app_lib->pass_hashed($password)));
            }else{
                $this->db->where_not_in('role', array(1, 6, 7));
                $this->db->where('user_id', $studentID);
                $this->db->update('login_credential', array('active' => 0));
            }
            set_alert('success', translate('information_has_been_updated_successfully'));
            $array  = array('status' => 'success');
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail', 'error' => $error);
        }
        echo json_encode($array);
    }

    // employee bank details are create here / ajax
    public function bank_account_create()
    {
        if (!get_permission('employee', 'is_edit')) {
            ajax_access_denied();
        }
        $this->bank_validation();
        if ($this->form_validation->run() !== false) {
            $post = $this->input->post();
            $this->employee_model->bankSave($post);
            set_alert('success', translate('information_has_been_saved_successfully'));
            $this->session->set_flashdata('bank_tab', 1);
            echo json_encode(array('status' => 'success'));
        } else {
            $error = $this->form_validation->error_array();
            echo json_encode(array('status' => 'fail', 'error' => $error));
        }
        
    }

    // employee bank details are update here / ajax
    public function bank_account_update()
    {
        if (!get_permission('employee', 'is_edit')) {
            ajax_access_denied();
        }
        $this->bank_validation();
        if ($this->form_validation->run() !== false) {
            $post = $this->input->post();
            $this->employee_model->bankSave($post);
            $this->session->set_flashdata('bank_tab', 1);
            set_alert('success', translate('information_has_been_updated_successfully'));
            echo json_encode(array('status' => 'success'));
        } else {
            $error = $this->form_validation->error_array();
            echo json_encode(array('status' => 'fail', 'error' => $error));
        }
    }

    // employee bank details are delete here
    public function bankaccount_delete($id)
    {
        if (get_permission('employee', 'is_edit')) {
            $this->db->where('id', $id);
            $this->db->delete('staff_bank_account');
            $this->session->set_flashdata('bank_tab', 1);
        }
    }

    public function bank_details()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $query = $this->db->get('staff_bank_account');
        $result = $query->row_array();
        echo json_encode($result);
    }

    protected function document_validation()
    {
        $this->form_validation->set_rules('document_title', translate('document_title'), 'trim|required');
        $this->form_validation->set_rules('document_category', translate('document_category'), 'trim|required');
        if ($this->uri->segment(2) != 'document_update') {
            if (isset($_FILES['document_file']['name']) && empty($_FILES['document_file']['name'])) {
                $this->form_validation->set_rules('document_file', translate('document_file'), 'required');
            }
        }
    }

    // employee document details are create here / ajax
    public function document_create()
    {
        if (!get_permission('employee', 'is_edit')) {
            ajax_access_denied();
        }
        $this->document_validation();
        if ($this->form_validation->run() !== false) {
            $insert_doc = array(
                'staff_id' => $this->input->post('staff_id'),
                'title' => $this->input->post('document_title'),
                'category_id' => $this->input->post('document_category'),
                'remarks' => $this->input->post('remarks'),
            );
            // uploading file using codeigniter upload library
            $config['upload_path'] = './uploads/attachments/documents/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|docx|csv|txt';
            $config['max_size'] = '2048';
            $config['encrypt_name'] = true;
            $this->upload->initialize($config);
            if ($this->upload->do_upload("document_file")) {
                $insert_doc['file_name'] = $this->upload->data('orig_name');
                $insert_doc['enc_name'] = $this->upload->data('file_name');
                $this->db->insert('staff_documents', $insert_doc);
                set_alert('success', translate('information_has_been_saved_successfully'));
            } else {
                set_alert('error', strip_tags($this->upload->display_errors()));
            }
            $this->session->set_flashdata('documents_details', 1);
            echo json_encode(array('status' => 'success'));
        } else {
            $error = $this->form_validation->error_array();
            echo json_encode(array('status' => 'fail', 'error' => $error));
        }
    }

    // employee document details are update here / ajax
    public function document_update()
    {
        if (!get_permission('employee', 'is_edit')) {
            ajax_access_denied();
        }
        // validate inputs
        $this->document_validation();
        if ($this->form_validation->run() !== false) {
            $document_id = $this->input->post('document_id');
            $insert_doc = array(
                'title' => $this->input->post('document_title'),
                'category_id' => $this->input->post('document_category'),
                'remarks' => $this->input->post('remarks'),
            );
            if (isset($_FILES["document_file"]) && !empty($_FILES['document_file']['name'])) {
                $config['upload_path'] = './uploads/attachments/documents/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx|csv|txt';
                $config['max_size'] = '2048';
                $config['encrypt_name'] = true;
                $this->upload->initialize($config);
                if ($this->upload->do_upload("document_file")) {
                    $exist_file_name = $this->input->post('exist_file_name');
                    $exist_file_path = FCPATH . 'uploads/attachments/documents/' . $exist_file_name;
                    if (file_exists($exist_file_path)) {
                        unlink($exist_file_path);
                    }
                    $insert_doc['file_name'] = $this->upload->data('orig_name');
                    $insert_doc['enc_name'] = $this->upload->data('file_name');
                } else {
                    set_alert('error', strip_tags($this->upload->display_errors()));
                }
            }
            set_alert('success', translate('information_has_been_updated_successfully'));
            $this->db->where('id', $document_id);
            $this->db->update('staff_documents', $insert_doc);
            echo json_encode(array('status' => 'success'));
            $this->session->set_flashdata('documents_details', 1);
        } else {
            $error = $this->form_validation->error_array();
            echo json_encode(array('status' => 'fail', 'error' => $error));
        }
        
    }

    // employee document details are delete here
    public function document_delete($id)
    {
        if (get_permission('employee', 'is_edit')) {
            $enc_name = $this->db->select('enc_name')->where('id', $id)->get('staff_documents')->row()->enc_name;
            $file_name = FCPATH . 'uploads/attachments/documents/' . $enc_name;
            if (file_exists($file_name)) {
                unlink($file_name);
            }
            $this->db->where('id', $id);
            $this->db->delete('staff_documents');
            $this->session->set_flashdata('documents_details', 1);
        }
    }

    public function document_details()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $query = $this->db->get('staff_documents');
        $result = $query->row_array();
        echo json_encode($result);
    }

    /* file downloader */
    public function documents_download()
    {
        $encrypt_name = $this->input->get('file');
        $file_name = $this->db->select('file_name')->where('enc_name', $encrypt_name)->get('staff_documents')->row()->file_name;
        $this->load->helper('download');
        force_download($file_name, file_get_contents('uploads/documents/' . $encrypt_name));
    }

    /* department form validation rules */
    protected function department_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('department_name', translate('department_name'), 'trim|required|callback_unique_department');
    }

    // employee department user interface and information are controlled here
    public function department()
    {
        if ($_POST) {
            if (!get_permission('department', 'is_add')) {
                access_denied();
            }
            $this->department_validation();
            if ($this->form_validation->run() !== false) {
                $arrayDepartment = array(
                    'name' => $this->input->post('department_name'), 
                    'branch_id' => $this->application_model->get_branch_id(), 
                );
                $this->db->insert('staff_department', $arrayDepartment);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('employee/department'));
            }
        }
        $this->data['department'] = $this->app_lib->getTable('staff_department');
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/department';
        $this->data['main_menu'] = 'employee';
        $this->load->view('layout/index', $this->data);
    }

    public function department_edit()
    {
        if (!get_permission('department', 'is_edit')) {
            ajax_access_denied();
        }
        $this->department_validation();
        if ($this->form_validation->run() !== false) {
            $arrayDepartment = array(
                'name' => $this->input->post('department_name'), 
                'branch_id' => $this->application_model->get_branch_id(), 
            );
            $department_id = $this->input->post('department_id');
            $this->db->where('id', $department_id);
            $this->db->update('staff_department', $arrayDepartment);
            set_alert('success', translate('information_has_been_updated_successfully'));
            $array  = array('status' => 'success');
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail','error' => $error);
        }
        echo json_encode($array);
    }

    public function department_delete($id)
    {
        if (!get_permission('department', 'is_delete')) {
            access_denied();
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->delete('staff_department');
    }

    // unique valid department name verification is done here
    public function unique_department($name)
    {
        $department_id = $this->input->post('department_id');
        $branchID = $this->application_model->get_branch_id();
        if (!empty($department_id)) {
            $this->db->where_not_in('id', $department_id);
        }

        $this->db->where('branch_id', $branchID);
        $this->db->where('name', $name);
        $q = $this->db->get('staff_department');
        if ($q->num_rows() > 0) {
            $this->form_validation->set_message("unique_department", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }

    /* designation form validation rules */
    protected function designation_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('designation_name', translate('designation_name'), 'trim|required|callback_unique_designation');
    }

    // employee designation user interface and information are controlled here
    public function designation()
    {
        if ($_POST) {
            if (!get_permission('designation', 'is_add')) {
                access_denied();
            }
            $this->designation_validation();
            if ($this->form_validation->run() !== false) {
                $arrayData = array(
                    'name' => $this->input->post('designation_name'), 
                    'branch_id' => $this->application_model->get_branch_id(), 
                );
                $this->db->insert('staff_designation', $arrayData);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('employee/designation'));
            }
        }
        $this->data['designation'] = $this->app_lib->getTable('staff_designation');
        $this->data['title'] = translate('employee');
        $this->data['sub_page'] = 'employee/designation';
        $this->data['main_menu'] = 'employee';
        $this->load->view('layout/index', $this->data);
    }

    public function designation_edit()
    {
        if (!get_permission('designation', 'is_edit')) {
            ajax_access_denied();
        }
        $this->designation_validation();
        if ($this->form_validation->run() !== false) {
            $designation_id = $this->input->post('designation_id');
            $arrayData = array(
                'name' => $this->input->post('designation_name'), 
                'branch_id' => $this->application_model->get_branch_id(), 
            );
            $this->db->where('id', $designation_id);
            $this->db->update('staff_designation', $arrayData);
            set_alert('success', translate('information_has_been_updated_successfully'));
            $array  = array('status' => 'success');
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail','error' => $error);
        }
        echo json_encode($array);
    }

    public function designation_delete($id)
    {
        if (!get_permission('designation', 'is_delete')) {
            access_denied();
        }
        $this->db->where('id', $id);
        $this->db->delete('staff_designation');
    }

    // unique valid designation name verification is done here
    public function unique_designation($name)
    {
        $designation_id = $this->input->post('designation_id');
        $branchID = $this->application_model->get_branch_id();
        if (!empty($designation_id)) {
            $this->db->where_not_in('id', $designation_id);
        }
        $this->db->where('name', $name);
        $this->db->where('branch_id', $branchID);
        $q = $this->db->get('staff_designation');
        if ($q->num_rows() > 0) {
            $this->form_validation->set_message("unique_designation", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }

    // showing disable authentication student list
    public function disable_authentication()
    {
        // check access permission
        if (!get_permission('employee_disable_authentication', 'is_view')) {
            access_denied();
        }

        if (isset($_POST['search'])) {
            $branchID = $this->application_model->get_branch_id();
            $role = $this->input->post('staff_role');
            $this->data['stafflist'] = $this->employee_model->getStaffList($branchID, $role, 0);
        }

        if (isset($_POST['auth'])) {
            if (!get_permission('employee_disable_authentication', 'is_add')) {
                access_denied();
            }
            $stafflist = $this->input->post('views_bulk_operations');
            if (isset($stafflist)) {
                foreach ($stafflist as $id) {
                    $this->db->where('user_id', $id);
                    $this->db->where_not_in('role', array(1, 6, 7));
                    $this->db->update('login_credential', array('active' => 1));
                }
                set_alert('success', translate('information_has_been_updated_successfully'));
            } else {
                set_alert('error', 'Please select at least one item');
            }
            redirect(base_url('employee/disable_authentication'));
        }
        $this->data['title'] = translate('deactivate_account');
        $this->data['sub_page'] = 'employee/disable_authentication';
        $this->data['main_menu'] = 'employee';
        $this->load->view('layout/index', $this->data);
    }

    /* employee csv importer */
    public function csv_import()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'trim|required');
        }
        $this->form_validation->set_rules('user_role', translate('role'), 'trim|required');
        $this->form_validation->set_rules('designation_id', translate('designation'), 'trim|required');
        $this->form_validation->set_rules('department_id', translate('department'), 'trim|required');
        if (isset($_FILES['userfile']['name']) && empty($_FILES['userfile']['name'])) {
            $this->form_validation->set_rules('userfile', "Select CSV File", 'required');
        }
        if ($this->form_validation->run() !== false) {
            $branchID = $this->application_model->get_branch_id();
            $userRole = $this->input->post('user_role');
            $designationID = $this->input->post('designation_id');
            $departmentID = $this->input->post('department_id');
            $err_msg = "";
            $i = 0;
            $this->load->library('csvimport');
            $csv_array = $this->csvimport->get_array($_FILES["userfile"]["tmp_name"]);
            if ($csv_array) {
                $columnHeaders = array('Name','Gender','Religion','BloodGroup','DateOfBirth','JoiningDate','Qualification','MobileNo','PresentAddress','PermanentAddress','Email','Password');
                $csvData = array();
                foreach ($csv_array as $row) {
                    if ($i == 0) {
                        $csvData = array_keys($row);
                    }
                    $checkCSV = array_diff($columnHeaders, $csvData);
                    if (count($checkCSV) <= 0) {
                        if (filter_var($row['Email'], FILTER_VALIDATE_EMAIL)) {
                            // verify existing username
                            $this->db->where('username', $row['Email']);
                            $query = $this->db->get_where('login_credential');
                            if ($query->num_rows() > 0) {
                                $err_msg .= $row['Name'] . " - Imported Failed : Email Already Exists.<br>";
                            } else {
                                // save all employee information in the database
                                $this->employee_model->csvImport($row, $branchID, $userRole, $designationID, $departmentID);
                                $i++;
                            }
                        } else {
                            $err_msg .= $row['Name'] . " - Imported Failed : Invalid Email.<br>";
                        }
                    } else {
                        set_alert('error', translate('invalid_csv_file'));
                    }
                }
                if ($err_msg != null) {
                    $msgRes = $i . ' Students Have Been Successfully Added. <br>';
                    $msgRes .= $err_msg;
                    echo json_encode(array('status' => 'errlist', 'errMsg' => $msgRes));
                    exit();
                }
                if ($i > 0) {
                    set_alert('success', $i . ' Students Have Been Successfully Added');
                }
            } else {
                set_alert('error', translate('invalid_csv_file'));
            }
            echo json_encode(array('status' => 'success'));
        } else {
            $error = $this->form_validation->error_array();
            echo json_encode(array('status' => 'fail', 'error' => $error));
        }
    }

    /* sample csv downloader */
    public function csv_Sampledownloader()
    {
        $this->load->helper('download');
        $data = file_get_contents('uploads/multi_employee_sample.csv');
        force_download("multi_employee_sample.csv", $data);
    }
}
