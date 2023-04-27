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

    $genres = str_replace(" ", "", $genres);
    $genres = str_replace(",", "", $genres);
    $genrearray = str_split($genres);

    while (empty($genrearray) == FALSE) {
        $genre = array($genrearry[0], $genrearry[1], $genrearry[2], $genrearry[3], $genrearry[4], $genrearry[5], 
        $genrearry[6], $genrearry[7], $genrearry[8]);

        $genre = implode($genre);

        $query = "insert into Genre(ISBN, genre) values ('$isbn', '$genre');" or die("Failed to insert book.");
        mysqli_query($conn, $query);

        array_splice($genrearray, 0, 9);
    };

    $query = "insert into Book(ISBN, author, title) values ('$isbn', '$author', '$title');" or die("Failed to insert book.");
    mysqli_query($conn, $query);
    mysqli_close($conn);

    // message confirming insert
    echo '</p><p style="text-align:center; font-size: 14px; color: rgb(157, 247, 38); font-weight: bold;">Book Added!</p>';


?>