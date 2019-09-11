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
    
$event_name = $_POST['name'];
$location = $_POST['location'];
$date = $_POST['date'];
$price = $_POST['price'];
$description = $_POST['description'];
$image_path = $_POST['image_path'];


$sql = "INSERT INTO events (name, location, date, price, description,image_path) VALUES('".$event_name."','".$location."','".$date."','".$price."','".$description."','".$image_path."')"; 

if($db->query($sql))
{
    echo '<h2>insert successful..redirecting</h2>';
    echo '<meta http-equiv="refresh" content="2; URL=AdminProfile.php">';
    

}

?>