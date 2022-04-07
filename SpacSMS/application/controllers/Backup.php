<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom school management system
 * @version : 2.0
 * @developed by : RamomCoder
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/RamomCoder
 * @filename : Accounting.php
 * @copyright : Reserved RamomCoders Team
 */

class Backup extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helpers('download');
    }

    public function index()
    {
        if (!get_permission('backup', 'is_view')) {
            access_denied();
        }
        $this->data['sub_page'] = 'database_backup/index';
        $this->data['main_menu'] = 'settings';
        $this->data['title'] = translate('database_backup');
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->load->view('layout/index', $this->data);
    }

    /* create database backup */
    public function create()
    {
        if (!get_permission('backup', 'is_add')) {
            access_denied();
        }
        $this->load->dbutil();
        $options = array(
            'format' => 'zip', // gzip, zip, txt
            'add_drop' => true, // Whether to add DROP TABLE statements to backup file
            'add_insert' => true, // Whether to add INSERT data to backup file
            'filename' => 'DB-backup_' . date('Y-m-d_H-i'),
        );

        $backup = $this->dbutil->backup($options);
        if (!write_file('./uploads/db_backup/DB-backup_' . date('Y-m-d_H-i') . '.zip', $backup)) {
            set_alert('error', translate('database_backup_failed'));
        } else {
            set_alert('success', translate('database_backup_completed'));
        }
        redirect(base_url('backup'));
    }

    public function download()
    {
        $file = $this->input->get('file');
        $this->data = file_get_contents('./uploads/db_backup/' . $file);
        force_download($file, $this->data);
        redirect(base_url('backup'));
    }

    public function delete_file($file)
    {
        if (!get_permission('backup', 'is_delete')) {
            access_denied();
        }
        unlink('./uploads/db_backup/' . $file);
    }

    public function restore_file()
    {
        if (!get_permission('backup_restore', 'is_add')) {
            ajax_access_denied();
        }
		if (isset($_FILES["uploaded_file"]) && empty($_FILES['uploaded_file']['name'])) {
			$this->form_validation->set_rules('uploaded_file', translate('file_upload'), 'required');
		} else {
			$this->form_validation->set_rules('uploaded_file', translate('file_upload'), 'trim');
		}
        if ($this->form_validation->run() == true) {
            $this->load->helper('unzip');
            $config['upload_path'] = './uploads/db_temp/';
            $config['allowed_types'] = 'zip';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('uploaded_file')) {
                $error = $this->upload->display_errors('', ' ');
                set_alert('error', $error);
                redirect(base_url('backup'));
            } else {
                $data = array('upload_data' => $this->upload->data());
                $backup = "uploads/db_temp/" . $data['upload_data']['file_name'];

            }
            if (!unzip($backup, "uploads/db_temp/", true, true)) {
                set_alert('error', "Backup Restore Error");
                redirect(base_url('backup'));
            } else {
                $this->load->dbforge();
                $backup = str_replace('.zip', '', $backup);
                $file_content = file_get_contents($backup . ".sql");
                $this->db->query('USE ' . $this->db->database . ';');
                foreach (explode(";\n", $file_content) as $sql) {
                    $sql = trim($sql);
                    if ($sql) {
                        $this->db->query($sql);
                    }
                }
                set_alert('success', "Backup Restore Successfully");
            }
            unlink($backup . '.sql');
            unlink($backup . '.zip');
            $array  = array('status' => 'success',);
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail', 'error' => $error);
        }
        echo json_encode($array);
    }
}
