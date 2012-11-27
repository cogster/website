<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 
 $jobid = mysql_real_escape_string(htmlspecialchars($_GET['jobid']));
 $companyid = mysql_real_escape_string(htmlspecialchars($_GET['companyid']));
 function renderForm($id, $firstname, $lastname, $title, $phonenumber, $email, $datelast, $jobid,  $error)
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
  <strong>Job ID: *</strong> <input type="text" name="jobid" value="<?php echo $jobid; ?>"/><br/>
 <strong>First Name: *</strong> <input type="text" name="firstname" value="<?php echo $firstname; ?>"/><br/>
 <strong>Last Name: *</strong> <input type="text" name="lastname" value="<?php echo $lastname; ?>"/><br/>
  <strong>Title: *</strong> <input type="text" name="title" value="<?php echo $title; ?>"/><br/>
 <strong>Phone Number: *</strong> <input type="text" name="phonenumber" value="<?php echo $phonenumber; ?>"/><br/>
 <strong>Email: *</strong> <input type="text" name="email" value="<?php echo $email; ?>"/><br/>
 <strong>Date Last Contacted: *</strong> <input type="text" name="datelast" value="<?php echo $datelast; ?>"/><br/>
 <p>* Required</p>
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
 $firstname = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));
 $lastname = mysql_real_escape_string(htmlspecialchars($_POST['lastname']));
 $title = mysql_real_escape_string(htmlspecialchars($_POST['title']));
 $phonenumber = mysql_real_escape_string(htmlspecialchars($_POST['phonenumber']));
 $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
 $datelast = mysql_real_escape_string(htmlspecialchars($_POST['datelast']));
 $jobid = mysql_real_escape_string(htmlspecialchars($_POST['jobid']));

 
 // check that firstname/lastname fields are both filled in
 if ($firstname == '' || $lastname == ''|| $title == ''|| $phonenumber == ''|| $email == ''|| $datelast == ''|| $jobid == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $firstname, $lastname, $title, $phonenumber, $email, $datelast, $jobid, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE Contact SET firstName='$firstname', lastName='$lastname', title='$title', phoneNumber='$phonenumber', email='$email',
dateLast='$datelast', jobID='$jobid' WHERE id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: ../../showall.php?jobid=" . $jobid . '&companyid='.$companyid) ;
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
 $result = mysql_query("SELECT * FROM contact WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $firstname = $row['firstName'];
 $lastname = $row['lastName'];
 $title= $row['title'];
 $phonenumber= $row['phoneNumber'];
 $email= $row['email'];
 $datelast= $row['dateLast']; 
 $jobid= $row['jobID']; 
 
 
 
 // show form
 renderForm($id, $firstname, $lastname,$title, $phonenumber, $email, $datelast, $jobid, '');
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