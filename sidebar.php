<div id="right">
	<script type="text/javascript">
		$(function() {
			SyntaxHighlighter.all();
		});
		$(window).load(function() {
			$('.flexslider').flexslider({
				animation : "slide",
				start : function(slider) {
					$('body').removeClass('loading');
				},
				randomize : true,
				controlsContainer : ".flexslider",
				autoResize : true
			});
		});
	</script>
		
	<!-- 
		Add modal which opens by clicking on an image. 
		It contains another flexslider which has to be 
		synchronized with this slider. 	Alternatively switch 
		to another slider which contains this functionality
		out of the box
	-->
	<div class="flexslider">
		<ul class="slides">
			<li><img src="flexslider/images/slide1.png" alt="slide pic"/></li>
			<li><img src="flexslider/images/slide2.png"  alt="slide pic"/></li>
			<li><img src="flexslider/images/slide3.png"  alt="slide pic"/></li>
			<li><img src="flexslider/images/slide4.png"  alt="slide pic"/></li>
			<li><img src="flexslider/images/slide5.png"  alt="slide pic"/></li>
			<li><img src="flexslider/images/slide6.png"  alt="slide pic"/></li>
			<li><img src="flexslider/images/slide7.png"  alt="slide pic"/></li>
			<li><img src="flexslider/images/slide8.png"  alt="slide pic"/></li>
			<li><img src="flexslider/images/slide9.png"  alt="slide pic"/></li>
			<li><img src="flexslider/images/slide10.png"  alt="slide pic"/></li>
			<li><img src="flexslider/images/slide11.png"  alt="slide pic"/></li>
		</ul>
	</div>
	<div class="concert">Upcoming shows:</div>
	<?php
		include 'databaseSettings.php';
	
		# Verbindungsaufbau
		if(mysql_connect($db_server, $db_benutzer, $db_passwort)) {
			if(mysql_select_db($db_name)) {
				$abfrage = "SELECT date, event, location, city FROM gigs WHERE date > NOW() ORDER BY date DESC";
				$ergebnis = mysql_query($abfrage);
				if(mysql_num_rows($ergebnis) > 0){
					while($row = mysql_fetch_object($ergebnis)){
						$timestamp = strtotime($row->date);
						$formatted_time = date( "d.m.Y", $timestamp);
						$timestamp = strtotime($row->date);
						$formatted_time = date( "D, d.m.Y", $timestamp);
						echo "<div class=\"gig\">$formatted_time<br>$row->event<br>$row->location, $row->city</div>";
					}
				}
				else{
					echo "<div class=\"gig\">none</div>";
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
	<div class="concert">Last concert:</div>
	<?php
		include 'databaseSettings.php';
	
		# Verbindungsaufbau
		if(mysql_connect($db_server, $db_benutzer, $db_passwort)) {
			if(mysql_select_db($db_name)) {
				$abfrage = "SELECT date, event, location, city FROM gigs WHERE date < NOW() ORDER BY date DESC LIMIT 1";
				$ergebnis = mysql_query($abfrage);
				$row = mysql_fetch_object($ergebnis);
				$timestamp = strtotime($row->date);
				$formatted_time = date( "D, d.m.Y", $timestamp);
				echo "<div class=\"gig\">$formatted_time<br/>$row->event<br/>$row->location, $row->city</div>";
			}
			else {
				echo 'Stay tuned. Bald kommen hier die neusten Infos.';
			}
		}
		else {
			echo 'Stay tuned. Bald kommen hier die neusten Infos.';
		}
	?>
	<div id="newsletter">
		<a href="http://web.inxmail.com/JanMortensen/anmeldung.jsp" id="newsletter-font">Newsletter bestellen</a>
	</div>
</div>
