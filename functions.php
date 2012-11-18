<?php
function createMyXML($result, $modus){
	$xml = "<?xml version='1.0' encoding='iso-8859–1' ?> \n";
	$xml .= "\t<firmendatenbank>\n";
	while($row = mysql_fetch_array($result)){
	$xml.="\t\t<firma>\n";
	
	//ID und Name
	$xml.="\t\t\t<FID>".$row['FID']."</FID>\n";
	$xml .="\t\t\t<Name>".$row['Firma']."</Name>\n";
	
	//Schwerpunkte und Themen aufsplitten
	$xml .= "\t\t\t<Studienschwerpunkte> \n";
	
	$schwerpunkte = explode(",", $row['Schwerpunkte']);
	foreach($schwerpunkte as $schwerpunkt){
		$xml .="\t\t\t\t<Schwerpunkt>".$schwerpunkt."</Schwerpunkt>\n";
	}
	
	$xml .="\t\t\t</Studienschwerpunkte> \n";
	
	$xml .="\t\t\t<Themen> \n";
	$themen = explode(",", $row['Themen']);
	foreach($themen as $thema){
		$xml .="\t\t\t\t<Thema>".$thema."</Thema>\n";
	}
	
	$xml .="\t\t\t</Themen> \n";
	
	$xml .="\t\t\t<Kontaktdaten> \n";

	//Unterscheidung kurz übersicht oder kompletter export
	if($modus =='long'){
		//Kontakt

		$xml .="\t\t\t\t<E-Mail>".$row['EMail']."</E-Mail>\n";
		$xml .="\t\t\t\t<URL>".$row['EMail']."<URL>\n";
		$xml .="\t\t\t\t<Strasse>".$row['Straße']."<Strasse>\n";
		$xml .="\t\t\t\t<Ort>".$row['Standort']."<Ort>\n";
		
	}
		$xml .="\t\t\t\t<PLZ>".$row['PLZ']."</PLZ>\n";
	$xml .="\t\t\t</Kontaktdaten> \n";
	
	if($modus =='long'){
			$xml .="\t\t\t<Beschreibung>".$row['Beschreibung']." </Beschreibung>\n";
	}
	
	// Bewertung
	$xml .="\t\t\t<Bewertung> \n";
	$xml .="\t\t\t\t<Durchschnitt>".$row['wertung']."</Durchschnitt>\n";
	$xml .="\t\t\t\t<Anzahl>".$row['anz_bew']."</Anzahl>\n";
	$xml .="\t\t\t</Bewertung> \n";

	$xml .="\t\t</firma>\n";	
	}
$xml .="\t</firmendatenbank>\n</xml>";
// MIME-Type und Dokument zurückgeben
return $xml;
}
?>