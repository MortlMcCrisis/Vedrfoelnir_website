<?php include 'header.php'; ?>

<?php
require_once 'databaseConnector.php';
?>
<h2>Neue Liste</h2>
</br></br>
<div class="row">
	<div class="col-md-12">
		<form role="form" action="action_newList.php">
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>"></input>
			</div>
			<!--<div class="form-group">
				<label for="description">Beschreibung:</label>
				<textarea name="description" cols="35" rows="4" class="form-control" id="description"><?php echo $description; ?></textarea>
			</div>-->
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
	</div>
</div>

<?php include 'footer.php'; ?>