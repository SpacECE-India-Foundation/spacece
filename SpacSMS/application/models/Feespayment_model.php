<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Feespayment_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sms_model');
    }

    public function get_student_invoice($student_id)
    {
        $this->db->select('fi.*,e.student_id,e.roll,s.first_name,s.last_name,s.register_no');
        $this->db->from('fee_invoice as fi');
        $this->db->join('enroll as e', 'e.student_id = fi.student_id', 'left');
        $this->db->join('student as s', 's.id = fi.student_id', 'left');
        $this->db->where('fi.student_id', $student_id);
        $this->db->order_by('fi.id', 'desc');
        return $this->db->get();
    }

    public function get_invoice_single($id)
    {
        $this->db->select('fi.*,e.student_id,e.roll,e.class_id,s.first_name,s.last_name,s.email,s.current_address,c.name as class_name');
        $this->db->from('fee_invoice as fi');
        $this->db->join('enroll as e', 'e.student_id = fi.student_id', 'left');
        $this->db->join('student as s', 's.id = fi.student_id', 'left');
        $this->db->join('class as c', 'c.id = e.class_id', 'left');
        $this->db->where('fi.id', $id);
        return $this->db->get()->row();
    }

    public function save_online_pay($data)
    {
        $arrayHistory = array(
            'fee_invoice_id' => $data['invoice_id'],
            'collect_by' => 'online',
            'remarks' => $data['remarks'],
            'method' => $data['method'],
            'amount' => $data['payment_amount'],
            'date' => date("Y-m-d"),
            'session_id' => get_session_id(),
        );
        $this->db->insert('payment_history', $arrayHistory);

        if ($data['total_due'] <= $data['payment_amount']) {
            $this->db->where('id', $data['invoice_id']);
            $this->db->update('fee_invoice', array('status' => 2));
        } else {
            $this->db->where('id', $data['invoice_id']);
            $this->db->update('fee_invoice', array('status' => 1));
        }
        $this->db->where('id', $data['invoice_id']);
        $this->db->set('total_paid', 'total_paid + ' . $data['payment_amount'], false);
        $this->db->set('total_due', 'total_due - ' . $data['payment_amount'], false);
        $this->db->update('fee_invoice');

        // send payment confirmation sms
        $arrayHistory['student_id'] = $data['student_id'];
        $this->sms_model->send_sms($arrayHistory, 2);
    }
}
