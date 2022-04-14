<?php
include('constants.php');

/**
 * 
 */
class Database
{
	private $con;
	public function connect(){
		$this->con = new Mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_NAME_LIBFORSMALL);
		return $this->con;
	}
}

?>