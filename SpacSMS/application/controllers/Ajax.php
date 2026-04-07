<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom School Management System
 * @version : 2.0
 * @developed by : RamomCoder
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/RamomCoder
 * @filename : Ajax.php
 */

class Ajax extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ajax_model');
    }

    // get exam list based on the branch
    public function getExamByBranch()
    {
        $html = "";
        $branchID = $this->application_model->get_branch_id();
        if (!empty($branchID)) {
            $this->db->select('id,name,term_id');
            $this->db->where(array('branch_id' => $branchID, 'session_id' => get_session_id()));
            $result = $this->db->get('exam')->result_array();
            if (count($result)) {
                $html .= '<option value="">' . translate('select') . '</option>';
                foreach ($result as $row) {
                    if ($row['term_id'] != 0) {
                        $term = $this->db->select('name')->where('id', $row['term_id'])->get('exam_term')->row()->name;
                        $name = $row['name'] . ' (' . $term . ')';
                    } else {
                        $name = $row['name'];
                    }
                    $html .= '<option value="' . $row['id'] . '">' . $name . '</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_branch_first') . '</option>';
        }
        echo $html;
    }

    // get class assign modal
    public function getClassAssignM()
    {
        $classID = $this->input->post('class_id');
        $sectionID = $this->input->post('section_id');
        $branchID = get_type_name_by_id('class', $classID, 'branch_id');
        $html = "";
        $subjects = $this->db->get_where('subject', array('branch_id' => $branchID))->result_array();
        if (count($subjects)) {
            foreach ($subjects as $row) {
                $query_assign = $this->db->get_where("subject_assign", array(
                    'class_id' => $classID,
                    'section_id' => $sectionID,
                    'session_id' => get_session_id(),
                    'subject_id' => $row['id'],
                ));
                $html .= '<option value="' . $row['id'] . '"' . ($query_assign->num_rows() != 0 ? 'selected' : '') . '>' . $row['name'] . '</option>';
            }
        }
        $data['branch_id'] = $branchID;
        $data['class_id'] = $classID;
        $data['section_id'] = $sectionID;
        $data['subject'] = $html;
        echo json_encode($data);
    }

    public function getAdvanceSalaryDetails()
    {
        if (get_permission('advance_salary', 'is_add')) {
            $this->data['salary_id'] = $this->input->post('id');
            $this->load->view('advance_salary/approvel_modalView', $this->data);
        }
    }

    public function getLeaveCategoryDetails()
    {
        if (get_permission('leave_category', 'is_edit')) {
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $query = $this->db->get('leave_category');
            $result = $query->row_array();
            echo json_encode($result);
        }
    }

    public function getDataByBranch()
    {
        $html = "";
        $table = $this->input->post('table');
        $branch_id = $this->application_model->get_branch_id();
        if (!empty($branch_id)) {
            $result = $this->db->select('id,name')->where('branch_id', $branch_id)->get($table)->result_array();
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

    public function getClassByBranch()
    {
        $html = "";
        $branch_id = $this->application_model->get_branch_id();
        if (!empty($branch_id)) {
            $classes = $this->db->select('id,name')->where('branch_id', $branch_id)->get('class')->result_array();
            if (count($classes)) {
                $html .= "<option value=''>" . translate('select') . "</option>";
                foreach ($classes as $row) {
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

    public function getStudentByClass()
    {
        $html = "";
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $branch_id = $this->application_model->get_branch_id();
        $student_id = (isset($_POST['student_id']) ? $_POST['student_id'] : 0);
        if (!empty($class_id)) {
            $this->db->select('e.student_id,e.roll,CONCAT(s.first_name, " ", s.last_name) as fullname');
            $this->db->from('enroll as e');
            $this->db->join('student as s', 's.id = e.student_id', 'inner');
            $this->db->join('login_credential as l', 'l.user_id = e.student_id and l.role = 7', 'left');
            $this->db->where('l.active', 1);
            $this->db->where('e.session_id', get_session_id());
            if (!empty($section_id)) {
                $this->db->where('e.section_id', $section_id);
            }
            $this->db->where('e.class_id', $class_id);
            $this->db->where('e.branch_id', $branch_id);
            $result = $this->db->get()->result_array();
            if (count($result)) {
                $html .= "<option value=''>" . translate('select') . "</option>";
                foreach ($result as $row) {
                    $sel = ($row['student_id']  == $student_id ? 'selected' : '');
                    $html .= '<option value="' . $row['student_id'] . '"' . $sel . '>' . $row['fullname'] . ' ( Roll : ' . $row['roll'] . ')</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_class_first') . '</option>';
        }
        echo $html;
    }

    // get section list based on the class
    public function getSectionByClass()
    {
        $html = "";
        $classID = $this->input->post("class_id");
        $mode = $this->input->post("all");
        $multi = $this->input->post("multi");
        if (!empty($classID)) {
            if (loggedin_role_id() == 3) {
                $result = $this->db->select('teacher_allocation.section_id,section.name')
                    ->from('teacher_allocation')
                    ->join('section', 'section.id = teacher_allocation.section_id', 'left')
                    ->where(array('teacher_allocation.class_id' => $classID, 'teacher_allocation.teacher_id' => get_loggedin_user_id(), 'teacher_allocation.session_id' => get_session_id()))
                    ->get()->result_array();
            } else {
                $result = $this->db->select('sections_allocation.section_id,section.name')
                    ->from('sections_allocation')
                    ->join('section', 'section.id = sections_allocation.section_id', 'left')
                    ->where('sections_allocation.class_id', $classID)
                    ->get()->result_array();
            }
            if (count($result)) {
                if ($multi == false) {
                   $html .= '<option value="">' . translate('select') . '</option>';
                }
                if ($mode == true && loggedin_role_id() != 3) {
                    $html .= '<option value="all">' . translate('all_sections') . '</option>';
                }
                foreach ($result as $row) {
                    $html .= '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_selection_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_class_first') . '</option>';
        }
        echo $html;
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

    // get staff all details
    public function getEmployeeList()
    {
        $html = "";
        $role_id = $this->input->post('role');
        $designation = $this->input->post('designation');
        $department = $this->input->post('department');
        $selected_id = (isset($_POST['staff_id']) ? $_POST['staff_id'] : 0);
        $this->db->select('staff.*,staff_designation.name as des_name,staff_department.name as dep_name,login_credential.role as role_id, roles.name as role');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id', 'inner');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
        $this->db->where('login_credential.role', $role_id);
        $this->db->where('login_credential.active', 1);
        if ($designation != '') {
            $this->db->where('staff.designation', $designation);
        }

        if ($department != '') {
            $this->db->where('staff.department', $department);
        }

        $result = $this->db->get()->result_array();
        if (count($result)) {
            $html .= "<option value=''>" . translate('select') . "</option>";
            foreach ($result as $row) {
                $selected = ($row['id'] == $selected_id ? 'selected' : '');
                $html .= "<option value='" . $row['id'] . "' " . $selected . ">" . $row['name'] . " (" . $row['staff_id'] . ")</option>";
            }
        } else {
            $html .= '<option value="">' . translate('no_information_available') . '</option>';
        }
        echo $html;
    }

    // get subject list based on the class
    public function getSubjectByClass()
    {
        $html = "";
        $classID = $this->input->post('classID');
        if (!empty($classID)) {
            $this->db->select('subject_assign.subject_id,subject.name,subject.subject_code');
            $this->db->from('subject_assign');
            $this->db->join('subject', 'subject.id = subject_assign.subject_id', 'left');
            $this->db->where('subject_assign.class_id', $classID);
            if (!is_superadmin_loggedin()) {
                $this->db->where('subject_assign.branch_id', get_loggedin_branch_id());
            }
            $subjects = $this->db->get()->result_array();
            if (count($subjects)) {
                $html .= '<option value="">' . translate('select') . '</option>';
                foreach ($subjects as $row) {
                    $html .= '<option value="' . $row['subject_id'] . '">' . $row['name'] . ' (' . $row['subject_code'] . ')</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_class_first') . '</option>';
        }
        echo $html;
    }

    public function get_salary_template_details()
    {
        if (get_permission('salary_template', 'is_view')) {
            $template_id = $this->input->post('id');
            $this->data['allowances'] = $this->ajax_model->get('salary_template_details', array('type' => 1, 'salary_template_id' => $template_id));
            $this->data['deductions'] = $this->ajax_model->get('salary_template_details', array('type' => 2, 'salary_template_id' => $template_id));
            $this->data['template'] = $this->ajax_model->get('salary_template', array('id' => $template_id), true);
            $this->load->view('payroll/qview_salary_templete', $this->data);
        }
    }

    public function department_details()
    {
        if (get_permission('department', 'is_edit')) {
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $query = $this->db->get('staff_department');
            $result = $query->row_array();
            echo json_encode($result);
        }
    }

    public function designation_details()
    {
        if (get_permission('designation', 'is_edit')) {
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $query = $this->db->get('staff_designation');
            $result = $query->row_array();
            echo json_encode($result);
        }
    }
}
