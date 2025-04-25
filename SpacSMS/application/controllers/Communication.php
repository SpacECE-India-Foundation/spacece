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

class Communication extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('communication_model');
    }

    public function index()
    {
        if (is_loggedin()) {
            redirect(base_url('communication/mailbox/inbox'));
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function mailbox($action = 'inbox')
    {
        if ($action == 'compose') {
            if ($this->input->post('submit') == 'send') {
                $this->form_validation->set_rules('message_body', 'Message', 'trim|required');
                if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                    $message_id = $this->communication_model->mailbox_compose($post);
                    set_alert('success', translate('message_sent_successfully'));
                    redirect(base_url('communication/mailbox/sent'));
                } else {
                    set_alert('error', translate('message_send_failed'));
                    redirect(base_url('communication/mailbox/compose'));
                }
            }
            $this->data['inside_subview'] = 'message_compose';
        } elseif ($action == 'inbox') {
            $this->data['inside_subview'] = 'message_inbox';
        } elseif ($action == 'sent') {
            $this->data['inside_subview'] = 'message_sent';
        } elseif ($action == 'important') {
            $this->data['inside_subview'] = 'message_important';
        } elseif ($action == 'trash') {
            $this->data['inside_subview'] = 'message_trash';
        } elseif ($action == 'read') {
            $id = $this->input->get('id');
            $response = $this->communication_model->mark_messages_read($id);
            $this->data['message_id'] = $id;
            $this->data['inside_subview'] = 'message_read';
        }
        $this->data['active_user'] = loggedin_role_id() . '-' . get_loggedin_user_id();
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['title'] = translate('mailbox');
        $this->data['sub_page'] = 'communication/message';
        $this->data['main_menu'] = 'message';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/summernote/summernote.css',
                'vendor/bootstrap-fileupload/bootstrap-fileupload.min.css',
            ),
            'js' => array(
                'vendor/summernote/summernote.js',
                 'vendor/bootstrap-fileupload/bootstrap-fileupload.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    public function message_send() {
        if ($_POST) {
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('role_id', translate('role'), 'trim|required');
            $this->form_validation->set_rules('receiver_id', translate('receiver'), 'trim|required');
            $this->form_validation->set_rules('subject', translate('subject'), 'trim|required');
            $this->form_validation->set_rules('message_body', translate('message'), 'trim|required');
            $this->form_validation->set_rules('attachment_file', translate('attachment'), 'callback_handle_upload');
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $message_id = $this->communication_model->mailbox_compose($post);
                set_alert('success', translate('message_sent_successfully'));
                $array = array('status' => 'success');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function message_reply()
    {
        if ($_POST) {
            $this->form_validation->set_rules('attachment_file', translate('attachment'), 'callback_handle_upload');
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            if ($this->form_validation->run() == true) {
                $message_id = $this->input->post('message_id');
                if ($this->input->post('user_identity') == 'sender') {
                    $arrayMsg['identity'] = 1;
                    $this->db->where('id', $message_id);
                    $this->db->update('message', array('read_status' => 0));
                } else {
                    $arrayMsg['identity'] = 0;
                    $this->db->where('id', $message_id);
                    $this->db->update('message', array('reply_status' => 1));
                }

                $arrayMsg['message_id'] = $message_id;
                $arrayMsg['body'] = $this->input->post('message');
                if($_FILES["attachment_file"]['name'] !="") {
                    // uploading file using codeigniter upload library
                    $config['upload_path'] = 'uploads/attachments/';
                    $config['encrypt_name'] = true;
                    $config['allowed_types'] = '*';
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("attachment_file")) {
                        $arrayMsg['file_name'] = $this->upload->data('orig_name');
                        $arrayMsg['enc_name'] = $this->upload->data('file_name');
                    }
                }
                $this->db->insert('message_reply', $arrayMsg);
                $array = array('status' => 'success');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
        }
    }


    // file downloader
    public function download()
    {
        $encrypt_name = $this->input->get('file');
        $type = $this->input->get('type');
        if ($type == 'reply') {
            $table = 'message_reply';
        } else {
            $table = 'message';
        }
        $file_name = $this->db->select('file_name')->where('enc_name', $encrypt_name)->get($table)->row()->file_name;
        $this->load->helper('download');
        force_download($file_name, file_get_contents('uploads/attachments/' . $encrypt_name));
    }

    public function handle_upload()
    {
        if (isset($_FILES["attachment_file"]) && !empty($_FILES['attachment_file']['name'])) {
            $file_type = $_FILES["attachment_file"]['type'];
            $file_size = $_FILES["attachment_file"]["size"];
            $file_name = $_FILES["attachment_file"]["name"];
            $allowedExts = array('pdf', 'csv', 'doc', 'xls', 'docx', 'xlsx', 'jpg', 'jpeg', 'png', 'gif', 'bmp');
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
        }
    }

    /* message delete */
    public function delete_mail()
    {
        $arrayID = $this->input->post('arrayID');
        $mode = $this->input->post('mode');
        if (count($arrayID)) {
            foreach ($arrayID as $value) {
                $this->db->where('id', $value);
                $this->db->update('message', array('trash_' . $mode => 1));
            }
            set_alert('success', translate('message_has_been_deleted'));
        } else {
            set_alert('error', 'Please Select a Message to Delete');
        }
    }

    public function set_fvourite_status()
    {
        $messageID = $this->input->post('messageID');
        $status = $this->input->post('status');
        $active_user = loggedin_role_id() . '-' . get_loggedin_user_id();
        $query = $this->db->select('sender,reciever')->where('id', $messageID)->get('message')->row();
        if ($active_user == $query->sender) {
            $data['fav_sent'] = ($status == 'false' ? 0 : 1);
        } elseif ($active_user == $query->reciever) {
            $data['fav_inbox'] = ($status == 'false' ? 0 : 1);
        }

        $this->db->where('id', $messageID);
        $this->db->update('message', $data);
        $return = array('msg' => translate('information_has_been_updated_successfully'), 'status' => true);
        echo json_encode($return);
    }

    /* mailbox trash observe */
    public function trash_observe()
    {
        $activeUser = loggedin_role_id() . '-' . get_loggedin_user_id();
        $arrayID = $this->input->post('array_id');
        $mode = $this->input->post('mode');
        if ($mode == 'restore') {
            $status = 0;
        } elseif ($mode == 'delete') {
            $status = 1;
        } elseif ($mode == 'forever') {
            $status = 2;
        }
        if (count($arrayID)) {
            $array = array();
            foreach ($arrayID as $id) {
                $get_user = $this->db->select('sender,reciever')->where(array('id' => $id))->get('message')->row();
                if ($get_user->sender == $activeUser) {
                    $array['trash_sent'] = $status;
                } elseif ($get_user->reciever == $activeUser) {
                    $array['trash_inbox'] = $status;
                }
                $this->db->where('id', $id);
                $this->db->update('message', $array);
            }
            if ($option == 'restore') {
                set_alert('success', translate('message_has_been_restored'));
            } elseif ($option == 'delete') {
                set_alert('success', translate('message_has_been_deleted'));
            }
        } else {
            set_alert('error', 'Please Select a Message to Delete');
        }
    }

    public function getStafflistRole()
    {
        $html = "";
        $branch_id = $this->application_model->get_branch_id();
        if (!empty($branch_id)) {
            $role_id = $this->input->post('role_id');
            $selected_id = (isset($_POST['staff_id']) ? $_POST['staff_id'] : 0);
            $this->db->select('staff.id,staff.name,staff.staff_id,lc.role');
            $this->db->from('staff');
            $this->db->join('login_credential as lc', 'lc.user_id = staff.id AND lc.role != 6 AND lc.role != 7', 'inner');
            $this->db->where('lc.role', $role_id);
            $this->db->where('staff.branch_id', $branch_id);
            $this->db->order_by('staff.id', 'asc');
            $result = $this->db->get()->result_array();
            if (count($result)) {
                $html .= "<option value=''>" . translate('select') . "</option>";
                foreach ($result as $staff) {
                    if ($staff['id'] == get_loggedin_user_id()) {
                        continue;
                    }
                    $selected = ($staff['id'] == $selected_id ? 'selected' : '');
                    $html .= "<option value='" . $staff['id'] . "' " . $selected . ">" . $staff['name'] . " (" . $staff['staff_id'] . ")</option>";
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_branch_first') . '</option>';
        }
        echo $html;
    }

    public function getStudentByClass()
    {
        $html = "";
        $class_id = $this->input->post('class_id');
        $branch_id = $this->application_model->get_branch_id();
        if (!empty($class_id)) {
            $this->db->select('e.student_id,e.roll,CONCAT(s.first_name, " ", s.last_name) as fullname');
            $this->db->from('enroll as e');
            $this->db->join('student as s', 's.id = e.student_id', 'inner');
            $this->db->join('login_credential as l', 'l.user_id = e.student_id and l.role = 7', 'left');
            $this->db->where('l.active', 1);
            $this->db->where('e.session_id', get_session_id());
            $this->db->where('e.class_id', $class_id);
            $this->db->where('e.branch_id', $branch_id);
            $result = $this->db->get()->result_array();
            if (count($result)) {
                $html .= "<option value=''>" . translate('select') . "</option>";
                foreach ($result as $row) {
                    if ($row['student_id'] == get_loggedin_user_id()) {
                        continue;
                    }
                    $html .= '<option value="' . $row['student_id'] . '">' . $row['fullname'] . ' ( Roll : ' . $row['roll'] . ')</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_class_first') . '</option>';
        }
        echo $html;
    }

    public function getParentListBranch()
    {
        $html = "";
        $branch_id = $this->application_model->get_branch_id();
        if (!empty($branch_id)) {
            $role_id = $this->input->post('role_id');
            $selected_id = (isset($_POST['parent_id']) ? $_POST['parent_id'] : 0);
            $this->db->select('parent.id,parent.name');
            $this->db->from('parent');
            $this->db->where('parent.branch_id', $branch_id);
            $this->db->order_by('parent.id', 'asc');
            $result = $this->db->get()->result_array();
            if (count($result)) {
                $html .= "<option value=''>" . translate('select') . "</option>";
                foreach ($result as $staff) {
                    if ($staff['id'] == get_loggedin_user_id()) {
                        continue;
                    }
                    $selected = ($staff['id'] == $selected_id ? 'selected' : '');
                    $html .= "<option value='" . $staff['id'] . "' " . $selected . ">" . $staff['name'] . "</option>";
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_branch_first') . '</option>';
        }
        echo $html;
    }
}
