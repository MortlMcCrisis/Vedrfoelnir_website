<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!--[if IE]><![endif]-->
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<title>Vedrfölnir - Extreme Folk Metal</title>
		
		<link href='http://fonts.googleapis.com/css?family=Caesar+Dressing|Open+Sans' rel='stylesheet' type='text/css' />

		<link rel="alternate" type="application/rss+xml" title="RSS" href="http://www.vedrfoelnir.de/rss.xml" />		

		<link rel="stylesheet" href="style.css" type="text/css" charset="utf-8" />
		
		<!-- Boilerplate -->
        	<link rel="stylesheet" href="css/normalize.css">
        	<link rel="stylesheet" href="css/main.css">
		
		<!-- Flexslider -->
		<link rel="stylesheet" href="flexslider/flexslider.css" type="text/css" />
		<script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
		<script src="flexslider/jquery.flexslider-min.js" type="text/javascript"></script>
		
		<!--div class="g-ytsubscribe" data-channel="VedrfoelnirOfficial"></div-->
		<!-- tweet anzahl anzeige -->
	</head>
	<!--script type="text/javascript" src="https://apis.google.com/js/platform.js"></script-->
	<body>
		<div id="page">
			<div id="logo"></div>
			<div id="container">
				<?php require('pageHeader.php'); ?>
				<div id="content">
					<div id="left">
						<h2>Live</h2>
						<div id="concert">Upcoming shows:</div>
						<div class="maingig">none</div>
						<div id="concert">Past concerts:</div>
						<div class="maingig">
											<table>
								<?php
									include 'databaseSettings.php';
	
									# Verbindungsaufbau
									if(mysql_connect($db_server, $db_benutzer, $db_passwort)) {
										if(mysql_select_db($db_name)) {
											$abfrage = "SELECT date, event, location, city FROM gigs ORDER BY date DESC";
											$ergebnis = mysql_query($abfrage);
											while($row = mysql_fetch_object($ergebnis)){
												$timestamp = strtotime($row->date);
												$formatted_time = date( "d.m.Y", $timestamp);
												echo "<tr><td>$formatted_time</td><td>$row->event, $row->location</td><td class=\"right\">$row->city</td></tr>";
											}
										}
										else {
											echo 'Stay tuned. Bald kommen hier die neusten Infos.';

										}
									}
									else {
										echo 'Stay tuned. Bald kommen hier die neusten Infos.';
									}
								?>
							</table>
						</div>
					</div>
					<?php require('sidebar.php'); ?>
					<div class="clear"></div>
				</div>
				<?php require('footer.php'); ?>
			</div>
		</div>
	</body>
</html>

