<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $name, $companyid, $jobnumber, $website, $avail, $error)
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
  <strong>Company ID: *</strong> <input type="text" name="companyid" value="<?php echo $companyid; ?>" /><br/>
 <strong>Name: *</strong> <input type="text" name="name" value="<?php echo $name; ?>" /><br/>
  <strong>Job Number: *</strong> <input type="text" name="jobnumber" value="<?php echo $jobnumber; ?>" /><br/>
 <strong>Website: *</strong> <input type="text" name="website" value="<?php echo $website; ?>" /><br/>
 <?php
 if ($avail == 1){
 echo '<strong>Availability: *</strong> <input type="radio" name="avail" value="1" checked/>Yes
 <input type="radio" name="avail" value="0" />No<br/>';}
 else {
  echo '<strong>Availability: *</strong> <input type="radio" name="avail" value="1" />Yes
 <input type="radio" name="avail" value="0" checked/>No<br/>';}
 ?>
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
 $name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
 $companyid = mysql_real_escape_string(htmlspecialchars($_POST['companyid']));
 $jobnumber = mysql_real_escape_string(htmlspecialchars($_POST['jobnumber']));
 $website = mysql_real_escape_string(htmlspecialchars($_POST['website']));
 $avail = mysql_real_escape_string(htmlspecialchars($_POST['avail']));
 // check that firstname/lastname fields are both filled in
 if ($companyid == '' )
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $name, $companyid, $jobnumber, $website, $avail, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE jobs SET name='$name', companyid='$companyid', website='$website', jobnumber='$jobnumber', 
 avail='$avail' WHERE id='$id'")
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
 $result = mysql_query("SELECT * FROM jobs WHERE id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
 $name = $row['name'];
 $companyid = $row['companyID'];
 $jobnumber = $row['jobNumber'];
 $website = $row['website'];
 $avail = $row['avail'];
 
 // show form
 renderForm($id, $name, $companyid, $jobnumber, $website, $avail, '');
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