<?php
    include 'creds.php';
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
    elseif ($newPass < 8) {
        echo 'Your new password must be 8 or more characters long.</p>';
        die();
    }
    elseif (preg_match('/[a-z]/', $newPass)) {
        echo 'Your new password must contain one or more lowercase letters.</p>';
        die();
    }
    elseif (preg_match('/[A-Z]/', $newPass)) {
        echo 'Your new password must contain one or more uppercase letters.</p>';
        die();
    }
    elseif (preg_match('/[0-9]/', $newPass)) {
        echo 'Your new password must contain one or more numbers.</p>';
        die();
    }

    $conn = mysqli_connect($server_, $username_, $password_, $database_);
    $query = '';
?>