<?php
    include 'creds.php';
    echo '<p style="text-align: center; color: red;">';

    if (empty($_POST['patron']) or empty($_POST['book'])) {
        echo '</p>';
        die();
    }

    $patron = $_POST['patron'];
    $book = $_POST['book'];
    $date = strtotime("+1 Week");
    $conn = mysqli_connect($server_, $username_, $password_, $database_);

    $query = "select ISBN, PID from CheckOut where ISBN = $book;";
    $result = mysqli_fetch_array(mysqli_query($conn, $query));

    if ($result != null) {
        echo 'Book is already checked out.</p>';
        die();
    }

    echo '</p>';
    echo '<p style="text-align: center; color: green;">';

    $query = "insert into CheckOut(ISBN, PID, returnDate) values ('$book', '$patron', '".date("Y-m-d", $date)."');";
    mysqli_query($conn, $query);

    echo 'Book successfully checked out.</p>';

    mysqli_close($conn);

?>