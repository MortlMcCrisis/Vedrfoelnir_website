<?php
require_once 'databaseConnector.php';

$listId = $_GET['listId'];
$id = $_GET['id'];

switch ($_GET['action']) {
	case 'up':
		up($listId, $id);
		break;
	case 'down':
		down($listId, $id);
		break;
	case 'delete':
		delete($listId, $id);
		break;
	case 'done':
		done($listId, $id);
		break;
	case 'edit':
		edit($listId, $id);
		break;
}
		
goBack($listId);

function up($listId, $id) {
	$lowerTodo = getTodoById($id);
	
	if($lowerTodo->position > 1){
		$upperTodo = getTodoByPosition($listId, $lowerTodo->position - 1);
		
		updateTodo($upperTodo->id, "position", $upperTodo->position + 1);
		updateTodo($lowerTodo->id, "position", $lowerTodo->position - 1);
	}
}

function down($listId, $id) {
	$upperTodo = getTodoById($id);
	$lowestTodo = getLowestTodo($listId);
	
	if($upperTodo->position < $lowestTodo->position){
		$lowerTodo = getTodoByPosition($listId, $upperTodo->position+1);
		
		updateTodo($upperTodo->id, "position", $upperTodo->position + 1);
		updateTodo($lowerTodo->id, "position", $lowerTodo->position - 1);	
	}
}

function edit($listId, $id) {
	goToEdit($listId, $id);
}

function done($listId, $id){
	$deletedTodo = getTodoById($id);
	updateTodo($id, "done", "1");
	updateTodo($id, "position", "-1");
	
	$allTodos = getAllTodosAbovePosition($listId, $deletedTodo->position);
	while($todo = mysql_fetch_object($allTodos)){
		updateTodo($todo->id, "position", ($todo->position-1));
		updateTodo($todo->id, "last_changed", time());
	}
}

function delete($listId, $id){
	$deletedTodo = getTodoById($id);
	updateTodo($id, "deleted", "1");
	updateTodo($id, "position", "-1");
	
	$allTodos = getAllTodosAbovePosition($listId, $deletedTodo->position);
	while($todo = mysql_fetch_object($allTodos)){
		updateTodo($todo->id, "position", ($todo->position-1));
                updateTodo($todo->id, "last_changed", time());
	}
}


function goToEdit($listId, $id){
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'/page_newTodo.php?listId='.$listId.'&id='.$id.'"</script>';
}

function goBack($listId) {
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'/page_listTodos.php?listId='.$listId.'"</script>';
}
?>