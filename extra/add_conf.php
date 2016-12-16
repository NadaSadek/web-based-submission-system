<?php
session_start();
$type=$_SESSION['Type'];
$username = isset($_SESSION['Username']) ? $_SESSION['Username'] : '';
$type=isset($_SESSION['Type'])? $_SESSION['Type']: '';
mysql_connect('localhost', 'root', '') or die("I couldn't connect to your database, please make sure your info is correct!");
mysql_select_db('submission_system') or die("I couldn't find the database table make sure it's spelt right!");
?>
<html>

<head>
	
 <link rel="stylesheet" href="signup.css">

</head>

	<div id="header">
		<h1>
			Submission System
		</h1>
	</div>
	<div id="navigation">
		<ul>
			<li><a href="main1.html">Home</a></li>
			<li><a href="#">Search</a></li>
			<li><a href="ContactUS.html">Contact us</a></li>
			<li><a href="#">Sitemap</a></li>
		</ul>
	</div>
	
<body>
<?php
 
if(isset($_POST["submit"]))
  // the user has submitted the form
  {
  // Check if the "to" input field is filled out
  if (isset($_POST["name"]))
    { 
	$link1= 'admin.php';
	$link3= 'allTrack.php';
	$conf=$_POST["name"];
	$track=$_POST["track"];
	$username=$_POST["checking"];
	$year= $_POST["year"];
	$myArray = explode(',', $track);
	  $link = 	 "<a href=\"$link1\">go back to profile</a>";
	  $link2 = 	 "<a href=\"$link3\">Add Track Heads</a>";
  $sql = mysql_query("INSERT INTO conf_table (conf_name,conf_chair_username,year) VALUES ('$conf','$username','$year')");
    $conf_id=mysql_insert_id();
    $sql3 = mysql_query("UPDATE users SET conf_id='$conf_id' WHERE username='$username'");
    $sql2 = mysql_query("UPDATE conf_chair SET assigned=1 WHERE username='$username'");

$id=mysql_insert_id();
	  foreach($myArray as $tr){
	  $query = mysql_query("INSERT INTO conf_track (conf_id,track_name) VALUES ('$id','$tr')");
	

	  }
	  echo "done! you can now"." ".$link." "."or"." ".$link2."</br>";
	  echo "you can add another conference";
	}
	
	}

?>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>"> 
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

	<?php
	  	$query1 = mysql_query("SELECT * FROM conf_chair");
	while($row1 = mysql_fetch_array($query1)){
$head=$row1['username'];
?>
<input type="radio" name="checking" value="<?php echo $head?>" checked> <?php echo $head ?> </br>
<?php
}?>
<input type="submit" class="button" name="submit"  value="add">
  
  </form>

</body>
</html>
<?php
mysql_close();
	?>