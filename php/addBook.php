<?php
    include 'creds.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    echo '<p style="text-align:center; font-size: 14px; color: rgb(164, 19, 36); font-weight: bold;">';

    // ISBN
    if (empty($_POST['ISBN'])) {
        echo '</p>';
        die();
    }
    elseif (strlen($_POST['ISBN']) != 13) {
        echo 'ISBN must be 13 numbers long. </p>';
        die();
    }

    // title
    if (empty($_POST['title'])) {
        echo '</p>';
        die();
    }

    // author
    if (empty($_POST['author'])) {
        echo '</p>';
        die();
    }

    $conn = mysqli_connect($server_, $username_, $password_, $database_);

    //check for book already in database
    $isbn = $_POST['ISBN'];
    $query = "select ISBN from Book where ISBN='$isbn';";
    $result = mysqli_fetch_array(mysqli_query($conn, $query));
    if ($result != null) {
        echo 'Book already in Library.</p>';
        mysqli_close($conn);
        die();
    }

    $title = $_POST['title'];
    $author = $_POST['author'];
    $genres = $_POST['genres'];

    // add book first
    $query = "insert into Book(ISBN, author, title) values ('$isbn', '$author', '$title');" or die("Failed to insert book.");
    mysqli_query($conn, $query);

    // then add genres
    $genres = str_replace(" ", "", $genres);
    $genres = str_replace(",", "", $genres);
    $genres = str_split($genres, 9);
    for ($i = 0; $i < count($genres); $i++) {

        $query = "insert into Genre(ISBN, genre) values ('$isbn', '$genres[$i]');" or die("Failed to insert book.");
        mysqli_query($conn, $query);
    };

    mysqli_close($conn);

    // message confirming insert
    echo '</p><p style="text-align:center; font-size: 14px; color: rgb(157, 247, 38); font-weight: bold;">Book Added!</p>';


?>