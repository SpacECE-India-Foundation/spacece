<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Payroll_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // employee basic salary validation by salary template
    public function get_basic_salary($staff_id, $amount)
    {
        $q = $this->db->get_where('staff', array('id' => $staff_id))->row_array();
        if (empty($q['salary_template_id']) || $q['salary_template_id'] == 0) {
            return 1;
        } else {
            $basic_salary = $this->db->get_where("salary_template", array('id' => $q['salary_template_id']))->row()->basic_salary;
            if ($amount > $basic_salary) {
                return 2;
            }
        }
        return 3;
    }

    // employee advance salary validation by month
    public function get_advance_valid_month($staff_id, $month)
    {
        $get_advance_month = $this->db->get_where("advance_salary", array(
            "staff_id" => $staff_id,
            "deduct_month" => date("m", strtotime($month)),
            "year" => date("Y", strtotime($month)),
            "status" => 2,
        ))->num_rows();
        $get_salary_month = $this->db->get_where("payslip", array(
            "staff_id" => $staff_id,
            "month" => date("m", strtotime($month)),
            "year" => date("Y", strtotime($month)),
        ))->num_rows();
        if ($get_advance_month == 0 && $get_salary_month == 0) {
            return true;
        } else {
            return false;
        }
    }

    // payslip save and update function
    public function save_payslip($data)
    {
        $staff_id = $data['staff_id'];
        $month = $data['month'];
        $year = $data['year'];
        $total_allowance = $data['total_allowance'];
        $total_deduction = $data['total_deduction'];
        $net_salary = $data['net_salary'];
        $overtime_hour = $data['overtime_total_hour'];
        $overtime_amount = $data['overtime_amount'];
        $salary_template_id = $data['salary_template_id'];
        $branchID = $this->application_model->get_branch_id();
        
		$ad_salary = $this->db->select('amount')
        ->where(array('staff_id' => $staff_id, 'deduct_month' => $month, 'year' => $year))
        ->get('advance_salary')->row_array();

        $exist_verify = $this->db->select('id')
        ->where(array('staff_id' => $staff_id, 'month' => $month, 'year' => $year))->get('payslip')
        ->num_rows();

        if ($exist_verify == 0) {
            $arrayPayslip = array(
                'staff_id' => $staff_id,
                'month' => $month,
                'year' => $year,
                'basic_salary' => $data['basic_salary'],
                'total_allowance' => $total_allowance,
                'total_deduction' => $total_deduction,
                'net_salary' => $net_salary,
                'bill_no' => $this->app_lib->get_bill_no('payslip'),
                'remarks' => $data['remarks'],
                'hash' => app_generate_hash(),
                'pay_via' => $data['pay_via'],
                'branch_id' => $branchID,
                'paid_by' => get_loggedin_user_id(),
            );
            $this->db->insert('payslip', $arrayPayslip);
            $payslip_id = $this->db->insert_id();

            $payslipData = array();
            $getTemplate = $this->get("salary_template_details", array('salary_template_id' => $salary_template_id));
            foreach ($getTemplate as $row) {
                if ($row['type'] == 1) {
                    $payslipData[] = array(
                        'payslip_id' => $payslip_id,
                        'name' => $row['name'],
                        'amount' => $row['amount'],
                        'type' => 1,
                    );
                } else {
                    $payslipData[] = array(
                        'payslip_id' => $payslip_id,
                        'name' => $row['name'],
                        'amount' => $row['amount'],
                        'type' => 2,
                    );
                }
            }

            if (!empty($overtime_hour) && $overtime_hour != 0) {
                $payslipData[] = array(
                    'payslip_id' => $payslip_id,
                    'name' => "Overtime Salary (" . $overtime_hour . " Hour)",
                    'amount' => $overtime_amount,
                    'type' => 1,
                );
            }

            if (count($ad_salary)) {
                $payslipData[] = array(
                    'payslip_id' => $payslip_id,
                    'name' => "Advance Salary",
                    'amount' => $ad_salary['amount'],
                    'type' => 2,
                );
            }
            $this->db->insert_batch('payslip_details', $payslipData);

            // voucher transaction save function
            if (isset($data['account_id'])) {
                $arrayTransaction = array(
                    'account_id' => $data['account_id'], 
                    'date' => $data['account_id'], 
                    'amount' => $net_salary, 
                    'month' => $month, 
                    'year' => $year, 
                );
                $this->saveTransaction($arrayTransaction);
            }

            $payslip_url = base_url('payroll/invoice/' . $payslip_id . '/' . $arrayPayslip['hash']);
            // pay-slip confirmation email
            $arrayEmail = array(
                'name' => get_type_name_by_id('staff', $staff_id), 
                'month_year' => date('F', strtotime($year . '-' . $month)), 
                'payslip_no' => $arrayPayslip['bill_no'], 
                'payslip_url' => $payslip_url, 
                'recipient' => get_type_name_by_id('staff', $staff_id, 'email'), 
            );
            $this->email_model->sentStaffSalaryPay($arrayEmail);
            return ['status' => 'success', 'uri' => $payslip_url];
        } else {
            return ['status' => 'failed'];
        }
    }


    // voucher transaction save function
    public function saveTransaction($data)
    {
        $branchID       = $this->application_model->get_branch_id();
        $accountID      = $data['account_id'];
        $amount         = $data['amount'];
        $month          = $data['month'];
        $year           = $data['year'];
        $description    = date("M-Y", strtotime($year . '-' . $month)) . " Paying Employees Salaries";

        // get the current balance of the selected account
        $qbal   = $this->app_lib->get_table('accounts', $accountID, true);
        $cbal   = $qbal['balance'];
        $bal    = ($cbal - $amount);
        // query system voucher head / insert
        $arrayHead = array(
            'name'      => 'Employees Salary Payment',
            'type'      => 'expense',
            'system'    => 1,
            'branch_id' => $branchID
        );
        $this->db->where($arrayHead);
        $query =$this->db->get('voucher_head');
        if ($query->num_rows() == 1) {
            $voucher_headID = $query->row()->id;
        } else {
            $this->db->insert('voucher_head', $arrayHead);
            $voucher_headID = $this->db->insert_id();
        }
        // query system transactions / insert
        $arrayTransactions =array(
            'account_id'        => $accountID,
            'voucher_head_id'   => $voucher_headID,
            'type'              => 'expense',
            'system'            => 1,
            'branch_id'         => $branchID
        );
        $this->db->where($arrayTransactions);
        $this->db->where('description', $description);
        $query =$this->db->get('transactions');
        if ($query->num_rows() > 0) {
            $this->db->set('amount', 'amount+' . $amount, FALSE);
            $this->db->set('dr', 'dr+' . $amount, FALSE);
            $this->db->set('bal', $bal);
            $this->db->where('id', $query->row()->id);
            $this->db->update('transactions');
        } else {
            $arrayTransactions['date']           = date("Y-m-d");
            $arrayTransactions['ref']           = '';
            $arrayTransactions['amount']        = $amount;
            $arrayTransactions['dr']            = $amount;
            $arrayTransactions['cr']            = 0;
            $arrayTransactions['bal']           = $bal;
            $arrayTransactions['pay_via']       = 5;
            $arrayTransactions['description']   = $description;
            $this->db->insert('transactions', $arrayTransactions);
        }

        $this->db->where('id', $accountID);
        $this->db->update('accounts', array('balance' => $bal));
    }

    public function getInvoice($id)
    {
        $this->db->select('payslip.*,staff.name as staff_name,staff.mobileno,IFNULL(staff_designation.name, "N/A") as designation_name,IFNULL(staff_department.name, "N/A") as department_name,branch.school_name,branch.email as school_email,branch.mobileno as school_mobileno,branch.address as school_address');
        $this->db->from('payslip');
        $this->db->join('staff', 'staff.id = payslip.staff_id', 'left');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
        $this->db->join('branch', 'branch.id = staff.branch_id', 'left');
        $this->db->where('payslip.id', $id);
        return $this->db->get()->row_array();
    }

    // get staff all details
    public function getEmployeeList($branch_id, $role_id, $designation)
    {
        $this->db->select('staff.*,staff_designation.name as designation_name,staff_department.name as department_name,login_credential.role as role_id, roles.name as role');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != 6 and login_credential.role != 7', 'inner');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
        $this->db->where('login_credential.role', $role_id);
        $this->db->where('login_credential.active', 1);
        $this->db->where('staff.branch_id', $branch_id);
        $this->db->where('staff.designation', $designation);
        return $this->db->get()->result();
    }

    // get employee payment list
    public function getEmployeePaymentList($branch_id='', $role_id, $month, $year)
    {
        $this->db->select('staff.*,staff_designation.name as designation_name,staff_department.name as department_name,login_credential.role as role_id, roles.name as role, IFNULL(payslip.id, 0) as salary_id, payslip.hash as salary_hash,salary_template.name as template_name, salary_template.basic_salary');
        $this->db->from('staff');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id', 'inner');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
        $this->db->join('payslip', 'payslip.staff_id = staff.id and payslip.month = ' . $this->db->escape($month) . ' and payslip.year = ' . $this->db->escape($year), 'left');
        $this->db->join('salary_template', 'salary_template.id = staff.salary_template_id', 'left');
        $this->db->where('staff.branch_id', $branch_id);
        $this->db->where('login_credential.role', $role_id);
        $this->db->where('login_credential.active', 1);
        $this->db->where('staff.salary_template_id !=', 0);
        return $this->db->get()->result();
    }

    // get employee payment list
    public function getEmployeePayment($staff_id, $month, $year)
    {
        $sql = "SELECT `staff`.*, `staff_designation`.`name` as `designation_name`, `staff_department`.`name` as `department_name`, `login_credential`.`role` as `role_id`, `roles`.`name` as `role`,
        `salary_template`.`name` as `template_name`, `salary_template`.`basic_salary`, `salary_template`.`overtime_salary`, `advance_salary`.`amount` as `advance_amount` FROM `staff` INNER JOIN
        `login_credential` ON `login_credential`.`user_id` = `staff`.`id` LEFT JOIN `roles` ON `roles`.`id` = `login_credential`.`role` LEFT JOIN `staff_designation` ON
        `staff_designation`.`id` = `staff`.`designation` LEFT JOIN `staff_department` ON `staff_department`.`id` = `staff`.`department` LEFT JOIN `salary_template` ON
        `salary_template`.`id` = `staff`.`salary_template_id` LEFT JOIN `advance_salary` ON `advance_salary`.`staff_id` = `staff`.`id` AND 
        `advance_salary`.`deduct_month` = " . $this->db->escape($month) . " AND `advance_salary`.`year` = " . $this->db->escape($year) . " WHERE
        `staff`.`id` = " . $this->db->escape($staff_id);
        return $this->db->query($sql)->row_array();
    }

    public function getAdvanceSalaryList($month='', $year='', $branch_id = '')
    {
        $this->db->select('advance_salary.*,staff.name,staff.photo,login_credential.role as role_id,roles.name as role');
        $this->db->from('advance_salary');
        $this->db->join('staff', 'staff.id = advance_salary.staff_id', 'inner');
        $this->db->join('login_credential', 'login_credential.user_id = staff.id and login_credential.role != 6 and login_credential.role != 7', 'left');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        if (!empty($month)) {
            $this->db->where('advance_salary.deduct_month', $month);
            $this->db->where('advance_salary.year', $year);
        }
        if (!empty($branch_id)) {
            $this->db->where('advance_salary.branch_id', $branch_id);
        }
        return $this->db->get()->result_array();
    }

    // get summary report function
    public function get_summary($branch_id = '', $month = '', $year = '', $staffID)
    {
        $this->db->select('payslip.*,staff.name as staff_name,staff.mobileno,IFNULL(staff_designation.name, "N/A") as designation_name,IFNULL(staff_department.name, "N/A") as department_name,payment_types.name as payvia');
        $this->db->from('payslip');
        $this->db->join('staff', 'staff.id = payslip.staff_id', 'left');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
        $this->db->join('payment_types', 'payment_types.id = payslip.pay_via', 'left');
        if (!empty($staffID)) {
            $this->db->where('payslip.staff_id', get_loggedin_user_id());
        }
        $this->db->where('payslip.branch_id', $branch_id);
        $this->db->where('payslip.month', $month);
        $this->db->where('payslip.year', $year);
        return $this->db->get()->result_array();
    }
}
