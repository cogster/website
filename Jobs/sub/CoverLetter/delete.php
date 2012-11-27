<?php
/* 
 DELETE.PHP
 Deletes a specific entry from the 'players' table
*/

 // connect to the database
 include('connect-db.php');
  $jobid = mysql_real_escape_string(htmlspecialchars($_GET['jobid']));
 $companyid = mysql_real_escape_string(htmlspecialchars($_GET['companyid']));
 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 
 // delete the entry
 $result = mysql_query("DELETE FROM coverletter WHERE id=$id")
 or die(mysql_error()); 
 
 // redirect back to the view page
 header("Location: ../../showall.php?jobid=" . $jobid . '&companyid='.$companyid);
 }
 else
 // if id isn't set, or isn't valid, redirect back to view page
 {
 header("Location: ../../showall.php?jobid=" . $jobid . '&companyid='.$companyid);
 }
 
?>