<?php
include 'db_config.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];

    // Check if the Book ID already exists in the database
    $checkSql = "SELECT * FROM books WHERE id = '$book_id'";
    $result = $conn->query($checkSql);
    if ($result->num_rows > 0) {
        echo "<div style='color: red; text-align: center; margin-bottom: 20px;'>Error: Book ID already exists.</div>";
    } else {
        $sql = "INSERT INTO books (id, title, author) VALUES ('$book_id', '$title', '$author')";
        if ($conn->query($sql) === TRUE) {
            echo "<div style='color: green; text-align: center; margin-bottom: 20px;'>New book added successfully with ID: $book_id</div>";
        } else {
            echo "<div style='color: red; text-align: center; margin-bottom: 20px;'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; height: 100vh; display: flex; justify-content: center; align-items: center;"> 

    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); width: 400px; text-align: center;">
        <h2 style="color: #4CAF50; margin-bottom: 20px;">Add Book</h2>
        
        <form method="POST" action="" style="display: flex; flex-direction: column; gap: 15px;">
            <!-- Book ID (Manually entered) -->
            <label for="book_id" style="text-align: left; font-weight: bold;">Book ID:</label>
            <input type="text" id="book_id" name="book_id" required style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; width: 100%;">

            <!-- Title Field -->
            <label for="title" style="text-align: left; font-weight: bold;">Title:</label>
            <input type="text" id="title" name="title" required style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; width: 100%;">
            
            <!-- Author Field -->
            <label for="author" style="text-align: left; font-weight: bold;">Author:</label>
            <input type="text" id="author" name="author" required style="padding: 10px; border: 1px solid #ddd; border-radius: 5px; width: 100%;">
            
            <!-- Submit Button -->
            <button type="submit" style="padding: 10px; color: white; background-color: #4CAF50; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Add Book</button>
        </form>
        
        <br>
        
        <!-- Back Button -->
        <a href="dashboard.php" style="color: #4CAF50; text-decoration: none; font-weight: bold;">Back to Dashboard</a>
    </div>

</body>
</html>
