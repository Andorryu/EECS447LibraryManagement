<?php
    include 'creds.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    echo '<p style="color: red; text-align: center;">';

    // email
    if (empty($_POST['email'])) {
        echo '</p>';
        die();
    }
    elseif (preg_match('/@/', $_POST['email']) == 0) {
        echo 'Invalid email.</p>';
        die();
    }

    // password
    if (empty($_POST['currentPassword']) or empty($_POST['newPassword'])) {
        echo '</p>';
        die();
    }
    $oldPass = $_POST['currentPassword'];
    $newPass = $_POST['newPassword'];
    if ($newPass == $oldPass) {
        echo 'Your current password and new password cannot be the same.</p>';
        die();
    }
    elseif (strlen($newPass) < 8) {
        echo 'Your new password must be 8 or more characters long.</p>';
        die();
    }
    elseif (preg_match('/[a-z]/', $newPass) == 0) {
        echo 'Your new password must contain one or more lowercase letters.</p>';
        die();
    }
    elseif (preg_match('/[A-Z]/', $newPass) == 0) {
        echo 'Your new password must contain one or more uppercase letters.</p>';
        die();
    }
    elseif (preg_match('/[0-9]/', $newPass) == 0) {
        echo 'Your new password must contain one or more numbers.</p>';
        die();
    }

    $email = $_POST['email'];
    $conn = mysqli_connect($server_, $username_, $password_, $database_);
    $query = "select * from Librarian where email='$email' and password='$oldPass';";
    $result = mysqli_fetch_array(mysqli_query($conn, $query));
    if ($result == null) {
        echo "$result";
        echo 'Email and/or password is incorrect.</p>';
        die();
    }

    $query = "update Librarian set password='$newPass' where email='$email';";
    mysqli_query($conn, $query);
    echo '</p><p style="color: green; text-align: center;">Password changed.</p>';
?>