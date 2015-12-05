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
                    require_once 'databaseConnector.php';
                    
                    $listIds = getLists();
                    
                    while($listRow = mysql_fetch_object($listIds)){
                    
                        $todos = getDoneTodos($listRow->id);
                        
                        while($todoRow = mysql_fetch_object($todos)){
                            echo "<li class=\"list-group-item\">".$todoRow->name."</li>";
                        }
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
            <div class="panel-body">
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                Neue Features
            </div>
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