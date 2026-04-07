<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Msg91 {

    protected $authKey;
    protected $senderID;

	public function __construct () {
        $ci = & get_instance();
        if (is_superadmin_loggedin()) {
            $branchID = $ci->input->post('branch_id');
        } else {
            $branchID = get_loggedin_branch_id();
        }
        $msg91 = $ci->db->get_where('sms_credential', array('id' => 3, 'branch_id' => $branchID))->row_array();

        $this->authKey  = $msg91['field_one'];
        $this->senderID = $msg91['field_two'];
        $this->url      = 'https://msg91sms.vsms.net/eapi/submission/send_sms/2/2.0';
	}

    public function send($to, $message) {
        //Your message to send, Add URL encoding here.
        $message = urlencode($message);

        //Define route
        $route = 4;
        //Prepare you post parameters
        $postData = array(
            'authkey' => $this->authKey,
            'mobiles' => $to,
            'message' => $message,
            'sender' => $this->senderID,
            'route' => $route
        );

        //API URL
        $url="http://api.msg91.com/api/sendhttp.php";

        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //get response
        $output = curl_exec($ch);

        //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }

        curl_close($ch);

        if ($output) {
            return TRUE;
        } else {
            return FALSE;
        }
	}
}





























?>