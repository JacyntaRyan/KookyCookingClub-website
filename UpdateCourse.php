<?php
//Jacynta Ryan
include ('CONFIG/config.php');
include ('CONFIG/connection.php');
$db=new mysqli($DBServer, $DBUser, $DBPass, $DBName); //try to connect to the MySQL server

if($db->connect_errno){
    //if DEBUG is enabled display diagnostics
    if (__DEBUG==1){
        echo '<h3>DIAGNOSTIC DATA - Unable to connect to MySQL Server</h3>';
        echo 'MySQL Server Connection parameters attempted:<br>';
        echo 'Host address :'.$DBServer.'<br>';
        echo 'Username : '.$DBUser.'<br>';
        echo 'Password : '.$DBPass.'<br>';
        echo 'Selected Database : '.$DBName.'<br>';
        echo '<h4>MySQLi error message:</h4>';    
        echo $db->connect_error;
        $db->close();
        exit ('<hr>Script terminated');
    }
    else{
        echo 'System Error - no debug information available';
        $db->close();
        exit ('<hr>Script terminated');
        }
        }
else{ 
        echo 'Server & database connection successful<br>';
    }
    
$course_id = $_POST['course_id'];
$availability = $_POST['availability'];


//updates availability field in course table
$sql = "UPDATE courses SET availability = '".$availability."' WHERE course_id = '".$course_id."'";

if($db->query($sql))
{
    echo '<h2>Update successful..redirecting</h2>';
    echo '<meta http-equiv="refresh" content="2; URL=AdminProfile.php">';
    

}

?>