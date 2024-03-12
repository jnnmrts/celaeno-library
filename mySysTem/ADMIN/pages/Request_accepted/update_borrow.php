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

// Check if the borrowed_id is set in the POST request
if (isset($_POST['borrowed_id'])) {
    // Sanitize the input to prevent SQL injection
    $borrowed_id = $conn->real_escape_string($_POST['borrowed_id']);

    // Update the status and borrowed_date in the "request" table
    $sql = "UPDATE request SET status = 'received', borrowed_date = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("i", $borrowed_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Return a success message
        $response = array('status' => 'success', 'message' => 'Status and borrowed_date updated successfully');
    } else {
        // Return an error message
        $response = array('status' => 'error', 'message' => 'Error updating status and borrowed_date: ' . $stmt->error);
    }

    // Close the statement
    $stmt->close();
} else {
    // Return an error message if borrowed_id is not set
    $response = array('status' => 'error', 'message' => 'No borrowed_id provided');
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
