<?php
require_once 'databaseConnector.php';

if (isset($_GET['id'])){
	updateLocation($_GET['id'], 'name', $_GET['name']);
	updateLocation($_GET['id'], 'city', $_GET['city']);
	updateLocation($_GET['id'], 'contact', $_GET['contact']);
	updateLocation($_GET['id'], 'comment', $_GET['comment']);
}
else{
	addLocation($_GET['name'], $_GET['city'], $_GET['contact'], $_GET['comment']);
}

goBack();

function goBack() {
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'/page_locations.php"</script>';
}
?>p