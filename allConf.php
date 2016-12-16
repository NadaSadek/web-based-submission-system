<?php
session_start();
$type=$_SESSION['Type'];
$email = isset($_SESSION['Email']) ? $_SESSION['Email'] : '';
$type=isset($_SESSION['Type'])? $_SESSION['Type']: '';
mysql_connect('localhost', 'root', '') or die("I couldn't connect to your database, please make sure your info is correct!");
mysql_select_db('submission_system') or die("I couldn't find the database table make sure it's spelt right!");
?>
<html>

<head>
	<script type="text/javascript" src="allconf.js"></script>
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
 <span id="del"></span>

<?php

	$query = mysql_query("SELECT * FROM users WHERE type='conf_chairman'");
	$query1 = mysql_query("SELECT * FROM conf_table WHERE conf_chair_email=''");

	
	while($row = mysql_fetch_array($query)) { 
  $value1=$row['username'];
  $value2=$row['email'];


	
	
 ?>


	<div class="description">
	<?php echo 'Username:'.$value1."<br />";
     echo 'Email: '.$value2."<br />";
    ?>
	Chairperson for:
	<?php
	$query2 = mysql_query("SELECT * FROM conf_table WHERE conf_chair_email='$value2'");
	if(mysql_num_rows($query2) != 0)
		{
		  $row = mysql_fetch_array($query2);
		echo $row['conf_name'];
}
else {		
	?>
	</br>
	<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>"> 

	<?php
	if(mysql_num_rows($query1) != 0){
	while($row1 = mysql_fetch_array($query1)){
$conf=$row1['conf_name'];

?>
<input type="radio" name="checking" id="type"  value="<?php echo $conf ?>" checked> <?php echo $conf ?> </br>
<?php
}?>
<input type="submit"  name="submit"  value="add">
<?php
}?>
	
<?php
if(isset($_POST["submit"])){
$conf1=$_POST["checking"];
$query2 = mysql_query("UPDATE conf_table SET conf_chair_email ='$value2' WHERE conf_name='$conf1'");
echo "done";
 }
}?>

<input type="button" onclick=deleting("<?php echo $value2?>"); testing(); value="delete"></div>

<?php

}
	mysql_close();
	?>
	<script>
				function testing(){
	
					  var xmlhttp2;
      
      if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
       xmlhttp2=new XMLHttpRequest();
      }
      else
      {// code for IE6, IE5
        xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp2.onreadystatechange=function()
        {
          if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
          {
          	
            var x = xmlhttp2.responseText;
            document.getElementById("trying").innerHTML = x;
          
            
          }
        }
      xmlhttp2.open("GET","allConf.php",true);
      xmlhttp2.send();
			
	}
		function deleting(email){
			
			
				  var xmlhttp2;
      
      if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
       xmlhttp2=new XMLHttpRequest();
      }
      else
      {// code for IE6, IE5
        xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp2.onreadystatechange=function()
        {
          if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
          {
          	
            var x = xmlhttp2.responseText;
            document.getElementById("del").innerHTML = x;
            document.getElementById("del").style.color='red';
            
          }
        }
      xmlhttp2.open("GET","delete.php?email="+email,true);
      xmlhttp2.send();
			
	
		}
		</script>