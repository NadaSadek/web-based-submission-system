<?php
mysql_connect('localhost', 'root', '') or die("I couldn't connect to your database, please make sure your info is correct!");
mysql_select_db('sys') or die("I couldn't find the database table make sure it's spelt right!");
	$sql=mysql_query("SELECT * FROM conf_table");
?>
<script>
function searching(){
	
    var xmlhttp;
      if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
       xmlhttp=new XMLHttpRequest();
      }
      else
      {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      
      
       xmlhttp.onreadystatechange=function()
        {
        	if (xmlhttp.readyState==4 && xmlhttp.status==200){
        		var x = xmlhttp.responseText;
            document.getElementById("searchresults").innerHTML = x;
            
            
            if(x!="No results , please try changing the searching criteria."){
           
            document.getElementById("searchresults").style.color='black';

        	}
        	 else{
        	 	
        	 	document.getElementById("searchresults").style.color='red';
        	 

        	 }
         }
        
     }
     	
     	xmlhttp.open("GET","shelper.php?author="+document.getElementById("author").value+"&confid="+document.getElementById("conid").value+"&keywords="+document.getElementById("keywords").value,true);     
	xmlhttp.send();

    
	}</script>
<?php
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

		   <div class="Columns"><div class="MainColumn">
        <div class="ArticleBorder"><div class="ArticleBL"><div></div></div><div class="ArticleBR"><div></div></div><div class="ArticleTL"></div><div class="ArticleTR"><div></div></div><div class="ArticleT"></div><div class="ArticleR"><div></div></div><div class="ArticleB"><div></div></div><div class="ArticleL"></div><div class="ArticleC"></div><div class="Article">';

     echo 'Conference Name:</br>
<select id="conid">';
 while($row = mysql_fetch_array($sql)){
$confname=$row['name']; 
$year=$row['year'];
$confid=$row['id'];
 echo '<option value="'.$confid.'"> '.$confname.'</option>';
}
 echo '</select> </br>
Please Enter Authors Names Separated by (,):</br> <input type="text" id="author"></br>
Please Enter Keywords Separated by (,):</br> <input type="text" id="keywords"></br>
 <span class="ButtonInput"><span><input type ="button"  id="buttonssubmit"  onclick="searching();" value="Search"></span></span></br>
 	<div id="tableheaders">	
<table align="center" color="blue" border="1" width="800px">

  <th width="32%">Paper Name</th> 
  <th width="23%">Author</th>
  <th width="20%">Conference</th>
  <th width="10%">Track</th>
  <th width="15%">Download Paper</th>
  </table>
  <table align="center" id="searchresults" border="1" width="800px">
  
 
  </table>
  </div></div></div></body></html>';
