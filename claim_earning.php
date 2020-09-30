<?
	require("Db.class.php");
	require 'steamauth/steamauth.php';
	require 'steamauth/userInfo.php';

$db = new Db();

		$db->bind("id_user", $steamprofile['steamid']);
		$your_earning =$db->single("SELECT affiliates FROM users WHERE id_user = :id_user");
		$your_earning1 = round($your_earning/100);

		$db->bind("id_user", $steamprofile['steamid']);
		$balance =$db->single("SELECT balance FROM users WHERE id_user = :id_user");

		if($your_earning1 >= 100)
		{

					$update = $db->query("UPDATE users SET affiliates=:affiliates WHERE id_user = :id_user ",
							   array("id_user"=> $steamprofile['steamid'],"affiliates"=>0));

					$update_2 = $db->query("UPDATE users SET balance=:balance+:affiliates1 WHERE id_user=:user",
								array("balance"=>$balance,"affiliates1"=>$your_earning1,"user"=> $steamprofile['steamid']));

					$response_array['status'] = 'success';    

					echo json_encode($response_array);
		}
		else
		{

		}

		mysql_close();
?>
