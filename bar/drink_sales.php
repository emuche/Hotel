<?php
require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('bar');

//error_reporting(0);

if(empty($_POST) === false){

	$required_fields = array('category', 'bar_product', 'description','quantity', 'unit_price', 'requested_by');
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
		if(!is_numeric($_POST['total'])){
			$errors[] = 'numbers is required in Total field';
		}
		if(strlen($_POST['total'])> 7){
			$errors[] = 'maximum of 7 digits are required in Total field';
		}
}

?>
<title> Hotel | Bar Sales</title>
<h3 class="text-center text-info"><?= strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Bar Sales page</h3>	
<?php


if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	alert_success('Drink Sales has been completed successfully');
}else{ if(empty($_POST) === false && empty($errors) === true){
	

	$update_data = array(
		'category'	 		=> $_POST['category'],
		'bar_product' 		=> $_POST['bar_product'],
		'description' 		=> $_POST['description'],
		'quantity' 			=> $_POST['quantity'],
		'unit_price'		=> $_POST['unit_price'],
		'customer_code'		=> $_POST['customer_code'],
		'total'				=> (($_POST['unit_price']) *($_POST['quantity'])),
		'customer_name'		=> $_POST['customer_name'],
		'sold_by' 			=> $user_data['last_name'].' '.$user_data['first_name'],
		'time' 				=> date("h:i:a"),
		'date'				=> date("d/M/Y"),
	);
	
	$old_quantity 		= (int)product_quantity('bar','quantity','drink_name', $_POST['bar_product']);
	$requested_quantity = (int)$_POST['quantity'];
	$new_quantity		= $old_quantity - $requested_quantity;
	if( $new_quantity < 0){

		alert_warning('Request is more than available');
		
	}else{


		//function update_product_quantity($table, $field, $field_value, $category, $category_name){

		update_product_quantity('bar','quantity', $new_quantity, 'drink_name', $_POST['bar_product']);
		add_customer($update_data, 'bar_sales');
		header('Location: drink_sales.php?success');
		exit();
	}
	
}else if(empty($errors) === false){
	alert_warning(output_errors($errors));
}
?>

	<form action="" method="post" role="form" class="form-horizontal text-center">
				<div class="form-group"> 
					<div class="col-md-4">
						<label for="category" >Drinks Category</label>
						<select name= "category" id="category" class="form-control drink_sales_category" required>
							<option value="" disabled selected >Drinks Category</option>
							<?php if(isset($_POST['category'])){	?>
                 				<option selected="selected" value="<?= $_POST['category']; ?>"><?= $_POST['category'];?></option>
							<?php }
							foreach (get_categories('bar_categories') as $category){
								?>
								<option value = "<?= $category['category'];?>"><?= $category['category'];?></option>
								<?php
							}
							?>
					</select>
					</div>
					<div class="col-md-4">
						<label for="bar_product" >Available drinks</label>
						<select name= "bar_product" id="bar_product" class="form-control drink_sales_bar_product" required readonly>


							<?php if(isset($_POST['bar_product'])){	?>
                 				<option selected="selected" value="<?= $_POST['bar_product']; ?>"><?= $_POST['bar_product'];?></option>
							<?php } ?>
							
					</select>
					</div>
					<div class="col-md-4">
						<label for="description">Description</label>
						
						<input type="text" name="description" id="description" class="form-control drink_sales_description" placeholder="Description*" id="" value= "<?php if(isset($_POST['description'])){echo $_POST['description'];}?>" readonly>
						
					</div>
					<div class="col-md-4" >
						<label for="unit_price">Unit Price</label>
					
						<input type="number" name="unit_price" id="unit_price" class="form-control drink_sales_unit_price" placeholder="Unit Price*" id="unit_price" value= "<?php if(isset($_POST['unit_price'])){echo $_POST['unit_price'];}?>" readonly> 
				
					</div>
					<div class="col-md-4">
						<label for="quantity">Quantity</label>
						<input type="number" id="quantity" class="form-control" name="quantity" placeholder="Quantity*" id="quantity" value= "<?php if(isset($_POST['quantity'])){echo $_POST['quantity'];}?>"> 
					</div>
					<div class="col-md-4">
						<label for="customer_code">Customer Code</label>
						<input type="number" name="customer_code" id="customer_code" class="form-control" placeholder="Customer Code" value= "<?php if(isset($_POST['customer_code'])){echo $_POST['customer_code'];}?>">
					</div>
					<div class="col-md-4">
						<label for="customer_name">Customer Name</label>
						<input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Customer Name" value= "<?php if(isset($_POST['customer_name'])){echo $_POST['customer_name'];}?>">
					</div>
					<div class="col-md-4">
						<label for="total">Total: (Naira)</label>
						
							<input type="number" id="total" name="total" class="form-control text-center" placeholder="<?php if(!empty($_POST['unit_price'])  && !empty($_POST['quantity'])){echo ($_POST['unit_price'])* ($_POST['quantity']);}else {echo '0';}?>" readonly>
			
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<button type="submit" id="" class="btn btn-success"> Sell Drink</button>
					</div>
				</div>

	</form>	

<?php
}

include_once ROOT_PATH.'/includes/overall/footer.php';?>