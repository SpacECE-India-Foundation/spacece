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

class Sendsmsmail extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sendsmsmail_model');
    }

    public function sms()
    {
        if (!get_permission('sendsmsmail', 'is_add')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/bootstrap-timepicker/css/bootstrap-timepicker.css',
            ),
            'js' => array(
                'vendor/bootstrap-timepicker/bootstrap-timepicker.js',
            ),
        );
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('bulk_sms_and_email');
        $this->data['sub_page'] = 'sendsmsmail/sms';
        $this->data['main_menu'] = 'sendsmsmail';
        $this->load->view('layout/index', $this->data);
    }

    public function email()
    {
        if (!get_permission('sendsmsmail', 'is_add')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/summernote/summernote.css',
                'vendor/bootstrap-timepicker/css/bootstrap-timepicker.css',
            ),
            'js' => array(
                'vendor/bootstrap-timepicker/bootstrap-timepicker.js',
                'vendor/summernote/summernote.js',
            ),
        );
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('bulk_sms_and_email');
        $this->data['sub_page'] = 'sendsmsmail/email';
        $this->data['main_menu'] = 'sendsmsmail';
        $this->load->view('layout/index', $this->data);
    }

    public function delete($id)
    {
        if (get_permission('sendsmsmail', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('bulk_sms_email');
        }
    }

    public function campaign_reports()
    {
        if (!get_permission('sendsmsmail_reports', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $sendType = $this->input->post('send_type');
            $campaignType = $this->input->post('campaign_type');
            $daterange = explode(' - ', $this->input->post('daterange'));
            $start = date("Y-m-d", strtotime($daterange[0]));
            $end = date("Y-m-d", strtotime($daterange[1]));
            $this->db->where('DATE(created_at) >=', $start);
            $this->db->where('DATE(created_at) <=', $end);
            $this->db->where('message_type', $campaignType);
            $this->db->where('branch_id', $branchID);
            if ($sendType != 'both')
                $this->db->where('posting_status', $sendType);
            $this->data['campaignlist'] = $this->db->get('bulk_sms_email')->result_array();
            $this->data['startdate'] = $start;
            $this->data['enddate'] = $end;
        }

        $this->data['headerelements']   = array(
            'css' => array(
                'vendor/daterangepicker/daterangepicker.css',
            ),
            'js' => array(
                'vendor/moment/moment.js',
                'vendor/daterangepicker/daterangepicker.js',
            ),
        );
        $this->data['title'] = translate('bulk_sms_and_email');
        $this->data['sub_page'] = 'sendsmsmail/campaign_reports';
        $this->data['main_menu'] = 'sendsmsmail';
        $this->load->view('layout/index', $this->data);
    }

    function save() 
    {
        if (!get_permission('sendsmsmail', 'is_add')) {
            ajax_access_denied();
        }

        if ($_POST) {
            $messageType = ($this->input->post('message_type') == 'sms' ? 1 : 2);
            $branchID = $this->application_model->get_branch_id();
            $recipientType = $this->input->post('recipient_type');
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('campaign_name', translate('campaign_name'), 'trim|required');
            $this->form_validation->set_rules('message', translate('message'), 'trim|required');
            if ($messageType == 1) {
                $this->form_validation->set_rules('sms_gateway', translate('sms_gateway'), 'trim|required');
            } else {
                $this->form_validation->set_rules('email_subject', translate('email_subject'), 'trim|required');
            }
            $this->form_validation->set_rules('recipient_type', translate('type'), 'trim|required');
            if ($recipientType == 1) {
                $this->form_validation->set_rules('role_group[]', translate('role'), 'trim|required');
            }

            if ($recipientType == 2) {
                $this->form_validation->set_rules('role_id', translate('role'), 'trim|required');
                $this->form_validation->set_rules('recipients[]', translate('name'), 'trim|required');
            }
            if ($recipientType == 3) {
                $this->form_validation->set_rules('class_id', translate('class'), 'trim|required');
                $this->form_validation->set_rules('section[]', translate('section'), 'trim|required');
            }
            if (isset($_POST['send_later'])) {
                $this->form_validation->set_rules('schedule_date', translate('schedule_date'), 'trim|required');
                $this->form_validation->set_rules('schedule_time', translate('schedule_time'), 'trim|required');
            }

            if ($this->form_validation->run() !== false) {
                $user_array = array();
                $receivedDetails = array();
                $campaignName = $this->input->post('campaign_name');
                $message = $this->input->post('message');
                $scheduleDate = $this->input->post('schedule_date');
                $scheduleTime = $this->input->post('schedule_time');
                $sendLater = (isset($_POST['send_later']) ? 1 : 2);
                $emailSubject = $this->input->post('email_subject');
                $smsGateway = $this->input->post('sms_gateway');
                
                if ($recipientType == 1) {
                    $roleGroup = $this->input->post('role_group[]');
                    $receivedDetails['role'] = $roleGroup;
                    foreach ($roleGroup as $key => $users_value) {
                        if ($users_value != 6 && $users_value != 7) {
                            $staff = $this->sendsmsmail_model->getStaff($branchID, $users_value);
                            if (count($staff)) {
                                foreach ($staff as $key => $value) {
                                    $user_array[] = array(
                                        'name' => $value['name'],
                                        'email' => $value['email'],
                                        'mobileno' => $value['mobileno'],
                                    );
                                }
                            }
                        }
                        if ($users_value == 6) {
                            $parents = $this->sendsmsmail_model->getParent($branchID);
                            if (count($parents)) {
                                foreach ($parents as $key => $value) {
                                    $user_array[] = array(
                                        'name' => $value['name'],
                                        'email' => $value['email'],
                                        'mobileno' => $value['mobileno'],
                                    );
                                }
                            }
                        }
                        if ($users_value == 7) {
                            $students = $this->sendsmsmail_model->getStudent($branchID);
                            if (count($students)) {
                                foreach ($students as $key => $value) {
                                    $user_array[] = array(
                                        'name' => $value['name'],
                                        'email' => $value['email'],
                                        'mobileno' => $value['mobileno'],
                                    );
                                }
                            }
                        }
                    }
                }

                if ($recipientType == 2) {
                    $roleID = $this->input->post('role_id');
                    $recipients = $this->input->post('recipients[]');
                    foreach ($recipients as $key => $value) {
                        if ($roleID != 6 && $roleID != 7) {
                            $staff = $this->sendsmsmail_model->getStaff($branchID, '', $value);
                            if (!empty($staff)) {
                                $user_array[] = array(
                                    'name' => $staff['name'],
                                    'email' => $staff['email'],
                                    'mobileno' => $staff['mobileno'],
                                );
                            }
                        }

                        if ($roleID == 6) {
                            $parent = $this->sendsmsmail_model->getParent($branchID, $value);
                            if (!empty($parent)) {
                                $user_array[] = array(
                                    'name' => $parent['name'],
                                    'email' => $parent['email'],
                                    'mobileno' => $parent['mobileno'],
                                );
                            }
                        }

                        if ($roleID == 7) {
                            $student = $this->sendsmsmail_model->getStudent($branchID, $value);
                            if (!empty($student)) {
                                $user_array[] = array(
                                    'name' => $student['name'],
                                    'email' => $student['email'],
                                    'mobileno' => $student['mobileno'],
                                );
                            }
                        }
                    }
                }

                if ($recipientType == 3) {
                    $classID = $this->input->post('class_id');
                    $sections = $this->input->post('section[]');
                    $receivedDetails['class'] = $classID;
                    $receivedDetails['sections'] = $sections;
                    foreach ($sections as $key => $value) {
                        $students = $this->sendsmsmail_model->getStudentBySection($classID, $value, $branchID);
                        if (count($students)) {
                            foreach ($students as $key => $value) {
                                $user_array[] = array(
                                    'name' => $value['name'],
                                    'email' => $value['email'],
                                    'mobileno' => $value['mobileno'],
                                );
                            }
                        }
                    }
                }

                $sCount = 0;
                if ($sendLater == 1) {
                    $additional = json_encode($user_array);
                } else {
                    foreach ($user_array as $key => $value) {
                        if ($messageType == 1) {
                            $response = $this->sendsmsmail_model->sendSMS($value['mobileno'], $message, $value['name'], $value['email'], $smsGateway);
                        } else {
                            $response = $this->sendsmsmail_model->sendEmail($value['email'], $message, $value['name'], $value['mobileno'], $emailSubject);
                        }
                        if ($response == true) {
                            $sCount++;
                        }
                    }
                    $additional = '';
                }
                $receivedDetails = (empty($receivedDetails) ? '' : json_encode($receivedDetails));
                $arrayData = array(
                    'campaign_name'         => $campaignName,
                    'message'               => $message,
                    'message_type'          => $messageType,
                    'recipient_type'        => $recipientType,
                    'recipients_details'    => $receivedDetails,
                    'additional'            => $additional,
                    'schedule_time'         => date('Y-m-d H:i:s', strtotime($scheduleDate . ' ' . $scheduleTime)),
                    'posting_status'        => $sendLater,
                    'total_thread'          => count($user_array),
                    'successfully_sent'     => $sCount,
                    'branch_id'             => $branchID,
                );
                if ($messageType == 1) {
                    $arrayData['sms_gateway'] = $smsGateway;
                } else {
                    $arrayData['email_subject'] = $emailSubject;
                }
                $this->db->insert('bulk_sms_email', $arrayData);
                set_alert('success', translate('message_sent_successfully'));
                if ($messageType == 1) {
                    $url = base_url('sendsmsmail/sms');
                } else {
                    $url = base_url('sendsmsmail/email');
                }
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    // add send sms mail template
    public function template()
    {
        $type = html_escape($this->uri->segment(3));
        $typeA = array('email', 'sms');
        $result = in_array($type, $typeA);
        $type_n = ($type == 'sms' ? 1 : 2);
        if (!get_permission('sendsmsmail_template', 'is_view') || !$result) {
            access_denied();
        }
        if ($_POST) {
            if (get_permission('sendsmsmail_template', 'is_add')) {
                // validate inputs
                if (is_superadmin_loggedin()) {
                    $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
                }
                $this->form_validation->set_rules('template_name', translate('name'), 'required');
                $this->form_validation->set_rules('message', translate('message'), 'required');
                if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                    $post['type'] = $type_n;
                    $this->sendsmsmail_model->saveTemplate($post);
                    $url = current_url();
                    $array = array('status' => 'success', 'url' => $url, 'error' => '');
                    set_alert('success', translate('information_has_been_saved_successfully'));
                } else {
                    $error = $this->form_validation->error_array();
                    $array = array('status' => 'fail', 'url' => '', 'error' => $error);
                }
                echo json_encode($array);
                exit();
            }
        }
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/summernote/summernote.css',
            ),
            'js' => array(
                'vendor/summernote/summernote.js',
            ),
        );
        $this->data['type'] = $type;
        $this->data['templetelist'] = $this->app_lib->getTable('bulk_msg_category', array('type' => $type_n));
        $this->data['title'] = translate('bulk_sms_and_email');
        $this->data['sub_page'] = 'sendsmsmail/template_' . $type;
        $this->data['main_menu'] = 'sendsmsmail';
        $this->load->view('layout/index', $this->data);
    }

    // edit send sms mail template
    public function template_edit($type = '', $id)
    {
        $typeA = array('email', 'sms');
        $result = in_array($type, $typeA);
        $type_n = ($type == 'sms' ? 1 : 2);

        if (!get_permission('sendsmsmail_template', 'is_edit') || !$result) {
            access_denied();
        }

        if ($_POST) {
            // validate inputs
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('template_name', translate('name'), 'required');
            $this->form_validation->set_rules('message', translate('message'), 'required');
            if ($this->form_validation->run() == true) {
                $post = $this->input->post();
                $post['type'] = $type_n;
                $this->sendsmsmail_model->saveTemplate($post);
                $url = base_url('sendsmsmail/template/' . $type);
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
                set_alert('success', translate('information_has_been_updated_successfully'));
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/summernote/summernote.css',
            ),
            'js' => array(
                'vendor/summernote/summernote.js',
            ),
        );
        $this->data['type'] = $type;
        $this->data['templete'] = $this->app_lib->getTable('bulk_msg_category', array('t.id' => $id, 't.type' => $type_n), true);
        $this->data['title'] = translate('bulk_sms_and_email');
        $this->data['sub_page'] = 'sendsmsmail/template_edit_' . $type;
        $this->data['main_menu'] = 'sendsmsmail';
        $this->load->view('layout/index', $this->data);
    }

    public function template_delete($id)
    {
        if (!get_permission('sendsmsmail_template', 'is_delete')) {
            access_denied();
        }
        $this->db->where('id', $id);
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->delete('bulk_msg_category');
    }

    public function getRecipientsByRole()
    {
        $html = "";
        $branchID = $this->application_model->get_branch_id();
        $roleID = $this->input->post('role_id');
        if (!empty($branchID)) {
            if ($roleID != 6 && $roleID != 7) {
                $this->db->select('staff.id,staff.name,staff.staff_id,lc.role');
                $this->db->from('staff');
                $this->db->join('login_credential as lc', 'lc.user_id = staff.id AND lc.role != 6 AND lc.role != 7', 'inner');
                $this->db->where('lc.role', $roleID);
                $this->db->where('staff.branch_id', $branchID);
                $this->db->order_by('staff.id', 'asc');
                $result = $this->db->get()->result_array();
                foreach ($result as $staff) {
                    $html .= "<option value='" . $staff['id'] . "'>" . $staff['name'] . " (" . $staff['staff_id'] . ")</option>";
                }
            }
            if ($roleID == 6) {
                $this->db->where('branch_id', $branchID);
                $result = $this->db->get('parent')->result_array();
                foreach ($result as $row) {
                    $html .= "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                }
            }
            if ($roleID == 7) {
                $this->db->select('e.student_id,e.roll,CONCAT(s.first_name, " ", s.last_name) as name');
                $this->db->from('enroll as e');
                $this->db->join('student as s', 's.id = e.student_id', 'inner');
                $this->db->where('e.branch_id', $branchID);
                $this->db->where('e.session_id', get_session_id());
                $students = $this->db->get()->result_array();
                foreach ($students as $row) {
                    $html .= "<option value='" . $row['student_id'] . "'>" . $row['name'] . " (Roll" . $row['roll'] . ")</option>";
                }
            }
        }
        echo $html;
    }

    public function getSectionByClass()
    {
        $html = "";
        $classID = $this->input->post("class_id");
        if (!empty($classID)) {
            $result = $this->db->select('sections_allocation.section_id,section.name')
                ->from('sections_allocation')
                ->join('section', 'section.id = sections_allocation.section_id', 'left')
                ->where('sections_allocation.class_id', $classID)
                ->get()->result_array();
            if (count($result)) {
                foreach ($result as $row) {
                    $html .= '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
                }
            }
        }
        echo $html;
    }

    public function getSmsGateway()
    {
        $html = "";
        $branchID = $this->application_model->get_branch_id();
        if (!empty($branchID)) {
            $this->db->select('sms_api.name');
            $this->db->from('sms_api');
            $this->db->join('sms_credential', 'sms_credential.sms_api_id = sms_api.id', 'inner');
            $this->db->where('sms_credential.branch_id', $branchID);
            $this->db->where('sms_credential.is_active', 1);
            $this->db->order_by('sms_api.id', 'asc');
            $result = $this->db->get()->result_array();
            if (count($result)) {
                $html .= '<option value="">' . translate('select') . '</option>';
                foreach ($result as $row) {
                    $html .= '<option value="' . $row['name'] . '">' . ucfirst($row['name']) . '</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_sms_gateway_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_branch_first') . '</option>';
        }
        echo $html;
    }

    public function getTemplateByBranch()
    {
        $html = "";
        $type = $this->input->post('type');
        $type = ($type == 'sms' ? 1 : 2);
        $branch_id = $this->application_model->get_branch_id();
        if (!empty($branch_id)) {
            $result = $this->db->select('id,name')->where(array('branch_id' => $branch_id, 'type' => $type))->get('bulk_msg_category')->result_array();
            if (count($result)) {
                $html .= "<option value=''>" . translate('select') . "</option>";
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

    public function getSmsTemplateText()
    {
        $id = $this->input->post('id');
        $row = $this->db->where(array('id' => $id))->get('bulk_msg_category')->row_array();
        echo $row['body'];
    }

    public function getDetails()
    {
        if (get_permission('sendsmsmail', 'is_view')) {
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->data['bulkdata'] = $this->db->get('bulk_sms_email')->row_array();
            $this->load->view('sendsmsmail/messageModal', $this->data);
        }
    }
}
