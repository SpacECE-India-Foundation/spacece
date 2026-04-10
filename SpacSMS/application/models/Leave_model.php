<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Leave_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    // get leave list
    public function getLeaveList($where = '', $single = false)
    {
        $this->db->select('la.*,c.name as category_name,r.name as role');
        $this->db->from('leave_application as la');
        $this->db->join('leave_category as c', 'c.id = la.category_id', 'left');
        $this->db->join('roles as r', 'r.id = la.role_id', 'left');
        $this->db->where('session_id', get_session_id());
        if (!empty($where)) {
            $this->db->where($where);
        }
        if ($single == false) {
            $this->db->order_by('la.id', 'DESC');
            return $this->db->get()->result_array();
        } else {
            return $this->db->get()->row_array();
        }
    }
}
