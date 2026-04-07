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

class Student extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helpers('download');
        $this->load->helpers('custom_fields');
        $this->load->model('student_model');
        $this->load->model('email_model');
        $this->load->model('sms_model');
    }

    public function index()
    {
        redirect(base_url('student/view'));
    }

    /* student form validation rules */
    protected function student_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'trim|required');
        }
        $this->form_validation->set_rules('year_id', translate('academic_year'), 'trim|required');
        $this->form_validation->set_rules('register_no', translate('register_no'), 'trim|required');
        $this->form_validation->set_rules('admission_date', translate('admission_date'), 'trim|required');
        $this->form_validation->set_rules('class_id', translate('class'), 'trim|required');
        $this->form_validation->set_rules('section_id', translate('section'), 'trim|required');
        $this->form_validation->set_rules('category_id', translate('category'), 'trim|required');
        $this->form_validation->set_rules('first_name', translate('first_name'), 'trim|required');
        $this->form_validation->set_rules('last_name', translate('last_name'), 'trim|required');
        $this->form_validation->set_rules('mobileno', translate('mobile_no'), 'trim|required');
        $this->form_validation->set_rules('email', translate('email'), 'trim|required|valid_email|callback_unique_username');
        $this->form_validation->set_rules('roll', translate('roll_number'), 'trim|required|numeric|callback_unique_roll');
        $this->form_validation->set_rules('register_no', translate('register_no'), 'trim|required|callback_unique_registerid');
        $this->form_validation->set_rules('user_photo', 'profile_picture',array(array('handle_upload', array($this->application_model, 'profilePicUpload'))));
        if (!isset($_POST['student_id'])) {
            $this->form_validation->set_rules('password', translate('password'), 'trim|required|min_length[4]');
            $this->form_validation->set_rules('retype_password', translate('retype_password'), 'trim|required|matches[password]');
        }
        // custom fields validation rules
        $class_slug = $this->router->fetch_class();
        $customFields = getCustomFields($class_slug);
        foreach ($customFields as $fields_key => $fields_value) {
            if ($fields_value['required']) {
                $fieldsID   = $fields_value['id'];
                $fieldLabel = $fields_value['field_label'];
                $this->form_validation->set_rules("custom_fields[student][" . $fieldsID . "]", $fieldLabel, 'trim|required');
            }
        }
    }

    /* student admission information are prepared and stored in the database here */
    public function add()
    {
        // check access permission
        if (!get_permission('student', 'is_add')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if (isset($_POST['save'])) {
            $this->student_validation();
            if (!isset($_POST['guardian_chk'])) {
                $this->form_validation->set_rules('grd_name', translate('name'), 'trim|required');
                $this->form_validation->set_rules('grd_relation', translate('relation'), 'trim|required');
                $this->form_validation->set_rules('grd_occupation', translate('occupation'), 'trim|required');
                $this->form_validation->set_rules('grd_mobileno', translate('mobile_no'), 'trim|required');
                $this->form_validation->set_rules('grd_email', translate('email'), 'trim|required|callback_get_valid_guardian_email');
                $this->form_validation->set_rules('grd_password', translate('password'), 'trim|required');
                $this->form_validation->set_rules('grd_retype_password', translate('retype_password'), 'trim|required|matches[grd_password]');
            } else {
                $this->form_validation->set_rules('parent_id', translate('guardian'), 'required');
            }
            if ($this->form_validation->run() == true) {
                $post = $this->input->post();
                //save all student information in the database file
                $studentID = $this->student_model->save($post);
                //save student enroll information in the database file
                $arrayEnroll = array(
                    'student_id' => $studentID,
                    'class_id' => $post['class_id'],
                    'section_id' => $post['section_id'],
                    'roll' => $post['roll'],
                    'session_id' => $post['year_id'],
                    'branch_id' => $branchID,
                );
                $this->db->insert('enroll', $arrayEnroll);

                // handle custom fields data
                $class_slug = $this->router->fetch_class();
                $customField = $this->input->post("custom_fields[$class_slug]");
                if (!empty($customField)) {
                    saveCustomFields($customField, $studentID);
                }

                //send account activate sms
                $this->sms_model->send_sms($arrayEnroll, 1);
                //send account activate email
                $emailData = array(
                    'name' => $this->input->post('first_name'),
                    'login_email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'user_role' => 7,
                    'email' => $this->input->post('email'),
                );
                $this->email_model->sentStaffRegisteredAccount($emailData);

                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('student/add'));
            }
        }
        $this->data['branch_id'] = $branchID;
        $this->data['sub_page'] = 'student/add';
        $this->data['main_menu'] = 'admission';
        $this->data['register_id'] = $this->student_model->regSerNumber();
        $this->data['title'] = translate('create_admission');
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'js/student.js',
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    /* csv file to import student information  and stored in the database here */
    public function csv_import()
    {
        // check access permission
        if (!get_permission('multiple_import', 'is_add')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if (isset($_POST['save'])) {
            $err_msg = "";
            $i = 0;
            $this->load->library('csvimport');
            // form validation rules
            if (is_superadmin_loggedin() == true) {
                $this->form_validation->set_rules('branch_id', 'Branch', 'trim|required');
            }
            $this->form_validation->set_rules('class_id', 'Class', 'trim|required');
            $this->form_validation->set_rules('section_id', 'Section', 'trim|required');
            if (isset($_FILES["userfile"]) && empty($_FILES['userfile']['name'])) {
                $this->form_validation->set_rules('userfile', 'CSV File', 'required');
            }
            if ($this->form_validation->run() == true) {
                $classID = $this->input->post('class_id');
                $sectionID = $this->input->post('section_id');
                $csv_array = $this->csvimport->get_array($_FILES["userfile"]["tmp_name"]);
                if ($csv_array) {
                    $columnHeaders = array('FirstName','LastName','BloodGroup','Gender','Birthday','MotherTongue','Religion','Caste','Phone','City','State','PresentAddress','PermanentAddress','CategoryID','Roll','AdmissionDate','StudentEmail','StudentPassword','GuardianName','GuardianRelation','FatherName','MotherName','GuardianOccupation','GuardianMobileNo','GuardianAddress','GuardianEmail','GuardianPassword');
                    $csvData = array();
                    foreach ($csv_array as $row) {
                        if ($i == 0) {
                            $csvData = array_keys($row);
                        }
                        $csv_chk = array_diff($columnHeaders, $csvData);
                        if (count($csv_chk) <= 0) {
                            if (filter_var($row['StudentEmail'], FILTER_VALIDATE_EMAIL)) {
                                $r = $this->csvCheckExistsData($row['StudentEmail'], $row['Roll'], $classID, $branchID);
                                if ($r['status'] == false) {
                                    $err_msg .= $row['FirstName'] . ' ' . $row['LastName'] . " - Imported Failed : " . $r['message'] . "<br>";
                                } else {
                                    $this->student_model->csvImport($row, $classID, $sectionID, $branchID);
                                    $i++;
                                }
                            } else {
                                $err_msg .= $row['FirstName'] . ' ' . $row['LastName'] . " - Imported Failed : Invalid Email.<br>";
                            }
                        } else {
                            set_alert('error', translate('invalid_csv_file'));
                            redirect(base_url("student/csv_import"));
                        }
                    }
                    if ($err_msg != null) {
                        $this->session->set_flashdata('csvimport', $err_msg);
                    }
                    if ($i > 0) {
                        set_alert('success', $i . ' Students Have Been Successfully Added');
                    }
                    redirect(base_url("student/csv_import"));
                } else {
                    set_alert('error', translate('invalid_csv_file'));
                    redirect(base_url("student/csv_import"));
                }
            }
        }
        $this->data['title'] = translate('multiple_import');
        $this->data['branch_id'] = $branchID;
        $this->data['sub_page'] = 'student/multi_add';
        $this->data['main_menu'] = 'admission';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    /* showing disable authentication student list */
    public function disable_authentication()
    {
        // check access permission
        if (!get_permission('student_disable_authentication', 'is_view')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if (isset($_POST['search'])) {
            $classID = $this->input->post('class_id');
            $sectionID = $this->input->post('section_id');
            $this->data['students'] = $this->application_model->getStudentListByClassSection($classID, $sectionID, $branchID, true);
        }

        if (isset($_POST['auth'])) {
            if (!get_permission('student_disable_authentication', 'is_add')) {
                access_denied();
            }
            $stafflist = $this->input->post('views_bulk_operations');
            if (isset($stafflist)) {
                foreach ($stafflist as $id) {
                    $this->db->where(array('role' => 7, 'user_id' => $id));
                    $this->db->update('login_credential', array('active' => 1));
                }
                set_alert('success', translate('information_has_been_updated_successfully'));
            } else {
                set_alert('error', 'Please select at least one item');
            }
            redirect(base_url('student/disable_authentication'));
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('deactivate_account');
        $this->data['sub_page'] = 'student/disable_authentication';
        $this->data['main_menu'] = 'student';
        $this->load->view('layout/index', $this->data);
    }

    // add new student category
    public function category()
    {
        if (isset($_POST['category'])) {
            if (!get_permission('student_category', 'is_add')) {
                access_denied();
            }
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('category_name', translate('category_name'), 'trim|required|callback_unique_category');
            if ($this->form_validation->run() !== false) {
                $arrayData = array(
                    'name' => $this->input->post('category_name'),
                    'branch_id' => $this->application_model->get_branch_id(),
                );
                $this->db->insert('student_category', $arrayData);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('student/category'));
            }
        }
        $this->data['title'] = translate('student') . " " . translate('details');
        $this->data['sub_page'] = 'student/category';
        $this->data['main_menu'] = 'admission';
        $this->load->view('layout/index', $this->data);
    }

    // update existing student category
    public function category_edit()
    {
        if (!get_permission('student_category', 'is_edit')) {
            ajax_access_denied();
        }
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('category_name', translate('category_name'), 'trim|required|callback_unique_category');
        if ($this->form_validation->run() !== false) {
            $category_id = $this->input->post('category_id');
            $arrayData = array(
                'name' => $this->input->post('category_name'),
                'branch_id' => $this->application_model->get_branch_id(),
            );
            $this->db->where('id', $category_id);
            $this->db->update('student_category', $arrayData);
            set_alert('success', translate('information_has_been_updated_successfully'));
            $array  = array('status' => 'success');
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail','error' => $error);
        }
        echo json_encode($array);
    }

    // delete student category from database
    public function category_delete($id)
    {
        if (get_permission('student_category', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('student_category');
        }
    }

    // student category details send by ajax
    public function categoryDetails()
    {
        if (get_permission('student_category', 'is_edit')) {
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $query = $this->db->get('student_category');
            $result = $query->row_array();
            echo json_encode($result);
        }
    }

    /* validate here, if the check student category name */
    public function unique_category($name)
    {
        $branchID = $this->application_model->get_branch_id();
        $category_id = $this->input->post('category_id');
        if (!empty($category_id)) {
            $this->db->where_not_in('id', $category_id);
        }
        $this->db->where(array('name' => $name, 'branch_id' => $branchID));
        $uniform_row = $this->db->get('student_category')->num_rows();
        if ($uniform_row == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_category", translate('already_taken'));
            return false;
        }
    }

    /* showing student list by class and section */
    public function view()
    {
        // check access permission
        if (!get_permission('student', 'is_view')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if (isset($_POST['search'])) {
            $classID = $this->input->post('class_id');
            $sectionID = $this->input->post('section_id');
            $this->data['students'] = $this->application_model->getStudentListByClassSection($classID, $sectionID, $branchID, false, true);
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('student_list');
        $this->data['main_menu'] = 'student';
        $this->data['sub_page'] = 'student/view';
        $this->data['headerelements'] = array(
            'js' => array(
                'js/student.js'
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    /* profile preview and information are updating here */
    public function profile($id = '')
    {
        // check access permission
        if (!get_permission('student', 'is_edit')) {
            access_denied();
        }
        $this->load->model('fees_model');
        $this->load->model('exam_model');
        $getStudent = $this->student_model->getSingleStudent($id);
        if (isset($_POST['update'])) {
            $this->session->set_flashdata('profile_tab', 1);
            $this->data['branch_id'] = $this->application_model->get_branch_id();
            $this->student_validation();
            $this->form_validation->set_rules('parent_id', translate('guardian'), 'required');
            if ($this->form_validation->run() == true) {
                $post = $this->input->post();
                //save all student information in the database file
                $studentID = $this->student_model->save($post);
                //save student enroll information in the database file
                $arrayEnroll = array(
                    'class_id' => $this->input->post('class_id'),
                    'section_id' => $this->input->post('section_id'),
                    'roll' => $this->input->post('roll'),
                    'session_id' => $this->input->post('year_id'),
                    'branch_id' => $this->data['branch_id'],
                );
                $this->db->where('student_id', $id);
                $this->db->update('enroll', $arrayEnroll);

                // handle custom fields data
                $class_slug = $this->router->fetch_class();
                $customField = $this->input->post("custom_fields[$class_slug]");
                if (!empty($customField)) {
                    saveCustomFields($customField, $id);
                }
                set_alert('success', translate('information_has_been_updated_successfully'));
                redirect(base_url('student/profile/' . $id));
            }
        }
        $this->data['student'] = $getStudent;
        $this->data['title'] = translate('student_profile');
        $this->data['sub_page'] = 'student/profile';
        $this->data['main_menu'] = 'student';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'js/student.js',
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    /* student information delete here */
    public function delete_data($eid = '', $sid = '')
    {
        if (get_permission('student', 'is_delete')) {
            // Check student restrictions
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $eid);
            $this->db->delete('enroll');
            if ($this->db->affected_rows() > 0) {
                $this->db->where('id', $sid);
                $this->db->delete('student');
                $this->db->where(array('user_id' => $sid, 'role' => 7));
                $this->db->delete('login_credential');
            }
        }
    }

    // student document details are create here / ajax
    public function document_create()
    {
        if (!get_permission('student', 'is_edit')) {
            ajax_access_denied();
        }
        $this->form_validation->set_rules('document_title', translate('document_title'), 'trim|required');
        $this->form_validation->set_rules('document_category', translate('document_category'), 'trim|required');
        if (isset($_FILES['document_file']['name']) && empty($_FILES['document_file']['name'])) {
            $this->form_validation->set_rules('document_file', translate('document_file'), 'required');
        }
        if ($this->form_validation->run() !== false) {
            $insert_doc = array(
                'student_id' => $this->input->post('patient_id'),
                'title' => $this->input->post('document_title'),
                'type' => $this->input->post('document_category'),
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
                $this->db->insert('student_documents', $insert_doc);
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

    // student document details are update here / ajax
    public function document_update()
    {
        if (!get_permission('student', 'is_edit')) {
            ajax_access_denied();
        }
        // validate inputs
        $this->form_validation->set_rules('document_title', translate('document_title'), 'trim|required');
        $this->form_validation->set_rules('document_category', translate('document_category'), 'trim|required');
        if ($this->form_validation->run() !== false) {
            $document_id = $this->input->post('document_id');
            $insert_doc = array(
                'title' => $this->input->post('document_title'),
                'type' => $this->input->post('document_category'),
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
                    set_alert('success', translate('information_has_been_updated_successfully'));
                } else {
                    set_alert('error', strip_tags($this->upload->display_errors()));
                }
            }
            $this->db->where('id', $document_id);
            $this->db->update('student_documents', $insert_doc);
            echo json_encode(array('status' => 'success'));
            $this->session->set_flashdata('documents_details', 1);
        } else {
            $error = $this->form_validation->error_array();
            echo json_encode(array('status' => 'fail', 'error' => $error));
        }
        
    }

    // student document details are delete here
    public function document_delete($id)
    {
        if (get_permission('student', 'is_edit')) {
            $enc_name = $this->db->select('enc_name')->where('id', $id)->get('student_documents')->row()->enc_name;
            $file_name = FCPATH . 'uploads/attachments/documents/' . $enc_name;
            if (file_exists($file_name)) {
                unlink($file_name);
            }
            $this->db->where('id', $id);
            $this->db->delete('student_documents');
            $this->session->set_flashdata('documents_details', 1);
        }
    }

    public function document_details()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $query = $this->db->get('student_documents');
        $result = $query->row_array();
        echo json_encode($result);
    }

    // file downloader
    public function documents_download()
    {
        $encrypt_name = $this->input->get('file');
        $file_name = $this->db->select('file_name')->where('enc_name', $encrypt_name)->get('student_documents')->row()->file_name;
        $this->load->helper('download');
        force_download($file_name, file_get_contents('./uploads/attachments/documents/' . $encrypt_name));
    }

    /* sample csv downloader */
    public function csv_Sampledownloader()
    {
        $this->load->helper('download');
        $data = file_get_contents('uploads/multi_student_sample.csv');
        force_download("multi_student_sample.csv", $data);
    }

    /* validate here, if the check multi admission  email and roll */
    public function csvCheckExistsData($email, $roll, $class_id, $branchID)
    {
        $array = array();
        $roll_query = $this->db->get_where('enroll', array(
            'roll' => $roll,
            'class_id' => $class_id,
            'branch_id' => $branchID,
        ));
        if ($roll_query->num_rows() > 0) {
            $array['status'] = false;
            $array['message'] = "Roll Already Exists.";
            return $array;
        }
        $this->db->where('username', $email);
        $query = $this->db->get_where('login_credential');
        if ($query->num_rows() > 0) {
            $array['status'] = false;
            $array['message'] = "Email Already Exists.";
            return $array;
        }
        $array['status'] = true;
        return $array;
    }

    // unique valid username verification is done here
    public function unique_username($email)
    {
        if ($this->input->post('student_id')) {
            $student_id = $this->input->post('student_id');
            $login_id = $this->app_lib->get_credential_id($student_id, 'student');
            $this->db->where_not_in('id', $login_id);
        }
        $this->db->where('username', $email);
        $query = $this->db->get('login_credential');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("unique_username", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }

    /* unique valid guardian email address verification is done here */
    public function get_valid_guardian_email($email)
    {
        $this->db->where('username', $email);
        $query = $this->db->get('login_credential');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("get_valid_guardian_email", translate('username_has_already_been_used'));
            return false;
        } else {
            return true;
        }
    }

    /* unique valid student roll verification is done here */
    public function unique_roll($roll)
    {
        $branchID = $this->application_model->get_branch_id();
        $classID = $this->input->post('class_id');
        if ($this->uri->segment(3)) {
            $this->db->where_not_in('student_id', $this->uri->segment(3));
        }
        $this->db->where(array('roll' => $roll, 'class_id' => $classID, 'branch_id' => $branchID));
        $q = $this->db->get('enroll')->num_rows();
        if ($q == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_roll", translate('already_taken'));
            return false;
        }
    }

    /* unique valid register ID verification is done here */
    public function unique_registerid($register)
    {
        $branchID = $this->application_model->get_branch_id();
        if ($this->uri->segment(3)) {
            $this->db->where_not_in('id', $this->uri->segment(3));
        }
        $this->db->where('register_no', $register);
        $query = $this->db->get('student')->num_rows();
        if ($query == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_registerid", translate('already_taken'));
            return false;
        }
    }

    /* generate student id card with qr code */
    public function generate_idcard()
    {
        // check access permission
        if (!get_permission('student_id_card', 'is_view')) {
            access_denied();
        }

        $this->data['branch_id'] = $this->application_model->get_branch_id();
        if ($_POST) {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $this->data['query'] = $this->student_model->getStudentList($class_id, $section_id, $this->data['branch_id']);
        }
        $this->data['title'] = translate('id_card_generate');
        $this->data['headerelements'] = array(
            'css' => array(
                'css/idcard.css',
            )
        );
        $this->data['sub_page'] = 'student/idcard';
        $this->data['main_menu'] = 'student';
        $this->load->view('layout/index', $this->data);
    }

    /* generate qrcode by id */
    public function create_qrcode($id)
    {
        $config['cachedir'] = FCPATH . 'uploads/qrcode_cache/';
        $this->load->library('ciqrcode', $config);
        header("Content-Type: image/png");
        $params['data'] = $id;
        $this->ciqrcode->generate($params);
    }

    public function search()
    {
        // check access permission
        if (!get_permission('student', 'is_view')) {
            access_denied();
        }

        $search_text = $this->input->post('search_text');
        $this->data['query'] = $this->student_model->getSearchStudentList(trim($search_text));
        $this->data['title'] = translate('searching_results');
        $this->data['sub_page'] = 'student/search';
        $this->data['main_menu'] = '';
        $this->load->view('layout/index', $this->data);
    }

    /* student password change here */
    public function change_password()
    {
        if (get_permission('student', 'is_edit')) {
            if (!isset($_POST['authentication'])) {
                $this->form_validation->set_rules('password', translate('password'), 'trim|required|min_length[4]');
            } else {
                $this->form_validation->set_rules('password', translate('password'), 'trim');
            }
            if ($this->form_validation->run() !== false) {
                $studentID = $this->input->post('student_id');
                $password = $this->input->post('password');
                if (!isset($_POST['authentication'])) {
                    $this->db->where('role', 7);
                    $this->db->where('user_id', $studentID);
                    $this->db->update('login_credential', array('password' => $this->app_lib->pass_hashed($password)));
                }else{
                    $this->db->where('role', 7);
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
    }

    /* student transfer user interface and information stored in the database here */
    public function transfer()
    {
        // check access permission
        if (!get_permission('student_promotion', 'is_view')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if ($this->input->post()) {
            $this->data['class_id'] = $this->input->post('class_id');
            $this->data['section_id'] = $this->input->post('section_id');
            $this->data['students'] = $this->application_model->getStudentListByClassSection($this->data['class_id'], $this->data['section_id'], $branchID, false, true);
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('student_promotion');
        $this->data['sub_page'] = 'student/transfer';
        $this->data['main_menu'] = 'transfer';
        $this->load->view('layout/index', $this->data);
    }

    public function transfersave()
    {
        // check access permission
        if (!get_permission('student_promotion', 'is_add')) {
            ajax_access_denied();
        }

        if ($_POST) {
            $this->form_validation->set_rules('promote_session_id', translate('promote_to_session'), 'required');
            $this->form_validation->set_rules('promote_class_id', translate('promote_to_class'), 'required');
            $this->form_validation->set_rules('promote_section_id', translate('promote_section_id'), 'required');
            $items = $this->input->post('promote');
            foreach ($items as $key => $value) {
                if (isset($value['enroll_id'])) {
                    $this->form_validation->set_rules('promote[' . $key . '][roll]', translate('roll'), 'required|callback_unique_prom_roll');
                }
            }
            if ($this->form_validation->run() !== false) {
                $promote_session_id = $this->input->post('promote_session_id');
                $promote_class_id = $this->input->post('promote_class_id');
                $promote_section_id = $this->input->post('promote_section_id');
                $branchID = $this->application_model->get_branch_id();
                $promote = $this->input->post('promote');
                foreach ($promote as $key => $value) {
                    if (isset($value['enroll_id'])) {
                        $roll = $value['roll'];
                        $enroll_id = $value['enroll_id'];
                        $this->db->where('student_id', $value['student_id']);
                        $this->db->where('session_id', $promote_session_id);
                        $query = $this->db->get('enroll');
                        $arrayData = array(
                            'student_id' => $value['student_id'],
                            'class_id' => $promote_class_id,
                            'roll' => $roll,
                            'section_id' => $promote_section_id,
                            'session_id' => $promote_session_id,
                            'branch_id' => $branchID,
                        );

                        if ($query->num_rows() > 0) {
                            $this->db->where('id', $enroll_id);
                            $this->db->update('enroll', $arrayData);
                        } else {
                            $this->db->insert('enroll', $arrayData);
                        }
                    }
                }
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('student/transfer');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function unique_prom_roll($roll)
    {
        if ($roll) {
            $promote_session_id = $this->input->post('promote_session_id');
            $promote_class_id = $this->input->post('promote_class_id');
            $branchID = $this->application_model->get_branch_id();
            $unique_roll = $this->db->select('id')->where(array(
                'roll' => $roll,
                'class_id' => $promote_class_id,
                'session_id' => $promote_session_id,
                'branch_id' => $branchID,
            ))->get('enroll')->num_rows();
            if ($unique_roll == 0) {
                return true;
            } else {
                $this->form_validation->set_message('unique_prom_roll', "The %s is already exists.");
                return false;
            }
        }
    }

    // student quick details
    public function quickDetails()
    {
        $id = $this->input->post('student_id');
        $this->db->select('student.*,enroll.student_id,enroll.roll,student_category.name as cname');
        $this->db->from('enroll');
        $this->db->join('student', 'student.id = enroll.student_id', 'inner');
        $this->db->join('student_category', 'student_category.id = student.category_id', 'inner');
        $this->db->where('enroll.id', $id);
        $row = $this->db->get()->row();
        $data['photo'] = get_image_url('student', $row->photo);
        $data['full_name'] = $row->first_name . " " . $row->last_name;
        $data['student_category'] = $row->cname;
        $data['register_no'] = $row->register_no;
        $data['roll'] = $row->roll;
        $data['admission_date'] = empty($row->admission_date) ? "N/A" : _d($row->admission_date);
        $data['birthday'] = empty($row->birthday) ? "N/A" : _d($row->birthday);
        $data['blood_group'] = empty($row->blood_group) ? "N/A" : $row->blood_group;
        $data['religion'] = empty($row->religion) ? "N/A" : $row->religion;
        $data['email'] = $row->email;
        $data['mobileno'] = empty($row->mobileno) ? "N/A" : $row->mobileno;
        $data['state'] = empty($row->state) ? "N/A" : $row->state;
        $data['address'] = empty($row->current_address) ? "N/A" : $row->current_address;
        echo json_encode($data);
    }

    function bulk_delete()
    {
        $status = 'success';
        $message = translate('information_deleted');
        if (get_permission('student', 'is_delete')) {
            $arrayID = $this->input->post('array_id');
            $this->db->where_in('student_id', $arrayID);
            $this->db->delete('enroll');
            $this->db->where_in('id', $arrayID);
            $this->db->delete('student');
            $this->db->where_in('user_id', $arrayID);
            $this->db->where('role', 7);
            $this->db->delete('login_credential');
        } else {
            $message = translate('access_denied');
            $status = 'error';
        }
        echo json_encode(array('status' => $status, 'message' => $message));
    }
}
