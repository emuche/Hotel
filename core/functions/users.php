<?php 

function update_recovered_password($email, $new_password){
	
	global $link;
	$email = mysqli_real_escape_string($link, $email);
	$email_code = md5(microtime());
	
	mysqli_query($link, "UPDATE `users` SET `password` = '$new_password' ,`active` = 1, `email_code` = '$email_code' WHERE `email` = '$email' ");
}


function email_code_n_email_exists($email, $email_code){
	
	global $link;
	$email = mysqli_real_escape_string($link, $email);
	$email_code = mysqli_real_escape_string($link, $email_code);
	
	$query6 = mysqli_query($link, "SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `email_code` = '$email_code'");
	if( mysqli_result($query6, 0) == 1){
		return true;
	}else{
		return false;
	}
}


function recover($mode, $email){
	global $link;
	$mode	= sanitize($mode);
	$email	= sanitize($email);
	
	$user_data = user_data(user_id_from_email($email), 'first_name', 'username');
	if($mode == 'username'){
		email($email,'Recover your username',"Hello ".$user_data['first_name'].",\n\nYour username is: ".$user_data['username']."\n\n-willhill Academy");
	}else if($mode == 'password'){
		
		$email_code = md5( rand(00000, 99999)+ microtime());
		mysqli_query($link, "UPDATE `users` SET `email_code` = '$email_code' WHERE `email` = '$email'");
		email($email,'recover your password', "Hello ".$user_data['first_name'] .",\n\nuse the link below to change your password:\n\nhttp://localhost/logreg/recoverpassword.php?email=".$email."&email_code=".$email_code ."\n\n- willhill Academy");
	}
}

function update_user($update_data){
	global $link;
	global $session_user_id;
	array_walk($update_data, 'array_sanitize');
	
	foreach($update_data as $field=>$data){
		$update[] = '`'.$field.'`=\''.$data.'\'';
	}
	
	mysqli_query($link, "UPDATE `users` SET ".implode (', ', $update) ."WHERE `user_id` = $session_user_id") or die(mysqli_error());
}

function activate($email, $email_code){
	
	global $link;
	$email = mysqli_real_escape_string($link, $email);
	$email_code = mysqli_real_escape_string($link, $email_code);
	
	$query6 = mysqli_query($link, "SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email' AND `email_code` = '$email_code' AND `active` = 0 ");
	if( mysqli_result($query6, 0) == 1){
		mysqli_query($link, "UPDATE `users` SET `active` = 1 WHERE `email` = '$email' ");
		return true;
	}else{
		return false;
	}
}

function change_password($user_id, $password){
	global $link;
	$user_id = (int)$user_id;
	$password = md5 ($password);
	
	$query7 = "UPDATE `users` SET `password` = '$password' WHERE `user_id` = $user_id ";
	mysqli_query($link, $query7);
}

function register_user($register_data){
	global $link;
	
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	
	$fields = '`'.implode('`,`',array_keys($register_data)).'`';
	$data = '\''.implode('\',\'',$register_data).'\'';
	mysqli_query($link, "INSERT INTO `users` ($fields) VALUE ($data)");
	
	email($register_data['email'],'Activate you account', "Hello ".$register_data['first_name'] .".\n\nYou need to activate your account, so use the link below:\n\nhttp://localhost/logreg/activate.php?email=".$register_data['email'] ."&email_code=" .$register_data['email_code'] ."\n\n- willhill Academy");
}

function user_count($table = 'users'){
	global $link;
	$query = mysqli_query($link, "SELECT COUNT(`user_id`) FROM `users` WHERE `active` = 1");
	return mysqli_result($query,0);
}

function user_data($user_id){
	global $link;
	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	if($func_num_args > 1){
		unset($func_get_args[0]);
		$fields = '`' .implode('`,`', $func_get_args) .'`';
		$data = mysqli_fetch_assoc(mysqli_query($link, "SELECT $fields FROM `users` WHERE `user_id` = $user_id" ));
		 
		return $data;
	}
}


function logged_in($department = null){
	global $link; 
	
	$query1 = "SELECT COUNT(`user_id`) FROM `users`  ";	

	if(isset($_SESSION['user_id'])){
		$user_id 	= 	$_SESSION['user_id'];
		$query1 .=" WHERE `user_id` = '$user_id' ";
	}

	if(isset($department)){
		$department = sanitize($department);
		$query1 	.= " AND `department`= '$department'";
	}

	$query1 = mysqli_query($link, $query1) ;	
	return (mysqli_result($query1,0) == 1) ? true : false;
}

function user_exists($username){
	global $link; 
	$username = sanitize($username);
	$query1 = mysqli_query($link, "SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'") ;	
	return (mysqli_result($query1,0) == 1) ? true : false;
}


function email_exists($email){
	global $link; 
	$email = sanitize($email);
	$query8 = mysqli_query($link, "SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'") ;	
	return (mysqli_result($query8,0) == 1) ? true : false;
}


function user_active($username){
	global $link; 
	$username = sanitize($username);
	$query2 = mysqli_query($link, "SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `active` = 1 ") ;	
	return (mysqli_result($query2,0) == 1) ? true : false;
}

function user_id_from_email($email){
	global $link; 
	$email = sanitize($email);
	$query5 = mysqli_query($link, "SELECT `user_id` FROM `users` WHERE `email` = '$email'") ;	
	return mysqli_result($query5,0,'user_id');
}

function user_id_from_username($username){
	global $link; 
	$username = sanitize($username);
	$query3 = mysqli_query($link, "SELECT `user_id` FROM `users` WHERE `username` = '$username'") ;	
	return mysqli_result($query3,0,'user_id');
}


function login($username, $password, $department){
	global $link; 
	$user_id = user_id_from_username($username);
	
	$username 		= sanitize($username);
	$password 		= md5($password);
	$department		= sanitize($department);
	$query4 = mysqli_query($link, "SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username' AND `password` = '$password' AND `department` = '$department' ");	
	return (mysqli_result($query4, 0) == 1) ? $user_id : false;
}



?> 