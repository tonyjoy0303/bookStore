<?php
include 'db_config.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM books WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $message = "Book deleted successfully";
        $messageType = "success";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Book</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh;">

    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); width: 400px; text-align: center;">
        
        <?php if (isset($message)): ?>
            <div style="color: <?= $messageType == 'success' ? 'green' : 'red' ?>; font-weight: bold; margin-bottom: 20px;">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <a href="view_books.php" style="color: #4CAF50; text-decoration: none; font-weight: bold; border: 1px solid #4CAF50; padding: 10px 20px; border-radius: 5px; background-color: white; cursor: pointer;">Back to Books List</a>
    </div>

</body>
</html>
