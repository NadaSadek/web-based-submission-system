 <?php
session_start();
$email = isset($_SESSION['Email']) ? $_SESSION['Email'] : '';
mysql_connect('localhost', 'root', '') or die("I couldn't connect to your database, please make sure your info is correct!");
mysql_select_db('sys') or die("I couldn't find the database table make sure it's spelt right!");
echo '<html>
<link rel="stylesheet" href="style.css">

	<body>
    <div class="BodyContent">

    <div class="BorderBorder"><div class="BorderBL"><div></div></div><div class="BorderBR"><div></div></div><div class="BorderTL"></div><div class="BorderTR"><div></div></div><div class="BorderT"></div><div class="BorderR"><div></div></div><div class="BorderB"><div></div></div><div class="BorderL"></div><div class="BorderC"></div><div class="Border">

        <div class="Menu">
            <ul><li><a href="main.html" class="ActiveMenuButton"><span>Home</span></a></li> <li><a href="search.php" class="MenuButton"><span>Search</span></a></li> <li><a href="contactus.php" class="MenuButton"><span>Contact Us</span></a></li></ul>
        </div><div class="Header">
          <div class="HeaderTitle">
            <h1>Web-Based Submission System</h1>
        </div>  

		   </div>  <a class="Button" href="admin.php"><span> Back to admin page</span></a>     <a class="Button" href="logout.php"><span> Logout</span></a></br>

		   <div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder">
		<div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div>
		<div class="ArticleTL"></div><div class="ArticleTR"><div></div></div>
		<div class="ArticleT"></div><div class="ArticleR"><div></div></div>
		<div class="ArticleB"><div></div></div><div class="ArticleL"></div>
		<div class="ArticleC"></div><div class="Article">';
	$query = mysql_query("SELECT * FROM authors WHERE accepted=1 AND admin=0");
	$count=0;
	while($row = mysql_fetch_array($query)) { 
	$count++;
 		if(isset($_POST["$count"])){
$em=$_POST["email"];
$na=$_POST["nam"];
	$q = mysql_query("UPDATE authors SET accepted=2 WHERE email='$em'") or die(mysql_error());
	echo '<span style="color:red;text-align:center;">'.$na.' ('.$em.')'.' is now blocked</span></br>';
}
 else {   $name=$row['Name'];     
	$value2=$row['email']; 
echo '<div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';


		echo '<form method="post" action="'.$_SERVER["PHP_SELF"].'"> 
	<input type="hidden" id="email" name="email" value="'.$value2.'">
<input type="hidden" id="name" name="nam" value="'.$name.'">
 Name:'.$name.'</br>
 Email: '.$value2.' </br>
 <span class="ButtonInput"><span> <input type="submit" name="'.$count.'" value="block"></span></span>';
 echo'</form></div></div>';
 }
 }
echo '</body></html>';

