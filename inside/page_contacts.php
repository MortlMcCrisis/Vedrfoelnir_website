<?php include 'header.php'; ?>

<?php 
require_once 'databaseConnector.php';

$listId = 1;
if (isset($_GET['listId'])){
	$listId = $_GET['listId'];
}

$listEntry = getContactListById($listId);
?>

<h2><?php echo $listEntry->name; ?></h2>
</br></br> 
<a href="/inside/page_newContact.php?listId=<?php echo $listId ?>" class="btn btn-default">Neuer Kontakt</a>
</br></br>
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th class="col-md-2">Name</th>
					<th class="col-md-2">Ort</th>
					<th class="col-md-3">Kontakt</th>
					<th class="col-md-4">Kommentar</th>
					<th class="col-md-2">Bearbeiten</th>
				</tr>
			</thead>
			<tbody>
				<?php
					require_once 'databaseConnector.php';
					
					$contacts = getContacts($listId);
					
					while($row = mysql_fetch_object($contacts)){
                                                echo "<tr>";
                                                    echo "<td>$row->name</td>";
                                                    echo "<td>$row->city</td>";
                                                    echo "<td>$row->contact</td>";
                                                    echo "<td>$row->comment</td>";
                                                    echo "<td>
								<div class=\"btn-group btn-group-xs\" role=\"group\">
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction($listId, $row->id, 'edit')\">
										<span class=\"glyphicon glyphicon-pencil\"></span>
									</button>
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction($listId, $row->id, 'delete')\">
										<span class=\"glyphicon glyphicon-trash\"></span>
									</button>
								</div>
							  </td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<script>
	function doAction(listId, id, action){
		window.location = 'action_listContacts.php?listId=' + listId + '&id=' + id + '&action=' + action;
	}
</script>

<?php include 'footer.php'; ?>