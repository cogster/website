<html>
<head>
<link rel="shortcut icon" href="favicon.png">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>Robert's Apps</title>

<?php 

 // Connects to your Database 

 mysql_connect("localhost", "root", "gnombe") or die(mysql_error()); 

 mysql_select_db("job") or die(mysql_error()); 

 
 //checks cookies to make sure they are logged in 

 if(isset($_COOKIE['ID_my_site'])) 

 { 

 	$username = $_COOKIE['ID_my_site']; 

 	$pass = $_COOKIE['Key_my_site']; 

 	 	$check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error()); 

 	while($info = mysql_fetch_array( $check )) 	 

 		{ 

 

 //if the cookie has the wrong password, they are taken to the login page 

 		if ($pass != $info['password']) 

 			{ 			header("Location: login.php"); 

 			} 

 

 //otherwise they are shown the admin area	 

 	else 

 			{ 

 			 //echo "Admin Area<p>"; 

 //echo "Your Content<p>"; 

 //echo "<a href=logout.php>Logout</a>"; 

 			} 

 		} 

 		} 

 else 

 

 //if the cookie does not exist, they are taken to the login screen 

 {			 

 header("Location: login.php"); 

 } 

 ?> 

</head>
<div class="wrapper">
<body>
<a href ="login.php" class="login">Login</a>/<a href=logout.php class = "login">Logout</a>
<h1 class="home" > <img src="./image/logo.png" alt="Robert's Apps" width="300" height="80" /></h1> 

<!--links menu bar-->

 
<b>
<div class="menu"> 
<span class="menuselect"><a class = "menu" href="home.php" >Home</a></span>
<a class = "menu" href="test.php">PHP/SQL</a>
<a class = "menu" href="job.php">Job</a>
???
???
???
</b>
</div> 


<!--links menu bar-->


<h3> News </h3>
<p>

I am now currently implementing an upload feature for conversation analysis. The site should be completed within 3 days. After this time we shall
finally use it as a tool to research jobs and hopefully land one. 
</p>
<hr>
<br/>
<h3>10/14/2011</h3>
<p >

The datatables for the job database is now complete. All that remains is to create the insert forms and the ability to update and delete and search the database. Once this is complete I will be able to start inserting jobs and developing my skills further for job's needs. 
</p>
<hr>
<br/>
<h3>10/01/2011</h3>
<p >

I am now researching companies. The companies that are being applied
to include Kaiser, Sutter, and other jobs in Sacramento. There are many jobs available 
that require a variety of skills. 
</p>





<p class = "end"></p>

</body>
</div >
</html>

