<?php
session_start();
error_reporting();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");


include '../Db_Connection/db_libforsmall.php';
?>
<?php

    $whereClause = '';
    if( isset( $_GET["id"] ) ) {
        $whereClause .= 'id=' . $_GET["id"] ;
    }

    if( isset( $_GET["p_id"] ) ) {
        $whereClause .= !empty($whereClause) ? ' AND ' : ' ' ;
        $whereClause .= 'p_id=' . $_GET["p_id"];
    }
    
    $sql = 'SELECT
                c.id,
                c.p_id,
                c.user_id,
                c.qty,
                c.status,
                c.exchange_product,
                c.exchange_price,
                p.product_title,
                p.product_qty,
                p.product_price,
                p.product_brand
            FROM
                cart c
            INNER JOIN products p ON
                c.p_id = p.product_id';

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