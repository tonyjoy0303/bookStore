<?php
include 'db_config.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Books</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh;">

    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); width: 80%; max-width: 900px; text-align: center;">
        <h2 style="color: #4CAF50; margin-bottom: 20px;">Books List</h2>
        
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead style="background-color: #4CAF50; color: white;">
                <tr>
                    <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Title</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Author</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td style='padding: 10px; border: 1px solid #ddd;'>".$row['id']."</td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>".$row['title']."</td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>".$row['author']."</td>
                                <td style='padding: 10px; border: 1px solid #ddd;'>
                                    <a href='update_book.php?id=".$row['id']."' style='color: #4CAF50; text-decoration: none; font-weight: bold;'>Update</a> | 
                                    <a href='delete_book.php?id=".$row['id']."' style='color: red; text-decoration: none; font-weight: bold;'>Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' style='padding: 10px; text-align: center;'>No books found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="dashboard.php" style="color: #4CAF50; text-decoration: none; font-weight: bold; border: 1px solid #4CAF50; padding: 10px 20px; border-radius: 5px; background-color: white; cursor: pointer;">Back to Dashboard</a>
    </div>

</body>
</html>
