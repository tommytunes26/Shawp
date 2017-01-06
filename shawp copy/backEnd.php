<?php
include("logon.php");

if(!isset($_SESSION['backEnd']))
{
    // not logged in
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lan="eng">
<meta charset="utf-8">
<head>
<title>Shawp Inventory</title>
<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css"><!-- minified CSS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><!-- jQuery library -->
<script src="bootstrap-3.3.7/js/bootstrap.min.js"></script><!-- JavaScript -->
<script src="js/bootbox.min.js"></script><!-- Bootbox -->
<meta name="viewport" content="width=device-width, initial-scale=1">
    
<!--Other links like custom stylesheets and script-->
<script src="js/ajax.js"></script> <!--Ajax custom-->
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="container">
    <nav>
        <div class="navbar">
            <div class="logo"><a href="/"></a></div>
            <div class="container resize">
                <ul class="nav right">
                    <li class="right"><a href="logout.php">Check Out</a></li>
                </ul>                
            </div>                
        </div>
    </nav>
    <div id="body" class="container verticle-center">
    
        <form class="form-inline" id="backForm" method="post" enctype="multipart/form-data" >
            <div class="form-group">
                <h1 class="center"><span class="pop">Shawp</span> [back end]</h1>
                <div class="center-contents">
                    <h4>Enter student ID below with points to add:</h4>

                    <div class="input-group">
                        <label class="sr-only" for="studentID">Student ID</label>
                        <div class="input-group-addon">ID</div>
                        <input name="studentID" id="id" type="number" class="form-control" placeholder="Student ID">
                    </div>

                    <div class="input-group">
                        <label class="sr-only" for="add">Add Points</label>
                        <div class="input-group-addon">$</div>
                        <input name="add" id="add" type="number" class="form-control" placeholder="Amount" required>
                    </div>

                    <button class="btn btn-primary" id="submitAdd" type="submit" alt="Add points" data-toggle="tooltip" title="Add specified amount to student ID">+ Add Points</button>

                    <div class="form-group last">
                        <label class="sr-only" for="datafile">File input</label>
                        <input class="form-control-file" type="file" id="file" aria-describedby="fileHelp" alt="Upload file" data-toggle="tooltip" title="Select a text file to upload">
                        <small name="fileHelp" class="form-text text-muted">Select a text file with a list of student IDs.</small>
                    </div>  

                    <button class="btn btn-primary set" id="submitSet" type="submit" alt="Set points" data-toggle="tooltip" title="Use to override student ID to specified amount">Set Points</button>
                </div>
            </div>
        </form>
    
    </div>
    <div id="footer">
        <div class="signature"><h5>Created by <span>tommyTunes</span></h5></div> 
    </div>

</body>
</html>

