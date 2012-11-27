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
        $result = mysql_query("SELECT * FROM answers ") 
                or die(mysql_error());  
                
        // display data in table
        echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
        
        echo "<table border='1' cellpadding='10'>";
		echo "<tr><th colspan='6'>Answer Information</th></tr>";
        echo "<tr> <th>ID</th> <th>Job ID</th> <th>Question ID</th> <th>Answer</th> <th colspan='2'>Modify Answer Information</th> </tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['id'] . '</td>';
				echo '<td>' . $row['jobid'] . '</td>';
                echo '<td>' . $row['questionid'] . '</td>';
                echo '<td>' . $row['solution'] . '</td>';
                echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>';
               echo '<td><input type="button" onclick="confirmation('.$row['id'].')" value="Delete"></td>';
                echo "</tr>";
        } 

        // close table>
        echo "</table>";
?>
<p><a href="new.php">Add a new Answer</a></p>

</body>
</html> 