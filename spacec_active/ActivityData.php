<?php
require('config.php');
class ActivityData extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $actTable = 'spaceactive_activities';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 		
			//$database = new dbConfig();
			//var_dump($database);            
            $this -> hostName = '3.109.14.4';
            $this -> userName = 'ostechnix';
            $this -> password = 'Password123#@!';
			// $this -> hostName = 'localhost';
            // $this -> userName = 'root';
            // $this -> password = '';
			$this -> dbName ='space_active';			
            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
			
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else{
                $this->dbConnect = $conn;
        	 }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}   	
	public function activityList(){		
		$sqlQuery = "SELECT * FROM ".$this->actTable." ";
	
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'where(activity_no LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR activity_name LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR activity_level LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR activity_dev_domain LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR activity_objectives LIKE "%'.$_POST["search"]["value"].'%") ';	
			$sqlQuery .= ' OR activity_key_dev LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR activity_material LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR activity_assessment LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR activity_process LIKE "%'.$_POST["search"]["value"].'%") ';	
			$sqlQuery .= ' OR activity_instructions LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR status LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR activity_date LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR playlist_id LIKE "%'.$_POST["search"]["value"].'%") ';	
			$sqlQuery .= ' OR playlist_name LIKE "%'.$_POST["search"]["value"].'%" ';			
			
					
		}
		if(!empty($_POST["order"])){
			
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY activity_no DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		
		$sqlQuery1 = "SELECT * FROM ".$this->actTable." ";
		
		$result1 = mysqli_query($this->dbConnect, $sqlQuery1);
		$numRows = mysqli_num_rows($result1);
		
		$activityData = array();	
		while( $activity = mysqli_fetch_assoc($result) ) {	
			
			$actRows = array();			
			$actRows[] = $activity['activity_no'];
			$actRows[] = ucfirst($activity['activity_name']);
			$actRows[] = $activity['activity_level'];		
			$actRows[] = $activity['activity_dev_domain'];	
			$actRows[] = $activity['activity_objectives'];
			$actRows[] = $activity['activity_key_dev'];	
			$actRows[] = $activity['activity_material'];		
			$actRows[] = $activity['activity_assessment'];	
			$actRows[] = $activity['activity_process'];
			$actRows[] = $activity['activity_instructions'];	
			$actRows[] = $activity['status'];		
			$actRows[] = $activity['activity_date'];	
			$actRows[] = $activity['playlist_id'];
			$actRows[] = $activity['playlist_name'];	
			$actRows[] = $activity['playlist_descr'];		
				
			$actRows[] = '<button type="button" name="update" id="'.$activity["activity_no"].'" class="btn btn-warning btn-xs update">Update</button>';
			$actRows[] =' <button type="button" name="delete" id="'.$activity["activity_no"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
			$activityData[] = $actRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$activityData
		);
		echo json_encode($output);
	}
	public function getActivity(){
		if($_POST["activity_no"]) {
			$sqlQuery = "
				SELECT * FROM ".$this->actTable." 
				WHERE activity_no = '".$_POST["activity_no"]."'";
				
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}
	}
	public function updateActivity(){
		var_dump($_POST);
		if($_POST['activity_no']) {	
			$updateQuery = "UPDATE ".$this->actTable." 
			SET activity_name = '".$_POST["activity_name"]."', activity_level = '".$_POST["activity_level"]."', activity_dev_domain = '".$_POST["activity_dev_domain"]."', activity_objectives = '".$_POST["activity_objectives"]."' , activity_key_dev = '".$_POST["activity_key_dev"]."',
			activity_material = '".$_POST["activity_material"]."', activity_assessment = '".$_POST["activity_assessment"]."', activity_process = '".$_POST["activity_process"]."', activity_instructions = '".$_POST["activity_instructions"]."' , status = '".$_POST["status"]."',
			activity_date = '".$_POST["activity_date"]."', playlist_id = '".$_POST["playlist_id"]."', playlist_name = '".$_POST["playlist_name"]."', playlist_descr = '".$_POST["playlist_descr"]."'
			WHERE activity_no ='".$_POST["activity_no"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}
	public function addActivity(){
		$insertQuery = "INSERT INTO ".$this->actTable." (activity_name, activity_level, activity_dev_domain, activity_objectives, activity_key_dev,activity_material,activity_assessment,activity_process,activity_instructions,status,activity_date,playlist_id,playlist_name,playlist_descr) 
			VALUES ('".$_POST["activity_name"]."', '".$_POST["activity_level"]."', '".$_POST["activity_dev_domain"]."', '".$_POST["activity_objectives"]."', '".$_POST["activity_key_dev"]."',
			'".$_POST["activity_material"]."', '".$_POST["activity_assessment"]."', '".$_POST["activity_process"]."', '".$_POST["activity_instructions"]."', '".$_POST["status"]."',
			'".$_POST["activity_date"]."', '".$_POST["playlist_id"]."', '".$_POST["playlist_name"]."', '".$_POST["playlist_descr"]."')";
		$isUpdated = mysqli_query($this->dbConnect, $insertQuery);		
	}
	public function deleteActivity(){
		var_dump($_POST);
		if($_POST["activity_no"]) {
			$sqlDelete = "
				DELETE FROM ".$this->actTable."
				WHERE activity_no = '".$_POST["activity_no"]."'";		
			mysqli_query($this->dbConnect, $sqlDelete);		
		}
	}
}
?>