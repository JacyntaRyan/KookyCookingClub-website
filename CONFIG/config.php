<?php
//configuration settings for this web application
//these are defined as global constants which will be available in ALL SCRIPTS, CLASSES and FUNCTIONS

define ('__DEBUG',1);  //constants are defined using the define keyword 1=true, 0=false

define ('__LOGGED_ON',0);   //this is not how login status is managed. This is just to make the example workable. Later in the module we will use SESSIONS to manage our logins.

define ('__CSS','webPages/styles/main.css');  //reference to CSS 
?>