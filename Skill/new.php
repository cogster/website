<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($description, $jobid, $priority, $experience, $background, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
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
 cols="50"  name="background" value="<?php echo $background; ?>" /> </textarea><br/>
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
 $description = mysql_real_escape_string(htmlspecialchars($_POST['description']));
 $jobid = mysql_real_escape_string(htmlspecialchars($_POST['jobid']));
 $priority = mysql_real_escape_string(htmlspecialchars($_POST['priority']));
 $experience = mysql_real_escape_string(htmlspecialchars($_POST['experience']));
 $background = mysql_real_escape_string(htmlspecialchars($_POST['background']));
 // check to make sure both fields are entered
 if ($jobid == ''  )
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($description, $jobid, $priority, $experience, $background, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT skill SET description='$description', priority='$priority',
 jobid='$jobid', experience='$experience', background='$background' ")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','','','','');
 }
?> 