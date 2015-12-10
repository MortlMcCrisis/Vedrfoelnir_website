<?php
require_once 'databaseConnector.php';

$id = $_GET['id'];
$listId = $_GET['listId'];

recover($listId, $id);
goBack($listId);

function recover($listId, $id){
	updateTodo($id, "done", "0");
        updateTodo($id, "last_changed", time());
	
	$lowestTodo = getLowestTodo($listId);
	updateTodo($id, "position", $lowestTodo->position+1);
}

function goBack($listId) {
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'/page_listTodos.php?show=done&listId='.$listId.'"</script>';
}
?>