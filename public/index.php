
<?php 
session_start(); 

//require_once __DIR__ . '/../config/database.php';
//require_once __DIR__ . '/../models/User.php';

//$DB = new Database();
//$DB_Conn = $DB->connect();



if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["sent"])){
    $Email = trim($_POST["email"]);
    $Pass = $_POST["pass"];

    if(empty($Email)){
        echo "Email cannot be empty";
    }

    if(empty($Pass)){
        echo "Password cannot be empty";
    }

    //else{}
    
    //Creating DB connection
    $user = new Database();
    $conn = $user->connect();

    //Querying the DB
    $sql = "SELECT * FROM users where email = :email"; // The statement/sql query retrieving the email and passwords
    $statement = $conn->prepare($sql);  
    
    //binding
    $statement->bindParam(":email", $Email, PDO::PARAM_STR);
    
    //executing
    $statement->execute();
    $Result = $statement->fetchAll();

    if($statement->rowCount() == 0){                      // checks if there are any rows returned from the DB query, rows containing email and password
        echo "Invalid username or password";
        exit;
    }

    if(password_verify($Pass,$CleanUserData["password"])){   // verify that the password entered during login matches as the hashed password in the DB
        session_start();                                                    //Start a session to store and remember the user's details
        $_SESSION["User_Email"] = $Email;
        $_SESSION["logged_in"] = true;
        header("Location: dashboard.php");                          //If password matches redirect to dashboard page
    }

    else{
        echo "Invalid username or password";
        exit;
    }




    
    

    /*
    if(!empty($Email && $Pass)){
        if($Email === $CleanUserData["email"] && $Pass === $CleanUserData["password"]){
            $_SESSION["user_id"] = 1;
            $_SESSION["Username"] = $Email;

            header("Location: dashboard.php");
            exit;
        }
    }

    else{
        echo "Invalid Username or Password";
    } */

    /*
    if($Email === $CleanUserData["email"] &&  $Pass === $CleanUserData["password"] ){
        $_SESSION["user_id"] = 1;
        $_SESSION["Username"] = $Email;

        header("Location: dashboard.php");
        exit;
    }

    else{
        $err = "Invalid Username or Password";
    } */
}
    

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




