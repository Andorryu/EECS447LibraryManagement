<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    echo '<p style="text-align:center; font-size: 14px; color: rgb(164, 19, 36); font-weight: bold;">';

    if (empty($_POST['isbn'])) {
        echo 'Please input an ISBN. </p>';
        die();
    }
    elseif (empty($_POST['title'])) {
        echo 'Please input a title. </p>';
        die();
    }
    elseif (empty($_POST['author'])) {
        echo 'Please input an author. </p>';
        die();
    }
    elseif (empty($_POST['title'])) {
        echo 'Please input genres. </p>';
        die();
    }
    elseif (strlen($_POST['isbn'] != 13)) {
        echo 'ISBN must be 13 numbers long. </p>';
        die();
    }

    $conn = mysqli_connect('localhost', 'root', 'password', 'LMS');

    //check for book already in database
    $isbn = $_POST['isbn'];
    $query = "select ISBN from Book where ISBN='$isbn';";
    $result = mysqli_fetch_array(mysqli_query($conn, $query));
    if ($result != null) {
        echo 'Book already in use.</p>';
        mysqli_close($conn);
        die();
    }

    $title = $_POST['title'];
    $author = $_POST['author'];
    $genres = $_POST['genres'];

    $query = "insert into Book(ISBN, author, title, genre) values ($isbn, $author, $title, $genres);" or die("Failed to insert book.");
    mysqli_query($conn, $query);
    mysqli_close($conn);

    // message confirming insert
    echo '</p><p style="text-align:center; font-size: 14px; color: rgb(157, 247, 38); font-weight: bold;">Book Added!</p>';


?>