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
        $result = mysql_query("SELECT * FROM Jobs") 
                or die(mysql_error());  
                
				
        // display data in table
        echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
        echo "<table border='1' cellpadding='10'>";
		echo "<tr> <th colspan='1'>Company</th> <th colspan='8'>Job Information</th> <th colspan='5'>Job Resources</th> <th >View</th> </tr>";
		echo "";
        echo "<tr> <th>Availability</th>  <th>Name</th><th>ID</th> <th>Company ID</th> <th>Name</th> <th>Number</th><th>Website</th> <th colspan=2>Modify Job Information</th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
				if($row['avail']==1)echo '<td>  Yes  </td>';
				else echo '<td>  No  </td>';
			
					$companyname = mysql_query("SELECT name FROM Company")  
					or die(mysql_error()); 
					$companyrow = mysql_fetch_array($companyname); 
					echo '<td>' . $companyrow['name'] . '</td>';
                echo '<td>' . $row['ID'] . '</td>';
				echo '<td>' . $row['companyID'] . '</td>';
				echo '<td>' . $row['name'] . '</td>';
				echo '<td>' . $row['jobNumber'] . '</td>';
				echo '<td><a href="http://'.$row['website'].'"> '.$row['website']. '</td>';
                echo '<td><a href="edit.php?id=' . $row['ID'] . '">Edit</a></td>';
				echo '<td><input type="button" onclick="confirmation('.$row['ID'].')" value="Delete"></td>';
                echo '<td><a href="../Contact/viewspec.php?jobid=' . $row['ID'] . '">Contact</a></td>';
				echo '<td><a href="../Conversation/viewspec.php?jobid=' . $row['ID'] . '">Conversation</a></td>';
				echo '<td><a href="../Resume/viewspec.php?jobid=' . $row['ID'] . '">Resume</a></td>';
				echo '<td><a href="../CoverLetter/viewspec.php?jobid=' . $row['ID'] . '">Cover Letter</a></td>';
				echo '<td><a href="../Skill/viewspec.php?jobid=' . $row['ID'] . '">Skill</a></td>';
				echo '<td><a href="showall.php?jobid=' . $row['ID'] . '&companyid='.$row['companyID'].'">Show All</a></td>';
                echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
?>
<p><a href="new.php">Add new job information</a></p>

</body>
</html> 