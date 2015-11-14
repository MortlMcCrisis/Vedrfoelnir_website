<?php include 'header.php'; ?>
<?php include 'parsedown/Parsedown.php'; ?>

<?php 
require_once 'databaseConnector.php';

$listId = 1;
if (isset($_GET['listId'])){
	$listId = $_GET['listId'];
}

$listEntry = getListById($listId);

$todoCount = getTodoCount($listId);
$doneTodoCount = getDoneTodoCount($listId);
$percent = ($doneTodoCount / ($doneTodoCount + $todoCount)) * 100;
?>

<div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <?php   
                        $lists = getLists();
                        
                        while($row = mysql_fetch_object($lists)){
                        
                            $todoCount = getTodoCount($row->id);
                            $doneTodoCount = getDoneTodoCount($row->id);
                            $percent = ($doneTodoCount / ($doneTodoCount + $todoCount)) * 100;
                            
                            $active = "";
                            if($row->id == $listId)
                                $active = "active";

                            echo "<a href=\"http://xn--vedrflnir-47a.de/inside?listId=".$row->id."\" class=\"list-group-item ".$active."\">
                                    <h4 class=\"list-group-item-heading\">".$row->name." <span class=\"badge\">".getTodoCount($row->id)."</span></h4>
                                    <!--<p class=\"list-group-item-text\">...</p>-->
                                    <div class=\"progress\">
                                        <div class=\"progress-bar progress-bar-striped active\" role=\"progressbar\" aria-valuenow=\"".$percent."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".$percent."%\">
                                            <span class=\"sr-only\">45% Complete</span>
                                        </div>
                                    </div>
                                    </a>";
                        }
                ?>
            </div>
        </div>
	<div class="col-md-9">
            <?php 
                $Parsedown = new Parsedown();
                echo $Parsedown->text($listEntry->description);
            ?>
            </br> 
            <a href="/inside/page_newTodo.php?listId=<?php echo $listId ?>" class="btn btn-default">Neues Todo</a>
            </br></br>
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="http://xn--vedrflnir-47a.de/inside?listId=<?php echo $listId; ?>">List</a></li>
                <li role="presentation"><a href="http://xn--vedrflnir-47a.de/inside/page_doneTodos.php?listId=<?php echo $listId; ?>">Done</a></li>
                <li role="presentation"><a href="http://xn--vedrflnir-47a.de/inside/page_deletedTodos.php?listId=<?php echo $listId; ?>">Deleted</a></li>
            </ul>
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
					
					$todos = getOpenTodos($listId);
                                        $Parsedown = new Parsedown();
                                        
					while($row = mysql_fetch_object($todos)){
						echo "<tr>";
						echo "<td>$row->position</td>";
						echo "<td>$row->name</td>";
						echo "<td>".$Parsedown->text($row->description)."</td>";
						echo "<td>
								<div class=\"btn-group btn-group-xs\" role=\"group\">
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction($listId, $row->id, 'up')\">
										<span class=\"glyphicon glyphicon-arrow-up\"></span>
									</button>
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction($listId, $row->id, 'down')\">
										<span class=\"glyphicon glyphicon-arrow-down\"></span>
									</button>
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction($listId, $row->id, 'edit')\">
										<span class=\"glyphicon glyphicon-pencil\"></span>
									</button>
									<button type=\"button\" class=\"btn btn-default\" onClick=\"doAction($listId, $row->id, 'done')\">
										<span class=\"glyphicon glyphicon-ok\"></span>
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
		window.location = 'action_listTodos.php?listId=' + listId + '&id=' + id + '&action=' + action;
	}
</script>

<?php include 'footer.php'; ?>