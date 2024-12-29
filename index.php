<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center; margin-top: 50px;">
    <h2 style="color: #4CAF50;">Login Page</h2>
    <form method="POST" action="login.php" style="display: inline-block; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <label>Username:</label><br>
        <input type="text" name="username" required style="margin-bottom: 10px; padding: 8px; width: 100%;"><br>
        <label>Password:</label><br>
        <input type="password" name="password" required style="margin-bottom: 10px; padding: 8px; width: 100%;"><br>
        <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">Login</button>
    </form>
</body>
</html>
