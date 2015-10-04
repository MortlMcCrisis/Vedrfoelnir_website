<?php include 'header.php'; ?>

<h2>Offene technische Todos</h2>
</br></br>
<a href="/inside/page_newTodo.php" class="btn btn-default">Neues Todo</a>
</br></br>
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th class="col-md-1">Position</th>
					<th class="col-md-3">Name</th>
					<th class="col-md-6">Beschreibung</th>
					<th class="col-md-2">Bearbeiten</th>
				</tr>
			</thead>
			<tbody>
				<?php
					require_once 'databaseConnector.php';
					
					$todos = getOpenTodos(1);
					
					while($row = mysql_fetch_object($todos)){
						echo "<tr>";
						echo "<td>$row->position</td>";
						echo "<td>$row->name</td>";
						echo "<td>$row->description</td>";
						echo "<td>
								<div class=\"btn-group btn-group-xs\" role=\"group\">
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction('up', $row->id)\">
										<span class=\"glyphicon glyphicon-arrow-up\"></span>
									</button>
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction('down', $row->id)\">
										<span class=\"glyphicon glyphicon-arrow-down\"></span>
									</button>
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction('edit', $row->id)\">
										<span class=\"glyphicon glyphicon-pencil\"></span>
									</button>
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction('done', $row->id)\">
										<span class=\"glyphicon glyphicon-ok\"></span>
									</button>
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction('delete', $row->id)\">
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
	function doAction(action, id){
		window.location = 'action_listTodos.php?action=' + action + '&id=' + id;
	}
</script>

<?php include 'footer.php'; ?>