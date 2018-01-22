<?php
session_start();
//check if a session if running and unset it.
	if(!isset($_SESSION["username"]) && $_SESSION["login"] == ""){
		header("Location: login.html");
		die();
	}
?>
<html>
<head>
<title>GHMC Student Information Form</title>
<link rel="stylesheet" type="text/css" href="../scripts/style.css" />
<script src="../scripts/cookie.js"></script>
</head>
<body>
<button value="LOGOUT" onClick="logout()" name="LOGOUT">LOGOUT</button>
<div class="header"></div>
<div class="table1">
<form id="studentinfo" action="update.php" method="post">
	  <div style="font-size:20" id= "rollnumber">  </div><br>
      <table width="1000">
      <tr><td>Department</td><td><select id="dept" name="dept" required="required"><option value="ECE">ECE</option><option value="EEE">EEE</option><option value="CSE">CSE</option><option value="AUTO">AUTO</option><option value="MECH">MECH</option><option value="IT">IT</option><option value="CIV">CIV</option></select></td></tr>
      <tr><td>Year</td><td><select id="year" name="year" required="required"><option value="2nd">2nd</option><option value="3rd">3rd</option><option value="4th">4th</option></select></td></tr>
      <tr><td>Section</td><td><select id="section" name="section" required="required"><option value="A">A</option><option value="B">B</option><option value="C">C</option></select></td></tr>
      <tr><td>Name</td><td><input type="text" name="name" required="required"></td></tr>
      <tr><td>Email Address</td><td><input type="email" name="email" required="required"></td></tr>
      <tr><td colspan="2"><b>High School Information</b></td></tr>
      <tr><td>Name of the School</td><td><input type="text" name="nameschool" required="required"></td><td>From</td><td><input type="date" name="fromschool"></td><td>To</td><td><input type="date" name="toschool"></td></tr>
      <tr><td>Place</td><td><input type="text" name="placeschool" required="required"></td></tr>
      <tr><td colspan="2"><b>Intermediate +2 Information</b></td><td></tr>
      <tr><td>Name of the college</td><td><input type="text" name="namecollege" required="required"></td><td>From</td><td><input type="date" name="fromcollege"></td><td>To</td><td><input type="date" name="tocollege"></td></tr>
      <tr><td>Place</td><td><input type="text" name="placecollege" required="required"></td></tr>
      <tr><td>Present Address</td><td><input type="text" name="presentadd" required="required"></td></tr>
      <tr><td>Pincode</td><td><input type="text" name="pincode" required="required"></td></tr>
      <tr><td>Student Phone no.</td><td><input type="text" name="studentphno" required="required"></td></tr>
      <tr><td>Native place address</td><td><input type="text" name="nativeadd" required="required"></td></tr>
      <tr><td>Parent Phone no.</td><td><input type="text" name="parentphno" required="required"></td></tr>
      <tr><td><input id="update" type="submit" name="submit"></td><td><input type="reset" name="reset"></td></tr></table></form>
     </div>
<div class="footer"><p>MVSR Engineering College||Developed by MV Siva Abhishek, MPP</p>
<p> Form to gather information about students of MVSR Engineering College as requested by Greater Municipal Corporation of Hyderabad</p></div>
</body>
<script>
window.onload = function(){
var rollnu ="";
//extract Roll Number from URL.
    var rollnu = window.location.href;  
	var splt = rollnu.split("=");
	document.getElementById("rollnumber").innerHTML = " Roll no:    "+ splt[1];
			 
};

//Logout by deleting the cookie
function logout() {
	document.cookie = "";
	window.location.replace("../view/login.html");
}


var button = document.getElementById("update");

function submit(former){
	//Gather required data from URL and Form to submit.
	var array = [];
	var inputNameandValue = "";
	
	var url = window.location.href;
	var urldef = url.split("=");
	inputNameandValue = "rollno=" + urldef[1];
	array.push(inputNameandValue);
	
	var d = document.getElementById("dept");
    var di = d.selectedIndex;
	inputNameandValue = "dept=" + d.options[di].text;
	array.push(inputNameandValue);
	
	var y = document.getElementById("year");
    var yi = y.selectedIndex;
	inputNameandValue = "year=" + y.options[yi].text;
	array.push(inputNameandValue);
	
	var s = document.getElementById("section");
    var si = s.selectedIndex;
	inputNameandValue = "section=" + s.options[si].text;
	array.push(inputNameandValue);
	
	var inputs = former.getElementsByTagName("input");
	for(i = 0; i<inputs.length-2; i++){
		inputNameandValue = inputs[i].name +"=" +inputs[i].value;
		array.push(inputNameandValue);
	}
	
	var form_data = array.join("&");
	//console.log(form_data);
	
	//Send an XMLHttpRequest
	var xhr = new XMLHttpRequest();
	xhr.open("POST","../model/update.php", true);
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xhr.send(form_data); 
	window.location.href = "confirm.html";
}

//call submit function when submit button is clicked
button.addEventListener("click", function(event){
event.preventDefault();
var former = document.getElementById("studentinfo");
submit(former);
});
</script>
</html>