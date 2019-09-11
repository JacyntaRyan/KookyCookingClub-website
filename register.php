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
//retrieves inputs from form an assigns to variable    
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$user_name = $_POST['user_name'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$password = $_POST['password'];
$email = $_POST['email'];
$address = $_POST['address'];
$password = password_hash($password, PASSWORD_BCRYPT);


//insert values to database
$sql = "INSERT INTO users (first_name, last_name, phone, address, username, password, date_of_birth, email) VALUES('".$first_name."','".$last_name."','".$phone."','".$address."','".$user_name."','".$password."','".$date."','".$email."')"; 

if($db->query($sql))
{
    //if sucessful redirect to log in page
    echo 'insert successful';
    header("Location: Login.html");

}
echo 'done';
?>