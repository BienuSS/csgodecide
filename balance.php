
<?php 
			
require("Db.class.php");
require 'steamauth/steamauth.php';
require 'steamauth/userInfo.php';
$db = new Db();


			$db->bind("id_user", $steamprofile['steamid']);
	        $balance =$db->single("SELECT balance FROM users WHERE id_user = :id_user");
	        echo "<b>".$balance."</b>";

mysql_close();
?>