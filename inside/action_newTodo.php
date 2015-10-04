<?php

include 'databaseConnector.php';

if (isset($_GET['id'])){
	updateTodo($_GET['id'], 'name', $_GET['name']);
	updateTodo($_GET['id'], 'description', $_GET['description']);
}
else{
	addTodo(0, $_GET['name'], $_GET['description']);
}

goBack();

function goBack() {
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'"</script>';
}
?>