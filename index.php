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
		<title>CSGOTROPICAL - Win skins on Holiday</title>
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
date_default_timezone_set(‘Europe/Warsaw’);
require("Db.class.php");
require("bet_win.php");
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
 <script>
jQuery(function ($) { // a
    $(".betBox").submit(function (event) {
     // b i c
        

        var method = this.method;
        var url = this.action;
        var data = $(this).serialize();
        
        

        $.ajax({ // f
            type: "POST",
            url: "place_bet.php",
            data: data,
            dataType: "json", // mówimy jQuery, że w odpowiedzi od serwera spodziewamy się danych w formacie JSON

            	success: function(){

			        $('.success').fadeIn(200).show();
			        $('.error').fadeOut(200).hide();
			        setTimeout(function(){$('.success').fadeOut(1000).hide();},1500);

			        $.ajax({
				        	url: "balance.php",
				        	success: function(response)
						        	{
						                setTimeout(function(){$('#balance-value').html(response);},500);
						            }
                          });
			        
			        
			    },

         	   error: function() {
			        $('.error').fadeIn(200).show();
			        $('.success').fadeOut(200).hide();
			        setTimeout(function(){$('.error').fadeOut(1000).hide();},1500);
			    }


        });

    
        
        
        
        $.fancybox.close( true );
        
       

        return false;
    });
});

</script>

        <script type="text/javascript">
             
            function wartosc(element){
                $("#potential-win").innerHTML = element.value;
            }
            

        </script>

			<div class="error" style='display:none'> <b>No enough money</b></div>
			<div class="success" style='display:none'> <b>Bet placed!</b></div>


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


<div id="chat">
	<div id="messages">
	</div>
	<form>
		<input type="textarea" name="" id="messages_input">
	</form>
</div>
<div class="main-site" id="events">


<div id="upcoming-m"><b>Upcoming matches</b></div>



<?

	$db = new Db();

	if (isset($_GET['first'])) $first = (int)$_GET['first']; else $first = 0;
	$ltmp = 10;

$query="SELECT * FROM `games`
	WHERE `status` = :status AND `date_match` > NOW() 
	ORDER BY `date_match` LIMIT :limit,:firstposition  ";
$games = $db->query($query, ['status' => 0, 'limit' => $first, 'firstposition' => $ltmp ]);

$db->bind("status", 0);
$max = $db->single("SELECT COUNT(id_match) FROM games WHERE `status` = :status AND `date_match` > NOW() ");


$count = $max/$ltmp; 
$ile = ceil($count);


$listaSpotkan = '';
$added= '';
$data_wydarzenia ='';
foreach($games as $i => $game) {


$kurs_team1 = ((int) (((0.95 * $game['team2_coins'])/$game['team1_coins']* 100))/100)+1;
$kurs_team2 = ((int) (((0.95 * $game['team1_coins'])/$game['team2_coins']* 100))/100)+1;

$kurs_add1_1 = ((int) (((0.95 * $game['add1_2_coins'])/$game['add1_1_coins']* 100))/100)+1;
$kurs_add1_2 = ((int) (((0.95 * $game['add1_1_coins'])/$game['add1_2_coins']* 100))/100)+1;

$kurs_add2_1 = ((int) (((0.95 * $game['add2_2_coins'])/$game['add2_1_coins']* 100))/100)+1;
$kurs_add2_2 = ((int) (((0.95 * $game['add2_1_coins'])/$game['add2_2_coins']* 100))/100)+1;

$kurs_add3_1 = ((int) (((0.95 * $game['add3_2_coins'])/$game['add3_1_coins']* 100))/100)+1;
$kurs_add3_2 = ((int) (((0.95 * $game['add3_1_coins'])/$game['add3_2_coins']* 100))/100)+1;

$kurs_add4_1 = ((int) (((0.95 * $game['add4_2_coins'])/$game['add4_1_coins']* 100))/100)+1;
$kurs_add4_2 = ((int) (((0.95 * $game['add4_1_coins'])/$game['add4_2_coins']* 100))/100)+1;




if($game['number_add']==0){

	$added.$game[$i] .= " <div class='betsadd'></div>";
};

if($game['number_add']==1){
	$added.$game[$i] .= "
<div class='betsadd'>


				<div id='match1add1' class='matchadd'>


						
						<div id='under-map1'>
							<div id='under'>".$game['add1_1_tittle']."</div>
							<a data-fancybox data-src='#3".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-under-map1'>".$kurs_add1_1."</div></a>
						</div>
						
						<div id='3".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add1_1."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add1_1_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>

													</form>
																					
										        
										    

						</div>

						
						<div id='over-map1'>
							<div id='over'>".$game['add1_2_tittle']."</div>
							<a data-fancybox data-src='#4".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-over-map1'>".$kurs_add1_2."</div></a>
						</div>	
						
						<div id='4".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add1_2."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add1_2_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>
													</form>
																					
										        
										    

						</div>	

				</div>	
		</div>";};
		


if($game['number_add']==2){
$added.$game[$i].= "	

<div class='betsadd'>


				<div id='match1add1' class='matchadd'>


						
						<div id='under-map1'>
							<div id='under'>".$game['add1_1_tittle']."</div>
							<a data-fancybox data-src='#3".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-under-map1'>".$kurs_add1_1."</div></a>
						</div>
						
						<div id='3".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add1_1."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add1_1_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>

													</form>
																					
										        
										    

						</div>

						
						<div id='over-map1'>
							<div id='over'>".$game['add1_2_tittle']."</div>
							<a data-fancybox data-src='#4".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-over-map1'>".$kurs_add1_2."</div></a>
						</div>	
						
						<div id='4".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add1_2."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add1_2_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>
													</form>
																					
										        
										    

						</div>	

				</div>			

				<div id='match1add2' class='matchadd'>


						<div id='under-map1'>
							<div id='under'>".$game['add2_1_tittle']."</div>
							<a data-fancybox data-src='#5".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-under-map1'>".$kurs_add2_1."</div></a>
						</div>
						<div id='5".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add2_1."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add2_1_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>
													</form>
																					
										        
										    

						</div>
						
						<div id='over-map1'>
							<div id='over'>".$game['add2_2_tittle']."</div>
							<a data-fancybox data-src='#6".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-over-map1'>".$kurs_add2_2."</div></a>
						</div>	
							
						<div id='6".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add2_2."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

										            <div class='win-potential'><b>Potential win:</b></div>        
										        	<input type='hidden' id='id_bet' name='id_bet' value='add2_2_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>
													</form>
																					
										        
										    

						</div>						

				</div>

			</div>";};
			

if($game['number_add']==3){
	$added.$game[$i] .= "

<div class='betsadd'>


				<div id='match1add1' class='matchadd'>


						
						<div id='under-map1'>
							<div id='under'>".$game['add1_1_tittle']."</div>
							<a data-fancybox data-src='#3".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-under-map1'>".$kurs_add1_1."</div></a>
						</div>
						
						<div id='3".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add1_1."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add1_1_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>

													</form>
																					
										        
										    

						</div>

						
						<div id='over-map1'>
							<div id='over'>".$game['add1_2_tittle']."</div>
							<a data-fancybox data-src='#4".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-over-map1'>".$kurs_add1_2."</div></a>
						</div>	
						
						<div id='4".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add1_2."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add1_2_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>
													</form>
																					
										        
										    

						</div>	

				</div>			

				<div id='match1add2' class='matchadd'>


						<div id='under-map1'>
							<div id='under'>".$game['add2_1_tittle']."</div>
							<a data-fancybox data-src='#5".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-under-map1'>".$kurs_add2_1."</div></a>
						</div>
						<div id='5".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add2_1."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add2_1_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>
													</form>
																					
										        
										    

						</div>
						
						<div id='over-map1'>
							<div id='over'>".$game['add2_2_tittle']."</div>
							<a data-fancybox data-src='#6".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-over-map1'>".$kurs_add2_2."</div></a>
						</div>	
							
						<div id='6".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add2_2."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

										            <div class='win-potential'><b>Potential win:</b></div>        
										        	<input type='hidden' id='id_bet' name='id_bet' value='add2_2_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>
													</form>
																					
										        
										    

						</div>						

				</div>

				<div id='match1add3' class='matchadd'>


						
						<div id='under-map1'>
							<div id='under'>".$game['add3_1_tittle']."</div>
							<a data-fancybox data-src='#7".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-under-map1'>".$kurs_add3_1."</div></a>
						</div>
						
						<div id='7".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add3_1."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add3_1_coins' />
										        	 <input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>
													</form>
																					
										        
										    

						</div>
						
						<div id='over-map1'>
							<div id='over'>".$game['add3_2_tittle']."</div>
							<a data-fancybox data-src='#8".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-over-map1'>".$kurs_add3_2."</div></a>
						</div>		
						
						<div id='8".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add3_2."'
										        			maxlength=10 

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											         <div class='win-potential'><b>Potential win:</b></div>           
										        	<input type='hidden' id='id_bet' name='id_bet' value='add3_2_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>

													</form>
																					
										        
										    

						</div>
				</div>	
			</div>";};
			

if($game['number_add']==4){
	$added.$game[$i] .= "


<div class='betsadd'>


				<div id='match1add1' class='matchadd'>


						
						<div id='under-map1'>
							<div id='under'>".$game['add1_1_tittle']."</div>
							<a data-fancybox data-src='#3".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-under-map1'>".$kurs_add1_1."</div></a>
						</div>
						
						<div id='3".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add1_1."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add1_1_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>

													</form>
																					
										        
										    

						</div>

						
						<div id='over-map1'>
							<div id='over'>".$game['add1_2_tittle']."</div>
							<a data-fancybox data-src='#4".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-over-map1'>".$kurs_add1_2."</div></a>
						</div>	
						
						<div id='4".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add1_2."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add1_2_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>
													</form>
																					
										        
										    

						</div>	

				</div>			

				<div id='match1add2' class='matchadd'>


						<div id='under-map1'>
							<div id='under'>".$game['add2_1_tittle']."</div>
							<a data-fancybox data-src='#5".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-under-map1'>".$kurs_add2_1."</div></a>
						</div>
						<div id='5".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add2_1."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add2_1_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>
													</form>
																					
										        
										    

						</div>
						
						<div id='over-map1'>
							<div id='over'>".$game['add2_2_tittle']."</div>
							<a data-fancybox data-src='#6".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-over-map1'>".$kurs_add2_2."</div></a>
						</div>	
							
						<div id='6".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add2_2."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

										            <div class='win-potential'><b>Potential win:</b></div>        
										        	<input type='hidden' id='id_bet' name='id_bet' value='add2_2_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>
													</form>
																					
										        
										    

						</div>						

				</div>

				<div id='match1add3' class='matchadd'>


						
						<div id='under-map1'>
							<div id='under'>".$game['add3_1_tittle']."</div>
							<a data-fancybox data-src='#7".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-under-map1'>".$kurs_add3_1."</div></a>
						</div>
						
						<div id='7".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add3_1."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add3_1_coins' />
										        	 <input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>
													</form>
																					
										        
										    

						</div>
						
						<div id='over-map1'>
							<div id='over'>".$game['add3_2_tittle']."</div>
							<a data-fancybox data-src='#8".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-over-map1'>".$kurs_add3_2."</div></a>
						</div>		
						
						<div id='8".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add3_2."'
										        			maxlength=10 

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											         <div class='win-potential'><b>Potential win:</b></div>           
										        	<input type='hidden' id='id_bet' name='id_bet' value='add3_2_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>

													</form>
																					
										        
										    

						</div>
				</div>	
				<div id='match1add4' class='matchadd'>



						<div id='under-map1'>
							<div id='under'>".$game['add4_1_tittle']."</div>
							<a data-fancybox data-src='#9".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-under-map1'>".$kurs_add4_1."</div></a>
						</div>
						<div id='9".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add4_1."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add4_1_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>

													</form>
																					
										        
										    

						</div>
						
						<div id='over-map1'>
							<div id='over'>".$game['add4_2_tittle']."</div>
							<a data-fancybox data-src='#10".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-over-map1'>".$kurs_add4_2."</div></a>
						</div>	
						
						<div id='10".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_add4_2."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='add4_2_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'></center>

													</form>
																					
										        
										    

						</div>							

				</div>						

</div>";};


	$listaSpotkan .= "
      <div class='match'>

			<img src='img/".$game['type_match'].".png'/>
				<span style='display: none'>".$game['id_match']."</span>
				<span class='bestof'>BO".$game['number_maps']."</span>
				<span class='time_to_match' style='display:none;'>".$game['date_match']."</span>
				    <div class='time_less'></div>
					<div id='team1'>
						<div id='img-team1'><img src='img/".$game['team1_img'].".png'/></div>
							<div id='team-1'>".$game['team_1']."</div>
							<a data-fancybox data-src='#1".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-team1'>".$kurs_team1."</div></a>

					</div>

		
					
						<div id='1".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' onpaste='return false' 
										        	data-binding='".$game['id_match']."v1' maxlength=10 data-multiplier='".$kurs_team1."'

										        				

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'

											                   
											                    />
											                    
											        <div class='win-potential'><b>Potential win:</b></div>       
										        	<input type='hidden' id='id_bet' name='id_bet' value='team1_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!'style='margin-top:5px;'></center>
											 		

													</form>
																					
										        
										    

						</div>



				<div id='vs'><img src='img/vs.png'></div>
					
					<div id='team2'>
						<div id='img-team2'><img src='img/".$game['team2_img'].".png'/></div>
							<div id='team-2'>".$game['team_2']."</div>
							<a data-fancybox data-src='#2".$game['id_match']."' href='javascript:;' id='betwindowbtn' ><div id='kurs-team2'>".$kurs_team2."</div></a>
					</div>
						
										<div id='2".$game['id_match']."' class='betwindow' >
										    
										    
										       <p><b>Your bet: </b></p>
										       
													<form action='place_bet.php' method='post' class='betBox'>

										        	<center><input type='text' id='value_coins' name='value_coins' autocomplete='off' data-multiplier='".$kurs_team2."'
										        			maxlength=10

																onkeydown='return ( event.ctrlKey || event.altKey 
											                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
											                    || (95<event.keyCode && event.keyCode<106)
											                    || (event.keyCode==8) || (event.keyCode==9) 
											                    || (event.keyCode>34 && event.keyCode<40) 
											                    || (event.keyCode==46) )'/>

											        <div class='win-potential'><b>Potential win:</b></div>            
										        	<input type='hidden' id='id_bet' name='id_bet' value='team2_coins' />
										         	<input type='hidden' id='id_match' name='id_match' value=".$game['id_match']." />
											 		<input type='submit' name='submit' id='Submit' value='Place!' ></center>
													</form>
																					
										        
										    

						</div>


	
					<div id='match-page'><a href=''>Match</a></div>

<div class='more-option'><b><span>+".$game['number_add']."</span></b></div></div>".$added.$game[$i]."";





        
}

?>
<?
echo $listaSpotkan;
?>

<div id="div-value"><center>

	
<?

   



if ($first!=0) print ("<a class ='number-site' href=\"index.php?first=" . ($first-$ltmp) . "\" ><img src='/img/icons-back.png' width='30px' height='30px'></a> ");

for ($i=1;$i<=$ile;$i++)
{
   print ("<a class ='number-site' href=\"index.php?first=" . ($i*$ltmp-$ltmp) . "\" >");

   if ($first==($i*$ltmp-$ltmp))
   {
       print ("<img src='/img/icons-". $i .".png' width='30px' height='30px'></a> "); $akt=$i; } else { print ("<img src='/img/icons-". $i .".png' width='30px' height='30px'></a> ");
   }
}

if ($akt<$ile) print ("<a class ='number-site' href=\"index.php?first=" . ($first+$ltmp) . "\" ><img src='/img/icons-forward.png' width='30px' height='30px'></a>");


?>



</center>
</div>
<br>
<div id="finished-m"><b>Finished matches</b></div>




<?
	

	$db = new Db();

	$first= 10;

$query="SELECT * FROM `games`
	WHERE `status` = :status AND `date_match` < NOW() 
	ORDER BY `date_match` DESC LIMIT :limit ";
$games = $db->query($query, ['status' => 1, 'limit' => $first]);

$listaendSpotkan = '';
$addedend= '';
foreach($games as $i => $game) {


$kurs_team1 = ((int) (((0.95 * $game['team2_coins'])/$game['team1_coins']* 100))/100)+1;
$kurs_team2 = ((int) (((0.95 * $game['team1_coins'])/$game['team2_coins']* 100))/100)+1;

$kurs_add1_1 = ((int) (((0.95 * $game['add1_2_coins'])/$game['add1_1_coins']* 100))/100)+1;
$kurs_add1_2 = ((int) (((0.95 * $game['add1_1_coins'])/$game['add1_2_coins']* 100))/100)+1;

$kurs_add2_1 = ((int) (((0.95 * $game['add2_2_coins'])/$game['add2_1_coins']* 100))/100)+1;
$kurs_add2_2 = ((int) (((0.95 * $game['add2_1_coins'])/$game['add2_2_coins']* 100))/100)+1;

$kurs_add3_1 = ((int) (((0.95 * $game['add3_2_coins'])/$game['add3_1_coins']* 100))/100)+1;
$kurs_add3_2 = ((int) (((0.95 * $game['add3_1_coins'])/$game['add3_2_coins']* 100))/100)+1;

$kurs_add4_1 = ((int) (((0.95 * $game['add4_2_coins'])/$game['add4_1_coins']* 100))/100)+1;
$kurs_add4_2 = ((int) (((0.95 * $game['add4_1_coins'])/$game['add4_2_coins']* 100))/100)+1;



if($game['number_add']==0){

	$addedend.$game[$i] .= " <div class='betsadd'></div>";
};

if($game['number_add']==1){
	$addedend.$game[$i] .= "
<div class='betsadd' style=' filter: grayscale(50%);'>


<div id='match1add1' class='matchadd'>


						
						<div id='under-map1'>
						<img src='/img/confirm.png' class='".$game['add1_1_result']."-bets-confirm'>
							<div id='under'>".$game['add1_1_tittle']."</div>
							<div id='kurs-under-map1end'>".$kurs_add1_1."</div></a>
						</div>
						


						
						<div id='over-map1'>
						<img src='/img/confirm.png' class='".$game['add1_2_result']."-bets-confirm2'>
							<div id='over'>".$game['add1_2_tittle']."</div>
							<div id='kurs-over-map1end'>".$kurs_add1_2."</div></a>
						</div>	
						
	

				</div>	
		</div>";};
		


if($game['number_add']==2){
$addedend.$game[$i].= "	

<div class='betsadd' style=' filter: grayscale(50%);'>


								<div id='match1add1' class='matchadd'>


						
						<div id='under-map1'>
						<img src='/img/confirm.png' class='".$game['add1_1_result']."-bets-confirm'>
							<div id='under'>".$game['add1_1_tittle']."</div>
							<div id='kurs-under-map1end'>".$kurs_add1_1."</div></a>
						</div>
						


						
						<div id='over-map1'>
						<img src='/img/confirm.png' class='".$game['add1_2_result']."-bets-confirm2'>
							<div id='over'>".$game['add1_2_tittle']."</div>
							<div id='kurs-over-map1end'>".$kurs_add1_2."</div></a>
						</div>	
						
	

				</div>			

				<div id='match1add2' class='matchadd'>


						<div id='under-map1'>
						<img src='/img/confirm.png' class='".$game['add2_1_result']."-bets-confirm'>
							<div id='under'>".$game['add2_1_tittle']."</div>
							<div id='kurs-under-map1end'>".$kurs_add2_1."</div></a>
						</div>

						
						<div id='over-map1'>
						<img src='/img/confirm.png' class='".$game['add2_2_result']."-bets-confirm2'>
							<div id='over'>".$game['add2_2_tittle']."</div>
							<div id='kurs-over-map1end'>".$kurs_add2_2."</div></a>
						</div>	
							
					

				</div>

			</div>";};
			

if($game['number_add']==3){
	$addedend.$game[$i] .= "

<div class='betsadd' style=' filter: grayscale(50%);'>


				
				<div id='match1add1' class='matchadd'>


						
						<div id='under-map1'>
						<img src='/img/confirm.png' class='".$game['add1_1_result']."-bets-confirm'>
							<div id='under'>".$game['add1_1_tittle']."</div>
							<div id='kurs-under-map1end'>".$kurs_add1_1."</div></a>
						</div>
						


						
						<div id='over-map1'>
						<img src='/img/confirm.png' class='".$game['add1_2_result']."-bets-confirm2'>
							<div id='over'>".$game['add1_2_tittle']."</div>
							<div id='kurs-over-map1end'>".$kurs_add1_2."</div></a>
						</div>	
						
	

				</div>			

				<div id='match1add2' class='matchadd'>


						<div id='under-map1'>
						<img src='/img/confirm.png' class='".$game['add2_1_result']."-bets-confirm'>
							<div id='under'>".$game['add2_1_tittle']."</div>
							<div id='kurs-under-map1end'>".$kurs_add2_1."</div></a>
						</div>

						
						<div id='over-map1'>
						<img src='/img/confirm.png' class='".$game['add2_2_result']."-bets-confirm2'>
							<div id='over'>".$game['add2_2_tittle']."</div>
							<div id='kurs-over-map1end'>".$kurs_add2_2."</div></a>
						</div>	
							
					

				</div>

				<div id='match1add3' class='matchadd'>


						
						<div id='under-map1'>
						<img src='/img/confirm.png' class='".$game['add3_1_result']."-bets-confirm'>
							<div id='under'>".$game['add3_1_tittle']."</div>
							<div id='kurs-under-map1end'>".$kurs_add3_1."</div></a>
						</div>
						

						
						<div id='over-map1'>
						<img src='/img/confirm.png' class='".$game['add3_2_result']."-bets-confirm2'>
							<div id='over'>".$game['add3_2_tittle']."</div>
							<div id='kurs-over-map1end'>".$kurs_add3_2."</div></a>
						</div>		
						

				</div>	
			</div>";};
			

if($game['number_add']==4){
	$addedend.$game[$i] .= "


<div class='betsadd' style=' filter: grayscale(50%);'>


				<div id='match1add1' class='matchadd'>


						
						<div id='under-map1'>
						<img src='/img/confirm.png' class='".$game['add1_1_result']."-bets-confirm'>
							<div id='under'>".$game['add1_1_tittle']."</div>
							<div id='kurs-under-map1end'>".$kurs_add1_1."</div></a>
						</div>
						


						
						<div id='over-map1'>
						<img src='/img/confirm.png' class='".$game['add1_2_result']."-bets-confirm2'>
							<div id='over'>".$game['add1_2_tittle']."</div>
							<div id='kurs-over-map1end'>".$kurs_add1_2."</div></a>
						</div>	
						
	

				</div>			

				<div id='match1add2' class='matchadd'>


						<div id='under-map1'>
						<img src='/img/confirm.png' class='".$game['add2_1_result']."-bets-confirm'>
							<div id='under'>".$game['add2_1_tittle']."</div>
							<div id='kurs-under-map1end'>".$kurs_add2_1."</div></a>
						</div>

						
						<div id='over-map1'>
						<img src='/img/confirm.png' class='".$game['add2_2_result']."-bets-confirm2'>
							<div id='over'>".$game['add2_2_tittle']."</div>
							<div id='kurs-over-map1end'>".$kurs_add2_2."</div></a>
						</div>	
							
					

				</div>

				<div id='match1add3' class='matchadd'>


						
						<div id='under-map1'>
						<img src='/img/confirm.png' class='".$game['add3_1_result']."-bets-confirm'>
							<div id='under'>".$game['add3_1_tittle']."</div>
							<div id='kurs-under-map1end'>".$kurs_add3_1."</div></a>
						</div>
						

						
						<div id='over-map1'>
						<img src='/img/confirm.png' class='".$game['add3_2_result']."-bets-confirm2'>
							<div id='over'>".$game['add3_2_tittle']."</div>
							<div id='kurs-over-map1end'>".$kurs_add3_2."</div></a>
						</div>		
						

				</div>	
				<div id='match1add4' class='matchadd'>



						<div id='under-map1'>
						<img src='/img/confirm.png' class='".$game['add4_1_result']."-bets-confirm'>
							<div id='under'>".$game['add4_1_tittle']."</div>
							<div id='kurs-under-map1end'>".$kurs_add4_1."</div></a>
						</div>

						
						<div id='over-map1'>
						<img src='/img/confirm.png' class='".$game['add4_2_result']."-bets-confirm2'>
							<div id='over'>".$game['add4_2_tittle']."</div>
							<div id='kurs-over-map1end'>".$kurs_add4_2."</div></a>
						</div>	
						
						

				</div>						

</div>";};


	$listaendSpotkan .= "
      <div  class='match' style='; filter: grayscale(50%);'>

			<img src='img/".$game['type_match'].".jpg'/>
				<span style='display: none'>".$game['id_match']."</span>
				<span class='bestof'>BO".$game['number_maps']."</span>
					<div id='team1'>
						<div id='img-team1'><img src='img/".$game['team1_img'].".png'/></div>
							<img src='/img/confirm.png' class='".$game['team1_result']."-bet-confirm'>
							<div id='team-1'>".$game['team_1']."</div>
							<div id='kurs-team1end'>".$kurs_team1."</div></a>

					</div>

				<div id='vs'><img src='img/vs.png'></div>
					
					<div id='team2'>
						<div id='img-team2'><img src='img/".$game['team2_img'].".png'/></div>
						<img src='/img/confirm.png' class='".$game['team2_result']."-bet-confirm2'>
							<div id='team-2'>".$game['team_2']."</div>
							<div id='kurs-team2end'>".$kurs_team2."</div></a>
					</div>
						

					<div id='match-page'><a href=''>Match</a></div>

<div class='more-option'><b><span>+".$game['number_add']."</span></b></div></div>".$added.$game[$i]."";





        
}


echo $listaendSpotkan;


?>

<div id='footer'><a href=#><center>Term of Service</center></a></div>

</div>



<script type="text/javascript">
	
$("div.more-option").click(function () {
    var przycisk = $(this);
    var tajnaTresc = przycisk.closest(".match").next("div.betsadd");
    
    tajnaTresc.toggle();
    
    var czyTajnaTrescJestUkryta = tajnaTresc.is(":hidden");
    
    
});

</script>



<script>
document.querySelectorAll('[data-multiplier]').forEach(input => {
    input.addEventListener('input', event => {
        event.target.parentNode.querySelector('.win-potential').innerHTML = "<b>Potential win: " + Math.round(event.target.value * event.target.dataset.multiplier) + "</b>";
    });
});
</script>

<script type="text/javascript">
	
	var a = Date.parse(document.getElementsByClassName("time_to_match").value())/1000
	var b = Date.now();
	var still_time = a-b ; 

if(b > a)
{
	document.getElementsByClassName("match").style.display = 'none';
}

else


	document.getElementsByClassName("time_to_match").innerHTML = still_time

</script>

<div id="backgroundd" style="z-index:-2;position:fixed;bottom:-5%;width:100%;height:auto;"><img src="beach.png" style="width:100%;height:auto;"></div>
<script>

$( "#events>div" ).each(function( index ) {
  var date = $.trim($(this).find('.time_to_match').text());
  CountDownTimer($(this));
});

function CountDownTimer(element)
{
	var offset = 120+(new Date().getTimezoneOffset());
	var dt = $.trim(element.find('.time_to_match').text());
	var date_less = dt.substr(0, 10);
    var match = $.trim(element.find('.match'));
    var end = new Date(dt);
    
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;
    showRemaining();

    function showRemaining() {
    	var now = new Date();
        var distance = end - now -((offset/60)*3600000);
        if (distance < 0) {
            
            clearInterval(timer);
            element.hide();
            
            
            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);
        
        
        if (String(hours).length < 2){
            hours = 0 + String(hours);
        }
        if (String(minutes).length < 2){
            minutes = 0 + String(minutes);
        }
        if (String(seconds).length < 2){
            seconds = 0 + String(seconds);
        }
        
        if(days == 0)
        {
            if(days == 0 && hours == 0)
              {
                       
        			if(days == 0 && hours == 0 && minutes == 0 )
        						{
       								 var datestr = seconds + ' s';
        						}
         
         					else
         					{
        							var datestr =  minutes + ' m ' + 
                   				 seconds + ' s';
                   }
             }
         
         else
         	{
        		var datestr = hours + ' h ' + 
                      minutes + ' m ' ;
          }
          
         }
        


         else
         {
         	        var datestr = date_less;
         
         }
         
         
        element.find('.time_less').html('<b><center>'+datestr+'</b></center>');
    }
    
    timer = setInterval(showRemaining, 1000);
}

</script>
</body>
</html>