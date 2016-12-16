<?php
session_start();
$val=$_SESSION['Email'];
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

   	echo 'Email:'.$val.'</br></div></div>';
	
echo   '<div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">
		<h2>Notifications</h2>';
		echo '</br>';
 $qy= mysql_query("SELECT * FROM track_table WHERE track_chair='$val'");
while($rowqy = mysql_fetch_array($qy)){
	     $track_name=$rowqy['track_name'];
		 $conf=$rowqy['conf_id'];
		 $q= mysql_query("SELECT * FROM conf_table WHERE id='$conf' AND blocked=0");
while($rowq = mysql_fetch_array($q)){
$msg=$rowq['msg'];
$name=$rowq['name'];
$chair=$rowq['chair'];
if ($msg != null){
echo "<b>Conference Name: ".$name."</br>";
echo "Chairperson: ".$chair."</br>";
echo 'Updates: <span style="color:blue;text-align:center;">'.$msg.'</span></b></br>';
echo '</br>';
}		 }
		 }
		 echo '</div></div>';
		echo ' <div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';
		 echo '<h2> Papers to be Assigned </h2>'; 
		 echo '</br>';
 $query= mysql_query("SELECT * FROM track_table WHERE track_chair='$val'");
	$count=0;
		 while($row11 = mysql_fetch_array($query)){
	     $track_name=$row11['track_name'];
		 $conf=$row11['conf_id'];
$v = mysql_query("SELECT * FROM conf_table WHERE id='$conf' AND blocked=0");
   if(mysql_num_rows($v) != 0){
		 echo '<b>Track:'.$track_name.'</b></br>';
         $query1 = mysql_query("SELECT * FROM papers WHERE track_name='$track_name' AND conf_id='$conf'");
   while($row = mysql_fetch_array($query1)){
	  $res_email=$row['res_email'];
	  $authors=$row['authors'];
	  $paper_id=$row['file_id'];
      $conf_id=$row['conf_id'];	  
	  $time=$row['time'];
	  echo '<b><span style="color:blue;text-align:center;">Paper id: '.$row['file_id'].'</br>'.' submitted by: '.$res_email.' in '.$time.'</br>
	  Authors: '.$authors.'</span></b></br>';
	  echo '</br>';
	  $query5=mysql_query("SELECT * FROM reviewers WHERE conf_id='$conf_id' AND track_name='$track_name'");
	  	  while($row5 = mysql_fetch_array($query5)){
		  $rev_email=$row5['email']; 
		  $query6=mysql_query("SELECT * FROM survey_result WHERE rev_email='$rev_email' AND paper_id='$paper_id'");
		  if(mysql_num_rows($query6) == 0){
		  $count++;
		  if(!(isset($_POST["$count"]))) { 
		  echo 'Reviewer:'.$rev_email.'</br>';
echo'<form method="post" action="'.$_SERVER["PHP_SELF"].'">
<input type="hidden" name="checking" value="'.$rev_email.'">
<input type="hidden" name="paper" value="'.$paper_id.'">
<span class="ButtonInput"><span><input type="submit" name="'.$count.'"  value="add"></span></span></br>
</form>';
}
	 else{
  	$rev=$_POST["checking"];
	$paper=$_POST["paper"];
	echo '<span style="color:green;text-align:center;">done</span></br>';
  $sql = mysql_query("INSERT INTO survey_result (paper_id,rev_email) VALUES ('$paper','$rev')");  
  }
} 
}

}
}
else {
echo "You are not the track chairperson of any track right now.";
}
}
echo '</div></div>
<div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';

echo '<h2> Evaluation Result: </h2>';
 $quey= mysql_query("SELECT * FROM track_table WHERE track_chair='$val'");
 while($ro11 = mysql_fetch_array($quey)){
	     $track_name1=$ro11['track_name'];
		 $cid=$ro11['conf_id'];
		 $v = mysql_query("SELECT * FROM conf_table WHERE id='$cid' AND blocked=0");
   if(mysql_num_rows($v) != 0){
$sql1=mysql_query("SELECT * FROM papers WHERE track_name='$track_name1' AND conf_id='$cid'");
while($row12 = mysql_fetch_array($sql1)){
$paper_id=$row12['file_id'];
$sql2=mysql_query("SELECT * FROM survey_result WHERE paper_id='$paper_id' AND abstract is NOT NULL");
if(mysql_num_rows($sql2) != 0){
while($row11 = mysql_fetch_array($sql2)){
$res1=$row11['res1'];
$res2=$row11['res2'];
$str=$row11['structure'];
$abs=$row11['abstract'];
$conc=$row11['conclusion'];
$re=$row11['relevance'];
$accept=$row11['accepted'];
$rev_email=$row11['rev_email'];
echo '<b>Track: '.$track_name.'</b> </br>';
echo '<b><span style="color:blue;text-align:center;">
Paper id: '.$paper_id.'</br>';
echo '</br>Reviewer: '.$rev_email.'</span></b></br>
</br>
1-Relevance to the conference and the track: '.$re.'</br>
2-Structure of the paper: '.$str.'</br>
3-Appropriateness of abstract as a description of the paper: '.$abs.'</br>
4-Discussion and conclusions: '.$conc.'</br>
</br>
<b>Should this paper be accepted for presentation at the conference?</b> '.$accept.' </br></br>
Result #1: <span style="color:blue;text-align:center;"> (to be seen by author and track chairperson)</span></br>
'.$res1.'</br>
Result #2: Note: <span style="color:blue;text-align:center;"> (to be seen by track chairperson only)</span></br>
'.$res2.'</br>';
echo '</br>';
}
}
}
}
else {
echo 'Note: <span style="color:blue;text-align:center;">You are not the track chairperson of any track right now.</span></br>';

}
}
echo '</div></div>
<div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';

		echo '<h2> Final Decision </h2>';
echo '</br>';
$count=0;
if(!(isset($_POST["$count"]))){
$sq=mysql_query("SELECT * FROM track_table WHERE track_chair='$val'");
 while($roq = mysql_fetch_array($sq)){
	     $trackn=$roq['track_name'];
		 $conid=$roq['conf_id'];
		 $sqw = mysql_query("SELECT * FROM conf_table WHERE id='$conid' AND blocked=0");
   if(mysql_num_rows($sqw) != 0){
$q1=mysql_query("SELECT * FROM papers WHERE track_name='$trackn' AND conf_id='$conid' AND accepted is NULL");
while($roq12 = mysql_fetch_array($q1)){
$count++;
$paper_id=$roq12['file_id'];
$authors=$roq12['authors'];
$time=$roq12['time'];
echo '<b><span style="color:blue;text-align:center;"> 
Paper id:'.$paper_id.'</br>Authors:'.$authors.'</br>submitted:'.$time.'</span></b></br>';
echo '<form method="post" action="'.$_SERVER["PHP_SELF"].'">
<input type="radio" name="ac" value="2" checked>Accept
<input type="radio" name="ac" value="1">Reject</br>
<span class="ButtonInput"><span><input type="submit" name="'.$count.'"  value="done"></span></span></form></br>';
}
}
}
}
else{
$acc=$_POST["ac"];
 $l=mysql_query("update papers SET accepted='$acc' WHERE file_id='$paper_id'") or die(mysql_error());
 if($acc == 2){
echo '<span style="color:green;text-align:center;"> accepted!</span></br></br>';
}
else {
echo '<span style="color:red;text-align:center;"> accepted!</span></br></br>';
}
}

echo '</div></div></body></html>';