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
    <h1 id="heading">KookyCookingClub</h1>
</head>
<body>
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


            $sql = "SELECT * FROM Courses WHERE availability = 'yes'";
            $result = $db->query($sql);
            ?>
    <main id="courses">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <img src="<?php echo $row['image_path']; ?>" />
                                        <h2><?php echo $row['course_name']; ?></h2>
                                        <p>starts: <?php echo $row['date']; ?> Price:<?php echo $row['price']; ?></p>
                                        <p><?php echo $row['description']; ?></p>
                                        <div class="course_buttons">
        <?php if (isset($_SESSION["user_name"])) { ?>  <!--passing course id to bookingcourse.php-->      
                   <a href = "BookingCourseForm.php?course_id=<?php echo $row['course_id']?>" ><img src= "images//button_book_now.png" width="100" height="30" alt="Book Course"/></a>
            <?php
        }
        ?>

                                        </div>
                                    </div>
                                </div>

        <?php
    }
};

$db->close();
?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>    



