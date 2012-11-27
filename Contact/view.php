<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
        <title>View Records</title>
		<script type="text/javascript">
			
				function confirmation(id) {
				
				var answer = confirm("Delete");
					if (answer){
						alert("Record Deleted");
						window.location = "delete.php?id="+ id;
					}
					else{
						alert("Record not deleted");
					}
				}
			
			</script>
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
        $result = mysql_query("SELECT * FROM Contact") 
                or die(mysql_error());  
                
        // display data in table
        echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
        
        echo "<table border='1' cellpadding='10'>";
        echo "<tr> <th>ID</th> <th>Job ID</th> <th>First Name</th> <th>Last Name</th> <th>Title</th> <th>Phone Number</th> 
        <th>Email</th> <th>Date Last</th> <th></th> <th></th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['ID'] . '</td>';
				echo '<td>' . $row['jobID'] . '</td>';
                echo '<td>' . $row['firstName'] . '</td>';
                echo '<td>' . $row['lastName'] . '</td>';
				echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $row['phoneNumber'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
				echo '<td>' . $row['dateLast'] . '</td>';
                
                echo '<td><a href="edit.php?id=' . $row['ID'] . '">Edit</a></td>';
				echo '<td><input type="button" onclick="confirmation('.$row['ID'].')" value="Delete"></td>';
                //echo '<td><a href="delete.php?id=' . $row['ID'] . '">Delete</a></td>';
                echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
?>
<p><a href="new.php">Add a new record</a></p>

</body>
</html> 