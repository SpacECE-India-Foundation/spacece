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

class Parents extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helpers('custom_fields');
        $this->load->model('email_model');
        $this->load->model('parents_model');
    }

    public function index()
    {
        redirect(base_url('parents/view'));
    }

    /* parent form validation rules */
    protected function parent_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'trim|required');
        }
        $this->form_validation->set_rules('name', translate('name'), 'trim|required');
        $this->form_validation->set_rules('relation', translate('relation'), 'trim|required');
        $this->form_validation->set_rules('occupation', translate('occupation'), 'trim|required');
        $this->form_validation->set_rules('income', translate('income'), 'trim|numeric');
        $this->form_validation->set_rules('mobileno', translate('mobile_no'), 'trim|required');
        $this->form_validation->set_rules('email', translate('email'), 'trim|required|valid_email|callback_unique_username');
        $this->form_validation->set_rules('user_photo', 'profile_picture',array(array('handle_upload', array($this->application_model, 'profilePicUpload'))));
        $this->form_validation->set_rules('facebook', 'Facebook', 'valid_url');
        $this->form_validation->set_rules('twitter', 'Twitter', 'valid_url');
        $this->form_validation->set_rules('linkedin', 'Linkedin', 'valid_url');
        if (!isset($_POST['parent_id'])) {
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
                $this->form_validation->set_rules("custom_fields[parents][" . $fieldsID . "]", $fieldLabel, 'trim|required');
            }
        }
    }

    /* parents list user interface  */
    public function view()
    {
        // check access permission
        if (!get_permission('parent', 'is_view')) {
            access_denied();
        }
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['title'] = translate('parents_list');
        $this->data['sub_page'] = 'parents/view';
        $this->data['main_menu'] = 'parents';
        $this->load->view('layout/index', $this->data);  
    }

    /* user all information are prepared and stored in the database here */
    public function add()
    {
        if (!get_permission('parent', 'is_add')) {
            access_denied();
        }
        if ($this->input->post('submit') == 'save') {
            $this->parent_validation();
            if ($this->form_validation->run() == true) {
                $post = $this->input->post();
                //save all employee information in the database
                $parentID = $this->parents_model->save($post);

                // handle custom fields data
                $class_slug = $this->router->fetch_class();
                $customField = $this->input->post("custom_fields[$class_slug]");
                if (!empty($customField)) {
                    saveCustomFields($customField, $parentID);
                }

                // send account activate email
                $post['user_role'] = 6;
                $this->email_model->sentStaffRegisteredAccount($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(base_url('parents/add'));
            }
        }
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['title'] = translate('add_parent');
        $this->data['sub_page'] = 'parents/add';
        $this->data['main_menu'] = 'parents';
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

    /* parents deactivate list user interface  */
    public function disable_authentication()
    {
        // check access permission
        if (!get_permission('parent_disable_authentication', 'is_view')) {
            access_denied();
        }
        if (isset($_POST['auth'])) {
            if (!get_permission('parent_disable_authentication', 'is_add')) {
                access_denied();
            }
            $stafflist = $this->input->post('views_bulk_operations');
            if (isset($stafflist)) {
                foreach ($stafflist as $id) {
                    $this->db->where(array('role' => 6, 'user_id' => $id));
                    $this->db->update('login_credential', array('active' => 1));
                }
                set_alert('success', translate('information_has_been_updated_successfully'));
            } else {
                set_alert('error', 'Please select at least one item');
            }
            redirect(base_url('parents/disable_authentication'));
        }
        $this->data['parentslist'] = $this->parents_model->getParentList('', 0);
        $this->data['title'] = translate('deactivate_account');
        $this->data['sub_page'] = 'parents/disable_authentication';
        $this->data['main_menu'] = 'parents';
        $this->load->view('layout/index', $this->data);
    }

    /* profile preview and information are controlled here */
    public function profile($id = '')
    {
        if (!get_permission('parent', 'is_edit')) {
            access_denied();
        }
        if (isset($_POST['update'])) {
            $this->parent_validation();
            if ($this->form_validation->run() == true) {
                $post = $this->input->post();
                //save all employee information in the database
                $this->parents_model->save($post);
                
                // handle custom fields data
                $class_slug = $this->router->fetch_class();
                $customField = $this->input->post("custom_fields[$class_slug]");
                if (!empty($customField)) {
                    saveCustomFields($customField, $id);
                }
                set_alert('success', translate('information_has_been_saved_successfully'));
                $this->session->set_flashdata('profile_tab', 1);
                redirect(base_url('parents/profile/' . $id));
            } else {
                $this->session->set_flashdata('profile_tab', 1);
            }
        }
        $this->data['student_id'] = $id;
        $this->data['parent'] = $this->parents_model->getSingleParent($id);
        $this->data['title'] = translate('parents_profile');
        $this->data['main_menu'] = 'parents';
        $this->data['sub_page'] = 'parents/profile';
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

    /* parents delete  */
    public function delete($id = '')
    {
        // check access permission
        if (!get_permission('parent', 'is_delete')) {
            access_denied();
        }

        // delete from parent table
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->delete('parent');
        if ($this->db->affected_rows() > 0) {
            $this->db->where(array('user_id' => $id, 'role' => 6));
            $this->db->delete('login_credential');
        }
    }

    // unique valid username verification is done here
    public function unique_username($username)
    {
        $parent_id = $this->input->post('parent_id');
        if (!empty($parent_id)) {
            $login_id = $this->app_lib->get_credential_id($parent_id, 'parent');
            $this->db->where_not_in('id', $login_id);
        }
        $this->db->where('username', $username);
        $query = $this->db->get('login_credential');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("unique_username", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }

    /* password change here */
    public function change_password()
    {
        if (!get_permission('parent', 'is_edit')) {
           ajax_access_denied(); 
        }
        if (!isset($_POST['authentication'])) {
            $this->form_validation->set_rules('password', translate('password'), 'trim|required|min_length[4]');
        } else {
            $this->form_validation->set_rules('password', translate('password'), 'trim');
        }
        if ($this->form_validation->run() !== false) {
            $parentID = $this->input->post('parent_id');
            $password = $this->input->post('password');
            if (!isset($_POST['authentication'])) {
                $this->db->where('role', 6);
                $this->db->where('user_id', $parentID);
                $this->db->update('login_credential', array('password' => $this->app_lib->pass_hashed($password)));
            }else{
                $this->db->where('role', 6);
                $this->db->where('user_id', $parentID);
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


    /* to set the children id in the session after the parent login */
    public function select_child($id = '')
    {
        if (is_parent_loggedin()) {
            $query = $this->db->select('id')->where(array('id' => $id, 'parent_id' => get_loggedin_user_id()))->get('student');
            if ($query->num_rows() == 1) {
                $this->session->set_userdata('myChildren_id', $id);
            }
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    public function my_children($id = '')
    {
        if (is_parent_loggedin()) {
            $this->session->set_userdata('myChildren_id', '');
            redirect(base_url('dashboard'));
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }
}
