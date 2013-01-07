<?php
	header('Content-Type: text/event-stream');
	header('Cache-Control: no-cache');
include('functions.php');
	
	$html = getBanner();
	echo "data:	".$html;		
	flush();
	sleep(20);

?>