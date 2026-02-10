
<?php 
session_start();                                                             
?>
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
    <form action="database.sql" method="POST">
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




