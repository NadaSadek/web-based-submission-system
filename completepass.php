<?php
session_start();
mysql_connect('localhost', 'root', '') or die("I couldn't connect to your database, please make sure your info is correct!");
mysql_select_db('sys') or die("I couldn't find the database table make sure it's spelt right!");
echo '<html>
<link rel="stylesheet" href="style.css">
 <script type="text/javascript" src="main.js"></script>

	<body>
    <div class="BodyContent">

    <div class="BorderBorder"><div class="BorderBL"><div></div></div><div class="BorderBR"><div></div></div><div class="BorderTL"></div><div class="BorderTR"><div></div></div><div class="BorderT"></div><div class="BorderR"><div></div></div><div class="BorderB"><div></div></div><div class="BorderL"></div><div class="BorderC"></div><div class="Border">

        <div class="Menu">
            <ul><li><a href="main.php" class="ActiveMenuButton"><span>Home</span></a></li> <li><a href="search.php" class="MenuButton"><span>Search</span></a></li> <li><a href="contactus.php" class="MenuButton"><span>Contact Us</span></a></li></ul>
        </div><div class="Header">
          <div class="HeaderTitle">
            <h1>Web-Based Submission System</h1>
        </div>  

		   </div>

		   <div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';


   if (!isset($_POST["submit1"])){
echo '<h1>	Please Choose a Password</h1> </br>';
echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'">
  Password <span style="color:red;text-align:center;">* </span> : </br>
  <input type="password" id="Password" name="password"></br>
  Confirm Password <span style="color:red;text-align:center;"> * </span> : </br>
  <input type="password" id="ConfirmPassword" name="confirmpassword" onblur="confirm();"></br>
	<span class="ButtonInput"><span><input type="submit" value="done" name="submit1"></span></span>';
	 }
	else{
	  $email=$_SESSION['Email'];
	  $password=$_POST['password'];
	  $confirmpassword=$_POST['confirmpassword'];
	  if($password == $confirmpassword){
	  /* Cookie expires when browser closes */
            setcookie('email', $email, false, '/submission');
            setcookie('password', $password, false, '/submission');
		
		$sql=mysql_query("UPDATE authors SET password='$password', accepted=1 WHERE email='$email'");
	  header("Location:researcher.php");
	}
	else {
	echo '<span style="color:red;text-align:center;"> Both Password Fields are not matched! </span></br>';
	}
}

echo '</div></div></body></html>';
