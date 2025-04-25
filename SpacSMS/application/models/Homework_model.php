<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Homework_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getList($classID, $sectionID, $subjectID, $branchID)
    {
        $this->db->select('homework.*,subject.name as subject_name,class.name as class_name,section.name as section_name,staff.name as creator_name');
        $this->db->from('homework');
        $this->db->join('subject', 'subject.id = homework.subject_id', 'left');
        $this->db->join('class', 'class.id = homework.class_id', 'left');
        $this->db->join('section', 'section.id = homework.section_id', 'left');
        $this->db->join('staff', 'staff.id = homework.created_by', 'left');
        $this->db->where('homework.class_id', $classID);
        $this->db->where('homework.section_id', $sectionID);
        $this->db->where('homework.subject_id', $subjectID);
        $this->db->where('homework.branch_id', $branchID);
        $this->db->where('homework.session_id', get_session_id());
        $this->db->order_by('homework.id', 'desc');
        return $this->db->get()->result_array();
    }

    public function evaluationCounter($classID, $sectionID, $homeworkID)
    {
        $countStu = $this->db->where(array('class_id' => $classID, 'section_id' => $sectionID, 'session_id' => get_session_id()))->get('enroll')->num_rows();
        $countEva = $this->db->where(array('homework_id' => $homeworkID, 'status' => 'c'))->get('homework_evaluation')->num_rows();
        $incomplete = ($countStu - $countEva);
        return array('total' => $countStu, 'complete' => $countEva, 'incomplete' => $incomplete);
    }

    public function getEvaluate($homeworkID)
    {
        $this->db->select('homework.*,CONCAT(s.first_name, " ",s.last_name) as fullname,s.register_no,e.student_id, e.roll,subject.name as subject_name,class.name as class_name,section.name as section_name,he.id as ev_id,he.status as ev_status,he.remark as ev_remarks,he.rank');
        $this->db->from('homework');
        $this->db->join('enroll as e', 'e.class_id=homework.class_id and e.section_id = homework.section_id and e.session_id = homework.session_id', 'inner');
        $this->db->join('student as s', 'e.student_id = s.id', 'inner');
        $this->db->join('homework_evaluation as he', 'he.homework_id = homework.id and he.student_id = e.student_id', 'left');
        $this->db->join('subject', 'subject.id = homework.subject_id', 'left');
        $this->db->join('class', 'class.id = homework.class_id', 'left');
        $this->db->join('section', 'section.id = homework.section_id', 'left');
        $this->db->where('homework.id', $homeworkID);
        if (!is_superadmin_loggedin()) {
            $this->db->where('homework.branch_id', get_loggedin_branch_id());
        }
        $this->db->where('homework.session_id', get_session_id());
        $this->db->order_by('homework.id', 'desc');
        return $this->db->get()->result_array();
    }

    // save student homework in DB
    public function save($data)
    {
    	$status = isset($data['published_later']) ? TRUE : FALSE;
        $sms_notification = isset($data['notification_sms']) ? TRUE : FALSE;
    	$arrayHomework = array(
    		'branch_id' => $this->application_model->get_branch_id(),
    		'class_id' => $data['class_id'],
    		'section_id' => $data['section_id'], 
    		'session_id' => get_session_id(), 
    		'subject_id' => $data['subject_id'], 
    		'date_of_homework' => date("Y-m-d", strtotime($data['date_of_homework'])), 
    		'date_of_submission' => date("Y-m-d", strtotime($data['date_of_submission'])), 
    		'description' => $data['homework'], 
    		'created_by' => get_loggedin_user_id(), 
    		'create_date' => date("Y-m-d"), 
    		'status' => $status, 
            'sms_notification' => $sms_notification, 
    	);
    	if ($status == TRUE) {
    		$arrayHomework['schedule_date'] = date("Y-m-d", strtotime($data['schedule_date']));
    	} else {
            $arrayHomework['schedule_date'] = null;
        }
        if (isset($data['homework_id'])) {
            if (!is_superadmin_loggedin()) 
                $this->db->where('branch_id', get_loggedin_branch_id());
            $this->db->where('id', $data['homework_id']);
            $this->db->update('homework', $arrayHomework);
            $insert_id = $data['homework_id'];
        } else {
            $this->db->insert('homework', $arrayHomework);
            $insert_id = $this->db->insert_id();
        }

        if (isset($_FILES["attachment_file"]) && !empty($_FILES['attachment_file']['name'])) {
            $uploaddir = './uploads/attachments/homework/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                die("Error creating folder $uploaddir");
            }
            $fileInfo = pathinfo($_FILES["attachment_file"]["name"]);
            $document = basename($_FILES['attachment_file']['name']);

            $file_name = $insert_id . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["attachment_file"]["tmp_name"], $uploaddir . $file_name);
        } else {
            if (isset($data['old_document'])) {
               $document = $data['old_document'];
            } else {
                $document = "";
            }
        }

        $this->db->where('id', $insert_id);
        $this->db->update('homework', array('document' => $document));

        //send homework sms notification
        if (isset($data['notification_sms'])) {
        	$stuList = $this->application_model->getStudentListByClassSection($arrayHomework['class_id'], $arrayHomework['section_id'], $arrayHomework['branch_id']);
        	foreach ($stuList as $row) {
        		$row['date_of_homework'] = $arrayHomework['date_of_homework'];
        		$row['date_of_submission'] = $arrayHomework['date_of_submission'];
        		$row['subject_id'] = $arrayHomework['subject_id'];
        		$this->sms_model->sendHomework($row);
        	}
        }
    }
}
