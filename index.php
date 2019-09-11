<!--//Jacynta Ryan-->
<?php
session_start();
?>
<!doctype html>

<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles/main.css"/>
    <title>KookyCookingClub</title>
    <meta charset="utf-8">



</head>

<body>

<header>

    <h1 id="heading">KookyCookingClub</h1>

</header>
    <!-- checks to see if user is logged in, nav menu displays either profile or log in
    if user is admin the profile links to admin_profile
    if regular user links to user profile-->
<nav id="nav_menu">
    <ul>
        <li><a href="Index.php">Home</a></li>
        <li><a href="Courses.php">Courses</a></li>
        <li><a href="Events.php">Events</a></li>
         <?php
         //depending on user type redirect to appropriate profile page
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
<main>

    <div id="home_img">
        <div id="home_left">
            <img id="img_class" src="images//classes.jpeg" width="150" height="300">

        </div>
        <div id="home_center">
            <img id="img_event" src="images//event2.jpg" width="150" height="300">

        </div>
         
        <div id="home_right">
            <img id="img_logIn" src="images//spoon.jpg" width="150" height="300"><br><br>
        </div>
    </div>
    <a id="course_link" href="Courses.php">View Courses</a>
    <a id="event_link" href="Events.php">View Events</a>
    <?php
                if(isset($_SESSION["user_name"])){?>               
                <a  href="Profile.php">Profile</a>
                <?php               
                }
                else if(isset($_SESSION["admin_user"])){
                    ?>
                <a id="login_link" href="AdminProfile.php">Profile</a>
                <?php
                }
                else{
                    ?>
                <a id="login_link" href="Login.html">Log In</a>
                <?php
                }
                ?>
    


    <footer>
        
         <?php
         //only displays the registration link if not logged in
                if( !isset($_SESSION["user_name"]) && !isset($_SESSION["admin_user"]) ){?>               
                <p>Are you interested in taking a course or attending an event? Sign up now and book .

            <a id="regButton1" href="Registration.html"><img src="images//button_sign-up.png" width="100" height="30" alt="Sign Up" /></a>

        </p>
                <?php               
                }
                ?>
               
        
    </footer>
</main>
</body>
</html>