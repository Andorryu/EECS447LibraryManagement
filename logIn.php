<?php
    // errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    print(var_dump($_POST));

    /*
    if ($_POST != []){
        $conn = mysqli_connect('localhost', 'root', 'password', 'LMS') or die('Could not connect to the database');

        $email = $_POST['email'];
        $password = $_POST['password'];
        echo var_dump($email);
        $query = "select LID from Librarian where email='$email' and password='$password';";
        $result = mysqli_query($conn, $query);
        echo "Testing query: '$query'";
        print(var_dump(mysqli_fetch_array($result)));
    
        // database
        mysqli_close($conn);
    }*/
?>