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

class Award extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('award_model');
        $this->load->model('email_model');
    }

    /* award form validation rules */
    protected function award_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('role_id', translate('role'), 'trim|required');
        $this->form_validation->set_rules('user_id', translate('winner'), 'trim|required');
        $this->form_validation->set_rules('award_name', translate('award_name'), 'trim|required');
        $this->form_validation->set_rules('gift_item', translate('gift_item'), 'trim|required');
        $this->form_validation->set_rules('award_reason', translate('award_reason'), 'trim|required');
        $this->form_validation->set_rules('given_date', translate('given_date'), 'trim|required');
        $roleID = $this->input->post('role_id');
        if ($roleID == 7) {
            $this->form_validation->set_rules('class_id', translate('class'), 'trim|required');
        }
    }

    public function index()
    {
        if (!get_permission('award', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            if (get_permission('award', 'is_add')) {
                $roleID = $this->input->post('role_id');
                $this->award_validation();
                if ($this->form_validation->run() !== false) {
                    $data = $this->input->post();
                    $this->award_model->save($data);
                    $this->email_model->sentAward($data);
                    set_alert('success', translate('information_has_been_saved_successfully'));
                    $url    = base_url('award');
                    $array  = array('status' => 'success', 'url' => $url);
                } else {
                    $error = $this->form_validation->error_array();
                    $array = array('status' => 'fail', 'error' => $error);
                }
                echo json_encode($array);
                exit();
            }
        }
        $this->data['awardlist']    = $this->award_model->getList();
        $this->data['title']        = translate('award');
        $this->data['sub_page']     = 'award/index';
        $this->data['main_menu']    = 'award';
        $this->load->view('layout/index', $this->data);
    }

    public function delete($id = '')
    {
        if (get_permission('award', 'is_delete')) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $this->db->where('id', $id);
            $this->db->delete('award');
        }
    }

    public function edit($id = '')
    {
        if (!get_permission('award', 'is_edit')) {
            access_denied();
        }
        if ($_POST) {
            $this->award_validation();
            if ($this->form_validation->run() !== false) {
                $data = $this->input->post();
                $this->award_model->save($data);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url    = base_url('award');
                $array  = array('status' => 'success', 'url' => $url, 'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['award']        = $this->award_model->getList($id, true);
        $this->data['title']        = translate('award');
        $this->data['sub_page']     = 'award/edit';
        $this->data['main_menu']    = 'award';
        $this->load->view('layout/index', $this->data);
    }
}
