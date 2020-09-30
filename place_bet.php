<?php
	require("Db.class.php");
	require 'steamauth/steamauth.php';
	require 'steamauth/userInfo.php';

$db = new Db();

$db->bind("id_user", $steamprofile['steamid']);
$balance =$db->single("SELECT balance FROM users WHERE id_user = :id_user");


$id_match = $_POST['id_match'];
$id_bet = $_POST['id_bet'];
$value_coins = $_POST['value_coins'];

$db->bind("id_match", $id_match);
$id_bet_coins = $db->single("SELECT ".$id_bet." FROM games WHERE id_match = :id_match");

$db->bind("id_user", $steamprofile['steamid']);
$db->bind("id_bet", $id_bet);
$db->bind("id_match", $id_match);
$bet_number =$db->single("SELECT COUNT(*) FROM bet_placed WHERE id_match = :id_match AND id_bet = :id_bet AND id_user = :id_user ");

$db->bind("id_user", $steamprofile['steamid']);
$promo_is_use =$db->single("SELECT promocode FROM users WHERE id_user = :id_user ");


$percentofbet=round(0.5*$value_coins);

$db->bind("promocode", $promo_is_use);
$affiliates_worth =$db->single("SELECT affiliates FROM users WHERE code=:promocode ");

$db->bind("promocode", $promo_is_use);
$affiliates_total_worth =$db->single("SELECT affiliatestotal FROM users WHERE code=:promocode ");

if ( $value_coins > 0 ) 

{

			if( $value_coins <= $balance)
			
			{
					if ($bet_number == 0)

					{

							$insert  =  $db->query("INSERT INTO bet_placed(id_match,id_bet,id_user,value_coins) VALUES(:id_match,:id_bet,:id_user,:valuecoins)",
							 			array("id_match"=>$id_match ,"id_bet"=>$id_bet ,"id_user"=> $steamprofile['steamid'],"valuecoins"=>$value_coins));

							
									if($promo_is_use == "")
									{}
									else
									{
									$update_4 = $db->query("UPDATE users SET affiliates=:affiliates+:percentofbet WHERE code=:promocode",
													array("affiliates"=>$affiliates_worth,"percentofbet"=>$value_coins, "promocode"=> $promo_is_use));

									$update_5 = $db->query("UPDATE users SET affiliatestotal=:affiliatestotal+:percentofbet WHERE code=:promocode",
													array("affiliatestotal"=>$affiliates_total_worth,"percentofbet"=>$value_coins, "promocode"=> $promo_is_use));
									}	

					}		
					
					else
					{
							$db->bind("id_user", $steamprofile['steamid']);
							$db->bind("id_bet", $id_bet);
							$db->bind("id_match", $id_match);

							$actually_worth =$db->single("SELECT value_coins FROM bet_placed WHERE id_match = :id_match AND id_bet = :id_bet AND id_user = :id_user ");

							$update = $db->query("UPDATE bet_placed SET value_coins=:actually_worth+:value_coins WHERE id_match = :id_match AND id_bet = :id_bet AND id_user = :id_user ",
									array("actually_worth"=>$actually_worth,"value_coins"=>$value_coins, "id_match"=>$id_match,"id_bet"=>$id_bet, "id_user"=> $steamprofile['steamid']));

									if($promo_is_use == "")
									{}
									else
									{
									$update_4 = $db->query("UPDATE users SET affiliates=:affiliates+:percentofbet WHERE code=:promocode",
													array("affiliates"=>$affiliates_worth,"percentofbet"=>$percentofbet, "promocode"=> $promo_is_use));

									$update_5 = $db->query("UPDATE users SET affiliatestotal=:affiliatestotal+:percentofbet WHERE code=:promocode",
													array("affiliatestotal"=>$affiliates_total_worth,"percentofbet"=>$percentofbet, "promocode"=> $promo_is_use));
									}	


					}	
						
	
							$update_2 = $db->query("UPDATE users SET balance=:balance-:value_coins WHERE id_user=:user",
									array("balance"=>$balance,"value_coins"=>$value_coins, "user"=> $steamprofile['steamid']));

							$update_3 = $db->query("UPDATE games SET  ".$id_bet."=:id_bet_coins+:value_coins WHERE id_match=:id_match",
							array("id_bet_coins"=>$id_bet_coins,"value_coins"=>$value_coins, "id_match"=>$id_match));

							$response_array['status'] = 'success';    

							echo json_encode($response_array);
			}
			
			else 
			
			{
					
				
					
			}
			


}
			
else 

{
	
	
	
}
						

mysql_close();


?>
