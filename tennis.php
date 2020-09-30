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
		<title>CSGODECIDE - Tennis</title>
	<meta name="description" content="Only You decide Who'll be winner !">
    <meta name="robots" content="index, nofollow">
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
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
<script type="text/javascript" src="lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="source/jquery.fancybox.pack.js?v=2.1.5"></script>
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
			<li><a href="fortnite.php"><strong class="span-menu">Fortnite</strong><img src="img/fortnite.png"/></a></li>
			<li><a href="pubg.php"><strong class="span-menu">PUBG</strong><img src="img/pubg.png"/></a></li>
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
				<div id="deposit-img-mobile"><img src="img/money.png"></div>
				<div id="balance-mobile"><?echo $balance;?></div>
				<div id="loggout-button-mobile"><a href="steamauth/logout.php"><img src="img/logout.png"/></a></div>
				<div id="categori-mobile"><img src="/img/categorize.png"/></div>
			<?}else{?>
        		<a href="#"><div id="login-button-mobile"><?echo loginbutton();?></div></a>
    		<?}?>
</div>	




<div class="main-site">
<?
	

	$db = new Db();
$query="SELECT * FROM `games`
	WHERE `status` = :status AND CONCAT(`date_match`,' ',`time_match`) > NOW() AND `type_match` = :type_match
	ORDER BY `date_match`, `time_match`
	LIMIT :limit;";
$games = $db->query($query, ['status' => 0, 'limit' => 20, 'type_match' => 9]);
 

$listaSpotkan = '';
foreach($games as $i => $game) {


$kurs_team1 = ((int) (((0.95 * $game['team2_coins'])/$game['team1_coins']* 100))/100);
$kurs_team2 = ((int) (((0.95 * $game['team1_coins'])/$game['team2_coins']* 100))/100);

$kurs_add1_1 = ((int) (((0.95 * $game['add1_2_coins'])/$game['add1_1_coins']* 100))/100);
$kurs_add1_2 = ((int) (((0.95 * $game['add1_1_coins'])/$game['add1_2_coins']* 100))/100);

$kurs_add2_1 = ((int) (((0.95 * $game['add2_2_coins'])/$game['add2_1_coins']* 100))/100);
$kurs_add2_2 = ((int) (((0.95 * $game['add2_1_coins'])/$game['add2_2_coins']* 100))/100);

$kurs_add3_1 = ((int) (((0.95 * $game['add3_2_coins'])/$game['add3_1_coins']* 100))/100);
$kurs_add3_2 = ((int) (((0.95 * $game['add3_1_coins'])/$game['add3_2_coins']* 100))/100);

$kurs_add4_1 = ((int) (((0.95 * $game['add4_2_coins'])/$game['add4_1_coins']* 100))/100);
$kurs_add4_2 = ((int) (((0.95 * $game['add4_1_coins'])/$game['add4_2_coins']* 100))/100);

	$listaSpotkan .= "
      <div  class='match'>

			<img src='img/".$game['type_match'].".jpg'/>
				<span style='display: none'>".$game['id_match']."</span>
				<span class='bestof'>BO".$game['number_maps']."</span>
				<span class='time_to_match'>".$game['time_match']."</span>
					<div id='team1'>
						<div id='img-team1'><img src='img/".$game['team1_img'].".png'/></div>
							<div id='team-1'>".$game['team_1']."</div>
								<a href='#divForm1' id='betwindowbtn'><div id='kurs-team1'>".$kurs_team1."</div></a>
					</div>

			





				<div id='vs'><img src='img/vs.png'></div>
					
					<div id='team2'>
						<div id='img-team2'><img src='img/".$game['team2_img'].".png'/></div>
							<div id='team-2'>".$game['team_2']."</div>
							<a href='#divForm1' id='betwindowbtn'><div id='kurs-team2'>".$kurs_team2."</div></a>
					</div>
							
					<div id='match-page'><a href=''>Match</a></div>

<div class='more-option'><b><span>+".$game['number_add']."</span></b></div></div>

<div class='betsadd'>


				<div id='match1add1' class='matchadd'>


						
						<div id='under-map1'>
							<div id='under'>".$game['add1_1_tittle']."</div>
							<a href='#divForm1' id='betwindowbtn'><div id='kurs-under-map1'>".$kurs_add1_1."</div></a>
						</div>

						
						<div id='over-map1'>
							<div id='over'>".$game['add1_2_tittle']."</div>
							<a href='#divForm1' id='betwindowbtn'><div id='kurs-over-map1'>".$kurs_add1_2."</div></a>
						</div>		

				</div>

				<div id='match1add2' class='matchadd'>


						
						<div id='under-map1'>
							<div id='under'>".$game['add2_1_tittle']."</div>
							<a href='#divForm1' id='betwindowbtn'><div id='kurs-under-map1'>".$kurs_add2_1."</div></a>
						</div>

						
						<div id='over-map1'>
							<div id='over'>".$game['add2_2_tittle']."</div>
							<a href='#divForm1' id='betwindowbtn'><div id='kurs-over-map1'>".$kurs_add2_2."</div></a>
						</div>		

				</div>

				<div id='match1add3' class='matchadd'>


						
						<div id='under-map1'>
							<div id='under'>".$game['add3_1_tittle']."</div>
							<a href='#divForm1' id='betwindowbtn'><div id='kurs-under-map1'>".$kurs_add3_1."</div></a>
						</div>

						
						<div id='over-map1'>
							<div id='over'>".$game['add3_2_tittle']."</div>
							<a href='#divForm1' id='betwindowbtn'><div id='kurs-over-map1'>".$kurs_add3_2."</div></a>
						</div>		

				</div>

				<div id='match1add4' class='matchadd'>



						<div id='under-map1'>
							<div id='under'>".$game['add4_1_tittle']."</div>
							<a href='#divForm1' id='betwindowbtn'><div id='kurs-under-map1'>".$kurs_add4_1."</div></a>
						</div>

						
						<div id='over-map1'>
							<div id='over'>".$game['add4_2_tittle']."</div>
							<a href='#divForm1' id='betwindowbtn'><div id='kurs-over-map1'>".$kurs_add4_2."</div></a>
						</div>		

				</div>						

</div>



        ";
}

?>

	<script type="text/javascript">
    	$("#betwindowbtn").fancybox();
	</script>
				<? if(isset($_SESSION['steamid'])) {?>
					
						<div id="divForm1" class="betwindow">
										    
										       <br />Your bet: <br /><br />
										        <form method="POST" action="place_bet.php">
										        	<!-- id_match-->
										        	<span style="display: none"><?=$steamprofile['steamid']?></span><!--niepewne!!!!!ukryć-->
													<input name="value_coins" /><br /><br />

													<input type="button"  id="btn" value="Place Bet!" onclick="window.location.href='index.php' ">

												</form>
										        
										    
										</div>

				<?}else{?>
						<div id="divForm1" class="betwindow">
										    <br /><br /><br />
										       <b>Login First</b>						    
										</div>
				        
				    <?}?>









<?php echo $listaSpotkan; ?>

<div id="div-value"><center>
	
<?

   



if ($first!=0) print ("<a class ='number-site' href=\"index.php?first=" . ($first-$ltmp) . "\" title=\"Poprzednie\"><big>&laquo;</big></a> ");

for ($i=1;$i<=$ile;$i++)
{
   print ("<a class ='number-site' href=\"index.php?first=" . ($i*$ltmp-$ltmp) . "\" title=\"" . ($i*$ltmp-($ltmp-1)) . "-" . ($i*$ltmp) ."\">");

   if ($first==($i*$ltmp-$ltmp))
   {
       print ("<b>[" . $i . "]</b></a> "); $akt=$i; } else { print ("[" . $i . "]</a> ");
   }
}

if ($akt<$ile) print ("<a class ='number-site' href=\"index.php?first=" . ($first+$ltmp) . "\" title=\"Następne\"><big>&raquo;</big></a>");


?>



</center>
</div>






</div>
<script type="text/javascript">
	
$("div.more-option").click(function () {
    var przycisk = $(this);
    var tajnaTresc = przycisk.closest(".match").next("div.betsadd");
    
    tajnaTresc.toggle(500);
    
    var czyTajnaTrescJestUkryta = tajnaTresc.is(":hidden");
    
    
});

</script>

<div id="backgroundd" style="z-index:-2;position:fixed;bottom:-5%;width:100%;height:auto;"><img src="beach.png" style="width:100%;height:auto;"></div>
</body>
</html>