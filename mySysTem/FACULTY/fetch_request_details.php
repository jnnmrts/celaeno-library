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

// Get the reservation ID from the POST request
$id = $_POST['id'];

// Fetch details for the selected reservation
$sql = "SELECT * FROM request WHERE id = '$id'";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $response = ['status' => 'success', 'data' => $data];
} else {
    $response = ['status' => 'error', 'message' => 'Reservation details not found'];
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
