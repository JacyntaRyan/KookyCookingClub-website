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
        //echo 'Server & database connection successful<br>';
    }

$course_id = $_GET['course_id'];


 $sql = "SELECT * FROM Courses WHERE course_id = ".$course_id;
            $result = $db->query($sql);
 if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $course_price = $row['price'];  
      $name = $row['course_name'];
    }
   }
?>

<!doctype html>

<html lang="en">
<head>
    <title>KookyCookingClub</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles/main.css">
    <h1 id="heading">KookyCookingClub</h1>
<header>

</header>
<nav id="nav_menu">
    <ul>
        <li><a href="Index.php">Home</a></li>
        <li><a href="Courses.php">Courses</a></li>
        <li><a href="Events.php">Events</a></li>
         <?php if (isset($_SESSION["user_name"])) { ?>               
                <li ><a href="Profile.php">Profile</a></li>
                <?php
            } else if (isset($_SESSION["admin_user"])) {
                ?>
                <li><a href=AdminProfile.php>Profile</a></li>
                <?php
            } else {
                ?>
                <li><a href="Login.html">Log In</a></li>
                <?php
            }
            ?>     
    </ul>
</nav>

<main>
    <h2 id="reg_header">Book Course</h2>
    <form action ="BookingCourse.php?course_price=<?php echo $course_price ?>&course_id=<?php echo $course_id ?>"  id="form"  method ="POST">
        <fieldset>


            <Div id ="left_form" style="float:left">
                <h2>Course name:</h2>
                <p><?php echo $name ?></p><br>
                <h2>Price:</h2>
                <p><?php echo $course_price ?></p><br>   
                
                <input type="submit" value="Submit" name="submit">
            </Div>
            <Div id ="right_form" style="float:right">
                <h3>Please enter the amount you wish to pay now.</h3><br>
                <input type="number" required name="payment" onchange="this.value = parseFloat(this.value).toFixed(2);" min="5.00" step="0.50" value="0.00"">
                <br><br><br><br><br><br> 
                
                <input type="reset" value="Cancel" name="cancel">
            </Div>

        </fieldset>
    </form>
</main>
<footer>
</footer>

</html>