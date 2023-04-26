<?php
    include 'creds.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    echo '<p style="text-align:center; font-size: 14px; color: rgb(164, 19, 36); font-weight: bold;">';

    // email
    if (empty($_POST['email'])) {
        echo '</p>';
        die();
    }

    // phone
    if (empty($_POST['phone'])) {
        echo '</p>';
        die();
    }
    elseif (strlen($_POST['phone']) != 10) {
        echo 'Phone Number must be 10 numbers long. </p>';
        die();
    }

    // first name
    if (empty($_POST['firstName'])) {
        echo '</p>';
        die();
    }

    // last name
    if (empty($_POST['lastName'])) {
        echo '</p>';
        die();
    }

    function toPID($num) {
        $id = strval($num);
        $pre = '';
        for ($i = 0; $i < 5-strlen($id); $i++) {
            $pre .= '0';
        }
        return $pre . $id;
    }

    $conn = mysqli_connect($server_, $username_, $password_, $database_);

    // check for email already existing in database
    $email = $_POST['email'];
    $query = "select email from Patron where email='$email';";
    $result = mysqli_fetch_array(mysqli_query($conn, $query));
    if ($result != null) {
        echo 'Email already in use.</p>';
        mysqli_close($conn);
        die();
    }

    // check for phone number already existing in database
    $phone = $_POST['phone'];
    $query = "select phone from Patron where phone='$phone';";
    $result = mysqli_fetch_array(mysqli_query($conn, $query));
    if ($result != null) {
        echo 'Phone number already in use.</p>';
        mysqli_close($conn);
        die();
    }

    // calculated PID
    $query = "select * from Patron order by PID asc;";
    $q_result = mysqli_query($conn, $query);
    $result = array();
    while ($line = mysqli_fetch_array($q_result, MYSQLI_ASSOC)) {
        array_push($result, $line);
    }
    $res_len = count($result);
    $new_PID = '00000';
    for ($i = 0; $i < $res_len; $i++) {
        if ($i < (int)$result[$i]['PID']) {
            // check for gaps in the id range of current Patrons
            // ex: there are the following ids: 00000 00001 00002 00004
            //     -since 00003 was skipped, it will be used for a new librarian
            $new_PID = toPID($i);
            break;
        }
        elseif ($i == $res_len - 1) {
            // if reached end, make it the next value
            $new_PID = toPID($res_len);
        }
    }

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    $query = "insert into Patron(PID, email, phone, firstName, lastName) values ('$new_PID', '$email', '$phone', '$firstName', '$lastName');" or die("Failed to insert patron.");
    mysqli_query($conn, $query);
    mysqli_close($conn);

    // message confirming insert
    echo '</p><p style="text-align:center; font-size: 14px; color: rgb(157, 247, 38); font-weight: bold;">Patron Added!</p>';


?>