<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
        <title>View Records</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<script type="text/javascript">
			
				function confirmation(id,jobid,companyid,choice) {
				
				var answer = confirm("Delete");
					if (answer){
						alert("Record Deleted");
						switch(choice){
						case 1:
						window.location = "./sub/Contact/delete.php?id="+ id+"&jobid="+jobid+"&companyid="+companyid;
						break;
						case 2:
						window.location = "./sub/Company/delete.php?id="+ id+"&jobid="+jobid+"&companyid="+companyid;
						break;
						case 3:
						window.location = "./sub/Facts/delete.php?id="+ id+"&jobid="+jobid+"&companyid="+companyid;
						break;
						case 4:
						window.location = "./sub/Questions/delete.php?id="+ id+"&jobid="+jobid+"&companyid="+companyid;
						break;
						case 5:
						window.location = "./sub/Answers/delete.php?id="+ id+"&jobid="+jobid+"&companyid="+companyid;
						break;
						case 6:
						window.location = "./sub/Jobs/delete.php?id="+ id+"&jobid="+jobid+"&companyid="+companyid;
						break;
						case 7:
						window.location = "./sub/Skill/delete.php?id="+ id+"&jobid="+jobid+"&companyid="+companyid;
						break;
						case 8:
						window.location = "./sub/Resume/delete.php?id="+ id+"&jobid="+jobid+"&companyid="+companyid;
						break;
						case 9:
						window.location = "./sub/CoverLetter/delete.php?id="+ id+"&jobid="+jobid+"&companyid="+companyid;
						break;
						case 10:
						window.location = "./sub/Conversation/delete.php?id="+ id+"&jobid="+jobid+"&companyid="+companyid;
						break;
						
						}
					}
					else{
						alert("Record not deleted");
					}
				}
			
			</script>
</head>
<body>


<div class="container" >



<div class="menu2" >
<!--begin contact info-->

<?php
/* 
        VIEW.PHP
        Displays all data from 'players' table
*/
		$jobid = mysql_real_escape_string(htmlspecialchars($_GET['jobid']));
		$companyid = mysql_real_escape_string(htmlspecialchars($_GET['companyid']));
        // connect to the database
        include('connect-db.php');

        // get results from database
        $result = mysql_query("SELECT * FROM Contact WHERE jobID = '$jobid'") 
                or die(mysql_error());  
        //$company = mysqlquery(       
        // display data in table
       
        
        echo "<table border='1' cellpadding=10' width='50%'>";
		 echo "<tr><th colspan='10'>Contact</th></tr>";
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
                
                echo '<td><a href="./sub/Contact/edit.php?id='.$row['ID'].'&jobid='.$jobid.'&companyid='.$companyid.'">Edit</a></td>';
                echo '<td><input type="button" onclick="confirmation('.$row['ID'].','.$jobid.','.$companyid.',1)" value="Delete"></td>';
                echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
		
		echo '<p><a href="./sub/Contact/newspec.php?jobid='.$jobid.'&companyid='.$companyid.'">Add a new record</a></p>';
?>


<!--end contact info-->

<!--begin company info-->

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
      
        
        echo "<table border='1' cellpadding='10' >";
		
		// Table headers (modify)
		echo "<tr><th colspan='6'>Company Information</th></tr>" ;
        echo "<tr> <th>ID</th> <th>Name</th> <th>Info</th> <th>Website</th><th colspan='2'>Modify Company Information</th> </tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table (modify)
                echo "<tr>";
                echo '<td>' . $row['ID'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['info'] . '</td>';
				echo '<td><a href="http://' . $row['website'] . '">'.$row['website'].'</a></td>';
                echo '<td><a href="./sub/Company/edit.php?id='.$row['ID'].'&jobid='.$jobid.'&companyid='.$companyid.'">Edit</a></td>';
                echo '<td><input type="button" onclick="confirmation('.$row['ID'].','.$jobid.','.$companyid.',2)" value="Delete"></td>';
                //echo '<td><a href="delete.php?id=' . $row['ID'] . '">Delete</a></td>';
				
                echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
?>
<p><a href="new.php">Add a new record</a></p>


<!--end company info-->

<!--begin facts info-->
<?php
/* 
        VIEW.PHP
        Displays all data from 'players' table
*/      
		
		$companyid = $_GET['companyid'];
        
		// connect to the database
        include('connect-db.php');

        // get results from database
        $result = mysql_query("SELECT * FROM Facts WHERE companyid='$companyid'") 
                or die(mysql_error());  
                
        // display data in table
       
        
         echo "<table border='1' cellpadding='10' width='50%'>";
		 echo "<tr><th colspan='5'>Facts</th></tr>";
        echo "<tr> <th>ID</th> <th>Company ID</th> <th>Description</th> <th></th> <th></th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['ID'] . '</td>';
                echo '<td>' . $row['companyID'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                     echo '<td><a href="./sub/Facts/edit.php?id='.$row['ID'].'&jobid='.$jobid.'&companyid='.$companyid.'">Edit</a></td>';
                echo '<td><input type="button" onclick="confirmation('.$row['ID'].','.$jobid.','.$companyid.',3)" value="Delete"></td>';
                echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
?>
<?php
$result = mysql_query("SELECT name FROM company WHERE id='$companyid'") 
                or die(mysql_error()); 
$row = mysql_fetch_array($result); 
echo '<p><a href="newspec.php?companyid='.$companyid.'">Add a new fact to '.$row['name'].'</a></p>';
echo '<p><a href="http://localhost/Company/view.php">View Companies</a></p>';
?>

<!--end facts info-->

<!--begin q/a info-->

<?php
/* 
        VIEW.PHP
        Displays all data from 'players' table
*/

        // connect to the database
        include('connect-db.php');
         
        // get results from database
        $result = mysql_query("SELECT * FROM questions ") 
                or die(mysql_error());  
                
        // display data in table
        echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
        
        echo "<table border='1' cellpadding='10'>";
		echo "<tr><th colspan='7'>Question Information</th></tr>";
        echo "<tr> <th>ID</th> <th>Question</th> <th colspan='2'> Modify Question Information</th> <th>answer</th> </tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['question'] . '</td>';
                echo '<td><a href="./sub/Questions/edit.php?id='.$row['id'].'&jobid='.$jobid.'&companyid='.$companyid.'">Edit</a></td>';
                echo '<td><input type="button" onclick="confirmation('.$row['id'].','.$jobid.','.$companyid.',4)" value="Delete"></td>';
			   echo '<td><a href="edit.php?id=' . $row['id'] . '">add</a></td>';
                echo "</tr>";
        } 

        // close table>
        echo "</table>";
?>
<p><a href="./sub/Questions/new.php">Add a new Question</a></p>


<!--end q/a info-->

<!--begin q/a info-->
<?php
/* 
        VIEW.PHP
        Displays all data from 'players' table
*/

        // connect to the database
        include('connect-db.php');
        $jobid = $_GET['jobid'];
        // get results from database
        $result = mysql_query("SELECT * FROM answers where jobid='$jobid' ") 
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
                     echo '<td><a href="./sub/Answers/edit.php?id='.$row['ID'].'&jobid='.$jobid.'&companyid='.$companyid.'">Edit</a></td>';
                echo '<td><input type="button" onclick="confirmation('.$row['ID'].','.$jobid.','.$companyid.',5)" value="Delete"></td>';
                echo "</tr>";
        } 

        // close table>
        echo "</table>";
?>
<p><a href="./sub/Answers/new.php">Add a new Answer</a></p>
<!--end q/a info-->

</div>

<div class="content" >
<!--begin job info-->

<?php
/* 
        VIEW.PHP
        Displays all data from 'players' table
*/

        // connect to the database
        include('connect-db.php');
        $companyid = mysql_real_escape_string(htmlspecialchars($_GET['companyid']));
        // get results from database
        $result = mysql_query("SELECT * FROM Jobs WHERE companyID = '$companyid'") 
                or die(mysql_error());  
                
        // display data in table
       
        echo "<table border='1' cellpadding='10'>";
		echo "<tr>  <th colspan='7'>Job Information</th> ";
		echo "";
        echo "<tr> <th> Availability</th>  <th>Company</th> <th>Name</th> <th>Number</th><th>Website</th> <th colspan='2'>Modify Job Information</th> </tr>";

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
               
				echo '<td>' . $row['name'] . '</td>';
				echo '<td>' . $row['jobNumber'] . '</td>';
				echo '<td><a href="http://'.$row['website'].'"> '.$row['website']. '</td>';
                     echo '<td><a href="./sub/Jobs/edit.php?id='.$row['ID'].'&jobid='.$jobid.'&companyid='.$companyid.'">Edit</a></td>';
                echo '<td><input type="button" onclick="confirmation('.$row['ID'].','.$jobid.','.$companyid.',6)" value="Delete"></td>';
              
                echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
		$companyid = mysql_real_escape_string(htmlspecialchars($_GET['companyid']));
		echo '<p><a href="newspec.php?companyid='. $companyid.'">Add a new job to this company</a></p>';
?>




<!--end job info-->

<!--begin skills info-->
<?php
/* 
        VIEW.PHP
        Displays all data from 'players' table
*/
$jobid = mysql_real_escape_string(htmlspecialchars($_GET['jobid']));
        // connect to the database
        include('connect-db.php');

        // get results from database
        $result = mysql_query("SELECT * FROM Skill WHERE jobID = '$jobid'") 
                or die(mysql_error());  
                
        // display data in table
       
        
        echo "<table border='1' cellpadding='10'>";
		 echo "<tr><th colspan='8'>Skills</th></tr>";
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
                echo '<td><a href="./sub/Skill/edit.php?id='.$row['ID'].'&jobid='.$jobid.'&companyid='.$companyid.'">Edit</a></td>';
                echo '<td><input type="button" onclick="confirmation('.$row['ID'].','.$jobid.','.$companyid.',7)" value="Delete"></td>';
                echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
?>
<p><a href="new.php">Add a new record</a></p>

<!--end skills info-->

<!--begin resume info-->
<?php
/* 
        VIEW.PHP
        Displays all data from 'players' table
*/
$jobid = mysql_real_escape_string(htmlspecialchars($_GET['jobid']));
        // connect to the database
        include('connect-db.php');

        // get results from database
        $result = mysql_query("SELECT * FROM Resume WHERE jobID = '$jobid'") 
                or die(mysql_error());  
                
        // display data in table
       
        
        echo "<table border='1' cellpadding='10'>";
		 echo "<tr><th colspan='6'>Resume</th></tr>";
        echo "<tr> <th>ID</th> <th>Job ID</th> <th>DateSent</th><th>Link</th> <th></th> <th></th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['ID'] . '</td>';
                echo '<td>' . $row['jobID'] . '</td>';
				echo '<td>' . $row['dateSent'] . '</td>';
				echo '<td><a href="./resume/'.$row['link'].'">'.$row['link'].'</a></td>';
                echo '<td><a href="./sub/Resume/edit.php?id='.$row['ID'].'&jobid='.$jobid.'&companyid='.$companyid.'">Edit</a></td>';
                echo '<td><input type="button" onclick="confirmation('.$row['ID'].','.$jobid.','.$companyid.',8)" value="Delete"></td>';
                echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
?>
<p><a href="new.php">Add a new record</a></p>

<!--end resume info-->

<!--end coverletter info-->


<?php
/* 
        VIEW.PHP
        Displays all data from 'players' table
*/
$jobid = mysql_real_escape_string(htmlspecialchars($_GET['jobid']));
        // connect to the database
        include('connect-db.php');

        // get results from database
        $result = mysql_query("SELECT * FROM CoverLetter WHERE jobID = '$jobid'") 
                or die(mysql_error());  
                
        // display data in table
        
        
        echo "<table border='1' cellpadding='10'>";
		 echo "<tr><th colspan='6'>CoverLetter</th></tr>";
        echo "<tr> <th>ID</th> <th>Job ID</th><th>Date Sent</th><th>Link</th> <th></th> <th></th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['ID'] . '</td>';
                echo '<td>' . $row['jobID'] . '</td>';
				echo '<td>' . $row['dateSent'] . '</td>';
				echo '<td><a href="./coverletter/'.$row['link'].'">'.$row['link'].'</a></td>';
                echo '<td><a href="./sub/CoverLetter/edit.php?id='.$row['ID'].'&jobid='.$jobid.'&companyid='.$companyid.'">Edit</a></td>';
                echo '<td><input type="button" onclick="confirmation('.$row['ID'].','.$jobid.','.$companyid.',9)" value="Delete"></td>';
                echo "</tr>"; 
        } 

        // close table>
        echo "</table>";
?>
<p><a href="new.php">Add a new record</a></p>

<!--end coverletter info-->


<!--end conversation info-->
<?php
/* 
        VIEW.PHP
        Displays all data from 'players' table
*/
$jobid = mysql_real_escape_string(htmlspecialchars($_GET['jobid']));
        // connect to the database
        include('connect-db.php');

        // get results from database
		
        $result = mysql_query("SELECT * FROM Conversation WHERE jobID = '$jobid'") 
                or die(mysql_error());  
				
                
        // display data in table
        
        
        echo "<table border='1' cellpadding='10'>";
		 echo "<tr><th colspan='11'>Conversation</th></tr>";
        echo "<tr> <th>ID</th> <th>Description</th> <th>Is Interview</th> <th>Is Description</th>
		<th>Date</th><th>Time Start</th><th>Time End</th><th>Link</th><th></th> <th></th><th>Total Time</th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['ID'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
				echo '<td>' . $row['isInterview'] . '</td>';
				echo '<td>' . $row['isDescription'] . '</td>';
				echo '<td>' . $row['date'] . '</td>';
				echo '<td>' . $row['timeStart'] . '</td>';
				echo '<td>' . $row['timeEnd'] . '</td>';
				echo '<td>'.
				'<object type="application/x-shockwave-flash" data="dewplayer-mini.swf" 
				width="160" height="20" id="dewplayer" name="dewplayer"> <param name="wmode" 
				value="transparent" /><param name="movie" value="dewplayer-mini.swf" /> 
				<param name="flashvars" value="mp3=../Recordings/'.$row['link'].'&amp;showtime=1" /> 
				</object>'. '</td>';
				//echo '<td><a href="'.$row['link'].'">' . $row['link'] . '</a></td>';
               	echo '<td><a href="./sub/Conversation/edit.php?id='.$row['ID'].'&jobid='.$jobid.'&companyid='.$companyid.'">Edit</a></td>';
                echo '<td><input type="button" onclick="confirmation('.$row['ID'].','.$jobid.','.$companyid.',10)" value="Delete"></td>';
				$result2 = mysql_query("SELECT TIMEDIFF('".
				$row['timeStart']."','".$row['timeEnd']."')");
				$line = mysql_fetch_array($result2, MYSQL_ASSOC); 
				echo '<td>'.$line["TIMEDIFF('".
				$row['timeStart']."','".$row['timeEnd']."')"].'</td>';
                echo "</tr>";
        } 

        // close table>
        echo "</table>";
?>
<p><a href="new.php">Add a new record</a></p>


<!--end coversation info-->
</div>

<div class="footer" >
Copyright © 2011 W3Schools.com</div>

</div>

</body>
</html> 