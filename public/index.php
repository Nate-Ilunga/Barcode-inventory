<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> | Login in | </title>
</head>
<body>
    <?php

if(isset($_SESSION["Registr_Success_Msg"])){
    echo "<p style='color:green'>" . $_SESSION["Registr_Success_Msg"] .   "</p>"; 
    unset($_SESSION["Registr_Success_Msg"]);            
}

?>
    <h1>Welcome</h1>
    <p>Please login to your account.</p>
    <form action="" method="POST">
        <label>Enter email:</label>
        <br>
        <input type="email" required name="email" placeholder="mikerafone@gmail.com">
        <br>
        <br>
        <label>Enter password:</label>
        <br>
        <br>
        <input type="password" required name="pass" placeholder="  ***********">
        <br>
        <br>
        <button type="submit" name="sent" > Login </button>
    </form>  
</body>
</html>

<?php 
//session_start(); 

require_once __DIR__ . '/../app/controllers/AuthController.php';

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["sent"])){
    $Controller = new AuthController();    // creating an object from Auth class to handle the login logic and do all the validation(because Auth is where the login and sign up login occurs)
    $response = $Controller->login();     //AuthController class contains a method that will handle the authentication
                                        //login function will also return all the error logins as an array to response variable, so that they can be displayed using a loop

    if(!empty($response)){
        foreach((array)$response as $LognErr){
            echo "<br>". "<p style='color:red'>" . htmlspecialchars($LognErr) . "<br>";
        }
    }
}                               

?>



