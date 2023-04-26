<?php
    include 'creds.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = mysqli_connect($server_, $username_, $password_, $database_) or die("could not connect to database");
    $query = "select LID from Librarian where email='$email' and password='$password';";
    $result = mysqli_fetch_array(mysqli_query($conn, $query));
    mysqli_close($conn);

    if ($result != NULL) {
        // login successful
        header('Location: ../base.html');
    } else {
        // login unsuccessful
        header('Location: ../logIn.html');
    }

?>