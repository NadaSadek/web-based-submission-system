

function emailblurring(){
if(document.getElementById("EmailTextarea").value==""){
document.getElementById("emailblur").innerHTML="* Please Write an Email";
document.getElementById("emailblur").style.color="red"
}
if(document.getElementById("EmailTextarea").value.indexOf("@")=== -1){
		document.getElementById("emailavailable").innerHTML= "* Must include character @ in the Email";
		document.getElementById("emailavailable").style.color='red';
	}
else{
document.getElementById("emailblur").innerHTML=""
}
}
function passwordblurring(){
if(document.getElementById("PasswordTextarea").value==""){
document.getElementById("passwordblur").innerHTML="* Please Write a password";
document.getElementById("passwordblur").style.color="red"
}
else{
document.getElementById("passwordblur").innerHTML=""
}
}
function confirmpasswordblurring(){
if(document.getElementById("ConfirmPasswordTextarea").value==""){
document.getElementById("confirmpasswordblur").innerHTML="* Please Confirm your password";
document.getElementById("confirmpasswordblur").style.color="red"}
else{document.getElementById("confirmpasswordblur").innerHTML=""}
}


function visibilty(){
if(document.getElementById("invisible").style.visibility=="visible"){
document.getElementById("invisible").style.visibility="hidden";
document.getElementById("invisible").style.display=""
}
else{
document.getElementById("invisible").style.visibility="visible";
document.getElementById("invisible").style.display=""
}
}

        
 function checkifNotEmptyUser(){
var e=document.getElementById("emailTextarea").value;
var t=document.getElementById("PasswordTextarea").value;
var n=document.getElementById("ConfirmPasswordTextarea").value;
var n=document.getElementById("type").value;
var u="";
var a=false;
if(e===""){
u+="Email ,";
a=true
}
if(t===""){
u+="Password ,";
a=true
}
if(n===""){
u+="Confirm-Password ,";
a=true
}
if(r===""){
u+="type ,";
a=true
}
if(a==true){
u=u.substring(0,u.length-1);
u+=" are required fields, Please dont leave them empty";
u.bold;
u.italics;window.alert(u);
a=false;
return
}
if(a==false){
if(t!=n){
alert("Password and Confirm password entered are not the same !!");
return
}
}
if(t.indexOf("'")!=-1||t.indexOf("<")!=-1||t.indexOf(">")!=-1){alert("Invalid Format , You cannot enter any of these characters in the bracket (' < > )  for safety issues");return}
if(n.indexOf("'")!=-1||n.indexOf("<")!=-1||n.indexOf(">")!=-1){alert("Invalid Format , You cannot enter any of these characters in the bracket (' < > )  for safety issues");return}
if(e.indexOf("'")!=-1||e.indexOf("<")!=-1||e.indexOf(">")!=-1){alert("Invalid Format , You cannot enter any of these characters in the bracket (' < > )  for safety issues");return}
if(r.indexOf("'")!=-1||r.indexOf("<")!=-1||r.indexOf(">")!=-1){alert("Invalid Format , You cannot enter any of these characters in the bracket (' < > )  for safety issues");return}

var f;
if(window.XMLHttpRequest){
f=new XMLHttpRequest
}
else{
f=new ActiveXObject("Microsoft.XMLHTTP")
}
f.onreadystatechange=function(){
if(f.readyState==4&&f.status==200){
var e=f.responseText;
document.getElementById("emailblur").innerHTML=e;
document.getElementById("emailblur").style.color="red";
if(e!="Email already exists, Please use another email"){
alert("You have successfully signed up")
}
}
};
f.open("GET","signup.php?email="+document.getElementById("EmailTextarea").value+"&password="+document.getElementById("PasswordTextarea").value+"&confirmpassword="+document.getElementById("ConfirmPasswordTextarea").value+"type="+document.getElementById("type").value,true);
f.send()
}
