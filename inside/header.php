<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php 
            require_once 'databaseConnector.php';

            $listId = 1;
            if (isset($_GET['listId'])){
                    $listId = $_GET['listId'];
            }
        ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://xn--vedrflnir-47a.de/inside/index.php">Vedrf&ouml;lnir Orga</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="http://xn--vedrflnir-47a.de/inside/page_listTodos.php?listId=1">Todos</a></li>
                <?php
                        include_once 'databaseConnector.php';
                        
                        $contactLists = getContactLists();
                        
                        while($row = mysql_fetch_object($contactLists)){
                                echo "<li><a href=\"http://xn--vedrflnir-47a.de/inside/page_contacts.php?listId=".$row->id."\">".$row->name."</a></li>";
                        }
                ?>
                <li><a href="http://xn--vedrflnir-47a.de/inside/page_orgaDocuments.php">Orga Dokumente</a></li>
                <li><p class="navbar-btn"><a href="/inside/page_newTodo.php?listId=<?php echo $listId ?>" class="btn btn-default">Neues Todo</a></p></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Admin<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="http://xn--vedrflnir-47a.de/inside/database.log">Datenbank Log</a></li>
                        <li><a href="http://xn--vedrflnir-47a.de/inside/page_technicalDocumentation.php">technische Dokumentation</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#"><span class="glyphicon glyphicon-question-sign"></span></a>
                </li>
            </ul>
        </div>
      </div>
    </nav>
	
	<br><br>
	
	<div class="container">