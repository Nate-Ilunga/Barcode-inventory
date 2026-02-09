<?php

require_once __DIR__ . '/../config/database.php';

class User {
    private $db;

    public function __construct() {                     //function runs automatically when an object is created
        $this->db = (new Database())->connect();        //creates a new object from Database class, calls the connect function from Database class, a db function is returned. The connection is stored inside the User object to be reused
    }                                                   //creates a connection even before the clean data from Authcontroller is saved into a db

    public function create($CleanUserData) {    //$CleanUserData is the validated data from AuthController
        try {                                           //try because it might fail
            $query = "
                INSERT INTO users (name, email, password, role)
                VALUES (:name, :email, :password, :role)                 
            ";                                            //SQL instructions, insert a new row in the users table with name, email and password as placeholders for now not real values yet

            $stmt = $this->db->prepare($query);    //prepares the db connection. Prevents SQL injection
            $stmt->execute([                     // runs the query so now the db stores the actual name,email and password values
                ":name"     => $CleanUserData["name"],
                ":email"    => $CleanUserData["email"],
                ":password" => $CleanUserData["password"],
                ":role" => $CleanUserData["role"]
            ]);

            return "success";                                  //returns message if everything worked

        } catch (PDOException $e) {                           //if inserting fails. $e is the error message from the db
            
            if ($e->getCode() == 23000) {                     // get the code from the db and if it is 2300, the value is a duplicate
                return "duplicate";                            // user email already exists
            }
            return "Unknown error occured";                                   // if the error is NOT a duplicate, something else went wrong
        }
    }
        
}
