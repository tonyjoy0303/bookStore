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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $id = $_POST['id'];  // Book ID entered manually
    $title = $_POST['title'];  // New Title
    $author = $_POST['author'];  // New Author

    // Check if book ID exists
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);  // Bind ID as integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Book found, proceed with the update
        $sql = "UPDATE books SET title = ?, author = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $author, $id);  // Bind title, author, and ID
        if ($stmt->execute()) {
            $message = "Book updated successfully!";
            $messageType = "success";
        } else {
            $message = "Error updating book: " . $stmt->error;
            $messageType = "error";
        }
    } else {
        $message = "Book with the given ID not found.";
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh;">

    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); width: 400px; text-align: center;">
        <h2 style="color: #4CAF50; margin-bottom: 20px;">Update Book</h2>
        
        <!-- Display success or error message -->
        <?php if (!empty($message)): ?>
            <div style="color: <?= $messageType == 'success' ? 'green' : 'red' ?>; font-weight: bold; margin-bottom: 20px;">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <!-- Form to update Book ID, Title, and Author -->
        <form method="POST" action="" style="display: flex; flex-direction: column; gap: 15px;">
            <!-- Book ID Field (User enters manually) -->
            <label for="id" style="text-align: left; font-weight: bold;">Book ID:</label>
            <input type="text" id="id" name="id" required style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; width: 100%;">

            <!-- Title Field -->
            <label for="title" style="text-align: left; font-weight: bold;">Title:</label>
            <input type="text" id="title" name="title" required style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; width: 100%;">

            <!-- Author Field -->
            <label for="author" style="text-align: left; font-weight: bold;">Author:</label>
            <input type="text" id="author" name="author" required style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; width: 100%;">

            <!-- Submit Button -->
            <button type="submit" style="padding: 10px; color: white; background-color: #4CAF50; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Update Book</button>
        </form>
        
        <br>
        <a href="dashboard.php" style="color: #4CAF50; text-decoration: none; font-weight: bold; border: 1px solid #4CAF50; padding: 10px 20px; border-radius: 5px; background-color: white; cursor: pointer;">Back to Dashboard</a>
    </div>

</body>
</html>
