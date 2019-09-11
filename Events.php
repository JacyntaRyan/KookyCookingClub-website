<?php
//Jacynta Ryan
session_start();
?>
<?php
include ('CONFIG/config.php');
include ('CONFIG/connection.php');
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
     <h1 id="heading">KookyCookingClub</h1>
     
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
     <?php
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
            
     //gets all available events to out put details stored in database       
    $sql = "SELECT * FROM Events WHERE availability = 'yes'";
    $result = $db->query($sql);
?>
     <main id="courses">
    <div class="container">
     
     <?php
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
?>
     

        <div class="row">
            <div class="col-sm-12">
                <div class="events">
                    <img src="<?php echo $row['image_path'] ?>" height="200px" width="200px" />
                    <div class="event_text">
                        
                        <h2><?php echo $row['name']; ?></h2>
                        <h3><?php echo $row['date'] ;?> , <?php echo $row['location'] ?> Price:<?php echo $row['price']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <div class="event_buttons">
                             <?php
                             //only logged in users who are not admin can view the book now link
                if(isset($_SESSION["user_name"])){?>               
               <a href = "BookingEventForm.php?event_id=<?php echo $row['event_id']?>" ><img src= "images//button_book_now.png" width="100" height="30" alt="Book Event"/></a>
                <?php               
                }
                 ?>
       
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
}};

 $db->close();
?>
    </div>
     
            
            
            
</main>
</body>
</html>