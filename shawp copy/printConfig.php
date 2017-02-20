<?php include("dbConfig.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //For testing
    //var_dump($_POST);

    //Select Database
    mysqli_select_db($conn, $dbName);
    
    
    //DB data--------------------------
    
    //Select all student data
    $sqli = "SELECT * FROM students";
    $result = $conn->query($sqli);
    
    //----------------------------------


    // Start a table tag in the HTML
    // Button sidebar
    echo "<div class='btn-container'>";
    echo "<div class='btn btn-warning' id='dnl-btn' onclick='exportFile()'>Download</div>";
    echo "<div class='btn btn-success' id='print-btn' onclick='printFile()'>Print</div>"; 
    echo "</div>";
    
    // Table
    echo "<table id='points-table'>"; 
    echo "<tr><td><b>Student Id</b></td><td><b>Points</b></td></tr>";

    //Creates a loop to loop through results
    while($row = mysqli_fetch_array($result)){   

        //$row['index'] the index here is a field name
        echo "<tr><td>" . $row['studentID'] . "</td><td>" . $row['points'] . "</td></tr>";  
    }
    //Close the table in HTML
    echo "</table>";       
    

mysqli_close($conn);


}


?>











