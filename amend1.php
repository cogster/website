<?PHP
session_start();
?>
<HTML>

<?php
$record = $_POST['record'];
echo "ID: $record<br><BR>";

$host = "localhost";
$login_name = "root";
$password = "gnombe";

//Connecting to MYSQL
MySQL_connect("$host","$login_name","$password");

//Select the database we want to use
mysql_select_db("database") or die("Could not find database");

$result=mysql_query(" SELECT * FROM person WHERE ID='$record'");
$num=mysql_num_rows($result);
$i=0;
while ($i < $num) {

// collect all details for our one reference
$first=mysql_result($result,$i,"first");
$last=mysql_result($result,$i,"last");
$ID=mysql_result($result,$i,"ID");


$f='<font face=Verdana,Arial,Helvetica size=2 Color=Blue';

$view='<img src=http://your_website/thumbs/';
echo "<br>$view$thumb.jpg><br><br>";

//next we display only the details we want to allow to be changed in a form object
// the other details that we won't allow to be changed can be echoed to the screen
//note the hidden input line 3 below. We don't need to echo it to the screen
?>

<TABLE WIDTH="100%" CELLPADDING="10" CELLSPACING="0" BORDER="2"> <TR ALIGN="center" VALIGN="top">
<TD ALIGN="center" COLSPAN="1" ROWSPAN="1" BGCOLOR="#F2F2F2">

<FORM ACTION="amend2.php" METHOD="post">
<P ALIGN="LEFT">
<INPUT TYPE="hidden" NAME="ud_id" VALUE="<? echo "$record" ?>">
<BR>first:<BR><TEXTAREA NAME="ud_first" COLS="50" ROWS="4">
<? echo "$first"?></TEXTAREA></P><P ALIGN="LEFT">last:<BR>
<TEXTAREA NAME="ud_last" COLS="50" ROWS="4"><? echo "$last"?></TEXTAREA></P><HR><B>
</P><P><INPUT TYPE="Submit" VALUE="Update the Record" NAME="Submit"> </P></FORM></TD></TR></TABLE>

<?
++$i;
}
?>
