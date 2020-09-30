<?

unset($a);
unset($b);
unset($c);
unset($d);
unset($myJSON);

$a = rand(0, 1000);

if($a <= 500){$b = 1; $c = 345;}
if($a >= 501 && $a <= 650){$b = 3; $c = 285;}
if($a >= 651 && $a <= 750){$b = 5; $c = 225;}
if($a >= 751 && $a <= 825){$b = 10; $c = 165;}
if($a >= 826 && $a <= 870){$b = 25; $c = 105;}
if($a >= 871 && $a <= 910){$b = 50; $c = 45;}
if($a >= 911 && $a <= 945){$b = 75; $c = 15;}
if($a >= 946 && $a <= 975){$b = 100; $c = 75;}
if($a >= 976 && $a <= 990){$b = 250; $c = 135;}
if($a >= 991 && $a <= 996){$b = 500; $c = 195;}
if($a >= 997 && $a <= 999){$b = 1000; $c = 255;}
if($a == 1000){$b = 5000; $c = 315;}

$d = 1080+$c;

$myObj->rotation = $d;
$myObj->winnig = $b;

$myJSON = json_encode($myObj);

echo $myJSON;

	require("Db.class.php");
	require 'steamauth/steamauth.php';
	require 'steamauth/userInfo.php';


$db = new Db();
$db->bind("id_user", $steamprofile['steamid']);
$balance =$db->single("SELECT balance FROM users WHERE id_user = :id_user");

$update_3 = $db->query("UPDATE users SET balance=:balance+:win_daily WHERE id_user=:user",
array("balance"=>$balance,"win_daily"=>$b, "user"=> $steamprofile['steamid']));

$dailyt = time(); 

$update_4 = $db->query("UPDATE users SET last_daily=:dailyt WHERE id_user=:user",
array("dailyt"=>$dailyt, "user"=> $steamprofile['steamid']));

mysql_close();
?>
