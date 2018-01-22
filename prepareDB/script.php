<?php
 // Use this file to load Roll numbers and Passwords for form if the database doesn't have them.
 ini_set('max_execution_time', 5000);
 
 function connect(){  
   $username = "root";
    $password = "";
    $host = "localhost";
    $dbname = "ghmc";
  
	// Create connection
	$conn = new mysqli($host, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	} 
	return $conn;
}
	
function insert($num){
	$rollno = "2451".$num;
	$pass = rand(100000000,10000000000);
	$query = "
            INSERT INTO studentinfo(
                rollno,
                pass)
			VALUES ('".$rollno."','".$pass."');";

        try
        {
			$conn = connect();
            $conn->query($query);
        }
        catch(PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }
}

function iter($num1, $num2){
	for($i = $num1; $i <= $num2; $i++)
	{
	insert($i);
	}
}

#civil
iter(11731001,11731120);
iter(12731001,12731120);
iter(13731001,13731120);
iter(14731001,14731120);
#mech
iter(11732001,11732120);
iter(12732001,12732120);
iter(13732001,13732120);
iter(14732001,14732120);
#ece
iter(11733001,11733120);
iter(12733001,12733120);
iter(13733001,13733120);
iter(14733001,14733120);
#eee
iter(11734001,11734120);
iter(12734001,12734120);
iter(13734001,13734120);
iter(14734001,14734120);
#cse
iter(11735001,11735120);
iter(12735001,12735120);
iter(13735001,13735120);
iter(14735001,14735120);
#IT
iter(11737001,11737090);
iter(12737001,12737090);
iter(13737001,13737090);
iter(14737001,14737090);
#auto
iter(11728001,11728090);
iter(12728001,12728090);
iter(13728001,13728090);
iter(14728001,14728090);

echo 'done';

	
?>