<?php
class DB {
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
    public function upload_video_to_db($video_id, $title, $summary,$category,$user){
        if( $this->db->query("INSERT INTO youtube_videos(user_id,video_id,title,description,category_id) VALUES('$user', '$video_id','$title','$summary','$category')")){
            echo "Success";
        }
        else{
            echo "Error";
        }
     }
 
 
     public function get_Videos($user){
         $sql= $this->db->query("SELECT * from youtube_videos where user_id='$user' ");
         //$data[]=array();
        
       while($result = $sql->fetch_assoc()){
         $data[]= $result;
       }
       if(count($data)>0){
        return $data;
       }else{
        return "No Video found";
       }
      
     }
 
     public function get_all_Videos(){
         //$data[]=array();
         $sql= $this->db->query("SELECT * from youtube_videos  ");
         while($result = $sql->fetch_assoc()){
            $data[]= $result;
         }
           if(count($data)>0){
            return $data;
           }else{
            return "No Video found";
           }
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
    
}