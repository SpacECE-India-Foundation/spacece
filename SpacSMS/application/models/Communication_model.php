<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Communication_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // mailbox compose
    public function mailbox_compose($data)
    {
        $id = '';
        $branchID = $this->application_model->get_branch_id();
        $sender = loggedin_role_id() . '-' . get_loggedin_user_id();
        $reciever = $data['role_id'] . '-' . $data['receiver_id'];
        $arrayMsg = array(
            'body' => $data['message_body'],
            'subject' => $data['subject'],
            'sender' => $sender,
            'reciever' => $reciever,
        );
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
        $this->db->insert('message', $arrayMsg);
        $id = $this->db->insert_id();

        // send new message received email
        $this->db->where(array('branch_id' => $branchID, 'template_id' => 4));
        $getTemplate = $this->db->get('email_templates_details')->row_array();
        if ($getTemplate['notified'] == 1) {
            $message = $getTemplate['template_body'];
            $message = str_replace("{institute_name}", get_global_setting('institute_name'), $message);
            $message = str_replace("{recipient}", $this->application_model->get_name_mode_by_id($data['role'], $data['receiver_id']), $message);
            $message = str_replace("{message}", $data['message_body'], $message);
            $message = str_replace("{message_url}", base_url('communication/mailbox/read?type=inbox&id=' . $id), $message);
            $msg_data['recipient'] = get_type_name_by_id($data['role'], $data['receiver_id'], 'email');
            $msg_data['subject'] = $getTemplate['subject'];
            $msg_data['message'] = $message;
            $this->load->model("email_model");
            $this->email_model->send_mail($msg_data);
        }
        return $id;
    }

    public function mark_messages_read($message_id)
    {
        $activeUser = loggedin_role_id() . '-' . get_loggedin_user_id();
        $this->db->where('reciever', $activeUser);
        $this->db->where('id', $message_id);
        $this->db->update('message', array('read_status' => 1));

        $this->db->where('sender', $activeUser);
        $this->db->where('id', $message_id);
        $this->db->update('message', array('reply_status' => 0));
    }
}
