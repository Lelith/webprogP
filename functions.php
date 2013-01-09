<?php
include('db_con.php');

function createMyXML($result, $tablename, $rowname){
	if(strlen($tablename)>0)$xml ="<".$tablename.">\n";
	
	while($row = mysql_fetch_assoc($result)){
		$xml .="\t<".$rowname.">\n";
		foreach( $row as $key => $value){
			if($key == 'Schwerpunkte'){
				$xml .= "\t\t\t<Studienschwerpunkte> \n";

				$schwerpunkte = explode(",", $value);
				foreach($schwerpunkte as $schwerpunkt){
					$xml .="\t\t\t\t<Schwerpunkt>".$schwerpunkt."</Schwerpunkt>\n";
				}
				$xml .= "\t\t\t</Studienschwerpunkte> \n";
				
			}else if($key =='Themen'){
				$xml .= "\t\t\t<Themen> \n";

				$themen = explode(",", $value);
				foreach($themen as $thema){
					$xml .="\t\t\t\t<Thema>".$thema."</Thema>\n";
				}
			$xml .= "\t\t\t</Themen> \n";
			}else{
				$xml.="\t\t\t\t<".$key."> ".$value." </".$key.">\n";
			}
			
	}
	$xml .="\t</".$rowname.">\n";
}
if(strlen($tablename)>0)$xml.="</".$tablename.">";
return $xml;
}

/*Führt die Datenbank abfrage aus und überprüft das ergebniss*/
function execQuery($sql){
	$result = mysql_query($sql);
	if (mysql_num_rows($result) == 0) {
    	echo  mysql_num_rows($result)."No rows found, nothing to print so am exiting";
    	exit;
	}	

	if (!$result) {
	    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
	    exit;
	}
	
return $result;
}

function getBanner(){
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
	return $html;
}


?>