<?php
require_once __DIR__ . '/../models/StockItem.php';

class StockController {

    public function StockHandler() {

        $Errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $StockName     = trim($_POST["Name"] ?? '');
            $StockPrice    = $_POST["Price"] ?? '';
            $Manufacturer  = trim($_POST["Manufacturer"] ?? '');
            $StockQuantity = $_POST["Quantity"] ?? '';
            $DateAdded     = $_POST["Date_Added"] ?? '';
            $Product       = $_POST["Product"] ?? '';

            if (empty($StockName)) {
                $Errors["Name"] = "Name cannot be empty";
            }

            if (empty($StockPrice)) {
                $Errors["Price"] = "Price is required";
            }

            if (empty($Product)) {
                $Errors["Product"] = "Please choose a product";
            }

            if (empty($StockQuantity)) {
                $Errors["Quantity"] = "Quantity is required";
            }

            if (empty($DateAdded)) {
                $Errors["Date_Added"] = "Date is required";
            }

            if (empty($Errors)) {
                $CleanData = [
                    "Name"         => trim($_POST["Name"]),
                    "Price"        => (float) $_POST["Price"],
                    "Manufacturer" => trim($_POST["Manufacturer"]),
                    "Product"      => $_POST["Product"],
                    "Quantity"     => (int) $_POST["Quantity"],
                    "Date_Added"   => trim($_POST["Date_Added"])
                ];

                $StockModel = new StockItem();
                

                if ($StockModel->CreateStock($CleanData)) {  //  if insert succeeds
                    header("Location: inventory.php");        // redirect to prevent resubmission
                    exit;
                }
            }

            return $Errors;  //  return errors if validation failed
        }
    }

    public function getAllStock() {
        $model = new StockItem();
        return $model->GetAllStock();
    }
}

?>