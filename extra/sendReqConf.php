<?php
session_start();
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
		$sql=mysql_query("INSERT INTO researcher_request (conf_id,username) VALUES ('".$_GET['id']."','".$_GET['name']."')");
		echo "your request was sent successfully";


mysql_close();

?>