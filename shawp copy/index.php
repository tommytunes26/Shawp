<?php
include("logon.php");
?>

<!DOCTYPE html>
<html lan="eng">
<meta charset="utf-8">
<head>
<title>Shawp</title>
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
                    <li class="right"><a id="prompt" href="#"><img src="images/lock.png" /> Add Points</a></li>
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
    
<!--Prompt Menu----------------------------------------->
    
    <div class="form-content" style="display:none;">
      <form class="form" role="form">
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" onkeypress="capLock(event)" placeholder="Enter password...">
        </div>
        <div id="divMayus" style="visibility:hidden">Caps Lock is on.</div>
        </form>
    </div>
    </div>
<script>
    
$('#prompt').click(function (){
    
    bootbox.prompt({
        size: "small",
        backdrop: true,
        animate: true,
        title: "Enter password to continue:",
        inputType: 'password',
        callback: function (result) {
            var call = result;
            success(call);
         }
    }); 
});
    
function success(call){
    
    $.ajax({
         url: 'logon.php',
         type: "POST",
         data: {pass: call},
         success: function(data){
             
            if (data == 'true'){                
                window.location.replace("backEnd.php");
            } else if (data == 'null') {

            } else {
                alert("Incorrect Password");
            }

        },
        error: function(){
            alert('ERROR');
        }
    })
        
}
    
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