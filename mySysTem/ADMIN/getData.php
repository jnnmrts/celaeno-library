<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$dbname = "portal";

try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to get counts
    $booksCount = $pdo->query('SELECT COUNT(*) FROM books')->fetchColumn();
    $user_dataCount = $pdo->query('SELECT COUNT(*) FROM user_data')->fetchColumn();
    $requestCount = $pdo->query('SELECT COUNT(*) FROM request')->fetchColumn();

    // Close the database connection
    $pdo = null;

    // Prepare data for JSON response
    $data = array(
        'books' => $booksCount,
        'user_data' => $user_dataCount,
        'borrow' => $requestCount
    );

    // Set the HTTP header to JSON
    header('Content-Type: application/json');

    // Send JSON response
    echo json_encode($data);
} catch (PDOException $e) {
    // Handle database connection errors
    echo json_encode(array('error' => 'Database connection error: ' . $e->getMessage()));
}
?>
