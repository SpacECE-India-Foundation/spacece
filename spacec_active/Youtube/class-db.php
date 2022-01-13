<?php
class DB {
    // private $dbHost     = "localhost";
    // private $dbUsername = "root";
    // private $dbPassword = "";
    private $dbHost     = "3.109.14.4";
    private $dbUsername = "ostechnix";
    private $dbPassword = "Password123#@!";
     private $dbName     = "space_active";
  
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
        if( $this->db->query("INSERT INTO youtube_videos(user_email,video_id,title,v_description,category_id,playlist_id,act_id) VALUES('$user', '$video_id','$title','$summary','$category','$pl_id,'$act_id')")){
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
    public function AddActivity($act_name,$act_lvl,$act_dom,$act_obj,$act_key,$act_mat,$act_asses,$act_pro,$act_ins,$status,$act_date,$playlist_id,$pl_desc,$pl_name){
        if( $this->db->query("INSERT INTO spaceactive_activities (activity_name,activity_level,activity_dev_domain,activity_objectives,
    activity_key_dev,activity_material,activity_assessment,activity_process,activity_instructions,
    status,activity_date,playlist_id,playlist_descr,playlist_name) 
    values ('$act_name','$act_lvl','$act_dom','$act_obj','$act_key','$act_mat','$act_asses','$act_pro','$act_ins','$status','$act_date','$playlist_id','$pl_desc','$pl_name')")){
          echo "Success";
         
    } else{
        
        echo "Error";
    }
    }
    
}