<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use Omnipay\Omnipay;

require_once(APPPATH . 'third_party/omnipay/vendor/autoload.php');

class Paypal_payment {

    private $ci;
    public $api_config;

    function __construct() {
        $this->ci = & get_instance();
        $this->api_config = $this->ci->db->select('paypal_username,paypal_password,paypal_signature,paypal_sandbox')->where('branch_id', get_loggedin_branch_id())->get('payment_config')->row_array();
    }

    public function payment($data) {
        $sandbox = $this->api_config['paypal_sandbox'] == 1 ? TRUE : FALSE;
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername($this->api_config['paypal_username']);
        $gateway->setPassword($this->api_config['paypal_password']);
        $gateway->setSignature($this->api_config['paypal_signature']);
        $gateway->setTestMode($sandbox);
        $response = $gateway->purchase($data)->send();
        return $response;
    }

    public function success($data) {
        $sandbox = $this->api_config['paypal_sandbox'] == 1 ? TRUE : FALSE;
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername($this->api_config['paypal_username']);
        $gateway->setPassword($this->api_config['paypal_password']);
        $gateway->setSignature($this->api_config['paypal_signature']);
        $gateway->setTestMode($sandbox);
        $response = $gateway->completePurchase($data)->send();
        return $response;
    }
}
?>