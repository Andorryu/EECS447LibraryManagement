<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $conn = mysqli_connect("localhost", "root", "password", "LMS");
    // JOIN QUERY 2
    $q_result = mysqli_query($conn, "select Book.ISBN, title, author, group_concat(genre separator '\n') as genre from Book, Genre 
        where Book.ISBN not in (select CheckOut.ISBN from Book, CheckOut where CheckOut.ISBN = Book.ISBN) 
        and Book.ISBN = Genre.ISBN group by Book.ISBN;");
    echo '<style> tr, th, td{
        border-style: solid;
    }
    table{
        margin: 0 auto;
    }
    td{
        padding: 0 20px;
    }
    </style>';
    echo '<table>';
    echo '<tr>
    <th>ISBN</th>
    <th>Title</th>
    <th>Author</th>
    <th>Genres</th>
    </tr>';
    while($line = mysqli_fetch_array($q_result, MYSQLI_ASSOC)){
        echo '<tr>' . 
        '<td>' . $line['ISBN'] . '</td>' .
        '<td>' . $line['title'] . '</td>' .
        '<td>' . $line['author'] . '</td>' .
        '<td>' . $line['genre'] . '</td>' .
        '</tr>';
    }
    echo '</table>';

?>