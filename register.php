<?php

require_once 'init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');

 
if(empty($_POST) === false){
	$required_fields = array('username','password','password_again','first_name','email','department', 'salary', 'phone_number' ,'address');
	foreach ($_POST as $key=>$value){
		if (empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with asterisk are required';
			break 1;
		}	
	}
	if(empty($errors) === true){
		if(user_exists($_POST['username']) === true){
			$errors[] = 'Sorry, the username \'' .$_POST['username'] .'\' is already taken.';
		}
		if(preg_match("/\\s/", $_POST['username']) == true){
			$errors[] = 'Your username must not contain any spaces';
		}
		if ((strlen($_POST['password']) < 6) || (strlen($_POST['password']) > 32 )){
			$errors[] = 'Your password should be between 6 to 32 characters' ;
		}
		if ((strlen($_POST['phone_number']) != 11) || (!is_numeric($_POST['phone_number']))){
			$errors[] = 'Type a correct phone number';
		}
		if($_POST['password'] !== $_POST['password_again']){
			$errors[] = 'Your password do not match';			
		}
	
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
			$errors[] = 'A valid email address is required';
		}
		if(email_exists($_POST['email']) === true){
			$errors[] = 'Sorry, the Email \'' .$_POST['email'] .'\' is already in use.';
		}
	}
}
 ?>
 		<title>Hotel | Register</title>
		<div class="text-info text-center"><h1>Registeration Page</h1> </div>

		
<?php
if(isset($_GET['success']) && empty($_GET['success'])){

	alert_success('You have registered successfully <br> please check you email to activate your account');

}else {
		
	if(empty($_POST) === false && empty($errors) === true){
		$register_data = array(
		'username' 		=> $_POST['username'],
		'password' 		=> $_POST['password'],
		'first_name' 	=> $_POST['first_name'],
		'last_name' 	=> $_POST['last_name'],
		'phone_number' 	=> $_POST['phone_number'],
		'address' 		=> $_POST['address'],
		'email' 		=> $_POST['email'],
		'department'	=> $_POST['department'],
		'salary'		=> $_POST['salary']
		);
		
		register_user($register_data);
		header('Location: register.php?success');
		exit();
		
	}else if(empty($errors) === false){

		alert_warning(output_errors($errors));

	} 
?>

	<form action="" method="post" class="form-horizontal text-center" role="form" >
		<div class="form-group">
			<div class="col-md-4">
				<label for="username" class="">Username*</label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username*"
				value= "<?php if(isset($_POST['username'])){echo $_POST['username'];}?>">
			</div>
			<div class="col-md-4">
				<label for="password" class="">Password*</label>
				<input type="password" class="form-control" id="password" name="password" placeholder=" Enter Password*">
			</div>
			<div class="col-md-4">
				<label for="password_again" class="">Password Again*</label>
				<input type="password" class="form-control" id="password_again" name="password_again" placeholder=" Enter Password Again*">
			</div>
			<div class="col-md-4">
				<label for="first_name" class="">First Name*</label>
				<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name*" value= "<?php if(isset($_POST['first_name'])){echo $_POST['first_name'];}?>">
			</div>	
			<div class="col-md-4">
				<label for="last_name" class="">Last Name</label>
				<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value= "<?php if(isset($_POST['last_name'])){echo $_POST['last_name'];}?>">
			</div>
			<div class="col-md-4">
				<label for="email" class="">Email*</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email*" value= "<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" >
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-4">
				<label for="department" class="">Department*</label>
				<select class="form-control" id="department" name="department" required>
					<option value="" disabled selected > Department*</option>
				<?php if(isset($_POST['department'])){	?>
                     <option selected="selected" value="<?php echo $_POST['department']; ?>"><?php echo $_POST['department'];?></option>
						<?php } ?>
					
					
					<option value="reception">Reception</option>
					<option value="bar">Bar</option>
					<option value="laundry">Laundry</option>
					<option value="store">Store</option>
					<option value="kitchen">Kitchen</option>
					<option value="admin">Administrator</option>
				</select>
			</div>
			<div class="col-md-4">
				<label for="salary" class="">Salary*</label>
				<input type="number" class="form-control" id="salary" name="salary" placeholder="Staff Salary*" value= "<?php if(isset($_POST['salary'])){echo $_POST['salary'];}?>">
			</div>
			<div class="col-md-4">
				<label for="phone_number" class="">Phone Number*</label>
				<input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Phone Number*" value= "<?php if(isset($_POST['phone_number'])){echo $_POST['phone_number'];}?>">
			</div>
			<div class="col-md-4">
				<label for="address" class="">Address*</label>
				<input type="text" class="form-control" id="address" name="address" placeholder="Enter Address*" value= "<?php if(isset($_POST['address'])){echo $_POST['address'];}?>">
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<label for="submit" class=""></label>
				<button type="submit" id="submit" class="btn btn-success">Submit</button>		
			</div>
		</div>
			
		
	</form>

<?php 
} include_once ROOT_PATH.'/includes/overall/footer.php';
?>