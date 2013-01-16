
<?php
//Header informations for all pages
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

<h2>
	Die Firmen
</h2>
<table id="firmen_tab" class="tablesorter results">
	<thead>
		<tr>
			<th>Name</th>
			<th>PLZ</th>
			<th>Schwerpunkte</th>
			<th>Themen</th>
			<th>Bewertung</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
	
</table>
</div>
</div>
<?php
//footer contents for all pages
include_once('footer.php');
?>
