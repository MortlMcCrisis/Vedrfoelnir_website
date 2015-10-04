<?php include 'header.php'; ?>

<h2>Erledigte Todos</h2>
</br></br>
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th class="col-md-3">Name</th>
					<th class="col-md-7">Beschreibung</th>
					<th class="col-md-2">Bearbeiten</th>
				</tr>
			</thead>
			<tbody>
				<?php
					require_once 'databaseConnector.php';
					
					$deletedTodos = getDoneTodos(0);
					
					while($todo = mysql_fetch_object($deletedTodos)){
						echo "<tr>";
						echo "<td>$todo->name</td>";
						echo "<td>$todo->description</td>";
						echo "<td>
								<button type=\"button\" class=\"btn btn-default btn-xs\" onClick=\"undo($todo->id)\">
									undo
								</button>
							  </td>";
						echo "</tr>";
					}
					?>	
			</tbody>
		</table>
	</div>
</div>

<script>
	function undo(id){
		window.location = 'action_undoTodos.php?id=' + id;
	}
</script>

<?php include 'footer.php'; ?>