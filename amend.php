<html>
<?php
// Show simple format of the records so person can choose the reference name/number
// this is then passed to the next page, for all details

$db = mysql_connect("localhost", "root", "gnombe");
mysql_select_db("test",$db) or die ('Unable to connect to database');

$q="SELECT * FROM person ORDER BY ID ASC";

$result = mysql_query( $q, $db )
or die(" - Failed More Information:<br><pre>$q</pre><br>Error: " . mysql_error());

$num_rows = mysql_num_rows($result);
if ($myrow = mysql_fetch_array($result)) {

echo "<br>A Quick View<BR><br>";
echo "<table border=1>\n";
echo "<tr><td><b>ID</b></td><td>First</td><td>Last</td></tr>\n";
do {
printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>\n", $myrow["ID"], $myrow["first"], $myrow["last"]);
} while ($myrow = mysql_fetch_array($result));
echo "</table>\n";
} else {
echo "$ref: That record appears to be unavailable";
}

mysql_free_result($result);
mysql_close($db);
?></DIV></TD></html>