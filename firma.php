
<?php
//Header informations for all pages
include('functions.php');
include_once('header.php');
?>
<div class="content">
<div class="left">
	<?php
	include_once('menu.php');?>
</div>
<div class="middle">
<?php
include_once('search.php');
?>
<hr>
<?php
if(isset($_GET['cid']))$cid = stripslashes($_GET['cid']);

	if(is_numeric($cid)){
		// Firmendaten
		$sql = "SELECT Firmen.FID, Firmen.Name as Name, Firmen.PLZ, Firmen.URL, Firmen.Strasse, Firmen.Standort, Firmen.Email, Firmen.Beschreibung,Firmen.Screenshot, (SELECT group_concat(distinct Studienschwerpunkte.Name order by Studienschwerpunkte.Name separator ',' ) from Studienschwerpunkte, DecktAb_Schwerpunkt WHERE DecktAb_Schwerpunkt.SID_FK = Studienschwerpunkte.SID AND DecktAb_Schwerpunkt.FID_FK = Firmen.FID ) as Schwerpunkte,(SELECT group_concat(distinct Themen.Name order by Themen.Name separator ',' ) from Themen, Behandelt_Thema WHERE Themen.TID = Behandelt_Thema.TID_FK AND Behandelt_Thema.FID_FK = Firmen.FID ) as Themen FROM Firmen WHERE Firmen.FID = ".$cid.";";
			$result = execQuery($sql);
			$html = " ";
			while($row = mysql_fetch_array($result)){
				$html .="<h1>".$row['Name']."</h1>";
				$html .="<img src='/hs/images/".$row['Screenshot']."' width='600'>";
				$html .="<div class='row'><h2>Beschreibung</h2><p>".$row['Beschreibung']."</p></div>";  
				$html .="<div class='row'><h2>Alle Themen</h2><p>".$row['Themen']."</p></div>";  
				$html .="<div class='row'><h2>Alle Schwerpunkte</h2><p>".$row['Schwerpunkte']."</p></div>"; 
				$html .="<div class='row'><h2>Adresse</h2><p>".$row['Strasse'].",<br>".$row['PLZ']." ".$row['Standort']."</p></div>"; 
				$html .="<div class='row'><h2>Kontakt</h2><p><a href='mailto:".$row['Email']."'>".$row['Email']."</a></p></div>"; 
			}
			print $html;
			?>
			<h2>Bewertungen</h2>
			<button type="button" id="bewerten">Firma Bewerten</button>
			<div class="wertung-form">
				<ul class="stars">
					<li class="star1"></li>
					<li class="star2"></li>
					<li class="star3"></li>
					<li class="star4"></li>
					<li class="star5"></li>
				</ul>
				<label for="begruendung">Begründung</label>
				<br><textarea name="begruendung" placeholder="Bitte geben Sie hier Ihre Begründung für die Bewertung ein"></textarea>
				<button type="button" id="wertung-senden">senden</button>
			</div>
<?php			
	}else{
		print "Keine gütlige Firmen ID";
	}


?>


</div>
</div>
<?php
//footer contents for all pages
include_once('footer.php');
?>
