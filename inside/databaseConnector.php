<?php
function addTodo($name, $description){
	$newPosition = getLowestTodo()->position+1;
			
	$sqlInsert = "INSERT INTO todos (id, position, name, description) VALUES (NULL, '".$newPosition."', '".$name."', '".$description."');";
	executeSql($sqlInsert);
}

function getTodoById($id){
	$sqlFetch = "SELECT * FROM todos WHERE id=".$id;
	return mysql_fetch_object(executeSql($sqlFetch));
}

function getLowestTodo(){
	$sqlFetch = 'SELECT * FROM todos ORDER BY position DESC LIMIT 1';
	return mysql_fetch_object(executeSql($sqlFetch));
}

function getDoneTodos(){
	$sqlFetch = 'SELECT * FROM todos WHERE done=1';
	return executeSql($sqlFetch);
}

function getDeletedTodos(){
	$sqlFetch = 'SELECT * FROM todos WHERE deleted=1';
	return executeSql($sqlFetch);
}

function getOpenTodos($listId){
	$sqlFetch = 'SELECT * FROM todos WHERE listId='.$listId.' AND deleted=0 AND done=0 ORDER BY position ASC LIMIT 100';
	return executeSql($sqlFetch);
}

function getAllTodosAbovePosition($position){
	$sqlFetch = 'SELECT * FROM todos WHERE position>'.$position;
	return executeSql($sqlFetch);
}

function updateTodo($id, $attribute, $value){
	$sqlUpdate = "UPDATE todos SET ".$attribute."='".$value."' WHERE id=".$id;
	echo $sqlUpdate;
	executeSql($sqlUpdate);
}

function executeSql($sql){
	
	include 'databaseSettings.php';
	
	# Verbindungsaufbau
	if(mysql_connect($db_server, $db_benutzer, $db_passwort)) {
		if(mysql_select_db($db_name)) {
			return mysql_query($sql);
		}
		else {
			echo 'Database not found.';
		}
	}
	else {
		echo 'Could not connect to database server.';
	}
}
?>