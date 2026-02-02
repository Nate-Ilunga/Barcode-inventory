<?php

require_once "User.php"; // loads the User class from User.php into this file once only.

$errors = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){                   //if the form was submitted, store the entered values into the corresponding variables
    $Name = trim($_POST["name"]);
    $Email = trim($_POST["email"]);
    $Pass = trim($_POST["pass"]);
    $Role = trim($_POST["Role"]);
    
    if(empty($Name)){
        $errors[] = "Name is required";
    }

    if(empty($Email)){
        $errors[] = "Email is required";
    }

    elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)){
       $errors[] = "Invalid email";
    }

    if(empty($Role)){
        $errors[] = "Choose a role";
    }
    elseif(!in_array($Role,["admin","user","manager"])){
        $errors[] =  "Invalid role selected";
    }

    if(empty($Pass)){
        $errors[] = "Password is required";
    }

    else{
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        if(!preg_match($pattern,$Pass)){
            $errors[] = "Password requires at least one lowercase letter, one uppercase letter, one digit, minimum 8 characters total";
        }
    }

    if(empty($errors)){
    $hashed_password = password_hash($Pass, PASSWORD_DEFAULT);
    }

    //creating clean that will be passed and saved to User.php(the user model)
    //The clean data is the validated data from above 

    $CleanUserData  = [
        "name" => $name,
        "email" => $email,
        "password" => $hashed_password
    ];


    


    
}



?>