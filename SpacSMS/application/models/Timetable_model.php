<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Timetable_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // class wise information save
    public function classwise_save($data, $mode)
    {
        $branchID   = $this->application_model->get_branch_id();
        $sectionID  = $data['section_id'];
        $classID    = $data['class_id'];
        $sessionID  = get_session_id();
        $day        = $data['day'];

        $arrayItems = $data['timetable'];
        foreach ($arrayItems as $key => $value) {
            if (!isset($value['break'])) {
                $subjectID  = $value['subject'];
                $teacherID  = $value['teacher'];
                $break      = false;
            } else {
                $subjectID  = 0;
                $teacherID  = 0;
                $break      = true;
            }
            $timeStart = date("H:i:s", strtotime($value['time_start']));
            $timeEnd = date("H:i:s", strtotime($value['time_end']));
            $roomNumber = $value['class_room'];
            if (!empty($timeStart) && !empty($timeEnd)) {
                $arrayRoutine = array(
                    'class_id'      => $classID,
                    'section_id'    => $sectionID,
                    'subject_id'    => $subjectID,
                    'teacher_id'    => $teacherID,
                    'time_start'    => $timeStart,
                    'time_end'      => $timeEnd,
                    'class_room'    => $roomNumber,
                    'session_id'    => $sessionID,
                    'branch_id'     => $branchID,
                    'break'         => $break,
                    'day'           => $day,
                );
                if ($mode == 'new') {
                    $this->db->insert('timetable_class', $arrayRoutine);
                } elseif ($mode == 'update') {
                    $this->db->where('id', $data['i'][$key]);
                    $this->db->update('timetable_class', $arrayRoutine);
                }
            }
        }
        if ($mode == 'update') {
            $arrayI = $data['i'];
            $this->db->where_not_in('id', $arrayI);
            $this->db->where('class_id', $classID);
            $this->db->where('section_id', $sectionID);
            $this->db->where('day', $day);
            $this->db->where('session_id', $sessionID);
            $this->db->where('branch_id', $branchID);
            $this->db->delete('timetable_class');
        }
    }

    public function getExamTimetableList($classID, $sectionID, $branchID)
    {
        $this->db->select('t.*,b.name as branch_name');
        $this->db->from('timetable_exam as t');
        $this->db->join('branch as b', 'b.id = t.branch_id', 'left');
        $this->db->where('t.branch_id', $branchID);
        $this->db->where('t.class_id', $classID);
        $this->db->where('t.section_id', $sectionID);
        $this->db->where('t.session_id', get_session_id());
        $this->db->order_by('t.id', 'asc');
        $this->db->group_by('t.exam_id');
        return $this->db->get()->result_array();
    }

    public function getSubjectExam($classID, $sectionID, $examID, $branchID)
    {
        $sql = "SELECT sa.*, s.name as subject_name, te.time_start, te.time_end, te.hall_id, te.exam_date, te.mark_distribution FROM subject_assign as sa
        LEFT JOIN subject as s ON s.id = sa.subject_id LEFT JOIN timetable_exam as te ON te.class_id = sa.class_id and te.section_id = sa.section_id and
        te.subject_id = sa.subject_id and te.session_id = sa.session_id and te.exam_id = " . $this->db->escape($examID) . " WHERE sa.class_id = " .
        $this->db->escape($classID) . " AND sa.section_id = " . $this->db->escape($sectionID) . " AND sa.branch_id = " .
        $this->db->escape($branchID) . " AND sa.session_id = " . $this->db->escape(get_session_id());
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getExamTimetableByModal($examID, $classID, $sectionID)
    {
        $this->db->select('t.*,s.name as subject_name,eh.hall_no');
        $this->db->from('timetable_exam as t');
        $this->db->join('subject as s', 's.id = t.subject_id', 'left');
        $this->db->join('exam_hall as eh', 'eh.id = t.hall_id', 'left');
        if (!is_superadmin_loggedin()) {
            $this->db->where('t.branch_id', get_loggedin_branch_id());
        }
        $this->db->where('t.exam_id', $examID);
        $this->db->where('t.class_id', $classID);
        $this->db->where('t.section_id', $sectionID);
        $this->db->where('t.session_id', get_session_id());
        return $this->db->get();
    }
}
