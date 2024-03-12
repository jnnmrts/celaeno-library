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

// Check if bookId is set in the POST request
if (isset($_POST['bookId'])) {
    // Sanitize input to prevent SQL injection
    $bookId = $conn->real_escape_string($_POST['bookId']);

    // Query to get book details based on bookId
    $sql = "SELECT * FROM books WHERE id = '$bookId'";
    $result = $conn->query($sql);

    if ($result) {
        // Check if any rows are returned
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Prepare response as an associative array
            $response = array(
                'status' => 'success',
                'data' => $row
            );

            // Send JSON response
            echo json_encode($response);
        } else {
            // Book with the provided ID not found
            $response = array(
                'status' => 'error',
                'message' => 'Book not found for the given ID'
            );

            // Send JSON response
            echo json_encode($response);
        }
    } else {
        // Error in the SQL query
        $response = array(
            'status' => 'error',
            'message' => 'Error executing the query'
        );

        // Send JSON response
        echo json_encode($response);
    }

    // Close database connection
    $conn->close();
} else {
    // If bookId is not set in the POST request
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request. BookId is not set.'
    );

    // Send JSON response
    echo json_encode($response);
}
?>
