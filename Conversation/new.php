<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($description, $isinterview, $isdescription, $date, $jobid, $timestart, $timeend, $link, $error)
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
 
 <form action="" method="post" enctype="multipart/form-data">
 <div>
 <strong>Job ID: *</strong> <input type="text" name="jobid" value="<?php echo $jobid; ?>" /><br/>
 <strong>Note: *</strong> <input type="text" name="description" value="<?php echo $description; ?>" /><br/>
 <strong>Is Interview: *</strong> <input type="radio" name="isinterview" value="1" >yes</input>
 </strong> <input type="radio" name="isinterview" value="0" >no</input><br/>
 <strong>Is Description: *</strong> <input type="radio" name="isdescription" value="1">yes</input>
 </strong> <input type="radio" name="isdescription" value="0">no</input><br/>
 <strong>Date(yyyy-mm-dd): *</strong> <input type="text" name="date" value="<?php echo $date; ?>" /><br/>
 <strong>Time Start(hh:mm:ss): *</strong> <input type="text" name="timestart" value="<?php echo $timestart; ?>" /><br/>
 <strong>Time End(hh:mm:ss): *</strong> <input type="text" name="timeend" value="<?php echo $timeend; ?>" /><br/>
<strong>Link(file name i.e.: song.mp3): *</strong> <input type="text" name="link" value="<?php echo $link; ?>" /><br/>
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
 $isinterview = mysql_real_escape_string(htmlspecialchars($_POST['isinterview']));
  $isdescription = mysql_real_escape_string(htmlspecialchars($_POST['isdescription']));
 $date = mysql_real_escape_string(htmlspecialchars($_POST['date']));
  $jobid = mysql_real_escape_string(htmlspecialchars($_POST['jobid']));
 $timestart = mysql_real_escape_string(htmlspecialchars($_POST['timestart']));
  $timeend = mysql_real_escape_string(htmlspecialchars($_POST['timeend']));
 $link = mysql_real_escape_string(htmlspecialchars($_POST['link']));
 
 
 // check to make sure both fields are entered
 if ($description == '' || $isinterview == ''||$isdescription == '' || $date == ''||$jobid == '' || $timestart == 
 ''|| $timeend == ''|| $link == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($description, $isinterview, $isdescription, $date, $jobid, $timestart, $timeend, $link, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("INSERT conversation SET description='$description', isinterview='$isinterview', 
 isdescription='$isdescription',date='$date', jobid ='$jobid', timestart = '$timestart', 
timeend = '$timeend', link = '$link'")or die(mysql_error());


  
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
 renderForm('','','','','','','','','');
 }
?> 