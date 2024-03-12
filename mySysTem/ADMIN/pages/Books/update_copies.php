<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the book ID and new copies value from the POST data
    $bookId = $_POST['bookId'];
    $newCopiesValue = $_POST['newCopies'];

    // Sanitize input if needed
    $bookId = mysqli_real_escape_string($conn, $bookId);
    $newCopiesValue = mysqli_real_escape_string($conn, $newCopiesValue);

    // Perform the database update
    $sql = "UPDATE books SET Copies = '$newCopiesValue' WHERE id = '$bookId'";
    
    if ($conn->query($sql) === TRUE) {
        echo 'Copies updated successfully';
    } else {
        echo 'Error updating copies: ' . $conn->error;
    }
} else {
    echo 'Invalid request method';
}

// Close the database connection
$conn->close();
?>
