function invalid(){
 var name = document.getElementById("name").value;

	if(name.indexOf("'") != -1){
   		alert("Invalid Format , You cannot enter ' character  for safety issues");
return;
   	}	
   	
   	
   	if(name.indexOf("<") != -1){
   		alert("Invalid Format , You cannot enter < character  for safety issues");
   		return;
   	}	
   	
   	
   	if(name.indexOf(">") != -1){
   		alert("Invalid Format , You cannot enter < character  for safety issues");
		counter=1;
   		return;
   	}	
   	
 }
function invalid1(){
 var subject = document.getElementById("subject").value;
if (subject === "") {
       
      alert("please enter a subject !");
 	return;
     
    }
  

	if(subject.indexOf("'") != -1){
   		alert("Invalid Format , You cannot enter ' character  for safety issues");
return;
   	}	
   	
   	
   	if(subject.indexOf("<") != -1){
   		alert("Invalid Format , You cannot enter < character  for safety issues");
   		return;
   	}	
   	
   	
   	if(subject.indexOf(">") != -1){
   		alert("Invalid Format , You cannot enter < character  for safety issues");
		counter=1;
   		return;
   	}	
   	
 }
function invalid2(){

 var message = document.getElementById("message").value;  
if (message === "") {
       
      alert("please enter your message");
 	return;
     
    }
  

	if(message.indexOf("'") != -1){
   		alert("Invalid Format , You cannot enter ' character  for safety issues");
return;
   	}	
   	
   	
   	if(message.indexOf("<") != -1){
   		alert("Invalid Format , You cannot enter < character  for safety issues");
   		return;
   	}	
   	
   	
   	if(message.indexOf(">") != -1){
   		alert("Invalid Format , You cannot enter < character  for safety issues");
		counter=1;
   		return;
   	}	
   	
 }

function bluremail(){
if(document.getElementById("Email").value==""){
document.getElementById("av").innerHTML="Please Enter your email!";
document.getElementById("av").style.color="red"
}
else{
document.getElementById("av").innerHTML=""
}
}
function blurpassword(){
if(document.getElementById("Password").value==""){
document.getElementById("ava").innerHTML="Please Enter you password!";
document.getElementById("ava").style.color="red"
}
else{
document.getElementById("ava").innerHTML=""
}

}
function confirm(){
if(document.getElementById("Password").value != document.getElementById("ConfirmPassword").value){
alert("Two Password's Fields Don't Match!");
}
}
function check(){   	
 var Email = document.getElementById("Email").value;
 var Password = document.getElementById("Password").value;
 var counter=0;	
  
if (Email === "") {
       
      alert("please enter your Email !");
	  counter=1;
 	return;
     
    }
    if (Password === "") {
       
        alert("please enter a password !");
		counter=1;
		return;
    }
		

	if(Email.indexOf("'") != -1){
   		alert("Invalid Format , You cannot enter ' character  for safety issues");
		counter=1;
return;
   	}	
   	
    	if(Password.indexOf("'") != -1){
   		alert("Invalid Format , You cannot enter ' character  for safety issues");
		counter="";
   		return;
   	}	
   	
   	if(Email.indexOf("<") != -1){
   		alert("Invalid Format , You cannot enter < character  for safety issues");
		counter=1;
   		return;
   	}	
   	
   	if(Password.indexOf("<") != -1){
   		alert("Invalid Format , You cannot enter < character  for safety issues");
		counter=1;
   		return;
   	}	
   	
   	if(Email.indexOf(">") != -1){
   		alert("Invalid Format , You cannot enter < character  for safety issues");
		counter=1;
   		return;
   	}	
   	
   	if(Password.indexOf(">") != -1){
   		alert("Invalid Format , You cannot enter < character  for safety issues");
		counter=1;
   		return;
   	}	
   	
 
     
   
	if(counter === ""){
	window.location.href="http://localhost/submission/login.php";
	
	} }
	

