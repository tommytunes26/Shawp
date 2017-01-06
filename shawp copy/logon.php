<?php session_start(); // Starting Session

include("dbConfig.php");

// Selecting database
mysqli_select_db($conn, "points");

//Get password from request
$pass = "SELECT pass FROM password";
$result = mysqli_query($conn, $pass);


//Get password VARIABLE
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        
        global $password;
        $password = $row['pass'];
    }
}


//Check Password
if(isset($_POST['pass'])){
    
    $compare = $_POST['pass'];
    
    function check($compare, $password){        
        
        if ($compare == $password){
            $_SESSION['backEnd'] = 'x';
            echo 'true';
            exit();
        } else if ($compare == null){
            echo 'null';
            exit();
        } else {
            echo 'false';
            exit();
        }
    }
    
    check($compare, $password);
}



mysqli_close($conn);

?>
























