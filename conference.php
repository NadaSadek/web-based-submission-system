<?php
session_start();
$username=$_GET['username'];
$conf_id=$_GET['conf_id'];
$_SESSION['username']=$username;
$_SESSION['conf_id']= $conf_id;
define('DB_NAME','submission_system');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_HOST','localhost');



$link=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);

if(!$link){
	die('couldnt connect'.mysql_error());
}



$db_selected=mysql_select_db(DB_NAME,$link);

	if(!$db_selected){
		die('cant use '.DB_NAME.':'.mysql_error());
		
	}
	
$query1= mysql_query("SELECT * FROM conf_track WHERE conf_id = '$conf_id' ");
$query2= mysql_query("SELECT * FROM users WHERE username='$username'");
	  while($row = mysql_fetch_array($query2)){
	  $_SESSION['researcher_id']=$row['id'];
	  }

?>

<html>

 <link rel="stylesheet" href="main.css">
 <script type="text/javascript" src="profile.js"></script>
 <div id="header">
		<h1>
			Submission System
		</h1>
	</div>
	<div id="navigation">
		<ul>
			<li><a href="main1.html">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Search</a></li>
			<li><a href="ContactUS.html">Contact us</a></li>
		</ul>
	</div>
	
<?php
	  while($row = mysql_fetch_array($query1)){
echo $row['track_name']."<br>"; 
$_SESSION['track_name']=$row['track_name'];

?>
<form action="upload_file.php" method="post" enctype="multipart/form-data">
<label for="file">Choose a paper to upload:</label>
<input type="file" name="file" id="file" value="Browse"><br>
<input type="submit" name="submit" value="Ulpoad File" >
</form>
<?php


}
?>
	