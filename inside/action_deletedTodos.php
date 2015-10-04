<?php

include 'databaseConnector.php';

recover($_GET['id']);
goBack();

function recover($id){
	updateTodo($id, "deleted", "0");
	
	$lowestTodo = getLowestTodo();
	updateTodo($id, "position", $lowestTodo->position+1);
}

function goBack() {
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'/page_deletedTodos.php"</script>';
}
?>