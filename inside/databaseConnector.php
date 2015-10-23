<?php
//---------------------LOCATIONS---------------------
function addLocation($name, $city, $contact, $comment){
    $sqlInsert = "INSERT INTO locations (id, name,city, contact, comment) VALUES (NULL, '".$name."', '".$city."', '".$contact."', '".$comment."');";
    executeSql($sqlInsert);
    
    logMessage("Added location: (name='".$name."' city='".$city."' contact=".$contact.")");
}

function getLocationById($id){
    $sqlFetch = 'SELECT * FROM locations WHERE id='.$id;
    return mysql_fetch_object(executeSql($sqlFetch));
}

function getLocations(){
    $sqlFetch = 'SELECT * FROM locations WHERE deleted=0';
    return executeSql($sqlFetch);
}

function updateLocation($id, $attribute, $value){

    $sqlUpdate = "UPDATE locations SET ".$attribute."='".$value."' WHERE id=".$id;
    executeSql($sqlUpdate);
    
    logMessage("Updated location: (id='".$id."' attribute='".$attribute."' value=".$value.")");
}
//-----------------END LOCATIONS---------------------


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
	$newPosition = getLowestTodo($listId)->position+1;
			
	$sqlInsert = "INSERT INTO todos (id, position, name, description, listId) VALUES (NULL, '".$newPosition."', '".$name."', '".$description."', '".$listId."');";
	executeSql($sqlInsert);
	
	logMessage("Added todo: (listId='".$listId."' name='".$name."' description=".$description.")");
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
	$sqlFetch = 'SELECT * FROM todos WHERE listId='.$listId.' ORDER BY position DESC LIMIT 100';
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
	$sqlFetch = 'SELECT * FROM todos WHERE listId='.$listId.' AND position>'.$position;
	return executeSql($sqlFetch);
}

function updateTodo($id, $attribute, $value){
	$todo = getTodoById($id);
	
	logMessage("Updated todo: (id='".$todo->id."' listId='".$todo->listId."' name='".$todo->name."' description='".$todo->description."') -> (".$attribute."='".$value."')");
	
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

//should be a member variable anyway
function logMessage($message){
        include_once('log4php/Logger.php');
	Logger::configure('config.xml');
	$logger = Logger::getLogger("main");
	$logger->info($message);
}
?>