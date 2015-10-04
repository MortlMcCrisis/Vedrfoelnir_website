<?php

//---------------------LISTS---------------------
function getListById($listId){
	$sqlFetch = "SELECT * FROM todo_lists WHERE id=".$listId;
	return mysql_fetch_object(executeSql($sqlFetch));
}

function getLists(){
	$sqlFetch = "SELECT * FROM todo_lists";
	return executeSql($sqlFetch);
}

//-----------------END LISTS---------------------


//---------------------TODOS---------------------

function addTodo($listId, $name, $description){
	$newPosition = getLowestTodo()->position+1;
			
	$sqlInsert = "INSERT INTO todos (id, position, name, description, listId) VALUES (NULL, '".$newPosition."', '".$name."', '".$description."', '".$listId."');";
	echo $sqlInsert;
	executeSql($sqlInsert);
}

function getTodoById($id){
	$sqlFetch = "SELECT * FROM todos WHERE id=".$id;
	return mysql_fetch_object(executeSql($sqlFetch));
}

function getTodoByPosition($listId, $position){
	$sqlFetch = "SELECT * FROM todos WHERE listId=".$listId." AND position=".$position;
	return mysql_fetch_object(executeSql($sqlFetch));
}

function getLowestTodo($listId){
	$sqlFetch = 'SELECT * FROM todos WHERE listId='.$listId.' ORDER BY position DESC LIMIT 1';
	return mysql_fetch_object(executeSql($sqlFetch));
}

function getDoneTodos($listId){
	$sqlFetch = 'SELECT * FROM todos WHERE done=1 AND listId='.$listId;
	return executeSql($sqlFetch);
}

function getDeletedTodos($listId){
	$sqlFetch = 'SELECT * FROM todos WHERE deleted=1 AND listId='.$listId;
	return executeSql($sqlFetch);
}

function getOpenTodos($listId){
	$sqlFetch = 'SELECT * FROM todos WHERE listId='.$listId.' AND deleted=0 AND done=0 ORDER BY position ASC LIMIT 100';
	return executeSql($sqlFetch);
}

function getAllTodosAbovePosition($listId, $position){
	$sqlFetch = 'SELECT * FROM todos WHERE listId='.$listId.' position>'.$position;
	return executeSql($sqlFetch);
}

function updateTodo($id, $attribute, $value){
	$sqlUpdate = "UPDATE todos SET ".$attribute."='".$value."' WHERE id=".$id;
	echo $sqlUpdate;
	executeSql($sqlUpdate);
}

//-----------------END TODOS---------------------

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