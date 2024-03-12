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

// Get user ID from POST request
$userId = $_POST['userId'];

// Perform the update in your user table
$sql = "UPDATE user_data SET status = 'accepted' WHERE id = $userId";

$response = array();

if ($conn->query($sql) === TRUE) {
    $response = ['status' => 'success', 'message' => 'User updated successfully'];
} else {
    $errorMessage = 'Error updating user: ' . $conn->error;
    $response = ['status' => 'error', 'message' => $errorMessage];

    // Log the specific error
    error_log($errorMessage);

    // Add debugging statements
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>