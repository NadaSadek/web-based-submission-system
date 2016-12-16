<?php 
mysql_connect('localhost', 'root', '') or die("I couldn't connect to your database, please make sure your info is correct!");
mysql_select_db('sys') or die("I couldn't find the database table make sure it's spelt right!");
$past = time() - 100; 
 setcookie('email', '', $past); 

 setcookie('pass', '', $past);	 

 header("Location: main.php"); 
 
 ?>
 