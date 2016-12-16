<?php
session_start();
$email = isset($_SESSION['Email']) ? $_SESSION['Email'] : '';
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
		   		  		        <a class="Button" href="logout.php"><span> Logout</span></a></br>

		   <div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';

			echo	'<li><a href="allRes.php">Block Users</a></li>
				<li><a href="unblock.php"> Unblock Users</a></li></div></div>';


			
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
        echo '<div class="MainColumn"><div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">

<h2>Invitation to Conference Chairperson to Join The System</h2>';

if(isset($_POST["submit"]))
  // the user has submitted the form
  {
  // Check if the "to" input field is filled out
  if (isset($_POST["to"]))
    { 
    // Check if "to" email address is valid
    $mailcheck = spamcheck($_POST["to"]);
	$conf_name=$_POST['name'];
	  $year=$_POST['year'];
	  $track=$_POST["track"];
	  $myArray = explode(',', $track);
	  $email = $_POST["to"]; 
      $query2 = mysql_query("SELECT * FROM authors WHERE email='$email'");
    if ($mailcheck==FALSE)
      {
      echo "Invalid input</br>";
}
else{    
 if (strlen($email)>0) {
if(mysql_num_rows($query2) == 0){
      $subject = "Invitation to Submission System";
	  $code= md5($email.time());
      $message = "please follow the link below and enter your invitation code: ";
	  $navigation_variable= 'verification.php';
	  $link = 	 "$navigation_variable";
      $message = wordwrap($message, 70);
      mail($email,$subject,$message." ".$code.$link,"nadasadek92@gmail.com");
	  $sqql=mysql_query("INSERT INTO authors (code,email) VALUES ('$code','$email')");
	 echo "you successfully sent an invitation to"." ".$email." to join the system as a conference chairperson for ".$conf_name; 
      }
	  
	  else {
	  $subject= "Submission System Notification: Conference Chairperson";
	  $message= "you are now the chairperson of ".$conf_name;
	  	        mail($email,$subject,$message,"nadasadek92@gmail.com");
echo "This account exists! An email was sent to the user stating that she/he was added as the chairperson of ".$conf_name;
	  }
	  }
	  $sql=mysql_query("INSERT INTO conf_table (name,year,chair) VALUES ('$conf_name','$year','$email')");
	  $conf_id=mysql_insert_id();
	  foreach($myArray as $tr){
	  $sql1=mysql_query("INSERT INTO track_table (conf_id,track_name) VALUES ('$conf_id','$tr')");
	 }
	  
	  }
    }
	}
	
  
  echo '<form method="post" action="'.$_SERVER["PHP_SELF"].'"> 
  Email: <br><input type="text" name="to" id="e"><br>
  Conference Name:<br>
  <input type="text" name="name" id="n"><br>
  Year:
  <select id="year" name="year">
  <option value="2014">2014</option>
  <option value="2015">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
  <option value="2019">2019</option>
  <option value="2020">2020</option>
  <option value="2021">2021</option>
  <option value="2022">2022</option>
  <option value="2023">2023</option>
  <option value="2024">2024</option>
  <option value="2025">2025</option>
  </select><br>
  Enter Conference Tracks separated by a (,):  </br>
  <input type="text" name="track" id="t"><br>
  <span class="ButtonInput"><span><input type="submit" name="submit"  value="Done"></span></span>
  </form></div></div>';
    echo '<div class="MainColumn"><div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">
';
if(isset($_POST["submit1"]))
  {
  if (isset($_POST["admin"]))
    { 
    $check = spamcheck($_POST["admin"]);
	$e=$_POST["admin"];
	 if ($check==FALSE)  {
      echo "Invalid input</br>";
}
else{    
 if (strlen($e)>0) {
       $que = mysql_query("SELECT * FROM authors WHERE email='$e'");

if(mysql_num_rows($que) == 0){
      $subject = "Invitation to Submission System";
	  $password= md5($e.time());
      $message = "you have been added as an admin in Web-Based Submission System. Please use your email with this password: ".$password."</br>";
	  $navigation_variable= 'main.php';
	  $link = 	 "$navigation_variable";
      $message = wordwrap($message, 70);
      mail($e,$subject,$message.$link,"nadasadek92@gmail.com");
	  $sqql=mysql_query("INSERT INTO authors (password,email,accepted,admin) VALUES ('$password','$e',1,1)") or die(mysql_error());
		echo '<span style="color:green;text-align:center;">you successfully sent an invitation to '.$e.' to join the system as an admin</span></br>';
}
else {
		echo '<span style="color:red;text-align:center;">This email already exists and can not be an  admin</span></br>';
}
	}
	}
	}
	}
echo '<h2> Add New Admin </h2></br>
Note: password will be randomly generated and sent to the new admin</br>
</br>
	<form method="post" action="'.$_SERVER["PHP_SELF"].'"> 
  Please Enter Email of Admin: </br>
    <input type="text" name="admin" id="admin"><br>
	 <span class="ButtonInput"><span><input type="submit" name="submit1"  value="Done"></span></span>
  </form></div></div>
  </body></html>';