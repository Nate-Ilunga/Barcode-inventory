<?php
require_once __DIR__ . '/../app/controllers/StockController.php';

session_start();

if(!isset($_SESSION["user_id"])){                           //if the user is not logged in, send back to login page. Prevents unauthorized access.
    header("Location: index.php");                  //The way to tell that the user is logged is through the existence of a session, that will be used to remember them across other pages
    exit;
}


$controller = new StockController();                   //call the controller, the controller on the other side calls the model, the model fetches data from DB 
$stocks = $controller->getAllStock();                  // the controller calls it function, this function in controller returns the data from the GetAllStock function in StockItem class
//$stocks will be used on this page to display all the stock values stored in stock_item DB.

if($_SERVER["REQUEST_METHOD"]=="POST"){                  //check whether a product was created on popup and saved
   $AddStock = $controller->StockHandler();                 /*if so, the product is added by calling the CreateStock function from the StockController class */      
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

     <form action="" method="POST">
        <label><h1>Add Product</h1></label>
        <br>
        <br>
        <label>Name</label>
        
        <input type="text" name="Name" required>

        <label>Price</label>
        <input type="text" name="Price" placeholder="R">

        <br>

        <label>Manufacturer</label>
        <input type="text" name="Manufacturer">
        <label>Product type</label>
        <select name="Product">
            <option value="Electronics">Electronics</option>
            <option value="Furniture">Furniture</option>
            <option value="Clothing">Clothing / Apparel</option>
            <option value="Equipment">Equipment / Machinery</option>
            <option value="Consumable">Consumable</option>
            <option value="Other">Other</option>
        </select>
        
        <br>
        <label>Quantity</label>
        <input type="number" name="Quantity">
        <label>Date Added</label>
        <input type="date" name="Date_Added">

        <br>

        <button type="reset">Clear All</button>
        <button type="submit">Add Product</button>

     </form>

     <table border="1">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Barcode</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Manufacturer</th>
            <th>Date Added</th>
        </tr>

        <!---$stocks was returned from StockController, it contains a function(called getAllStock. getAllStock is a function that also calls a function from StockItem) that gets/fetches all the stock from the DB-->
        <?php if(!empty($stocks)): ?>                        <!--first check that there's stock in DB,-->
            <?php foreach($stocks as $products): ?>         <!--The stock in the DB is returned as an array and we loop through each to display in table-->
                                                            <!--the stock in variable model are assigned to variable product-->
        <tr>                                               <!--Displays rows containing -->
            <td> 
                <?php echo htmlspecialchars($products["Name"]); ?>  <!--displaying the actual stock values stored in the DB columns.-->
            </td>                                                          <!--$products["Name"] represents the column names from the DB table -->
            <td>
                <?php echo htmlspecialchars($products["Price"]); ?>     <!--to prevent XSS, htmlspecialchars() is used to not trust direct user input.-->
            </td>
            <td>
                
            </td>
            <td>
                <?php echo htmlspecialchars($products["Product"]); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($products["Quantity"]); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($products["Manufacturer"]); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($products["Date_Added"]); ?>
            </td>
        </tr>
         <?php endforeach; ?>

         <!--If there is no stock/product added, display empty table:-->

        <?php else: ?>
            <tr>
                <td colspan="7"> No stock found.</td>
            </tr>
        <?php endif; ?>

     </table>


</body>
</html>