<?php
defined('BASEPATH') or exit('No direct script access allowed');

class School_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getBranchID()
    {
        if (is_superadmin_loggedin()) {
            return $this->input->get('branch_id', true);
        } else {
            return get_loggedin_branch_id();
        }
    }

    public function branchUpdate($data)
    {
        $arrayBranch = array(
            'name' => $data['branch_name'],
            'school_name' => $data['school_name'],
            'email' => $data['email'],
            'mobileno' => $data['mobileno'],
            'currency' => $data['currency'],
            'symbol' => $data['currency_symbol'],
            'city' => $data['city'],
            'state' => $data['state'],
            'address' => $data['address'],
        );
        $this->db->where('id', $data['brance_id']);
        $this->db->update('branch', $arrayBranch);
    }

    function getSmsConfig()
    {
        if (is_superadmin_loggedin()) {
            $branch_id = $this->input->get('branch_id');
        } else {
            $branch_id = get_loggedin_branch_id();
        }

        $api = array();
        $result = $this->db->get('sms_api')->result();
        foreach ($result as $key => $value) {
            $api[$value->name] = $this->db->where(array('sms_api_id' => $value->id, 'branch_id' => $branch_id))->get('sms_credential')->row_array();
        }
        return $api;
    }

}
