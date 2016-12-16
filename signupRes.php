<?php
session_start();
mysql_connect('localhost', 'root', '') or die("I couldn't connect to your database, please make sure your info is correct!");
mysql_select_db('sys') or die("I couldn't find the database table make sure it's spelt right!");

	
echo '<html>
<link rel="stylesheet" href="style.css">

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
		   		  		        <a class="Button" href="logout.php"><span> Logout</span></a></br>

		   <div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';
function spamcheck($field)
  {
  // Sanitize e-mail address
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);
  // Validate e-mail address
  if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
    return TRUE;
    }
  else
    {
    return FALSE;
    }
  }

// display form if user has not clicked submit
if (!isset($_POST["submit"]))
  {
echo '<form  method="POST" action="'.$_SERVER["PHP_SELF"].'">   
<h1>Signup as an author</h1> </br>
       Email <span style="color:red;text-align:center;"> * </span> : </br>
      <input type="text" id="email" name="email"></br> 
      Name <span style="color:red;text-align:center;"> * </span> : </br>
       <input type="text" id="firstname" name="firstname" ></br>     
	<span class="ButtonInput"><span><input type="submit" value="Sign Up" class="button" name="submit"></span></span>
</form>';
	
}
else{
// Check if the "to" input field is filled out
  if (isset($_POST["email"]))
    { 
    // Check if "to" email address is valid
    $mailcheck = spamcheck($_POST["email"]);
    if ($mailcheck==FALSE)
      {
      echo '<span style="color:red;text-align:center;">Invalid input</span></br>';
  
}

$_SESSION['Email']=mysql_real_escape_string($_POST["email"]);
$email = mysql_real_escape_string($_POST["email"]);
$first = mysql_real_escape_string($_POST["firstname"]);
$message = "please follow the link below and enter your confirmation code: ";
$navigation_variable= 'localhost/submission/verification.php';
$link = 	 "<a href=\"$navigation_variable\">Verify your Account as a Researcher</a>";
$code=md5($email.time()); 
      $query2 = mysql_query("SELECT * FROM authors WHERE email='$email'");
     if(mysql_num_rows($query2) != 0){
echo '<span style="color:red;text-align:center;">this email already has an account.</br></span>';
}
else{ 
$to=$email;
$subject="Email verification";
  // message lines should not exceed 70 characters (PHP rule), so wrap it
      $message = wordwrap($message, 70);
      // send mail
      mail($email,$subject,$message." ".$code.$link,"nadasadek92@gmail.com");
	  $navigation_variable1= 'main.php';
	  $link1= 	 "<a href=\"$navigation_variable1\">Go Back to HomePage</a>";

	echo'<span style="color:green;text-align:center;">You signed up successfully. Please check your email for confirmation code</br>.'.$link1.'.</span>';

	 $query=mysql_query("INSERT INTO authors (code,email,accepted,Name) VALUES ('$code','$email',0,'$first')");

	
}
}

}

echo '</div></div></body></html>';