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

        .controls-bar{
            background: rgba(135, 134, 134, 0.28);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.3);
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            gap: 16px;
        }

        .controls-left{
            
            display: flex;
            align-items: center;
            gap: 12px;

        }

        .control-btn{
            background: rgba(135, 134, 134, 0.28);
            border: 1px solid #d0d0d0;
            padding: 9px 18px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #ffffff;
            transition: all 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .control-btn:hover{
            background: #211f1f;
            border-color: #aaa;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(0,0,0,0.12);
        }

        .control-btn:active{
            transform: translateY(0);
        }

        
        .search-bar{
            flex: 1;
            max-width: 1000px;
            padding: 10px 16px 10px 42px;
            border: 1px solid #d0d0d0;
            border-radius: 7px;
            font-size: 16px;  /* Increased from 14px */
            background: #919191 url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%23ffffff' stroke-width='2'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='m21 21-4.35-4.35'/%3E%3C/svg%3E") 14px center no-repeat;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            transition: all 0.2s;
            color: white;
        }

        /* White placeholder text */
        .search-bar::placeholder{
            color: white;
            font-size: 16px;
            opacity: 0.8;  
        }

        .search-bar:focus{
            outline: none;
            border-color: #888;
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }

        .add-inventory-btn{
            background: linear-gradient(135deg, #2980b9 0%, #21618c,#211f1f 100%);
            color: #ffffff;
            border: none;
            padding: 10px 24px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 6px rgba(52,152,219,0.3);
            transition: all 0.2s;

        }

        .add-inventory-btn:hover{
            background: linear-gradient(135deg, #399f20 0%, #8a8888, #399f20 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(38, 97, 137, 0.4);
        }

        .add-inventory-btn:active{
            transform: translateY(0);
        }

        .icon{
            font-size: 16px;
        }


    </style>
</head>
<body>
    <!--Top navigation bar -->
    <nav class="Navbar">
        <div class="Navbar-name">RF-Inventory</div>

        <div class="Navbar-title">All Inventory</div>

        <div class="Navbar-user">
            <div class="user-avatar"> 👤 </div>
            <span><?php echo $_SESSION["Username"] ?></span>
        </div>
    </nav>

    <!-- second bar -->
     <div class="controls-bar">

        <div class="controls-left">
            <button class="control-btn">
                <span class="icon">⚙️</span>
                Filter
            </button>
            <button class="control-btn">
                <span class="icon">↕️</span>
                Sort
            </button>
            <button class="control-btn">
                <span class="icon">☰</span>
                Columns
            </button>
        </div>
        
        <input type="text" class="search-bar" placeholder="Search...">

        <button class="add-inventory-btn">

            <span class="icon"> + </span>
            Add Inventory
        </button>
     </div>


</body>
</html>