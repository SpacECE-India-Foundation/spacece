<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classes_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getTeacherAllocation($branch_id = '')
    {
        $this->db->select('ta.*,st.name as teacher_name,st.staff_id as teacher_id,c.name as class_name,c.branch_id,s.name as section_name');
        $this->db->from('teacher_allocation as ta');
        $this->db->join('staff as st', 'st.id = ta.teacher_id', 'left');
        $this->db->join('class as c', 'c.id = ta.class_id', 'left');
        $this->db->join('section as s', 's.id = ta.section_id', 'left');
        $this->db->order_by('ta.id', 'ASC');
        $this->db->where('ta.session_id', get_session_id());
        if (!empty($branch_id)) {
            $this->db->where('c.branch_id', $branch_id);
        }
        return $this->db->get();
    }

    public function teacherAllocationSave($data)
    {
        $arrayData = array(
            'branch_id'     => $this->application_model->get_branch_id(),
            'session_id'    => get_session_id(),
            'class_id'      => $data['class_id'],
            'section_id'    => $data['section_id'],
            'teacher_id'    => $data['staff_id'],
        );
        if (!isset($data['allocation_id'])) {
            if (get_permission('assign_class_teacher', 'is_add')) {
                $this->db->insert('teacher_allocation', $arrayData);
            }
            set_alert('success', translate('information_has_been_saved_successfully'));
        } else {
            if (get_permission('assign_class_teacher', 'is_edit')) {
                $this->db->where('id', $data['allocation_id']);
                $this->db->update('teacher_allocation', $arrayData);
            }
            set_alert('success', translate('information_has_been_updated_successfully'));
        }
        unset($arrayData['teacher_id']);
        $this->db->where($arrayData);
        $this->db->update('subject_assign', array('teacher_id' => $data['staff_id']));
    }

}