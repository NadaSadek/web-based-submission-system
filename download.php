<?php
session_start();
mysql_connect('localhost', 'root', '') or die("I couldn't connect to your database, please make sure your info is correct!");
mysql_select_db('sys') or die("I couldn't find the database table make sure it's spelt right!");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: public");
$id=isset($_GET['pid'])?$_GET['pid']:'';
$qq= mysql_query("SELECT * FROM papers WHERE file_id='$id'");
$roww = mysql_fetch_array($qq);
$content=$roww['content'];
$pname=$roww['file_name'];
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="'.$pname.'"');
header('Content-Transfer-Encoding: binary');
echo $content;
?>