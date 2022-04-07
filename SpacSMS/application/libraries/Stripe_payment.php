<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use Omnipay\Omnipay;

require_once(APPPATH . 'third_party/omnipay/vendor/autoload.php');

class Stripe_payment {

    private $ci;
    public $api_config;

    function __construct() {
        $this->ci = & get_instance();
        $this->api_config = $this->ci->db->select('stripe_secret,stripe_demo')->where('branch_id', get_loggedin_branch_id())->get('payment_config')->row_array();
    }

    public function payment($data) {
        $stripe_demo = $this->api_config['stripe_demo'] == 1 ? TRUE : FALSE;
        $gateway = Omnipay::create('Stripe');
        $gateway->setApiKey($this->api_config['stripe_secret']);
        $gateway->setTestMode($stripe_demo);

        $params = array(
            'amount'        => number_format($data['amount'] + $data['fine'], 2, '.', ''),
            'description'   => "Online Student fees deposit. Invoice No - " . $data['invoice_no'],
            'currency'      => $data['currency'],
            'card'          => $data['card_data']
        );
        $response = $gateway->purchase($params)->send();
        return $response;
    }

}

?>