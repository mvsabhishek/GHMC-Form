<?php

require("common.php");

	//check if a session if running and unset it.
	if(!isset($_SESSION["username"]) && $_SESSION["login"] == ""){
		header("Location: login.html");
		die();
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
	
	$log = false;
	
    
             $query = "
            UPDATE studentinfo SET
                dept = :dept, year = :year, section = :section, name= :name, email = :email, 
				nameschool = :nameschool, fromschool = :fromschool, toschool= :toschool, placeschool = :placeschool,
				namecollege = :namecollege, fromcollege = :fromcollege, tocollege = :tocollege, placecollege = :placecollege, 
				presentadd = :presentadd, pincode = :pincode, studentphno = :studentphno, nativeadd = :nativeadd, parentphno = :parentphno
            WHERE
                rollno = :rollno
        ";
        $query_params = array(
            ':rollno' => $data['rollno'], ':dept' => $data['dept'], ':year'=>$data['year'], ':section'=>$data['section'], ':name'=>$data['name'],
			':email'=>$data['email'], ':nameschool'=>$data['nameschool'], ':fromschool'=>$data['fromschool'], ':toschool'=>$data['toschool'], 
			':placeschool'=>$data['placeschool'], ':namecollege'=>$data['namecollege'], ':fromcollege'=> $data['fromcollege'], 
			':tocollege'=>$data['tocollege'], ':placecollege'=>$data['placecollege'], ':presentadd'=>$data['presentadd'], 
			':pincode'=>$data['pincode'], ':studentphno'=>$data['studentphno'], ':nativeadd'=>$data['nativeadd'], ':parentphno'=>$data['parentphno']
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
		//if updated, redirect ot confirmation page.
		if($log){
			 header("Location: ../view/confirm.html");
		}
		else{
		echo "failed";
		}
	}
?>