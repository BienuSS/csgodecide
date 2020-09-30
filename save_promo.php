<?php
	require("Db.class.php");
	require 'steamauth/steamauth.php';
	require 'steamauth/userInfo.php';

$db = new Db();


$save_promo = $_POST['save_promo'];

$db->bind("code", $save_promo);
$code_save_exist =$db->single("SELECT COUNT(code) FROM users WHERE code = :code");


if($code_save_exist == 0){

		$update5 = $db->query("UPDATE users SET code=:code WHERE id_user = :id_user ",
					array("id_user"=> $steamprofile['steamid'],"code"=>$save_promo));

		$response_array['status'] = 'success';    

		echo json_encode($response_array);
	}
else
{
	
}	

mysql_close();
?>