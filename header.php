<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="utf-8">
		<link rel="stylesheet" href="./css/blue.css" type="text/css" media="screen" title="no title" charset="utf-8">
<!--		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script> -->
		<script src="./js/jquery.min.js"></script>
		<script src="./js/jquery-ui.min.js"></script>
		<script src="./js/jquery.tablesorter.js"></script>
		<script src="./js/functions.js"></script>
		
		<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
		<title>Firmendatenbank Hochschule Ravensburg-Weingarten</title>
	</head>
	<body>
		<header>
		<a href="./index.php">	<img id="logo" src="./img/logo_welle_de.png" alt="hs-logo"></a>
			<h1 class="heading">Firmendatenbank Hochschule Ravensburg Weingarten</h1>
			</header>
			
			
	<!-- Banner Programm-->
			<div id="advertise">

		<?php
		
			include_once('functions.php');
			//um sicherzugehen das mindestens ein banner geladen wird
			$html = getBanner(); 
			print $html;
		?>
			</div>