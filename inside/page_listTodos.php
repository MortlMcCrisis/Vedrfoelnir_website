<?php
    require_once 'header.php'; 

    $show = (isset($_GET['show']) ? $_GET['show'] : "list");
    $listId = (isset($_GET['listId']) ? $_GET['listId'] : 1);
    $listEntry = getListById($listId);
?>

<div class="row">
        <div class="col-md-3">
            <a href="http://xn--vedrflnir-47a.de/inside/page_newList.php" class="btn btn-default">Neue Liste</a>
            <br>
            <br>
            <div class="list-group">
                <?php   
                        $lists = getLists();
                        
                        while($row = mysql_fetch_object($lists)){
                        
                            $todoCount = getTodoCount($row->id);
                            $doneTodoCount = getDoneTodoCount($row->id);
                            $percent = ($doneTodoCount / ($doneTodoCount + $todoCount)) * 100;
                            
                            $active = ($row->id == $listId ? "active" : "");

                            echo "<a href=\"http://xn--vedrflnir-47a.de/inside/page_listTodos.php?listId=".$row->id."\" class=\"list-group-item ".$active."\">
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
            <ul class="nav nav-tabs">
                <li role="presentation" <?php if($show=="list"){echo "class=\"active\"";} ?>><a href="http://xn--vedrflnir-47a.de/inside/page_listTodos.php?show=list&listId=<?php echo $listId; ?>">List</a></li>
                <li role="presentation" <?php if($show=="done"){echo "class=\"active\"";} ?>><a href="http://xn--vedrflnir-47a.de/inside/page_listTodos.php?show=done&listId=<?php echo $listId; ?>">Done</a></li>
                <li role="presentation" <?php if($show=="deleted"){echo "class=\"active\"";} ?>><a href="http://xn--vedrflnir-47a.de/inside/page_listTodos.php?show=deleted&listId=<?php echo $listId; ?>">Deleted</a></li>
            </ul>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if($show=="list"){ echo "<th class=\"col-md-1\">Position</th>";} ?>
					<th class="col-md-3">Name</th>
					<th class="col-md-6">Beschreibung</th>
					<th class="col-md-2">Bearbeiten</th>
				</tr>
			</thead>
			<tbody>
				<?php
                                    $Parsedown = new Parsedown();
                                                                            
                                    if($show=="list")
                                    {
                                            $todos = getOpenTodos($listId);
                                            
                                            while($row = mysql_fetch_object($todos)){
                                                    echo "<tr>";
                                                    echo "<td>$row->position</td>";
                                                    //echo "<td>$row->name</td>";
                                                    echo "<td><a href=\"http://xn--vedrflnir-47a.de/inside/action_listTodos.php?listId=$listId&id=$row->id&action=edit\">$row->name</a></td>";
                                                    echo "<td>".$Parsedown->text($row->description)."</td>";
                                                    echo "<td>
                                                                    <div class=\"btn-group btn-group-xs\" role=\"group\">
                                                                            <button type=\"button\" class=\"btn btn-default\" onClick=\"doAction($listId, $row->id, 'up')\">
                                                                                    <span class=\"glyphicon glyphicon-arrow-up\"></span>
                                                                            </button>
                                                                            <button type=\"button\" class=\"btn btn-default\" onClick=\"doAction($listId, $row->id, 'down')\">
                                                                                    <span class=\"glyphicon glyphicon-arrow-down\"></span>
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
                                        }
                                        else if($show=="done")
                                        {
                                            $doneTodos = getDoneTodos($listId);
                                            
                                            while($todo = mysql_fetch_object($doneTodos)){
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
                                        }
                                        else if($show=="deleted")
                                        {
                                            $deletedTodos = getDeletedTodos($listId);
                                                                                    
                                            while($todo = mysql_fetch_object($deletedTodos)){
                                                    echo "<tr>";
                                                    echo "<td>$todo->name</td>";
                                                    echo "<td>".$Parsedown->text($todo->description)."</td>";
                                                    echo "<td>
                                                                    <button type=\"button\" class=\"btn btn-default btn-xs\" onClick=\"recover($listId, $todo->id)\">
                                                                            recover
                                                                    </button>
                                                            </td>";
                                                    echo "</tr>";
                                            }
                                        }
                                    ?>	
			</tbody>
		</table>
	</div>
</div>

<script>
	function doAction(listId, id, action)
	{
            window.location = 'action_listTodos.php?listId=' + listId + '&id=' + id + '&action=' + action;
	}
	function undo(listId, id)
	{
            window.location = 'action_undoTodos.php?listId=' + listId +'&id=' + id;
	}
	function recover(listId, id)
	{
		window.location = 'action_deletedTodos.php?listId=' + listId +'&id=' + id;
	}
</script>

<?php include 'footer.php'; ?>