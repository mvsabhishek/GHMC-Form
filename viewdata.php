<?php
session_start();

	if(!isset($_SESSION["username"]) && $_SESSION["login"] == ""){
		header("Location: login.html");
		die();
	}
	
	function is_ajax_request() {
    return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) &&
      $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest";
	}
	
    if(is_ajax_request()){
    
	$userinfo = file_get_contents("php://input");
	$data = array();
	parse_str($userinfo, $data);
	
	$log = false;
	
        $query = "
            SELECT rollno from studentinfo WHERE dept = :dept, year = :year, section = :section, submit = 0;
        ";
        $query_params = array(
            ":dept" => $data["dept"], ":year"=>$data["year"], ":section"=>$data["section"], 
		);

        try
        {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
			$log = true;
        }
        catch(PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }
		
		if($log){
			 $input = "";
			 $row = $stmt->fetch();
			 for($i = 0; $i <$row.length; $i++){
					$input += "<data><rollno>".$row["rollno"]."</rollno><submit> NO </submit></data>";
			 }
			echo $input;
		}
		else { echo "Retry";
		} 
		}
	
?>
<html>
<head>
<title>MVSREC Student Information Form for GHMC</title>
<link rel="stylesheet" type="text/css" href="../scripts/style.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../scripts/script.js"></script>
<script src="../scripts/cookie.js"></script>
</head>
<body>
<div class="header">
</div><div class="table1">
      <h1 align="left">Student Information<h1>
     <div id="info">
	 
	 <form id="studentinfo" action="viewdata.php" method="post">
      <table width="1000">
      <tr><td>Department</td><td><select id="dept" name="dept"><option value="ECE">ECE</option><option value="EEE">EEE</option><option value="CSE">CSE</option><option value="AUTO">AUTO</option><option value="MECH">MECH</option><option value="IT">IT</option><option value="CIV">CIV</option></select></td></tr>
      <tr><td>Year</td><td><select id="year" name="year"><option value="2nd">2nd</option><option value="3rd">3rd</option><option value="4th">4th</option></select></td></tr>
      <tr><td>Section</td><td><select id="section" name="section"><option value="A">A</option><option value="B">B</option><option value="C">C</option></select></td></tr>
      <tr><td><input id="sub" type="submit" name="submit"></td><td><input type="reset" name="reset"></td></tr></table></form>
      </div>
	  
	  <button value="LOGOUT" onClick="logout()" name="LOGOUT">LOGOUT</button>
	  <div id = "result"> </div>
	  </div>
<div class="footer">MVSR Engineering College||Developed by MV Siva Abhishek, MPP</div>
</body>
<script>
function logout() {
	document.cookie = "";
	window.location.replace("../view/login.html");
}

var button = document.getElementById("sub");

function subbmit(){

	var array = [];
	var inputNameandValue = "";
	
	/*var d = document.getElementById("dept");
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
	array.push(inputNameandValue);*/
var former = document.getElementById("studentinfo");	
	var form_data = new FormData(former);
	var act = former.getAttribute("action");
	for ([key,value] of form_data.entries()){
		console.log(key + ": "+ value);		
	}
	
	var xhr = new XMLHttpRequest();
	xhr.open("POST","viewdata.php", true);
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	xhr.onreadystatechange = function () {
          if(xhr.readyState == 4 && xhr.status == 200) {
                 var result = xhr.responseXML;
				 console.log(result);
          }
	};
	xhr.send(form_data);
	/*document.getElementById("info").style.display = "none";
	 //var parser=new DOMParser();
	 //var doc = parser.parseFromString(result,"text/xml");
	 console.log(result);
	 document.getElementById("result").style.display = "block";
	 document.getElementById("result").innerHTML = result;*/
}


button.addEventListener("click", function(event){
event.preventDefault();
var former = document.getElementById("studentinfo");
subbmit();
});

</script>
</html>
