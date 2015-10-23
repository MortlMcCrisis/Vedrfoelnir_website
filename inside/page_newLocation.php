<?php include 'header.php'; ?>

<?php
require_once 'databaseConnector.php';

$idParam = "";
$name = "";
$city = "";
$contact = "";
$comment = "";

if (isset($_GET['id'])) {
	
	$id = $_GET['id'];

	$idParam = '<input type="hidden" name="id" value="'.$id.'">';

	$location = getLocationById($id);

	$name = $location->name;
	$city = $location->city;
	$contact = $location->contact;
	$comment = $location->comment;
}
?>
<h2>Neue Location</h2>
</br></br>
<div class="row">
	<div class="col-md-12">
		<form role="form" action="action_newLocation.php">
			<?php echo $idParam; ?>
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>"></input>
			</div>
			<div class="form-group">
				<label for="city">Ort:</label>
				<input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>"></input>
			</div>
			<div class="form-group">
				<label for="contact">Kontakt:</label>
				<textarea name="contact" cols="35" rows="4" class="form-control" id="contact"><?php echo $contact; ?></textarea>
			</div>
			<div class="form-group">
				<label for="comment">Kommentar:</label>
				<textarea name="comment" cols="35" rows="4" class="form-control" id="comment"><?php echo $comment; ?></textarea>
			</div>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
	</div>
</div>

<?php include 'footer.php'; ?>