<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // account save and update function
    public function saveAccounts($data)
    {
        $branchID = $this->application_model->get_branch_id();
        $obal = (empty($data['opening_balance']) ? 0 : $data['opening_balance']);
        $insert_account = array(
            'branch_id' => $branchID,
            'name' => $data['account_name'],
            'number' => $data['account_number'],
            'description' => $data['description'],
        );
        if (isset($data['account_id']) && !empty($data['account_id'])) {
            $this->db->where('id', $data['account_id']);
            $this->db->update('accounts', $insert_account);
            $this->db->where('id', $data['account_id']);
            $this->db->update('transactions', array('branch_id' => $branchID));
        } else {
            $insert_account['balance'] = $obal;
            $this->db->insert('accounts', $insert_account);
            $insertID = $this->db->insert_id();
            if ($obal > 0) {
                $insertTransaction = array(
                    'account_id' => $insertID,
                    'voucher_head_id' => 0,
                    'type' => 'deposit',
                    'amount' => $obal,
                    'dr' => 0,
                    'cr' => $obal,
                    'bal' => $obal,
                    'date' => date('Y-m-d'),
                    'description' => 'Opening Balance',
                );
                $this->db->insert('transactions', $insertTransaction);
            }
        }
    }

    // voucher save function
    public function saveVoucher($data)
    {
        $branchID = $this->application_model->get_branch_id();
        $accountID = $data['account_id'];
        $voucher_headID = $data['voucher_head_id'];
        $voucherType = $data['voucher_type'];
        $ref_no = $data['ref_no'];
        $amount = $data['amount'];
        $date = $data['date'];
        $pay_via = $data['pay_via'];
        $description = $data['description'];
        $qbal = $this->app_lib->get_table('accounts', $accountID, true);
        $cbal = $qbal['balance'];
        if ($voucherType == 'deposit') {
            $cr = $amount;
            $dr = 0;
            $bal = $cbal + $amount;
        } elseif ($voucherType == 'expense') {
            $cr = 0;
            $dr = $amount;
            $bal = $cbal - $amount;
        }
        $insertTransaction = array(
            'account_id' => $accountID,
            'voucher_head_id' => $voucher_headID,
            'type' => $voucherType,
            'ref' => $ref_no,
            'amount' => $amount,
            'dr' => $dr,
            'cr' => $cr,
            'bal' => $bal,
            'date' => date("Y-m-d", strtotime($date)),
            'pay_via' => $pay_via,
            'description' => $description,
            'branch_id' => $branchID,
        );

        $this->db->insert('transactions', $insertTransaction);
        $insert_id = $this->db->insert_id();
        $this->db->where('id', $accountID);
        $this->db->update('accounts', array('balance' => $bal));
        return $insert_id;
    }

    // voucher update function
    public function voucherEdit($data)
    {
        $voucher_headID = $data['voucher_head_id'];
        $refNo = $data['ref_no'];
        $date = $data['date'];
        $payVia = $data['pay_via'];
        $description = $data['description'];
        $insertTransaction = array(
            'voucher_head_id' => $voucher_headID,
            'ref' => $refNo,
            'date' => date("Y-m-d", strtotime($date)),
            'pay_via' => $payVia,
            'description' => $description,
        );

        if (isset($data['voucher_old_id']) && !empty($data['voucher_old_id'])) {
            if (!is_superadmin_loggedin()) {
                $this->db->where('branch_id', get_loggedin_branch_id());
            }
            $insert_id = $data['voucher_old_id'];
            if (isset($_FILES["attachment_file"]) && !empty($_FILES['attachment_file']['name'])) {
                $ext = pathinfo($_FILES["attachment_file"]["name"], PATHINFO_EXTENSION);
                $file_name = $insert_id . '.' . $ext;
                move_uploaded_file($_FILES["attachment_file"]["tmp_name"], "./uploads/attachments/voucher/" . $file_name);
                $this->db->where('id', $insert_id);
                $this->db->update('transactions', array('attachments' => $file_name));
            }

            $this->db->where('id', $insert_id);
            $this->db->update('transactions', $insertTransaction);
        }
    }

    // get voucher list function
    public function getVoucherList($type = '')
    {
        
        $this->db->select('transactions.*, accounts.name as ac_name, voucher_head.name as v_head, payment_types.name as via_name');
        $this->db->from('transactions');
        $this->db->join('accounts', 'accounts.id = transactions.account_id', 'left');
        $this->db->join('voucher_head', 'voucher_head.id = transactions.voucher_head_id', 'left');
        $this->db->join('payment_types', 'payment_types.id = transactions.pay_via', 'left');
        if (!empty($type)) {
            $this->db->where('transactions.type', $type);
        }
        if (!is_superadmin_loggedin()) {
            $this->db->where('transactions.branch_id', get_loggedin_branch_id());
        }
        return $this->db->get()->result_array();
    }

    // get statement report function
    public function getStatementReport($account_id = '', $type = '', $start = '', $end = '')
    {
        $this->db->select('transactions.*,voucher_head.name as v_head');
        $this->db->from('transactions');
        $this->db->join('voucher_head', 'voucher_head.id = transactions.voucher_head_id', 'left');
        $this->db->where('transactions.account_id', $account_id);
        $this->db->where('transactions.date >=', $start);
        $this->db->where('transactions.date <=', $end);
        if ($type != 'all') {
            $this->db->where('transactions.type', $type);
        }
        $this->db->order_by('transactions.id', 'ASC');
        return $this->db->get()->result_array();
    }

    // get income expense report function
    public function getIncomeExpenseRepots($branchID, $start = '', $end = '', $type = '')
    {
        $this->db->select('transactions.*,accounts.name as ac_name,voucher_head.name as v_head,payment_types.name as via_name');
        $this->db->from('transactions');
        $this->db->join('accounts', 'accounts.id = transactions.account_id', 'left');
        $this->db->join('voucher_head', 'voucher_head.id = transactions.voucher_head_id', 'left');
        $this->db->join('payment_types', 'payment_types.id = transactions.pay_via', 'left');
        if ($type != '') {
            $this->db->where('transactions.type', $type);
        }
        $this->db->where('transactions.branch_id', $branchID);
        $this->db->where('transactions.date >=', $start);
        $this->db->where('transactions.date <=', $end);
        $this->db->order_by('transactions.id', 'ASC');
        return $this->db->get()->result_array();
    }

    // get account balance sheet report
    public function get_balance_sheet($branchID)
    {
        $this->db->select('transactions.*,IFNULL(SUM(transactions.dr), 0) as total_dr,IFNULL(SUM(transactions.cr),0) as total_cr,accounts.name as ac_name,accounts.balance as fbalance');
        $this->db->from('accounts');
        $this->db->join('transactions', 'transactions.account_id = accounts.id', 'left');
        $this->db->group_by('transactions.account_id');
        $this->db->order_by('accounts.balance', 'DESC');
        $this->db->where('accounts.branch_id', $branchID);
        return $this->db->get()->result_array();
    }

    // get income vs expense report
    public function get_incomevsexpense($branchID, $start = '', $end = '')
    {
        $sql = "SELECT transactions.*, voucher_head.name as v_head, IFNULL(SUM(transactions.dr), 0) as total_dr, IFNULL(SUM(transactions.cr), 0) as total_cr FROM voucher_head LEFT JOIN
        transactions ON transactions.voucher_head_id = voucher_head.id WHERE transactions.date >= " . $this->db->escape($start) .
        " AND transactions.date <= " . $this->db->escape($end) . " AND transactions.branch_id = " . $this->db->escape($branchID) . " GROUP BY transactions.voucher_head_id ORDER BY transactions.id ASC";
        return $this->db->query($sql)->result_array();
    }

    // get transitions repots
    public function getTransitionsRepots($branchID, $start = '', $end = '')
    {
        $sql = "SELECT transactions.*, accounts.name as ac_name, voucher_head.name as v_head, payment_types.name as via_name FROM transactions LEFT JOIN
        accounts ON accounts.id = transactions.account_id LEFT JOIN voucher_head ON voucher_head.id = transactions.voucher_head_id LEFT JOIN
        payment_types ON payment_types.id = transactions.pay_via WHERE transactions.date >= " . $this->db->escape($start) . " AND
        transactions.date <= " . $this->db->escape($end) . " AND transactions.branch_id = " . $this->db->escape($branchID) . " ORDER BY transactions.id ASC";
        return $this->db->query($sql)->result_array();
    }

    // duplicate voucher head check in db
    public function unique_voucher_head($name)
    {
        $branchID = $this->application_model->get_branch_id();
        $voucher_head_id = $this->input->post('voucher_head_id');
        if (!empty($voucher_head_id)) {
            $this->db->where_not_in('id', $voucher_head_id);
        }

        $this->db->where(array('name' => $name, 'branch_id' => $branchID));
        $query = $this->db->get('voucher_head');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("unique_voucher_head", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }

    // duplicate account name check in db
    public function unique_account_name($name)
    {
        $account_id = $this->input->post('account_id');
        if (!empty($account_id)) {
            $this->db->where_not_in('id', $account_id);
        }

        $this->db->where('name', $name);
        $query = $this->db->get('accounts');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message("unique_account_name", translate('already_taken'));
            return false;
        } else {
            return true;
        }
    }
}
