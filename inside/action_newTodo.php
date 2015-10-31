<?php
require_once 'databaseConnector.php';

$listId = $_GET['listId'];

if (isset($_GET['id'])){
        updateTodo($_GET['id'], 'listId', $_GET['listId']);
	updateTodo($_GET['id'], 'name', $_GET['name']);
	updateTodo($_GET['id'], 'description', $_GET['description']);
}
else{
	addTodo($listId, $_GET['name'], $_GET['description']);
}

goBack($listId);

function goBack($listId) {
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'?listId='.$listId.'"</script>';
}
?>