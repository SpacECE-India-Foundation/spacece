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

class Branch extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('branch_model');
    }

    /* branch all data are prepared and stored in the database here */
    public function index()
    {
        if (is_superadmin_loggedin()) {
            if ($this->input->post('submit') == 'save') {
                $this->form_validation->set_rules('branch_name', translate('branch_name'), 'required|callback_unique_name');
                $this->form_validation->set_rules('school_name', translate('school_name'), 'required');
                $this->form_validation->set_rules('email', translate('email'), 'required|valid_email');
                $this->form_validation->set_rules('mobileno', translate('mobile_no'), 'required');
                $this->form_validation->set_rules('currency', translate('currency'), 'required');
                $this->form_validation->set_rules('currency_symbol', translate('currency_symbol'), 'required');
                if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                    $response = $this->branch_model->save($post);
                    if ($response) {
                        set_alert('success', translate('information_has_been_saved_successfully'));
                    }
                    redirect(base_url('branch'));
                } else {
                    $this->data['validation_error'] = true;
                }
            }
            $this->data['title'] = translate('branch');
            $this->data['sub_page'] = 'branch/add';
            $this->data['main_menu'] = 'branch';
            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /* branch information update here */
    public function edit($id = '')
    {
        if (is_superadmin_loggedin()) {
            if ($this->input->post('submit') == 'save') {
                $this->form_validation->set_rules('branch_name', translate('branch_name'), 'required|callback_unique_name');
                $this->form_validation->set_rules('school_name', translate('school_name'), 'required');
                $this->form_validation->set_rules('email', translate('email'), 'required|valid_email');
                $this->form_validation->set_rules('mobileno', translate('mobile_no'), 'required');
                $this->form_validation->set_rules('currency', translate('currency'), 'required');
                $this->form_validation->set_rules('currency_symbol', translate('currency_symbol'), 'required');
                if ($this->form_validation->run() == true) {
                    $post = $this->input->post();
                    $response = $this->branch_model->save($post, $id);
                    if ($response) {
                        set_alert('success', translate('information_has_been_updated_successfully'));
                    }
                    redirect(base_url('branch'));
                }
            }

            $this->data['data'] = $this->branch_model->getSingle('branch', $id, true);
            $this->data['title'] = translate('branch');
            $this->data['sub_page'] = 'branch/edit';
            $this->data['main_menu'] = 'branch';
            $this->load->view('layout/index', $this->data);
        } else {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
    }

    /* delete information */
    public function delete_data($id = '')
    {
        if (is_superadmin_loggedin()) {
            $this->db->where('id', $id);
            $this->db->delete('branch');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    /* unique valid branch name verification is done here */
    public function unique_name($name)
    {
        $branch_id = $this->input->post('branch_id');
        if (!empty($branch_id)) {
            $this->db->where_not_in('id', $branch_id);
        }
        $this->db->where('name', $name);
        $name = $this->db->get('branch')->num_rows();
        if ($name == 0) {
            return true;
        } else {
            $this->form_validation->set_message("unique_name", translate('already_taken'));
            return false;
        }
    }
}
