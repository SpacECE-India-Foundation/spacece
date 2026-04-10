<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Crud_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // check employee access permission
    public function block_user($user_role)
    {
        if (empty($user_role)) {
            return false;
        } else {
            if (is_superadmin_loggedin()) {
                $blockuser = array('admin', 'teacher', 'librarian', 'accountant');
            } elseif (is_admin_loggedin()) {
                $blockuser = array('teacher', 'librarian', 'accountant');
            }
            if (in_array($user_role, $blockuser)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
