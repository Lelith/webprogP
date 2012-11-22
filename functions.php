<?php
function createMyXML($result){
	$xml ='';
	while($row = mysql_fetch_assoc($result)){
		foreach( $row as $key => $value){
			if($key == 'Schwerpunkte'){
				$xml .= "\t\t\tStudienschwerpunkte \n";

				$schwerpunkte = explode(",", $value);
				foreach($schwerpunkte as $schwerpunkt){
					$xml .="\t\t\t\tSchwerpunkt".$schwerpunkt."/Schwerpunkt\n";
				}
			}else if($key =='Themen'){
				$xml .= "\t\t\tThemen \n";

				$themen = explode(",", $value);
				foreach($themen as $thema){
					$xml .="\t\t\t\tThema".$thema."/Thema\n";
				}
			
			}else{
				$xml.=$key.": ".$value." / ".$key."<br>";
			}
			
	}
}

/*	
	//Schwerpunkte und Themen aufsplitten
	
	
	$xml .="\t\t\t</Studienschwerpunkte> \n";
	
	$xml .="\t\t\t<Themen> \n";
	$themen = explode(",", $row['Themen']);
	foreach($themen as $thema){
		$xml .="\t\t\t\t<Thema>".$thema."</Thema>\n";
	}
	
	$xml .="\t\t\t</Themen> \n";
	*/

return $xml;
}
?>