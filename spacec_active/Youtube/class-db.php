<?php

//include('../../Db_Connection/constants.php');

//For delete. It should come from above constants.php file
if(!defined('DB_HOST_NAME'))
define('DB_HOST_NAME', 'database-spacece.cjnrqpvibfnn.ap-south-1.rds.amazonaws.com');

if(!defined('DB_USER_NAME'))
define('DB_USER_NAME', 'spaceuser');

if(!defined('DB_USER_PASSWORD'))
define('DB_USER_PASSWORD', 'Spaceuser12#');

if(!defined('CURRENCY'))
define('CURRENCY', '₹');

if(!defined('DB_NAME_SPACE_ACTIVE'))
define('DB_NAME_SPACE_ACTIVE', 'space_active');

class DB {
    private $dbHost     = DB_HOST_NAME;
    private $dbUsername = DB_USER_NAME;
    private $dbPassword = DB_USER_PASSWORD;
    private $dbName     = DB_NAME_SPACE_ACTIVE;
  
    public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
  
    public function is_table_empty() {
        $result = $this->db->query("SELECT id FROM youtube_oauth WHERE provider = 'youtube'");
        //$result->num_rows > 0 ||
        if($result->num_rows) {
            return false;
        }  
        return true;
    }
  
    public function get_access_token() {
       
        $sql = $this->db->query("SELECT provider_value FROM youtube_oauth WHERE provider = 'youtube'");
       
        $result = $sql->fetch_assoc();
     //var_dump( json_($result['provider_value']));
        return json_decode($result['provider_value']);
    }
    public function upload_video_to_db($video_id, $title, $summary,$category,$user,$act_id,$pl_id){
        if( $this->db->query("INSERT INTO youtube_videos(user_email,video_id,title,v_description,category_id,playlist_id,act_id) VALUES('$user', '$video_id','$title','$summary','$category','$pl_id','$act_id')")){
            echo "Success";
        }
        else{
            echo "Error";
        }
     }
 
 
     public function get_Videos($user,$act_id){
         $sql= $this->db->query("SELECT * from youtube_videos where user_email='$user' and act_id= '$act_id' ");
       
        
       while($result = $sql->fetch_assoc()){
         $data[]= $result;
       }
       
        return $data;
     }
 
     public function get_all_Videos($act_id){
      
         $sql= $this->db->query("SELECT * from youtube_videos Where act_id= '$act_id' ");
         
         while($result = $sql->fetch_assoc()){
            $data[]= $result;
         }

         return $data;
     }
    

    public function get_refersh_token() {
        $result = $this->get_access_token();
        return $result->refresh_token;
    }
  
    public function update_access_token($token) {
        //var_dump($token);
        if($this->is_table_empty()) {
            $this->db->query("INSERT INTO youtube_oauth(provider, provider_value) VALUES('youtube', '$token')");
        } else {
            $this->db->query("UPDATE youtube_oauth SET provider_value = '$token' WHERE provider = 'youtube'");
        }
    }
    public function AddActivity($act_name,$act_lvl,$act_dom,$act_obj,$act_key,$act_mat,$act_asses,$act_pro,$act_ins,$status,$act_date,$playlist_id,$pl_desc,$pl_name,$flag){
        if( $this->db->query("INSERT INTO spaceactive_activities (activity_name,activity_level,activity_dev_domain,activity_objectives,
    activity_key_dev,activity_material,activity_assessment,activity_process,activity_instructions,
    status,activity_date,playlist_id,playlist_descr,playlist_name,flag) 
    values ('$act_name','$act_lvl','$act_dom','$act_obj','$act_key','$act_mat','$act_asses','$act_pro','$act_ins','$status','$act_date','$playlist_id','$pl_desc','$pl_name','$flag')")){
          echo "Success";
         
    } else{
        
        echo "Error";
    }
    }
    
}