<?php
session_start();
$email = isset($_SESSION['Email']) ? $_SESSION['Email'] : '';
//$type=isset($_SESSION['Type1'])? $_SESSION['Type1']: '';
//$conf_id=isset($_SESSION['conf_id1'])? $_SESSION['conf_id1']: '';

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

		   </div>   <div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';

if (!isset($_POST["submit"]))
  {

	echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'">
	<h1>please complete your profile</h1> </br>
		   
       Email:  '.$email.' </br>
       Password <span style="color:red;text-align:center;"> * </span> : </br>
       <input type="password" id="Password" name="password"></br> 
       Confirm Password <span style="color:red;text-align:center;"> * </span> : </br>
       <input type="password" id="ConfirmPassword" name="confirmpassword" onblur="confirm();"></br> 
 Name <span style="color:red;text-align:center;"> * </span> : </br>
       <input type="text" id="firstname" name="firstname" ></br>        	   	   
	<span class="ButtonInput"><span><input type="submit" value="Sign Up" class="button" name="submit"> </span></span>
	</form>';
 }
if(isset($_POST["submit"]))
  {
$password =  mysql_real_escape_string($_POST["password"]);
$confirmpassword =  mysql_real_escape_string($_POST["confirmpassword"]);
$first = mysql_real_escape_string($_POST["firstname"]);
if($password == $confirmpassword){
		$sql=mysql_query("UPDATE authors SET password='$password', accepted=1,Name='$first' WHERE email='$email'");
		$query = mysql_query("SELECT * FROM reviewers WHERE email='$email'");
		$query1 = mysql_query("SELECT * FROM track_table WHERE track_chair='$email'");
		$query2 = mysql_query("SELECT * FROM conf_table WHERE chair='$email'");
 /* Cookie expires when browser closes */
            setcookie('email', $email, false, '/submission');
            setcookie('password', $password, false, '/submission');
			
   echo '<a class="Button" href="researcher.php"><span> Author </span></a>';

 if(mysql_num_rows($query2) != 0){

               echo '<a class="Button" href="confChairProfile.php"><span> Conference Chair </span></a>';

			}
		
     else if(mysql_num_rows($query) != 0){
			echo '<a class="Button" href="reviewer.php"><span> Reviewer </span></a>';

			}
			     else if(mysql_num_rows($query1) != 0){

               echo '<a class="button" href="trackChairProfile.php"><span> Track Chair </span></a>';
}			}

		}
	

		
echo '</div></div></body></html';