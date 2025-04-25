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

class Feespayment extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('feespayment_model');
        $this->load->model('userrole_model');
        $this->load->model('fees_model');
        $this->load->library('paypal_payment');
        $this->load->library('stripe_payment');
        $this->load->library('razorpay_payment');
    }

    public function index()
    {
        if (is_student_loggedin() || is_parent_loggedin()) {
            redirect(base_url('userrole/invoice'), 'refresh');
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    public function checkout()
    {
        if (!is_student_loggedin() && !is_parent_loggedin()) {
            ajax_access_denied();
        }
        if ($_POST) {
            $payVia = $this->input->post('pay_via');
            $this->form_validation->set_rules('fees_type', translate('fees_type'), 'trim|required');
            $this->form_validation->set_rules('fee_amount', translate('amount'), array('trim','required','numeric','greater_than[0]',array('deposit_verify', array($this->fees_model, 'depositAmountVerify'))));
            $this->form_validation->set_rules('pay_via', translate('payment_method'), 'trim|required');
            if ($payVia == 'stripe') {
                $this->form_validation->set_rules('card_number', 'Card Number', 'trim|required');
                $this->form_validation->set_rules('cvv', 'CVV', 'trim|required|max_length[4]');
                $this->form_validation->set_rules('expire_month', 'Card Expire', 'trim|required|max_length[2]');
                $this->form_validation->set_rules('expire_year', 'Card Expire', 'trim|required|max_length[4]');
            }
            if ($payVia == 'payumoney') {
                $this->form_validation->set_rules('payer_name', translate('name'), 'trim|required');
                $this->form_validation->set_rules('email', translate('email'), 'trim|required|valid_email');
                $this->form_validation->set_rules('phone', translate('phone'), 'trim|required');
            }
            if ($this->form_validation->run() !== false) {
                $stu = $this->userrole_model->getStudentDetails();
                $feesType = explode("|", $this->input->post('fees_type'));

                $params = array(
                    'student_id' => $stu['student_id'],
                    'student_name' => $stu['fullname'],
                    'student_email' => $stu['student_email'],
                    'invoice_no' => $this->input->post('invoice_no'),
                    'allocation_id' => $feesType[0],
                    'type_id' => $feesType[1],
                    'amount' => $this->input->post('fee_amount'),
                    'fine' => $this->input->post('fine_amount'),
                    'currency' => $this->data['global_config']['currency'],
                );

                if ($payVia == 'paypal') {
                    $url = base_url("feespayment/paypal");
                    $this->session->set_userdata("params", $params);
                }

                if ($payVia == 'stripe') {
                    $cardData = array(
                        'number' => $this->input->post('card_number'),
                        'expiryMonth' => $this->input->post('expire_month'),
                        'expiryYear' => $this->input->post('expire_year'),
                        'cvv' => $this->input->post('cvv'),
                    );
                    $params['card_data'] = $cardData;
                    $url = base_url("feespayment/stripe");
                    $this->session->set_userdata("params", $params);
                }

                if ($payVia == 'payumoney') {
                    $payerData = array(
                        'name' => $this->input->post('payer_name'),
                        'email' => $this->input->post('email'),
                        'phone' => $this->input->post('phone'),
                    );
                    $params['payer_data'] = $payerData;
                    $url = base_url("feespayment/payumoney");
                    $this->session->set_userdata("params", $params);
                }

                if ($payVia == 'paystack') {
                    $url = base_url("feespayment/paystack");
                    $this->session->set_userdata("params", $params);
                }

                if ($payVia == 'razorpay') {
                    $url = base_url("feespayment/razorpay");
                    $this->session->set_userdata("params", $params);
                }
                
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'url' => '', 'error' => $error);
            }
            echo json_encode($array);
        }
    }

    public function paypal()
    {
        $config = $this->get_payment_config();
        $params = $this->session->userdata('params');
        if (!empty($params)) {
            if ($config['paypal_username'] == "" || $config['paypal_password'] == "" || $config['paypal_signature'] == "") {
                set_alert('error', 'Paypal config not available');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $data = array(
                    'cancelUrl' => base_url('feespayment/getsuccesspayment'),
                    'returnUrl' => base_url('feespayment/getsuccesspayment'),
                    'fees_allocation_id' => $params['allocation_id'],
                    'fees_type_id' => $params['type_id'],
                    'name' => $params['student_name'],
                    'description' => "Online Student fees deposit. Invoice No - " . $params['invoice_no'],
                    'amount' => floatval($params['amount'] + $params['fine']),
                    'currency' => $params['currency'],
                );
                $response = $this->paypal_payment->payment($data);
                if ($response->isSuccessful()) {

                } elseif ($response->isRedirect()) {
                    $response->redirect();
                } else {
                    echo $response->getMessage();
                }
            }
        }
    }

    /* paypal successpayment redirect */
    public function getsuccesspayment()
    {
        $params = $this->session->userdata('params');
        if (!empty($params)) {
            // null session data
            $this->session->set_userdata("params", "");
            $data = array(
                'fees_allocation_id' => $params['allocation_id'],
                'fees_type_id' => $params['type_id'],
                'name' => $params['student_name'],
                'description' => "Online Student fees deposit. Invoice No - " . $params['invoice_no'],
                'amount' => floatval($params['amount'] + $params['fine']),
                'currency' => $params['currency'],
            );
            $response = $this->paypal_payment->success($data);
            $paypalResponse = $response->getData();
            if ($response->isSuccessful()) {
                $purchaseId = $_GET['PayerID'];
                if (isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {
                    if ($purchaseId) {
                        $ref_id = $paypalResponse['PAYMENTINFO_0_TRANSACTIONID'];
                        // payment info update in invoice
                        $arrayFees = array(
                            'allocation_id' => $params['allocation_id'],
                            'type_id' => $params['type_id'],
                            'collect_by' => "",
                            'amount' => floatval($paypalResponse['PAYMENTINFO_0_AMT'] - $params['fine']),
                            'discount' => 0,
                            'fine' => $params['fine'],
                            'pay_via' => 6,
                            'collect_by' => 'online',
                            'remarks' => "Fees deposits online via Paypal Ref ID: " . $ref_id,
                            'date' => date("Y-m-d"),
                        );
                        $this->savePaymentData($arrayFees);

                        set_alert('success', translate('payment_successfull'));
                        redirect(base_url('userrole/invoice'));
                    }
                }
            } elseif ($response->isRedirect()) {
                $response->redirect();
            } else {
                set_alert('error', translate('payment_cancelled'));
                redirect(base_url('userrole/invoice'));
            }
        }
    }

    public function stripe()
    {
        $config = $this->get_payment_config();
        $params = $this->session->userdata('params');
        if (!empty($params)) {
            if ($config['stripe_secret'] == "") {
                set_alert('error', 'Stripe config not available');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                // null session data
                $this->session->set_userdata("params", "");
                try {
                    $response = $this->stripe_payment->payment($params);
                    if ($response->isSuccessful()) {
                        $ref_id = $response->getTransactionReference();
                        $response = $response->getData();
                        if ($response['status'] == 'succeeded') {
                            // payment info update in invoice
                            $arrayFees = array(
                                'allocation_id' => $params['allocation_id'],
                                'type_id' => $params['type_id'],
                                'collect_by' => "",
                                'amount' => ($response['amount'] / 100) - $params['fine'],
                                'discount' => 0,
                                'fine' => $params['fine'],
                                'pay_via' => 7,
                                'collect_by' => 'online',
                                'remarks' => "Fees deposits online via Stripe Ref ID: " . $ref_id,
                                'date' => date("Y-m-d"),
                            );
                            $this->savePaymentData($arrayFees);

                            set_alert('success', translate('payment_successfull'));
                            redirect(base_url('userrole/invoice'));
                        }
                    } elseif ($response->isRedirect()) {
                        $response->redirect();
                    } else {
                        // payment failed: display message to customer
                        set_alert('error', "Something went wrong!");
                        redirect(site_url('feespayment/invoice'));
                    }
                } catch (\Exception $ex) {
                    set_alert('error', $ex->getMessage());
                    redirect(site_url('feespayment/invoice'));
                }
            }
        }
    }

    public function paystack()
    {
        $config = $this->get_payment_config();
        $params = $this->session->userdata('params');
        if (!empty($params)) {
            if ($config['paystack_secret_key'] == "") {
                set_alert('error', 'Paystack config not available');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $result = array();
                $amount = ($params['amount'] + $params['fine']) * 100;
                $ref = app_generate_hash();
                $callback_url = base_url().'feespayment/verify_paystack_payment/'.$ref;
                $postdata =  array('email' => $params['student_email'], 'amount' => $amount,"reference" => $ref, "callback_url" => $callback_url);
                $url = "https://api.paystack.co/transaction/initialize";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postdata));  //Post Fields
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $headers = [
                    'Authorization: Bearer ' . $config['paystack_secret_key'],
                    'Content-Type: application/json',
                ];
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $request = curl_exec ($ch);
                curl_close ($ch);
                //
                if ($request) {
                    $result = json_decode($request, true);
                }

                $redir = $result['data']['authorization_url'];
                header("Location: ".$redir);
            }
        }
    }

    public function verify_paystack_payment($ref)
    {
        $config = $this->get_payment_config();
        $params = $this->session->userdata('params');
        // null session data
        $this->session->set_userdata("params", "");
        $result = array();
        $url = 'https://api.paystack.co/transaction/verify/'.$ref;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '.$config['paystack_secret_key']]
        );
        $request = curl_exec($ch);
        curl_close($ch);
        //
        if ($request) {
            $result = json_decode($request, true);
            // print_r($result);
            if($result){
                if($result['data']){
                    //something came in
                    if($result['data']['status'] == 'success'){
                        // payment info update in invoice
                        $arrayFees = array(
                            'allocation_id' => $params['allocation_id'],
                            'type_id' => $params['type_id'],
                            'collect_by' => "",
                            'amount' => $params['amount'],
                            'discount' => 0,
                            'fine' => $params['fine'],
                            'pay_via' => 9,
                            'collect_by' => 'online',
                            'remarks' => "Fees deposits online via Paystack Ref ID: " . $ref,
                            'date' => date("Y-m-d"),
                        );
                        $this->savePaymentData($arrayFees);

                        set_alert('success', translate('payment_successfull'));
                        redirect(base_url('userrole/invoice'));

                    }else{
                        // the transaction was not successful, do not deliver value'
                        // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
                        set_alert('error', "Transaction Failed");
                        redirect(base_url('userrole/invoice'));
                    }
                }else{
                    //echo $result['message'];
                set_alert('error', "Transaction Failed");
                redirect(base_url('userrole/invoice'));
                }
            }else{
                //print_r($result);
                //die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
                set_alert('error', "Transaction Failed");
                redirect(base_url('userrole/invoice'));
            }
        }else{
            //var_dump($request);
            //die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
            set_alert('error', "Transaction Failed");
            redirect(base_url('userrole/invoice'));
        }

    }

    /* PayUmoney Payment */
    public function payumoney()
    {
        $config = $this->get_payment_config();
        $params = $this->session->userdata('params');
        if (!empty($params)) {
            if ($config['payumoney_key'] == "" || $config['payumoney_salt'] == "") {
                set_alert('error', 'PayUmoney config not available');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                // api config
                if ($config['payumoney_demo'] == 1) {
                    $api_link = "https://test.payu.in/_payment";
                } else {
                    $api_link = "https://secure.payu.in/_payment";
                }
                $key = $config['payumoney_key'];
                $salt = $config['payumoney_salt'];

                // payumoney details
                $invoiceNo = $params['invoice_no'];
                $amount = floatval($params['amount'] + $params['fine']);
                $payer_name = $params['payer_data']['name'];
                $payer_email = $params['payer_data']['email'];
                $payer_phone = $params['payer_data']['phone'];
                $product_info = "Online Student fees deposit. Invoice No - " . $invoiceNo;
                // redirect url
                $success = base_url('feespayment/payumoney_success');
                $fail = base_url('feespayment/payumoney_success');
                // generate transaction id
                $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                $params['txn_id'] = $txnid;
                $this->session->set_userdata("params", $params);

                // optional udf values
                $udf1 = '';
                $udf2 = '';
                $udf3 = '';
                $udf4 = '';
                $udf5 = '';

                $hashstring = $key . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $payer_name . '|' . $payer_email . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $salt;
                $hash = strtolower(hash('sha512', $hashstring));
                $data = array(
                    'salt' => $salt,
                    'key' => $key,
                    'payu_base_url' => $api_link,
                    'action' => $api_link,
                    'surl' => $success,
                    'furl' => $fail,
                    'txnid' => $txnid,
                    'amount' => $amount,
                    'firstname' => $payer_name,
                    'email' => $payer_email,
                    'phone' => $payer_phone,
                    'productinfo' => $product_info,
                    'hash' => $hash,
                );
                $this->load->view('layout/payumoney', $data);
            }
        }
    }

    /* payumoney successpayment redirect */
    public function payumoney_success()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $params = $this->session->userdata('params');
            // null session data
            $this->session->set_userdata("params", "");
            if ($this->input->post('status') == "success") {
                $txn_id = $params['txn_id'];
                $mihpayid = $this->input->post('mihpayid');
                $transactionid = $this->input->post('txnid');
                if ($txn_id == $transactionid) {
                    // payment info update in invoice
                    $arrayFees = array(
                        'allocation_id' => $params['allocation_id'],
                        'type_id' => $params['type_id'],
                        'collect_by' => "",
                        'amount' => $this->input->post('amount'),
                        'discount' => 0,
                        'fine' => $params['fine'],
                        'pay_via' => 8,
                        'collect_by' => 'online',
                        'remarks' => "Fees deposits online via PayU TXN ID: " . $txn_id . " / PayU Ref ID: " . $mihpayid,
                        'date' => date("Y-m-d"),
                    );
                    $this->savePaymentData($arrayFees);

                    set_alert('success', translate('payment_successfull'));
                    redirect(base_url('userrole/invoice'));
                } else {
                    set_alert('error', translate('invalid_transaction'));
                    redirect(base_url('userrole/invoice'));
                }
            } else {
                set_alert('error', "Transaction Failed");
                redirect(base_url('userrole/invoice'));
            }
        }
    }

    public function razorpay()
    {
        $config = $this->get_payment_config();
        $params = $this->session->userdata('params');
        if (!empty($params)) {
            if ($config['razorpay_key_id'] == "" || $config['razorpay_key_secret'] == "") {
                set_alert('error', 'Razorpay config not available');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $response = $this->razorpay_payment->payment($params);
                $params['razorpay_order_id'] = $response;
                $this->session->set_userdata("params", $params);
                $arrayData = array(
                    'key' => $config['razorpay_key_id'], 
                    'amount' => ($params['amount'] + $params['fine']) * 100, 
                    'name' => $params['student_name'], 
                    'description' => "Submitting student fees online. Invoice No - " . $params['invoice_no'], 
                    'image' => base_url('uploads/app_image/logo-small.png'), 
                    'currency' => 'INR', 
                    'order_id' => $params['razorpay_order_id'], 
                    'theme' => ["color" => "#F37254"], 
                );
                $data['return_url'] = base_url('userrole/invoice');
                $data['pay_data'] = json_encode($arrayData);
                $this->load->view('layout/razorpay', $data);

            }
        }
    }

    public function razorpay_verify()
    { 
        $params = $this->session->userdata('params');
        if ($this->input->post('razorpay_payment_id')) {
            // null session data
            $this->session->set_userdata("params", "");
            $attributes = array(
                'razorpay_order_id' => $params['razorpay_order_id'],
                'razorpay_payment_id' => $this->input->post('razorpay_payment_id'),
                'razorpay_signature' => $this->input->post('razorpay_signature')
            );
            $response = $this->razorpay_payment->verify($attributes);
            if ($response == TRUE) {
                // payment info update in invoice
                $arrayFees = array(
                    'allocation_id' => $params['allocation_id'],
                    'type_id' => $params['type_id'],
                    'collect_by' => "",
                    'amount' => ($params['amount'] + $params['fine']),
                    'discount' => 0,
                    'fine' => $params['fine'],
                    'pay_via' => 10,
                    'collect_by' => 'online',
                    'remarks' => "Fees deposits online via Razorpay TxnID: " . $attributes['razorpay_payment_id'],
                    'date' => date("Y-m-d"),
                );
                $this->savePaymentData($arrayFees);
                set_alert('success', translate('payment_successfull'));
                redirect(base_url('userrole/invoice'));
            } else {
                set_alert('error', $response);
                redirect(base_url('userrole/invoice')); 
            }
        }
    }


    private function savePaymentData($data)
    {
        // insert in DB
        $this->db->insert('fee_payment_history', $data);

        // transaction voucher save function
        $getSeeting =  $this->fees_model->get('transactions_links', array('branch_id' => get_loggedin_branch_id()), true);
        if ($getSeeting['status']) {
            $arrayTransaction = array(
                'account_id' => $getSeeting['deposit'],
                'amount' => $data['amount'] + $data['fine'],
                'date' => $data['date'],
            );
            $this->fees_model->saveTransaction($arrayTransaction);
        }
    }
}
