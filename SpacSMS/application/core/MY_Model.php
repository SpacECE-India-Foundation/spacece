<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function hash($password) {
		return hash("sha512", $password . config_item("encryption_key"));
	}
	
	public function uploadImage($role) {
		$return_photo = 'defualt.png';
		$old_user_photo = $this->input->post('old_user_photo');
		if (isset($_FILES["user_photo"]) && !empty($_FILES['user_photo']['name'])) {
			$config['upload_path'] = './uploads/images/' . $role . '/';
			$config['allowed_types'] = 'jpg|png';
			$config['overwrite'] = FALSE;
			$config['encrypt_name'] = TRUE;
			$this->upload->initialize($config);
			if ($this->upload->do_upload("user_photo")) {
	            // need to unlink previous photo
	            if (!empty($old_user_photo)) {
	            	$unlink_path = 'uploads/images/' . $role . '/';
	                if (file_exists($unlink_path . $old_user_photo)) {
	                    @unlink($unlink_path . $old_user_photo);
	                }
	            }
				$return_photo = $this->upload->data('file_name');
			}
		}else{
			if (!empty($old_user_photo)){
				$return_photo = $old_user_photo;
			}
		}
		return $return_photo;
	}

    public function get($table, $where_array = NULL, $single = false, $branch = false, $columns = '*')
    {
        $this->db->select($columns);
        if (is_array($where_array)){
            $this->db->where($where_array);
        }
        if ($branch == true) {
	        if (!is_superadmin_loggedin()) {
	            $this->CI->db->where("branch_id", get_loggedin_branch_id());
	        }
        }
        if ($single == true) {
            $method = 'row_array';
        } else {
            $method = 'result_array';
            $this->db->order_by('id', 'ASC');
        }
        $result = $this->db->get($table)->$method();
		return $result;
    }

    public function getSingle($table, $id = NULL, $single = false)
    {
        if ($single == true) {
            $method = 'row';
        } else {
            $method = 'result';
        }
        $q = $this->db->query("SELECT * FROM " . $table . " WHERE id = " . $this->db->escape($id));
		return $q->$method();
    }
}
