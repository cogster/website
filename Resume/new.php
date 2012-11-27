<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($datesent, $jobid, $link, $error)
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
 <strong>Job ID: *</strong> <input type="text" name="jobid" value="<?php echo $jobid; ?>" /><br/>
 <strong>Date Sent: *</strong> <input type="text" name="datesent" value="<?php echo $datesent; ?>" /><br/>
 <strong>Link: *</strong> <input type="text" name="link" value="<?php echo $link; ?>" /><br/>
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
 $datesent = mysql_real_escape_string(htmlspecialchars($_POST['datesent']));
 $jobid = mysql_real_escape_string(htmlspecialchars($_POST['jobid']));
 $link = mysql_real_escape_string(htmlspecialchars($_POST['link']));
 
 // check to make sure both fields are entered
 if ($datesent == '' || $link == ''|| $jobid == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($datesent, $jobint, $link, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT resume SET datesent='$datesent', link='$link', jobid='$jobid'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','','');
 }
?> 