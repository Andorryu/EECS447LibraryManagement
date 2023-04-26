<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    echo '<p style = "text-align: center;">';
    

    //check if search bar is empty
    if (empty($_POST['search'])){
        echo 'No results.</p>';
        die();
    }

    $conn = mysqli_connect('localhost', 'root', 'password', 'LMS');
    $input = $_POST['search'];
    $table = $_POST['option'];
    $query = "select * from Book where $table like '%$input%'";
    $q_result = mysqli_query($conn, $query);
    echo '<style> table, tr, th, td{ border-style: solid;}</style>';
    echo '<table>';
    echo '<tr>
    <th>Author</th>
    <th>ISBN</th>
    <th>Title</th>
    </tr>';
    while($line = mysqli_fetch_array($q_result, MYSQLI_ASSOC)){
        echo '<tr>' . 
        '<td>' . $line['author'] . '</td>' .
        '<td>' . $line['ISBN'] . '</td>' .
        '<td>' . $line['title'] . '</td>' .
        '<td> <a href = "deleteQuery.php">Delete</a> </td>' . 
        '</tr>';
    }
    echo '</table>';

    

?>

