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

// Fetch requests for a specific user based on their ID and order by 'status' and 'publication_date'
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $myID = mysqli_real_escape_string($conn, $_GET['myID']);

    // Use a prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM request WHERE MyId = ? AND status IN ('accepted', 'received') ORDER BY borrowed_date");


    $stmt->bind_param("s", $myID);
    $stmt->execute();

    $result = $stmt->get_result();

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
            $response = ['status' => 'error', 'message' => 'No requests found for the specified user ID'];
        }
    } else {
        // Handle query error
        $response = ['status' => 'error', 'message' => $conn->error];
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Invalid request method
    $response = ['status' => 'error', 'message' => 'Invalid request method'];
}

// Close the database connection
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
