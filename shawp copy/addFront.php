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
<title>Shawp Add</title>
<link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css"><!-- minified CSS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><!-- jQuery library -->
<script src="bootstrap-3.3.7/js/bootstrap.min.js"></script><!-- JavaScript -->
<script src="js/bootbox.min.js"></script><!-- Bootbox -->
<meta name="viewport" content="width=device-width, initial-scale=1">
    
<!--Other links like custom stylesheets and script-->
<script src="js/ajax.js"></script> <!--Ajax custom-->
<link rel="stylesheet" href="css/style.css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <div id="container">
    <nav>
        <div class="navbar">
            <div class="logo"><a href="/"></a></div>
            <div class="container resize">
                <ul class="nav right">
                    <li class="right"><a class="btn btn-warning" href="logout.php">Sign Out</a></li>
                    <li class="right"><a class="btn btn-success" id="prompt" href="backEnd.php">+ Add Points</a></li>                    
                </ul>                
            </div>                
        </div>
    </nav> 
    <div id="body" class="container verticle-center">
    
        <form class="form-inline" name="frontForm" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <h1 class="center">Let's <span class="pop">Shawp</span></h1>
                <h4>Enter student ID below with item cost:</h4>
                
                <label class="sr-only" for="studentID">Student ID</label>
                <div class="input-group">
                    <div class="input-group-addon">ID</div>
                    <input id="id" type="text" class="form-control" placeholder="Student ID">
                </div>
                
                <label class="sr-only" for="subtract">Amount</label>
                <div class="input-group">
                    <div class="input-group-addon">$</div>
                    <input id="subtract" type="number" class="form-control" placeholder="Amount">
                </div>
                
                <button type="submit" id="submitSubtr" class="btn btn-primary" alt="Purchase" data-toggle="tooltip" title="Subtrack specified amount from student total points">Purchase</button>
                
            </div>
        </form> 
        
    </div>
    <div id="footer">
        <div class="signature"><h5>Created by <span>tommyTunes</span></h5></div> 
    </div>
    
<script>
    
function capLock(e){
    
     kc = e.keyCode?e.keyCode:e.which;
     sk = e.shiftKey?e.shiftKey:((kc == 16)?true:false);
     if(((kc >= 65 && kc <= 90) && !sk)||((kc >= 97 && kc <= 122) && sk))
      document.getElementById('divMayus').style.visibility = 'visible';
     else
      document.getElementById('divMayus').style.visibility = 'hidden';
    
}
    
</script>
    
</body>
</html>