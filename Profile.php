<?php
//Jacynta Ryan
include ('CONFIG/config.php');
include ('CONFIG/connection.php');
?>
<?php
session_start();
 @$db = new mysqli($DBServer, $DBUser, $DBPass, $DBName); //try to connect to the MySQL server
     
      if ($db->connect_errno) {
                //if DEBUG is enabled display diagnostics
                if (__DEBUG == 1) {
                    echo '<h3>DIAGNOSTIC DATA - Unable to connect to MySQL Server</h3>';
                    echo 'MySQL Server Connection parameters attempted:<br>';
                    echo 'Host address :' . $DBServer . '<br>';
                    echo 'Username : ' . $DBUser . '<br>';
                    echo 'Password : ' . $DBPass . '<br>';
                    echo 'Selected Database : ' . $DBName . '<br>';
                    echo '<h4>MySQLi error message:</h4>';
                    echo $db->connect_error;
                    $db->close();
                    exit('<hr>Script terminated');
                } else {
                    echo 'System Error - no debug information available';
                    $db->close();
                    exit('<hr>Script terminated');
                }
            } else {
               
            }
//get user details
$sql = "SELECT * FROM users WHERE username = '" . $_SESSION["user_name"] . "'";
$result = $db->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>KookyCookingClub</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles/main.css">

    </head>
    <body>
        <h1 id="heading">KookyCookingClub - <?php echo $_SESSION["user_name"] ?></h1>

        <nav id="nav_menu">
            <ul>
                <li><a href="Index.php">Home</a></li>
                <li><a href="Courses.php">Courses</a></li>
                <li><a href="Events.php">Events</a></li>
                 <?php
                if(isset($_SESSION["user_name"])){?>               
                <li ><a href="Profile.php">Profile</a></li>
                <?php               
                }
                else if(isset($_SESSION["admin_user"])){
                    ?>
                <li><a href=AdminProfile.php>Profile</a></li>
                <?php
                }
                
                else{
                    ?>
                <li><a href="Login.html">Log In</a></li>
                <?php
                }
                ?>
                
            </ul>
        </nav>
        <main id="courses">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="profile">
                                    <img src="images//profile_default.png" />
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
 $userID = $row['user_id'] ;       
        ?>
                                    <!--out puts specified user details from data base -->
                                    <h2><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></h2>
                                    <h3>Date of birth:</h3>
                                    <p> <?php echo $row['date_of_birth']; ?></p>
                                    <h3>Email:</h3>
                                    <p> <?php echo $row['email']; ?></p>
                                   </div>
                            </div>
                                    
                                    
<?php
}};
//find courses the logged in user has booked
$sql = "SELECT * FROM courses JOIN bookings ON courses.course_id = bookings.course_id WHERE bookings.user_id = $userID";
$result = $db->query($sql);
 
?>
                             <div class="col-sm-3">
                                <div class="profile">
                                    <h2>Your Courses</h2>
<?php
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        ?>
                                   
                           
                                    <p><?php echo $row['course_name']; ?></p>
                                    
<?php
}};
//find events the logged in user has booked
$sql = "SELECT * FROM Events JOIN bookings ON events.event_id = bookings.event_id WHERE bookings.user_id = $userID";
$result = $db->query($sql);
 
?>
                                    <br><br>
                                    <h2>Events Booked</h2>
<?php
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        ?>
                                    
                                    <p><?php echo $row['name']; ?></p>
                               

                                    
<?php
}};
$db->close();
?>
                                     </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="profile">
                                    <br>
                                    <form action = "LogOut.php" method="POST" id="form">
                                            <input id="logout_button" type="submit" value="Log Out" name="log out">
                                            </form>
                                    
                                </div>
                                </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
