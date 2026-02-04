<?php

//creating a database connection

class Database {                                   //creating a db class so it's reusable
                                                  // only visible to this class
    private $host = "localhost";                  //where the db is located
    private $db   = "InventoryDB";           //name of the db
    private $user = "root";                        //defaut db username
    private $pass = "";                            

    
    public function connect() {
        try {                                       // try even if it fails
            return new PDO(                         //creates new db connection using PHP built db tool -PDO
                "mysql:host={$this->host};dbname={$this->db}",  //db type, where it lives and which db. Use the host and db in this object
                $this->user,                           // db username taken from the class
                $this->pass,                           // db pass taken from class
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]   // if something goes wrong, give an ERROR
            );
        } catch (PDOException $e) {                                     //if anything fails inside
            die("Database connection failed");                          //terminate the entire program and display that message
        }
    } 
}
