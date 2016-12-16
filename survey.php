<?php
session_start();
$rev_email=isset($_SESSION['Email'])? $_SESSION['Email']: '';
$paper_id=isset($_SESSION['paper_id'])? $_SESSION['paper_id']: '';
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
	 if(isset($_POST["submit"])){
	  $res1=$_POST["res1"];
      $res2=$_POST["res2"];
	  $ab=$_POST["ab"];
	  $conc=$_POST["conc"];
	  $str=$_POST["str"];
	  $accept=$_POST["accept"];
	  $re=$_POST["re"];
	  $ql=mysql_query("SELECT * FROM survey_result WHERE paper_id='$paper_id' AND rev_email='$rev_email' AND res1 is Null AND res2 is NULL AND relevance is NULL AND conclusion is NULL AND abstract is NULL AND structure is NULL AND accepted is NULL ");
	 if(mysql_num_rows($ql)!= 0 ){
 $sl=mysql_query("update survey_result SET res1='$res1', res2='$res2',accepted='$accept',abstract='$ab',conclusion='$conc',structure='$str',relevance='$re' WHERE paper_id='$paper_id' AND rev_email='$rev_email'");
 echo '<span style="color:green;text-align:center;"> You successfully submitted the evaluation form. Note: if you retake it for the same paper, your previous evaluation will be replaced by the new one.</span>';
 
 }
	else {  $querysql=mysql_query("SELECT * FROM survey_result WHERE paper_id='$paper_id' AND rev_email='$rev_email'");
	 if(mysql_num_rows($querysql)!= 0 ){
 $sl=mysql_query("update survey_result SET res1='$res1', res2='$res2',accepted='$accept',abstract='$ab',conclusion='$conc',structure='$str',relevance='$re' WHERE paper_id='$paper_id' AND rev_email='$rev_email'");
	  echo '<span style="color:green;text-align:center;">you successfully updated your review.</span></br>';
	 }
 }
}
echo '<h2> Fill the Survey Please! </h2>';
echo 'Note: <span style="color:blue;text-align:center;">if you retake it for the same paper, your previous evaluation will be replaced by the new one.</span></br>';
echo '</br>';
echo '<span style="color:red;text-align:center;">Please Answer all the questions! </span></br>';
echo '</br>';
echo 'paper id: '.$paper_id; 
echo '</br></br>';
echo '<form method="POST" action="'.$_SERVER["PHP_SELF"].'" id="form1">
<span style="color:blue;text-align:center;"> Please rate the following: (5 excellent, 1 poor)</span></br>
1-Relevance to the conference and the track:</br><input type="radio" name="re" value="5" checked>5 <input type="radio" name="re" value="4">4
<input type="radio" name="re" value="3">3<input type="radio" name="re" value="2">2
<input type="radio" name="re" value="1">1</br>
2-Structure of the paper:</br>
<input type="radio" name="str" value="5" checked>5 <input type="radio" name="str" value="4">4
<input type="radio" name="str" value="3">3<input type="radio" name="str" value="2">2
<input type="radio" name="str" value="1">1</br>
3-Appropriateness of abstract as a description of the paper:</br>
<input type="radio" name="ab" value="5" checked>5 <input type="radio" name="ab" value="4">4
<input type="radio" name="ab" value="3">3<input type="radio" name="ab" value="2">2
<input type="radio" name="ab" value="1">1</br>
4-Discussion and conclusions:</br>
<input type="radio" name="conc" value="5" checked>5 <input type="radio" name="conc" value="4">4
<input type="radio" name="conc" value="3">3<input type="radio" name="conc" value="2">2
<input type="radio" name="conc" value="1">1</br>
</br>
<span style="color:blue;text-align:center;"> Should this paper be accepted for presentation at the conference? </span></br>
<input type="radio" name="accept" value="Yes - no changes" checked>Yes - no changes </br>
<input type="radio" name="accept" value="Yes - with minor revisions ">Yes - with minor revisions </br>
<input type="radio" name="accept" value="Yes - with major revisions">Yes - with major revisions </br>
<input type="radio" name="accept" value="No">No </br>
</br>
<span style="color:blue;text-align:center;"> Comment to be seen by Author and Track ChairPerson </span></br>
<textarea col="90" rows="6" form="form1" name="res1"></textarea></br>
</br>
<span style="color:blue;text-align:center;"> Comment to be seen by Track Chairperson ONLY </span></br>
<textarea col="90" rows="6" form="form1" name="res2"></textarea></br>
<input type="submit" name="submit" value="Evaluate"></form><br>
</div></div></body></html>';