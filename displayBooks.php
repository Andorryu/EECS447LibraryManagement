<?php
    $conn = mysqli_connect("localhost", "root", "password", "LMS");
    $q_result = mysqli_query($conn, "SELECT title, author, Book.ISBN FROM Book, Checkout WHERE Book.ISBN != Checkout.ISBN");
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