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
    // Get the book ID and user ID from the POST data
    $bookId = $_POST['bookId'];
    $requestId = $_POST['requestId'];

    // Sanitize input if needed
    $bookId = mysqli_real_escape_string($conn, $bookId);
    $requestId = mysqli_real_escape_string($conn, $requestId);

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Perform the database update for the "Books" table
        $sqlUpdateBooks = "UPDATE books SET Copies = Copies + 1 WHERE id = '$bookId'";
        if ($conn->query($sqlUpdateBooks) !== TRUE) {
            throw new Exception('Error updating copies: ' . $conn->error);
        }

        // Perform the database update for the "request" table
        $sqlUpdateRequest = "UPDATE request SET status = 'return' WHERE  id = '$requestId'";
        if ($conn->query($sqlUpdateRequest) !== TRUE) {
            throw new Exception('Error updating request status: ' . $conn->error);
        }

        // Commit the transaction
        $conn->commit();

        echo 'Copies and request status updated successfully';
    } catch (Exception $e) {
        // Rollback the transaction if any errors occurred
        $conn->rollback();
        echo $e->getMessage();
    }
} else {
    echo 'Invalid request method';
}

// Close the database connection
$conn->close();
?>
