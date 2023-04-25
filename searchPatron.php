<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    echo '<p style="text-align: center;">';

    // check if there is a search value
    if (empty($_POST['search'])) {
        echo 'No results.</p>';
        die();
    }
    // check if option selected
    elseif (empty($_POST['option'])) {
        echo 'Please select a term to search by.</p>';
        die();
    }

    $conn = mysqli_connect('localhost', 'root', 'password', 'LMS');
    $query = "select * from Patron where";

?>