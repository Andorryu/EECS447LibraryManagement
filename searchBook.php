<?php

    echo '<p style = "text-align: center;">';
    

    //check if search bar is empty
    if (empty($_POST['search'])){
        echo 'No results.</p>';
        die()
    }
    $conn = mysqli_connect('mysql.eecs.ku.edu', 't365t737', 'aiPho4UN', 't365t737');
    elseif ($_POST['Option'] == 'title'){
        $input = $_POST['search'];
        $query = "select * from Book where title = '$input'";
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
    }
?>