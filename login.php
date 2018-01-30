<?php

    require("common.php");

    if(!empty($_SESSION['user']))
    {
        header("Location: admin.php");

        die("Redirecting to adminpage");
    }

    $submitted_username = '';
    if(!empty($_POST))

    { $username= $_POST['username'];
             $query = "
            SELECT
                username,
                password
            FROM admin
            WHERE
                username = :username
        ";
        $query_params = array(
            ':username' => $username
        );

        try
        {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex)
        {
            die("Failed to run query: " . $ex->getMessage());
        }

        $login_ok = false;

        $row = $stmt->fetch();
        if($row)
        {
            $check_password = $_POST['password'];
            if($check_password === $row['password'])
            {
              $login_ok = true;
            }
        }
        if($login_ok)
        {
            unset($row['password']);

            $_SESSION['user'] = $row;
            header("Location: admin.php");
            die("Redirecting to homepage");
        }
        else
        {


            // Tell the user they failed
            header("Location: login.php");
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
        }
    }

?>


<html>
<head>
<title>MVSREC Student Information Form</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div class="header">
<a href='admin.php'><b>ADMIN LOGIN</b></a></div><div class="table1">
      <h1 align="left">Student Information<h1>
     <form id="studentinfo" action="login.php" method="post">
      <table width='800'>
      <tr><td>Username</td><td><input type='text' name='username'></td></tr>
      <tr><td>Password</td><td><input type='password' name='password'></td></tr>
      <tr><td><input type='submit' name='submit'></td><td><input type='reset' name='reset'></td></tr></table></form>
      </div>
<div class="footer">MVSR Engineering College||Developed by MPP</div>
</body>
</html>