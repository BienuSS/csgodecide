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
		<title>CSGODECIDE - Deposit</title>
	<meta name="description" content="Only You decide Who'll be winner !">
    <meta name="robots" content="index, nofollow">
    <link rel="stylesheet" href="style.css"/>
    <meta name="theme-color" content="#baaa53" /> 
    <link rel="apple-touch-icon" href="img/image.png">
    <meta name="apple-mobile-web-app-title" content="CSGODECIDE">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>



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
		<script type="text/javascript">
			        var sum = 0;
			function sumAddresses(x,obj)
			{
				sum = obj.checked ? sum + parseFloat(x) : sum - parseFloat(x);
				document.getElementById('sumAmount').innerHTML = sum;
			}

		</script>

		
	<form>
	<?php



	$inventoryJsonUrl = 'http://steamcommunity.com/inventory/'.$steamprofile['steamid'].'/730/2?l=english&count=5000';
	$inventoryJsonGet = file_get_contents($inventoryJsonUrl);
	$inventories = json_decode($inventoryJsonGet , TRUE);




foreach($inventories['assets'] as $key1 => $assets)
{
	 foreach($inventories['descriptions'] as $key => $description)
	 {
		  if($assets['classid'] == $description['classid'])
		  {
			    if($description['marketable']==1 || $inventories['succes']=='true'){echo
			   "<div class='item-deposit'>
						<center>
			    			<input type='checkbox' name='".$assets['assetid']."' value='valuable' id='".$assets['assetid']."' onClick='sumAddresses(35,this)'/>
								<label for='".$assets['assetid']."'>
									<strong class='name-skin'>
			    						<span >".$description['name']."</span>
			    					</strong>
							
									<span class='item-image'><center><img src='https://steamcommunity-a.akamaihd.net/economy/image/".$description['icon_url']."'></center></span>
			    					<strong class='outside'></br>".$description['tags'][5]['localized_tag_name']."</strong>	
			    					<strong class='value-skin'><center><br>35</center></strong>
			    			
			    				</label>	
			    		</center>
			    </div>";}
		  }
	 }
}

	?>
<div id='bottom-deposit'>
	<img src="img/money.png" style="z-index:-1; position: absolute; top:0%; left:17%; margin-left:5px;">
		<span id='items-value'>
			Items value:<strong id='sumAmount'>0</strong>
		</span>
			<button class='button-deposit' type='button'><b>Deposit</b></button>
	</div>
</form>
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