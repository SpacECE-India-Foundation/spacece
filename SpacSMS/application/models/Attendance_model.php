<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Attendance_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getStudentAttendence($classID, $sectionID, $date, $branchID)
    {
        $sql = "SELECT enroll.student_id,enroll.roll,student.first_name,student.last_name,student.register_no,student_attendance.id as `att_id`,
        student_attendance.status as `att_status`,student_attendance.remark as `att_remark` FROM enroll LEFT JOIN student ON
        student.id = enroll.student_id LEFT JOIN student_attendance ON student_attendance.student_id = student.id AND
        student_attendance.date = " . $this->db->escape($date) . " WHERE enroll.class_id = " . $this->db->escape($classID) .
        " AND enroll.section_id = " . $this->db->escape($sectionID) . " AND enroll.branch_id = " .
        $this->db->escape($branchID) . " AND enroll.session_id = " . $this->db->escape(get_session_id());
        return $this->db->query($sql)->result_array();
    }

    public function getStaffAttendence($roleID, $date, $branchID)
    {
        $sql = "SELECT staff.*, lc.role, sa.id as `atten_id`, IFNULL(sa.status, 0) as att_status, sa.remark as `att_remark` FROM staff LEFT JOIN
        login_credential as `lc` ON lc.user_id = staff.id and lc.role != '6' and lc.role != '7' LEFT JOIN staff_attendance as `sa` ON
        sa.staff_id = staff.id and sa.date = " . $this->db->escape($date) . " WHERE staff.branch_id = " . $this->db->escape($branchID) .
        " AND lc.role = " . $this->db->escape($roleID) . " AND lc.active = 1 ORDER BY staff.id ASC";
        return $this->db->query($sql)->result_array();
    }

    public function getExamAttendence($classID, $sectionID, $examID, $subjectID, $branchID)
    {
        $sql = "SELECT enroll.student_id,enroll.roll,student.first_name,student.last_name,student.register_no,exam_attendance.id as `atten_id`,
        exam_attendance.status as `att_status`,exam_attendance.remark as `att_remark` FROM `enroll` LEFT JOIN student ON
        student.id = enroll.student_id LEFT JOIN exam_attendance ON exam_attendance.student_id = student.id AND exam_attendance.exam_id = " .
        $this->db->escape($examID) . " AND exam_attendance.subject_id = " . $this->db->escape($subjectID) .
        " WHERE enroll.class_id = " . $this->db->escape($classID) . " AND enroll.section_id = " . $this->db->escape($sectionID) .
        " AND enroll.branch_id = " . $this->db->escape($branchID) . " AND enroll.session_id = " . $this->db->escape(get_session_id());
        return $this->db->query($sql)->result_array();
    }

    public function getStudentList($branch_id, $class_id, $section_id)
    {
        $this->db->select('e.student_id,e.roll,s.first_name,s.last_name,s.register_no');
        $this->db->from('enroll as e');
        $this->db->join('student as s', 's.id = e.student_id', 'left');
        $this->db->where('e.class_id', $class_id);
        $this->db->where('e.section_id', $section_id);
        $this->db->where('e.branch_id', $branch_id);
        $this->db->where('e.session_id', get_session_id());
        return $this->db->get()->result_array();
    }

    // GET STAFF ALL DETAILS
    public function getStaffList($branch_id = '', $role_id, $active = 1)
    {
        $this->db->select('staff.*,login_credential.role as role_id, roles.name as role');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != "6" and login_credential.role != "7"', 'inner');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        if (!empty($branch_id)) {
            $this->db->where('staff.branch_id', $branch_id);
        }
        $this->db->where('login_credential.role', $role_id);
        $this->db->where('login_credential.active', $active);
        $this->db->order_by('staff.id', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getExamReport($data)
    {
        $sql = "SELECT ea.*, s.first_name, s.last_name, s.register_no, s.category_id, e.roll, sb.name as subject_name FROM exam_attendance as ea LEFT JOIN
        enroll as e ON e.student_id = ea.student_id LEFT JOIN student as s ON s.id = ea.student_id LEFT JOIN subject as sb ON sb.id = ea.subject_id WHERE
        ea.exam_id = " . $this->db->escape($data['exam_id']) . " AND ea.subject_id = " . $this->db->escape($data['subject_id']) . " AND
        ea.branch_id = " . $this->db->escape($data['branch_id']) . " AND e.class_id = " . $this->db->escape($data['class_id']) . " AND
        e.section_id = " . $this->db->escape($data['section_id']) . " AND e.session_id = " . $this->db->escape(get_session_id());
        return $this->db->query($sql)->result_array();
    }

    // check attendance by staff id and date
    public function get_attendance_by_date($studentID, $date)
    {
        $sql = "SELECT student_attendance.* FROM student_attendance WHERE student_id = " . $this->db->escape($studentID) . " AND date = " . $this->db->escape($date);
        return $this->db->query($sql)->row_array();
    }
}
