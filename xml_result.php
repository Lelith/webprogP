<?php

header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="firmendatenbank.xml"');

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
	mysql_select_db("hs", $con);
	
$modus='short';

if(isset($_GET['mode']))$modus = stripslashes($_GET['mode']);
include('functions.php');


switch($modus){
	case "short":
	$sql ="SELECT Firmen.FID, Firmen.Name, Firmen.PLZ, Firmen.bew_avg as wertung, Firmen.bew_cnt as anz_bew, (SELECT group_concat(distinct Studienschwerpunkte.Name order by Studienschwerpunkte.Name separator ',' ) from Studienschwerpunkte, DecktAb_Schwerpunkt WHERE DecktAb_Schwerpunkt.SID_FK = Studienschwerpunkte.SID AND DecktAb_Schwerpunkt.FID_FK = Firmen.FID ) as Schwerpunkte,(SELECT group_concat(distinct Themen.Name order by Themen.Name separator ',' ) from Themen, Behandelt_Thema WHERE Themen.TID = Behandelt_Thema.TID_FK AND Behandelt_Thema.FID_FK = Firmen.FID ) as Themen FROM Firmen";
	
	
		$result = execQuery($sql);
		//usage: $sql_result, $tablename, $rowname
		$xml =	createMyXML($result, "Firmen", "Firma");
		
		mysql_free_result($result);
		$xml = "<?xml version='1.0' encoding='utf-8'?> \n".$xml;
		echo $xml;
	break;
	case "export":
	
	//export all company data
	$sql = "SELECT Firmen.FID, Firmen.Name as Name, Firmen.PLZ, Firmen.URL, Firmen.Email, Firmen.Beschreibung, Firmen.bew_avg as wertung, Firmen.bew_cnt as anz_bew, (SELECT group_concat(distinct Studienschwerpunkte.SID order by Studienschwerpunkte.SID separator ',' ) from Studienschwerpunkte, DecktAb_Schwerpunkt WHERE DecktAb_Schwerpunkt.SID_FK = Studienschwerpunkte.SID AND DecktAb_Schwerpunkt.FID_FK = Firmen.FID ) as Schwerpunkte,(SELECT group_concat(distinct Themen.TID order by Themen.TID separator ',' ) from Themen, Behandelt_Thema WHERE Themen.TID = Behandelt_Thema.TID_FK AND Behandelt_Thema.FID_FK = Firmen.FID ) as Themen FROM Firmen";
	
	$result1 =execQuery($sql);
	$firmen =	createMyXML($result1, "Firmen", "Firma");
	// themen tabelle
	$sql = "SELECT * FROM Themen";
	$result2 = execQuery($sql);
	$themen =	createMyXML($result2, "Themen", "Thema");
	
	// schwerpunkte tabelle
	$sql = "SELECT * FROM Studienschwerpunkte";
	$result3 = execQuery($sql);
	$schwerpunkte =	createMyXML($result3, "Studienschwerpunkte", "Schwerpunkt");
	
	$xml = "<?xml version='1.0' encoding='utf-8'?> \n".$themen."\n".$schwerpunkte."\n".$firmen;
	
	
	
	mysql_free_result($result1);
	mysql_free_result($result2);
	mysql_free_result($result3);
	echo $xml;
	break;
	case "filter":
		if(isset($_GET['themen'])) $themen = stripslashes($_GET['themen']);
		//$themen = preg_split($themen,',');
		// do db select with filter statements

	
		$sql ="SELECT us.t2name as Firma, us.tag as Themen";
		$sql .=" FROM (";
		$sql .="	SELECT f2.name as t2name,(";
		$sql .="		SELECT group_concat(distinct t2.Name order by t2.Name separator ',' ) ";
		$sql .="		FROM Themen t2, Behandelt_Thema bt2,  Firmen f3";
		$sql .="		WHERE t2.TID = bt2.TID_FK ";
		$sql .="		AND bt2.FID_FK = f2.FID ";
		$sql .="		AND t2.Name Like 'Python'";
		$sql .="	 	) as tag FROM Firmen f2";
		$sql .="	) us";
		$sql .=" WHERE us.tag IS not NULL";
	
	
		
	break;
}


function execQuery($sql){
	$result = mysql_query($sql);
	if (!$result) {
	    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
	    exit;
	}

	if (mysql_num_rows($result) == 0) {
	    echo  "No rows found, nothing to print so am exiting";
	    exit;
	}
	
return $result;
}
?>