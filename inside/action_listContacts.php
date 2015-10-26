<?php
require_once 'databaseConnector.php';

$listId = $_GET['listId'];
$id = $_GET['id'];

switch ($_GET['action']) {
	case 'delete':
		delete($id);
		break;
	case 'edit':
		edit($listId, $id);
		break;
}
		
goToPage("/page_contacts.php?listId=".$listId);

function edit($listId, $id) {
	goToPage("/page_newContact.php?listId=".$listId."&id=".$id);
}

function delete($id){
	updateContact($id, "deleted", "1");
}

//sollte eine globale Methode sein
function goToPage($page){
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	
	echo '<script type="text/javascript">window.location = "http://'.$host.$uri.$page.'"</script>';
}
?>