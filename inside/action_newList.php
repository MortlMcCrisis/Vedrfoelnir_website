<?php
require_once 'databaseConnector.php';

addList($_GET['name']);

goBack();

function goBack() {
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'"</script>';
}
?>