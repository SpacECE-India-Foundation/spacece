<?php 
session_start();
/**
 * 
 */
class Credentials
{
	
	private $con;

	function __construct()
	{
		include_once("../../../Db_Connection/Database_obj.php");
		$db = new Database();
		$this->con = $db->connect();
	}


	

	

}




?>