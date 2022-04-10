<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Authentication_model extends MY_Model
{
    
    // checking login credential
    public function login_credential($username, $password)
    {
        $this->db->select('*');
        $this->db->from('login_credential');
        $this->db->where('username', $username);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $verify_password = $this->app_lib->verify_password($password, $query->row()->password);
            if ($verify_password) {
                return $query->row();
            }
        }
        return false;
    }


    // password forgotten
    public function lose_password($username)
    {
        if (!empty($username)) {
            $this->db->select('*');
            $this->db->from('login_credential');
            $this->db->where('username', $username);
            $this->db->limit(1);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $login_credential = $query->row();
                $getUser = $this->application_model->getUserNameByRoleID($login_credential->role, $login_credential->user_id);
                $key = hash('sha512', $login_credential->role . $login_credential->username . app_generate_hash());
                $query = $this->db->get_where('reset_password', array('login_credential_id' => $login_credential->id));
                if ($query->num_rows() > 0) {
                    $this->db->where('login_credential_id', $login_credential->id);
                    $this->db->delete('reset_password');
                }
                $arrayReset = array(
                    'key' => $key,
                    'login_credential_id' => $login_credential->id,
                    'username' => $login_credential->username,
                );
                $this->db->insert('reset_password', $arrayReset);
                // send email for forgot password
                $this->load->model('email_model');
                $arrayData = array(
                    'role' => $login_credential->role, 
                    'branch_id' => $getUser['branch_id'], 
                    'username' => $login_credential->username, 
                    'name' => $getUser['name'], 
                    'reset_url' => base_url('authentication/pwreset?key=' . $key), 
                    'email' => $getUser['email'], 
                );
                $this->email_model->sentForgotPassword($arrayData);
                return true;
            }
        }
        return false;
    }
}
