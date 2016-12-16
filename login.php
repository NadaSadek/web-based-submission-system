<?php
session_start();
$_SESSION['Email']=mysql_real_escape_string(isset($_POST['email'])?($_POST['email']):'');
mysql_connect('localhost', 'root', '') or die("I couldn't connect to your database, please make sure your info is correct!");
mysql_select_db('sys') or die("I couldn't find the database table make sure it's spelt right!");

echo ' <html>
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
		   </div><div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">

';

	$email=mysql_real_escape_string(isset($_POST['email'])?($_POST['email']):'');
	$pass=mysql_real_escape_string(isset($_POST['password'])?($_POST['password']):'');
	
	$query  = mysql_query("SELECT * FROM authors WHERE email='$email' AND password='$pass' AND accepted=1");
	$query1 = mysql_query("SELECT * FROM conf_table WHERE chair='$email' ");	
	$query2 = mysql_query("SELECT * FROM track_table WHERE track_chair='$email'");	
	$query3 = mysql_query("SELECT * FROM reviewers WHERE email='$email' ");	
	$query4  = mysql_query("SELECT * FROM authors WHERE email='$email' AND password='$pass' AND admin=1");

	if(mysql_num_rows($query) != 0){
	if (isset($_POST['rememberme'])) {
            /* Set cookie to last 1 year */
            setcookie('email', $email, time()+60*60*24*365, '/submission');
            setcookie('password', $pass, time()+60*60*24*365, '/submission');
        
        } else {
            /* Cookie expires when browser closes */
            setcookie('email', $email, false, '/submission');
            setcookie('password', $pass, false, '/submission');
        }
		if(mysql_num_rows($query4) != 0){
header("Location:admin.php");
			}	
  echo '<a class="Button" href="researcher.php"><span> Author </span></a></br>';
  
			if(mysql_num_rows($query3) != 0){

	echo '<a class="Button" href="reviewer.php"><span> Reviewer </span></a></br>';

			}
			 if(mysql_num_rows($query2) != 0){
            echo '<a class="Button" href="trackChairProfile.php"><span> Track Chair </span></a></br>';

			}
			 if(mysql_num_rows($query1) != 0){

                echo '<a class="Button" href="confChairProfile.php"><span> Conference Chair </span></a></br>';
			}
			$rev  = mysql_query("SELECT * FROM reviewers WHERE email='$email' AND accepted=0");
		$count=0;
		 if(mysql_num_rows($rev) != 0){
			 echo '<h2> You have a pending request as a reviewer</h2>
			 <b>Note:</b><span style="color:blue;text-align:center;"> This cannot be undone!</span></br>
';
			 }
			while($row1 = mysql_fetch_array($rev)){
			$count++;
			$cid1=$row1['conf_id'];
			$trk=$row1['track_name'];
		$conf  = mysql_query("SELECT * FROM conf_table WHERE id='$cid1'");
			$row2 = mysql_fetch_array($conf);
			 if(mysql_num_rows($rev) != 0){
echo '</br>
<b>Conference Name: </b> '.$row2['name'].'</br>
<b>Track Name: </b> '.$trk.'</br>';
if((isset($_POST["$count"]))){
$acc=$_POST["ac"];
 if($acc == 1){
 $l=mysql_query("update reviewers SET accepted=1 WHERE email='$email' AND track_name='$trk'  AND conf_id='$cid1'") or die(mysql_error());
echo '<span style="color:green;text-align:center;"> you accepted the invitation as a reviewer!</span></br></br>';
}
else if($acc==0){
$subject="Reviewer Declined!";
  $message="Reviewer: ".$email."declined your request as a reviewer in Track: ".$trk;
  $message = wordwrap($message, 70);
  mail($email,$subject,$message,"nadasadek92@gmail.com");
$l=mysql_query("DELETE FROM reviewers WHERE email='$email' AND track_name='$trk' AND conf_id='$cid1'") or die(mysql_error());
echo '<span style="color:red;text-align:center;"> You rejected the invitation!</span></br></br>';
}
}
else {
echo '<form method="post" action="'.$_SERVER["PHP_SELF"].'">
<input type="radio" name="ac" value="1" checked>Accept
<input type="radio" name="ac" value="0">Reject</br>
<span class="ButtonInput"><span><input type="submit" name="'.$count.'"  value="Done"></span></span>
</form>';
}
}}
	} else {
	echo "email or/and password are incorrect";
			echo '<form action ="login.php" method="POST">
	<div id="login">    
	<h2> Login </h2>
	<LABEL>Email</LABEL> <LABEL class="red"> * </LABEL> : </br>
	</span><span id="av"></span><br>
   <INPUT type="text" id="Email" name="email" size="20px" placeholder="enter your email" onblur="bluremail();"><span id="emailblur"><br>
 <LABEL>Password</LABEL> <LABEL class="red"> * </LABEL> : </br>
<span id="ava"></span><br>
 <INPUT type="password" id="Password" name="password" size="20px" placeholder="enter your password" onblur="blurpassword();"><br>
<span class="ButtonInput"><span><input type ="submit" class="button" id="buttonssubmit"  name="submit" onclick="check();" value="Login"></span></span></br></div>
</div></form>';
	}
echo '</div></div></body></html>';
mysql_close();
?>
