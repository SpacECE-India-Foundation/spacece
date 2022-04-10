<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom school management system
 * @version : 2.0
 * @developed by : RamomCoder
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/RamomCoder
 * @filename : live_class.php
 * @copyright : Reserved RamomCoders Team
 */

class Live_class extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('live_class_model');
        $this->load->model('sms_model');
    }

    /* live class form validation rules */
    protected function award_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('title', translate('title'), 'trim|required');
        $this->form_validation->set_rules('zoom_meeting_id', translate('zoom_meeting_id'), 'trim|required');
        $this->form_validation->set_rules('zoom_meeting_password', translate('zoom_meeting_password'), 'trim|required');
        $this->form_validation->set_rules('class_id', translate('class'), 'trim|required');
        $this->form_validation->set_rules('section[]', translate('section'), 'trim|required');
        $this->form_validation->set_rules('date', translate('date'), 'trim|required');
        $this->form_validation->set_rules('time_start', translate('time_start'), 'trim|required');
        $this->form_validation->set_rules('time_end', translate('time_end'), 'trim|required');
    }

    public function index()
    {
        if (!get_permission('live_class', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            if (get_permission('live_class', 'is_add')) {
                $roleID = $this->input->post('role_id');
                $this->award_validation();
                if ($this->form_validation->run() !== false) {
					// SAVE ALL ROUTE INFORMATION IN THE DATABASE FILE
                    $post = $this->input->post();
                    $this->live_class_model->save($post);
                    $branchID = $this->application_model->get_branch_id();

                    //send live class sms notification
                    if (isset($post['send_notification_sms'])) {
                        foreach ($post['section'] as $key => $value) {
                            $stuList = $this->application_model->getStudentListByClassSection($post['class_id'], $value, $branchID);
                            foreach ($stuList as $row) {
                                $row['date_of_live_class'] = $post['date'];
                                $row['start_time'] = date("h:i A", strtotime($post['time_start']));
                                $row['end_time'] = date("h:i A", strtotime($post['time_end']));
                                $row['host_by'] = $this->session->userdata('name');
                                $this->sms_model->sendLiveClass($row);
                            }
                        }
                    }
                    set_alert('success', translate('information_has_been_saved_successfully'));
                    $array  = array('status' => 'success');
                } else {
                    $error = $this->form_validation->error_array();
                    $array = array('status' => 'fail', 'error' => $error);
                }
                echo json_encode($array);
                exit();
            }
        }
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/bootstrap-timepicker/css/bootstrap-timepicker.css',
            ),
            'js' => array(
                'vendor/bootstrap-timepicker/bootstrap-timepicker.js',
            ),
        );
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['liveClass'] = $this->live_class_model->getList();
        $this->data['title'] = translate('live_class_rooms');
        $this->data['sub_page'] = 'live_class/index';
        $this->data['main_menu'] = 'live_class';
        $this->load->view('layout/index', $this->data);
    }

    public function edit($id = '')
    {
        if (!get_permission('live_class', 'is_edit')) {
            access_denied();
        }
        if ($_POST) {
            $this->award_validation();
            if ($this->form_validation->run() !== false) {
                // SAVE ALL ROUTE INFORMATION IN THE DATABASE FILE
				$this->live_class_model->save($this->input->post());
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url    = base_url('live_class');
                $array  = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['live'] = $this->app_lib->getTable('live_class', array('t.id' => $id), true);
        $this->data['title'] = translate('live_class');
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/bootstrap-timepicker/css/bootstrap-timepicker.css',
            ),
            'js' => array(
                'vendor/bootstrap-timepicker/bootstrap-timepicker.js',
            ),
        );
        $this->data['sub_page'] = 'live_class/edit';
        $this->data['main_menu'] = 'live_class_rooms';
        $this->load->view('layout/index', $this->data);
    }

    public function delete($id = '')
    {
        if (get_permission('live_class', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('live_class');
        }
    }

    public function hostModal()
    {
        if (get_permission('live_class', 'is_add')) {
            $this->data['meetingID'] = $this->input->post('meeting_id');
            echo $this->load->view('live_class/hostModal', $this->data, true);
        }
    }

    public function host()
    {
        if (!get_permission('live_class', 'is_add')) {
            access_denied();
        }
        $this->load->view('live_class/host', $this->data);
    }
}
