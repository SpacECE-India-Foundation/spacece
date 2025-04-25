<?php
if(file_exists('../../Db_Connection/constants.php')){
    include('../../Db_Connection/constants.php');

}else{
    include('../Db_Connection/constants.php');
}


class Functions
{
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = mysqli_connect(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_NAME_SPACTUBE);
            if (!$this->conn) {
                throw new Exception('Failed to connect to Database:');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    public function validate($string)
    {
        $string_vali = mysqli_real_escape_string($this->conn, trim(strip_tags($string)));
        $string_vali = urldecode($string_vali);
        return $string_vali;
    }

    public function insert($tb_name, $tb_field)
    {

        $q_data = "";

        foreach ($tb_field as $q_key => $q_value) {
            $q_data = $q_data . "$q_key='$q_value',";
        }
        $q_data = rtrim($q_data, ",");

        $query = "INSERT INTO $tb_name SET $q_data";
        //echo  $query;
        $insert_fire = mysqli_query($this->conn, $query);
        if ($insert_fire) {
            return $insert_fire;
        } else {
            return false;
        }
    }

    public function selected_order($tbl_name, $field_id)
    {

        $select = "SELECT DISTINCT $field_id FROM $tbl_name";
        $query = mysqli_query($this->conn, $select);
        if (mysqli_num_rows($query) > 0) {
            $select_fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
            if ($select_fetch) {
                return $select_fetch;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function select_order($tbl_name, $field_id, $order = 'ASC')
    {

        $select = "SELECT * FROM $tbl_name ORDER BY $field_id $order";

        $query = mysqli_query($this->conn, $select);
        if (mysqli_num_rows($query) > 0) {
            $select_fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
            if ($select_fetch) {
                return $select_fetch;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function trend_video_cat($tbl_name, $tb_field, $field_id, $order)
    {
        //echo $field_id;

        // $field_op = "";
        // foreach ($field_id as $q_key => $q_value) {
        //     $field_op = $field_op . "$q_key='$q_value' $op ";
        // }
        // $field_op = rtrim($field_op, "$op ");

        $select = "SELECT * FROM  $tbl_name WHERE filter='$tb_field' ORDER BY $field_id $order LIMIT 5";
        //echo $select;
        $query = mysqli_query($this->conn, $select);
        if (mysqli_num_rows($query) > 0) {
            $select_fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
            if ($select_fetch) {
                return $select_fetch;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function filter_video($tbl_name, $tb_field, $status, $field_id, $order, $search)
    {
        //echo $field_id;

        // $field_op = "";
        // foreach ($field_id as $q_key => $q_value) {
        //     $field_op = $field_op . "$q_key='$q_value' $op ";
        // }
        // $field_op = rtrim($field_op, "$op ");
        if ($status != null){
            $select = "SELECT * FROM  $tbl_name WHERE  status='$status' AND title LIKE '%$search%'";
        }
           
        else{

            $select = "SELECT * FROM  $tbl_name WHERE status='$status' AND title LIKE '%$search%'";
        
        }    //echo $select;
        $query = mysqli_query($this->conn, $select);
        
        if (mysqli_num_rows($query) > 0) {
            $select_fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
            if ($select_fetch) {
                return $select_fetch;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function select_order_where($tbl_name, $condition, $field_id, $op = 'AND', $order = 'ASC')
    {

        $field_op = "";
        foreach ($condition as $q_key => $q_value) {
            $field_op = $field_op . "$q_key='$q_value' $op ";
        }
        $field_op = rtrim($field_op, "$op ");

        $select = "SELECT * FROM $tbl_name WHERE $field_op ORDER BY $field_id $order";
        $query = mysqli_query($this->conn, $select);
        if (mysqli_num_rows($query) > 0) {
            $select_fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
            if ($select_fetch) {
                return $select_fetch;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function update($tblname, $field_data, $condition, $op = 'AND')
    {

        $field_row = "";
        foreach ($field_data as $q_key => $q_value) {
            $field_row = $field_row . "$q_key='$q_value',";
        }
        $field_row = rtrim($field_row, ",");

        $field_op = "";

        foreach ($condition as $q_key => $q_value) {
            $field_op = $field_op . "$q_key='$q_value' $op ";
        }
        $field_op = rtrim($field_op, "$op");

        $update = "UPDATE $tblname SET $field_row WHERE $field_op";
        $update_fire = mysqli_query($this->conn, $update);
        if ($update_fire) {
            return $update_fire;
        } else {
            return false;
        }
    }

    public function delete($tblname, $condition, $op = 'AND')
    {

        $delete_data = "";

        foreach ($condition as $q_key => $q_value) {
            $delete_data = $delete_data . "$q_key='$q_value' $op ";
        }

        $delete_data = rtrim($delete_data, "$op ");
        $delete = "DELETE FROM $tblname WHERE $delete_data";
        $delete_fire = mysqli_query($this->conn, $delete);
        if ($delete_fire) {
            return $delete_fire;
        } else {
            return false;
        }
    }

    public function select_assoc($tbl_name, $condition, $op = 'AND')
    {

        $field_op = "";
        foreach ($condition as $q_key => $q_value) {
            $field_op = $field_op . "$q_key='$q_value' $op ";
        }
        $field_op = rtrim($field_op, "$op ");

        $select_assoc = "SELECT * FROM $tbl_name WHERE $field_op";

        $select_assoc_query = mysqli_query($this->conn, $select_assoc);
        if (mysqli_num_rows($select_assoc_query) == 1) {

            $select_assoc_fire = mysqli_fetch_assoc($select_assoc_query);
            if ($select_assoc_fire) {
                return $select_assoc_fire;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // public function trend_video_cat($tblname, $field_data, $condition){
    //    // echo $tblname;
    //    // echo $condition;
    //     echo $field_data;
    // }

    public function checkSubscription($table, $email)
    {
        $select_assoc = "SELECT * FROM $table WHERE email='$email'";
        /// echo $select_assoc;
        $select_assoc_query = mysqli_query($this->conn, $select_assoc);
        if (mysqli_num_rows($select_assoc_query) > 1) {
            return true;
        }
        return false;
    }
}
