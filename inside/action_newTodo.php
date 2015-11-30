<?php
require_once 'databaseConnector.php';

$id = $_GET['id'];
$listId = $_GET['listId'];

if (isset($_GET['id'])){
        $oldTodo = getTodoById($id);
        $lowestTodo = getLowestTodo($listId);

        updateTodo($id, 'listId', $_GET['listId']);
	updateTodo($id, 'name', $_GET['name']);
	updateTodo($id, 'description', $_GET['description']);
        updateTodo($id, 'position', ($lowestTodo->position + 1));
	
	echo $oldTodo->listId." ".$oldTodo->position." ";
	
	$todos = getAllTodosAbovePosition($oldTodo->listId, $oldTodo->position);
        while($row = mysql_fetch_object($todos)){
            echo $row->position;
            updateTodo($row->id, 'position', ($row->position - 1));
        }
}
else{
	addTodo($listId, $_GET['name'], $_GET['description']);
}

goBack($listId);

function goBack($listId) {
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'/page_listTodos.php?listId='.$listId.'"</script>';
}
?>