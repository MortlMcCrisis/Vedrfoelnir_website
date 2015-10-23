<?php include 'header.php'; ?>

<h2>Locations</h2>
Locations wo wir spielen können.
</br></br> 
<a href="/inside/page_newLocation.php" class="btn btn-default">Neue Location</a>
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
					
					$locations = getLocations();
					
					while($row = mysql_fetch_object($locations)){
                                                echo "<tr>";
                                                    echo "<td>$row->name</td>";
                                                    echo "<td>$row->city</td>";
                                                    echo "<td>$row->contact</td>";
                                                    echo "<td>$row->comment</td>";
                                                    echo "<td>
								<div class=\"btn-group btn-group-xs\" role=\"group\">
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction($row->id, 'edit')\">
										<span class=\"glyphicon glyphicon-pencil\"></span>
									</button>
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction($row->id, 'delete')\">
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
	function doAction(id, action){
		window.location = 'action_listLocations.php?id=' + id + '&action=' + action;
	}
</script>

<?php include 'footer.php'; ?>