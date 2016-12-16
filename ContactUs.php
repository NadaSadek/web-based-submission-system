<?php echo '<html>
<link rel="stylesheet" href="style.css">
 <script type="text/javascript" src="main.js"></script>
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

// display form if user has not clicked submit
if (isset($_POST["submit"]))
  {
 if (isset($_POST["subject"]))
    {
    
      $subject = $_POST["subject"];
      $message = $_POST["message"];
      // message lines should not exceed 70 characters (PHP rule), so wrap it
      $message = wordwrap($message, 70);
      // send mail
      mail("nadasadek92@gmail.com",$subject,$message,"nadasadek92@gmail.com");
       echo '<span style="color:blue;text-align:center;"> Thank you for sending us your feedback</span>';
      
    }
  }

echo '<form method="post" action="'.$_SERVER["PHP_SELF"].'">
  <b>Name:</b> </br><input type="text" name="uname" id="name" onblur="invalid();"></br>
  <b>Subject:</b> </br><input type="text" name="subject" id="subject" onblur="invalid();invalid1();"><br>
  <b> Message:  </b></br>
  <textarea rows="10" cols="40" name="message" id="message" onblur="invalid();invalid1();invalid2();"></textarea><br>
  <span class="ButtonInput"><span><input type="submit" name="submit" value="Submit Feedback"></span></span>
  </form>';
 
echo '</div></div></body></html>';
