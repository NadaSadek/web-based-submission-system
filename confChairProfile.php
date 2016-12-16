<?php
session_start();
$email = isset($_SESSION['Email']) ? $_SESSION['Email'] : '';
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
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">
		My Email:'.$email.'<br>
	 </div></div>';
	 function test($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

		echo  '<div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';
		
echo'<h2>Update Notifications</h2>';
echo 'Note: <span style="color:red;text-align:center;">The update will be seen by all users of the conference</span></br>';
echo '</br>';
   $qur = mysql_query("SELECT * FROM conf_table WHERE chair='$email' AND blocked=0");
	while($rowq1 = mysql_fetch_array($qur)){
	$conf_name=$rowq1['name'];
	$conf_year=$rowq1['year'];
	$conf_id=$rowq1['id'];
	$note=$rowq1['msg'];
echo $conf_name."-".$conf_year;
 echo '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
 <input type="hidden" value="'.$conf_id.'" name="id">
<input type="text" name="notify"><br>
<span class="ButtonInput"><span><input type="submit" name="'.$conf_id.'" value="update"></span></span><br></form>';
if(isset($_POST["$conf_id"])){
if(isset($_POST["notify"])){
$notify=$_POST["notify"];
$notify=test($notify);
$id=$_POST["id"];
$su=mysql_query("UPDATE conf_table SET msg='$notify' WHERE id='$id'");
echo 'Latest Update:  <span style="color:blue;text-align:center;">'.$notify.'</span></br>';
}
else echo '<span style="color:red;text-align:center;">You did not update the message!</span></br>';

}
else{
echo 'Latest Update: <span style="color:blue;text-align:center;">'.$note.'</span></br>';

}
} 
echo '</div></div>';
	
   $v = mysql_query("SELECT * FROM conf_table WHERE chair='$email' AND blocked=0");
   if(mysql_num_rows($v) != 0){
   echo  '<div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';
   echo '<h2>Manage Conferences</h2>';
   echo 'Note:  <span style="color:red;text-align:center;">When your conference is over, block it to stop any activity within it.</span></br>';
   echo '</br>';
   }
	while($rowv = mysql_fetch_array($v)){
	$coname=$rowv['name'];
	$coyear=$rowv['year'];
	$conid=$rowv['id'];

$var=$conid."-".$coyear;
if(!(isset($_POST["$var"]))){
echo $coname."-".$coyear;
echo '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
<input type="hidden" value="'.$conid.'" name="id">
<span class="ButtonInput"><span><input type="submit" name="'.$var.'" value="Block"></span></span></form>';
}
else{
$coid=$_POST["id"];
$sv=mysql_query("UPDATE conf_table SET blocked=1 WHERE id='$coid'");
echo '<span style="color:red;text-align:center;">Conference is blocked successfully.</span></br>';
	header('Refresh: 2; URL=http://localhost/submission/confChairProfile.php');
}

}
echo '</div></div>';
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
    	echo  '<div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';

echo '<h2>Assign Track Chairs</h2>';
echo 'Note:  <span style="color:red;text-align:center;">If chairpersons are not users of the system, an invitation to become users will be sent to them.</span></br>';
echo '</br>';

if(isset($_POST["invite"]))  {
  if (isset($_POST["to"]))  { 
      $mailcheck = spamcheck($_POST["to"]);
	  $conf=$_POST["conf"];   	
      $track=$_POST["track"];	
      $conf_id=$_POST["id"];	  
	  $email = $_POST["to"]; 
	  $code= md5($email.time());
      $query1 = mysql_query("SELECT * FROM authors WHERE email='$email' AND accepted=1");
    if ($mailcheck==FALSE)   {
      echo "Invalid input</br>";
}
      
  
else{    
 if (strlen($email)>0) {
  if(mysql_num_rows($query1) != 0){
  $subject="Notification From Submission System";
  $message="You are now a track chair in ".$conf;
  $message = wordwrap($message, 70);
  mail($email,$subject,$message,"nadasadek92@gmail.com");
  $sql3=mysql_query("UPDATE track_table SET track_chair='$email' WHERE track_name='$track' AND conf_id='$conf_id'");
  echo "this email already has an account. An Email was sent to notify him/her that he/she became a track chair in ".$conf;
  	header('Refresh: 4; URL=http://localhost/submission/confChairProfile.php');

}
else{
      $subject = "Invitation to Submission System";
      $message = "please follow the link below and enter your invitation code: ";
	  $navigation_variable= 'verification.php';
	  $link = 	 "<a href=\"$navigation_variable\">Verify your Account</a>";
      $message = wordwrap($message, 70);
      mail($email,$subject,$message." ".$code.$link,"nadasadek92@gmail.com");
	  $sql3=mysql_query("INSERT INTO authors (code,email) VALUES ('$code','$email')");
	  $sql4=mysql_query("UPDATE track_table SET track_chair='$email' WHERE track_name='$track'  AND conf_id='$conf_id'");
	 echo ' <span style="color:blue;text-align:center;">you successfully sent an invitation to '.$email.'</span></br>'; 
	header('Refresh: 4; URL=http://localhost/submission/confChairProfile.php');
	 	//  header("Location:confChairProfile.php");

      }
    }
	}
   }
  }
echo '<form method="post" action="'.$_SERVER["PHP_SELF"].'">'; 
  echo 'Email:';
  echo '<input type="text" name="to" id="e"><br>';
  echo 'Conference: <br>';
   $qu = mysql_query("SELECT * FROM conf_table WHERE chair='$email' AND blocked=0");
	while($row1 = mysql_fetch_array($qu)){
          $conf_name=$row1['name'];
          $conf_year=$row1['year'];
		  $conf_id=$row1['id'];
echo '<input type="hidden" name="id" value="'.$conf_id.'">
<input type="radio" name="conf" value="'.$conf_name.'" checked> '.$conf_name.' - '.$conf_year.' </br>';
    $que = mysql_query("SELECT * FROM track_table WHERE conf_id='$conf_id' And track_chair IS NULL");
 echo "Track:"."<br>";	
 while($rw = mysql_fetch_array($que)){
    $track_name=$rw['track_name'];
echo '<input type="radio" name="track" value="'.$track_name.'" checked> '.$track_name.' </br>';
	} }
 echo '<span class="ButtonInput"><span><input type="submit" class="button" name="invite"  value="Invite"></span></span></form>'; 
 echo '</div></div>';
   	echo  '<div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';
		
  if(isset($_POST["invite1"]))  {
    if (isset($_POST["to"]))  { 
      $mailcheck = spamcheck($_POST["to"]);
	  $conf=$_POST["conf"];   
      $track=$_POST["track"];	  
      $conf_id=$_POST["id"];	  
	  $email = $_POST["to"]; 
	  $code= md5($email.time());
      $query1 = mysql_query("SELECT * FROM authors WHERE email='$email'");
    if ($mailcheck==FALSE)   {
      echo "Invalid input</br>";
	  	 	header('Refresh: 2; URL=http://localhost/submission/confChairProfile.php');

} 
else{    
 if (strlen($email)>0) {
  if(mysql_num_rows($query1) != 0){
     $revc = mysql_query("SELECT * FROM reviewers WHERE email='$email' AND track_name='$track' AND conf_id='$conf_id' AND accepted=1");
		if(mysql_num_rows($revc) != 0){
		echo "this person is already a reviewer in this track!";
		}
	 $revs = mysql_query("SELECT * FROM reviewers WHERE email='$email' AND track_name='$track' AND conf_id='$conf_id' AND accepted=0");
		if(mysql_num_rows($revs) != 0){
		echo "You already sent an invitation to this person but they still haven't replied yet!";
		}
		else {
  $subject="Notification From Submission System";
  $message="Please check your homepage to accept or decline a pending request as reviewer in conference: ".$conf."in track: ".$track;
  $message = wordwrap($message, 70);
  mail($email,$subject,$message,"nadasadek92@gmail.com");
  $sql4=mysql_query("INSERT INTO reviewers (track_name,conf_id,email) VALUES ('$track','$conf_id','$email')") or die(mysql_error());
  echo "this email already has an account. An Email was sent to notify him/her about the pending request";
  	header('Refresh: 4; URL=http://localhost/submission/confChairProfile.php');
}}
else{
      $subject = "Invitation to Submission System";
      $message = "you are invited to become a reviewer in ".$conf."-".$track." please follow the link below and enter your invitation code: ";
	  $navigation_variable= 'verification.php';
	  $navigation_variable1= 'decline.php';
	  $link = 	 "<a href=\"$navigation_variable\">Accept and Verify Account</a>";
	  $link1 = 	 "<a href=\"$navigation_variable1\">Decline Request</a>";
      $message = wordwrap($message, 70);
      mail($email,$subject,$message." ".$code."</br>".$link." ".$link1,"nadasadek92@gmail.com");
	  $sql3=mysql_query("INSERT INTO authors (code,email) VALUES ('$code','$email')");
	  $sql4=mysql_query("INSERT INTO reviewers (track_name,conf_id,email) VALUES ('$track','$conf_id','$email')");
	 echo "you successfully sent an invitation to"." ".$email; 
	 	header('Refresh: 4; URL=http://localhost/submission/confChairProfile.php');

      }
    }
	}
   }
   }
   
  echo '<h2>Invite Reviewers to your conference</h2>';
  echo 'Note:  <span style="color:red;text-align:center;">If reviewers are not users of the system, an invitation will be sent to them to become users.</span></br>';
   echo '</br>';
  echo '<form method="post" action="'.$_SERVER["PHP_SELF"].'">'; 
  echo 'Email:';
echo  '<input type="text" name="to" id="e"><br>';
  echo 'Conference: <br>';
   $qu2 = mysql_query("SELECT * FROM conf_table WHERE chair='$email' AND blocked=0");
	while($row1 = mysql_fetch_array($qu2)){
          $conf_name=$row1['name'];
          $conf_year=$row1['year'];
		  $conf_id=$row1['id'];
echo '<input type="hidden" name="id" value="'.$conf_id.'">';
echo '<input type="radio" name="conf" value="'.$conf_name.'" checked> '.$conf_name.' - '.$conf_year.' </br>';
$qu1 = mysql_query("SELECT * FROM track_table WHERE conf_id='$conf_id'");
echo "Track:"."<br>";
	while($row11 = mysql_fetch_array($qu1)){
	$track_name=$row11['track_name']; 	
	echo '<input type="radio" name="track" value="'.$track_name.'" checked> '.$track_name.'</br>';
	}
	echo '<span class="ButtonInput"><span><input type="submit" class="button" name="invite1"  value="Invite"></span></span></form>';
}
echo '</div></div>';

echo ' <div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">
<h2> Evaluation Result: </h2></br>';
$sk=mysql_query("SELECT * FROM conf_table WHERE chair='$email' AND blocked=0");
while($roww = mysql_fetch_array($sk)){
$cod=$roww['id'];
$cnam=$roww['name'];
$sk1=mysql_query("SELECT * FROM papers WHERE accepted is NOT NULL AND conf_id='$cod'");
while($row12 = mysql_fetch_array($sk1)){
$paper_id=$row12['file_id'];
$authors=$row12['authors'];
$track_name=$row12['track_name'];
$acc=$row12['accepted'];
echo "<b>Conference: ".$conf_name."</br>"."Track: ".$track_name."</b></br><b>Authors:".$authors."</b></br>";
if($acc==2){
echo '<b>Decision by track chairperson: <span style="color:green;text-align:center;">Accepted</span></br></br>';
}
else if($acc==1){
echo '<b>Decision by track chairperson: <span style="color:red;text-align:center;">Rejected</span></br></br>';
}
echo '</br>';
}
}

echo '</div></div></body></html>';