<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once(APPPATH . 'third_party/razorpay/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Razorpay_payment {

    private $ci;
    public $api_config;

    function __construct() {
        $this->ci = & get_instance();
        $this->api_config = $this->ci->db->select('razorpay_key_id,razorpay_key_secret')->where('branch_id', get_loggedin_branch_id())->get('payment_config')->row_array();
    }

    public function payment($data) {
        $api = new Api($this->api_config['razorpay_key_id'], $this->api_config['razorpay_key_secret']);
        $orderData = [
            'receipt'         => $data['invoice_no'],
            'amount'          => ($data['amount'] + $data['fine']) * 100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];

        $razorpayOrder = $api->order->create($orderData);
        return $razorpayOrder['id'];
    }

    public function verify($attributes) {
        $success = TRUE;
        $api = new Api($this->api_config['razorpay_key_id'], $this->api_config['razorpay_key_secret']);
        try
        {
            $api->utility->verifyPaymentSignature($attributes);
        }
        catch(SignatureVerificationError $e)
        {
            $success = 'Razorpay Error : ' . $e->getMessage();
        }
        return $success;
    }
}
?>