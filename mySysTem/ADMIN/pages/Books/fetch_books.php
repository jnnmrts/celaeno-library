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

// Fetch users with status 'pending' from the 'user' table
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

$response = array();

if ($result) {
    // Check if there are rows returned
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $response = ['status' => 'success', 'data' => $data];
    } else {
        $response = ['status' => 'error', 'message' => 'No books found'];
    }
} else {
    // Handle query error
    $response = ['status' => 'error', 'message' => $conn->error];
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
