<html>
   <head>
   <title>Listing 4.2 Changing the type of a variable with settype()</title>
   </head>
  <body>
 
   <?php
   /* 
        Variable testing using gettype, settype(varName,type), all variables named with $ 
   */
   $undecided = 3.14;  
   print gettype( $undecided ); // double
   print " is $undecided<br>";  // 3.14
  settype( $undecided, 'string' );
  print gettype( $undecided ); // string
  print " is $undecided<br>";  // 3.14
  settype( $undecided, 'integer' );
  print gettype( $undecided ); // integer
  print " is $undecided<br>";  // 3
  settype( $undecided, 'double' );
  print gettype( $undecided ); // double
  print " is $undecided<br>";  // 3.0
  settype( $undecided, 'boolean' );
  print gettype( $undecided ); // boolean
  print " is $undecided<br>";  // 1
  $name = 5;
  $name2 = 10;
  define("tires", 5); 
  print " <br> multiply string $name * $name2 "; 
  /*
     constant use define("name",value, boolean(for case dependency)
  */
  define("Robert","Awesome"); 
  print "<br> Robert is      " .Robert .PHP_VERSION; 
  
  /*
  conditional statements
  */
  $name = 5 + tires;
  if (tires == 5) print " <br>robert is awesome" . "&nbsp &nbsp &nbsp" . "concat test" . 5;
  else print "<br>name is equal to $name" ;
  $awesome = 5; 
  
  switch($awesome) {
  
  case 1: print "hello"; 
  break; 
  case 5: print "<br/>u got 5"; 
  break; 
  default: 
  print "this is default"; 
  break; 
  
  
  }
  
  $var = 10; 
  $var = ($awesome == 5) ? print "<br> true" : print "<br> false" ; 
  echo "hello"; 
  echo "can", "take", "mulitple", "lines", chr(10); 

  //function names are not case sensitive
  //variable names are
  function awesome(){
	  ?>
	  <h1><p>You are the friken man!</p></h1>
	  <br/> <h2>if anyone can do it you can!<h2>
	  <?php
  }
  
  awesome();
  $acer = 5; 
  $glo = 10; 
  function scope(){
  global $glo;
  $acer = 10; 
  echo $acer . ": value inside  the function <br/>"; 
  $glo = 30;
  echo $glo . ": value inside  the function <br/>";
  }
  scope();
  echo $acer . ":value outside the function"; 
  echo $glo . ":value outside the function";
  
  $scopetest = 259252; 
   ?>
   
   <?php
   echo $scopetest;
   
   // parameter you can use & to make a reference value. 
   ?>
   
   
  </body>
</html>
