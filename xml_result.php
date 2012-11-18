<?php

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
	mysql_select_db("hs", $con);
	
$modus='short';

if(isset($_GET['mode']))$modus = stripslashes($_GET['mode']);
include('functions.php');
if($modus =='short'){
$sql ="SELECT Firmen.FID, Firmen.Name as Firma, Firmen.PLZ, Firmen.bew_avg as wertung, Firmen.bew_cnt as anz_bew, (SELECT group_concat(distinct Studienschwerpunkte.Name order by Studienschwerpunkte.Name separator ',' ) from Studienschwerpunkte, DecktAb_Schwerpunkt WHERE DecktAb_Schwerpunkt.SID_FK = Studienschwerpunkte.SID AND DecktAb_Schwerpunkt.FID_FK = Firmen.FID ) as Schwerpunkte,(SELECT group_concat(distinct Themen.Name order by Themen.Name separator ',' ) from Themen, Behandelt_Thema WHERE Themen.TID = Behandelt_Thema.TID_FK AND Behandelt_Thema.FID_FK = Firmen.FID ) as Themen FROM Firmen";
}else if($modus =='long'){
//do something different	
}

$result = mysql_query($sql);
if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

if (mysql_num_rows($result) == 0) {
    echo  "No rows found, nothing to print so am exiting";
    exit;
}

if($result>0){
	$xml = createMyXML($result, $modus);
}

mysql_free_result($result);
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="firmendatenbank.xml"');
echo $xml;
?>