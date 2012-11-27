<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 //(modify)
 function renderForm($name, $info, $website, $error)
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
 
<?php
echo'
 <form action="" method="post">
 <div> <!--modify-->
 <strong>Name: *</strong> <input type="text" name="name" value="'.  $name .'" /><br/>
 <strong>Info: *<br/></strong> <textarea rows = "5" cols="50" type="text" name="info" value="'.  $info.'" /> </textarea><br/>
  <strong>Website: *</strong> <input type="text" name="website"value="'.  $website.'" /><br/>
 <p>* required</p>
 <input type="submit" name="submit" value="Submit">
 </div>
 </form> 
 </body>
 </html>
 ';
?>
 
 <?php 
 }
 
 
 

 // connect to the database
 include('connect-db.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 //(modify)
 $name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
 $info = mysql_real_escape_string(htmlspecialchars($_POST['info']));
 $website = mysql_real_escape_string(htmlspecialchars($_POST['website']));
 
 // check to make sure both fields are entered
 //(modify)
 if ($name == '' || $website == '' || $info == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 // (modify)
 renderForm($name, $info, $website, $error);
 }
 else
 {
 // save the data to the database
 //(modify)
 mysql_query("INSERT Company SET name='$name', info='$info', website='$website'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 //(modify)
 {
 renderForm('','','','');
 }
?> 