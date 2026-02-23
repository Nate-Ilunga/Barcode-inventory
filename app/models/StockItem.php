<?php

require_once __DIR__ . '/../config/database.php';

class StockItem{

    private $conn;                   // property storing the connection for later use
    public function __construct(){      //Connecting to the database
        $DB = new Database();
        $this->conn = $DB->connect();
    }
    
    function GetAllStock(){      
        $sql = "SELECT * FROM stock_item";
        $statement =  $this->conn->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);  
    }

    function CreateStock($data){
        $sql = "INSERT INTO stock_item(Name, Price, Manufacturer, Quantity, Date_Added)
        VALUES(:Name, :Price, :Manufacturer, :Quantity, :Date_Added)";
        $statement = $this->conn->prepare($sql);

        //bind params
        $statement->bindParam(":Name", $StockName, PDO::PARAM_STR);
        $statement->bindParam(":Price", $StockPrice, PDO::PARAM_FLOAT);
        $statement->bindParam(":Manufacturer", $Manufacturer, PDO::PARAM_STR);
        $statement->bindParam(":Quantity", $StockQuantity, PDO::PARAM_INT);
        $statement->bindParam(":Date_Added", $DateAdded, PDO::PARAM_STR);

        //executing:
        $statement->execute();
    }
    function UpdateStock($id, $data) {
        $StockInDb = $data->prepare("SELECT * FROM stock_item WHERE id = ?");

        $StockInDb->execute([$id]);
        $stockData = $StockInDb->fetch(PDO::FETCH_ASSOC);

        $NewStockName = trim($_POST["Name"]);
        $NewStockPrice = (float)$_POST["Price"];
        $NewStockManu = trim($_POST["Manufacturer"]);
        $NewStockQuantity = (int)$_POST["Quantity"];
        $NewStockDate = trim($_POST["Date_Added"]);

        if ($NewStockName !== $stockData["Name"]) {
            // Use prepared statement with parameter binding
            $sql = "UPDATE stock_item SET Name = ? WHERE id = ?";
            $statement = $data->prepare($sql);
            $statement->execute([$NewStockName, $id]);
        }

        if ($NewStockPrice !== $stockData["Price"]) {
            // Use prepared statement with parameter binding
            $sql = "UPDATE stock_item SET Price = ? WHERE id = ?";
            $statement = $data->prepare($sql);
            $statement->execute([$NewStockPrice, $id]);
        }

        if ($NewStockManu !== $stockData["Manufacturer"]) {
            // Use prepared statement with parameter binding
            $sql = "UPDATE stock_item SET Manufacturer = ? WHERE id = ?";
            $statement = $data->prepare($sql);
            $statement->execute([$NewStockManu, $id]);
        }

        if ($NewStockQuantity !== $stockData["Quantity"]) {
            // Use prepared statement with parameter binding
            $sql = "UPDATE stock_item SET Quantity = ? WHERE id = ?";
            $statement = $data->prepare($sql);
            $statement->execute([$NewStockQuantity, $id]);
        }

        if ($NewStockDate !== $stockData["Date_Added"]) {
            // Use prepared statement with parameter binding
            $sql = "UPDATE stock_item SET Date_Added = ? WHERE id = ?";
            $statement = $data->prepare($sql);
            $statement->execute([$NewStockDate, $id]);
        }
    }
    function delete($id){
        $sql = "DELETE FROM stock_item WHERE id = :id";
        $statement = $this->conn->prepare($sql);
        return $statement->execute([":id"=>$id]);
    }
}





?>