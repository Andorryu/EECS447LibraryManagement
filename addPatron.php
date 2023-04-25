<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    echo '<p style="text-align:center; font-size: 14px; color: rgb(164, 19, 36); font-weight: bold;">';

    if (empty($_POST['PID'])) {
        echo '</p>';
        die();
    }
    elseif (strlen($_POST['phone'] != 10)) {
        echo 'Phone Number must be 10 numbers long. </p>';
        die();
    }

    $conn = mysqli_connect('localhost', 'root', 'password', 'LMS');

    //check for PID already in database
    $PID = $_POST['PID'];
    $query = "select PID from Patron where PID='$PID';";
    $result = mysqli_fetch_array(mysqli_query($conn, $query));
    if ($result != null) {
        echo 'PID already in use.</p>';
        mysqli_close($conn);
        die();
    }

    // check for email already existing in database
    $email = $_POST['email'];
    $query = "select email from Librarian where email='$email';";
    $result = mysqli_fetch_array(mysqli_query($conn, $query));
    if ($result != null) {
        echo 'Email already in use.</p>';
        mysqli_close($conn);
        die();
    }

    // check for phone number already existing in database
    $phone = $_POST['phone'];
    $query = "select phone from Librarian where phone='$phone';";
    $result = mysqli_fetch_array(mysqli_query($conn, $query));
    if ($result != null) {
        echo 'Phone number already in use.</p>';
        mysqli_close($conn);
        die();
    }

    $firstName = $_POST['firstName'];
    $firstName = $_POST['author'];

    $query = "insert into Patron(PID, email, phone, firstName, lastName) values ($PID, $email, $phone, $firstName, $lastName);" or die("Failed to insert patron.");
    mysqli_query($conn, $query);
    mysqli_close($conn);

    // message confirming insert
    echo '</p><p style="text-align:center; font-size: 14px; color: rgb(157, 247, 38); font-weight: bold;">Book Added!</p>';


?>