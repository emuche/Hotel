<?php 

require_once 'init.php';
include_once ROOT_PATH.'/includes/overall/header.php';

logged_out_redirect();

if(empty($_POST) === false){
	$requires_fields = array('current_password','password','password_again');
	foreach ($_POST as $key=>$value){
		if (empty($value) && in_array($key, $requires_fields) === true){
			$errors[] = 'Fields marked with asterisk are required';
			break 1;
		}	
	}
	if(md5($_POST['current_password']) === $user_data['password']){
		if ((strlen($_POST['password']) < 6) || (strlen($_POST['password']) > 32 )){
			$errors[] = 'Your password should be between 6 to 32 characters' ;
		}else if(trim($_POST['password']) !== trim($_POST['password_again'])){
			$errors[] = 'Your password do not match';			
		}
	}else {
		$errors[] = 'enter the correct current password';
	}
}


?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Change Password Page</h3>



<?php

if(isset($_GET['success']) && empty($_GET['success'])){

	echo '<h4 class="alert alert-success text-center fade in">
			You Password has been changed successfully
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove"></span></a>
		 </h4>';
}else {
if (empty($_POST) === false && empty($errors) === true ){
	change_password($session_user_id, $_POST['password']);
	header('Location: changepassword.php?success');
}else if (empty($errors) === false){
	echo '<h4 class="alert alert-danger text-center fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove"></span></a>'.output_errors($errors).'</h4>';;
}
?>
<div class="col-md-4 centerDiv">
	<form action="" method="post" role="form" class="form-horizontal text-center">
		<div class="form-group ">
				<label for="current_password" class="">Current Password*</label>
				<div class="">
					<input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter Current Password*">
				</div>
		</div>
		<div class="form-group">
				<label for="password" class="">New Password*</label>
				<div class="">
					<input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password*">
				</div>
		</div>
		<div class="form-group">
				<label for="password_again" class="">New Password Again*</label>
				<div class="">
					<input type="password" class="form-control" id="password_again" name="password_again" placeholder="Enter New Password Again*">
				</div>
		</div>
		<div class="">
			<button type="submit" id="submit" class="btn btn-success">Change Password</button>		
		</div>
	</form>	
</div>
		
<?php 
}
include ROOT_PATH.'/includes/overall/footer.php';?>