<?php
session_start();
$val=$_SESSION['Email'];
mysql_connect('localhost', 'root', '') or die("I couldn't connect to your database, please make sure your info is correct!");
mysql_select_db('sys') or die("I couldn't find the database table make sure it's spelt right!");

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
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">
	
	Email:'.$val.'</br ></div></div>';
	  echo ' <div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">
';	
echo '<h2>Conferences:</h2></br>';
$count=0;
$query= mysql_query("SELECT * FROM conf_table WHERE chair != '$val' AND blocked=0");
	  while($row = mysql_fetch_array($query)){
$conf_name=$row['name'];
$year=$row['year'];
$conf_id=$row['id'];
$msg=$row['msg'];

	echo '<b>Conference - Year: <span style="color:blue;text-align:center;">'.$conf_name.' - '.$year.'</span></b><br>';
if ($msg != null){
echo '<b>Updates: <span style="color:blue;text-align:center;">'.$msg.'</span></b></br>';
echo '</br>';
}
$query1= mysql_query("SELECT * FROM track_table WHERE conf_id = '$conf_id' And track_chair !='$val'");
	  while($row1 = mysql_fetch_array($query1)){
$track_name=$row1['track_name'];
$qury1= mysql_query("SELECT * FROM reviewers WHERE conf_id = '$conf_id' AND track_name='$track_name' And email = '$val'");
	 if(mysql_num_rows($qury1) == 0){
echo 'track:<span style="color:blue;text-align:center;">'.$track_name.'</span><br>';
 $count++;

 if((isset($_POST["$count"]))){
  if($_POST["key"]){
 if($_POST["authors"]){
 $key=$_POST["key"];
 $authors=$_POST["authors"];
$allowedExts = array("pdf");
$temp = explode(".", $_FILES["userfile"]["name"]);
$extension = end($temp);
if (($_FILES["userfile"]["type"] == "application/pdf")
 && in_array($extension, $allowedExts)) {
 if($_FILES['userfile']['size']>0){
if($_FILES['userfile']['error'] == 0) {
        // Gather all required data
         $name = $_FILES['userfile']['name'];
   		 $mime = $_FILES['userfile']['type'];
         $data = addslashes(file_get_contents($_FILES  ['userfile']['tmp_name']));
         $size = intval($_FILES['userfile']['size']);
		 $qu1= mysql_query("SELECT * FROM papers WHERE conf_id = '$conf_id' AND track_name='$track_name' And res_email = '$val'");
	 if(mysql_num_rows($qu1) ==0){
 $sql=mysql_query("INSERT INTO papers (res_email,file_name,content,conf_id,track_name,keywords,authors) VALUES ('$val','$name','$data','$conf_id','$track_name','$key','$authors')") or die(mysql_error());
 echo '<span style="color:green;text-align:center;">you successfully uploaded the paper</span></br>';
 echo '</br>';
 }
 else {
  $sql=mysql_query("UPDATE papers set file_name='$name',content='$data',keywords='$key' WHERE conf_id='$conf_id' AND track_name='$track_name' AND res_email='$val'") or die(mysql_error());
echo '<span style="color:green;text-align:center;">you successfully re-uploaded the paper</span></br>';
 echo '</br>';
 }
    }
    else {
         echo '<span style="color:red;text-align:center;">An error occurred while the file was being uploaded</span></br>';
		 echo '</br>';
    }
	}
 }
 else {
 echo '<span style="color:red;text-align:center;">you are only allowed to upload pdf files.</span></br>';
 echo '</br>';
 }	
}
}
}
$q= mysql_query("SELECT * FROM papers WHERE conf_id= '$conf_id' And track_name ='$track_name' AND res_email='$val'");
 if(mysql_num_rows($q)!= 0 ){
 $rq = mysql_fetch_array($q);
  echo '</br>';
 echo 'Your Latest Upload:';
 $pid=$rq['file_id'];

 echo '<a class="Button" href="download.php?pid='.$pid.'"><span> download </span></a></br>';
 echo '</br>';
 }

echo '<form action="'.$_SERVER["PHP_SELF"].'" method="post" enctype="multipart/form-data">
Please Enter Keywords separated by a (,):</br><input type="text" name="key"></br>
Please Enter Authors (including yourself) separated by a (,):</br><input type="text" name="authors"></br>';
echo '<input type="file" name="userfile"></br>
<span class="ButtonInput"><span><input type="submit" name="'.$count.'" value="Upload"></span></span></form></br>';
}
 }

 }
echo '</div></div>';

 echo ' <div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">
<h2> Evaluation Result: </h2>';
$sql1=mysql_query("SELECT * FROM papers WHERE res_email='$val'");
while($row12 = mysql_fetch_array($sql1)){
$paper_id=$row12['file_id'];
$confd=$row12['conf_id'];
$track_name=$row12['track_name'];
$sl1=mysql_query("SELECT * FROM conf_table WHERE id='$confd'");
while($ro12 = mysql_fetch_array($sl1)){
$conf_name=$ro12['name'];
$l=mysql_query("SELECT * FROM survey_result WHERE paper_id='$paper_id' AND res1 is NOT NULL");
if(mysql_num_rows($l) != 0){
echo "<b>Conference: ".$conf_name."</br>"."Track: ".$track_name."</b></br>";

$s2=mysql_query("SELECT * FROM papers WHERE file_id='$paper_id' AND accepted is NOT NULL");
if(mysql_num_rows($s2) != 0){
$rs2= mysql_fetch_array($s2);
$acc=$rs2['accepted'];
if($acc==2){
echo '<b>Decision by track chairperson: <span style="color:green;text-align:center;">Accepted</span></br>';
}
else {
echo '<b>Decision by track chairperson: <span style="color:red;text-align:center;">Rejected</span></br>';

}
echo '</br>';
}
}}
$sql2=mysql_query("SELECT * FROM survey_result WHERE paper_id='$paper_id' AND res1 is NOT NULL");
if(mysql_num_rows($sql2) != 0){
while($row11 = mysql_fetch_array($sql2)){
$res1=$row11['res1'];
echo "<b>Reviewer's Comment:"."</br>";
echo '<span style="color:blue;text-align:center;">'.$res1.'</span></br>';
echo '</br>';
}
}
}

echo '</div></div></body></html>';