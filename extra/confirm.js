
// create the XMLHttpRequest object, according browser
function get_XmlHttp() {
  // create the variable that will contain the instance of the XMLHttpRequest object (initially with null value)
  var xmlHttp = null;
  if(window.XMLHttpRequest) {		// for Forefox, IE7+, Opera, Safari, ...
    xmlHttp = new XMLHttpRequest();
  }
  else if(window.ActiveXObject) {	// for Internet Explorer 5 or 6
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  return xmlHttp;
}
// sends data to a php file, via POST, and displays the received answer
function ajaxrequest(php_file, tagID) {
  var request =  get_XmlHttp();		// calls the function for the XMLHttpRequest instance

  // gets data from form fields, using their ID
  var password= document.getElementById('password').value;
  var email = document.getElementById('email').value;
  // create pairs index=value with data that must be sent to server
  var  the_data = 'password='+password+'&email='+email;

  request.open("POST", php_file, true);			// sets the request

  // adds a header to tell the PHP script to recognize the data as is sent via POST
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(the_data);		// sends the request

  // Check request status
  // If the response is received completely, will be transferred to the HTML tag with tagID
  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      document.getElementById(tagID).innerHTML = request.responseText;
    }
  }
}
