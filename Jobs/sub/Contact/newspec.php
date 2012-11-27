<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
  $jobid = mysql_real_escape_string(htmlspecialchars($_GET['jobid']));
 $companyid = mysql_real_escape_string(htmlspecialchars($_GET['companyid']));
 function renderForm($jobid,$firstname, $lastname, $title, $phonenumber, $email, $datelast , $error)
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
 <strong>First Name: *</strong> <input type="text" name="firstname" value="<?php echo $firstname; ?>" /><br/>
 <strong>Last Name: *</strong> <input type="text" name="lastname" value="<?php echo $lastname; ?>" /><br/>
 <strong>Title: *</strong> <input type="text" name="title" value="<?php echo $title; ?>" /><br/>
 <strong>Phone Number: *</strong> <input type="text" name="phonenumber" value="<?php echo $phonenumber; ?>" /><br/>
 <strong>Email: *</strong> <input type="text" name="email" value="<?php echo $email; ?>" /><br/>
 <strong>Date Last Contact: *</strong> <input type="text" name="datelast" value="<?php echo $datelast; ?>" /><br/>
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
 
 $firstname = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));
 $lastname = mysql_real_escape_string(htmlspecialchars($_POST['lastname']));
 $title = mysql_real_escape_string(htmlspecialchars($_POST['title']));
 $phonenumber = mysql_real_escape_string(htmlspecialchars($_POST['phonenumber']));
 $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
 $datelast = mysql_real_escape_string(htmlspecialchars($_POST['datelast']));

 
 
 // check to make sure both fields are entered
 if ( $jobid == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($jobid,$firstname, $lastname, $title, $phonenumber, $email, $datelast , $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT contact SET jobid='$jobid',firstname='$firstname', lastname='$lastname', title='$title', phonenumber='$phonenumber', 
 email='$email', datelast='$datelast'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ../../showall.php?jobid=" . $jobid . '&companyid='.$companyid); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','', '', '', '', '', '' , '');
 }
?> 