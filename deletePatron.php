<?php

// Connect to the database
$conn = mysqli_connect("localhost", "root", "password", "LMS");

// Retrieve the ID parameter from the form submission
$id = $_POST['PID'];

// Execute the SQL DELETE query to delete the row with the specified ID
mysqli_query($conn, "DELETE FROM Patron WHERE PID = '$id'");

// Close the database connection
mysqli_close($conn);


echo "Patron has been deleted from the database";
?>
