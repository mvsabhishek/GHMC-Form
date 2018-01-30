<?php

    require("common.php");

    if(empty($_SESSION['user']))
    {
        header("Location: login.php");

        die("Redirecting to loginpage");
    }

    if(!empty($_POST))
    {
        
        $query = "
            SELECT
            *
            FROM studentinfo
            WHERE
                dept = :dept and year = :year and section = :section
        ";

        $dept= $_POST['dept'];
            $year = $_POST['year'];
            $section = $_POST['section'];
        $query_params = array(
            ':dept' => $dept,
            ':year' => $year,
            ':section' => $section
        );

        try
        {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
            $data = $stmt->fetchAll();
        }
        catch(PDOException $ex)
        {
          die("Failed to run query: " . $ex->getMessage());
        }


       echo "<html>
<head>
<title>MVSREC Student Information Form</title>
<link rel='stylesheet' type='text/css' href='style.css' />
</head>
<body>
<div class='header'>
<a href='logout.php'><b>LOGOUT</b></a></div><div class='table1'>
      <h1 align='left'>Student Information<h1><div>";

        $count=count($data);
        if($count==0){
         echo "No result found\n";
        }
        else{
        foreach($data as $row){

        echo "<table class='table3'>";
        echo "<tr><th>ROLL NO</th><th>DEPARTMENT</th><th>YEAR</th><th>SECTION</th><th>NAME</th><th>EMAIL</th><th>NAME OF THE SCHOOL</th><th>FROM</th><th>TO</th><th>PLACE</th><th>NAME OF THE COLLEGE</th><th>FROM</th><th>TO</th><th>PLACE</th><th>PRESENT ADDRESS</th><th>PINCODE</th><th>STUDENT PHNO</th><th>NATIVE ADDRESS</th><th>PARENT PHNO</th>";
        echo "<tr><td>".$row['rollno']."</td><td>".$row['dept']."</td><td>".$row['year']."</td><td>".$row['section']."</td><td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['nameschool']."</td><td>".$row['fromschool']."</td><td>".$row['toschool']."</td><td>".$row['placeschool']."</td><td>".$row['namecollege']."</td><td>".$row['fromcollege']."</td><td>".$row['tocollege']."</td><td>".$row['placecollege']."</td><td>".$row['presentadd']."</td><td>".$row['pincode']."</td><td>".$row['studentphno']."</td><td>".$row['nativeadd']."</td><td>".$row['parentphno']."</td></tr>";

 }
 echo "</table><br><br></div>";
   }
    }



else{ echo" <head>
<title>MVSREC Student Information Form</title>
<link rel='stylesheet' type='text/css' href='style.css' />
</head>
<body>
<div class='header'>
<a href='logout.php'><b>LOGOUT</b></a></div><div class='table1'>
      <h1 align='left'>Student Information<h1>
     <form id='studentinfo' action='admin.php' method='post'>
      <table width='1000'>
      <tr><td>Department</td><td><select name='dept'><option value='ECE'>ECE</option><option value='EEE'>EEE</option><option value='CSE'>CSE</option><option value='AUTO'>AUTO</option><option value='MECH'>MECH</option><option value='IT'>IT</option><option value='CIV'>CIV</option></select></td></tr>
      <tr><td>Year</td><td><select name='year'><option value='2nd'>2nd</option><option value='3rd'>3rd</option><option value='4th'>4th</option></select></td></tr>
      <tr><td>Section</td><td><select name='section'><option value='A'>A</option><option value='B'>B</option><option value='C'>C</option></select></td></tr>
      <tr><td><input type='submit' name='submit'></td><td><input type='reset' name='reset'></td></tr></table></form>
      </div>
<div class='footer'>MVSR Engineering College||Developed by MPP</div>
</body>
</html>";}
?>