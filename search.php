<p class="info">
	Bitte wählen Sie die Suchkriterien aus.
</p>
<ul id="tabs">
	<li>
		<a href="#schwerpunkt">Schwerpunkt</a>
		<ul class="aktiv f_sw"></ul>
	</li>
	<li>
		<a href="#plz">| PLZ </a>
		<ul class="aktiv f_plz"></ul>
	</li>
	<li>
		<a href="#themen">| Thema</a>
		<ul class="aktiv f_thema">
		</ul>
	</li>
</ul>
<button type="button" id="remove_filter">Alle Filter entfernen</button>

	<section class="auswahl" id="schwerpunkt">
		
		<?php
		//get schwerpunkte from database

		$result = mysql_query("SELECT * FROM Studienschwerpunkte");
		$html = "";
		while($row = mysql_fetch_array($result))
		  {
			
			$schwerpunkt = $row["Name"];
			$html .= "<div class='form_row'> \n";
			$html .= "\t<input id='".$schwerpunkt."' value='".$schwerpunkt."' type='checkbox' data-id='".$row['SID']."'><label for='".$schwerpunkt."'>".$schwerpunkt."</label>\n";
			$html .="</div>\n";
		  }
		print $html

		?>
	</section>
	<section class="auswahl" id="plz">
		<img src="./img/deutschlandkarte.gif" alt="deutschlandkarte">
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
		print $html

		?>
		</select>
	</section>
<div id="home" class="page">


	
</div>