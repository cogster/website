<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $description, $jobid, $priority, $experience, $background, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>Edit Record</title>
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
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
 <div>
 <p><strong>ID:</strong> <?php echo $id; ?></p>
<strong>Job ID *</strong> <input type="text" name="jobid" value="<?php echo $jobid; ?>" /><br/>
 <strong>Description: *</strong> <input type="text" name="description" value="<?php echo $description; ?>" /><br/>
 <strong>Priority: *</strong> <select name="priority">
 <option value="not necessary" selected="selected" />Not Necessary</option>
 <option value="preferred" />Preferred</option>
 <option value="minimum" />Minimum</option>
 <option value="essential" />Essential</option>
 </select> <br/>
 <strong>Personal Experience: *</strong> <select name="experience">
 <option value="no exp" selected="selected" />No Experience</option>
 <option value="learned" />Learned</option>
 <option value="experienced" />Experienced</option>
 <option value="expert" />Expert</option>
 </select> <br/>
 <strong>Background *</strong> <br/><textarea rows="5"
 cols="50"  name="background" value="<?php echo $background; ?>" /> <?php echo $background; ?></textarea><br/>
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
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 // get form data, making sure it is valid
 $id = $_POST['id'];
 $description = mysql_real_escape_string(htmlspecialchars($_POST['description']));
 $priority = mysql_real_escape_string(htmlspecialchars($_POST['priority']));
 $jobid = mysql_real_escape_string(htmlspecialchars($_POST['jobid']));
 $experience = mysql_real_escape_string(htmlspecialchars($_POST['experience']));
 $background = mysql_real_escape_string(htmlspecialchars($_POST['background']));

 
 // check that firstname/lastname fields are both filled in
 if ($jobid == '' )
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $description, $jobid, $priority, $experience, $background, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE skill SET description='$description', priority='$priority',
 jobid='$jobid', experience='$experience', background='$background' WHERE id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'Error!';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
 {
 // query db
 $id = $_GET['id'];
 $result = mysql_query("SELECT * FROM skill WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $jobid = $row['jobID'];
 $description = $row['description'];
 $priority = $row['priority'];
 $experience = $row['experience'];
 $background = $row['background'];
 
 // show form
 renderForm($id, $description, $jobid, $priority, $experience, $background ,'');
 }
 else
 // if no match, display result
 {
 echo "No results!";
 }
 }
 else
 // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
 {
 echo 'Error!';
 }
 }
?>