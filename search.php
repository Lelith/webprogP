<?php
include_once('functions.php');
include_once('db_con.php');
?>
<script src="./js/search.js"></script>

<!--TODO zurueck zum suchergebniss -->
<p class="info">
	Bitte wählen Sie die Suchkriterien aus.
</p>
<ul id="tabs">
	<li>
		<a href="#schwerpunkt">Schwerpunkt</a>
		<ul class="aktiv f_sw">
			<?php
			if(isset($_GET['schwerpunkte'])){
				$schwerpunkte =$_GET['schwerpunkte'];
				$swSQL = "SELECT * FROM Studienschwerpunkte Where SID IN (".$schwerpunkte.")";
				$swRes = execQuery($swSQL);
				$html = "";
				while($row = mysql_fetch_array($swRes)){	
					print "<li class='filter-schwerpunkt' data-id='".$row['SID']."'>".$row['Name']."<span class='remove'>&nbsp;</span></li>";
				}
			}
			?>
		</ul>
	</li>
	<li>
		<a href="#plz">| PLZ </a>
		<ul class="aktiv f_plz">
			<?php
			if(isset($_GET['plz'])){
				$plzStr =$_GET['plz'];
				$plzArr = preg_split("/,/", $plzStr);
				foreach($plzArr as $plz){
					print "<li class='filter-plz' data-id='".$plz."'>".$plz."<span class='remove'>&nbsp;</span></li>";
				}
			}
			?>
		</ul>
	</li>
	<li>
		<a href="#themen">| Thema</a>
		<ul class="aktiv f_thema">
			<?php
			if(isset($_GET['themen'])){
				$themen =$_GET['themen'];
				$thSQL = "SELECT * FROM Themen Where TID IN (".$themen.")";
				$thRes = execQuery($thSQL);
				while($row = mysql_fetch_array($thRes)){	
					print "<li class='filter-thema' data-id='".$row['TID']."'>".$row['Name']."<span class='remove'>&nbsp;</span></li>";
				}
			}
			?>
		</ul>
	</li>
</ul>
<button type="button" class="filter-button" id="remove_filter">Alle Filter entfernen</button>
<a  href="./index.php" class="filter-button" id="bto">Zurück zur Auswahl</a>
<div class="filtering">
	<section class="auswahl" id="schwerpunkt">
		
		<?php
		//get schwerpunkte from database
		$sql = "SELECT * FROM Studienschwerpunkte";
		$result = execQuery($sql);
		$html = "";
		while($row = mysql_fetch_array($result))
		  {
			
			$schwerpunkt = $row["Name"];
			$html .= "<div class='form_row'> \n";
			$html .= "\t<input id='".$schwerpunkt."' value='".$schwerpunkt."' type='checkbox' data-id='".$row['SID']."'><label for='".$schwerpunkt."'>".$schwerpunkt."</label>\n";
			$html .="</div>\n";
		  }
		print $html;
		?>
	</section>
	<section class="auswahl" id="plz">
		<img src="./img/deutschlandkarte.gif" alt="deutschlandkarte">
		<div class="plz-area" style="left: 380px; top: 335px" data-id="0">0</div>
		<div class="plz-area" style="left: 389px; top: 166px" data-id="1">1</div>
		<div class="plz-area" style="left: 210px; top: 140px" data-id="2">2</div>
		<div class="plz-area" style="left: 210px; top: 285px" data-id="3">3</div>
		<div class="plz-area" style="left: 100px; top: 245px" data-id="4">4</div>
		<div class="plz-area" style="left: 83px; top: 383px" data-id="5">5</div>
		<div class="plz-area" style="left: 155px; top: 460px" data-id="6">6</div>
		<div class="plz-area" style="left: 150px; top:550px" data-id="7">7</div>
		<div class="plz-area" style="left: 290px; top: 590px" data-id="8">8</div>
		<div class="plz-area" style="left: 275px; top: 443px" data-id="9">9</div>
	</section>
	<section class="auswahl" id="themen">
				<label>Themen: </label>	
		<select>
			<option value=""> </option>
		<?php
		//get schwerpunkte from database

		$result = mysql_query("SELECT * FROM Themen");
		$html = "";
		while($row = mysql_fetch_array($result))
		  {
			
			$thema = $row["Name"];
			$tid = $row["TID"];
			$html .= "<option data-id='".$tid."' value='".$thema."'> \n";
			$html .= "\t".$thema."\n";
			$html .="</option>\n";
		  }
			mysql_close($con);
		print $html

		?>
		</select>
	</section>
</div>
<div id="home" class="page">


	
</div>