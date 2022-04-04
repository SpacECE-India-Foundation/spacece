<?php
session_start();
error_reporting();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

include '../Db_Connection/db_khanstore.php';


?>
<?php

    $whereClause = '';
    if( isset( $_GET["product_id"] ) ) {
        $whereClause .= 'product_id=' . $_GET["product_id"] ;
    }

    if( isset( $_GET["product_brand"] ) ) {
        $whereClause .= !empty($whereClause) ? ' AND ' : ' ' ;
        $whereClause .= 'product_brand=' . $_GET["product_brand"];
    }
    
    $sql = "SELECT 
        product_id, product_brand, product_title, product_price, product_qty
        product_desc, product_image, product_keywords, exchange_price, rent_price, deposit 
    FROM 
        products";

    if(!empty($whereClause)){
        $sql .= ' WHERE ' . $whereClause;
    } else{
        $sql .= ' LIMIT 35';
    }

    $res = mysqli_query( $conn, $sql );
    header('Content-Type:application/json');

//checking whether query is excuted or not
if ($res) {
    // count that data is there or not in database
    $count = mysqli_num_rows($res);
    $sno = 1;
    if ($count > 0) {
        // we have data in database
        while ($row = mysqli_fetch_assoc($res)) {

            $arr[] = $row;   // making array of data

        }
        echo json_encode(['status' => 'success', 'data' => $arr, 'result' => 'found']);
        //echo json_encode(['status'=>'success','result'=>'found']);


    } else {
        echo json_encode(['status' => 'failure', 'result' => 'not found']);
    }
}

?>