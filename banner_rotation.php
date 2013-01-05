<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
include('functions.php');


	$sql = "Select FID from Firma";
	
	$randomCID;
	
$time = date('r');
echo "data: The server time is: {$time}\n\n";
flush();
sleep(55);
?>