<?php include("dbConfig.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    //Select Database
    mysqli_select_db($conn, $dbName);
    
    
    //Student IDs and Bank
    $studentID = $_POST['studentID'];
    $addPoints = $_POST['add'];

    //Protection
    $studentID = mysqli_real_escape_string($conn, $studentID);
    $addPoints = mysqli_real_escape_string($conn, $addPoints);
    
    //For testing
    //var_dump($_POST);
    
    if (isset($_FILES['file']['name'])) {
        
        if (0 < $_FILES['file']['error']) {//File not found
            
            echo 'Error during file upload' . $_FILES['file']['error'];
            
        } else {//Get data from file and ADD it to DB
            
            //File data------------------------------------
            
            //Count items in file
            $file = file($_FILES['file']['tmp_name']);
            $count = count($file);
            
            //Get content of text file
            $data = file_get_contents($_FILES['file']['tmp_name']);
            
            //Convert content to array by line breaks
            $id = (explode(PHP_EOL, $data));
            
            //--------------------------------------------
            
            if ($count > 0) {
                
                $i = 1;                
                //Add array from file to DB
                foreach ($id as $stu){


                    //DB data--------------------------
                    
                    //Select all student data matching student ID
                    $sqli = "SELECT * FROM students WHERE studentID = $stu ";
                    $result = mysqli_query($conn, $sqli);
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    //----------------------------------
                    
                    //For testing
                    //var_dump($stu);
                    
                    //Math
                    $add = $addPoints + $row['points'];
                    $sql = "
                    INSERT INTO students (studentID, points) VALUES ('$stu', '$add') 
                    ON DUPLICATE KEY UPDATE points='$add' ";

                    //Return results
                    if ($conn->query($sql) === FALSE) {
                        die('Can\'t add record to database: ' . mysqli_error($conn) . "<br />");
                    } else {
                        //echo "<p>Added <span style='color:#009106'>$<b>" . $addPoints . "</b></span> to <i>" . $stu . "</i></p>";
                    }

                    //Check with rows in text file
                    $i < $count;
                    $i++;
                }
                
                //Return results
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Can\'t add record to database: ' . mysqli_error($conn) . "<br />");
                } else {
                    echo "Added <span style='color:#009106'>$<b>" . $addPoints . "</b></span> to <b>" . $count . "</b> student(s). ";
                } 
            }
        }
            
    } else {//If no file present 
        
        //DB data--------------------------
                
        //Select all student data matching student ID
        $sqli = "SELECT * FROM students WHERE studentID = $studentID ";
        $result = mysqli_query($conn, $sqli);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        //----------------------------------
        
        $before = $addPoints;
        $addPoints += $row['points'];
        
        //Update points in table
        $sql = "
            INSERT INTO students (studentID, points) VALUES ('$studentID', '$addPoints') 
            ON DUPLICATE KEY UPDATE points='$addPoints' ";

        //Return results
        if ($conn->query($sql) === FALSE) {
            die('Can\'t add record to database: ' . mysqli_error($conn) . "<br />");
        } else {
            echo "Added <span style='color:#009106'>$<b>" . $before . "</b></span> to student <i>" . $studentID . "</i>" . '<p> <b>' . "Total Points: " . $addPoints . '</b></p>';
        } 
    }
}

mysqli_close($conn);

?>











