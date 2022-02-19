<?php

include 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
if(isset($_POST['submit'])){
   
if($_FILES["select_excel"]["name"] != '')
{
    echo "Inside";
 $allowed_extension = array('xls', 'xlsx');
 $file_array = explode(".", $_FILES['select_excel']['name']);
 $file_extension = end($file_array);
 if(in_array($file_extension, $allowed_extension))
 {
  $reader = IOFactory::createReader('Xlsx');
  $spreadsheet = $reader->load($_FILES['select_excel']['tmp_name']);

  $writer = IOFactory::createWriter($spreadsheet, 'Html');
  $message = $writer->save('out');
  $excelSheet = $spreadsheet->getActiveSheet();
  $spreadSheetAry = $excelSheet->toArray();
  var_dump($spreadSheetAry);
  for ($i = 0; $i <= $sheetCount; $i ++) {
      var_dump($spreadSheetAry[$i][0]);
      
    // $name = "";
    // if (isset($spreadSheetAry[$i][0])) {
    //     $name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
    // }
    // $description = "";
    // if (isset($spreadSheetAry[$i][1])) {
    //     $description = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
    // }

    // if (! empty($name) || ! empty($description)) {
    //     //$query = "insert into tbl_info(name,description) values(?,?)";
    //     $paramType = "ss";
    //     $paramArray = array(
    //         $name,
    //         $description
    //     );
    //     // $insertId = $db->insert($query, $paramType, $paramArray);
    //     // $query = "insert into tbl_info(name,description) values('" . $name . "','" . $description . "')";
    //     // $result = mysqli_query($conn, $query);

    //     // if (! empty($insertId)) {
    //     //     $type = "success";
    //     //     $message = "Excel Data Imported into the Database";
    //     // } else {
    //     //     $type = "error";
    //     //     $message = "Problem in Importing Excel Data";
    //     // }
    // }else{
    //     echo "Empty Excel";
    }
}
 
 else
 {
  $message = '<div class="alert alert-danger">Only .xls or .xlsx file allowed</div>';
 }
}
else
{
 $message = '<div class="alert alert-danger">Please Select File</div>';
}

echo $message;

}
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
	font-family: Arial;
	width: 550px;
}

.outer-container {
	background: #F0F0F0;
	border: #e0dfdf 1px solid;
	padding: 40px 20px;
	border-radius: 2px;
}

.btn-submit {
	background: #333;
	border: #1d1d1d 1px solid;
	border-radius: 2px;
	color: #f0f0f0;
	cursor: pointer;
	padding: 5px 20px;
	font-size: 0.9em;
}

.tutorial-table {
	margin-top: 40px;
	font-size: 0.8em;
	border-collapse: collapse;
	width: 100%;
}

.tutorial-table th {
	background: #f0f0f0;
	border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.tutorial-table td {
	background: #FFF;
	border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
	padding: 10px;
	margin-top: 10px;
	border-radius: 2px;
	display: none;
}

.success {
	background: #c7efd9;
	border: #bbe2cd 1px solid;
}

.error {
	background: #fbcfcf;
	border: #f3c6c7 1px solid;
}

div#response.display-block {
	display: block;
}
</style>
</head>

<body>
    <h2>Import Excel File into MySQL Database using PHP</h2>

    <div class="outer-container">
        <form method="post" name="frmExcelImport"
            id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Choose Excel File</label> <input type="file"
                    name="select_excel" id="select_excel" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="submit"
                    class="btn-submit">Import</button>

            </div>

        </form>

    </div>
    <div id="response">
       </div>




</body>
</html>