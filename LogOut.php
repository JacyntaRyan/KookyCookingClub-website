<?php
//Jacynta Ryan
//destroys the session and redirects to home page
session_start();
                session_destroy();
                header("Location: index.php");
                
?>