<?php
session_start();
$val=$_SESSION['Email'];
define('DB_NAME','sys');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_HOST','localhost');
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: public");

$link=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
if(!$link){
	die('couldnt connect'.mysql_error());
}
$db_selected=mysql_select_db(DB_NAME,$link);

	if(!$db_selected){
		die('cant use '.DB_NAME.':'.mysql_error());
		
	}
	
echo '<html>
<link rel="stylesheet" href="style.css">

	<body>
    <div class="BodyContent">

    <div class="BorderBorder"><div class="BorderBL"><div></div></div><div class="BorderBR"><div></div></div><div class="BorderTL"></div><div class="BorderTR"><div></div></div><div class="BorderT"></div><div class="BorderR"><div></div></div><div class="BorderB"><div></div></div><div class="BorderL"></div><div class="BorderC"></div><div class="Border">

        <div class="Menu">
            <ul><li><a href="main.php" class="ActiveMenuButton"><span>Home</span></a></li> <li><a href="search.php" class="MenuButton"><span>Search</span></a></li> <li><a href="contactus.php" class="MenuButton"><span>Contact Us</span></a></li></ul>
        </div><div class="Header">
          <div class="HeaderTitle">
            <h1>Web-Based Submission System</h1>
        </div>  

		   </div>
		   		  		        <a class="Button" href="logout.php"><span> Logout</span></a></br>

		   <div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';

echo 'Email:'.$val.'</br>';
echo '</div></div>
<div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';

echo '<h2> Notifications </h2>';
echo '</br>';
$qy= mysql_query("SELECT * FROM reviewers WHERE email='$val' AND accepted=1");
while($rowqy = mysql_fetch_array($qy)){
		 $conf=$rowqy['conf_id'];
		 $q= mysql_query("SELECT * FROM conf_table WHERE id='$conf' AND blocked=0");
while($rowq = mysql_fetch_array($q)){
$msg=$rowq['msg'];
$name=$rowq['name'];
$chair=$rowq['chair'];
if ($msg != null){

echo '<b>Conference Name: '.$name.'</br>';
echo 'Chairperson: '.$chair.'</br>';
echo 'Updates: <span style="color:blue;text-align:center;"> '.$msg.'</span></b></br>';
}	
}	
 }
 
echo '</div></div><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';

echo '<h2>Papers to be reviewed:</br></h2>';
echo '</br>';
$count=0;
$query1 = mysql_query("SELECT * FROM survey_result WHERE rev_email='$val'");
while($row1 = mysql_fetch_array($query1)){
$paper_id=$row1['paper_id'];
$_SESSION['paper_id']=$paper_id;
$query2= mysql_query("SELECT * FROM papers WHERE file_id='$paper_id'");
while($row2 = mysql_fetch_array($query2)){
$track_name=$row2['track_name'];
$conf_id=$row2['conf_id'];
$qu2= mysql_query("SELECT * FROM conf_table WHERE id='$conf_id'");
$rw2 = mysql_fetch_array($qu2);
$cname=$rw2['name'];
$pname=$row2['file_name'];
echo "<b>Conference Name: ".$cname."<br>Track Name:".$track_name."<br>"."Paper ID:".$paper_id."</b></br>";
$count++;
	if(!(isset($_POST["$count"]))){
	echo'<form method="post" action="'.$_SERVER["PHP_SELF"].'">
<input type="hidden" name="id" value="'.$paper_id.'">
</br>
<span class="ButtonInput"><span><input type="submit" name="'.$count.'"  value="Download Paper"></span></span>
</form>';
} 
else {
$id=$_POST["id"];
$qq= mysql_query("SELECT * FROM papers WHERE file_id='$id'");
$roww = mysql_fetch_array($qq);
$content=$roww['content'];
$pname=$roww['file_name'];
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="'.$pname.'"');
header('Content-Transfer-Encoding: binary');
echo $content;
}
echo'<span class="ButtonInput"><span><input type="button"  value="Evaluate" onClick="survey();"></span></span></br></br>';
}}
?>
<script>
function survey(){
   window.location="http://localhost/submission/survey.php";
}

</script>

