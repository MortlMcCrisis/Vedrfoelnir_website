<?php

require_once 'databaseConnector.php';

switch ($_GET['action']) {
	case 'up':
		up($_GET['id']);
		break;
	case 'down':
		down($_GET['id']);
		break;
	case 'delete':
		delete($_GET['id']);
		break;
	case 'done':
		done($_GET['id']);
		break;
	case 'edit':
		edit($_GET['id']);
		break;
}
		
goBack();

function up($id) {
	$lowerTodo = getTodoById($id);
	
	if($lowerTodo->position > 1){
		$upperTodo = getTodoByPosition(0, $lowerTodo->position - 1);
		
		updateTodo($upperTodo->id, "position", $upperTodo->position + 1);
		updateTodo($lowerTodo->id, "position", $lowerTodo->position - 1);
	}
}

function down($id) {
	$upperTodo = getTodoById($id);
	$lowestTodo = getLowestTodo(0);
	
	if($upperTodo->position < $lowestTodo->position){
		$lowerTodo = getTodoByPosition(0, $upperTodo->position+1);
		
		updateTodo($upperTodo->id, "position", $upperTodo->position + 1);
		updateTodo($lowerTodo->id, "position", $lowerTodo->position - 1);	
	}
}

function edit($id) {
	goToEdit($id);
}

function done($id){
	$deletedTodo = getTodoById($id);
	updateTodo($id, "done", "1");
	updateTodo($id, "position", "-1");
	
	$allTodos = getAllTodosAbovePosition($deletedTodo->position);
	while($todo = mysql_fetch_object($allTodos)){
		updateTodo($todo->id, "position", ($todo->position-1));
	}
}

function delete($id){
	$deletedTodo = getTodoById($id);
	updateTodo($id, "deleted", "1");
	updateTodo($id, "position", "-1");
	
	$allTodos = getAllTodosAbovePosition($deletedTodo->position);
	while($todo = mysql_fetch_object($allTodos)){
		updateTodo($todo->id, "position", ($todo->position-1));
	}
}


function goToEdit($id){
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'/page_newTodo.php?id='.$id.'"</script>';
}

function goBack() {
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.'"</script>';
}
?>