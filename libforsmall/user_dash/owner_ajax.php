<?php
// db settings
include '../../Db_Connection/db_libforsmall.php';

// db connection
// $draw = $_POST['draw'];
//    $row = $_POST['start'];
//    $rowperpage = $_POST['length']; // Rows display per page
//    $columnIndex = $_POST['order'][0]['column']; // Column index
//    $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
//    $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
//    $searchValue = $_POST['search']['value']; // Search value
$column = array("order_id", "payment_id", "payment_id", "grand_total","address","mobile","user_name","u_note","u_note");
$sql = "SELECT order_id as order_id,payment_id as payment_id, grand_total as GrandTotalPrice,address as Address,mobile as MobileNumber,
 user_name as Name,u_note  as Note,p_status as Status FROM orders ";
  // $sql .= "WHERE owner_id = '56'";

    if(isset($_POST["search"]["value"]))
{
 $sql .= '
 WHERE order_id LIKE "%'.$_POST["search"]["value"].'%" 
 OR payment_id LIKE "%'.$_POST["search"]["value"].'%" 
 OR grand_total LIKE "%'.$_POST["search"]["value"].'%"
 OR address LIKE "%'.$_POST["search"]["value"].'%" 
 OR mobile LIKE "%'.$_POST["search"]["value"].'%" 
 OR user_name LIKE "%'.$_POST["search"]["value"].'%"
 OR u_note LIKE "%'.$_POST["search"]["value"].'%" 
 OR p_status LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}
if(isset($_POST["order"]))
{
 $sql .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $sql .= 'ORDER BY order_id DESC ';
}
$sql1 = '';


if($_POST["length"] != -1)
{
 $sql1 = ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
//echo $sql . $sql1;
$res = $conn->query($sql . $sql1);

   // header('Content-Type:application/json');

    if ($res) {
        // count that data is there or not in database
        $count = mysqli_num_rows($res);
        $sno = 1;
        if ($count > 0) {
            // we have data in database
            while ($row = mysqli_fetch_assoc($res)) {
                
                $result[]=  array('Address' => $row['Address'],
                'GrandTotalPrice'=>$row['GrandTotalPrice'],
                'MobileNumber'=>$row['MobileNumber'],
                'Name'=>$row['Name'],
                'Note'=>$row['Note'],
                'Status'=>$row['Status'],
                'Order_id'=>$row['order_id'],
                'Payment_id'=>$row['payment_id']
                ); 
            }
            $dataset = array(
                'draw'   => intval($_POST['draw']),
                "totalrecords" =>100,
                "totaldisplayrecords" =>$count,
                "data" => $result
            );
            echo json_encode($dataset);
// fetch records
        }

    }


?>