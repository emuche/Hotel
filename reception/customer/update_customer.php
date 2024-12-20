<?php
require_once '../../init.php';
include ROOT_PATH.'/includes/overall/header.php';

exclude_page('reception');

if(isset($_GET['customer_code'])){
$customer_code = $_GET['customer_code'];
}	

if(empty($_POST) === false){

	$required_fields = array('room_type', 'room_number','room_rate','no_of_days');
	foreach ($_POST as $key=>$value){
		if (empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with asterisk are required';
			break 1;
		}	
	}

		if(!filter_var($_POST['room_number'], FILTER_VALIDATE_INT)){
			$errors[] = 'numbers is required in room number field';
		}
		if (room_available($_POST['room_number']) == '0') {
			$errors[] = 'Room '.$_POST['room_number'].' is taken already';
		}
		if(!filter_var($_POST['room_rate'], FILTER_VALIDATE_INT)){
			$errors[] = 'numbers is required in room rate field';
		}
		if(!is_numeric($_POST['security_deposite'])){
			$errors[] = 'numbers is required in security deposite field';
		}
		if(!filter_var($_POST['no_of_days'], FILTER_VALIDATE_INT)){
			$errors[] = 'numbers is required in No of day(s) field';
		}
		if(strlen($_POST['room_number'])>4){
			$errors[] = 'maximum of 4 digits are required in room number field';
		}
		if(strlen($_POST['room_rate'])> 7){
			$errors[] = 'maximum of 7 digits are required in room rate field';
		}
		if(strlen($_POST['security_deposite'])>7){
			$errors[] = 'maximum of 7 digits are required in security deposite field';
		}
		if(strlen($_POST['no_of_days'])> 3){
			$errors[] = 'maximum of 3 digits are required in No of day(s) field';
		}
	
}

?>
<title> Hotel | Update Customer</title>

<?php
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_customer_submenu.php';	

?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Room Sales Page</h3>	

<?php 
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	alert_success('Customer has been Updated');
}else {if(empty($_POST) === false && empty($errors) === true){

	$update_data = array(
		'room_number' 			=> $_POST['room_number'],
		'no_of_days' 			=> $_POST['no_of_days'],
		'room_rate' 			=> $_POST['room_rate'],
		'security_deposite'		=> $_POST['security_deposite'],
		'room_description'		=> $_POST['room_description'],
		'room_type'				=> $_POST['room_type'],
		'date' 					=> date("d/M/Y"),
		'total' 				=> ($_POST['no_of_days']) *($_POST['room_rate']),
	);
	
	update_customer($update_data, $customer_code, 'new_customer');
	update_cell('rooms_available', 'customer_code', $customer_code, 'room_number', $_POST['room_number']);
	update_cell('rooms_available', 'available', '0', 'room_number', $_POST['room_number']);
	header('Location: update_customer.php?success');
	exit();
	
}elseif(empty($errors) === false){
	alert_danger(output_errors($errors));
	
}




?>




	<table  class="table table-striped table-hover table-bordered table-responsive">
		<tr>
			<th>Customer Name</th>
			<th>Customer Code</th>
			<th>Phone Number</th>
			<th>Occuption</th>
			<th>Address</th>
		</tr>
		<tr>
			<td><?php echo $customer_data['customer_name'];?></td>
			<td><?php echo $customer_data['customer_code'];?></td>
			<td><?php echo $customer_data['phone_number'] ;?></td>
			<td><?php echo $customer_data['occupation'] ;?></td>
			<td><?php echo $customer_data['address'] ;?></td>

		</tr>
		<tr>
			<th>Room Type</th>
			<th>Room Number</th>
			<th>Room Rate</th>
			<th>Room Description</th>
			<th>No of Days</th>
			
		</tr>
		<tr>
			<td><?php echo $customer_data['room_type'];?></td>
			<td><?php echo $customer_data['room_number'];?></td>
			<td><?php echo $customer_data['room_rate'];?></td>
			<td><?php echo $customer_data['room_description'];?></td>
			<td><?php echo $customer_data['no_of_days'];?></td>

			
		</tr>
	</table>
	<br>
<form action="" method="post" role="role" class="form-horizontal text-center">
	<div class="form-group">




		<div class="col-md-4">
			<label for="room_type" >Room Type</label>
			<select name="room_type" id="room_type" class="form-control room_type" required>
			<option value="" disabled selected >Room Type</option>
				
				<?php if(isset($_POST['room_type'])){	?>
	     <option selected="selected" value="<?php echo $_POST['room_type']; ?>"><?php echo $_POST['room_type'];?></option>
			<?php } ?>

				<?php 
				foreach (get_categories('room_categories') as $category){
					?>
					<option value = "<?php echo $category['category'];?>"><?php echo $category['category'];?></option>
					<?php
				}
				?>
		</select>
		</div>

		<div class="col-md-4">
			<label for="room_number" >Room Number</label>
			<select name= "room_number" id="room_number" class="form-control room_number" required readonly>


				<?php if(isset($_POST['room_number'])){	?>
     				<option selected="selected" value="<?php echo $_POST['room_number']; ?>"><?php echo $_POST['room_number'];?></option>
				<?php } ?>
				
		</select>
		</div>

		<div class="col-md-4">
			<label for="room_rate">Room Rate (per day)*</label>
			<input type="text" id ="room_rate" class="form-control room_rate" name="room_rate" placeholder="Room Rate (per day)*" value= "<?php if(isset($_POST['room_rate'])){echo $_POST['room_rate'];}else{echo $customer_data['room_rate'] ;}?>" readonly>
		</div>
		<div class="col-md-4">
			<label for="room_description">Room Description*</label>
			<input type="text" id ="room_description" class="form-control room_description" name="room_description" placeholder="Room Description" value= "<?php if(isset($_POST['room_description'])){echo $_POST['room_description'];}else{echo $customer_data['room_description'] ;}?>" readonly>
		</div>
		<div class="col-md-4">
			<label for="no_of_days">Number of Day(s)*</label>
			<input type="text" id="no_of_days" class="form-control" name="no_of_days" placeholder="Number of Day(s)*" value= "<?php if(isset($_POST['no_of_days'])){echo $_POST['no_of_days'];}else{echo $customer_data['no_of_days'] ;}?>">
		</div>
		<div class="col-md-4">
			<label for="security_deposite">Security Deposit (Naira)*</label>
			<input type="text" name="security_deposite" id="security_deposite" class="form-control" placeholder="Security Deposite (Naira)*" value= "<?php if(isset($_POST['security_deposite'])){echo $_POST['security_deposite'];}else{echo $customer_data['security_deposite'] ;}?>">
		</div>
		
		<div class="col-md-4">
			<label for="total">Total (Naira)</label>
			<fieldset disabled>
				<input type="text" id="total" id="total" name="" class="form-control" placeholder="<?php if(!empty($_POST['room_rate'])  && !empty($_POST['no_of_days'])){
						echo ($_POST['room_rate'])* ($_POST['no_of_days']);
						}else {echo $customer_data['total'];}?>">
			</fieldset>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
			<label for="submit" class=""></label>
			<button type="submit" id="submit" class="btn btn-success">Update</button>
		</div>
	</div>
</form>
<?php  } include ROOT_PATH.'/includes/overall/footer.php';?>