<?php
// 	ini_set('display_errors', 1);
// 	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

	session_start();
	require_once("../includes/config.php");
	require_once("../includes/dbConn.php");

	if(isset($_POST['submit'])){
		
		if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){

			$username = $objConnection->real_escape_string($_POST['username']);
			$password = $objConnection->real_escape_string($_POST['password']);
			
			$sql = "SELECT * FROM drf_map_users WHERE username = '{$username}'";
			$result = $objConnection->query($sql);
			if($result->num_rows == 1){
				while($row = $result->fetch_object()) { 
					$id = $row->id;
					$username = $row->username;
					$name = $row->name;
					$password = $row->password;
				}
				$password_hash = $password;
				if(password_verify($_POST['password'], $password_hash)){
					$_SESSION['id'] = $id;
					$_SESSION['username'] = $username;
					$_SESSION['name'] = $name;
					header("Location: ../a-panel/index.php");
				}else {
					header('LOCATION: ../login.php?status=err3');
				}
			}else {
				header('LOCATION: ../login.php?status=err3');
			}

		} else {
			// Der mangler brugernavn eller password!
			header('LOCATION: ../login.php?status=err2');
		}
	} else {
		// Hvis man forsøger at køre scriptet uden at udfylde formen
		header('LOCATION: ../login.php?status=err1');
	}