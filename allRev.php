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

	$strSQL = "SELECT * FROM users WHERE type='Reviewer'";

	$query = mysql_query($strSQL);
	
	while($row = mysql_fetch_array($query)) { ?>

	  <?php   
  $value1=$row['username'];
	$value2=$row['email'];


	?>
	

	<div class="description">
	<?php echo 'Username:'.$value1."<br />";
     echo 'Email: '.$value2."<br />";
    ?>
	</div> 
<input type="button" onclick=deleting("<?php echo $value2?>"); testing(); value="delete"></div>

	  <?php }


	mysql_close();
	?>



</body>
</html>
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