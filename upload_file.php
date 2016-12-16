<?php
session_start();
$username=$_SESSION['username'];
$conf_id=$_SESSION['conf_id'];
$track_name=$_SESSION['track_name'];
$res_id=$_SESSION['researcher_id'];
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
	


$fileName = $_FILES['file']['name'];
$fileSize   = $_FILES['file']['size'];
$fileType = $_FILES['file']['type'];
$fileContents = file_get_contents($_FILES['file']['tmp_name']);




mysql_query( "insert into papers(file_name,conference_id,track_name,content,researcher_id) values('$fileName','$conf_id','$track_name','$fileContents','$res_id')");
echo "you successfully uploaded your file"."</br>";
echo"go back to profile";

	?>