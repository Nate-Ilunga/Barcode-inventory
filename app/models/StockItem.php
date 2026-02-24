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

        $StockName = $data["Name"];
        $StockPrice = $data["Price"];
        $Manufacturer = $data["Manufacturer"];
        $StockQuantity = $data["Quantity"];
        $DateAdded = $data["Date_Added"];


        //bind params
        $statement->bindParam(":Name", $StockName, PDO::PARAM_STR);
        $statement->bindParam(":Price", $StockPrice);
        $statement->bindParam(":Manufacturer", $Manufacturer, PDO::PARAM_STR);
        $statement->bindParam(":Quantity", $StockQuantity, PDO::PARAM_INT);
        $statement->bindParam(":Date_Added", $DateAdded, PDO::PARAM_STR);

        //executing:
        return $statement->execute();
    }
    
    function UpdateStock($id,$data){
        $statement = $this->conn->prepare("SELECT * FROM stock_item WHERE id = :id");
        $statement->execute([":id" => $id]);
        $current = $statement->fetch(PDO::FETCH_ASSOC);
        
        if(!$current){
            return false;
        }

        $fieldsToUpdate = [];
        $params = [":id" => $id];

        foreach ($data as $field => $value){
            if ($current[$field] != $value){
                $fieldsToUpdate[] = "$field = :$field";
                $params[":$field"] = $value;
            } 
        }

        if(empty($fieldsToUpdate)){
            return true;
        }

        $sql = "UPDATE stock_item SET ". implode(", ", $fieldsToUpdate) . " WHERE id = :id";
        $updateStmt = $this->conn->prepare($sql);
        return $updateStmt->execute($params);

    }

    function DeleteStock($id){
        $sql = "DELETE FROM stock_item WHERE id = :id";
        $statement = $this->conn->prepare($sql);
        return $statement->execute([":id"=>$id]);
    }
}





?>