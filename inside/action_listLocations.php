<?php
require_once 'databaseConnector.php';

$id = $_GET['id'];

switch ($_GET['action']) {
	case 'delete':
		delete($id);
		break;
	case 'edit':
		edit($id);
		break;
}
		
goToPage("/page_locations.php");

function edit($id) {
	goToPage("/page_newLocation.php?id=".$id);
}

function delete($id){
	updateLocation($id, "deleted", "1");
}

//sollte eine globale Methode sein
function goToPage($page){
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.$page.'"</script>';
}
?>