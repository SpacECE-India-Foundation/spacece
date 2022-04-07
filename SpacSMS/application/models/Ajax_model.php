<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPayslip($id)
    {
        $this->db->select('payout_commission.*,staff.name as staff_name,staff.staff_id,ifnull(staff_designation.name,"N/A") as designation_name,ifnull(staff_department.name,"N/A") as department_name,payment_type.name as pay_via_name');
        $this->db->from('payout_commission');
        $this->db->join('staff', 'staff.id = payout_commission.staff_id', 'left');
        $this->db->join('staff_designation', 'staff_designation.id = staff.designation', 'left');
        $this->db->join('staff_department', 'staff_department.id = staff.department', 'left');
        $this->db->join('payment_type', 'payment_type.id = payout_commission.pay_via', 'left');
        $this->db->where('payout_commission.id', $id);
        return $this->db->get()->row_array();
    }
}
