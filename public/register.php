<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h1>Create a new account</h1>

    <form action="AuthController.php" method="POST">
        <label>Enter name:</label>
        <br>
        <br>
        <input type="text" name="name" required placeholder="Mike Rafone">
        <br>
        <br>
        <label>Enter email:</label>
        <br>
        <br>
        <input type="email" name="email" required placeholder="mike.rafone@example.com">
        <br>
        <br>
        <label>Enter password:</label>
        <br>
        <br>
        <input type="password" name="pass" required placeholder="  ***********">
        <br>
        <br>
        <label>Role:</label>
        <br>
        <select name="Role" required>
            <option value="User">User</option>
            <option value="Admin">Admin</option>
        </select>
        <br>
        <br>
        <button type="submit" name="sent">Sign Up</button>
    </form>
</body>
</html>