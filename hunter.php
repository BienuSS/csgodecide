<?

	require 'steamauth/steamauth.php';
	require 'steamauth/userInfo.php';

	if(isset($_SESSION['steamid']))
	{

			$id = $_SESSION['steamid'];
	}

	else
	{

		#Not logged in
	}
?>


<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="x-ua-compatible" content="ie=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/image.png">
		<title>CSGOTROPICAL - HUNTER</title>
	<meta name="description" content="Only You decide Who'll be winner !">
    <meta name="robots" content="index, nofollow">
    <link rel="stylesheet" href="style.css"/>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
	<link  href="dist/jquery.fancybox.css" rel="stylesheet">
	<script src="dist/jquery.fancybox.js"></script>
    <meta name="theme-color" content="#baaa53" /> 
    <link rel="apple-touch-icon" href="img/image.png">
    <meta name="apple-mobile-web-app-title" content="CSGOTROPICAL">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
    <script language="JavaScript" type="text/javascript">

		function zegar(){
    	d = new Date();
    	var h=d.getHours(),m=d.getMinutes(),s=d.getSeconds(),r;
    	r=(h<10?"0"+h:h)+":"+(m<10?"0"+m:m)+":"+(s<10?"0"+s:s);
    
    	document.getElementById('time').innerHTML=r;
    	setTimeout("zegar()", 1000);

		}
	</script>

<!-- Google Analistyc -->



</head>

<body>

<?php
require("Db.class.php");
require("bet_win.php");
$db = new Db();
?>
<?
unset($array_item);
  $array_item = ["empress.png",
  				 "bloodsport.png",
  				 "neon_revoluton.png",
  				 "aquamarine.png",
  				 "fuel_injector.png",
  				 "jaguar.png",
  				 "vulcan.png",
  				 "point_disarray.png",
  				 "redline.png",
  				 "case_harden.png",
  				 "hydrophonic.png",
  				 "blue_laminat.png",
  				 "elite_build.png)",
  				 "safari_mesh.png",
  				 "emerald_pinstripe.png",
  				 "frontside.png"  ];

shuffle($array_item);

?>

<?php
 
 
function createSalt()
{
	unset($text);
    $text = md5(uniqid(rand(), TRUE));
    return substr($text, 0, 15);
}


$salt = createSalt();
$number = "1+";
$item = $array_item[0];
$hash = hash('sha256', $number .$salt . $item);
$salt2 = createSalt();
$number2 = "2+";
$item2 = $array_item[1];
$hash2 = hash('sha256', $number2 .$salt2 . $item2);
$salt3 = createSalt();
$number3 = "3+";
$item3 = $array_item[2];
$hash3 = hash('sha256', $number3 .$salt3 . $item3);
$salt4 = createSalt();
$number4 = "4+";
$item4 = $array_item[3];
$hash4 = hash('sha256', $number4 .$salt4 . $item4);
$salt5 = createSalt();
$number5 = "5+";
$item5 = $array_item[4];
$hash5 = hash('sha256', $number5 .$salt5 . $item5);
$salt6 = createSalt();
$number6 = "6+";
$item6 = $array_item[5];
$hash6 = hash('sha256', $number6 .$salt6 . $item6);
$salt7 = createSalt();
$number7 = "7+";
$item7 = $array_item[6];
$hash7 = hash('sha256', $number7 .$salt7 . $item7);
$salt8 = createSalt();
$number8 = "8+";
$item8 = $array_item[7];
$hash8 = hash('sha256', $number8 .$salt8 . $item8);
$salt9 = createSalt();
$number9 = "9+";
$item9 = $array_item[8];
$hash9 = hash('sha256', $number9 .$salt9 . $item9);
$salt10 = createSalt();
$number10 = "10+";
$item10 = $array_item[9];
$hash10 = hash('sha256', $number10 .$salt10 . $item10);
$salt11 = createSalt();
$number11 = "11+";
$item11 = $array_item[10];
$hash11 = hash('sha256', $number11 .$salt11 . $item11);
$salt12 = createSalt();
$number12 = "12+";
$item12 = $array_item[11];
$hash12 = hash('sha256', $number12 .$salt12 . $item12);
$salt13 = createSalt();
$number13 = "13+";
$item13 = $array_item[12];
$hash13 = hash('sha256', $number13 .$salt13 . $item13);
$salt14 = createSalt();
$number14 = "14+";
$item14 = $array_item[13];
$hash14 = hash('sha256', $number14 .$salt14 . $item14);
$salt15 = createSalt();
$number15 = "15+";
$item15 = $array_item[14];
$hash15 = hash('sha256', $number15 .$salt15 . $item15);
$salt16 = createSalt();
$number16 = "16+";
$item16 = $array_item[15];
$hash16 = hash('sha256', $number16 .$salt16 . $item16);

$_SESSION[$hash] = $item;
$_SESSION[$hash2] = $item2;
$_SESSION[$hash3] = $item3;
$_SESSION[$hash4] = $item4;
$_SESSION[$hash5] = $item5;
$_SESSION[$hash6] = $item6;
$_SESSION[$hash7] = $item7;
$_SESSION[$hash8] = $item8;
$_SESSION[$hash9] = $item9;
$_SESSION[$hash10] = $item10;
$_SESSION[$hash11] = $item11;
$_SESSION[$hash12] = $item12;
$_SESSION[$hash13] = $item13;
$_SESSION[$hash14] = $item14;
$_SESSION[$hash15] = $item15;
$_SESSION[$hash16] = $item16;


?>

 <script>
jQuery(function ($)
{ // a
    $(".area").click(function (event)
    {
    	$.ajax({
                  type: "POST",
                  url: "random_case_id.php",
                  dataType: "json",
					success: function(data)
					{
							case1 =data["case1"];
			                case2 =data["case2"];
			                case3 =data["case3"];
			                case4 =data["case4"];
			                case5 =data["case5"];
			                case6 =data["case6"];
			                case7 =data["case7"];
			                case8 =data["case8"];
			                case9 =data["case9"];
			                case10 =data["case10"];
			                case11 =data["case11"];
			                case12 =data["case12"];
			                case13 =data["case13"];
			                case14 =data["case14"];
			                case15 =data["case15"];
			                case16 =data["case16"];

			                        document.getElementById('<?echo $hash;?>').innerHTML = '<img src="/skins/'case1'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash2;?>').innerHTML = '<img src="/skins/'case2'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash3;?>').innerHTML = '<img src="/skins/'case3'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash4;?>').innerHTML = '<img src="/skins/'case4'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash5;?>').innerHTML = '<img src="/skins/'case5'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash6;?>').innerHTML = '<img src="/skins/'case6'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash7;?>').innerHTML = '<img src="/skins/'case7'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash8;?>').innerHTML = '<img src="/skins/'case8'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash9;?>').innerHTML = '<img src="/skins/'case9'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash10;?>').innerHTML = '<img src="/skins/'case10'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash11;?>').innerHTML = '<img src="/skins/'case11'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash12;?>').innerHTML = '<img src="/skins/'case12'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash13;?>').innerHTML = '<img src="/skins/'case13'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash14;?>').innerHTML = '<img src="/skins/'case14'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash15;?>').innerHTML = '<img src="/skins/'case15'" style="width:80px; height:80px; padding-top:15px;">';
							        document.getElementById('<?echo $hash16;?>').innerHTML = '<img src="/skins/'case16'" style="width:80px; height:80px; padding-top:15px;">';


		            },
              });








    });
});

 </script>
<script>

    function useronline(){
			        $.ajax({
				        	url: "user.php",
						    success: function(response)
						        	{
						                setTimeout(function(){$('#user-live').html(response);},500);
						            }
						            
                          });


			    };
</script>
<script>
	setInterval("useronline();", 5000);
</script>
 
<div id="top-desktop-menu">
    <div class="time-div"><h1 id="time"></h1></div>

	<div class="user-online-img">
    <img src="img/user.png"/>
	</div>
    <div id="user-live" class="user-online">
        <?php
        $onlineuser =$db->single("SELECT COUNT(*) FROM users WHERE online + 5*60 > UNIX_TIMESTAMP(NOW()) ");
        echo $onlineuser;
        ?>

    </div>


    <div id="left-navigation" style="display:block;">

        <a href="index.php"><img src="img/logo223.png" /></a>

    </div>
    <div id="copyright">
        © CSGODecide 2017. All rights reserved.
    </div>

    <div class="user-menu">


	<? if(isset($_SESSION['steamid'])) {?>

    <?php
    $db = new Db();



    $db->bind("id_user", $steamprofile['steamid']);
	$user =$db->single("SELECT COUNT(*) FROM users WHERE id_user = :id_user");

	$onlinetime = time();
	$update = $db->query("UPDATE users SET online=:online WHERE id_user=:user",
	array("online"=>$onlinetime, "user"=> $steamprofile['steamid']));


if ($user == 0){

		$insert   =  $db->query("INSERT INTO users(id_user,balance) VALUES(:user,:balance)", array("user"=> $steamprofile['steamid'] ,"balance"=>"0"));
}
    
else {


}



?>
	<div class="profile">
		<li class="dropdown">
			<a href="profile.php" class="dropdown-toggle" data-toogle="dropdown">
				<img class="img-rounded" src="<?=$steamprofile['avatar'];?>"></a> <b><a href="profile.php"><div id="user-name"><?=$steamprofile['personaname']?></div></a></b><b class="caret"></b>

		<span class="dropdown-arrow"></span>
			<div id="deposit-img"><img src="img/money.png"></div>
			<a href="deposit.php"><div id="balance-value"><b>
			
			<?php 
			$db->bind("id_user", $steamprofile['steamid']);
	        $balance =$db->single("SELECT balance FROM users WHERE id_user = :id_user");
	        echo $balance;
	        ?>
	</b></div></a>
		</li>	
		<div id="loggout-button"><a href="steamauth/logout.php"><img src="img/logout.png"/></a></div>
	</div>
	<?}else{?>
        <a href="#"><div id="login-button"><?echo loginbutton();?></div></a>
    <?}?>

</div>

</div>
    <div class="containers">

                <ul class="menu__list">

                    <li class="menu__item menu__item--current"><a href="index.php" class="menu__link">Games</a></li>
                    <li class="menu__item"><a href="deposit.php" class="menu__link">Deposit</a></li>
                    <li class="menu__item"><a href="store.php" class="menu__link">Store</a></li>
                    <li class="menu__item"><a href="dailyfree.php" class="menu__link">Daily Free</a></li>
                    <li class="menu__item"><a href="affiliates.php" class="menu__link">Affiliates</a></li>
                    <li class="menu__item"><a href="profile.php" class="menu__link">Profile</a></li>
                </ul>

    </div>





		<div class="wrap-all">	
			<span class="navigation-toggle">
		
				<script>
					$(function() {
						$('.navigation-toggle').on('click', function(e) {
							$('body').toggleClass('navigation-show');
						});
					});
				</script>
		<span></span>
		<span></span>
		<span></span>	
	</span>

	<nav class="navigation" role="navigation">



		<ul id="menu-desktop">
			<li id="nav-left-categories">Categories</li>
			<li><a href=""><b><strong class="span-menu">Lounge</strong></b><img src="img/lounge.png"/></a></li>
			<li><a href="hunter.php"><strong class="span-menu">Hunter</strong><img src="img/hunter.png"/></a></li>	
			<li><a href=""><strong class="span-menu">Roulette</strong><img src="img/roulette.png"/></a></li>
			<li><a href=""><strong class="span-menu">Crash</strong><img src="img/crash.png"/></a></li>
			<li><a href=""><strong class="span-menu">Mine</strong><img src="img/mine.png"/></a></li>
			<li><a href=""><strong class="span-menu">Upgrader</strong><img src="img/upgrader.png"/></a></li>
			<li><a href=""><strong class="span-menu">Jackpot</strong><img src="img/jackpot.png"/></a></li>

	


		</ul>
		<a href="http://icons8.com/icon"><span id="icon-link">Icon</span></a>
	</nav>


	<div role="main" class="page-main">
		
	</div>
</div>

<div id="user-mobile">
	
				<div id="menu-img-mobile"><img src="/img/menu.png"></div>

			<? if(isset($_SESSION['steamid'])) {?>

				<div id="menu-img-mobile"><img src="/img/menu.png"></div>
				<div id="deposit-img-mobile"><img src="img/money-30.png"></div>
				<div id="balance-mobile"><?echo $balance;?></div>
				<div id="loggout-button-mobile"><a href="steamauth/logout.php"><img src="img/logout.png"/></a></div>
				<div id="categori-mobile"><img src="/img/categorize.png"/></div>
			<?}else{?>
        		<a href="#"><div id="login-button-mobile"><?echo loginbutton();?></div></a>
    		<?}?>
</div>	


<div class="main-site-case">

<div id="menu">
	<div id="start-game">Start Game</div>
	<div id="price-case">Price: 1750</div>
</div>
<div style="margin-top:32px; margin-left:90px; color:white; background-color:green; border-radius:3px; width:38px; padding: 5px;" onclick="">HASH</strong>


<div id="hash-fair" style=" display: none; background-color:black; z-index:2; ">
	Hash list:<br><br>
	<span id="hash1" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block; "><?echo $hash;?></span><br>
	<span id="hash2" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash2;?></span><br>
	<span id="hash3" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash3;?></span><br>
	<span id="hash4" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash4;?></span><br>
	<span id="hash5" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash5;?></span><br>
	<span id="hash6" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash6;?></span><br>
	<span id="hash7" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash7;?></span><br>
	<span id="hash8" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash8;?></span><br>
	<span id="hash9" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash9;?></span><br>
	<span id="hash10" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash10;?></span><br>
	<span id="hash11" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash11;?></span><br>
	<span id="hash12" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash12;?></span><br>
	<span id="hash13" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash13;?></span><br>
	<span id="hash14" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash14;?></span><br>
	<span id="hash15" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash15;?></span><br>
	<span id="hash16" style="padding:5px 0px; border-color:white; border-width:1px;border-style:groove; display: inline-block;"><?echo $hash16;?></span><br>
</div>

<div id="left-skins" style="height:696px; width:225px; position: absolute; left: 50px; top: 140px; ">
	<img src="/skins/aquamarine.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange; 
	border-radius:4px;">
	<img src="/skins/bloodsport.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange; 
	border-radius:4px;">
	<img src="/skins/blue_laminat.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange; 
	border-radius:4px;">
	<img src="/skins/case_harden.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange; 
	border-radius:4px;">
	<img src="/skins/elite_build.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange; 
	border-radius:4px;">
	<img src="/skins/emerald_pinstripe.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange;
	border-radius:4px;">
	<img src="/skins/empress.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange;
	border-radius:4px;">
	<img src="/skins/frontside.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange; 
	border-radius:4px;">
</div>

<div id="right-skins" style="height:696px; width:225px; position: absolute; left: 850px; top: 140px; ">
	<img src="/skins/fuel_injector.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange; 
	border-radius:4px;">
	<img src="/skins/hydrophonic.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange; 
	border-radius:4px;">
	<img src="/skins/jaguar.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange; 
	border-radius:4px;">
	<img src="/skins/neon_revoluton.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange; 
	border-radius:4px;">
	<img src="/skins/point_disarray.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange; 
	border-radius:4px;">
	<img src="/skins/redline.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange;
	border-radius:4px;">
	<img src="/skins/safari_mesh.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange;
	border-radius:4px;">
	<img src="/skins/vulcan.png" style="width:85px; height:85px; border-width:2px; border-color:black; border-style: groove; border-radius:2px; padding:5px; background-color:orange; 
	border-radius:4px;">
</div>

<div id="case-area">

<div  id="<?echo $hash;?>" class="area"></div>
<div  id="<?echo $hash2;?>" class="area"></div>
<div  id="<?echo $hash3;?>" class="area"></div>
<div  id="<?echo $hash4;?>" class="area"></div>
<div  id="<?echo $hash5;?>" class="area"></div>
<div  id="<?echo $hash6;?>" class="area"></div>
<div  id="<?echo $hash7;?>" class="area"></div>
<div  id="<?echo $hash8;?>" class="area"></div>
<div  id="<?echo $hash9;?>" class="area"></div>
<div  id="<?echo $hash10;?>" class="area"></div>
<div  id="<?echo $hash11;?>" class="area"></div>
<div  id="<?echo $hash12;?>" class="area"></div>
<div  id="<?echo $hash13;?>" class="area"></div>
<div  id="<?echo $hash14;?>" class="area"></div>
<div  id="<?echo $hash15;?>" class="area"></div>
<div  id="<?echo $hash16;?>" class="area"></div>

</div>

</div>

</div>

<div id="backgroundd" style="z-index:-2;position:fixed;bottom:-5%;width:100%;height:auto;"><img src="beach.png" style="width:100%;height:auto;"></div>


</body>
</html>