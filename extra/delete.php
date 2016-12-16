<?php

define('DB_NAME','sys');
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
	$email=$_GET['em'];
	$fname=$_GET['na'];
	echo $email.'</br>';
	echo $fname;
	$q = mysql_query("UPDATE authors SET accepted=2 WHERE email='$email'") or die(mysql_error());
	echo $fname.' ('.$email.')'.' is now blocked';
	?>
   