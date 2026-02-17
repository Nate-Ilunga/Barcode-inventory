<?php

session_start();

if(!isset($_SESSION["user_id"])){                           //if the user is not logged in, send back to login page. Prevents unauthorized access.
    header("Location: index.php");                  //The way to tell that the user is logged is through the existence of a session, that will be used to remember them across other pages
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <style>
        *{
            box-sizing: border-box; 
            margin: 0; 
            padding: 0;
        }

        body{
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(90deg, #787676 0%, #797878 100%);
        }

        .Navbar{
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            
            color: #f5f5f5;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
        }


        .Navbar-name{
            color: #ffffff;
            font-size: 20px;
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        .Navbar-title{
            color: #ffffff;
            font-size: 20px;
            font-weight: 600;
        }

        .Navbar-user{
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ffffff;
            font-size: 20px;
        }

        .user-avatar{
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255,255,255,0.25);
            border: 2px solid rgba(255,255,255,0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 300;

        }


    </style>
</head>
<body>
    <nav class="Navbar">
        <div class="Navbar-name">RF-Inventory</div>

        <div class="Navbar-title">All Inventory</div>

        <div class="Navbar-user">
            <div class="user-avatar"> 👤 </div>
            <span><?php echo $_SESSION["Username"] ?></span>
        </div>
    </nav>
</body>
</html>