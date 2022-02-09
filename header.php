<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistics Application </title>
    
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <!--<link rel="stylesheet" href="css/bootstrap-rtl.css" />-->
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/droid-arabic-kufi" type="text/css"/>
    
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
       
        <a class="navbar-brand" href="index.php">Logistics App    </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Main <span class="sr-only">(current)</span></a></li>
            
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entry <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="plan.php">Plan</a></li>
                <li><a href="dispatch.php">Dispatch Area</a></li>
                <li><a href="trans.php">Daily Trans</a></li>
            </ul>
            </li>
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports  <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="qry_plan.php">Plan Report</a></li>
                <li><a href="qry_dispatch.php">Dispatch Report</a></li>
                <li><a href="qry_dispatch_balance.php">Dispatch Balance Rpt</a></li>
                <li><a href="qry_trans.php">Trans Report</a></li>
               
            </ul>
            </li>
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">settings <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="sites.php">Sites </a></li>
                <li><a href="lines.php"> Lines</a></li>
                <li><a href="models.php">Models </a></li>
                <li><a href="items.php"> Items</a></li>
                <li><a href="models.php">Colors </a></li>
                <li><a href="#"> Units</a></li>
            </ul>
            </li>
        </ul>
        
        <ul class="nav navbar-nav navbar-left">
            
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Accounts <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="logout.php"> Logout</a></li>
                
            </ul>
            </li>
        </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>