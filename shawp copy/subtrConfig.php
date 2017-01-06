<?php include("dbConfig.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    //Select Database
    mysqli_select_db($conn, $dbName);
    
    
    //Student IDs and Bank
    $studentID = $_POST['studentID'];
    $subtrPoints = $_POST['subtr'];

    //Protection
    $studentID = mysqli_real_escape_string($conn, $studentID);
    $subtrPoints = mysqli_real_escape_string($conn, $subtrPoints);
    
    //DB data--------------------------
    
    //Select all student data
    $sqli = "SELECT * FROM students";
    $result = $conn->query($sqli);
    
    //----------------------------------
        
    //Verify table is not empty
    if ($result->num_rows > 0) {
        //Output data to array
        while($row = $result->fetch_assoc()) {

            //Compare and add points to student ID
            if($studentID == $row['studentID'] ){
                
                //Points in DB
                $points = $row['points'];
                $before = $subtrPoints; 
                //Subtract points from DB
                $subtrPoints = ($points - $subtrPoints);
                
                if ($subtrPoints >= 0){
                    
                    //Update points in table
                    $sql = "UPDATE students SET points='$subtrPoints' WHERE studentID='$studentID' ";

                    //Return results
                    if ($conn->query($sql) === FALSE) {
                        die('Can\'t add record to database: ' . mysqli_error($conn) . "<br />");
                    } else {
                        echo "Student <i>" . $studentID . "</i> purchased item for <span style='color:#b90000'>$<b>" . $before . "</b></span>" . "<p><b>Total Points: " . $subtrPoints . '</b></p>';
                    } 
                    
                } else {
                    
                    echo "<span style='color:#930b00'><b>Insuficient funds!</span> <p>Total Points: " . $points . "</b></p>";
                    
                }
                
            }                
         }
    } else {
        echo "No students found!";
    }
}

mysqli_close($conn);

?>











