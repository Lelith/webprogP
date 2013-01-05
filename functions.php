<?php
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

function execQuery($sql){
	$con = dbConnection();
	mysql_select_db("hs", $con);
	$result = mysql_query($sql);
	if (mysql_num_rows($result) == 0) {
    	echo  mysql_num_rows($result)."No rows found, nothing to print so am exiting";
    	exit;
	}	

	if (!$result) {
	    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
	    exit;
	}

mysql_close($con);
	
return $result;
}



?>