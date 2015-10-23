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
		
goBack($listId);

function edit($listId, $id) {
	goToEdit($listId, $id);
}

function delete($listId, $id){
	$deletedTodo = getTodoById($id);
	updateTodo($id, "deleted", "1");
	updateTodo($id, "position", "-1");
	
	$allTodos = getAllTodosAbovePosition($listId, $deletedTodo->position);
	while($todo = mysql_fetch_object($allTodos)){
		updateTodo($todo->id, "position", ($todo->position-1));
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
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'?listId='.$listId.'"</script>';
}
?>