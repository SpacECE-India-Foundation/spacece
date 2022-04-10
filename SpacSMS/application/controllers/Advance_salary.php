<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom school management system
 * @version : 2.0
 * @developed by : RamomCoder
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/RamomCoder
 * @filename : Advance_salary.php
 * @copyright : Reserved RamomCoders Team
 */

class Advance_salary extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('advancesalary_model');
        $this->load->model('email_model');
    }

    public function index()
    {
        if (!get_permission('advance_salary_manage', 'is_view')) {
            access_denied();
        }
        if (isset($_POST['update'])) {
            if (!get_permission('advance_salary_manage', 'is_add')) {
                access_denied();
            }
            $arrayAdvance = array(
                'issued_by' => get_loggedin_user_id(),
                'paid_date' => date("Y-m-d H:i:s"),
                'status'    => $this->input->post('status'),
                'comments'  => $this->input->post('comments'),
            );
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->update('advance_salary', $arrayAdvance);
            // getting information for send email alert
            $getApplication = $this->db->select('staff_id,amount,deduct_month,year')->where('id', $id)->get('advance_salary')->row();
            $getStaff = $this->db->select('email,name')->where('id', $getApplication->staff_id)->get('staff')->row();
            $arrayAdvance['staff_name']     = $getStaff->name;
            $arrayAdvance['email']          = $getStaff->email;
            $arrayAdvance['amount']         = $getApplication->amount;
            $arrayAdvance['deduct_motnh']   = $getApplication->year . '-' . $getApplication->deduct_month;
            $this->email_model->sentAdvanceSalary($arrayAdvance);

            set_alert('success', translate('information_has_been_updated_successfully'));
            redirect(base_url('advance_salary'));
        }
		
        $month = '';
        $year = '';
        if (isset($_POST['search'])) {
            $month_year = $this->input->post('month_year');
            $month      = date("m", strtotime($month_year));
            $year       = date("Y", strtotime($month_year));
        }
        $branch_id                  = $this->application_model->get_branch_id();
        $this->data['advanceslist'] = $this->advancesalary_model->getAdvanceSalaryList($month, $year, $branch_id);
        $this->data['title']        = translate('advance_salary');
        $this->data['sub_page']     = 'advance_salary/index';
        $this->data['main_menu']    = 'advance_salary';
        $this->load->view('layout/index', $this->data);
    }

    public function save()
    {
        if (!get_permission('advance_salary_manage', 'is_add')) {
            ajax_access_denied();
        }

        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', 'Branch', 'required');
        }
        $this->form_validation->set_rules('staff_role', translate('staff_role'), 'required');
        $this->form_validation->set_rules('staff_id', translate('applicant'), 'required');
        $this->form_validation->set_rules('amount', translate('amount'), 'required|callback_check_salary');
        $this->form_validation->set_rules('month_year', translate('deduct_month'), 'required|callback_check_advance_month');
        if ($this->form_validation->run() == true) {
            $branch_id = $this->application_model->get_branch_id();
            $insertData = array(
                'staff_id'      => $this->input->post('staff_id'),
                'deduct_month'  => date("m", strtotime($this->input->post('month_year'))),
                'year'          => date("Y", strtotime($this->input->post('month_year'))),
                'amount'        => $this->input->post('amount'),
                'reason'        => $this->input->post('reason'),
                'issued_by'     => get_loggedin_user_id(),
                'paid_date'     => date("Y-m-d H:i:s"),
                'status'        => 2,
                'branch_id'     => $branch_id,
            );
            $this->db->insert('advance_salary', $insertData);
            $url = base_url('advance_salary');
            $array = array('status' => 'success', 'url' => $url, 'error' => '');
            set_alert('success', translate('information_has_been_saved_successfully'));
        } else {
            $error = $this->form_validation->error_array();
            $array = array('status' => 'fail', 'url' => '', 'error' => $error);
        }
        echo json_encode($array);
    }

    public function delete($id = '')
    {
        if (get_permission('advance_salary_manage', 'is_delete')) {
            // Check branch restrictions
            $this->app_lib->check_branch_restrictions('advance_salary', $id);
            $this->db->where('id', $id);
            $this->db->delete('advance_salary');
        }
    }

    public function request()
    {
        if (!get_permission('advance_salary_request', 'is_view')) {
            access_denied();
        }
        $month      = '';
        $year       = '';
        $staff_id   = get_loggedin_user_id();
        if (isset($_POST['search'])) {
            $month_year = $this->input->post('month_year');
            $month      = date("m", strtotime($month_year));
            $year       = date("Y", strtotime($month_year));
        }
        $this->data['advanceslist'] = $this->advancesalary_model->getAdvanceSalaryList($month, $year, '', $staff_id);
        $this->data['title']        = translate('advance_salary');
        $this->data['sub_page']     = 'advance_salary/request';
        $this->data['main_menu']    = 'advance_salary';
        $this->load->view('layout/index', $this->data);
    }

    public function request_save()
    {
        if (!get_permission('advance_salary_request', 'is_add')) {
            ajax_access_denied();
        }
        if ($_POST) {
            $this->form_validation->set_rules('amount', translate('amount'), 'required|callback_check_salary');
            $this->form_validation->set_rules('month_year', translate('deduct_month'), 'required|callback_check_advance_month');
            if ($this->form_validation->run() == true) {
                $insertData = array(
                    'staff_id'      => get_loggedin_user_id(),
                    'deduct_month'  => date("m", strtotime($this->input->post('month_year'))),
                    'year'          => date("Y", strtotime($this->input->post('month_year'))),
                    'amount'        => $this->input->post('amount'),
                    'reason'        => $this->input->post('reason'),
                    'branch_id'     => get_loggedin_branch_id(),
                    'status'        => 1,
                );
                $this->db->insert('advance_salary', $insertData);
                $url    = base_url('advance_salary/request');
                $array  = array('status' => 'success', 'url' => $url);
                set_alert('success', translate('information_has_been_saved_successfully'));
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function request_delete($id = '')
    {
        if (get_permission('advance_salary_request', 'is_delete')) {
            $this->db->where('staff_id', get_loggedin_user_id());
            $this->db->where('id', $id);
            $this->db->where('status', 1);
            $this->db->delete('advance_salary');
        }
    }

    public function getRequestDetails()
    {
        if (get_permission('advance_salary_request', 'is_view')) {
            $this->data['salary_id'] = $this->input->post('id');
            $this->load->view('advance_salary/modal_request_details', $this->data);
        }
    }

    // employee salary allocation validation checking
    public function check_salary($amount)
    {
        if ($amount) {
            if ($this->uri->segment(2) == 'request_save') {
                $staff_id = get_loggedin_user_id();
            } else {
                $staff_id = $this->input->post('staff_id');
            }
            $get_salary = $this->advancesalary_model->getBasicSalary($staff_id, $amount);
            if ($get_salary == 1) {
                $this->form_validation->set_message('check_salary', 'This Employee Is Not Allocated Salary !');
                return false;
            } elseif ($get_salary == 2) {
                $this->form_validation->set_message('check_salary', 'Your Advance Amount Exceeds Basic Salary !');
                return false;
            } elseif ($get_salary == 3) {
                return true;
            }
        }
    }

    // verification of payment to employees salary this month
    public function check_advance_month($month)
    {
        $staff_id = $this->input->post('staff_id');
        $getValidation = $this->advancesalary_model->getAdvanceValidMonth($staff_id, $month);
        if ($getValidation == true) {
            return true;
        } else {
            $this->form_validation->set_message('check_advance_month', 'This Month Salary Already Paid Or Requested !');
            return false;
        }
    }
}
