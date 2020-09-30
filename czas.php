<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <title>Serwis ABC</title>
    <meta http-equiv=content-type content="text/html; charset=iso-8859-2">
    <meta http-equiv="Content-Language" content="pl">
    <meta http-equiv="Refresh" content="5" />
</head>

<body>

<?php
$data = '2018-03-27 22:00:00';
$string_czas_do_wydarzenia = timematch ($data);

if ($string_czas_do_wydarzenia=="")
    echo 'LIVE<br />';
else
    echo  $string_czas_do_wydarzenia . ' from now <br />';

?>

<?php
$data = '2018-03-27 24:00:00';
$string_czas_do_wydarzenia = timematch ($data);

if ($string_czas_do_wydarzenia=="")
    echo 'LIVE<br />';
else
    echo  $string_czas_do_wydarzenia . ' from now <br />';

?>







<?
function timematch($data_wydarzenia) {
    $data_aktualna = Date('Y-m-d H:i:s');
    
    $liczba_sekund_dla_wydarzenia = StrToTime($data_wydarzenia);
    $liczba_sekund_dla_aktualnej_daty = StrToTime($data_aktualna);
 
    $liczba_sekund_miedzy_datami = $liczba_sekund_dla_wydarzenia - $liczba_sekund_dla_aktualnej_daty;


    if ($liczba_sekund_miedzy_datami<=0)
       return "";
 
    $liczba_sekund_w_roku = 365*24*60*60;

    $liczba_lat = Floor ($liczba_sekund_miedzy_datami/$liczba_sekund_w_roku);


    if ($liczba_lat > 0)

       $string_liczba_lat = "lat: $liczba_lat, ";

    else 
       $string_liczba_lat = "";
 
                    $liczba_sekund_w_miesiacu = 30*24*60*60;

                    $pozostała_liczba_sekund_miedzy_datami = $liczba_sekund_miedzy_datami - $liczba_lat*$liczba_sekund_w_roku;

                    $liczba_miesiecy = Floor($pozostała_liczba_sekund_miedzy_datami/$liczba_sekund_w_miesiacu);

    if ($liczba_miesiecy > 0)
       $string_liczba_miesiecy = "miesięcy: $liczba_miesiecy, ";
    else 
       $string_liczba_miesiecy = "";
 
                    $liczba_sekund_w_dniu = 24*60*60;

                    $pozostała_liczba_sekund_miedzy_datami = $pozostała_liczba_sekund_miedzy_datami - $liczba_miesiecy*$liczba_sekund_w_miesiacu;

                    $liczba_dni = Floor($pozostała_liczba_sekund_miedzy_datami/$liczba_sekund_w_dniu);

    if ($liczba_dni > 0)
       $string_liczba_dni = "$liczba_dni days ";
    else 
       $string_liczba_dni = "";
 
                    $liczba_sekund_w_godzinie = 60*60;

                    $pozostała_liczba_sekund_miedzy_datami = $pozostała_liczba_sekund_miedzy_datami - $liczba_dni*$liczba_sekund_w_dniu;

                    $liczba_godzin = Floor($pozostała_liczba_sekund_miedzy_datami/$liczba_sekund_w_godzinie);

    if ($liczba_godzin > 0)
       $string_liczba_godzin = "$liczba_godzin hours";
    else 
       $string_liczba_godzin = "";
 
                    $liczba_sekund_w_minucie = 60;

                    $pozostała_liczba_sekund_miedzy_datami = $pozostała_liczba_sekund_miedzy_datami - $liczba_godzin*$liczba_sekund_w_godzinie;

                    $liczba_minut = Floor($pozostała_liczba_sekund_miedzy_datami/$liczba_sekund_w_minucie);

    if ($liczba_minut > 0)
       $string_liczba_minut = "$liczba_minut minutes ";
    else 
       $string_liczba_minut = "";
 

    $liczba_sekund = $pozostała_liczba_sekund_miedzy_datami - $liczba_minut*$liczba_sekund_w_minucie;
    $string_liczba_sekund = "$liczba_sekund sec ";

    if($liczba_dni == 0 && $liczba_godzin > 0 )
    {
    $string_czas_do_wydarzenia = $string_liczba_godzin;};
    if($liczba_dni == 0 && $liczba_godzin == 0 ){
    $string_czas_do_wydarzenia = $string_liczba_minut;};
    if($liczba_dni == 0 && $liczba_godzin == 0 && $liczba_minut == 0){
    $string_czas_do_wydarzenia = $string_liczba_sekund; };
 
    return $string_czas_do_wydarzenia;
 }



 ?>


</body>
</html>