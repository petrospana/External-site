<html>
<body>

<?php


$action = $_POST['postAction'];


if($action == "insert"){
    InsertToDatabase("INSERT INTO aitiseis (first_name,last_name,yearlyIncome,fathersName,mothersName) VALUES ('".$_POST['fname']."','". $_POST['lname']."','".$_POST['yearlyIncome']."','".$_POST['fathersName']."','".$_POST['mothersName']."')");
}


if($action == "search"){
    SearchForApplicant("SELECT * FROM aitiseis WHERE aitisi_id ='".$_POST['searchcode']."'");
}


    function InsertToDatabase($args){

        $dbhost = "localhost:3308";
        $dbuser = "hbstudent";
        $dbpass = "changeit";
        $db = "ergasia"; 

        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

       $sql = ($args);

        if ($conn->query($sql) === TRUE) {
                echo "Your Application Has Been Submitted Successfully<br>";
                $last_id = $conn->insert_id;
                echo "Your Application ID is: <strong>" . $last_id ."</strong>";

        } else {
                echo "There was an ERROR please try again or contact as at example@gmailcom ";
                echo "Error: " . $sql . "<br>" . $conn->error;
        };
              
            $conn -> close();
    };





    function SearchForApplicant($arg){

        $dbhost = "localhost:3308";
        $dbuser = "hbstudent";
        $dbpass = "changeit";
        $db = "ergasia"; 

        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

                // Perform query
                if ($result = $conn -> query($arg)){ //<-- CHANGE THE MyTable to PENDING USERS TABLE
                //echo nl2br ("Returned rows are: " . $result -> num_rows ."\n");
            
                    if($result -> num_rows > 0){
                        
                        // Process all rows
                        while($row = mysqli_fetch_array($result)) {
    
                            echo "Found Applicant, " . $row['first_name'] . " " . $row['last_name']. "<br> Status is: <strong> Pending </strong>"; //
                           
                        }
                    }else{
                        echo nl2br ("Applicant Not Found\n");
                    }
        
                }else{
                echo nl2br ("Couldn't Perform Query...\n");
                
                }
        
                $conn -> close();

        }

    ?>
</body>
</html> 