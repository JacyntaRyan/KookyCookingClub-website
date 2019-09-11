<?php
//Jacynta Ryan
include ('CONFIG/config.php');
include ('CONFIG/connection.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>LogInFailed</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="refresh" content="2; URL=Login.html">
    </head>
    <body>


        <?php
//connect using object oriented method - use MySQLi class
//MySQLi class : http://php.net/manual/en/class.mysqli.php
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

        $username = $_POST['user_name'];
        $password = $_POST['password'];


        $sql = "SELECT * FROM users WHERE username = '" . $username . "' ";
        $result = $db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $userType = $row['user_type'];
            $dbPassword = $row['password'];
        }

        if ($result = $db->query($sql)) {
            if ($result->num_rows <> 1) {
                $loginError = 'Invalid password';
                echo 'login fail: ' . $loginError;
                $result->free();
            } else {

//because my admins dont register their password isnt encrypted only the regular user has an encrypted password
//so if regular user it checks the passwrd matches the encryped one
//if admin it just checks the paswod matches
                if ($userType == ("user") && password_verify($password, $dbPassword)) {
                    session_start();
                    $_SESSION["user_name"] = $username;
                    header("Location: profile.php");
                } else if ($userType == ("admin") && $password == $dbPassword) {
                    session_start();
                    $_SESSION["admin_user"] = $username;
                    header("Location: AdminProfile.php");
                } else {
                    $loginError = 'Invalid password';
                    echo 'login fail: ' . $loginError;



                    $result->free();
                }
            }
        }

//end of database operations
        $db->close();
        ?>

    </body>
</html>