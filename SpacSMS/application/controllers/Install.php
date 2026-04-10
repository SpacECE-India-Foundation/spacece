<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom Diagnostic Management System
 * @version : 2.0
 * @developed by : techtune
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/techtune
 * @filename : Install.php
 */

class Install extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('install_model', '_install');
        if ($this->config->item('installed')) {
            redirect(site_url('authentication'));
        }
    }

    public function index()
    {
        $this->data['step'] = 1;
        if ($_POST) {
            if ($this->input->post('step') == 2) {
                $this->data['step'] = 2;
            }
			
            if ($this->input->post('step') == 3) {
                $this->data['step'] = 2;
                // Validating the hostname, the database name and the username. The password is optional
                $this->form_validation->set_rules('purchase_username', 'Envato Username', 'trim|required');
                $this->form_validation->set_rules('purchase_code', 'Purchase Code', 'trim|required|callback_purchase_validation');
                if ($this->form_validation->run() == true) {
					$file = APPPATH.'config/purchase_key.php';
					$text = json_encode(array($this->input->post('purchase_username'), $this->input->post('purchase_code')));
					@chmod($file, FILE_WRITE_MODE);
					write_file($file, $text);
					$this->data['step'] = 3;
                }
            }

            if ($this->input->post('step') == 4) {
                $this->data['step'] = 3;
                // Validating the hostname, the database name and the username. The password is optional
                $this->form_validation->set_rules('hostname', 'Hostname', 'trim|required');
                $this->form_validation->set_rules('database', 'Database', 'trim|required');
                $this->form_validation->set_rules('username', 'Username', 'trim|required');
                if ($this->form_validation->run() == true) {
                    $hostname = $this->input->post('hostname');
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $database = $this->input->post('database');
                    // Connect to the database
                    $link = mysqli_connect($hostname, $username, $password, $database);
                    if (!$link) {
                        $this->data['mysql_error'] = "Error: Unable to connect to MySQL Database." . PHP_EOL;
                    } else {
                        // Write the new database.php file
                        if ($this->_install->write_database_config($this->input->post())) {
                            $this->data['step'] = 4;
                        }
                        // Close the connection
                        mysqli_close($link);
                    }
                }
            }

            if ($this->input->post('step') == 5) {
                // Validating the diagnostic name, superadmin name, superadmin email, login username, login password
                $this->form_validation->set_rules('school_name', 'School Name', 'trim|required');
                $this->form_validation->set_rules('sa_name', 'Superadmin Name', 'trim|required');
                $this->form_validation->set_rules('sa_email', 'Superadmin Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('sa_password', 'Superadmin Password', 'trim|required');
                $this->form_validation->set_rules('timezone', 'Timezone', 'trim|required');
                if ($this->form_validation->run() == true) {
					$purchaseCode = $this->purchase_code_verification();
					if ( isset($purchaseCode->status) && $purchaseCode->status ) {
						if (!empty($purchaseCode->sql)) {
							$encryption_key = bin2hex(substr(md5(rand()), 0, 10));
							$staff_id = substr(md5(rand() . microtime() . time() . uniqid()), 3, 7);
							$this->load->database();
							// Execute a multi query
							if (mysqli_multi_query($this->db->conn_id, $purchaseCode->sql)) {
								$this->_install->clean_up_db_query();
								$schoolName = $this->input->post('school_name');
								$timezone = $this->input->post('timezone');
								$email = $this->input->post('sa_email');
								$password = $this->input->post('sa_password');
								// Superadmin add in the database
								$staff_data = array(
									'staff_id' => $staff_id,
									'name' => $this->input->post('sa_name'),
									'joining_date' => date('Y-m-d'),
									'email' => $email,
								);
								$this->db->insert('staff', $staff_data);
								$insert_id = $this->db->insert_id();

								// Save superadmin login credential information in the database
								$credential_data = array(
									'user_id' => $insert_id,
									'username' => $email,
									'password' => $this->_install->pass_hashed($password),
									'role' => 1,
									'active' => 1,
								);

								if ($this->db->insert('login_credential', $credential_data)) {
									// global settings DB update
									$this->db->where('id', 1);
									$this->db->update('global_settings', array(
										'institute_name' => $schoolName,
										'timezone' => $timezone,
									));
									// Write the new autoload.php file
									$this->_install->update_autoload_installed();
									// Write the new routes.php file
									$this->_install->write_routes_config();
									$this->_install->update_config_installed($encryption_key);
								}
							}
							$this->data['step'] = 5;
						} else {
							$this->data['step'] = 2;
							$this->data['purchase_error'] = "SQL not found";
						}
					} else {
						$this->data['step'] = 2;
						$this->data['purchase_error'] = $purchaseCode->message;
					}
                } else {
                    $this->data['step'] = 4;
                }
            }
        }
        $this->load->view('install/index', $this->data);
    }
	
    public function purchase_validation($purchase_code)
    {
        if($purchase_code != "") {
			$array['purchase_username'] = $this->input->post('purchase_username');
			$array['purchase_code'] = $purchase_code;
			$apiResult = $this->_install->call_CurlApi($array);
			if ($apiResult->status == false) {
				$this->form_validation->set_message("purchase_validation", $apiResult->message);
				return false;
			}
			return true;
		}
    }
	
	function purchase_code_verification()
	{
        $file = APPPATH.'config/purchase_key.php';
        @chmod($file, FILE_WRITE_MODE);
        $purchase = file_get_contents($file);
        $purchase = json_decode($purchase);	
        $array = array();
        if(is_array($purchase)) {
            $array['purchase_username'] = trim($purchase[0]);
            $array['purchase_code'] = trim($purchase[1]);
        }
		$array['sys_install'] = true;
		$apiResult = $this->_install->call_CurlApi($array);
		return $apiResult;
	}
	
}
