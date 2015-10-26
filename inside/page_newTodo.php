<?php include 'header.php'; ?>

<?php
require_once 'databaseConnector.php';

$listId = $_GET['listId'];
$idParam = "";
$name = "";
$description = "";

if (isset($_GET['id'])) {
	
	$id = $_GET['id'];
	
	$idParam = '<input type="hidden" name="id" value="'.$id.'">';
	
	$todo = getTodoById($id);
	
	$name = $todo->name;
	$description = $todo->description;
}
?>
<h2>Neues Todo</h2>
</br></br>
<div class="row">
	<div class="col-md-12">
		<form role="form" action="action_newTodo.php">
                        <input type="hidden" name="listId" value="<?php echo $listId; ?>">
			<?php echo $idParam; ?>
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>"></input>
			</div>
			<div class="form-group">
				<label for="description">Beschreibung:</label>
				<textarea name="description" cols="35" rows="4" class="form-control" id="description"><?php echo $description; ?></textarea>
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
	</div>
</div>

<?php include 'footer.php'; ?>