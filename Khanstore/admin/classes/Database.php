<?php

/**
 * 
 */
class Database
{
	
	private $con;
	public function connect(){
		$this->con = new Mysqli("3.109.14.4", "ostechnix", "Password123#@!", "khanstore");
		return $this->con;
	}
}

?>