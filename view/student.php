<?
session_start();

//check to see if a session is running.
	if(!isset($_SESSION["username"]) && $_SESSION["login"] == ""){
		header("Location: login.html");
		die();
	}
?>



<html>
<head>
<title>GHMC Student Information Form</title>
<link rel="stylesheet" type="text/css" href="../scripts/style.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../scripts/cookie.js"></script>
</head>
<body>
<button value="LOGOUT" onClick="logout()" name="LOGOUT">LOGOUT</button>
	  
<div class="header">
      </div><div class="table1"><br>

	  <div id="table1">
	  <h1 align="left"><i>Student  Login</i><h1>
	  <p style =" font-size:14;">Please enter your Roll Number to access the form. For example, 245112737001.</p>
	  <table width='800'>
      <tr><td>Rollno:</td><td><input id ='rollno' type='text'></td></tr>
      <tr><td><input id="form_submit" type ="submit" value="submit"></td>
	  </tr></table>
	  <p style = "font-size:10;"> No password required.</p>
	  </div>
<div class="footer"><p>MVSR Engineering College||Developed by MV Siva Abhishek, MPP</p>
<p> Form to gather information about students of MVSR Engineering College as requested by Greater Municipal Corporation of Hyderabad</p></div>
</body>
<script>
//Logout by deleting the cookie
function logout() {
	document.cookie = "";
	window.location.replace("../view/login.html");
}
//Redirect to form page with roll number key-value pair on clicking submit button.
var button = document.getElementById("form_submit");
var form = document.getElementById("roll");

button.addEventListener("click", function(event) {
event.preventDefault();
var $roll = document.getElementById('rollno');
window.location.href = "form.php?roll="+document.getElementById("rollno").value;
});
</script>
</html>