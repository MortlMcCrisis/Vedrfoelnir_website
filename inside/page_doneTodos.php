<?php include 'header.php'; ?>
<?php include 'parsedown/Parsedown.php'; ?>

<?php 
require_once 'databaseConnector.php';

$listId = $_GET['listId'];

$listEntry = getListById($listId);
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
                <li role="presentation"><a href="http://xn--vedrflnir-47a.de/inside?listId=<?php echo $listId; ?>">List</a></li>
                <li role="presentation" class="active"><a href="http://xn--vedrflnir-47a.de/inside/page_doneTodos.php?listId=<?php echo $listId; ?>">Done</a></li>
                <li role="presentation"><a href="http://xn--vedrflnir-47a.de/inside/page_deletedTodos.php?listId=<?php echo $listId; ?>">Deleted</a></li>
            </ul>
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
					$deletedTodos = getDoneTodos($listId);
                                        $Parsedown = new Parsedown();
					
					while($todo = mysql_fetch_object($deletedTodos)){
						echo "<tr>";
						echo "<td>$todo->name</td>";
						echo "<td>".$Parsedown->text($todo->description)."</td>";
						echo "<td>
								<button type=\"button\" class=\"btn btn-default btn-xs\" onClick=\"undo($listId, $todo->id)\">
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
	function undo(listId, id){
		window.location = 'action_undoTodos.php?listId=' + listId +'&id=' + id;
	}
</script>

<?php include 'footer.php'; ?>