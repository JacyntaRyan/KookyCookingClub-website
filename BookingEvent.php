<?php
//Jacynta Ryan
session_start();
?>
<?php
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
       // echo 'Server & database connection successful<br>';
    }
  //retrieving id that was passed in  
$event_id = $_GET['event_id'];
//echo "course id".$course_id;
$event_price = $_GET['event_price'];
//echo "<br>courseprice". $course_price;
$deduct_payment = $_POST['payment'];
//echo "<br> deductprice".$deduct_payment;
$amount_remaining = $event_price - $deduct_payment;

$sql = "SELECT * FROM users WHERE username = '" . $_SESSION["user_name"] . "'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
 $userID = $row['user_id'] ; 
    }
}
// to create a booking you need a payID so I insert the payment first
$sql = "INSERT into payments(user_id,amount_remaining) VALUES (".$userID.",".$amount_remaining.") ";
if ($db->query($sql) === TRUE) {
    //insert_id will bring back the last id inserted 
    //into the database which is the pay id from the payment inserted above
    $last_id = $db->insert_id;
    $payID= $last_id;
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

//insert booking into table
$sql1 = "INSERT INTO bookings (user_id,pay_id,event_id) VALUES(".$userID.",".$payID.",".$event_id.")"; 


if($db->query($sql1))
{
    echo '<h2>Booking successful..redirecting</h2>';
    echo '<meta http-equiv="refresh" content="2; URL=Profile.php">';
    

}

?>