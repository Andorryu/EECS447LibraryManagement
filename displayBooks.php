<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $conn = mysqli_connect("localhost", "root", "password", "LMS");
    $q_result = mysqli_query($conn, "select * from Book where ISBN not in (select CheckOut.ISBN from Book, CheckOut where CheckOut.ISBN = Book.ISBN);");
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
        '</tr>';
    }
    echo '</table>';

?>