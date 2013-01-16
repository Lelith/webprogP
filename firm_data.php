<?php
include_once('functions.php');
include_once('db_con.php');
$html = " ";
$cid = -1;
if(isset($_POST['cid'])){
	$cid = stripslashes($_POST['cid']);

	if(is_numeric($_POST['wert'])){
		$sql = "INSERT INTO hs.Bewertungen(Bewertung, Kommentar, Gehoert_Zu_FID) VALUES ('".$_POST['wert']."', '".$_POST['begruendung']."', '".$cid."');";
		$res = mysql_query($sql);
	}
	$stars = 0;
	$anzBew = 0;
	// sterne durchschnitt berechnen
	 $sqlWertungen ="SELECT Bewertung FROM Bewertungen WHERE Gehoert_Zu_FID =".$cid.";";

	 $resWertungen = mysql_query($sqlWertungen);
		if (!$resWertungen) {
		    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
		    exit;
			}

 		if(mysql_num_rows($resWertungen) == 1 || mysql_num_rows($resWertungen) == 0 ){

			$stars = $_POST['wert'];
			$anzBew =1;
		}else{
			while($row = mysql_fetch_array($resWertungen)){
				$stars +=$row['Bewertung'];
				$anzBew++; 
			}
			//auf ganze zahlen mathematisch korrekt runden
			$stars = round(($stars/$anzBew));
		}
		
		//avg und anzahl in firma updaten
		$update = "UPDATE Firmen SET bew_cnt = '".$anzBew."', bew_avg ='".$stars."' WHERE Firmen.FID ='".$cid."'";
		$resUpdate = mysql_query($update);	

}

//firmen daten anzeigen
if(isset($_GET['cid']) || $cid >=0){
	if(isset($_GET['cid'])) $cid = stripslashes($_GET['cid']);

	if(is_numeric($cid)){
		// Firmendaten

		$sql = "SELECT Firmen.FID, Firmen.Name as Name, Firmen.PLZ, Firmen.URL, Firmen.Strasse, Firmen.Standort, Firmen.Email, Firmen.Beschreibung,Firmen.Screenshot, (SELECT group_concat(distinct Studienschwerpunkte.Name order by Studienschwerpunkte.Name separator ',' ) from Studienschwerpunkte, DecktAb_Schwerpunkt WHERE DecktAb_Schwerpunkt.SID_FK = Studienschwerpunkte.SID AND DecktAb_Schwerpunkt.FID_FK = Firmen.FID ) as Schwerpunkte,(SELECT group_concat(distinct Themen.Name order by Themen.Name separator ',' ) from Themen, Behandelt_Thema WHERE Themen.TID = Behandelt_Thema.TID_FK AND Behandelt_Thema.FID_FK = Firmen.FID ) as Themen FROM Firmen WHERE Firmen.FID = ".$cid.";";
			$result = execQuery($sql);
			while($row = mysql_fetch_array($result)){
				
				$html .="<div id='fid' class='hiding'>".$row['FID']."</div>";
				$html .="<h1>".$row['Name']."</h1>";
				$html .="<img src='/hs/images/".$row['Screenshot']."' width='600'>";
				$html .="<div class='row'><h2>Beschreibung</h2><p>".$row['Beschreibung']."</p></div>";  
				$html .="<div class='row'><h2>Alle Themen</h2><p>".$row['Themen']."</p></div>";  
				$html .="<div class='row'><h2>Alle Schwerpunkte</h2><p>".$row['Schwerpunkte']."</p></div>"; 
				$html .="<div class='row'><h2>Adresse</h2><p>".$row['Strasse'].",<br>".$row['PLZ']." ".$row['Standort']."</p></div>"; 
				$html .="<div class='row'><h2>Kontakt</h2><p><a href='mailto:".$row['Email']."'>".$row['Email']."</a></p></div>"; 
				
			}

			
			$html .="<h2>Bewertungen</h2>";
			$html .="<section  id='bewertungen'>";
			$sqlWertungen ="SELECT * FROM Bewertungen WHERE Gehoert_Zu_FID =".$cid.";";
			$resWertungen = mysql_query($sqlWertungen);
			if (!$resWertungen) {
			    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
			    exit;
				}
				
			if (mysql_num_rows($resWertungen) == 0) {
		    	$html .="<div class='hint'> Noch Keine Bewertung abgegeben</div>";
			}else{
				while($row = mysql_fetch_array($resWertungen)){
			
					$html .="<div class='wertung'>";
					$html.=	"<p>".$row['Kommentar']."</p>";
					$html.=	"<img src='./img/Sterne/star".$row['Bewertung'].".png'></div>";
				
			
				}
			}
			
			$html .="	<button type='button' id='bewerten'>Firma Bewerten</button>";
			$html .="	<div class='wertung-form'>";
			$html .="	<ul id='stars'>";
			$html .="		<li class='star1' data-wert='1'></li>";
			$html .="		<li class='star2' data-wert='2'></li>";
			$html .="		<li class='star3' data-wert='3'></li>";
			$html .="		<li class='star4' data-wert='4'></li>";
			$html .="		<li class='star5' data-wert='5'></li>";
			$html .="	</ul>";
			$html .="	<label for='begruendung'>Begründung</label>";
			$html .="	<br><textarea name='begruendung' placeholder='Bitte geben Sie hier Ihre Begründung für die Bewertung ein'></textarea>";
			$html .="	<button type='button' id='wertung-senden'>senden</button>";
		$html .="	</div>			";
		//TO DO fehlermeldung
	}else{
		print "Keine gütlige Firmen ID";
	}
}else {
			print "Keine gütlige Firmen ID";
	
}
print $html;
?>