<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($question, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <?php
/* 
        VIEW.PHP
        Displays all data from 'players' table
*/

        // connect to the database
        include('connect-db.php');

        // get results from database
        $result = mysql_query("SELECT * FROM questions") 
                or die(mysql_error());  
                
        // display data in table
        echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
        echo "<strong> Companies </strong><br/>";
        echo "<table border='1' cellpadding='10'>";
		
		// Table headers (modify)
        echo "<tr> <th>ID</th> <th>Question</th> </th> <th></th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysql_fetch_array( $result )) {
                
                // echo out the contents of each row into a table (modify)
                echo "<tr>";
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['question'] . '</td>';
                echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>';
                echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
                echo "</tr>"; 
        } 

        // close table>
        echo "</table><br/>";
?>
 <title>New Record</title>
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 
 <form action="" method="post">
 <div>
 <strong>Question : *</strong> <textarea rows="5" cols="50" type="text" name="question" value="<?php echo $question; ?>" /></textarea><br/>
 <p>* required</p>
 <input type="submit" name="submit" value="Submit">
 </div>
 </form> 
 </body>
 </html>
 <?php 
 }
 
 
 

 // connect to the database
 include('connect-db.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 $question = mysql_real_escape_string(htmlspecialchars($_POST['question']));

 
 // check to make sure both fields are entered
 if ($question == '' )
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($question, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT questions SET question='$question'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','');
 }
?> 