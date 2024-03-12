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

// Fetch parameters
$category = isset($_GET['category']) ? $_GET['category'] : '';
$searchText = isset($_GET['searchText']) ? $_GET['searchText'] : '';

// SQL query
$sql = "SELECT id,Copies,availability,topic, image FROM books";
$conditions = [];

if (!empty($category)) {
    $conditions[] = "category LIKE ?";
}
if (!empty($searchText)) {
    $conditions[] = "topic LIKE ?";
}

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}

$stmt = $conn->prepare($sql);

if (false === $stmt) {
    die("Error preparing statement: " . htmlspecialchars($conn->error));
}

// Bind parameters dynamically
$bindTypes = '';
$params = [];

if (!empty($category)) {
    $bindTypes .= 's'; // type string
    $params[] = '%' . $category . '%';
}
if (!empty($searchText)) {
    $bindTypes .= 's'; // type string
    $params[] = '%' . $searchText . '%';
}

if (!empty($params)) {
    $stmt->bind_param($bindTypes, ...$params);
}

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Fetching data
$books = $result->fetch_all(MYSQLI_ASSOC);

// Return as JSON
header('Content-Type: application/json');
echo json_encode($books);

$stmt->close();
$conn->close();
?>
