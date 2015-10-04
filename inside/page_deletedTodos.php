<?php include 'header.php'; ?>

<h2>Gelöschte Todos</h2>
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
					include 'databaseConnector.php';
					
					$deletedTodos = getDeletedTodos(0);
					
					while($todo = mysql_fetch_object($deletedTodos)){
						echo "<tr>";
						echo "<td>$todo->name</td>";
						echo "<td>$todo->description</td>";
						echo "<td>
								<button type=\"button\" class=\"btn btn-default btn-xs\" onClick=\"recover($todo->id)\">
									recover
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
	function recover(id){
		window.location = 'action_deletedTodos.php?id=' + id;
	}
</script>

<?php include 'footer.php'; ?>