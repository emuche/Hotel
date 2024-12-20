<?php
require_once '../../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');

//error_reporting(0);

if(empty($_POST) === false){

	$required_fields = array('category', 'drink_name', 'description', 'unit_price','quantity');
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
<title> Hotel | Add New Drink</title>



<?php
	
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_bar_submenu.php';	
?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Add New Drink page</h3>	
<?php


if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	alert_success('Drink has been Added');
}else{ if(empty($_POST) === false && empty($errors) === true){
	

	$update_data = array(
		'category' 			=> $_POST['category'],
		'drink_name' 		=> $_POST['drink_name'],
		'description' 		=> $_POST['description'],
		'quantity' 			=> $_POST['quantity'],
		'unit_price'		=> $_POST['unit_price'],
		'total'				=> (($_POST['unit_price']) *($_POST['quantity'])),
		'added_by' 			=> $user_data['last_name'].' '.$user_data['first_name'],
		'time' 				=> date("h:i:a"),
		'date'				=> date("d/M/Y"),
	);
	
	
		//function update_product_quantity($table, $field, $field_value, $category, $category_name){
		add_customer($update_data, 'bar_products');
		header('Location: add_new_drink.php?success');
		exit();
	
	
}else if(empty($errors) === false){
	alert_warning(output_errors($errors));
}
?>

	<form action="" method="post" role="form" class="form-horizontal text-center">
				<div class="form-group"> 
					<div class="col-md-4">
						<label for="category" >Drink Category</label>
						<select name= "category" id="category" class="form-control" required>
							<option value="" disabled selected >Drink Category</option>
							<?php if(isset($_POST['category'])){	?>
                     <option selected="selected" value="<?php echo $_POST['category']; ?>"><?php echo $_POST['category'];?></option>
						<?php } ?>
				
							<?php 
							foreach (get_categories('bar_categories') as $category){
								?>
								<option value = "<?php echo $category['category'];?>"><?php echo $category['category'];?></option>
								<?php
							}
							?>
					</select>
					</div>
					<div class="col-md-4">
						<label for="drink_name">Drink Name</label>
						<input type="text" name="drink_name" id="drink_name" class="form-control" placeholder="Drink Name*" id="" value= "<?php if(isset($_POST['drink_name'])){echo $_POST['drink_name'];}?>">
					</div>
					<div class="col-md-4">
						<label for="description">Description</label>
						<input type="text" name="description" id="description" class="form-control" placeholder="Description*" id="" value= "<?php if(isset($_POST['description'])){echo $_POST['description'];}?>">
					</div>
					<div class="col-md-4">
						<label for="unit_price">Unit Price</label>
						<input type="number" name="unit_price" id="unit_price" class="form-control" placeholder="Unit Price*" id="unit_price" value= "<?php if(isset($_POST['unit_price'])){echo $_POST['unit_price'];}?>"> 
					</div>
					<div class="col-md-4">
						<label for="quantity">Quantity</label>
						<input type="number" id="quantity" class="form-control" name="quantity" placeholder="Quantity*" id="quantity" onkeyup ="calculate();" value= "<?php if(isset($_POST['quantity'])){echo $_POST['quantity'];}?>"> 
					</div>
					
					<div class="col-md-4">
						<label for="total">Total: (Naira)</label>
						<fieldset disabled>
							<input type="text" id="total" class="form-control text-center" placeholder="<?php if(!empty($_POST['unit_price'])  && !empty($_POST['quantity'])){echo ($_POST['unit_price'])* ($_POST['quantity']);}else {echo '0';}?>">
						</fieldset>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<button type="submit" id="" class="btn btn-success">Add Drink</button>
					</div>
				</div>

	</form>	

<?php
}

include_once ROOT_PATH.'/includes/overall/footer.php';?>