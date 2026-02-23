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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!--Top navigation bar -->
    <nav class="Navbar">
        <div class="Navbar-name">RF-Inventory</div>

        <div class="Navbar-title">All Inventory</div>

        <div class="Navbar-user">
            <div class="user-avatar"> 👤 </div>
            <span><?php echo htmlspecialchars($_SESSION["Username"]) ?></span>
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