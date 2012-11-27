<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($name, $companyid, $jobnumber, $website, $error)
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
 
 <strong>Name: *</strong> <input type="text" name="name" value="<?php echo $name; ?>" /><br/>
  <strong>Job Number: *</strong> <input type="text" name="jobnumber" value="<?php echo $jobnumber; ?>" /><br/>
 <strong>Website: *</strong> <input type="text" name="website" value="<?php echo $website; ?>" /><br/>

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
 $name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
 $companyid = mysql_real_escape_string(htmlspecialchars($_GET['companyid']));
 
  $jobnumber = mysql_real_escape_string(htmlspecialchars($_POST['jobnumber']));
 $website = mysql_real_escape_string(htmlspecialchars($_POST['website']));
 // check to make sure both fields are entered
 if ($name == '' || $companyid == ''||$jobnumber == '' ||$website == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($name, $companyid, $website, $jobnumber, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT jobs SET name='$name', companyid='$companyid', website='$website', jobnumber='$jobnumber'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','','','');
 }
?> 