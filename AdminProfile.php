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

$sql = "SELECT * FROM users WHERE username = '" . $_SESSION["admin_user"] . "'";
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
        <h1 id="heading">KookyCookingClub </h1>
        <h2 id="adminTitle">Admin Account: <?php echo $_SESSION["admin_user"] ?></h2>


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
                    <li><a href="AdminProfile.php">Profile</a></li>
                    <?php
                } else {
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
        $userID = $row['user_id'];
        ?>
                                            <h2><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></h2>
                                            <h3>Date of birth:</h3>
                                            <p> <?php echo $row['date_of_birth']; ?></p>
                                            <h3>Email:</h3>
                                            <p> <?php echo $row['email']; ?></p>
                                        </div>
                                    </div> 
        <?php
    }
}
?>
                            <div class="col-sm-3">
                                <div class="profile">  
                                    <br><br>
                                    <h2><a href="AddEventForm.html">Add Event >></a></h2>
                                    <br>
                                    <h2><a href="AddCourseForm.html">Add Course >></a></h2> 
                                    <br>
                                    <h2><a href="UpdateEventForm.html">Update Event >></a></h2> 
                                    <br>
                                    <h2><a href="UpdateCourseForm.html">Update Course >></a></h2>
                                    <br>
                                    <h2><a href="DeleteEventForm.html">Delete Event >></a></h2> 
                                    <br>
                                    <h2><a href="DeleteCourseForm.html">Delete Course >></a></h2> 
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
<?php
$db->close();
?>
        </main>
    </body>
</html>


