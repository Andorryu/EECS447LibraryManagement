<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    echo '<p style="text-align: center;">';

    // check if there is a search value
    if (empty($_POST['search'])) {
        echo 'No results.</p>';
        die();
    }
    // check if option selected
    elseif (empty($_POST['option'])) {
        echo 'Please select a term to search by.</p>';
        die();
    }
    echo '</p>';

    $search = $_POST['search'];
    $option = $_POST['option'];
    $conn = mysqli_connect('localhost', 'root', 'password', 'LMS');
    $query = "select * from Patron where $option like '%$search%'";
    $q_result = mysqli_query($conn, $query);

    echo '<script type="text/javascript" src="selection.js"></script>';
    echo '<style>

    table, tr, th, td{border-style: solid;}
    
    .selectedPatronSection{
        background-color: blue;
        padding: 20px 200px;
    }

    .selectedBooksSection{
        background-color: cadetblue;
        padding: 20px 100px;
    }

    .selectedBooksSection > div, .selectedPatronSection > div{
        background-color: white;
        padding: 20px;
    }
    </style>';

    echo '<div class="selectedPatronSection">
        <div class="selectedPatron">No patron selected.</div>
    </div>';

    echo '<table>';
    echo '<tr>
    <th>PID</th>
    <th>Last Name</th>
    <th>First Name</th>
    <th>Phone #</th>
    </tr>';
    while ($line = mysqli_fetch_array($q_result, MYSQLI_ASSOC)) {
        $PID = $line['PID'];
        echo '<tr>' .
        '<td>' . $PID . '</td>' .
        '<td>' . $line['lastName'] . '</td>' .
        '<td>' . $line['firstName'] . '</td>' .
        '<td>' . $line['phone'] . '</td>' .
        '<td><a href="#" onclick="selectPatron(' . $PID . ')">select</a></td>' .
        "<td><form action='deletePatron.php' method='post'><input type='hidden' name='PID' value=" . $line['PID'], "><button type='submit'>Delete</button></form></td>" .
        '</tr>';
    }
    echo "</table>";
?>