<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up | Login in</title>
</head>
<body>
    <h1>Welcome back!</h1>
    <p>Please login to your account.</p>
    <form action="database.sql" method="POST">
        <label>Enter email:</label>
        <br>
        <br>
        <input type="email" required name="email" placeholder="mikerafone@gmail.com">
        <br>
        <br>
        <label>Enter password:</label>
        <br>
        <br>
        <input type="password" required name="pass" placeholder="  ***********">
        <br>
        <br>
        <button type="submit" name="sent" > Login </button>
    </form>  
</body>
</html>


