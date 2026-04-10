<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom SSchool Management System
 * @version : 2.0
 * @developed by : RamomCoder
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/RamomCoder
 * @filename : Accounting.php
 */

class Accounting extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('accounting_model');
        $this->load->model('email_model');
        $this->data['headerelements']   = array(
            'css' => array(
                'vendor/daterangepicker/daterangepicker.css',
            ),
            'js' => array(
                'vendor/moment/moment.js',
                'vendor/daterangepicker/daterangepicker.js',
            ),
        );
    }

    /* account form validation rules */
    protected function account_validation()
    {
        if (is_superadmin_loggedin()) {
            $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
        }
        $this->form_validation->set_rules('account_name', translate('account_name'), array('trim','required',array('unique_account_name',
        array($this->accounting_model, 'unique_account_name'))));
        $this->form_validation->set_rules('opening_balance', translate('opening_balance'), 'trim|numeric');
    }

    // add new account for office accounting
    public function index()
    {
        // check access permission
        if (!get_permission('account', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            if (!get_permission('account', 'is_add')) {
                access_denied();
            }
            $this->account_validation();
            if ($this->form_validation->run() !== false) {
                $data = $this->input->post();
                $this->accounting_model->saveAccounts($data);
                set_alert('success', translate('information_has_been_saved_successfully'));
                $url    = $_SERVER['HTTP_REFERER'];
                $array  = array('status' => 'success');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['accountslist'] =  $this->app_lib->getTable('accounts');
        $this->data['sub_page'] = 'accounting/index';
        $this->data['main_menu'] = 'accounting';
        $this->data['title'] = translate('office_accounting');
        $this->load->view('layout/index', $this->data);
    }

    // update existing account if passed id
    public function edit($id = '')
    {
        if (!get_permission('account', 'is_edit')) {
            access_denied();
        }
        if ($_POST) {
            $this->account_validation();
            if ($this->form_validation->run() !== false) {
                $data = $this->input->post();
                $this->accounting_model->saveAccounts($data);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url    = base_url('accounting');
                $array  = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['account'] = $this->app_lib->getTable('accounts', array('t.id' => $id), true);
        $this->data['sub_page'] = 'accounting/edit';
        $this->data['main_menu'] = 'accounting';
        $this->data['title'] = translate('office_accounting');
        $this->load->view('layout/index', $this->data);
    }

    // delete account from database
    public function delete($id = '')
    {
        if (!get_permission('account', 'is_delete')) {
            access_denied();
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->delete('accounts');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('account_id', $id);
            $this->db->delete('transactions');
        }
    }

    // add new voucher head for voucher
    public function voucher_head()
    {
        if ($_POST) {
            if (!get_permission('voucher_head', 'is_add')) {
                access_denied();
            }
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('voucher_head', translate('name'), array('trim', 'required',
            array('unique_voucher_head', array($this->accounting_model, 'unique_voucher_head'))));
            $this->form_validation->set_rules('type', translate('type'), 'trim|required');
            if ($this->form_validation->run() !== false) {
                $arrayHead = array(
                    'branch_id' => $this->application_model->get_branch_id(),
                    'name' => $this->input->post('voucher_head'),
                    'type' => $this->input->post('type'),
                );
                $this->db->insert('voucher_head', $arrayHead);
                set_alert('success', translate('information_has_been_saved_successfully'));
                redirect(current_url());
            }
        }
        $this->data['productlist'] = $this->app_lib->getTable('voucher_head', array('system' => 0));
        $this->data['title'] = translate('office_accounting');
        $this->data['sub_page'] = 'accounting/voucher_head';
        $this->data['main_menu'] = 'accounting';
        $this->load->view('layout/index', $this->data);
    }

    // update existing voucher head if passed id
    public function voucher_head_edit()
    {
        if ($_POST) {
            if (!get_permission('voucher_head', 'is_edit')) {
                ajax_access_denied();
            }
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('voucher_head', translate('name'), array('trim', 'required', array('unique_voucher_head',
            array($this->accounting_model, 'unique_voucher_head'))));
            if ($this->form_validation->run() !== false) {
                $voucher_head_id = $this->input->post('voucher_head_id');
                $arrayHead = array(
                    'name' => $this->input->post('voucher_head'),
                );
                $this->db->where('id', $voucher_head_id);
                $this->db->update('voucher_head', $arrayHead);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url    = base_url('accounting/voucher_head');
                $array  = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function voucherHeadDetails()
    {
        if (get_permission('voucher_head', 'is_edit')) {
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $query = $this->db->get('voucher_head');
            $result = $query->row_array();
            echo json_encode($result);
        }
    }

    // delete voucher head from database
    public function voucher_head_delete($id)
    {
        if (!get_permission('voucher_head', 'is_delete')) {
            access_denied();
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('branch_id', get_loggedin_branch_id());
        }
        $this->db->where('id', $id);
        $this->db->delete('voucher_head');
    }

    // this function is used to add voucher data
    public function voucher_deposit()
    {
        if (!get_permission('deposit', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        $this->data['branch_id'] = $branchID;
        $this->data['voucherlist'] = $this->accounting_model->getVoucherList('deposit');
        $this->data['sub_page'] = 'accounting/voucher_deposit';
        $this->data['main_menu'] = 'accounting';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->data['title'] = translate('office_accounting');
        $this->load->view('layout/index', $this->data);
    }

    // this function is used to add voucher data
    public function voucher_expense()
    {
        if (!get_permission('expense', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        $this->data['branch_id'] = $branchID;
        $this->data['voucherlist'] = $this->accounting_model->getVoucherList('expense');
        $this->data['sub_page'] = 'accounting/voucher_expense';
        $this->data['main_menu'] = 'accounting';
        $this->data['headerelements'] = array(
            'css' => array(
                'vendor/dropify/css/dropify.min.css',
            ),
            'js' => array(
                'vendor/dropify/js/dropify.min.js',
            ),
        );
        $this->data['title'] = translate('office_accounting');
        $this->load->view('layout/index', $this->data);
    }

    public function voucher_save()
    {
        if ($_POST) {
            $type = $this->input->post('voucher_type');
            if ($type == 'deposit') {
                if (!get_permission('deposit', 'is_add')) {
                    ajax_access_denied();
                }
            }
            if ($type == 'expense') {
                if (!get_permission('expense', 'is_add')) {
                    ajax_access_denied();
                }
            }
            if (is_superadmin_loggedin()) {
                $this->form_validation->set_rules('branch_id', translate('branch'), 'required');
            }
            $this->form_validation->set_rules('account_id', translate('account'), 'trim|required');
            $this->form_validation->set_rules('voucher_head_id', translate('voucher_head'), 'trim|required');
            $this->form_validation->set_rules('amount', translate('amount'), 'trim|required|numeric');
            $this->form_validation->set_rules('date', translate('date'), 'trim|required|callback_get_valid_date');
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                //save data into table
                $insert_id = $this->accounting_model->saveVoucher($post);
                if (isset($_FILES["attachment_file"]) && !empty($_FILES['attachment_file']['name'])) {
                    $ext = pathinfo($_FILES["attachment_file"]["name"], PATHINFO_EXTENSION);
                    $file_name = $insert_id . '.' . $ext;
                    move_uploaded_file($_FILES["attachment_file"]["tmp_name"], "./uploads/attachments/voucher/" . $file_name);
                    $this->db->where('id', $insert_id);
                    $this->db->update('transactions', array('attachments' => $file_name));
                }
                set_alert('success', translate('information_has_been_saved_successfully'));
                $array  = array('status' => 'success',  'error' => '');
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function all_transactions()
    {
        if (!get_permission('all_transactions', 'is_view')) {
            access_denied();
        }

        $this->data['voucherlist'] = $this->accounting_model->getVoucherList();
        $this->data['sub_page'] = 'accounting/all_transactions';
        $this->data['main_menu'] = 'accounting';
        $this->data['title'] = translate('office_accounting');
        $this->load->view('layout/index', $this->data);
    }


    // this function is used to voucher data update
    public function voucher_deposit_edit($id = '')
    {
        if (!get_permission('deposit', 'is_edit')) {
            access_denied();
        }
        if ($_POST) {
            $this->form_validation->set_rules('voucher_head_id', translate('voucher_head'), 'trim|required');
            $this->form_validation->set_rules('date', translate('date'), 'trim|required');
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                // update data into table
                $insert_id = $this->accounting_model->voucherEdit($post);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url    = base_url('accounting/voucher_deposit');
                $array  = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['deposit'] = $this->app_lib->getTable('transactions', array('t.id' => $id), true);
        $this->data['sub_page'] = 'accounting/voucher_deposit_edit';
        $this->data['main_menu'] = 'accounting';
        $this->data['title'] = translate('office_accounting');
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

    // this function is used to voucher data update
    public function voucher_expense_edit($id = '')
    {
        if (!get_permission('expense', 'is_edit')) {
            access_denied();
        }
        if ($_POST) {
            $this->form_validation->set_rules('voucher_head_id', translate('voucher_head'), 'trim|required');
            $this->form_validation->set_rules('date', translate('date'), 'trim|required');
            if ($this->form_validation->run() !== false) {
                $post = $this->input->post();
                // update data into table
                $insert_id = $this->accounting_model->voucherEdit($post);
                set_alert('success', translate('information_has_been_updated_successfully'));
                $url    = base_url('accounting/voucher_expense');
                $array  = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }
        $this->data['expense'] = $this->app_lib->getTable('transactions', array('t.id' => $id), true);
        $this->data['sub_page'] = 'accounting/voucher_expense_edit';
        $this->data['main_menu'] = 'accounting';
        $this->data['title'] = translate('office_accounting');
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

    // delete into voucher table by voucher id
    public function voucher_delete($id)
    {
        $q = $this->db->where('id', $id)->get('transactions')->row_array();
        if ($q['type'] == 'expense') {
            if (!get_permission('expense', 'is_delete')) {
                access_denied();
            }
            $sql = "UPDATE accounts SET balance = balance + " . $q['amount'] . " WHERE id = " . $this->db->escape($q['account_id']);
            $this->db->query($sql);
        } elseif ($q['type'] == 'deposit') {
            if (!get_permission('deposit', 'is_delete')) {
                access_denied();
            }
            $sql = "UPDATE accounts SET balance = balance - " . $q['amount'] . " WHERE id = " . $this->db->escape($q['account_id']);
            $this->db->query($sql);
        }
        $filepath = FCPATH . 'uploads/attachments/voucher/' . $q['attachments'];
        if (file_exists($filepath)) {
            unlink($filepath);
        }
        $this->db->where('id', $id);
        $this->db->delete('transactions');
    }

    // account statement by date to date
    public function account_statement()
    {
        if (!get_permission('accounting_reports', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            $account_id = $this->input->post('account_id');
            $type = $this->input->post('type');
            $daterange = explode(' - ', $this->input->post('daterange'));
            $start = date("Y-m-d", strtotime($daterange[0]));
            $end = date("Y-m-d", strtotime($daterange[1]));
            $this->data['daterange'] = $daterange;
            $this->data['results'] = $this->accounting_model->getStatementReport($account_id, $type, $start, $end);
        }
        $this->data['title'] = translate('financial_reports');
        $this->data['branch_id'] = $this->application_model->get_branch_id();
        $this->data['sub_page'] = 'accounting/account_statement';
        $this->data['main_menu'] = 'accounting_repots';
        $this->load->view('layout/index', $this->data);
    }

    // income repots by date to date
    public function income_repots()
    {
        if (!get_permission('accounting_reports', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            $branchID = $this->application_model->get_branch_id();
            $daterange = explode(' - ', $this->input->post('daterange'));
            $start = date("Y-m-d", strtotime($daterange[0]));
            $end = date("Y-m-d", strtotime($daterange[1]));
            $this->data['daterange'] = $daterange;
            $this->data['results'] = $this->accounting_model->getIncomeExpenseRepots($branchID, $start, $end, 'deposit');
        }
        $this->data['title'] = translate('financial_reports');
        $this->data['sub_page'] = 'accounting/income_repots';
        $this->data['main_menu'] = 'accounting_repots';
        $this->load->view('layout/index', $this->data);
    }

    public function expense_repots()
    {
        if (!get_permission('accounting_reports', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            $branchID = $this->application_model->get_branch_id();
            $daterange = explode(' - ', $this->input->post('daterange'));
            $start = date("Y-m-d", strtotime($daterange[0]));
            $end = date("Y-m-d", strtotime($daterange[1]));
            $this->data['daterange'] = $daterange;
            $this->data['results'] = $this->accounting_model->getIncomeExpenseRepots($branchID, $start, $end, 'expense');
        }
        $this->data['title'] = translate('financial_reports');
        $this->data['sub_page'] = 'accounting/expense_repots';
        $this->data['main_menu'] = 'accounting_repots';
        $this->load->view('layout/index', $this->data);
    }

    // account balance sheet
    public function balance_sheet()
    {
        if (!get_permission('accounting_reports', 'is_view')) {
            access_denied();
        }
        $branchID = $this->application_model->get_branch_id();
        $this->data['branch_id'] = $branchID;
        $this->data['results'] = $this->accounting_model->get_balance_sheet($branchID);
        $this->data['title'] = translate('financial_reports');
        $this->data['sub_page'] = 'accounting/balance_sheet';
        $this->data['main_menu'] = 'accounting_repots';
        $this->load->view('layout/index', $this->data);
    }

    // income vs expense repots by date to date
    public function incomevsexpense()
    {
        if (!get_permission('accounting_reports', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            $branchID = $this->application_model->get_branch_id();
            $daterange = explode(' - ', $this->input->post('daterange'));
            $start = date("Y-m-d", strtotime($daterange[0]));
            $end = date("Y-m-d", strtotime($daterange[1]));
            $this->data['daterange'] = $daterange;
            $this->data['results'] = $this->accounting_model->get_incomevsexpense($branchID, $start, $end);
        }
        $this->data['title'] = translate('financial_reports');
        $this->data['sub_page'] = 'accounting/income_vs_expense';
        $this->data['main_menu'] = 'accounting_repots';
        $this->load->view('layout/index', $this->data);
    }

    public function transitions_repots()
    {
        if (!get_permission('accounting_reports', 'is_view')) {
            access_denied();
        }
        if ($_POST) {
            $branchID = $this->application_model->get_branch_id();
            $daterange = explode(' - ', $this->input->post('daterange'));
            $start = date("Y-m-d", strtotime($daterange[0]));
            $end = date("Y-m-d", strtotime($daterange[1]));
            $this->data['daterange'] = $daterange;
            $this->data['results'] = $this->accounting_model->getTransitionsRepots($branchID, $start, $end);
        }

        $this->data['title'] = translate('financial_reports');
        $this->data['sub_page'] = 'accounting/transitions_repots';
        $this->data['main_menu'] = 'accounting_repots';
        $this->load->view('layout/index', $this->data);
    }

    public function getVoucherHead()
    {
        $html = "";
        $branch_id = $this->application_model->get_branch_id();
        $type = $this->input->post('type');
        if (!empty($branch_id)) {
            $result = $this->db->select('id,name')->where(array('branch_id' => $branch_id, 'type' => $type))->get('voucher_head')->result_array();
            if (count($result)) {
                $html .= "<option value=''>" . translate('select') . "</option>";
                foreach ($result as $row) {
                    $html .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            } else {
                $html .= '<option value="">' . translate('no_information_available') . '</option>';
            }
        } else {
            $html .= '<option value="">' . translate('select_branch_first') . '</option>';
        }
        echo $html;
    }

    public function get_valid_date($date)
    {
        $present_date = date('Y-m-d');
        $date = date("Y-m-d", strtotime($date));
        if ($date > $present_date) {
            $this->form_validation->set_message("get_valid_date", "Please Enter Correct Date");
            return false;
        } else {
            return true;
        }
    }
}
