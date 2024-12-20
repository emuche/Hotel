<?php
require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('bar');

//error_reporting(0);

if(isset($_GET['id'])){
	$id = $_GET['id'];

}elseif (!isset($_GET['id'])) {
	$id = 0;}
if(empty($_POST) === false){

	$required_fields = array('category','bar_product', 'description','quantity', 'recieved_from', 'dept_recieved_from');
	foreach ($_POST as $key=>$value){
		if (empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with asterisk are required';
			break 1;
		}	
	}
		if(category_exists() === true){
			$errors[] = 'Drink Already Exists'; 
		}
		if(!filter_var($_POST['quantity'], FILTER_VALIDATE_INT)){
			$errors[] = 'numbers is required in Quantity field';
		}
		if(strlen($_POST['quantity'])> 7){
			$errors[] = 'maximum of 7 digits are required in room rate field';
		}
}

?>
<title> Hotel | Update Bar </title>


<h3 class="text-center text-info"><?= strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Update Bar Page</h3>

<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	alert_success('Bar Drink has been Updated');
}else{ if(empty($_POST) === false && empty($errors) === true){
	

	$update_data = array(
		'category' 				=> $_POST['category'],
		'drink_name' 			=> $_POST['drink_name'],
		'description' 			=> $_POST['description'],
		'recieved_by' 			=> $user_data['last_name'].' '.$user_data['first_name'],
		'quantity' 				=> $_POST['quantity'],
		'recieved_from'			=> $_POST['recieved_from'],
		'dept_recieved_from'	=> $_POST['dept_recieved_from'],
		'time' 					=> date("h:i:a"),
		'date'					=> date("d/M/Y"),
	);
	
	update_customer($update_data, null, 'bar', $id);
	header('Location: update_bar.php?success');
	exit();
	
}else if(empty($errors) === false){
	alert_warning(output_errors($errors));
	
}

foreach(get_available_store(null, 'bar', null, $id) as $store_data){
?>
	<form action="" method="post" role="form" class="form-horizontal text-center">
		<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				
				<td>
					<label for="category" >Category</label>
					<input type="text" id="category" class="form-control" value="<?php if(isset($_POST['category'])){echo $_POST['category'];}elseif(isset($_GET['id'])){echo $store_data['category'];}?>" name="category" readonly>
				</td>

				<td>
					<label for="drink_name" >Drink Name</label>
					<input type="text" id="drink_name" class="form-control" value="<?php if(isset($_POST['drink_name'])){echo $_POST['drink_name'];}elseif(isset($_GET['id'])){echo $store_data['drink_name'];}?>" name="drink_name" readonly>
				</td>
				<td>
					<label>Description</label>
					<input type="text" name="description" placeholder="Description*" class="form-control drink_sales_description" value= "<?php if(isset($_POST['description'])){echo $_POST['description'];}else{ echo $store_data['description'];}?>" readonly>
				</td>
				<td>
					<label>Quantity</label>
					<input type="number" name="quantity" class="form-control" placeholder="Qty*" value= "<?php if(isset($_POST['quantity'])){echo $_POST['quantity'];}else{ echo $store_data['quantity'];}?>">
				</td>
				<td>
					<label>Recieved From</label>
					<input type="text" name="recieved_from" id="recieved_from" class="form-control" placeholder="Recieved From*" value= "<?php if(isset($_POST['recieved_from'])){echo $_POST['recieved_from'];}else{ echo $store_data['recieved_from'];}?>">
				</td>
				<td>
					<label>Department Recieved From</label>
					<input type="text" name="dept_recieved_from" id="dept_recieved_from" class="form-control" placeholder="Department Recieved From*" value= "<?php if(isset($_POST['dept_recieved_from'])){echo $_POST['dept_recieved_from'];}else{ echo $store_data['dept_recieved_from'];}?>">
				</td>
				<td>
					<label></label><br>
					<button type="submit" class="btn btn-success">Update Drink</button>
				</td>
			</tr>
		</table>
	</form>	
	
	
	
		
<?php
}
}

include_once ROOT_PATH.'/includes/overall/footer.php';?>