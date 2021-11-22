<?php
class DB {
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "spaceece";
  
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
        if($result->num_rows) {
            return false;
        }
  
        return true;
    }
  
    public function get_access_token() {
        $sql = $this->db->query("SELECT provider_value FROM youtube_oauth WHERE provider = 'youtube'");
        $result = $sql->fetch_assoc();
        return json_decode($result['provider_value']);
    }
  
    public function get_refersh_token() {
        $result = $this->get_access_token();
        return $result->refresh_token;
    }
  
    public function update_access_token($token) {
        if($this->is_table_empty()) {
            $this->db->query("INSERT INTO youtube_oauth(provider, provider_value) VALUES('youtube', '$token')");
        } else {
            $this->db->query("UPDATE youtube_oauth SET provider_value = '$token' WHERE provider = 'youtube'");
        }
    }
}