<?php
    $conn = mysql_connect("mysql.eecs.ku.edu", "a815d085", "ohni7oklhJ") or die('could not connect' . mysql_error());
	mysql_select_db('a815d085') or die('Could not select database');
    $q = mysql_query('SELECT * FROM CRUISE') or die('My SQL query failed');
    echo "<table>\n";
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    		echo "\t<tr>\n";
    		foreach ($line as $col_value) {
        		echo "\t\t<td>$col_value</td>\n";
    		}
    		echo "\t</tr>\n";
	}
	echo "</table>\n";

	echo "Number of fields: ".mysql_num_fields($result)."<br>";
	echo "Number of records: ".mysql_num_rows($result)."<br>";
?>