<?php
include 'db_config.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Initialize message and message type
$message = "";
$messageType = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the book ID entered by the user
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];

        // Prepare the SQL to check if the book ID exists
        $checkSql = "SELECT * FROM books WHERE id = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("i", $id);  // Bind the book ID as an integer
        $stmt->execute();
        $result = $stmt->get_result();

        // If the book exists, delete it
        if ($result->num_rows > 0) {
            // Prepare SQL to delete the book
            $sql = "DELETE FROM books WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);  // Bind the book ID as an integer

            if ($stmt->execute()) {
                $message = "Book deleted successfully.";
                $messageType = "success";
            } else {
                $message = "Error deleting the book: " . $conn->error;
                $messageType = "error";
            }
        } else {
            $message = "Book with ID $id not found.";
            $messageType = "error";
        }
    } else {
        $message = "Please enter a valid Book ID.";
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
        
        <!-- Display success or error message -->
        <?php if (!empty($message)): ?>
            <div style="color: <?= $messageType == 'success' ? 'green' : 'red' ?>; font-weight: bold; margin-bottom: 20px;">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <!-- Deletion form -->
        <form method="POST" action="">
            <label for="id" style="text-align: left; font-weight: bold;">Enter Book ID to Delete:</label>
            <input type="text" id="id" name="id" required style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; width: 100%;">

            <br><br>
            <button type="submit" style="padding: 10px 20px; background-color: red; color: white; border: none; border-radius: 5px; cursor: pointer;">Delete Book</button>
        </form>

        <br>
        <a href="view_books.php" style="color: #4CAF50; text-decoration: none; font-weight: bold; border: 1px solid #4CAF50; padding: 10px 20px; border-radius: 5px; background-color: white; cursor: pointer;">Back to Books List</a>
    </div>

</body>
</html>
