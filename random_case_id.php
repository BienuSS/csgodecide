<?
session_start();
	$case1_skin = $_POST[$_SESSION[$hash]];
	$case2_skin = $_POST[$_SESSION[$hash2]];
	$case3_skin = $_POST[$_SESSION[$hash3]];
	$case4_skin = $_POST[$_SESSION[$hash4]];
	$case5_skin = $_POST[$_SESSION[$hash5]];
	$case6_skin = $_POST[$_SESSION[$hash6]];
	$case7_skin = $_POST[$_SESSION[$hash7]];
	$case8_skin = $_POST[$_SESSION[$hash8]];
	$case9_skin = $_POST[$_SESSION[$hash9]];
	$case10_skin = $_POST[$_SESSION[$hash10]];
	$case11_skin = $_POST[$_SESSION[$hash11]];
	$case12_skin = $_POST[$_SESSION[$hash12]];
	$case13_skin = $_POST[$_SESSION[$hash13]];
	$case14_skin = $_POST[$_SESSION[$hash14]];
	$case15_skin = $_POST[$_SESSION[$hash15]];
	$case16_skin = $_POST[$_SESSION[$hash16]];

	$myObj1->case1 = $case1_skin;
	$myObj1->case2 = $case2_skin;
	$myObj1->case3 = $case3_skin;
	$myObj1->case4 = $case4_skin;
	$myObj1->case5 = $case5_skin;
	$myObj1->case6 = $case6_skin;
	$myObj1->case7 = $case7_skin;
	$myObj1->case8 = $case8_skin;
	$myObj1->case9 = $case9_skin;
	$myObj1->case10 = $case10_skin;
	$myObj1->case11 = $case11_skin;
	$myObj1->case12 = $case12_skin;
	$myObj1->case13 = $case13_skin;
	$myObj1->case14 = $case14_skin;
	$myObj1->case15 = $case15_skin;
	$myObj1->case16 = $case16_skin;


	$myJSON1 = json_encode($myObj1);

	echo $myJSON1;
?>