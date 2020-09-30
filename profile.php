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
		<title>CSGODECIDE - Profile</title>
	<meta name="description" content="Only You decide Who'll be winner !">
    <meta name="robots" content="index, nofollow">
    <link rel="stylesheet" href="style.css"/>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
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



<?
	

	$db = new Db();
	
	if (isset($_GET['first'])) $first = (int)$_GET['first']; else $first = 0;
	$ltmp = 10;
	
$query="SELECT * FROM `games`
	INNER JOIN bet_placed ON games.id_match=bet_placed.id_match
	WHERE `id_user` = :id_user 
	ORDER BY `date_match`, `time_match` DESC
	LIMIT :limit,:firstposition  
	
	";

$betlist = $db->query($query, ['id_user' => $steamprofile['steamid'], 'limit' => $first, 'firstposition' => $ltmp] );

$db->bind("id_user", $steamprofile['steamid'] );
$max = $db->single("SELECT COUNT(id) FROM games INNER JOIN bet_placed ON games.id_match=bet_placed.id_match
	WHERE `id_user` = :id_user 
	ORDER BY `date_match`, `time_match` DESC ");

while ($wynik = mysql_fetch_assoc($zap)) {

print "$wynik[pole1]";
}

$count = $max/$ltmp; 
$ile = ceil($count);


 
$pick ='';
$rate ='';
$status = '';
$profit = '';
$bet_history = '';
foreach($betlist as $i => $bet_one) {


$kurs_team1 = ((int) (((0.95 * $bet_one['team2_coins'])/$bet_one['team1_coins']* 100))/100)+1;
$kurs_team2 = ((int) (((0.95 * $bet_one['team1_coins'])/$bet_one['team2_coins']* 100))/100)+1;

$kurs_add1_1 = ((int) (((0.95 * $bet_one['add1_2_coins'])/$bet_one['add1_1_coins']* 100))/100)+1;
$kurs_add1_2 = ((int) (((0.95 * $bet_one['add1_1_coins'])/$bet_one['add1_2_coins']* 100))/100)+1;

$kurs_add2_1 = ((int) (((0.95 * $bet_one['add2_2_coins'])/$bet_one['add2_1_coins']* 100))/100)+1;
$kurs_add2_2 = ((int) (((0.95 * $bet_one['add2_1_coins'])/$bet_one['add2_2_coins']* 100))/100)+1;

$kurs_add3_1 = ((int) (((0.95 * $bet_one['add3_2_coins'])/$bet_one['add3_1_coins']* 100))/100)+1;
$kurs_add3_2 = ((int) (((0.95 * $bet_one['add3_1_coins'])/$bet_one['add3_2_coins']* 100))/100)+1;

$kurs_add4_1 = ((int) (((0.95 * $bet_one['add4_2_coins'])/$bet_one['add4_1_coins']* 100))/100)+1;
$kurs_add4_2 = ((int) (((0.95 * $bet_one['add4_1_coins'])/$bet_one['add4_2_coins']* 100))/100)+1;	







if($bet_one['id_bet'] == 'team1_coins')
{
	

	$pick.$bet_one[$i] .= 
	$bet_one['team_1'];

	$rate[$i] .=
	$kurs_team1;

	$status[$i] .=
	$bet_one['team1_result'];
};

if($bet_one['id_bet'] == 'team2_coins')
{
	$pick.$bet_one[$i] .= 
	$bet_one['team_2'];

	$rate[$i] .=
	$kurs_team2;

	$status[$i] .=
	$bet_one['team2_result'];

};

if($bet_one['id_bet'] == 'add1_1_coins')
{
	$pick.$bet_one[$i] .= 
	$bet_one['add1_1_tittle'];

	$rate[$i] .=
	$kurs_add1_1;

	$status[$i] .=
	$bet_one['add1_1_result'];

};

if($bet_one['id_bet'] == 'add1_2_coins')
{
	$pick.$bet_one[$i] .= 
	$bet_one['add1_2_tittle'];

	$rate[$i] .=
	$kurs_add1_2;

	$status[$i] .=
	$bet_one['add1_2_result'];

};

if($bet_one['id_bet'] == 'add2_1_coins')
{
	$pick.$bet_one[$i] .= 
	$bet_one['add2_1_tittle'];

	$rate[$i] .=
	$kurs_add2_1;

	$status[$i] .=
	$bet_one['add2_1_result'];
};
if($bet_one['id_bet'] == 'add2_2_coins')
{
	$pick.$bet_one[$i] .= 
	$bet_one['add2_2_tittle'];

	$rate[$i] .=
	$kurs_add2_2;

	$status[$i] .=
	$bet_one['add2_2_result'];

};
if($bet_one['id_bet'] == 'add3_1_coins')
{
	$pick.$bet_one[$i] .= 
	$bet_one['add3_1_tittle'];

	$rate[$i] .=
	$kurs_add3_1;

	$status[$i] .=
	$bet_one['add3_1_result'];

};
if($bet_one['id_bet'] == 'add3_2_coins')
{
	$pick.$bet_one[$i] .= 
	$bet_one['add3_2_tittle'];

	$rate[$i] .=
	$kurs_add3_2;

	$status[$i] .=
	$bet_one['add3_2_result'];

};
if($bet_one['id_bet'] == 'add4_1_coins')
{
	$pick.$bet_one[$i] .= 
	$bet_one['add4_1_tittle'];

	$rate[$i] .=
	$kurs_add4_1;

	$status[$i] .=
	$bet_one['add4_1_result'];
};
if($bet_one['id_bet'] == 'add4_2_coins')
{
	$pick.$bet_one[$i] .= 
	$bet_one['add4_2_tittle'];

	$rate[$i] .=
	$kurs_add4_2;

	$status[$i] .=
	$bet_one['add4_2_result'];

};


if($status[$i] == '')
{

	$status1[$i]="Upcoming";
	$profit[$i]="-";
}	



if($status[$i] == 'Win')
{
	$status1[$i]	.="<font color='green'>".$status[$i]."</font>";
	$profit[$i] .="<font color='green'>+".$rate[$i]*$bet_one['value_coins']."</font>";
	$profit1[$i] .= $rate[$i]*$bet_one['value_coins'];

	

	
	

		$db = new Db();

				$db->bind("id_user", $steamprofile['steamid']);
				$db->bind("id_bet", $bet_one['id_bet']);
				$db->bind("id_match", $bet_one['id_match']);		

				$check =$db->single("SELECT bet_result FROM `bet_placed` WHERE id_match = :id_match AND id_bet = :id_bet AND id_user = :id_user ");

				if($check == '')

				{	
								$db->bind("id_user", $steamprofile['steamid']);
								$balance =$db->single("SELECT balance FROM users WHERE id_user = :id_user");

						        $update = $db->query("UPDATE users SET balance=:balance+:profit_win WHERE id_user=:user",
								array("balance"=>$balance,"profit_win"=>$profit1[$i], "user"=> $steamprofile['steamid']));

						        $db->bind("bet_result", "Claim");	
								$db->bind("id_user", $steamprofile['steamid']);
								$db->bind("id_bet", $bet_one['id_bet']);
								$db->bind("id_match", $bet_one['id_match']);	

								$update1 = $db->query("UPDATE bet_placed SET bet_result=:bet_result WHERE id_match = :id_match AND id_bet = :id_bet AND id_user = :id_user ");

								$db->bind("id_user", $steamprofile['steamid']);
								$win =$db->single("SELECT win FROM users WHERE id_user = :id_user");

								$update2 = $db->query("UPDATE users SET win=:win+1 WHERE id_user=:user",
								array("win"=>$win,"user"=> $steamprofile['steamid']));

				}
				else
				{


				}




}	

if($status[$i] == 'Lose')
{
	$status1[$i]	.="<font color='red'>".$status[$i]."</font>";
	$profit[$i] .="<font color='red'>-".$bet_one['value_coins']."</font>";




	$db = new Db();

				$db->bind("id_user", $steamprofile['steamid']);
				$db->bind("id_bet", $bet_one['id_bet']);
				$db->bind("id_match", $bet_one['id_match']);		

				$check =$db->single("SELECT bet_result FROM `bet_placed` WHERE id_match = :id_match AND id_bet = :id_bet AND id_user = :id_user ");

				if($check == '')

				{	
								$db->bind("id_user", $steamprofile['steamid']);
								$lose =$db->single("SELECT lose FROM users WHERE id_user = :id_user");

								$update3 = $db->query("UPDATE users SET lose=:lose+1 WHERE id_user=:user",
								array("lose"=>$lose,"user"=> $steamprofile['steamid']));

						        $db->bind("bet_result", "Claim");	
								$db->bind("id_user", $steamprofile['steamid']);
								$db->bind("id_bet", $bet_one['id_bet']);
								$db->bind("id_match", $bet_one['id_match']);	

								$update1 = $db->query("UPDATE bet_placed SET bet_result=:bet_result WHERE id_match = :id_match AND id_bet = :id_bet AND id_user = :id_user ");

				}
				else
				{


				}
}	

if($status[$i] == 'Draw')
{
	$profit[$i] .="0";
	$status1[$i] .="Returned";
	$profit2[$i] .= $bet_one['value_coins'];
			$db = new Db();

				$db->bind("id_user", $steamprofile['steamid']);
				$db->bind("id_bet", $bet_one['id_bet']);
				$db->bind("id_match", $bet_one['id_match']);		

				$check =$db->single("SELECT bet_result FROM `bet_placed` WHERE id_match = :id_match AND id_bet = :id_bet AND id_user = :id_user ");

				if($check == '')

				{	
								$db->bind("id_user", $steamprofile['steamid']);
								$balance =$db->single("SELECT balance FROM users WHERE id_user = :id_user");

						        $update = $db->query("UPDATE users SET balance=:balance+:profit_win WHERE id_user=:user",
								array("balance"=>$balance,"profit_win"=>$profit2[$i], "user"=> $steamprofile['steamid']));

						        $db->bind("bet_result", "Claim");	
								$db->bind("id_user", $steamprofile['steamid']);
								$db->bind("id_bet", $bet_one['id_bet']);
								$db->bind("id_match", $bet_one['id_match']);	

								$update1 = $db->query("UPDATE bet_placed SET bet_result=:bet_result WHERE id_match = :id_match AND id_bet = :id_bet AND id_user = :id_user ");

				}
				else
				{


				}
}	

$bet_history .= "

<div id='match-history' class='".$bet_one['id_match']."'>

<div class='match-history-date'>
".$bet_one['date_match']."</br>".$bet_one['time_match']."
</div>	

<div class='match-history-team1'>
".$bet_one['team_1']."
</div>

<div class='match-history-team2'>
".$bet_one['team_2']."
</div>

<div class='match-history-pick'>
".$pick.$bet_one[$i]."
</div>
<div class='match-history-kurs'>
	<b>".$rate[$i]."</b>
</div>
<div class='match-history-value'>
	<b>".$bet_one['value_coins']."</b>
</div>

<div class='match-history-profit'>
	<b>".$profit[$i]."</b>
</div>

<div id='match-history-status' class='match-history-status".$bet_one['id_match']."'>
	".$status1[$i]."
</div>


</div>

";

}
$db = new Db();

$db->bind("id_user", $steamprofile['steamid']);
$win =$db->single("SELECT win FROM users WHERE id_user = :id_user");

$db->bind("id_user", $steamprofile['steamid']);
$lose =$db->single("SELECT lose FROM users WHERE id_user = :id_user");

$ratio = $win/$lose;

$db->bind("id_user", $steamprofile['steamid']);
$trade =$db->single("SELECT tradeurl FROM users WHERE id_user = :id_user ");

mysql_close();

?>
<script>
jQuery(function ($) { // a
    $(".trade-url").submit(function (event) {
        var method = this.method;
        var url = this.action;
        var data = $(this).serialize();
        
        

        $.ajax({ // f
            type: "POST",
            url: "trade-url.php",
            data: data,
            dataType: "json", // mówimy jQuery, że w odpowiedzi od serwera spodziewamy się danych w formacie JSON

            	success: function(){

			        $('.success').fadeIn(200).show();
			        $('.error').fadeOut(200).hide();
			        setTimeout(function(){$('.success').fadeOut(1000).hide();},1500);
 
			    },

         	   error: function() {
			        $('.error').fadeIn(200).show();
			        $('.success').fadeOut(200).hide();
			        setTimeout(function(){$('.error').fadeOut(1000).hide();},1500);
			    }


        });

        return false;
    });
});

</script>

<div id="profile-info">
	<img class="img-rounded" src="<?=$steamprofile['avatarfull'];?>">
	<div id="user-name-profile"><b><?=$steamprofile['personaname']?><b></div>
	<div id="trade-url">
		<p><b>Set Your Trade-url:</b></br></p>
		<a target="_blank" href="https://steamcommunity.com/id/user/tradeoffers/privacy"><span id="found-link"><i>Where I can found link?</i></span></a>
		<form action="trade-url.php" method="post" class="trade-url">
			<input type="text" id="trade-url-input" name="trade-url" placeholder="Paste your trade-url" value="<?=$trade?>" required="required" autocomplete="off" >
			<input type='submit' name='submit' id='Submit' value="Save" style="height: 27px"></br>
		</form>

	</div>
	<div id="static">
		<span></br><i>Total wins: <?=$win?></i></br></span>
		<span><i>Total lost: <?=$lose?></i></br></span>
		<span><i>Ratio: <?=$ratio?></i></br></span>

	</div>
</div>

<div id="your-history">Your History</div>

<div class="match-history-top">

<div id="match-history-date">
<b>Date</b>
</div>	

<div class="match-history-team1">
	<b>Team 1</b>
</div>

<div class="match-history-team2">
	<b>Team2</b>
</div>

<div class="match-history-pick">
	<b><font color="#FF9900">Pick</font></b>
</div>
<div class="match-history-kurs">
	<b>Rate</b>
</div>
<div class="match-history-value">
	<b>Coins</b>
</div>

<div class="match-history-profit">
	<b>Profit</b>
</div>


<div class="match-history-status-top">
	<b>Result</b>
</div>


</div>





<?php echo $bet_history;?>

<div id="div-value2"><center>
	
<?

   



if ($first!=0) print ("<a class ='number-site' href=\"profile.php?first=" . ($first-$ltmp) . "\" ><img src='/img/icons-back.png' width='30px' height='30px'></a> ");

for ($i=1;$i<=$ile;$i++)
{
   print ("<a class ='number-site' href=\"profile.php?first=" . ($i*$ltmp-$ltmp) . "\" >");

   if ($first==($i*$ltmp-$ltmp))
   {
       print ("<img src='/img/icons-". $i .".png' width='30px' height='30px'></a> "); $akt=$i; } else { print ("<img src='/img/icons-". $i .".png' width='30px' height='30px'></a> ");
   }
}

if ($akt<$ile) print ("<a class ='number-site' href=\"profile.php?first=" . ($first+$ltmp) . "\" ><img src='/img/icons-forward.png' width='30px' height='30px'></a>");


?>



</center>
</div>

</div>	
<?}else{?>
<div class="match1"><center>
	<p><i>Login First</i></p>
		<a href="#"><div id="login-button-site"><?echo loginbutton();?></div></a></center>
	</div>
        
    <?}?>


<div id="backgroundd" style="z-index:-2;position:fixed;bottom:-5%;left:0%;width:100%;height:auto;"><img src="beach.png" style="width:100%;height:auto;"></div>
</body>
</html>