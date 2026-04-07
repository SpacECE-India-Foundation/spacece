<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Live_class_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getList($branch_id = '')
    {
        $this->db->select('live_class.*,class.name as class_name,staff.name as staffname,branch.name as branchname');
        $this->db->from('live_class');
        $this->db->join('branch', 'branch.id = live_class.branch_id', 'left');
        $this->db->join('class', 'class.id = live_class.class_id', 'left');
        $this->db->join('staff', 'staff.id = live_class.created_by', 'left');
        if (!empty($branch_id)) {
            $this->db->where('live_class.branch_id', $branch_id);
        }
        if (!is_superadmin_loggedin() && !is_admin_loggedin()) {
            $this->db->where('live_class.created_by', get_loggedin_user_id());
        }
        $this->db->order_by('live_class.id', 'ASC');
        $result = $this->db->get()->result_array();
        foreach ($result as $key => $value) {
            $result[$key]['section_details'] = $this->getSectionDetails($value['section_id']);
        }
        return $result;
    }

    function getSectionDetails($data)
    {
        $array = json_decode($data, true);
        $nameList = '';
        if (json_last_error() == JSON_ERROR_NONE) {
            foreach ($array as $key => $value) {
                $nameList .= get_type_name_by_id('section', $value) . '<br>';
            }
        }
        return $nameList;
    }

    function save($data)
    {
        $arrayLive = array(
            'branch_id' => $this->application_model->get_branch_id(),
            'title' => $data['title'],
            'meeting_id' => $data['zoom_meeting_id'],
            'meeting_password' => $data['zoom_meeting_password'],
            'class_id' => $data['class_id'],
            'section_id' => json_encode($data['section']),
            'remarks' => $data['remarks'],
            'date' => date("Y-m-d", strtotime($data['date'])),
            'start_time' => date("H:i", strtotime($data['time_start'])),
            'end_time' => date("H:i", strtotime($data['time_end'])),
            'created_by' => get_loggedin_user_id(),
        );
        if (!isset($data['live_id'])) {
            $this->db->insert('live_class', $arrayLive);
        } else {
            $this->db->where('id', $data['live_id']);
            $this->db->update('live_class', $arrayLive);
        } 
    }
}