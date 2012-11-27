<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>Rob's Apps</title>
<?php
echo "</br>". getdate('weekday'); 
?>
</head>

<body>
<h1 class="home" > Robert's Apps reg</h1> 
<table class=first> 
<tr>
<th><a href="home.php"> Home</a></th>
<th><a href="test.php">PHP/SQL</a></th>
<th>???</th>
<th>???</th>
<th>???</th>
<th>???</th>
</tr> 
</table>

<h3> Logged out </h3> 


 <?php 
 $past = time() - 100; 

 //this makes the time in the past to destroy the cookie 

 setcookie(ID_my_site, gone, $past); 

 setcookie(Key_my_site, gone, $past); 

 header("Location: login.php"); 
?>


<p class = "end"></p>
</body>

</html>

