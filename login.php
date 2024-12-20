<?php

require_once 'init.php';
include_once ROOT_PATH.'/includes/overall/header.php';

logged_in_redirect();


if(empty($_POST) === false){
	$username 	= $_POST['username'];
	$password 	= $_POST['password'];
	$department	= $_POST['department'];

	if(empty($username) === true || empty($password) === true){
		 $errors[]='You need to enter a username, password and department combination that match';
	}else if(user_exists($username) === false){
		$errors[] = 'we cannot find the username. Have you registered?';
	}else if (user_active($username)=== false) {
		$errors[] = 'you have not activated your account or your account has been banned';
	}else{
		
		if(strlen($password) > 32){
			$errors[] = 'password too long';
		}
		
		$login = login($username, $password, $department, 'hotel');
		if($login === false){
			$errors[] = 'that username and password combination is incorrect';
		} else{
			$_SESSION['user_id'] = $login;
			header('Location: index.php');
			exit();
		}
		
	}
}
else{
	$errors[] =  'No data recieved';
}

if(empty($errors) === false){
?>
<h3 class="text-center text-info">We tried to log you in, but ...</h3>
<?php
alert_warning(output_errors($errors));
}

include_once ROOT_PATH.'/includes/overall/footer.php';
?>