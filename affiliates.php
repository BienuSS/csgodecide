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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/image.png">
		<title>CSGOTROPICAL - Affiliates</title>
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

<body onload="javascript:zegar()">
<?php
require("Db.class.php");

$db = new Db();


?>
 <script>
jQuery(function ($) { // a
    $(".use_promo_code").submit(function (event) {
         

        var method = this.method;
        var url = this.action;
        var data = $(this).serialize();
        event.preventDefault();
        

        $.ajax({ // f
            type: "POST",
            url: "use_promo.php",
            data: data,
            dataType: "json",

            	success: function(){

			        $('.success_aff').fadeIn(200).show();
			        $('.error_aff').fadeOut(200).hide();
			        setTimeout(function(){$('.success_aff').fadeOut(1000).hide();},1500);

			        $.ajax({
				        	url: "balance.php",
				        	success: function(response)
						        	{
						                setTimeout(function(){$('#balance-value').html(response);},500);
						            }
                          });
			      document.getElementById("used_promo").style.display = "none";  
			      document.getElementById("submit_use_promo").style.display = "none";    
			    },

         	   error: function() {
			        $('.error_aff').fadeIn(200).show();
			        $('.success_aff').fadeOut(200).hide();
			        setTimeout(function(){$('.error_aff').fadeOut(1000).hide();},2500);
			    }


        });
    });
});

 </script>

  <script>
jQuery(function ($) { // a
    $(".save_promo_code").submit(function (event) {
         

        var method2 = this.method;
        var url2 = this.action;
        var data2 = $(this).serialize();
        event.preventDefault();
        

        $.ajax({ // f
            type: "POST",
            url: "save_promo.php",
            data: data2,
            dataType: "json",

            	success: function(){

			        $('.success_cod').fadeIn(200).show();
			        $('.error_cod').fadeOut(200).hide();
			        setTimeout(function(){$('.success_cod').fadeOut(1000).hide();},1500);
			      	document.getElementById("save_promo").style.display = "none";  
			      	document.getElementById("submit_save_promo").style.display = "none";  
			    },

         	   error: function() {
			        $('.error_cod').fadeIn(200).show();
			        $('.success_cod').fadeOut(200).hide();
			        setTimeout(function(){$('.error_cod').fadeOut(1000).hide();},2500);
			    }


        });
    });
});

 </script>

  <script>
jQuery(function ($) { // a
    $(".claim_coins").submit(function (event) {
         

        var method = this.method;
        var url3 = this.action;
        var data3 = $(this).serialize();
        event.preventDefault();
        

        $.ajax({ // f
            type: "POST",
            url: "claim_earning.php",
            data: data3,
            dataType: "json",

            	success: function(){
            		document.getElementById("submit_claim_promo").style.display = "none";
					document.getElementById("my_earning").style.display = "none";
					$.ajax({
				        	url: "balance.php",
				        	success: function(response)
						        	{
						                setTimeout(function(){$('#balance-value').html(response);},500);
						            }
                          });  
			        $('.success_claim').fadeIn(200).show();
			        $('.error_claim').fadeOut(200).hide();
			        setTimeout(function(){$('.success_claim').fadeOut(1000).hide();},1500);

			    },

         	   error: function() {
			        $('.error_claim').fadeIn(200).show();
			        $('.success_claim').fadeOut(200).hide();
			        setTimeout(function(){$('.error_claim').fadeOut(1000).hide();},2500);
			    }


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
			<div class="error_aff" style='display:none'> <b>Code doesn't exist!</b></div>
			<div class="success_aff" style='display:none'> <b>Coins is added!</b></div>
			<div class="error_cod" style='display:none'> <b>Code does exist!</b></div>
			<div class="success_cod" style='display:none'> <b>Code is saved!</b></div>
			<div class="error_claim" style='display:none'> <b>Minimum is 100!</b></div>
			<div class="success_claim" style='display:none'> <b>Earning are claimed!</b></div>


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

		$db->bind("id_user", $steamprofile['steamid']);
		$promocod_div =$db->single("SELECT usepromo FROM users WHERE id_user = :id_user");

		$db->bind("id_user", $steamprofile['steamid']);
		$promocod_name_div =$db->single("SELECT promocode FROM users WHERE id_user = :id_user");

		if($promocod_div == 0){
			echo"
		<div class='aff-block-code' id='aff-block-code'>
			<form  method='post' class='use_promo_code'>
			  <center>
				<span class='aff-code'><b>Use promo code:</b></span><br><br>
				<input type='text'  id='used_promo' name='used_promo' class='code-aff' autocomplete='off'></br>
				<input type='submit' name='submit' id='submit_use_promo' value='Use!' style='margin-top:10px;' class='Submit'>
			  </center>
			</form>
		</div>";
			}
		else{
		echo "<div class='aff-block-code' id='aff-block-code'>
			
			  <center>
				<span class='aff-code'><b>Your used code:</b><br><br><b>".$promocod_name_div."</b></span>
			  </center>
			
		</div>";}

?>

	<?

		$db = new Db();

		$db->bind("id_user", $steamprofile['steamid']);
		$my_code =$db->single("SELECT code FROM users WHERE id_user = :id_user");

		$db->bind("id_user", $steamprofile['steamid']);
		$your_earning =$db->single("SELECT affiliates FROM users WHERE id_user = :id_user");
		$your_earning1 = round($your_earning/100);

		$db->bind("id_user", $steamprofile['steamid']);
		$register_user =$db->single("SELECT affiliatesuser FROM users WHERE id_user = :id_user");

		$db->bind("id_user", $steamprofile['steamid']);
		$total_earned =$db->single("SELECT affiliatestotal FROM users WHERE id_user = :id_user");
		$total_earned1 = round($total_earned/100);

		if($my_code == ""){
			echo"
			<div class='aff-block-code'>
				<form  method='post' class='save_promo_code' >
				  <center>
					<span class='aff-code'><b>Your code:</b></span><br><br>
					<input type='text' class='code-aff' id='save_promo' name='save_promo' autocomplete='off' ><br>
					<input type='submit' name='submit' id='submit_save_promo' value='Save!' style='margin-top:10px;' class='Submit'>
				  </center>
				</form>
		</div>";
			}
		else{
		echo "		<div class='aff-block-code'>
				  <center>
					<span class='aff-code'><b>Your code:</b><br><br>".$my_code."</span>
				  </center>		
		</div>";}

?>



		<br><strong id="invite-aff">Invite your friends to use CSGODECIDE<br> They get 100 coins for free and you earn 0.50% of everything they play.</strong>
		<div class="ref-block-code">

		
			<span>Your earning: 
				<strong id ="my_earning"><?echo $your_earning1;?></strong>
				<form method="post" class="claim_coins">
					<input type='submit' name='submit' id='submit_claim_promo' value='Claim!' style='margin-top:-30px;' class='Submit'>
				</form>
			</span>
			<span>Register User: <strong><?echo $register_user;?></strong><br></span>
			<span>Total Earned: <strong><?echo $total_earned1;?></strong><br></span>

			
		</div>

		

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

</body>
</html>