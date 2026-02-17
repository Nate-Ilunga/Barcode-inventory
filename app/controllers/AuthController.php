<?php
session_start();                                     // stores and remembers the success confirmation msg that will be displayed on the login page

require_once __DIR__ . '/../models/User.php';

class AuthController {

    //The function register handles the sign up
    public function register($data) {         //$data is the same thing as $_POST but renamed, in the function it became a parameter since globals like $_POST aren't allowed
        $errors = [];
        $hashed_password = null;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {                 //if the form was submitted, store the entered values into the corresponding variables
            $Name  = trim($data["name"] ?? '');
            $Email = trim($data["email"] ?? '');
            $Pass  = $data["pass"] ?? '';
            $Role  = trim($data["Role"] ?? '');

            
            if (empty($Name)) {
                $errors['name'] = "Name is required";
            }

           
            if (empty($Email)) {
                $errors['email'] = "Email is required";
            } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format";
            }

            
            if (empty($Pass)) {
                $errors['password'] = "Password is required";
            } else {
                $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
                if (!preg_match($pattern, $Pass)) {
                    $errors['password'] = "Password must contain at least one lowercase letter, one uppercase letter, one digit, one special character, and be at least 8 characters long";
                }
            }

            
            if (empty($Role)) {
                $errors['role'] = "Role is required";
            } elseif (!in_array($Role, ["Admin", "User"])) {
                $errors['role'] = "Invalid role selected";
            }

            // If no errors, proceed
            if (empty($errors)) {
                $hashed_password = password_hash($Pass, PASSWORD_DEFAULT);

                //creating clean that will be passed and saved to User.php(the user model)
                //The clean data is the validated data from above 

                $CleanUserData = [
                    "name"     => $Name,
                    "email"    => $Email,
                    "password" => $hashed_password,
                    "role"     => $Role
                ];

                //calls the User model to save CleanData by creating objet from User class

                $user = new User();
                $result = $user->create($CleanUserData);  //The function from the User class, called create, is passed the clean data, which is inserted&saved into the user db table.



                if ($result === "success") {
                    
                    $_SESSION["Registr_Success_Msg"] = "Congratulations! You’ve successfully registered.";   
                    header("Location: index.php");   // redirect to login page, after successful insertion of user data into db
                    exit;
                }

                if ($result === "duplicate") {
                    $errors['general'] = "User already exists";
                } else {
                    $errors['general'] = "Something went wrong";
                }
            }

            // Sends back lists of errors collected
            return $errors;
        }
       
    }
    // the function login handles the login, compares whether credentials match, redirects to dashboard or displays error message
    public function login(){
        $LoginError = [];
        $email = trim($_POST["email"] ?? '');
        $pass = $_POST["pass"] ?? '';

        if(empty($email)){
            $LoginError[] = "Email cannot be empty";
        }

        if(empty($pass)){
            $LoginError[] = "Password cannot be empty";
        }

        if(!empty($LoginError)){
            return $LoginError;
        }

        

        //DB connection and the querying
        $UserModel = new User();
        $user = $UserModel->findByEmail($email);  // fetching the email entered on login from DB


       if(!$user){                                      //if no user was found
        return ["Invalid username or password"];   // returned to the $LoginError array that will be displayed on the login page
       }

       if(!password_verify($pass,$user["Password"])){
        return ["Invalid credentials"];             // returned to the $LoginError array that will be displayed on the login page
       }

       else{                                            //else in case the password matches:
        $_SESSION["user_id"] = 1;                       // 
        $_SESSION["Username"] = $email;
        header("Location: inventory.php");
        exit;
       }

       /*I cant add return $LoginError like in the function register 
       because there's a redirection using the header function,so anything
       anything after the header and exit lines doesn't run. In this case
       the errors are returned to the $LoginError array and this 
       array is accessed on index.php by calling the Auth class
       and the login() function.
       
       */

    }


}
