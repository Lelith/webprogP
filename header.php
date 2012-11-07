<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="utf-8">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
		<script src="./js/behaviour.js"></script>
		<title>Firmendatenbank Hochschule Ravensburg-Weingarten</title>
	
	</head>
	<body>
		<header>
			<img id="logo" src="./img/logo_welle_de.png" alt="hs-logo">
			<h1 class="heading">Firmendatenbank Hochschule Ravensburg Weingarten</h1>
			</header>
			
			
	<!--TODO: Banner Programm -->
			<div id="advertise">
				<img src="./banner/technics1.jpg" alt="banner 1">
				<img src="./banner/technics2.jpg" alt="banner 2">
				<img src="./banner/technics4.jpg" alt="banner 4">
				<img src="./banner/technics6.jpg" alt="banner 6">
			</div>
			
<?php
//db connect once
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
	mysql_select_db("hs", $con)	

?>