<?php
function createMyXML($result, $tablename, $rowname){
	$xml ="<table name='".$tablename."'>\n";
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
$xml.="</table>";
return $xml;
}
?>