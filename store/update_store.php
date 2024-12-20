<?php

require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';

exclude_page('store');
//error_reporting(0);

if(isset($_GET['id'])){
	$id = $_GET['id'];
}elseif (!isset($_GET['id'])) {
	$id = 0;
}



if(empty($_POST) === false){

	$required_fields = array('category','description','quantity','unit_price','store_product', 'dept_recieved_from', 'recieved_from');
	foreach ($_POST as $key=>$value){
		if (empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with asterisk are required';
			break 1;
		}	
	}
		if(!filter_var($_POST['quantity'], FILTER_VALIDATE_INT)){
			$errors[] = 'numbers is required in Quantity field';
		}
		if(!filter_var($_POST['unit_price'], FILTER_VALIDATE_INT)){
			$errors[] = 'numbers is required in Unit Price field';
		}
		if(strlen($_POST['quantity'])> 7){
			$errors[] = 'maximum of 7 digits are required in room rate field';
		}
		if(strlen($_POST['unit_price'])>7){
			$errors[] = 'maximum of 7 digits are required in security deposite field';
		}
}

?>
<title> Hotel | Update Store </title>


<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Update Store Page</h3>


<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	alert_success('Store Item has been Updated');
	 
}else{ if(empty($_POST) === false && empty($errors) === true){
	

	$update_data = array(
		'category' 					=> $_POST['category'],
		'store_product' 			=> $_POST['store_product'],
		'description' 				=> $_POST['description'],
		'recieved_from' 			=> $_POST['recieved_from'],
		'dept_recieved_from' 		=> $_POST['dept_recieved_from'],
		'recieved_by' 				=> $user_data['last_name'].' '.$user_data['first_name'],
		'quantity' 					=> $_POST['quantity'],
		'unit_price' 				=> $_POST['unit_price'],
		'total' 					=> $_POST['quantity'] * $_POST['unit_price'],
		'time' 						=> date("h:i:a"),
		'date'						=> date("d/M/Y"),

	);
	
	update_customer($update_data, null, 'store', $id);
	header('Location: update_store.php?success');
	exit();
	
}else if(empty($errors) === false){
	alert_warning(output_errors($errors));
}

foreach(get_available_store(null, 'store', null, $id) as $store_data){
?>
	<form action="" method="post" role="form" class="form-horizontal text-center">
		<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<td>
					<label for="category" >Category</label>
					<input type="text" id="category" class="form-control" value="<?php if(isset($_POST['category'])){echo $_POST['category'];}elseif(isset($_GET['id'])){echo $store_data['category'];}?>" name="category" readonly>
				</td>


				<td>
					<label for="store_product" >Store Product</label>
					<input type="text" id="store_product" class="form-control" value="<?php if(isset($_POST['store_product'])){echo $_POST['store_product'];}elseif(isset($_GET['id'])){echo $store_data['store_product'];}?>" name="store_product" readonly>
				</td>

				<td>
				<label for="description">Description</label>
					<input type="text" name="description" class="form-control drink_sales_description" placeholder="Description*" value= "<?php if(isset($_POST['description'])){echo $_POST['description'];}elseif(isset($_GET['id'])){echo $store_data['description'];}?>" readonly>
				</td>
				<td>
				<label for="unit_price">Unit Price</label>
					<input type="text" name="unit_price" class="form-control drink_sales_unit_price" placeholder="Unit Price" id="unit_price" onkeyup="calculate();" value= "<?php if(isset($_POST['unit_price'])){echo $_POST['unit_price'];}elseif(isset($_GET['id'])){echo $store_data['unit_price'];}?>" readonly>
				</td>
				<td>
				<label for="quantity">Quantity</label>
					<input type="text" name="quantity" class="form-control" placeholder="Quantity*" id="quantity" onkeyup="calculate();" value= "<?php if(isset($_POST['quantity'])){echo $_POST['quantity'];}elseif(isset($_GET['id'])){echo $store_data['quantity'];}?>">
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
					<button type="submit" class="btn btn-success">Update Store</button>
				</td>
			</tr>
		</table>
	</form>	
	
	
	
		
<?php
}
}

include ROOT_PATH.'/includes/overall/footer.php';?>