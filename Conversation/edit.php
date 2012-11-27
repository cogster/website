<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $description, $isinterview, $isdescription, $date,
 $jobid, $timestart, $timeend, $link, $error)
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
 $jobid = mysql_real_escape_string(htmlspecialchars($_POST['jobid']));
 $description = mysql_real_escape_string(htmlspecialchars($_POST['description']));
 $isinterview = mysql_real_escape_string(htmlspecialchars($_POST['isinterview']));
 $isdescription = mysql_real_escape_string(htmlspecialchars($_POST['isdescription']));
 $date = mysql_real_escape_string(htmlspecialchars($_POST['date']));
 $timestart = mysql_real_escape_string(htmlspecialchars($_POST['timestart']));
 $timeend = mysql_real_escape_string(htmlspecialchars($_POST['timeend']));
 $link = mysql_real_escape_string(htmlspecialchars($_POST['link'])); 
 
 // check that firstname/lastname fields are both filled in
 if ($jobid == '' )
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $description, $isinterview, $isdescription, $date,
 $jobid, $timestart, $timeend, $link,  $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE conversation SET description='$description', isinterview='$isinterview', 
 isdescription='$isdescription',date='$date', jobid ='$jobid', timestart = '$timestart', 
timeend = '$timeend', link = '$link' WHERE id='$id'")
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
 $result = mysql_query("SELECT * FROM conversation WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $description = $row['description'];
 $isinterview = $row['isInterview'];
  $isdescription = $row['isDescription'];
 $date = $row['date'];
  $jobid = $row['jobID'];
 $timestart = $row['timeStart'];
  $timeend = $row['timeEnd'];
 $link = $row['link'];

 
 // show form
 renderForm($id, $description, $isinterview, $isdescription, $date,
 $jobid, $timestart, $timeend, $link,'');
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