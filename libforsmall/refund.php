<?php

if (isset($_POST['refundInit'])) {
    $trx_id = $_POST['trx_id'];
    $refund_amt = $_POST['refund_amt'];
    refundInit($trx_id, $refund_amt);
}

function refundInit($trx_id, $refund_amt)
{
    $ch = curl_init();

    // curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/refunds/');
    curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/refunds/');
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            // "X-Api-Key:e4f2b4dc4a9538131479fd94c84eb10e",
            // "X-Auth-Token:c317f9c3980dfde368345eace142711d"
            "X-Api-Key:test_d93c3d591e0abb22ab505118e62",
            "X-Auth-Token:test_76954866b66d6b27022e3086fd6"
        )
    );
    $payload = array(
        'transaction_id' => 'partial_refund_1',
        'payment_id' => $trx_id,
        'type' => 'QFL',
        'body' => "Customer isn't satisfied with the quality",
        "refund_amount" => $refund_amt,
        "total_amount" => $refund_amt,
        "created_at" => date("Y-m-d H:i:s")
    );
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
    // echo $response;

    exit();
}
