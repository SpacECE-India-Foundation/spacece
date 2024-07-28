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

class Sessions extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /* form validation rules */
    protected function rules()
    {
        $rules = array(
            array(
                'field' => 'session',
                'label' => 'Session',
                'rules' => 'trim|required|callback_unique_name',
            ),
        );
        return $rules;
    }

    public function index()
    {
        if (is_superadmin_loggedin()) {
            if (isset($_POST['save'])) {
                $this->form_validation->set_rules($this->rules());
                if ($this->form_validation->run() == true) {
                    $this->save($this->input->post());
                    set_alert('success', translate('information_has_been_saved_successfully'));
                    redirect(base_url('sessions'));
                }
            }
            $this->data['title'] = translate('session_settings');
            $this->data['sub_page'] = 'sessions/index';
            $this->data['main_menu'] = 'settings';
            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    public function set_academic($action = '')
    {
        if (is_loggedin()) {
            $this->session->set_userdata('set_session_id', $action);
            if (!empty($_SERVER['HTTP_REFERER'])) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(base_url('dashboard'), 'refresh');
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    /* academic sessions information are prepared and stored in the database here */
    public function edit()
    {
        if ($_POST) {
            if (!is_superadmin_loggedin()) {
               ajax_access_denied(); 
            }
            $this->form_validation->set_rules($this->rules());
            if ($this->form_validation->run() == true) {
                $this->save($this->input->post());
                set_alert('success', translate('information_has_been_updated_successfully'));
                $array = array('status' => 'success');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function delete($id = '')
    {
        if (is_superadmin_loggedin())
        {
            $this->db->where('id', $id);
            $this->db->delete('schoolyear');
        }
    }

    /* unique academic sessions name verification is done here */
    public function unique_name($year)
    {
        $schoolyearID = $this->input->post('schoolyear_id');
        if (!empty($schoolyearID)) {
            $this->db->where_not_in('id', $schoolyearID);
        }
        $this->db->where(array('school_year' => $year));
        $uniform_row = $this->db->get('schoolyear')->num_rows();
        if ($uniform_row == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        }
    }

    protected function save($data)
    {
        $arrayYear = array(
            'school_year' => $data['session'],
            'created_by' => get_loggedin_user_id(),
        );
        if (!isset($data['schoolyear_id'])) {
            $this->db->insert('schoolyear', $arrayYear);
        } else {
            $this->db->where('id', $data['schoolyear_id']);
            $this->db->update('schoolyear', $arrayYear);
        }
    }
}
