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
        $companyid = mysql_real_escape_string(htmlspecialchars($_GET['companyid']));
        // get results from database
        $result = mysql_query("SELECT * FROM Company WHERE id='$companyid' ORDER BY name ") 
                or die(mysql_error());  
                
        // display data in table
        echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
        
        echo "<table border='1' cellpadding='10'>";
		
		// Table headers (modify)
		echo "<tr><th colspan='6'>Company Information</th><th colspan='2'> View </th></tr>" ;
        echo "<tr> <th>ID</th> <th>Name</th> <th>Info</th> <th>Website</th><th colspan='2'>Modify Company Information</th> </tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table (modify)
                echo "<tr>";
                echo '<td>' . $row['ID'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['info'] . '</td>';
				echo '<td><a href="http://' . $row['website'] . '">'.$row['website'].'</a></td>';
                echo '<td><a href="edit.php?id=' . $row['ID'] . '">Edit</a></td>';
				echo '<td><input type="button" onclick="confirmation('.$row['ID'].')" value="Delete"></td>';
                //echo '<td><a href="delete.php?id=' . $row['ID'] . '">Delete</a></td>';
				echo '<td><a href="../Facts/viewspec.php?companyid=' . $row['ID'] . '">Facts</a></td>';
                echo '<td><a href="../Jobs/viewspec.php?companyid=' . $row['ID'] . '">Jobs</a></td>';
                echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
?>
<p><a href="new.php">Add a new record</a></p>

</body>
</html> 