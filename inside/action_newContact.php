<?php
require_once 'databaseConnector.php';

$listId = $_GET['listId'];

if (isset($_GET['id'])){
	updateContact($_GET['id'], 'name', $_GET['name']);
	updateContact($_GET['id'], 'city', $_GET['city']);
	updateContact($_GET['id'], 'contact', $_GET['contact']);
	updateContact($_GET['id'], 'comment', $_GET['comment']);
}
else{
	addContact($listId, $_GET['name'], $_GET['city'], $_GET['contact'], $_GET['comment']);
}

goBack($listId);

function goBack($listId) {
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'/page_contacts.php?listId='.$listId.'"</script>';
}
?>