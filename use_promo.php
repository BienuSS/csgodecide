<?php
	require("Db.class.php");
	require 'steamauth/steamauth.php';
	require 'steamauth/userInfo.php';

$db = new Db();


$used_promo = $_POST['used_promo'];

$db->bind("code", $used_promo);
$affiliatesuser =$db->single("SELECT affiliatesuser FROM users WHERE code = :code");

$db->bind("code", $used_promo);
$code_exist =$db->single("SELECT COUNT(*) FROM users WHERE code = :code");

if($code_exist == 1){
		$db->bind("id_user", $steamprofile['steamid']);
		$balance =$db->single("SELECT balance FROM users WHERE id_user = :id_user");

		$update2 = $db->query("UPDATE users SET promocode=:promocode WHERE id_user = :id_user ",
					array("id_user"=> $steamprofile['steamid'],"promocode"=>$used_promo));

		$update2 = $db->query("UPDATE users SET usepromo=:available WHERE id_user = :id_user ",
				array("available"=>1,"id_user"=> $steamprofile['steamid']));

		$update3 = $db->query("UPDATE users SET affiliatesuser=:affiliatesuser+:added WHERE code = :code ",
				array("affiliatesuser"=>$affiliatesuser,"added"=> 1,"code"=> $used_promo));


		$update4 = $db->query("UPDATE users SET balance=:balance+:values_coins WHERE id_user=:user",
					array("balance"=>$balance,"values_coins"=>100, "user"=> $steamprofile['steamid']));

		$response_array['status'] = 'success';    

		echo json_encode($response_array);
	}
else
{
	
}	

mysql_close();
?>