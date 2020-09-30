<img src="img/money.png">
<?php 
			
require("Db.class.php");
require 'steamauth/steamauth.php';
require 'steamauth/userInfo.php';
$db = new Db();
$balance =$db->single("SELECT balance FROM users WHERE id_user = :id_user");
$update_3 = $db->query("UPDATE users SET balance=:balance+:win_daily WHERE id_user=:user",
array("balance"=>$balance,"win_daily"=>$b, "user"=> $steamprofile['steamid']));


			$db->bind("id_user", $steamprofile['steamid']);
	        $balance =$db->single("SELECT balance FROM users WHERE id_user = :id_user");
	        echo "<b>".$balance."</b>";

mysql_close();
?>