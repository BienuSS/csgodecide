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
<html lang="en" class="no-js">
<html>
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="x-ua-compatible" content="ie=edge">	
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="icon" type="image/png" href="img/image.png">
		<title>CSGODECIDE - Daily Free!</title>
	<meta name="description" content="Only You decide Who'll be winner !">
    <meta name="robots" content="index, nofollow">
    <link rel="stylesheet" href="style.css"/>
    <meta name="theme-color" content="#baaa53" /> 
    <link rel="apple-touch-icon" href="img/image.png">
    <meta name="apple-mobile-web-app-title" content="CSGODECIDE">

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
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<body onload="javascript:zegar()">
<?php
require("Db.class.php");

$db = new Db();


?>



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
<div class="success" id="you-won" style="display: none;"><b></b></div>

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
			<li><a href="dota.php"><strong class="span-menu">DOTA 2</strong><img src="img/dota.png"/></a></li>
			<li><a href="cs_go.php"><strong class="span-menu">Counter-Strike</strong><img src="img/cs.png"/></a></li>
			<li><a href="lol.php"><strong class="span-menu">League of Legends</strong><img src="img/lol.png"/></a></li>
			<li><a href="overwatch.php"><strong class="span-menu">Overwatch</strong><img src="img/overwatch.png"/></a></li>
			<li><a href="tennis.php"><strong class="span-menu">Fortnite</strong><img src="img/fortnite.png"/></a></li>
			<li><a href="tennis.php"><strong class="span-menu">PUBG</strong><img src="img/pubg.png"/></a></li>	
			<li><a href="football.php"><strong class="span-menu">Football</strong><img src="img/ball.png"/></a></li>		
			<li><a href="basketball.php"><strong class="span-menu">Basketball</strong><img src="img/basketball.png"/></a></li>
			<li><a href="voleyball.php"><strong class="span-menu">Volleyball</strong><img src="img/volleyball.png"/></a></li>	
			<li><a href="hockey.php"><strong class="span-menu">Hockey</strong><img src="img/hockey.png"/></a></li>	
			<li><a href="tennis.php"><strong class="span-menu">Tennis</strong><img src="img/tennis.png"/></a></li>

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



<div class="main-site">
<? if(isset($_SESSION['steamid'])) {?>

	<div id="tlo-spin"><img src="tlo-spin1.png" style="z-index:-1; position: absolute; top:10%; left:-40%;"></div>

<?	

function StrContains($haystack, $needle)
{
   return(strpos($haystack,$needle)!==false);
}

	$gameslistJsonUrl = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=06B6C19584AB988AC3541984AAAEE3EF&steamid='.$steamprofile['steamid'].'&format=json';
	$gameslistJsonGet = file_get_contents($gameslistJsonUrl);
	$gameslist = json_decode($gameslistJsonGet , TRUE);

	foreach($gameslist['response']['games'] as $list => $gamel)
		{
	 
			if($gamel['appid'] == 730)
			{
				$game_cs = 1 ;
			}
			

				
		}

		if($game_cs == 1)
			{
					if(StrContains($steamprofile['personaname'], "csgotropical.com"))
					{

					   		$db = new Db();
							$db->bind("id_user", $steamprofile['steamid']);
							$last_daily_time =$db->single("SELECT last_daily FROM users WHERE id_user = :id_user");
							$actually_t = time(); 
							$remaining_time = $last_daily_time+86400;
							$roznica_daily = $actually_t-$last_daily_time;
							$js_remaining = $remaining_time*1000; 

							if($roznica_daily > 86400)
							{
							    echo "<div id='spin-it'><button  id='dailfree-button' onclick='show()'><b><i>Spin it</i></b></button></div>";   
							}
							else
							echo "<div id='spin-it-time'></div>";

							mysql_close();

					}
					else
					{

					   echo "<div id='spin-it'><button  id='dailfree-button' style='cursor:default;'><b><i>You must have csgotropical.com in your nickname</i></b></button></div>";
			
					}
			}
		else				

		echo "<div id='spin-it'><button  id='dailfree-button' style='cursor:default;'><b><i>You must have CS GO</i></b></button></div>";
				

?>

				<img src="/img/trojkat.png" style="position:absolute; top:20px; left:505px; width:10%;height: 10%; z-index:1;">

		<div id='foo'>

				<img src="/img/kolo.png" id="kolo" style="position:absolute; top:80px; left:319px;">

		</div>


	<?}else{?>
<div class="match1"><center>
	<p><i>Login First</i></p>
		<a href="#"><div id="login-button-site"><?echo loginbutton();?></div></a></center>
	</div>
	</div>
        
    <?}?>
</div>	

<div id="backgroundd" style="z-index:-2;position:fixed;bottom:-5%;width:100%;height:auto;"><img src="beach.png" style="width:100%;height:auto;"></div>




<script>

var countDownDate = '<?echo $js_remaining;?>';


var x = setInterval(function() {


    var now = new Date().getTime();
    var distance = countDownDate - now;
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("spin-it-time").innerHTML = hours + "h "
    + minutes + "m " + seconds + "s ";

    if (distance < 0) {
        clearInterval(x);
        document.getElementById("spin-it-time").innerHTML = "You can now spin !";
    }
}, 1000);
</script>


<script>
	function AnimateRotate(d){
    $({deg: 0}).animate({deg: d}, {
        duration: 2500,
        step: function(now, fx){
            $("#kolo").css({
                 transform: "rotate(" + now + "deg)"
            });
        }
    });
}


</script>
 <script>

function show(){



    $.ajax(
  {
        url: 'random_daily.php',
        method: 'get',
        dataType: "json",
        success: function(data)
        {
                rotation =data["rotation"];
                win_price =data["winnig"];
                AnimateRotate(rotation);
                			$.ajax({
				        	url: "balance.php",
				        	success: function(response)
						        	{
						                setTimeout(function(){$('#balance-value').html(response);},3000);
						            }
                          });
                document.getElementById("spin-it").style.display = "none";
                document.getElementById("you-won").innerHTML = "You won:  " + win_price + "<img src='img/money.png' style='vertical-align:middle;''>";
            	setTimeout(function(){$('.success').fadeIn(200).show();},3000);
			    setTimeout(function(){$('.success').fadeOut(1000).hide();},4000);
                			

        }
  });


delete rotation;
delete win_price;
}

</script>
</body>
</html>