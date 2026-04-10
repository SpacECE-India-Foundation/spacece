<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Award_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getList($id='', $row = false)
    {
        $this->db->select('award.*,roles.name as role_name');
        $this->db->from('award');
        $this->db->join('roles', 'roles.id = award.role_id', 'left');
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('session_id', get_session_id());
        if ($row == false) {
            $result = $this->db->get()->result_array();
        } else {
            $this->db->where('award.id', $id);
            $result = $this->db->get()->row_array();
        }
        return $result;
    }


    public function save($data)
    {
        $insertData = array(
            'name'          => $data['award_name'],
            'user_id'       => $data['user_id'],
            'role_id'       => $data['role_id'],
            'gift_item'     => $data['gift_item'],
            'award_amount'  => $data['cash_price'],
            'award_reason'  => $data['award_reason'],
            'given_date'    => date("Y-m-d", strtotime($data['given_date'])),
            'session_id'    => get_session_id(),
            'branch_id'     => $this->application_model->get_branch_id(),
        );
        $award_id = $this->input->post('award_id');
        if (empty($award_id)) {
            $this->db->insert('award', $insertData);
        } else {
            $this->db->where('id', $award_id);
            $this->db->update('award', $insertData);
        }
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
