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

class Payroll extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll_model');
        $this->load->model('email_model');
    }

    public function index()
    {
        if (!get_permission('salary_payment', 'is_view')) {
            access_denied();
        }
        if (isset($_POST['search'])) {
            $month_year = $this->input->post('month_year');
            $staff_role = $this->input->post('staff_role');
            $branch_id = $this->application_model->get_branch_id();
            $this->data['month'] = date("m", strtotime($month_year));
            $this->data['year'] = date("Y", strtotime($month_year));
            $this->data['stafflist'] = $this->payroll_model->getEmployeePaymentList($branch_id, $staff_role, $this->data['month'], $this->data['year']);
        }
        $this->data['sub_page'] = 'payroll/salary_payment';
        $this->data['main_menu'] = 'payroll';
        $this->data['title'] = translate('payroll');
        $this->load->view('layout/index', $this->data);
    }

    // add staff salary payslip in database
    public function create($id = '', $month = '', $year = '')
    {
        if (!get_permission('salary_payment', 'is_add')) {
            access_denied();
        }
        // check student restrictions
        $this->app_lib->check_branch_restrictions('staff', $id);
        // save all information related to salary
        if (isset($_POST['paid'])) {
            $post = $this->input->post();
            $response = $this->payroll_model->save_payslip($post);
            if ($response['status'] == 'success') {
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect($response['uri']);
            } else {
                set_alert('error', "This Month Salary Already Paid !");
                redirect(base_url('payroll'));
            }
        }
        $this->data['month'] = $month;
        $this->data['year'] = $year;
        $this->data['staff'] = $this->payroll_model->getEmployeePayment($id, $this->data['month'], $this->data['year']);
        $this->data['payvia_list'] = $this->app_lib->getSelectList('payment_types');
        $this->data['sub_page'] = 'payroll/create';
        $this->data['main_menu'] = 'payroll';
        $this->data['title'] = translate('payroll');
        $this->load->view('layout/index', $this->data);
    }

    // view staff salary payslip
    public function invoice($id = '', $hash = '')
    {
        if (!get_permission('salary_payment', 'is_view')) {
            access_denied();
        }
        check_hash_restrictions('payslip', $id, $hash);
        $this->data['salary'] = $this->payroll_model->getInvoice($id);
        $this->data['sub_page'] = 'payroll/invoice';
        $this->data['main_menu'] = 'payroll';
        $this->data['title'] = translate('payroll');
        $this->load->view('layout/index', $this->data);
    }

    /* staff template form validation rules */
    protected function template_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('template_name', translate('salary_grade'), 'required');
        $this->form_validation->set_rules('basic_salary', translate('basic_salary'), 'required|numeric');
    }

    // add staff salary template
    public function salary_template()
    {
        if (!get_permission('salary_template', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            if (get_permission('salary_template', 'is_add')) {
                // validate inputs
                $this->template_validation();
                if ($this->form_validation->run() == true) {
                    $overtime_rate = (empty($_POST['overtime_rate']) ? 0 : $_POST['overtime_rate']);
                    // save salary template info
                    $insertData = array(
                        'branch_id' => $this->application_model->get_branch_id(),
                        'name' => $this->input->post('template_name'),
                        'basic_salary' => $this->input->post('basic_salary'),
                        'overtime_salary' => $overtime_rate,
                    );
                    $this->db->insert('salary_template', $insertData);
                    $template_id = $this->db->insert_id();

                    // save all allowance info
                    $allowances = $this->input->post('allowance');
                    foreach ($allowances as $key => $value) {
                        if ($value["name"] != "" && $value["amount"] != "") {
                            $insertAllowance = array(
                                'salary_template_id' => $template_id,
                                'name' => $value["name"],
                                'amount' => $value["amount"],
                                'type' => 1,
                            );
                            $this->db->insert('salary_template_details', $insertAllowance);
                        }
                    }

                    // save all deduction info
                    $deductions = $this->input->post('deduction');
                    foreach ($deductions as $key => $value) {
                        if ($value["name"] != "" && $value["amount"] != "") {
                            $insertDeduction = array(
                                'salary_template_id' => $template_id,
                                'name' => $value["name"],
                                'amount' => $value["amount"],
                                'type' => 2,
                            );
                            $this->db->insert('salary_template_details', $insertDeduction);
                        }
                    }
                    $url = base_url('payroll/salary_template');
                    $array = array('status' => 'success', 'url' => $url, 'error' => '');
                    set_alert('success', translate('information_has_been_saved_successfully'));
                }else{
                    $error = $this->form_validation->error_array();
                    $array = array('status' => 'fail', 'url' => '', 'error' => $error);
                }
                echo json_encode($array);
                exit();
            }
        }
        $this->data['title'] = translate('payroll');
        $this->data['sub_page'] = 'payroll/salary_templete';
        $this->data['main_menu'] = 'payroll';
        $this->load->view('layout/index', $this->data);
    }

    // salary template update by id
    public function salary_template_edit($id)
    {
        if (!get_permission('salary_template', 'is_edit')) {
            access_denied();
        }

        // Check branch restrictions
        $this->app_lib->check_branch_restrictions('salary_template', $id);
        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $this->template_validation();
            if ($this->form_validation->run() == true) {
                $template_id = $this->input->post('salary_template_id');
                $overtime_rate = (empty($_POST['overtime_rate']) ? 0 : $_POST['overtime_rate']);
                // update salary template info
                $insertData = array(
                    'name' => $this->input->post('template_name'),
                    'basic_salary' => $this->input->post('basic_salary'),
                    'overtime_salary' => $overtime_rate,
                    'branch_id' => $branchID,
                );
                $this->db->where('id', $template_id);
                $this->db->update('salary_template', $insertData);

                // update all allowance info
                $allowances = $this->input->post('allowance');
                foreach ($allowances as $key => $value) {
                    if ($value["name"] != "" && $value["amount"] != "") {
                        $insertAllowance = array(
                            'salary_template_id' => $template_id,
                            'name' => $value["name"],
                            'amount' => $value["amount"],
                            'type' => 1,
                        );

                        if (isset($value["old_allowance_id"])) {
                            $this->db->where('id', $value["old_allowance_id"]);
                            $this->db->update('salary_template_details', $insertAllowance);
                        } else {
                            $this->db->insert('salary_template_details', $insertAllowance);
                        }
                    }
                }

                // update all deduction info
                $deductions = $this->input->post('deduction');
                foreach ($deductions as $key => $value) {
                    if ($value["name"] != "" && $value["amount"] != "") {
                        $insertDeduction = array(
                            'salary_template_id' => $template_id,
                            'name' => $value["name"],
                            'amount' => $value["amount"],
                            'type' => 2,
                        );

                        if (isset($value["old_deduction_id"])) {
                            $this->db->where('id', $value["old_deduction_id"]);
                            $this->db->update('salary_template_details', $insertDeduction);
                        } else {
                            $this->db->insert('salary_template_details', $insertDeduction);
                        }
                    }
                }

                $url = base_url('payroll/salary_template');
                $array = array('status' => 'success', 'url' => $url, 'error' => '');
                set_alert('success', translate('information_has_been_updated_successfully'));
            }else{
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }

        $this->data['template_id'] = $id;
        $this->data['allowances'] = $this->payroll_model->get('salary_template_details', array('type' => 1, 'salary_template_id' => $id));
        $this->data['deductions'] = $this->payroll_model->get('salary_template_details', array('type' => 2, 'salary_template_id' => $id));
        $this->data['template'] = $this->app_lib->getTable('salary_template', array('t.id' => $id), true);
        $this->data['title'] = translate('payroll');
        $this->data['sub_page'] = 'payroll/salary_templete_edit';
        $this->data['main_menu'] = 'payroll';
        $this->load->view('layout/index', $this->data);
    }

    // delete salary template from database
    public function salary_template_delete($id)
    {
        if (!get_permission('salary_template', 'is_delete')) {
            access_denied();
        }
        // Check student restrictions
        $this->app_lib->check_branch_restrictions('salary_template', $id);
        $this->db->where('salary_template_id', $id);
        $this->db->delete('salary_template_details');
        $this->db->where('id', $id);
        $this->db->delete('salary_template');
    }

    // staff salary allocation
    public function salary_assign()
    {
        if (!get_permission('salary_assign', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if (isset($_POST['search'])) {
            $staff_role = $this->input->post('staff_role');
            $designation_id = $this->input->post('designation_id');
            $this->data['stafflist'] = $this->payroll_model->getEmployeeList($branchID, $staff_role, $designation_id);
        }
        if (isset($_POST['assign'])) {
            if (!get_permission('salary_assign', 'is_add')) {
                access_denied();
            }
            $stafflist = $this->input->post('stafflist');
            if (count($stafflist)) {
                foreach ($stafflist as $key => $value) {
                    $template_id = $value['template_id'];
                    if (empty($template_id)) {
                        $template_id = 0;
                    }
                    $this->db->where('id', $value['id']);
                    $this->db->update('staff', array('salary_template_id' => $template_id));
                }
            }
            set_alert('success', translate('information_has_been_saved_successfully'));
            redirect(base_url('payroll/salary_assign'));
        }
        
        $this->data['title'] = translate('payroll');
        $this->data['designationlist'] = $this->app_lib->getSelectByBranch('staff_designation', $branchID);
        $this->data['templatelist'] = $this->app_lib->getSelectByBranch('salary_template', $branchID);
        $this->data['sub_page'] = 'payroll/salary_assign';
        $this->data['main_menu'] = 'payroll';
        $this->load->view('layout/index', $this->data);
    }

    // employees salary statement list
    public function salary_statement()
    {
        if (!get_permission('salary_summary_report', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        if ($_POST) {
            $staffID = '';
            if (!get_permission('salary_payment', 'is_add')) {
                $staffID = get_loggedin_user_id();
            }
            $this->data['month'] = date("m", strtotime($this->input->post('month_year')));
            $this->data['year'] = date("Y", strtotime($this->input->post('month_year')));
            $this->data['payslip'] = $this->payroll_model->get_summary($branchID, $this->data['month'], $this->data['year'], $staffID);
        }
        $this->data['title'] = translate('payroll');
        $this->data['sub_page'] = 'payroll/salary_statement';
        $this->data['main_menu'] = 'payroll_reports';
        $this->load->view('layout/index', $this->data);
    }

    public function payslipPrint()
    {
        if (!get_permission('salary_summary_report', 'is_view')) {
            ajax_access_denied();
        }
        if ($_POST) {
            $this->data['payslip_array'] = $this->input->post('payslip_id');
            echo $this->load->view('payroll/payslipPrint', $this->data, true);
        }  
    }
}
