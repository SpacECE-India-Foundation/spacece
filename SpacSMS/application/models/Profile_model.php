<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Profile_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // moderator staff all information
    public function staffUpdate($data)
    {
        $update_data = array(
            'name' => $data['name'],
            'sex' => $data['sex'],
            'religion' => $data['religion'],
            'blood_group' => $data['blood_group'],
            'birthday' => $data["birthday"],
            'mobileno' => $data['mobile_no'],
            'present_address' => $data['present_address'],
            'permanent_address' => $data['permanent_address'],
            'photo' => $this->uploadImage('staff'),
            'email' => $data['email'],
            'facebook_url' => $data['facebook'],
            'linkedin_url' => $data['linkedin'],
            'twitter_url' => $data['twitter'],
        );
        if (is_admin_loggedin()) {
            $update_data['joining_date'] = date("Y-m-d", strtotime($data['joining_date']));
            $update_data['designation'] = $data['designation_id'];
            $update_data['department'] = $data['department_id'];
            $update_data['qualification'] = $data['qualification'];
        }
        // UPDATE ALL INFORMATION IN THE DATABASE
        $this->db->where('id', get_loggedin_user_id());
        $this->db->update('staff', $update_data);

        // UPDATE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
        $this->db->where('user_id', get_loggedin_user_id());
        $this->db->where_not_in('role', array(6,7));
        $this->db->update('login_credential', array('username' => $data['email']));
    }

    public function studentUpdate($data)
    {
        $update_data1 = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender' => $data['gender'],
            'birthday' => date("Y-m-d", strtotime($data['birthday'])),
            'religion' => $data['religion'],
            'caste' => $data['caste'],
            'blood_group' => $data['blood_group'],
            'mother_tongue' => $data['mother_tongue'],
            'current_address' => $data['current_address'],
            'permanent_address' => $data['permanent_address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'mobileno' => $data['mobileno'],
            'email' => $data['email'],
            'photo' => $this->uploadImage('student'),
        );

        // update student all information in the database
        $this->db->where('id', get_loggedin_user_id());
        $this->db->update('student', $update_data1);

        // update login credential information in the database
        $this->db->where('user_id', get_loggedin_user_id());
        $this->db->where('role', 7);
        $this->db->update('login_credential', array('username' => $data['email']));
    }

    // moderator staff all information
    public function parentUpdate($data)
    {
        $update_data = array(
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

        // UPDATE ALL INFORMATION IN THE DATABASE
        $this->db->where('id', get_loggedin_user_id());
        $this->db->update('parent', $update_data);

        // UPDATE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
        $this->db->where('user_id', get_loggedin_user_id());
        $this->db->where('role', 6);
        $this->db->update('login_credential', array('username' => $data['email']));
    }
}
