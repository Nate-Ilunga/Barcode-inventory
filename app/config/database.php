<?php
class Database {
    private $host = "localhost";                                              //where db is located            
    private $db   = "inventorydb";                                             //name of the db
    private $user = "root";                                                     // default db username
    private $pass = "";                                                         //db password
    private $port = 3307;                                                   
    
    public function connect() {                               //function to connect to db

        try {                                                       //try even though it might fail                                          
            
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db}";    //Build connection string with all info above  
            
                                                                                        
            $pdo = new PDO(                                                                //create actual connection using PDO(PHP's db tool) and stores
                $dsn,                                                               // connection string we just built
                $this->user,                                                    //db username taken from the class
                $this->pass,                                                    //db pass taken from class
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]                      // if something goes wrong, give an ERROR
            );
            
            return $pdo;                                                                    //Send back the connection so other code can use it
            
        } catch (PDOException $e) {                                                         //if anything fails inside, catch the error
            die("Database connection failed: " . $e->getMessage());                         // terminate the entire program and display message
        }
    } 
}