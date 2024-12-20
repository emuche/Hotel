<?php

require_once '../../init.php';
include ROOT_PATH.'/includes/overall/header.php';

exclude_page('reception');
//error_reporting(0);

if(empty($_POST) === false){

	$required_fields = array('customer_name','phone_number','gender','occupation');
	foreach ($_POST as $key=>$value){
		if (empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with asterisk are required';
			break 1;
		}	
	} if(empty($errors) === true){

		if(!is_numeric($_POST['phone_number'])){
			$errors[] = 'numbers is required in phone number field';
		}
		
		if(strlen($_POST['phone_number']) != 11){
			$errors[] = 'only 11 digits are required in phone number field';
		}
	}
	

}

?>
<title> Hotel | New Customer </title>


<?php
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_customer_submenu.php';	

?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Add new customer page</h3>	

<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true){


	alert_success('New Customer has been added');

}else{ if(empty($_POST) === false && empty($errors) === true){
	

	$update_data = array(
		'customer_name' 			=> $_POST['customer_name'],
		'phone_number' 				=> $_POST['phone_number'],
		'address' 					=> $_POST['address'],
		'email' 					=> $_POST['email'],
		'gender' 					=> $_POST['gender'],
		'occupation' 				=> $_POST['occupation'],
		'car_reg' 					=> $_POST['car_reg'],
		'country' 					=> $_POST['country'],
		'state' 					=> $_POST['state'],
		'administrator' 			=> $user_data['last_name'].' '.$user_data['first_name'],
		'time'		 				=> date("h:i:a"),
		'date'						=> date("d/M/Y"),
	);
	
	add_customer($update_data);
	header('Location: addnewcustomer.php?success');
	exit();
	
}else if(empty($errors) === false){

	alert_danger(output_errors($errors));
	
}


?>

<form action="" method="post" class="form-horizontal text-center" role="form">
		<div class="form-group">
			<div class="col-md-4">
				<label for="customer_name">Customer Name*</label><br>
				<input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Customer Name*" value= "<?php if(isset($_POST['customer_name'])){echo $_POST['customer_name'];}?>">
			</div>
			<div class="col-md-4">
				<label for="phone_number">Phone Number*</label><br>
				<input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Phone Number*" value= "<?php if(isset($_POST['phone_number'])){echo $_POST['phone_number'];}?>">
			</div>
			<div class="col-md-4">
				<label for="gender">Gender*</label><br>
				<select name="gender" id="gender" class="form-control" required>
					<option value="" disabled selected > Gender*</option>
					<?php if(isset($_POST['gender'])){	?>
                     <option selected="selected" value="<?php echo $_POST['gender']; ?>"><?php echo $_POST['gender'];?></option>
						<?php } ?>
					<option value="male"> Male</option>
					<option value="female"> Female</option>
				</select>
			</div>
		</div>
		<div class="form-group"> 
			<div class="col-md-4">
				<label for="country">Country</label><br>
				<select name= "country" id="country" class="form-control" required>
					<option value="" disabled selected >Country</option>
					<?php if(isset($_POST['country'])){	?>
                     <option selected="selected" value="<?php echo $_POST['country']; ?>"><?php echo $_POST['country'];?></option>
						<?php } ?>
					<option value="nigerian"> Nigerian</option>
					<option value="non_nigerian"> Non Nigerian</option>
				</select>
			</div>
			<div class="col-md-4">
				<label for="state">State</label><br>
				<select name="state" id="state" class="form-control" required >
					<option value="" disabled selected > state</option>
					<?php if(isset($_POST['state'])){	?>
                     <option selected="selected" value="<?php echo $_POST['state']; ?>"><?php echo $_POST['state'];?></option>
						<?php } ?>
					<option value="abia">Abia</option>
					<option value="anambra">Anambra</option>
					<option value="ebonyi">Ebonyi</option>
					<option value="enugu">Enugu</option>
					<option value="imo">Imo</option>
				</select>
			</div>
			<div class="col-md-4">
				<label for="address">Address</label><br>
				<input type="text" name="address" class="form-control" id="address" placeholder="Address" value= "<?php if(isset($_POST['address'])){echo $_POST['address'];}?>">
			</div>
		
		</div>
		<div class="form-group">
			<div class="col-md-4">
				<label for="occupation">Occupation*</label><br>
				<input type="text" name="occupation" id="occupation" class="form-control" placeholder="Occupation" value= "<?php if(isset($_POST['occupation'])){echo $_POST['occupation'];}?>">
			</div>
			<div class="col-md-4">
				<label for="email">E-mail</label><br>
				<input type="email" name="email" id="email" class="form-control" placeholder="Email" value= "<?php if(isset($_POST['email'])){echo $_POST['email'];}?>">
			</div>
			<div class="col-md-4">
				<label for="car_reg">Car Rgistration Number</label><br>
				<input type="text" name="car_reg" id="car_reg" class="form-control" placeholder="Car Registration Number" value= "<?php if(isset($_POST['car_reg'])){echo $_POST['car_reg'];}?>">
			</div>
		</div>
	</div>

	<div class="text-center centerDiv" role="form">
		<div class="form-group">
			<label for="submit"></label><br>
			<button type="submit" id="submit" class="btn btn-success" value="">Add New Customer</button>
		</div>
	</div>	
</form>	
	
	
	
	
	
		
<?php
}

include_once ROOT_PATH.'/includes/overall/footer.php';?>