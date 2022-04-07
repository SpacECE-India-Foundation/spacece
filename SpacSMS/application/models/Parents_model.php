<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Parents_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // moderator parents all information
    public function save($data)
    {
        $inser_data1 = array(
            'branch_id' => $this->application_model->get_branch_id(),
            'name' => $data['name'],
            'relation' => $data['relation'],
            'father_name' => $data['father_name'],
            'mother_name' => $data['mother_name'],
            'occupation' => $data['occupation'],
            'income' => $data['income'],
            'education' => $data['education'],
            'email' => $data['email'],
            'mobileno' => $data['mobileno'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'photo' => $this->uploadImage('parent'),
            'facebook_url' => $data['facebook'],
            'linkedin_url' => $data['linkedin'],
            'twitter_url' => $data['twitter'],
        );
        $inser_data2 = array('username' => $data["email"]);
        if (!isset($data['parent_id']) && empty($data['parent_id'])) {
            // save employee information in the database
            $this->db->insert('parent', $inser_data1);
            $parent_id = $this->db->insert_id();
            // save employee login credential information in the database
            $inser_data2['role'] = 6;
            $inser_data2['active'] = 1;
            $inser_data2['user_id'] = $parent_id;
            $inser_data2['password'] = $this->app_lib->pass_hashed($data["password"]);
            $this->db->insert('login_credential', $inser_data2);
            return $parent_id;
        } else {
            $this->db->where('id', $data['parent_id']);
            $this->db->update('parent', $inser_data1);
            // update login credential information in the database
            $this->db->where(array('role' => 6, 'user_id' => $data['parent_id']));
            $this->db->update('login_credential', $inser_data2);
        }

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getSingleParent($id)
    {
        $this->db->select('parent.*,login_credential.role as role_id,login_credential.active,login_credential.username,login_credential.id as login_id, roles.name as role');
        $this->db->from('parent');
        $this->db->join('login_credential', 'login_credential.user_id = parent.id and login_credential.role = "6"', 'inner');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        $this->db->where('parent.id', $id);
        if (!is_superadmin_loggedin()) {
            $this->db->where('parent.branch_id', get_loggedin_branch_id());
        }
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            show_404();
        }
        return $query->row_array();
    }

    public function childsResult($parent_id)
    {
        $this->db->select('s.id,s.photo, CONCAT(s.first_name, " ", s.last_name) as fullname,c.name as class_name,se.name as section_name');
        $this->db->from('enroll as e');
        $this->db->join('student as s', 'e.student_id = s.id', 'inner');
        $this->db->join('login_credential as l', 'l.user_id = s.id and l.role = 7', 'inner');
        $this->db->join('class as c', 'e.class_id = c.id', 'left');
        $this->db->join('section as se', 'e.section_id=se.id', 'left');
        $this->db->where('s.parent_id', $parent_id);
        $this->db->where('l.active', 1);
        return $this->db->get()->result_array();
    }

    // get parent all details
    public function getParentList($branchID = null, $active = 1)
    {
        $this->db->select('parent.*,login_credential.active as active');
        $this->db->from('parent');
        $this->db->join('login_credential', 'login_credential.user_id = parent.id and login_credential.role = "6"', 'inner');
        $this->db->where('login_credential.active', $active);
        if (!empty($branchID)) {
           $this->db->where('parent.branch_id', $branchID);
        }
        $this->db->order_by('parent.id', 'ASC');
        return $this->db->get()->result();
    }
}
