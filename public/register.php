<?php 

require_once __DIR__ . '/../app/controllers/AuthController.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {           // if the form was submitted, then we are calling the class in Authcontroller to do the validation which it does in the Authcontroller.php file on the data entered on this page
    $auth = new AuthController();                     // creates a new object from AuthController class and assigns it to variable
    $message = $auth->register($_POST);                     //This is how fom data on this page is passed/sent to AuthController     
    
                                                     // this variable calls the function from the AuthController class, which receives form input, validates, checks for empty fields, call the User model to save this data and redirects to login page if registration was valid or displays appropriate message 
}                                                     // any error message from Auth should display here

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h1>Create a new account</h1>

    <form action="" method="POST">
        <label>Enter name:</label>
        <br>
        <br>
        <input type="text" name="name" placeholder="Mike Rafone">
        <br>
        <br>
        <label>Enter email:</label>
        <br>
        <br>
        <input type="email" name="email" placeholder="mike.rafone@example.com">
        <br>
        <br>
        <label>Enter password:</label>
        <br>
        <br>
        <input type="password" name="pass" placeholder="  ***********">
        <br>
        <br>
        <label>Role:</label>
        <br>
        <select name="Role">
            <option value="User">User</option>
            <option value="Admin">Admin</option>
        </select>
        <br>
        <br>
        <button type="submit" name="sent">Sign Up</button>
        
    </form>

    

   <p>
    <?php  //Using a loop, to display each error

    if(!empty($message)){
        foreach((array)$message as $msg){
            echo htmlspecialchars($msg) . "<br>";
        }
    }
    
    
    
    ?>
   </p>
</body>
</html>



