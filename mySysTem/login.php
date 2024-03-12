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

// Get username and password from the POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password using md5 (not recommended for production)
$hashedPassword = md5($password);



// Query to check if the user is an admin
$adminQuery = "SELECT id, username FROM admin WHERE username='$username' AND password='$hashedPassword'";
$adminResult = $conn->query($adminQuery);

// Query to check if the user is a regular user
$userQuery = "SELECT id, username FROM user_data WHERE username='$username' AND password='$hashedPassword' AND status='accepted'";
$userResult = $conn->query($userQuery);


// Check the results and return the user type
if ($adminResult->num_rows > 0) {
    echo json_encode(['userType' => 'admin']);
} elseif ($userResult->num_rows > 0) {
  $userRow = $userResult->fetch_assoc();
  echo json_encode(['userType' => 'user', 'userID' => $userRow['id'], 'userName' => $userRow['username']]);
} else {
    echo json_encode(['userType' => 'invalid']  );
}

// Close the database connection
$conn->close();
?>
