<?php
session_start();
mysql_connect('localhost', 'root', '') or die("I couldn't connect to your database, please make sure your info is correct!");
mysql_select_db('sys') or die("I couldn't find the database table make sure it's spelt right!");
	
	$author=$_GET['author'];
	$keywords=$_GET['keywords'];
	$confid=$_GET['confid'];
    $myArray = explode(',', $keywords);
	$authorArray=explode(',', $author);

if(($author != "") && ($keywords != "")){
$check=0;
foreach($myArray as $key){
foreach($authorArray as $aut){
$query2 = mysql_query("SELECT * FROM papers WHERE conf_id='$confid' AND accepted=2 AND authors LIKE '%$aut%' AND keywords LIKE'%$key%'");
if(mysql_num_rows($query2) != 0)
{
while($row2 = mysql_fetch_array($query2)){
$pid=$row2['file_id'];
$_SESSION['pid']=$pid;
$trackname=$row2['track_name'];
$papername=$row2['file_name'];
$authorname=$row2['authors'];
$id=$row2['conf_id'];
$query3 = mysql_query("SELECT * FROM conf_table WHERE id='$id' ");
$row3 = mysql_fetch_array($query3);
$confname=$row3['name'];
$check++;
echo '
	<table style: "width=800px">
  <tr>
  <td width="32%">'.$papername.'</td>
  <td width="23%">'.$authorname.'</td>
  <td width="20%">'.$confname.'</td>
  <td width="10%">'.$trackname.'</td>
  <td width="15%"><a class="Button" href="download.php?pid='.$pid.'"><span> download </span></a></td>
  </tr></table>';
  
	}	

}
 }
 }
  if($check ==0){


	echo 'No results , please try changing the searching criteria.';

}
 }

 else if(($author == "") && ($keywords == "")){
 $check=0;
 $query2 = mysql_query("SELECT * FROM papers WHERE conf_id='$confid' AND accepted=2");
if(mysql_num_rows($query2) != 0)
{
while($row2 = mysql_fetch_array($query2)){
$pid=$row2['file_id'];
$_SESSION['pid']=$pid;
$trackname=$row2['track_name'];
$papername=$row2['file_name'];
$authorname=$row2['authors'];
$id=$row2['conf_id'];
$query3 = mysql_query("SELECT * FROM conf_table WHERE id='$id' ");
$row3 = mysql_fetch_array($query3);
$confname=$row3['name'];
$check++;
echo '
	<table style: "width=800px">
  <tr>
  <td width="32%">'.$papername.'</td>
  <td width="23%">'.$authorname.'</td>
  <td width="20%">'.$confname.'</td>
  <td width="10%">'.$trackname.'</td>
  <td width="15%"><a class="Button" href="download.php?pid='.$pid.'"><span> download </span></a></td>
  </tr></table>';
  
	}	
}
 if($check ==0){
	echo 'No results , please try changing the searching criteria.';

}
}

 else if($author == ""){
 $check=0;
   foreach($myArray as $key){
	 $query2 = mysql_query("SELECT * FROM papers WHERE accepted=2 AND conf_id='$confid' AND keywords LIKE'%$key%'");
	 if(mysql_num_rows($query2) != 0)
{
while($row2 = mysql_fetch_array($query2)){
$pid=$row2['file_id'];
$_SESSION['pid']=$pid;
$trackname=$row2['track_name'];
$papername=$row2['file_name'];
$authorname=$row2['authors'];
$id=$row2['conf_id'];
$query3 = mysql_query("SELECT * FROM conf_table WHERE id='$id' ");
$row3 = mysql_fetch_array($query3);
$confname=$row3['name'];
$check++;
echo '
	<table style: "width=800px">
  <tr>
  <td width="32%">'.$papername.'</td>
  <td width="23%">'.$authorname.'</td>
  <td width="20%">'.$confname.'</td>
  <td width="10%">'.$trackname.'</td>
  <td width="15%"><a class="Button" href="download.php?pid='.$pid.'"><span> download </span></a></td>
  </tr></table>';
  
	}	

}
	 }
 if($check ==0){
	echo 'No results , please try changing the searching criteria.';

}
 }

 else if($keywords == ""){
 $check=0;
foreach($authorArray as $aut){
$query2 = mysql_query("SELECT * FROM papers WHERE accepted=2 AND conf_id='$confid' AND authors LIKE '%$aut%'");
if(mysql_num_rows($query2) != 0)
{
while($row2 = mysql_fetch_array($query2)){
$pid=$row2['file_id'];
$_SESSION['pid']=$pid;
$trackname=$row2['track_name'];
$papername=$row2['file_name'];
$authorname=$row2['authors'];
$id=$row2['conf_id'];
$query3 = mysql_query("SELECT * FROM conf_table WHERE id='$id' ");
$row3 = mysql_fetch_array($query3);
$confname=$row3['name'];
$check++;
echo '
	<table style: "width=800px">
  <tr>
  <td width="32%">'.$papername.'</td>
  <td width="23%">'.$authorname.'</td>
  <td width="20%">'.$confname.'</td>
  <td width="10%">'.$trackname.'</td>
  <td width="15%"><a class="Button" href="download.php?pid='.$pid.'"><span> download </span></a></td>
  </tr></table>';
  
	}	

}
 }
  if($check ==0){


	echo 'No results , please try changing the searching criteria.';

}
}

	mysql_close();
?>
