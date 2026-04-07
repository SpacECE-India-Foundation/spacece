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

class Exam extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('exam_model');
        $this->load->model('sms_model');
    }

    /* exam form validation rules */
    protected function exam_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('name', translate('name'), 'trim|required');
        $this->form_validation->set_rules('type_id', translate('exam_type'), 'trim|required');
        $this->form_validation->set_rules('mark_distribution[]', translate('mark_distribution'), 'trim|required');
    }

    public function index()
    {
        if (!get_permission('exam', 'is_view')) {
            access_denied();
        }

        if ($_POST) {
            if (!get_permission('exam', 'is_view')) {
                ajax_access_denied();
            }
            $this->exam_validation();

            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $this->exam_model->exam_save($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('exam');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }

        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['examlist'] = $this->exam_model->getExamList();
        $this->data['title'] = translate('exam_list');
        $this->data['sub_page'] = 'exam/index';
        $this->data['main_menu'] = 'exam';
        $this->load->view('layout/index', $this->data);
    }

    public function edit($id = '')
    {
        if (!get_permission('exam', 'is_edit')) {
            access_denied();
        }

        if ($_POST) {
            $this->exam_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $this->exam_model->exam_save($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('exam');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }

        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['exam'] = $this->app_lib->getTable('exam', array('t.id' => $id), true);
        $this->data['title'] = translate('exam_list');
        $this->data['sub_page'] = 'exam/edit';
        $this->data['main_menu'] = 'exam';
        $this->load->view('layout/index', $this->data);
    }

    // exam information delete stored in the database here
    public function delete($id)
    {
        if (!get_permission('exam', 'is_delete')) {
            access_denied();
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->delete('exam');
    }

    /* term form validation rules */
    protected function term_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('term_name', translate('name'), 'trim|required|callback_unique_term');
    }

    // exam term information are prepared and stored in the database here
    public function term()
    {
        if (isset($_POST['save'])) {
            if (!get_permission('exam_term', 'is_add')) {
                access_denied();
            }
            $this->term_validation();
            if ($this->form_validation->run() !== false) {
                //save exam term information in the database file
                $this->exam_model->termSave($this->input->post());
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(current_url());
            }
        }
        $this->data['termlist'] = $this->app_lib->getTable('exam_term');
        $this->data['sub_page'] = 'exam/term';
        $this->data['main_menu'] = 'exam';
        $this->data['title'] = translate('exam_term');
        $this->load->view('layout/index', $this->data);
    }

    public function term_edit()
    {
        if ($_POST) {
            if (!get_permission('exam_term', 'is_edit')) {
                ajax_access_denied();
            }
            $this->term_validation();
            if ($this->form_validation->run() !== false) {
                //save exam term information in the database file
                $this->exam_model->termSave($this->input->post());
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('exam/term');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function term_delete($id)
    {
        if (!get_permission('exam_term', 'is_delete')) {
            access_denied();
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->delete('exam_term');
    }

    /* unique valid exam term name verification is done here */
    public function unique_term($name)
    {
        $branchID = $this->application_model->get_branch_id();
        $term_id = $this->input->post('term_id');
        if (!empty($term_id)) {
            $this->db->where_not_in('id', $term_id);
        }
        $this->db->where(array('name' => $name, 'branch_id' => $branchID));
        $uniform_row = $this->db->get('exam_term')->num_rows();
        if ($uniform_row == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_term", translate('already_taken'));
            return false;
        }
    }

    public function mark_distribution()
    {
        if (isset($_POST['save'])) {
            if (!get_permission('mark_distribution', 'is_add')) {
                access_denied();
            }
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('name', translate('name'), 'trim|required');
            if ($this->form_validation->run() !== false) {
                // save mark distribution information in the database file
                $arrayDistribution = array(
                    'name' => $this->input->post('name'),
                    'branch_id' => $this->application_model->get_branch_id(),
                );
                $this->db->insert('exam_mark_distribution', $arrayDistribution);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(current_url());
            }
        }
        $this->data['termlist'] = $this->app_lib->getTable('exam_mark_distribution');
        $this->data['sub_page'] = 'exam/mark_distribution';
        $this->data['main_menu'] = 'exam';
        $this->data['title'] = translate('mark_distribution');
        $this->load->view('layout/index', $this->data);
    }

    public function mark_distribution_edit()
    {
        if ($_POST) {
            if (!get_permission('mark_distribution', 'is_edit')) {
                ajax_access_denied();
            }
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('name', translate('name'), 'trim|required');
            if ($this->form_validation->run() !== false) {
                // save mark distribution information in the database file
                $arrayDistribution = array(
                    'name' => $this->input->post('name'),
                    'branch_id' => $this->application_model->get_branch_id(),
                );
                $this->db->where('id', $this->input->post('distribution_id'));
                $this->db->update('exam_mark_distribution', $arrayDistribution);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('exam/mark_distribution');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function mark_distribution_delete($id)
    {
        if (!get_permission('mark_distribution', 'is_delete')) {
            access_denied();
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->delete('exam_mark_distribution');
    }

    /* hall form validation rules */
    protected function hall_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('hall_no', translate('hall_no'), 'trim|required|callback_unique_hall_no');
        $this->form_validation->set_rules('no_of_seats', translate('no_of_seats'), 'trim|required|numeric');
    }

    /* exam hall information moderator and page */
    public function hall($action = '', $id = '')
    {
        if (isset($_POST['save'])) {
            if (!get_permission('exam_hall', 'is_add')) {
                access_denied();
            }
            $this->hall_validation();
            if ($this->form_validation->run() !== false) {
                //save exam hall information in the database file
                $this->exam_model->hallSave($this->input->post());
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(current_url());
            }
        }
        $this->data['halllist'] = $this->app_lib->getTable('exam_hall');
        $this->data['title'] = translate('exam_hall');
        $this->data['sub_page'] = 'exam/hall';
        $this->data['main_menu'] = 'exam';
        $this->load->view('layout/index', $this->data);
    }

    public function hall_edit()
    {
        if ($_POST) {
            if (!get_permission('exam_hall', 'is_edit')) {
                ajax_access_denied();
            }
            $this->hall_validation();
            if ($this->form_validation->run() !== false) {
                //save exam hall information in the database file
                $this->exam_model->hallSave($this->input->post());
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('exam/hall');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function hall_delete($id)
    {
        if (!get_permission('exam_hall', 'is_delete')) {
            access_denied();
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->delete('exam_hall');
    }

    /* exam hall number exists validation */
    public function unique_hall_no($hall_no)
    {
        $branchID = $this->application_model->get_branch_id();
        $term_id = $this->input->post('term_id');
        if (!empty($term_id)) {
            $this->db->where_not_in('id', $term_id);
        }
        $this->db->where(array('hall_no' => $hall_no, 'branch_id' => $branchID));
        $uniform_row = $this->db->get('exam_hall')->num_rows();
        if ($uniform_row == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_hall_no", translate('already_taken'));
            return false;
        }
    }

    /* exam mark information are prepared and stored in the database here */
    public function mark_entry()
    {
        if (!get_permission('exam_mark', 'is_add')) {
            access_denied();
        }

        $branchID = $this->application_model->get_branch_id();
        $classID = $this->input->post('class_id');
        $sectionID = $this->input->post('section_id');
        $subjectID = $this->input->post('subject_id');
        $examID = $this->input->post('exam_id');

        $this->data['branch_id'] = $branchID;
        $this->data['class_id'] = $classID;
        $this->data['section_id'] = $sectionID;
        $this->data['subject_id'] = $subjectID;
        $this->data['exam_id'] = $examID;
        if (isset($_POST['search'])) {
            $this->data['timetable_detail'] = $this->exam_model->getTimetableDetail($classID, $sectionID, $examID, $subjectID);

            $this->data['student'] = $this->exam_model->getMarkAndStudent($branchID, $classID, $sectionID, $examID, $subjectID);
        }

        $this->data['sub_page'] = 'exam/marks_register';
        $this->data['main_menu'] = 'mark';
        $this->data['title'] = translate('mark_entries');
        $this->load->view('layout/index', $this->data);
    }

    public function mark_save()
    {
        if ($_POST) {
            if (!get_permission('exam_mark', 'is_add')) {
                ajax_access_denied();
            }
            $inputMarks = $this->input->post('mark');
            foreach ($inputMarks as $key => $value) {
                if (!isset($value['absent'])) {
                    foreach ($value['assessment'] as $i => $row) {
                        $this->form_validation->set_rules('mark[' . $key . '][assessment][' . $i . ']', translate('mark'), 'trim|required|numeric');
                    }
                }
            }
            if ($this->form_validation->run() !== false) {
                $branchID = $this->application_model->get_branch_id();
                $classID = $this->input->post('class_id');
                $sectionID = $this->input->post('section_id');
                $subjectID = $this->input->post('subject_id');
                $examID = $this->input->post('exam_id');
                $inputMarks = $this->input->post('mark');
                foreach ($inputMarks as $key => $value) {
                    $assMark = array();
                    foreach ($value['assessment'] as $i => $row) {
                        $assMark[$i] = $row;
                    }
                    $arrayMarks = array(
                        'student_id' => $value['student_id'],
                        'exam_id' => $examID,
                        'class_id' => $classID,
                        'section_id' => $sectionID,
                        'subject_id' => $subjectID,
                        'branch_id' => $branchID,
                        'session_id' => get_session_id(),
                    );
                    $inputMark = (isset($value['absent']) ? null : json_encode($assMark));
                    $absent = (isset($value['absent']) ? 'on' : '');
                    $query = $this->db->get_where('mark', $arrayMarks);
                    if ($query->num_rows() > 0) {
                        $this->db->where('id', $query->row()->id);
                        $this->db->update('mark', array('mark' => $inputMark, 'absent' => $absent));
                    } else {
                        $arrayMarks['mark'] = $inputMark;
                        $arrayMarks['absent'] = $absent;
                        $this->db->insert('mark', $arrayMarks);
                        // send exam results sms
                        $this->sms_model->send_sms($arrayMarks, 5);
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

    /* exam grade form validation rules */
    protected function grade_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('name', translate('name'), 'trim|required');
        $this->form_validation->set_rules('grade_point', translate('grade_point'), 'trim|required');
        $this->form_validation->set_rules('lower_mark', translate('mark_from'), 'trim|required');
        $this->form_validation->set_rules('upper_mark', translate('mark_upto'), 'trim|required');
    }

    /* exam grade information are prepared and stored in the database here */
    public function grade($action = '')
    {
        if (!get_permission('exam_grade', 'is_view')) {
            access_denied();
        }

        if ($_POST) {
            if (!get_permission('exam_grade', 'is_view')) {
                ajax_access_denied();
            }
            $this->grade_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $this->exam_model->gradeSave($post);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url = base_url('exam/grade');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['title'] = translate('grades_range');
        $this->data['sub_page'] = 'exam/grade';
        $this->data['main_menu'] = 'mark';
        $this->load->view('layout/index', $this->data);
    }

    // exam grade information updating here
    public function grade_edit($id = '')
    {
        if (!get_permission('exam_grade', 'is_edit')) {
            ajax_access_denied();
        }

        if ($_POST) {
            $this->grade_validation();
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                $this->exam_model->gradeSave($post);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url = base_url('exam/grade');
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['grade'] = $this->app_lib->getTable('grade', array('t.id' => $id), true);
        $this->data['sub_page'] = 'exam/grade_edit';
        $this->data['title'] = translate('grades_range');
        $this->data['main_menu'] = 'exam';
        $this->load->view('layout/index', $this->data);
    }

    public function grade_delete($id = '')
    {
        if (get_permission('exam_grade', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('grade');
        }
    }

    public function marksheet()
    {
        if (!get_permission('report_card', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $sessionID = $this->input->post('session_id');
            $examID = $this->input->post('exam_id');
            $classID = $this->input->post('class_id');
            $sectionID = $this->input->post('section_id');
            $this->db->select('e.roll,s.*,c.name as category');
            $this->db->from('enroll as e');
            $this->db->join('student as s', 'e.student_id = s.id', 'inner');
            $this->db->join('mark as m', 'm.student_id = s.id', 'inner');
            $this->db->join('student_category as c', 'c.id = s.category_id', 'left');
            $this->db->where('e.session_id', $sessionID);
            $this->db->where('e.class_id', $classID);
            $this->db->where('e.section_id', $sectionID);
            $this->db->where('e.branch_id', $branchID);
            $this->db->where('m.exam_id', $examID);
            $this->db->group_by('m.student_id');
            $this->data['student'] = $this->db->get()->result_array();
        }

        $this->data['branch_id'] = $branchID;
        $this->data['sub_page'] = 'exam/marksheet';
        $this->data['main_menu'] = 'exam_reports';
        $this->data['title'] = translate('report_card');
        $this->load->view('layout/index', $this->data);
    }

    public function reportCardPrint()
    {
        if ($_POST) {
            if (!get_permission('report_card', 'is_view')) {
                ajax_access_denied();
            }
            $this->data['student_array'] = $this->input->post('student_id');
            $this->data['remarks_array'] = $this->input->post('remarks');
            $this->data['grade_scale'] = $this->input->post('grade_scale');
            $this->data['attendance'] = $this->input->post('attendance');
            $this->data['print_date'] = $this->input->post('print_date');
            $this->data['examID'] = $this->input->post('exam_id');
            $this->data['sessionID'] = $this->input->post('session_id');
            echo $this->load->view('exam/reportCard', $this->data, true);
        }
    }

    /* tabulation sheet report generating here */
    public function tabulation_sheet()
    {
        if (!get_permission('tabulation_sheet', 'is_view')) {
            access_denied();
        }
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        if (!empty($this->input->post('submit'))) {
            $classID = $this->input->post('class_id');
            $sectionID = $this->input->post('section_id');
            $examID = $this->input->post('exam_id');
            $sessionID = $this->input->post('session_id');
            $this->data['get_subjects'] = $this->exam_model->getSubjectList($examID, $classID, $sectionID, $sessionID);
        }
        $this->data['title'] = translate('tabulation_sheet');
        $this->data['sub_page'] = 'exam/tabulation_sheet';
        $this->data['main_menu'] = 'exam_reports';
        $this->load->view('layout/index', $this->data);
    }

    public function getDistributionByBranch()
    {
        $html = "";
        $table = $this->input->post('table');
        $branch_id = $this->application_model->get_branch_id();
        if (!empty($branch_id)) {
            $result = $this->db->select('id,name')->where('branch_id', $branch_id)->get('exam_mark_distribution')->result_array();
            if (count($result)) {
                foreach ($result as $row) {
                    $html .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            }
        }
        echo $html;
    }

}
