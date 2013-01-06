<?php
	header('Content-Type: text/event-stream');
	header('Cache-Control: no-cache');
include('functions.php');
/*$time = date('r');
echo "data: The server time is: {$time}\n\n";
flush();*/

	$sql = "Select FID from Firmen";
	$result = execQuery($sql);
	$arrCID =array();
	while($row = mysql_fetch_array($result)){
		array_push($arrCID,$row["FID"]);
	}
	
	$rdnCID = array_rand($arrCID, 1);
	$bannerSQL = "SELECT Name, Banner FROM Firmen WHERE FID =".$arrCID[$rdnCID];
	$bannerInfo = execQuery($bannerSQL);
	$html ="";
	
	while($row = mysql_fetch_array($bannerInfo)){
		$html = "<a href='firma.php?cid=".$arrCID[$rdnCID]."'><h2 class='advertise'>".$row['Name']."</h2><img src='/hs".$row['Banner']."'></a>";
	}
	
	echo "data:	".$html;		
	flush();
		sleep(20);

?>