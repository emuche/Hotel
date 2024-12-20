<?php
session_start();
if(time() < strtotime('01 April 2033') ) {
	define('ROOT_PATH', dirname(__FILE__));
	require_once ROOT_PATH.'/core/database/connect.php';
	require_once ROOT_PATH.'/core/functions/general.php';
	require_once ROOT_PATH.'/core/functions/users.php';
	require_once ROOT_PATH.'/core/functions/customer_functions.php';

	if (logged_in() === true){
		$session_user_id = $_SESSION['user_id'];
		$user_data = user_data($session_user_id,'user_id','username', 'password', 'first_name','last_name','email', 'department', 'salary', 'phone_number', 'address', 'active');
		
		if(user_active($user_data['username']) === false){
			session_destroy();
			header('Location: index.php');
			exit();
		}
	}

if((isset($_POST['customer_code']) && !empty($_POST['customer_code']))  || (isset($_GET['customer_code']) &&!empty($_GET['customer_code']))){
	if(isset($_POST['customer_code'])){
			$customer_code = $_POST['customer_code'];
	}
	if(isset($_GET['customer_code'])){
			$customer_code = $_GET['customer_code'];
	}
	$customer_data = customer_data($customer_code,'customer_id', 'customer_code','customer_name','address','phone_number', 'occupation', 'email','gender', 'car_reg','country', 'state', 'check_out', 'room_type', 'room_number' , 'no_of_days', 'room_rate','room_description', 'security_deposite', 'administrator', 'time','date', 'total', 'quantity');	
}

$errors = array();    
	
}else {
	echo ':Contact Program Support For Assistance: Code Message 3005 Error  ';
}
?>