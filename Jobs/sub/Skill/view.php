<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
        <title>View Records</title>
</head>
<body>

<?php
/* 
        VIEW.PHP
        Displays all data from 'players' table
*/

        // connect to the database
        include('connect-db.php');

        // get results from database
        $result = mysql_query("SELECT * FROM Skill") 
                or die(mysql_error());  
                
        // display data in table
        echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
        
        echo "<table border='1' cellpadding='10'>";
        echo "<tr> <th>ID</th> <th>Job ID</th> <th>Description</th> <th>Priority</th> 
		<th>Experience</th><th>Background</th><th></th> <th></th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['ID'] . '</td>';
                echo '<td>' . $row['jobID'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
				echo '<td>' . $row['priority'] . '</td>';
                echo '<td>' . $row['experience'] . '</td>';
				echo '<td>' . $row['background'] . '</td>';
                echo '<td><a href="edit.php?id=' . $row['ID'] . '">Edit</a></td>';
                echo '<td><a href="delete.php?id=' . $row['ID'] . '">Delete</a></td>';
                echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
?>
<p><a href="new.php">Add a new record</a></p>

</body>
</html> 