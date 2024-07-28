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

class Timetable extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('timetable_model');
    }

    public function index()
    {
        if (get_loggedin_id()) {
            redirect(base_url('timetable/view_classwise'));
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    /*class timetable view page*/
    public function viewclass()
    {
        if (!get_permission('class_timetable', 'is_view')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $classID = $this->input->post('class_id');
            $sectionID = $this->input->post('section_id');
            $arrayTimetable = array(
                'branch_id' => $branchID,
                'class_id' => $classID,
                'section_id' => $sectionID,
                'session_id' => get_session_id(),
            );
            $this->db->order_by('time_start', 'asc');
            $this->data['timetables'] = $this->db->get_where('timetable_class', $arrayTimetable)->result();
            $this->data['class_id'] = $classID;
            $this->data['section_id'] = $sectionID;
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('class') . " " . translate('schedule');
        $this->data['sub_page'] = 'timetable/viewclass';
        $this->data['main_menu'] = 'timetable';
        $this->load->view('layout/index', $this->data);
    }

    /* class timetable information are prepared and stored in the database here */
    public function set_classwise()
    {
        if (!get_permission('class_timetable', 'is_add')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $this->data['class_id'] = $this->input->post('class_id');
            $this->data['day'] = $this->input->post('day');
            $this->data['section_id'] = $this->input->post('section_id');
            $this->data['branch_id'] = $branchID;
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('add') . " " . translate('schedule');
        $this->data['sub_page'] = 'timetable/set_classwise';
        $this->data['main_menu'] = 'timetable';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/bootstrap-timepicker/css/bootstrap-timepicker.css',
            ),
            'js' => array(
                'vendor/bootstrap-timepicker/bootstrap-timepicker.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    /* class timetable updating here */
    public function update_classwise()
    {

        if (!get_permission('class_timetable', 'is_edit')) {
            access_denied();
        }

        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['class_id'] = $this->input->post('class_id');
        $this->data['section_id'] = $this->input->post('section_id');
        $this->data['day'] = $this->input->post('day');
        $timetable_array = array(
            'branch_id' => $this->data['branch_id'],
            'class_id' => $this->data['class_id'],
            'section_id' => $this->data['section_id'],
            'day' => $this->data['day'],
            'session_id' => get_session_id(),
        );
        $this->db->order_by('time_start', 'asc');
        $this->data['timetables'] = $this->db->get_where('timetable_class', $timetable_array)->result();
        $this->data['title'] = translate('class') . " " . translate('schedule');
        $this->data['sub_page'] = 'timetable/update_classwise';
        $this->data['main_menu'] = 'timetable';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/bootstrap-timepicker/css/bootstrap-timepicker.css',
            ),
            'js' => array(
                'vendor/bootstrap-timepicker/bootstrap-timepicker.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    public function class_save($mode = '')
    {
        if ($_POST) {
            if (!get_permission('class_timetable', 'is_add')) {
                ajax_access_denied();
            }

            $items = $this->input->post('timetable');
            foreach ($items as $key => $value) {
                $this->form_validation->set_rules('timetable[' . $key . '][time_start]', translate('starting_time'), 'required');
                $this->form_validation->set_rules('timetable[' . $key . '][time_end]', translate('ending_time'), 'required');
                if (!isset($value['break'])) {
                    $this->form_validation->set_rules('timetable[' . $key . '][subject]', translate('subject'), 'trim|required');
                    $this->form_validation->set_rules('timetable[' . $key . '][teacher]', translate('teacher'), 'trim|required');
                }
            }
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $this->timetable_model->classwise_save($post, $mode);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('timetable/set_classwise');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    // exam timetable preview page
    public function viewexam()
    {
        if (!get_permission('exam_timetable', 'is_view')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $classID = $this->input->post('class_id');
            $sectionID = $this->input->post('section_id');
            $this->data['examlist'] = $this->timetable_model->getExamTimetableList($classID, $sectionID, $branchID);
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('exam') . " " . translate('schedule');
        $this->data['sub_page'] = 'timetable/viewexam';
        $this->data['main_menu'] = 'exam_timetable';
        $this->load->view('layout/index', $this->data);
    }

    // exam timetable information are prepared and stored in the database here
    public function set_examwise()
    {
        if (!get_permission('exam_timetable', 'is_add')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $examID = $this->input->post('exam_id');
            $classID = $this->input->post('class_id');
            $sectionID = $this->input->post('section_id');
            $this->data['exam_id'] = $examID;
            $this->data['class_id'] = $classID;
            $this->data['section_id'] = $sectionID;
            $this->data['subjectassign'] = $this->timetable_model->getSubjectExam($classID, $sectionID, $examID, $branchID);
        }
        $this->data['branch_id'] = $branchID;
        $this->data['title'] = translate('add') . " " . translate('schedule');
        $this->data['sub_page'] = 'timetable/set_examwise';
        $this->data['main_menu'] = 'exam_timetable';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/bootstrap-timepicker/css/bootstrap-timepicker.css',
            ),
            'js' => array(
                'vendor/bootstrap-timepicker/bootstrap-timepicker.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    public function exam_create()
    {
        if (!get_permission('exam_timetable', 'is_add')) {
            ajax_access_denied();
        }
        if ($_POST) {
			// form validation rules
            $items = $this->input->post('timetable');
            foreach ($items as $key => $value) {
                $this->form_validation->set_rules('timetable[' . $key . '][date]', translate('date'), 'required');
                $this->form_validation->set_rules('timetable[' . $key . '][time_start]', translate('starting_time'), 'required');
                $this->form_validation->set_rules('timetable[' . $key . '][time_end]', translate('ending_time'), 'required');
                $this->form_validation->set_rules('timetable[' . $key . '][hall_id]', translate('hall_room'), 'required|callback_check_hallseat_capacity');
                foreach ($value['full_mark'] as $i => $id) {
                    $this->form_validation->set_rules('timetable[' . $key . '][full_mark][' . $i . ']', translate('full_mark'), 'required|numeric');
                    $this->form_validation->set_rules('timetable[' . $key . '][pass_mark][' . $i . ']', translate('pass_mark'), 'required|numeric');
                }
            }
            if ($this->form_validation->run() !== false) {
                $branchID = $this->application_model->get_branch_id();
                $examID = $this->input->post('exam_id');
                $classID = $this->input->post('class_id');
                $sectionID = $this->input->post('section_id');
                $timetable = $this->input->post('timetable');
                foreach ($timetable as $key => $value) {
					// distribution array
                    $distribution = array();
                    foreach ($value['full_mark'] as $id => $mark) {
                       $distribution[$id]['full_mark'] = $mark;

                    }
                    foreach ($value['pass_mark'] as $id => $mark) {
                       $distribution[$id]['pass_mark'] = $mark;

                    }
                    $arrayData = array(
                        'exam_id' => $examID,
                        'class_id' => $classID,
                        'section_id' => $sectionID,
                        'subject_id' => $value['subject_id'],
                        'time_start' => $value['time_start'],
                        'time_end' => $value['time_end'],
                        'hall_id' => $value['hall_id'],
                        'exam_date' => $value['date'],
                        'mark_distribution' => json_encode($distribution),
                        'branch_id' => $branchID,
                        'session_id' => get_session_id(),
                    );
                    $this->db->where('exam_id', $examID);
                    $this->db->where('class_id', $classID);
                    $this->db->where('section_id', $sectionID);
                    $this->db->where('subject_id', $value['subject_id']);
                    $this->db->where('session_id', get_session_id());
                    $q = $this->db->get('timetable_exam');
                    if ($q->num_rows() > 0) {
                        $result = $q->row_array();
                        $this->db->where('id', $result['id']);
                        $this->db->update('timetable_exam', $arrayData);
                    } else {
                        $this->db->insert('timetable_exam', $arrayData);
                    }
                }
                $message = translate('information_has_been_saved_successfully');
                $array = array('status' => 'success', 'message' => $message);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function exam_delete($examID, $classID, $sectionID)
    {
        if (get_permission('exam_timetable', 'is_delete')) {
            $this->db->where('exam_id', $examID);
            $this->db->where('class_id', $classID);
            $this->db->where('section_id', $sectionID);
            $this->db->where('session_id', get_session_id());
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->delete('timetable_exam');
        }
    }

    public function getExamTimetableM()
    {
        $examID = $this->input->post('exam_id');
        $classID = $this->input->post('class_id');
        $sectionID = $this->input->post('section_id');
        $this->data['exam_id'] = $examID;
        $this->data['class_id'] = $classID;
        $this->data['section_id'] = $sectionID;
        $this->data['timetables'] = $this->timetable_model->getExamTimetableByModal($examID, $classID, $sectionID);
        $this->load->view('timetable/examTimetableM', $this->data);
    }

    // check exam hall room capacity
    public function check_hallseat_capacity($hallid)
    {
        if ($hallid) {
            $classID = $this->input->post('class_id');
            $sectionID = $this->input->post('section_id');
            $seats = $this->db->get_where('exam_hall', array('id' => $hallid))->row()->seats;
            $stuCount = $this->db->get_where('enroll', array(
                'class_id' => $classID,
                'section_id' => $sectionID,
                'session_id' => get_session_id(),
            ))->num_rows();
            if ($stuCount > $seats) {
                $this->form_validation->set_message("check_hallseat_capacity", "The seats capacity is exceeded.");
                return false;
            } else {
                return true;
            }
        }
    }
}
