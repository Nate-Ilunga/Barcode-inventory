<?php

session_start();

if(!isset($_SESSION["user_id"])){                           //if the user is not logged in, send back to login page. Prevents unauthorized access.
    header("Location: index.php");                  //The way to tell that the user is logged is through the existence of a session, that will be used to remember them across other pages
    exit;
}

?>