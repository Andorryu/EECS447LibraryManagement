<?php
    include 'creds.php';
// Connect to the database
    $conn = mysqli_connect($server_, $username_, $password_, $database_);

// Retrieve the ID parameter from the form submission
$id = $_POST['isbn'];

// Execute the SQL DELETE query to delete the row with the specified ID
mysqli_query($conn, "DELETE FROM Book WHERE ISBN = '$id'");

// Close the database connection
mysqli_close($conn);

echo "Book has been deleted from the database";
?>
