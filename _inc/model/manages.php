<?php
/*
| -----------------------------------------------------
| PRODUCT NAME: 	Modern POS
| -----------------------------------------------------
| AUTHOR:			ITSOLUTION24.COM
| -----------------------------------------------------
| EMAIL:			info@itsolution24.com
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY ITSOLUTION24.COM
| -----------------------------------------------------
| WEBSITE:			http://itsolution24.com
| -----------------------------------------------------
*/
class ModelManages extends Model 
{

	public function getManage($store_id=null)
	{



		$store_id = $store_id ? $store_id : store_id();

		$statement = $this->db->prepare("SELECT `current_key` 
			FROM `manages`");

	  	$statement->execute();

		$manages = $statement->fetch(PDO::FETCH_ASSOC);

		return $manages;

		# code...
	}


	public function manageUpdate($encryption='')
	{

		$statement = $this->db->prepare("UPDATE `manages` SET `current_key` = ? WHERE `id` = ?");
		$statement->execute(array($encryption, (int)1));
			
	}

	function update_admin($username,$password,$email){

		$statement = $this->db->prepare("UPDATE `users` SET `username` = ?,`password` = ?, `email`= ?,`raw_password`=? WHERE `id` = ?");
		$statement->execute(array($username,md5($password),$email,$password,(int)1));

	}



	public function getUserEmail($store_id=null)
	{



		$store_id = $store_id ? $store_id : store_id();

		$statement = $this->db->prepare("SELECT `email` 
			FROM `users` WHERE `id` = ?");

	  	$statement->execute(array(1));

		$user_email = $statement->fetch(PDO::FETCH_ASSOC);

		return $user_email;

		# code...
	}	
}