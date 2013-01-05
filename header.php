<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
		<script src="./js/behaviour.js"></script>
		<script src="./js/functions.js"></script>
		<title>Firmendatenbank Hochschule Ravensburg-Weingarten</title>
	<script>
	
	var source=new EventSource("banner_rotation.php");
	source.onmessage=function(event)
	  {
	  	$('#advertise').append(event.data + "<br>");
	  };
	</script>
	</head>
	<body>
		<header>
		<a href="./index.php">	<img id="logo" src="./img/logo_welle_de.png" alt="hs-logo"></a>
			<h1 class="heading">Firmendatenbank Hochschule Ravensburg Weingarten</h1>
			</header>
			
			
	<!--TODO: Banner Programm -->
			<div id="advertise">

			</div>