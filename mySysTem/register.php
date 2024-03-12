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

// Retrieve data from POST request
$name = $_POST['name'];
$password = $_POST['password'];
$username = $_POST['username'];
$studentId= $_POST['studentId'];
$email = $_POST['email'];
$trackStrand= $_POST['trackStrand'];
$status = "pending";


// Hash the password (for better security, consider using password_hash())
$hashedPassword = md5($password);

// Insert data into the database
$sql = "INSERT INTO user_data ( id,name, password,username,studentId,email,trackStrand,status) VALUES ('','$name', '$hashedPassword','$username','$studentId','$email','$trackStrand','$status')";

if ($conn->query($sql) === TRUE) {
    echo "User registered successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
