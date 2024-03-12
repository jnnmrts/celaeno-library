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

// Fetch data from the form
$title = $_POST['title'];
$author = $_POST['author'];
$ISBN = $_POST['ISBN'];
$language = $_POST['Language'];
$publisher = $_POST['Publisher'];
$date = $_POST['date'];
$category = $_POST['Category'];
$DDC = $_POST['DDC'];
$topic = $_POST['topic'];
$Copies = $_POST['Copies'];

// Handle file uploads
$imageFile = $_FILES['Image'];
$sheetsFile = $_FILES['sheets'];
$status = "Available";

// Check if files are selected
if ($imageFile['error'] == UPLOAD_ERR_OK && $sheetsFile['error'] == UPLOAD_ERR_OK) {
    $imageFileName = $imageFile['name'];
    $sheetsFileName = $sheetsFile['name'];

    // Move uploaded files to a desired directory (adjust the path as needed)
    move_uploaded_file($imageFile['tmp_name'], "uploads/" . $imageFileName);
    move_uploaded_file($sheetsFile['tmp_name'], "uploads/" . $sheetsFileName);

    // Perform the SQL query to insert data
    $sql = "INSERT INTO books (title, author, ISBN, language, publisher, publication_date, category, DDC,topic, image, sheets,availability,Copies)
            VALUES ('$title', '$author', '$ISBN', '$language', '$publisher', '$date', '$category', '$DDC',      '$topic','$imageFileName', '$sheetsFileName','$status',$Copies)";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error uploading files.";
}

// Close the database connection
$conn->close();
?>