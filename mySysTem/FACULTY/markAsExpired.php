
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

// Get user ID from the POST request
$request_id = $_POST['request_id'];

// Update the 'borrowed_date' to 'Expired' for the given user ID
$sql = "UPDATE `request` SET `borrowed_date` = 'Expired' WHERE `id` = '$request_id'";

if ($conn->query($sql) === TRUE) {
    // Success response
    echo json_encode(["success" => true]);
} else {
    // Error response
    echo json_encode(["success" => false, "error" => $conn->error]);
}

// Close the database connection
$conn->close();
?>


