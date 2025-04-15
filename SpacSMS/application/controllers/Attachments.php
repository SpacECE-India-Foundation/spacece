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

class Attachments extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helpers('download');
        $this->load->model('attachments_model');
    }

    public function index()
    {
        // check access permission
        if (!get_permission('attachments', 'is_view')) {
            access_denied();
        }

        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['attachmentss'] = $this->attachments_model->getAttachmentsList();
        $this->data['title'] = translate('upload_content');
        $this->data['sub_page'] = 'attachments/index';
        $this->data['main_menu'] = 'attachments';
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

    // attachments information edit here
    public function edit($id = '')
    {
        // check access permission
        if (!get_permission('attachments', 'is_edit')) {
            access_denied();
        }

        $attachments_db = $this->db->where('id', $id)->get('attachments')->row_array();
        if ($attachments_db['uploader_id'] != get_loggedin_user_id()) {
            set_alert('error', 'You do not have permission to edit');
            redirect(base_url('attachments'));
        }

        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['data'] = $this->db->where('id', $id)->get('attachments')->row_array();
        $this->data['title'] = translate('upload_content');
        $this->data['sub_page'] = 'attachments/edit';
        $this->data['main_menu'] = 'attachments';
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

    public function save()
    {
        if ($_POST) {
            if (isset($_POST['attachment_id'])) {
                if (!get_permission('attachments', 'is_edit')) {
                    ajax_access_denied();
                }
            } else {
                if (!get_permission('attachments', 'is_add')) {
                    ajax_access_denied();
                }
            }
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('title', translate('title'), 'trim|required');
            $this->form_validation->set_rules('type_id', translate('type'), 'trim|required');
            $this->form_validation->set_rules('date', translate('date'), 'trim|required');
            $this->form_validation->set_rules('attachment_file', translate('attachment'), 'callback_handle_upload');
            if (!isset($_POST['all_class_set'])) {
                $this->form_validation->set_rules('class_id', translate('class'), 'trim|required');
            }
            if (!isset($_POST['subject_wise']) && !isset($_POST['all_class_set'])) {
                $this->form_validation->set_rules('subject_id', translate('subject'), 'trim|required');
            }
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $response = $this->attachments_model->save($post);
                if (is_array($response)) {
                    set_alert('error', $response['error']);
                } else {
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                }
                $url = base_url('attachments');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function delete($id)
    {
        if (get_permission('attachments', 'is_delete')) {
            $enc_name = $this->db->select('enc_name')->where('id', $id)->get('attachments')->row()->enc_name;
            $file_name = 'uploads/attachments/' . $enc_name;
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
                $this->db->where('uploader_id', get_loggedin_user_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('attachments');
            if ($this->db->affected_rows() > 0) {
                if (file_exists($file_name)) {
                    unlink($file_name);
                }
            }

        }
    }

    /* type form validation rules */
    protected function type_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('type_name', translate('type_name'), 'trim|required|callback_unique_type');
    }

    // view and save attachment type from database
    public function type()
    {
        if (isset($_POST['save'])) {
            if (!get_permission('attachment_type', 'is_add')) {
                access_denied();
            }
            $this->type_validation();
            if ($this->form_validation->run() !== false) {
                $arrayData = array(
                    'name' => $this->input->post('type_name'),
                    'branch_id' => $this->application_model->get_branch_id(),
                );
                $this->db->insert('attachments_type', $arrayData);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(current_url());
            }
        }

        $this->data['typelist'] = $this->app_lib->getTable('attachments_type');
        $this->data['title'] = translate('attachment_type');
        $this->data['sub_page'] = 'attachments/type';
        $this->data['main_menu'] = 'attachments';
        $this->load->view('layout/index', $this->data);
    }

    public function type_edit()
    {
        if ($_POST) {
            if (!get_permission('attachment_type', 'is_edit')) {
                ajax_access_denied();
            }
            $this->type_validation();
            if ($this->form_validation->run() !== false) {
                $arrayData = array(
                    'name' => $this->input->post('type_name'),
                    'branch_id' => $this->application_model->get_branch_id(),
                );
                $type_id = $this->input->post('type_id');
                $this->db->where('id', $type_id);
                $this->db->update('attachments_type', $arrayData);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('attachments/type');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    // delete attachment type from database
    public function type_delete($id)
    {
        if (get_permission('attachment_type', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('attachments_type');
        }
    }

    // unique valid attachment type name verification is done here
    public function unique_type($name)
    {
        $branchID = $this->application_model->get_branch_id();
        $type_id = $this->input->post('type_id');
        if (!empty($type_id)) {
            $this->db->where_not_in('id', $type_id);
        }
        $this->db->where(array('name' => $name, 'branch_id' => $branchID));
        $uniform_row = $this->db->get('attachments_type')->num_rows();
        if ($uniform_row == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_type", translate('already_taken'));
            return false;
        }
    }

    // file downloader
    public function download()
    {
        $encrypt_name = $this->input->get('file');
        $file_name = $this->db->select('file_name')->where('enc_name', $encrypt_name)->get('attachments')->row()->file_name;
        $this->load->helper('download');
        force_download($file_name, file_get_contents('uploads/attachments/' . $encrypt_name));
    }

    // upload file form validation
    public function handle_upload()
    {
        if (isset($_FILES["attachment_file"]) && !empty($_FILES['attachment_file']['name'])) {
            $file_type = $_FILES["attachment_file"]['type'];
            $file_size = $_FILES["attachment_file"]["size"];
            $file_name = $_FILES["attachment_file"]["name"];
            $allowedExts = array('pdf', 'doc', 'xls', 'docx', 'xlsx', 'txt', 'jpg', 'jpeg', 'png', 'gif', 'bmp');
            $upload_size = 2097152;
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            if ($files = filesize($_FILES['attachment_file']['tmp_name'])) {
                if (!in_array(strtolower($extension), $allowedExts)) {
                    $this->form_validation->set_message('handle_upload', translate('this_file_type_is_not_allowed'));
                    return false;
                }
                if ($file_size > $upload_size) {
                    $this->form_validation->set_message('handle_upload', translate('file_size_shoud_be_less_than') . " " . ($upload_size / 1024) . " KB");
                    return false;
                }
            } else {
                $this->form_validation->set_message('handle_upload', translate('error_reading_the_file'));
                return false;
            }
            return true;
        } else {
            if (isset($_POST['attachment_id'])) {
                return true;
            }
            $this->form_validation->set_message('handle_upload', "The Attachment field is required.");
            return false;
        }
    }
}
