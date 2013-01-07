
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
<button type="button" id="firmen">Show results</button>
<button type="button" id="firmen_filter">Show filtered</button>
<table id="firmen_tab" class="results striped">


</table>
</div>
</div>
<?php
//footer contents for all pages
include_once('footer.php');
?>
