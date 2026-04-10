<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sendsmsmail_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getStaff($branch_id, $role_id = '', $staff_id = '')
    {
        $this->db->select('staff.id,staff.name,staff.mobileno,staff.email');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != "6" and login_credential.role != "7"', 'inner');
        $this->db->where('staff.branch_id', $branch_id);
        if (!empty($role_id)) {
            $method = 'result_array';
            $this->db->where('login_credential.role', $role_id);
            $this->db->order_by('staff.id', 'ASC');
        }
        if (!empty($staff_id)) {
            $this->db->where('staff.id', $staff_id);
            $method = 'row_array';
        }
        return $this->db->get()->$method();
    }

    public function getParent($branch_id, $parent_id = '')
    {
        $this->db->select('id,name,email,mobileno');
        $this->db->where('branch_id', $branch_id);
        if (empty($parent_id)) {
            $method = 'result_array';
        } else {
            $this->db->where('id', $parent_id);
            $method = 'row_array';
        }
        return $this->db->get('parent')->$method();
    }

    public function getStudent($branch_id, $student_id = '')
    {
        $this->db->select('e.student_id,CONCAT(s.first_name, " ", s.last_name) as name,s.mobileno,s.email');
        $this->db->from('enroll as e');
        $this->db->join('student as s', 'e.student_id = s.id', 'inner');
        $this->db->where('e.branch_id', $branch_id);
        if (empty($student_id)) {
            $method = 'result_array';
            $this->db->where('e.session_id', get_session_id());
            $this->db->order_by('s.id', 'ASC');
        } else {
            $this->db->where('s.id', $student_id);
            $method = 'row_array';
        }
        return $this->db->get()->$method();
    }

    public function getStudentBySection($class_id, $section_id, $branch_id)
    {
        $this->db->select('e.student_id,CONCAT(s.first_name, " ", s.last_name) as name,s.mobileno,s.email');
        $this->db->from('enroll as e');
        $this->db->join('student as s', 'e.student_id = s.id', 'inner');
        $this->db->where('e.class_id', $class_id);
        $this->db->where('e.section_id', $section_id);
        $this->db->where('e.branch_id', $branch_id);
        $this->db->where('e.session_id', get_session_id());
        $this->db->order_by('s.id', 'ASC');
        return $this->db->get()->result_array();
    }

    public function saveTemplate($data)
    {
        $insertData = array(
            'branch_id' => $this->application_model->get_branch_id(),
            'name' => $data['template_name'],
            'body' => $data['message'],
            'type' => $data['type'],
        );

        if (!isset($data['template_id'])) {
            $this->db->insert('bulk_msg_category', $insertData);
        } else {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $data['template_id']);
            $this->db->update('bulk_msg_category', $insertData);
        }
    }

    public function sendEmail($sendTo, $message, $name, $mobileNo, $emailSubject)
    {
        $message = str_replace('{name}', $name, $message);
        $message = str_replace('{email}', $sendTo, $message);
        $message = str_replace('{mobile_no}', $mobileNo, $message);

        $branchID = $this->application_model->get_branch_id();
        $getConfig = $this->db->get_where('email_config', array('id' => 1, 'branch_id' => $branchID))->row_array();
        if ($getConfig['email_protocol'] == 'smtp') {
            $config = array(
                'smtp_host' => $getConfig['smtp_host'],
                'smtp_port' => $getConfig['smtp_port'],
                'smtp_user' => $getConfig['smtp_user'],
                'smtp_pass' => $getConfig['smtp_pass'],
                'smtp_crypto' => $getConfig['smtp_encryption'],
            );
        }

        $config['protocol'] = $getConfig['email_protocol'];
        $config['useragent'] = "CodeIgniter";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = true;

        $this->load->library('email', $config);
        $this->email->from($getConfig['email'], get_global_setting('institute_name'));
        $this->email->to($sendTo);
        $this->email->subject($emailSubject);
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function sendSMS($sendTo, $message, $name, $eMail, $smsGateway)
    {

        $message = str_replace('{name}', $name, $message);
        $message = str_replace('{email}', $eMail, $message);
        $message = str_replace('{mobile_no}', $sendTo, $message);
        if ($smsGateway == 'twilio') {
            $this->load->library("twilio");
            $get = $this->twilio->get_twilio();
            $from = $get['number'];
            $response = $this->twilio->sms($from, $sendTo, $message);
            if ($response->IsError) {
                return false;
            } else {
                return true;
            }
        }
        if ($smsGateway == 'clickatell') {
            $this->load->library("clickatell");
            return $this->clickatell->send_message($sendTo, $message);
        }
        if ($smsGateway == 'msg91') {
            $this->load->library("msg91");
            return $this->msg91->send($sendTo, $message);
        }
        if ($smsGateway == 'bulksms') {
            $this->load->library("bulk");
            return $this->bulk->send($sendTo, $message);
        }
        if ($smsGateway == 'textlocal') {
            $this->load->library("textlocal");
            try {
                $this->textlocal->sendSms(array($sendTo), $message);
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
    }

}
