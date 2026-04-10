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

class Profile extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('student_model');
        $this->load->model('parents_model');
        $this->load->model('profile_model');
        $this->load->model('email_model');
    }

    public function index()
    {
        $userID = get_loggedin_user_id();
        $loggedinRoleID = loggedin_role_id();
        if ($loggedinRoleID == 6) {
            if ($_POST) {
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
                if ($this->form_validation->run() == true) {
                    $data = $this->input->post();
                    $this->profile_model->parentUpdate($data);
                    set_alert('success', translate('information_has_been_updated_successfully'));
                    redirect(base_url('profile')); 
                }
            }
            $this->data['parent'] = $this->parents_model->getSingleParent($userID);
            $this->data['sub_page'] = 'profile/parent';
        } elseif ($loggedinRoleID == 7) {
            if ($_POST) {
                $this->form_validation->set_rules('first_name', translate('first_name'), 'trim|required');
                $this->form_validation->set_rules('last_name', translate('last_name'), 'trim|required');
                $this->form_validation->set_rules('mobileno', translate('mobile_no'), 'trim|required');
                $this->form_validation->set_rules('email', translate('email'), 'required|valid_email|callback_unique_username');
                $this->form_validation->set_rules('user_photo', 'profile_picture',array(array('handle_upload', array($this->application_model, 'profilePicUpload'))));
                if ($this->form_validation->run() == true) {
                    $data = $this->input->post();
                    $this->profile_model->studentUpdate($data);
                    set_alert('success', translate('information_has_been_updated_successfully'));
                    redirect(base_url('profile'));
                }
            }
            $this->data['student'] = $this->student_model->getSingleStudent($userID);
            $this->data['sub_page'] = 'profile/student';
        } else {
            if ($_POST) {
                $this->form_validation->set_rules('name', translate('name'), 'trim|required');
                $this->form_validation->set_rules('mobile_no', translate('mobile_no'), 'trim|required');
                $this->form_validation->set_rules('present_address', translate('present_address'), 'trim|required');
                if (is_admin_loggedin()) {
                    $this->form_validation->set_rules('designation_id', translate('designation'), 'trim|required');
                    $this->form_validation->set_rules('department_id', translate('department'), 'trim|required');
                    $this->form_validation->set_rules('joining_date', translate('joining_date'), 'trim|required');
                    $this->form_validation->set_rules('qualification', translate('qualification'), 'trim|required');
                }
                $this->form_validation->set_rules('email', translate('email'), 'trim|required|valid_email|callback_unique_username');
                $this->form_validation->set_rules('facebook', 'Facebook', 'trim|valid_url');
                $this->form_validation->set_rules('twitter', 'Twitter', 'trim|valid_url');
                $this->form_validation->set_rules('linkedin', 'Linkedin', 'trim|valid_url');
                $this->form_validation->set_rules('user_photo', 'profile_picture',array(array('handle_upload', array($this->application_model, 'profilePicUpload'))));
                if ($this->form_validation->run() == true) {
                    $data = $this->input->post();
                    $this->profile_model->staffUpdate($data);
                    set_alert('success', translate('information_has_been_updated_successfully'));
                    redirect(base_url('profile'));
                }
            }
            $this->data['staff'] = $this->employee_model->getSingleStaff($userID);
            $this->data['sub_page'] = 'profile/employee';
        }

        $this->data['title'] = translate('profile') . " " . translate('edit');
        $this->data['main_menu'] = 'profile';
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

    // unique valid username verification is done here
    public function unique_username($username)
    {
        $this->db->where_not_in('id', get_loggedin_id());
        $this->db->where('username', $username);
        $query = $this->db->get('login_credential');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("unique_username", translate('username_has_already_been_used'));
            return false;
        } else {
            return true;
        }
    }


    // when user change his password
    public function password()
    {
        if ($_POST) {
            $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|min_length[4]|callback_check_validate_password');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[4]|matches[new_password]');
            if ($this->form_validation->run() !== false) {
                $new_password = $this->input->post('new_password');
                $this->db->where('id', get_loggedin_id());
                $this->db->update('login_credential', array('password' => $this->app_lib->pass_hashed($new_password)));
                set_alert('success', translate('password_has_been_changed'));
                redirect(base_url('profile/password'));
            }
        }

        $this->data['sub_page'] = 'profile/password_change';
        $this->data['main_menu'] = 'profile';
        $this->data['title'] = translate('profile');
        $this->load->view('layout/index', $this->data);
    }

    // current password verification is done here
    public function check_validate_password($password)
    {
        if ($password) {
            $getPassword = $this->db->select('password')
                ->where('id', get_loggedin_id())
                ->get('login_credential')->row()->password;
            $getVerify = $this->app_lib->verify_password($password, $getPassword);
            if ($getVerify) {
                return true;
            } else {
                $this->form_validation->set_message("check_validate_password", translate('current_password_is_invalid'));
                return false;
            }
        }
    }
}
