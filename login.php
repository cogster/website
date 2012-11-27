<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<title>Rob's Apps</title>

</head>

<body>

<!--links menu bar-->
<b>
<div class="menu"> 
<a class = "menu" href="home.php" >Home</a>
<a class = "menu" href="test.php">PHP/SQL</a>
<a class = "menu" href="job.php">Job</a>
???
???
???
</b>
</div> 
<!--links menu bar-->



 <?php 

 // Connects to your Database 

 mysql_connect("localhost", "root", "gnombe") or die(mysql_error()); 

 mysql_select_db("job") or die(mysql_error()); 


 //Checks if there is a login cookie

 if(isset($_COOKIE['ID_my_site']))


 //if there is, it logs you in and directes you to the members page

 { 
 	$username = $_COOKIE['ID_my_site']; 

 	$pass = $_COOKIE['Key_my_site'];

 	 	$check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error());

 	while($info = mysql_fetch_array( $check )) 	

 		{

 		if ($pass != $info['password']) 

 			{

 			 			}

 		else

 			{

 			header("Location: members.php");



 			}

 		}

 }


 //if the login form is submitted 

 if (isset($_POST['submit'])) { // if form has been submitted



 // makes sure they filled it in

 	if(!$_POST['username'] | !$_POST['pass']) {

 		die('You did not fill in a required field.');

 	}

 	// checks it against the database



 	if (!get_magic_quotes_gpc()) {

 		$_POST['email'] = addslashes($_POST['email']);

 	}

 	$check = mysql_query("SELECT * FROM users WHERE username = '".$_POST['username']."'")or die(mysql_error());



 //Gives error if user dosen't exist

 $check2 = mysql_num_rows($check);

 if ($check2 == 0) {

 		die('That user does not exist');

 				}

 while($info = mysql_fetch_array( $check )) 	

 {

 $_POST['pass'] = stripslashes($_POST['pass']);

 	$info['password'] = stripslashes($info['password']);

 	$_POST['pass'] = md5($_POST['pass']);



 //gives error if the password is wrong

 	if ($_POST['pass'] != $info['password']) {

 		die('Incorrect password, please try again.');

 	}


 else 

 { 

 
 // if login is ok then we add a cookie 

 	 $_POST['username'] = stripslashes($_POST['username']); 

 	 $hour = time() + 10000; 

 setcookie(ID_my_site, $_POST['username'], $hour); 

 setcookie(Key_my_site, $_POST['pass'], $hour);	 

 

 //then redirect them to the members area 

 header("Location: home.php"); 

 } 

 } 

 } 

 else 

{	 

 

 // if they are not logged in 

 ?> 

 <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> 



<h1>Login</h1>

Username:

 <input type="text" name="username" maxlength="40"> 



Password:

 <input type="password" name="pass" maxlength="50"> 



 <input type="submit" name="submit" value="Login"> 


 </form> 

 <?php 

 } 

 

 ?> 



<p class = "end"></p>
</body>

</html>

