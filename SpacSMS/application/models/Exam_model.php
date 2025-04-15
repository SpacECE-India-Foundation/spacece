<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Exam_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getExamList()
    {
        $this->db->select('e.*,b.name as branch_name');
        $this->db->from('exam as e');
        $this->db->join('branch as b', 'b.id = e.branch_id', 'left');
        if (!is_superadmin_loggedin()) {
            $this->db->where('e.branch_id', get_loggedin_branch_id());
        }
        $this->db->where('e.session_id', get_session_id());
        $this->db->order_by('e.id', 'asc');
        return $this->db->get()->result_array();
    }
    
    public function exam_save($data)
    {
        $arrayExam = array(
            'name' => $data['name'],
            'branch_id' => $this->application_model->get_branch_id(),
            'term_id' => $data['term_id'],
            'type_id' => $data['type_id'],
            'mark_distribution' => json_encode($data['mark_distribution']),
            'remark' => $data['remark'],
            'session_id' => get_session_id(),
        );
        if (!isset($data['exam_id'])) {
            $this->db->insert('exam', $arrayExam);
        } else {
            $this->db->where('id', $data['exam_id']);
            $this->db->update('exam', $arrayExam);
        }
    }

    public function termSave($post)
    {
        $arrayTerm = array(
            'name' => $post['term_name'],
            'branch_id' => $this->application_model->get_branch_id(),
            'session_id' => get_session_id(),
        );
        if (!isset($post['term_id'])) {
            $this->db->insert('exam_term', $arrayTerm);
        } else {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $post['term_id']);
            $this->db->update('exam_term', $arrayTerm);
        }
    }

    public function hallSave($post)
    {
        $arrayHall = array(
            'hall_no' => $post['hall_no'],
            'seats' => $post['no_of_seats'],
            'branch_id' => $this->application_model->get_branch_id(),
        );
        if (!isset($post['hall_id'])) {
            $this->db->insert('exam_hall', $arrayHall);
        } else {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $post['hall_id']);
            $this->db->update('exam_hall', $arrayHall);
        }
    }

    public function gradeSave($data)
    {
        $arrayData = array(
            'branch_id' => $this->application_model->get_branch_id(),
            'name' => $data['name'],
            'grade_point' => $data['grade_point'],
            'lower_mark' => $data['lower_mark'],
            'upper_mark' => $data['upper_mark'],
            'remark' => $data['remark'],
        );
        // posted all data XSS filtering
        if (!isset($data['grade_id'])) {
            $this->db->insert('grade', $arrayData);
        } else {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $data['grade_id']);
            $this->db->update('grade', $arrayData);
        }
    }

    public function get_grade($mark, $branch_id)
    {
        $this->db->where('branch_id', $branch_id);
        $query = $this->db->get('grade');
        $grades = $query->result_array();
        foreach ($grades as $row) {
            if ($mark >= $row['lower_mark'] && $mark <= $row['upper_mark']) {
                return $row;
            }
        }
    }

    public function getSubjectList($examID, $classID, $sectionID, $sessionID)
    {
        $branchID = $this->application_model->get_branch_id();
        $this->db->select('t.*,s.name as subject_name');
        $this->db->from('timetable_exam as t');
        $this->db->join('subject as s', 's.id = t.subject_id', 'left');
        $this->db->where('t.exam_id', $examID);
        $this->db->where('t.class_id', $classID);
        $this->db->where('t.section_id', $sectionID);
        $this->db->where('t.session_id', $sessionID);
        $this->db->where('t.branch_id', $branchID);
        return $this->db->get()->result_array();
    }

    public function getTimetableDetail($classID, $sectionID, $examID, $subjectID)
    {
        $this->db->select('timetable_exam.mark_distribution');
        $this->db->where('class_id', $classID);
        $this->db->where('section_id', $sectionID);
        $this->db->where('exam_id', $examID);
        $this->db->where('subject_id', $subjectID);
        $this->db->where('session_id', get_session_id());
        return $this->db->get('timetable_exam')->row_array();
    }


    public function getMarkAndStudent($branchID, $classID, $sectionID, $examID, $subjectID)
    {
        $this->db->select('en.*,st.first_name,st.last_name,st.register_no,st.category_id,m.mark as get_mark,IFNULL(m.absent, 0) as get_abs,subject.name as subject_name');
        $this->db->from('enroll as en');
        $this->db->join('student as st', 'st.id = en.student_id', 'inner');
        $this->db->join('mark as m', 'm.student_id = en.student_id and m.class_id = en.class_id and m.section_id = en.section_id and m.exam_id = ' . $this->db->escape($examID) . ' and m.subject_id = ' . $this->db->escape($subjectID), 'left');
        $this->db->join('subject', 'subject.id = m.subject_id', 'left');
        $this->db->where('en.class_id', $classID);
        $this->db->where('en.section_id', $sectionID);
        $this->db->where('en.branch_id', $branchID);
        $this->db->where('en.session_id', get_session_id());
        $this->db->order_by('en.roll', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getStudentReportCard($studentID, $examID, $sessionID)
    {
        $result = array();
        $this->db->select('enroll.roll,student.*,c.name as class_name,se.name as section_name,IFNULL(parent.father_name,"N/A") as father_name,IFNULL(parent.mother_name,"N/A") as mother_name');
        $this->db->from('enroll');
        $this->db->join('student', 'student.id = enroll.student_id', 'inner');
        $this->db->join('class as c', 'c.id = enroll.class_id', 'left');
        $this->db->join('section as se', 'se.id = enroll.section_id', 'left');
        $this->db->join('parent', 'parent.id = student.parent_id', 'left');
        $this->db->where('enroll.student_id', $studentID);
        $result['student'] = $this->db->get()->row_array();

        $this->db->select('m.mark as get_mark,IFNULL(m.absent, 0) as get_abs,subject.name as subject_name, te.mark_distribution');
        $this->db->from('mark as m');
        $this->db->join('subject', 'subject.id = m.subject_id', 'left');
        $this->db->join('timetable_exam as te', 'te.exam_id = m.exam_id and te.class_id = m.class_id and te.section_id = m.section_id and te.subject_id = m.subject_id', 'left');
        $this->db->where('m.exam_id', $examID);
        $this->db->where('m.student_id', $studentID);
        $this->db->where('m.session_id', $sessionID);
        $result['exam'] = $this->db->get()->result_array();

        return $result;
    }

}
