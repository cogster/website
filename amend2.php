<?PHP
session_start();
?>

<?php

$ud_id=$_POST['ud_id'];
$ud_description=$_POST['ud_description'];
$ud_text2=$_POST['ud_text2'];
$ud_thumb=$_POST['ud_thumb'];
$ud_img1=$_POST['ud_img1'];
$ud_img2=$_POST['ud_img2'];
$ud_img3=$_POST['ud_img3'];

if ($ud_id == "") echo "! No identifier retrieved";
else
echo "Amending record $ud_id";

//clean up any carriage returns etc

$ud_description = preg_replace("/[\n\r]*/","",$ud_description);
$ud_text2 = preg_replace("/[\n\r]*/","",$ud_text2);

$host = "db_host";
$login_name = "db_name";
$password = "db_password";

//Connecting to MYSQL
MySQL_connect("$host","$login_name","$password");

//Select the database we want to use
mysql_select_db("db_database") or die("Could not select database");

mysql_query(" UPDATE db_table
SET description='$ud_description', text2='$ud_text2', thumb='$ud_thumb', image1='$ud_img1', image2='$ud_img2', image3='$ud_img3', WHERE reference='$ud_id'");

echo "<BR>Record $ud_id <-- Updated<BR><BR>";
?>

<?php
//if you want to check it's ok, display new data

echo "Search on $ud_id<BR>";

$db = mysql_connect("host", "name", "password");
mysql_select_db("db_database",$db) or die ('Unable to connect to database');

$q="SELECT * FROM db_table WHERE reference ='$ud_id'";

$result = mysql_query( $q, $db )
or die(" - Failed More Information:<br><pre>$q</pre><br>Error: " . mysql_error());

$num_rows = mysql_num_rows($result);
if ($myrow = mysql_fetch_array($result)) {

$thumb='<img src=http://your_website/thumbs/';

//if the record leads to a specific page
$web='http://www.your_website/detail/index.php?name=';

echo "<table border=0>\n";
echo "<tr><td></td><td></td><td></td><td></td></tr>\n";


do {
printf("<tr><td>$thumb%s.jpg></td><td>%s</td><td>%s</td><td>%s</td>
</tr>\n", $myrow["thumb"], $myrow["reference"], $myrow["description"], $myrow["text2"]);

} while ($myrow = mysql_fetch_array($result));
echo "</table>\n";
} else {
echo "Sorry, no records were found";
}

mysql_free_result($result);
mysql_close($db);
session_destroy();

?>