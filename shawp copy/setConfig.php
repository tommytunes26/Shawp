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
            
        } else {//Get data from file and insert into DB
            
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
                
                $sql = "REPLACE INTO students (studentID, points) VALUES";
                $i = 1;
                $add = $addPoints;

                foreach($id as $row){
                    $tmp = explode("|", $row);
                    $sql .= "('$tmp[0]','$add')";
                    $sql .= $i < $count ? ',' : '';
                    $i++;
                }
                
                //Return results
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Can\'t add record to database: ' . mysqli_error($conn) . "<br />");
                } else {
                    echo "Set <b>" . $count . "</b> student(s) to <span style='color:#009106'>$<b>" . $addPoints . "</b></span>";
                } 
                
            }
            
        }
    } else {//If no file present 
        
        //Insert data into table
        $sql = "REPLACE INTO students (studentID, points)
                VALUES ($studentID, $addPoints)";
        
        //Return results
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die('Can\'t add record to database: ' . mysqli_error($conn) . "<br />");
        } else {
            echo "Set student <i>" . $studentID . "</i> to <span style='color:#009106'>$<b>" . $addPoints . "</b></span>";
        } 
        
    }
}

mysqli_close($conn);

?>











