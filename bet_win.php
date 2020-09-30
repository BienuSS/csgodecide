<?php

	

	$db = new Db();

$query="SELECT * FROM `games`
	INNER JOIN bet_placed ON games.id_match=bet_placed.id_match
	WHERE `id_user` = :id_user 
	ORDER BY `date_match`
	LIMIT :limit;
	
	";

$betlist = $db->query($query, ['id_user' => $steamprofile['steamid'], 'limit' => 20]);

 
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

				}
				else
				{


				}




}	

if($status[$i] == 'Lose')
{
	$status1[$i]	.="<font color='red'>".$status[$i]."</font>";
	$profit[$i] .="<font color='red'>-".$bet_one['value_coins']."</font>";
}	

if($status[$i] == 'Draw')
{
	$profit[$i] .="0";
	$status1[$i] .="Returned";
	$profit1[$i] .= $bet_one['value_coins'];
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

				}
				else
				{


				}
}	

}
					
?>