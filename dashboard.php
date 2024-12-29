<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; height: 100vh; display: flex; justify-content: center; align-items: center;">

    <div style="text-align: center; background: white; padding: 40px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); width: 400px;">
        <h2 style="color: #4CAF50; margin-bottom: 20px;">Welcome, <?php echo $_SESSION['username']; ?></h2>
        <div style="display: flex; flex-direction: column; gap: 10px;">
            <a href="add_book.php" style="padding: 10px; color: white; background-color: #4CAF50; text-decoration: none; border-radius: 5px; text-align: center;">Add Book</a>
            <a href="view_books.php" style="padding: 10px; color: white; background-color: #4CAF50; text-decoration: none; border-radius: 5px; text-align: center;">View Books</a>
            <a href="update_book.php" style="padding: 10px; color: white; background-color:  #4CAF50; text-decoration: none; border-radius: 5px; text-align: center;">update book</a>
            <a href="delete.php" style="padding: 10px; color: white; background-color:  #4CAF50; text-decoration: none; border-radius: 5px; text-align: center;">delete book</a>


            <a href="logout.php" style="padding: 10px; color: white; background-color: red; text-decoration: none; border-radius: 5px; text-align: center;">Logout</a>
        </div>
    </div>

</body>
</html>
