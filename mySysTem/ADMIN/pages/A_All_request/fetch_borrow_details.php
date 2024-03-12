<?php
// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Get the reservation ID from the POST request
$borrow_id = isset($_POST['borrow_id']) ? $_POST['borrow_id'] : null;

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM request WHERE id = ?");
$stmt->bind_param("s", $borrow_id);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Initialize response array
$response = array();

// Check if rows were returned
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $response = ['status' => 'success', 'data' => $data];
} else {
    $response = ['status' => 'error', 'message' => 'Reservation details not found'];
}

// Close the statement
$stmt->close();

// Close the database connection
$conn->close();

// Return the response as JSON without debugging statements
header('Content-Type: application/json');
echo json_encode($response);
?>
