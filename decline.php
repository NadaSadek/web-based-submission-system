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


if (isset($_POST["submit"])) {  
	
	$code= $_POST["code"];
    $query1= mysql_query("SELECT * FROM authors WHERE code='$code'");	
  if(mysql_num_rows($query1) != 0)
		{ 	
  
  $row = mysql_fetch_array($query1);
  $email=$row['email'];
  $query2= mysql_query("SELECT * FROM reviewers WHERE email='$email' AND accepted=0");	
  $row1= mysql_fetch_array($query2);
  $track=$row1['track_name'];
  $subject="Reviewer Declined!";
  $message="Reviewer: ".$email."declined your invitation as a reviewer in Track: ".$track;
  $message = wordwrap($message, 70);
  mail($email,$subject,$message,"nadasadek92@gmail.com");
  $delete1= mysql_query("DELETE FROM authors WHERE code='$code'");	
 $delete2= mysql_query("DELETE FROM reviewers WHERE email='$email' AND accepted=0");	

echo "you declined the invitation";
		}
		else{
echo "invalid code";
}
}
echo '<h2>Please Enter your Code to Decline the Invitation as a Reviewer</h2>
  <form method="post" action="'.$_SERVER["PHP_SELF"].'">
  <input type="text" name="code"><br>
  <span class="ButtonInput"><span><input type="submit" name="submit" value="Submit"></span></span>
  </form>';
  
echo '</div></div>
</body>
</html>';