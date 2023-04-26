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
    // JOIN QUERY 1
    $query = "select Book.ISBN, title, author, group_concat(genre separator '\n') as genre from Book, Genre where $table like '%$input%' and Book.ISBN=Genre.ISBN group by Book.ISBN;";
    $q_result = mysqli_query($conn, $query);

    echo '<script type="text/javascript" src="../selection.js"></script>';
    echo '<style>

    tr, th, td{border-style: solid;}
    td{
        padding: 0 5px;
    }

    .selectedBookSection{
        padding: 15px 100px;
    }

    .selectedBook{
        text-align: center;
    }
    </style>';

    echo '<div class="selectedBookSection">
        <p class="selectedBook">No book selected.</p>
    </div>';

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
        '<td><a href="#" onclick="selectBook(' . $line['ISBN'] . ')">select</a></td>' .
        "<td><form action='deleteBook.php' method='post'><input type='hidden' name='isbn' value=".$line['ISBN']."><button type='submit'>Delete</button></form></td>" .
        '</tr>';
    }
    echo '</table>';

    

?>

