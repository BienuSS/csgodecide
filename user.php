
<?php
require("Db.class.php");
$db = new Db();

	$onlineuser =$db->single("SELECT COUNT(*) FROM users WHERE online + 5*60 > UNIX_TIMESTAMP(NOW()) ");
	echo "<b>".$onlineuser."</b>";
	mysql_close();
?>