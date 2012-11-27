<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
   $jobid = mysql_real_escape_string(htmlspecialchars($_GET['jobid']));
 $companyid = mysql_real_escape_string(htmlspecialchars($_GET['companyid']));
 function renderForm($description, $companyid, $error)
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
<strong>Description: *<br/></strong> <textarea rows="5" cols="50" type="text" name="description" value="<?php echo $description; ?>" /> </textarea><br/>
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

 
 // check to make sure both fields are entered
 if ($description == '' || $companyid == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($description, $companyid, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT facts SET description='$description', companyid='$companyid'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
  header("Location: ../../showall.php?jobid=" . $jobid . '&companyid='.$companyid) ;
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','');
 }
?> 