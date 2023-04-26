<?php

    echo '<p style = "text-align: center;">';
    

    //check if search bar is empty
    if (empty($_POST['search'])){
        echo 'No results.</p>';
        die();
    }

    $conn = mysqli_connect('localhost', 'root', 'password', 'LMS');
    $input = $_POST['search'];
    $table = $_POST['Option'];
    $query = "select * from Book where $table = '$input'";
    $q_result = mysqli_query($conn, $query);
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
        '</tr>';
    }
    echo '</table>';


?>