<?php

    require("common.php");

    if(!empty($_POST))
    {
      $query = "
            INSERT INTO studentinfo (
            rollno, dept, year, section, name, email, nameschool, fromschool, toschool, placeschool, namecollege,fromcollege,tocollege,placecollege, presentadd, pincode, studentphno, nativeadd, parentphno
            ) VALUES (
      :rollno, :dept, :year, :section, :name, :email, :nameschool, :fromschool, :toschool, :placeschool, :namecollege, :fromcollege, :tocollege, :placecollege, :presentadd, :pincode, :studentphno, :nativeadd, :parentphno
      )
        ";
        // Here we prepare our tokens for insertion into the SQL query.  We do not
        // store the original password; only the hashed version of it.  We do store
        // the salt (in its plaintext form; this is not a security risk).
        $query_params = array(
            ':rollno' => $_POST['rollno'], ':dept' => $_POST['dept'], ':year'=>$_POST['year'], ':section'=>$_POST['section'], ':name'=>$_POST['name'], ':email'=>$_POST['email'], ':nameschool'=>$_POST['nameschool'], ':fromschool'=>$_POST['fromschool'], ':toschool'=>$_POST['toschool'], ':placeschool'=>$_POST['placeschool'], ':namecollege'=>$_POST['namecollege'], ':fromcollege'=> $_POST['fromcollege'], ':tocollege'=>$_POST['tocollege'], ':placecollege'=>$_POST['placecollege'], ':presentadd'=>$_POST['presentadd'], ':pincode'=>$_POST['pincode'], ':studentphno'=>$_POST['studentphno'], ':nativeadd'=>$_POST['nativeadd'], ':parentphno'=>$_POST['parentphno']

         );

        try
        {
            // Execute the query to create the user
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);


        }
        catch(PDOException $ex)
        {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            die("Failed to run query: " . $ex->getMessage());

        }
         header("Location: confirm.htm");
        }


?>



<html>
<head>
<title>MVSREC Student Information Form</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="script" type="text/javascript" href="jscript.js" />
</head>
<body>
<div class="header">
<a href='login.php'><b>ADMIN LOGIN</b></a></div><div class="table1">
      <h1 align="left">Student Information<h1>
     <form id="studentinfo" action="studentinfo.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this);">
      <table width='1000'>
      <tr><td>Roll No.</td><td><input type='text' name='rollno' required='required'></td></tr>
      <tr><td>Department</td><td><select name='dept' required='required'><option value="ECE">ECE</option><option value="EEE">EEE</option><option value="CSE">CSE</option><option value="AUTO">AUTO</option><option value="MECH">MECH</option><option value="IT">IT</option><option value="CIV">CIV</option></select></td></tr>
      <tr><td>Year</td><td><select name='year' required='required'><option value="2nd">2nd</option><option value="3rd">3rd</option><option value="4th">4th</option></select></td></tr>
      <tr><td>Section</td><td><select name='section' required='required'><option value="A">A</option><option value="B">B</option><option value="C">C</option></select></td></tr>
      <tr><td>Name</td><td><input type='text' name='name' required='required'></td></tr>
      <tr><td>Email Address</td><td><input type='email' name='email' required='required'></td></tr>
      <tr><td colspan='2'><b>High School Information</b></td></tr>
      <tr><td>Name of the School</td><td><input type='text' name='nameschool' required='required'></td><td>From</td><td><input type='date' name='fromschool'></td><td>To</td><td><input type='date' name='toschool'></td></tr>
      <tr><td>Place</td><td><input type='text' name='placeschool' required='required'></td></tr>
      <tr><td colspan='2'><b>Intermediate +2 Information</b></td><td></tr>
      <tr><td>Name of the college</td><td><input type='text' name='namecollege' required='required'></td><td>From</td><td><input type='date' name='fromcollege'></td><td>To</td><td><input type='date' name='tocollege'></td></tr>
      <tr><td>Place</td><td><input type='text' name='placecollege' required='required'></td></tr>
      <tr><td>Present Address</td><td><input type='text' name='presentadd' required='required'></td></tr>
      <tr><td>Pincode</td><td><input type='text' name='pincode' required='required'></td></tr>
      <tr><td>Student Phone no.</td><td><input type='text' name='studentphno' required='required'></td></tr>
      <tr><td>Native place address</td><td><input type='text' name='nativeadd' required='required'></td></tr>
      <tr><td>Parent Phone no.</td><td><input type='text' name='parentphno' required='required'></td></tr>
      <tr><td><input type='submit' name='submit'></td><td><input type='reset' name='reset'></td></tr></table></form>
      </div>
<div class="footer">MVSR Engineering College||Developed by MPP</div>
</body>
</html>

