<?php

require("common.php");

	//check if a session if running and unset it.
    if(!empty($_SESSION['username']))
    {
        header("Location: ../view/login.html");
		unset($_SESSION['username']);
		unset($_SESSION['login']);
		
        die("Redirecting to adminpage");
    }
	
	//To test if the data posted is through HTTP (an AJAX XMLHttpRequest).
	function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
	}
	
	
	//Accept posted data and process login	
    if(is_ajax_request()){
    
	$userinfo = file_get_contents('php://input');
	$data = array();
	parse_str($userinfo, $data);
	
	
	$username = $data['username'];
	$password = $data['password'];
	
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
        {	//Match password
            $check_password = $password;
            if($check_password === $row['password'])
            {
              $login_ok = true;
			  
			}
        }
		
		//If logged in, set session variables.
        if($login_ok)
        {
            unset($row['password']);
		
			
            $_SESSION['username'] = $username;
			$_SESSION['login'] = true;
			
			echo 'done';
			            
        }
		
        else
        {
			echo "Failed. Please retry.";
        }
    }
	else {
		echo "Retry";
	}


?>