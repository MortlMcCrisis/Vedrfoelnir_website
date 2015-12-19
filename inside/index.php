<?php include 'header.php'; ?>

<div class="page-header">
    <h1>Vedrfölnir Orga</h1>
</div>
    
<div class="row">
    <div class="col-md-8">   
        <div class="panel panel-default">
            <div class="panel-heading">
                Aktivitätsstrom
            </div>
              <!-- List group -->
            <ul class="list-group">
                <?php
                    $todos = getRecentlyChangedTodosDesc();
                    
                    $counter=0;
                    while($todoRow = mysql_fetch_object($todos)){
                    
                        echo "<li style=\"color:rgb($counter,$counter,$counter)\" class=\"list-group-item\">".date("d.m.Y H:i:s", $todoRow->last_changed)." <a href=\"http://xn--vedrflnir-47a.de/inside/action_listTodos.php?listId=$todoRow->listId&id=$todoRow->id&action=edit\">$todoRow->name</a>";
                        $counter+=12;
                        if($todoRow->deleted==1)
                        {
                            echo " (deleted)";
                        }
                        elseif($todoRow->done==1)
                        {
                            echo " (done)";
                        }
                        else
                        {
                            echo " (edited)";
                        }
                        echo "</li>";
                    }
                ?>
            </ul>
        </div>
    </div>

    <div class="col-md-4">        
        <div class="panel panel-default">
            <div class="panel-heading">
                Mir zugewiesen
            </div>
            <div class="panel-body">
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                User Statistiken
            </div>
            <div class="panel-body">
                <p>Stats</p>
            </div>
        </div>  
        
        <div class="panel panel-default">
            <div class="panel-heading">
                Anstehende Termine
            </div>
            <ul class="list-group">
                <li class="list-group-item">Juzekonzert: 12. oder 26. März</li>
            </ul>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                Neue Features
            </div>
            <ul class="list-group">
                <li class="list-group-item">
                    <h3>Zuletzt bearbeitete Todos auf der Startseite</h3>
                    Hier werden ab sofort die 10 letzten Todos die bearbeitet, erledigt oder gelöscht wurden. Zukünftig werden auch die User angezeigt die das Todo bearbeitet haben.
                </li>
            </ul>
            <ul class="list-group">
                <li class="list-group-item">
                    <h3>Startseite</h3>
                        Hier stehen die alle erledigten Todos. Für die Zukunft ist geplant hier die neuesten erledigten Todos anzuzeigen, die dem Benutzer zugewiesenen Todos, anstehende Termine und Statistiken wer wieviel erledigt hat.
                </li>
            </ul>
        </div>    
    </div>
</div>

<?php include 'footer.php'; ?>