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
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->  
<!--Favicons-->
<link rel="apple-touch-icon" sizes="180x180" href="images/favicons/apple-touch-icon.png">
<link rel="icon" type="image/png" href="images/favicons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="images/favicons/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="images/favicons/manifest.json">
<meta name="theme-color" content="#ffffff">    
</head>
<body>
    <div id="container">
    <nav>
        <div class="navbar">
            <div class="logo"><a href="/"></a></div>
            <div class="container resize">               
            </div>                
        </div>
    </nav> 
    <div id="body" class="container verticle-center">
    
        <div class="form-group login">
            <h1 class="center">Let's <span class="pop">Shawp</span></h1>
            <h4>Sign in to access the Shawp!</h4>
            <a class="btn btn-primary right" id="prompt" href="#">Login</a>     
            <div><a class="btn btn-success" data-toggle="tooltip" title="Check total points for student ID" id="submitBalance" href="#">Check Student Balance</a></div>     
        </div> 
        
    </div>
        
    <div id="footer">
        <div class="signature"><h5>Created by <span>tommyTunes</span></h5></div> 
    </div>
    
<!--Password Prompt Menu----------------------------------------->
    
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
    
    <!--Student ID Prompt Menu----------------------------------------->
    
    <div class="form-content" style="display:none;">
      <form class="form" role="form">
        <div class="form-group">
          <label for="id">Student ID</label>
          <input type="text" class="form-control" id="idBalance" name="Student ID" onkeypress="capLock(event)" placeholder="Enter student ID...">
        </div>
        <div id="divMayus" style="visibility:hidden">Caps Lock is on.</div>
        </form>
    </div>
    </div>
    
<script>
    
/*Password Prompt-------------------------------*/
    
$('#prompt').click(function (){
    
    bootbox.prompt({
        size: "small",
        backdrop: true,
        animate: true,
        title: "Enter password to continue:",
        inputType: 'password',
        callback: function (result) {
            var call = result;
            pass(call);
         }
    }); 
});
    
function pass(call){
    
    $.ajax({
         url: 'logon.php',
         type: "POST",
         data: {pass: call},
         success: function(data){
             
            if (data == 'true'){                
                window.location.replace("addFront.php");
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

/*Check student balance---------------------------*/
    
$('#submitBalance').click(function (){
    
    bootbox.prompt({
        size: "small",
        backdrop: true,
        animate: true,
        title: "Enter student ID to continue:",
        inputType: 'text',
        callback: function (result) {
            var call = result;
            success(call);
         }
    }); 
});
    
function success(call){
    
    var check = call;
        
    //Validate if amount has been submitted
    if (check !== ''){

        event.preventDefault();
        
        $.ajax({
            url: 'checkConfig.php',
            dataType: 'text',
            data: {studentID: call},
            type: 'post',
            success: function (data) {
                
                if ($.trim(data) !== '' ){

                    bootbox.alert({
                        size: "small",
                        backdrop: true,
                        animate: true,
                        message: data,
                    }); 

                        // Clear the form.
                        $('#id').val('');
                        $('#subtract').val('');

                } else {

                    bootbox.alert({
                        size: "small",
                        backdrop: true,
                        animate: true,
                        title: "Failed!",
                        message: "Student not found!",
                    }); 

                        // Clear the form.
                        $('#id').val('');
                        $('#subtract').val('');   
                }
            },  
            error: function(){
                bootbox.alert({
                    size: "small",
                    backdrop: true,
                    animate: true,
                    title: 'Failed!',
                    message: 'ERROR',
                }); 
            }
        });

    } else {
        bootbox.alert({
            size: "small",
            backdrop: true,
            animate: true,
            title: 'Failed!',
            message: 'Please enter a student ID',
        }); 
    }
        
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