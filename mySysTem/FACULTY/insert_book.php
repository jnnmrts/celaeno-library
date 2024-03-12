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

// Assuming you have received the data via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input data (modify as needed)
    $DDC = mysqli_real_escape_string($conn, $_POST['DDC']);
    $ISBN = mysqli_real_escape_string($conn, $_POST['ISBN']);
    $Author = mysqli_real_escape_string($conn, $_POST['Author']);
    $Category = mysqli_real_escape_string($conn, $_POST['Category']);
    $book_id = mysqli_real_escape_string($conn, $_POST['book_id']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $language = mysqli_real_escape_string($conn, $_POST['language']);
    $publication_date = mysqli_real_escape_string($conn, $_POST['publication_date']);
    $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
    $sheets = mysqli_real_escape_string($conn, $_POST['sheets']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $topic = mysqli_real_escape_string($conn, $_POST['topic']);
    $MyId = mysqli_real_escape_string($conn, $_POST['Myid']);
    $myName = mysqli_real_escape_string($conn, $_POST['myName']);

    // Get the current date in the format 'Y-m-d'
    $currentDate = date("Y-m-d");

    // SQL query to insert data into the "request" table with a status of "pending" and current date
    $sql = "INSERT INTO `request` (`DDC`, `ISBN`, `author`, `category`, `book_id`, `image`, `language`, `publication_date`, `publisher`, `sheets`, `title`, `topic`, `borrowed_date`,`name`, `MyId`, `status`) 
            VALUES ('$DDC', '$ISBN', '$Author', '$Category', '$book_id', '$image', '$language', '$publication_date', '$publisher', '$sheets', '$title', '$topic', '$currentDate','$myName', '$MyId', 'pending')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
