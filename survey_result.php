<?php
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
	

$res1=$_POST["res1"];
$res2=$_POST["res2"];
 $sql=mysql_query("INSERT INTO survey_result (rev_id,paper_id,res1,res2) VALUES (67,1,'$res1','$res2')");
echo "you successfully submitted the evaluation form. Note: if you retake it for the same paper, your previous evaluation will be replaced by the new one.";


 
 ?>