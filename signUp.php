<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    echo '<p style="text-align:center; font-size: 14px; color: rgb(164, 19, 36); font-weight: bold;">';
    // validity checks
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
    if (empty($_POST['password'])) {
        echo '</p>';
        die();
    }
    // at least 8 characters
    elseif (strlen($_POST['password']) < 8) {
        echo 'Password must be 8 or more characters.</p>';
        die();
    }
    // one lowercase
    elseif (preg_match('/[a-z]/', $_POST['password']) == 0) {
        echo 'Password must have at least one lower case letter.</p>';
        die();
    }
    // one uppercase
    elseif (preg_match('/[A-Z]/', $_POST['password']) == 0) {
        echo 'Password must have at least one upper case letter.</p>';
        die();
    }
    // one number
    elseif (preg_match('/[0-9]/', $_POST['password']) == 0) {
        echo 'Password must have at least one number.</p>';
        die();
    }

    // passwordConfirmation
    if (empty($_POST['passwordConfirmation'])) {
        echo '</p>';
        die();
    }
    elseif ($_POST['password'] != $_POST['passwordConfirmation']) {
        echo 'Passwords do not match.</p>';
    }

    if (empty($_POST['firstName']) or empty($_POST['lastName'])) {
        echo '</p>';
        die();
    }

    // converts a number to a five digit LID string (to be used when deciding what LID to give a new librarian)
    function toLID($num) {
        $id = strval($num);
        $pre = '';
        for ($i = 0; $i < 5-strlen($id); $i++) {
            $pre .= '0';
        }
        return $pre . $id;
    }

    $conn = mysqli_connect('localhost', 'root', 'password', 'LMS');

    // check for email already existing in database
    $email = $_POST['email'];
    $query = "select email from Librarian where email='$email';";
    $result = mysqli_fetch_array(mysqli_query($conn, $query));
    if ($result != null) {
        echo 'Email already in use.</p>';
        mysqli_close($conn);
        die();
    }

    // now that its validated, insert into database
    // get relevent POST data
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    // decide new LID
    $query = "select * from Librarian order by LID asc;";
    $q_result = mysqli_query($conn, $query);
    $result = array();
    while ($line = mysqli_fetch_array($q_result, MYSQLI_ASSOC)) {
        array_push($result, $line);
    }
    $res_len = count($result);
    $new_LID = '00000';
    for ($i = 0; $i < $res_len; $i++) {
        if ($i < (int)$result[$i]['LID']) {
            // check for gaps in the id range of current librarians
            // ex: there are the following ids: 00000 00001 00002 00004
            //     -since 00003 was skipped, it will be used for a new librarian
            $new_LID = toLID($i);
            break;
        }
        elseif ($i == $res_len - 1) {
            // if reached end, make it the next value
            $new_LID = toLID($res_len);
        }
    }
    $query = "insert into Librarian(LID, email, password, firstName, lastName) values ('$new_LID', '$email', '$password', '$firstName', '$lastName');" or die("failed to insert into Librarian");
    mysqli_query($conn, $query);
    mysqli_close($conn);

    // message confirming insert
    echo '</p><p style="text-align:center; font-size: 14px; color: rgb(157, 247, 38); font-weight: bold;">Account Created!</p>';
?>