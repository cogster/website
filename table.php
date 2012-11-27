<html> 
<body> 
<?php

print "<table border=\"1\">\n";
for ($y = 1; $y<=12; $y++) {
	print "<tr>\n";
	for( $x=1; $x<12; $x++) {
print "\t<td>"; 
print($x*$y);
print"</td>\n";
}
print "</tr>\n";
}
print "</table>"; 
?>



</body> 
</html>
