<?php
require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('kitchen');

//error_reporting(0);

if(isset($_GET['id'])){
	$id = $_GET['id'];

}elseif (!isset($_GET['id'])) {
	$id = 0;
}
if(empty($_POST) === false){

	$required_fields = array('category','food_name', 'description','quantity', 'recieved_from', 'dept_recieved_from');
	foreach ($_POST as $key=>$value){
		if (empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with asterisk are required';
			break 1;
		}	
	} 
		if(!filter_var($_POST['quantity'], FILTER_VALIDATE_INT)){
			$errors[] = 'numbers is required in Quantity field';
		}
		if(strlen($_POST['quantity'])> 7){
			$errors[] = 'maximum of 7 digits are required in room rate field';
		}
}

?>
<title> Hotel | Update Food Stuff </title>


<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Update Food Stuff Page</h3>

<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	alert_success('Food Stuff has been Updated Successfully');
}else{ if(empty($_POST) === false && empty($errors) === true){
	

	$update_data = array(
		'category' 				=> $_POST['category'],
		'food_name' 			=> $_POST['food_name'],
		'description' 			=> $_POST['description'],
		'recieved_by' 			=> $user_data['last_name'].' '.$user_data['first_name'],
		'quantity' 				=> $_POST['quantity'],
		'recieved_from'			=> $_POST['recieved_from'],
		'dept_recieved_from'	=> $_POST['dept_recieved_from'],
		'time' 					=> date("h:i:a"),
		'date'					=> date("d/M/Y"),
	);
	
	update_customer($update_data, null, 'kitchen', $id);
	header('Location: update_food.php?success');
	exit();
	
}else if(empty($errors) === false){
	alert_warning(output_errors($errors));
}

foreach(get_available_store(null, 'kitchen', null, $id) as $store_data){
?>
	<form action="" method="post" role="form" class="form-horizontal text-center">
		<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				
				<td>
					<label>Food Stuff Category</label>
					<input type="text" name="category" placeholder="Food Stuff Category*" class="form-control " value= "<?php if(isset($_POST['category'])){echo $_POST['category'];}else{ echo $store_data['category'];}?>" readonly>
				</td>
				<td>
					<label>Food Name</label>
					<input type="text" name="food_name" placeholder="Food Name*" class="form-control " value= "<?php if(isset($_POST['food_name'])){echo $_POST['food_name'];}else{ echo $store_data['food_name'];}?>" readonly>
				</td>
				<td>
					<label>Description</label>
					<input type="text" name="description" placeholder="Description*" class="form-control drink_sales_description" value= "<?php if(isset($_POST['description'])){echo $_POST['description'];}else{ echo $store_data['description'];}?>" readonly>
				</td>
				<td>
					<label>Quantity</label>
					<input type="number" name="quantity" class="form-control" placeholder="Qty*" value= "<?php if(isset($_POST['quantity'])){echo $_POST['quantity'];}else{ echo $store_data['quantity'];}?>"
				</td>
				<td>
					<label>Recieved From</label>
					<input type="text" name="recieved_from" id="recieved_from" class="form-control" placeholder="Recieved From*" value= "<?php if(isset($_POST['recieved_from'])){echo $_POST['recieved_from'];}else{ echo $store_data['recieved_from'];}?>">
				</td>
				<td>
					<label>Department Recieved</label>
					<input type="text" name="dept_recieved_from" id="dept_recieved_from" class="form-control" placeholder="Department Recieved From*" value= "<?php if(isset($_POST['dept_recieved_from'])){echo $_POST['dept_recieved_from'];}else{ echo $store_data['dept_recieved_from'];}?>">
				</td>
				<td>
					<label></label><br>
					<button type="submit" class="btn btn-success">Update Food Stuff</button>
				</td>
			</tr>
		</table>
	</form>	
	
	
	
		
<?php
}
}

include_once ROOT_PATH.'/includes/overall/footer.php';?>