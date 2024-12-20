<?php
require_once '../../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');

//error_reporting(0);

if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = $_GET['id'];
}elseif (!isset($_GET['id'])) {
	$id = 0;
}



if(empty($_POST) === false){

	$required_fields = array('category', 'food_name', 'description', 'unit_price','quantity');
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
			$errors[] = 'maximum of 7 digits are required in Quantity field';
		}
		if(!filter_var($_POST['unit_price'], FILTER_VALIDATE_INT)){
			$errors[] = 'numbers is required in Unit Price field';
		}
		if(strlen($_POST['unit_price'])> 7){
			$errors[] = 'maximum of 7 digits are required in Unit Price field';
		}
}

?>
<title> Hotel | Edit Food</title>



<?php
	
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_kitchen_submenu.php';	
?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Edit Food page</h3>	
<?php


if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	alert_success('Food has been Updated');
}else{ if(empty($_POST) === false && empty($errors) === true){
	

	$update_data = array(
		'category' 			=> $_POST['category'],
		'food_name' 		=> $_POST['food_name'],
		'description' 		=> $_POST['description'],
		'quantity' 			=> $_POST['quantity'],
		'unit_price'		=> $_POST['unit_price'],
		'total'				=> (($_POST['unit_price']) *($_POST['quantity'])),
		'added_by' 			=> $user_data['last_name'].' '.$user_data['first_name'],
		'time' 				=> date("h:i:a"),
		'date'				=> date("d/M/Y"),
	);
	
	
	update_customer($update_data, null, 'kitchen_products', $id);
	header('Location: edit_food.php?success');
	exit();
	
}else if(empty($errors) === false){
	alert_warning(output_errors($errors));
}



foreach(get_available_store(null, 'kitchen_products', null, $id) as $store_data){
?>

	<form action="" method="post" role="form" class="form-horizontal text-center">
				<div class="form-group"> 
					<div class="col-md-4">
						<label for="category" >Food Category</label>
						
							<input type="text" name="category" id="category" class="form-control" placeholder="Category Name*" id="" value= "<?php if(isset($_POST['category'])){echo $_POST['category'];}else{ echo $store_data['category'];}?>" readonly>
				
					</div>
					<div class="col-md-4">
						<label for="food_name">Food Name</label>
				
						<input type="text" name="food_name" id="food_name" class="form-control" placeholder="Food Name*" id="" value= "<?php if(isset($_POST['food_name'])){echo $_POST['food_name'];}else{ echo $store_data['food_name'];}?>" readonly>
			
					</div>
					<div class="col-md-4">
						<label for="description">Description</label>
						<input type="text" name="description" id="description" class="form-control" placeholder="Description*" id="" value= "<?php if(isset($_POST['description'])){echo $_POST['description'];}else{ echo $store_data['description'];}?>">
					</div>
					<div class="col-md-4">
						<label for="unit_price">Unit Price</label>
						<input type="number" name="unit_price" id="unit_price" class="form-control" placeholder="Unit Price*" id="unit_price" value= "<?php if(isset($_POST['unit_price'])){echo $_POST['unit_price'];}else{ echo $store_data['unit_price'];}?>"> 
					</div>
					<div class="col-md-4">
						<label for="quantity">Quantity</label>
						<input type="number" id="quantity" class="form-control" name="quantity" placeholder="Quantity*" id="quantity" onkeyup ="calculate();" value= "<?php if(isset($_POST['quantity'])){echo $_POST['quantity'];}else{ echo $store_data['quantity'];}?>"> 
					</div>
					
					<div class="col-md-4">
						<label for="total">Total: (Naira)</label>
					
							<input type="text" id="total" class="form-control text-center" placeholder="<?php if(!empty($_POST['unit_price'])  && !empty($_POST['quantity'])){echo ($_POST['unit_price'])* ($_POST['quantity']);}else{ echo $store_data['total'];}?>" readonly>
			
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<button type="submit" id="" name="submit" class="btn btn-success">Update Food</button>
					</div>
				</div>

	</form>	

<?php
}
}

include_once ROOT_PATH.'/includes/overall/footer.php';?>


