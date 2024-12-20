<?php

require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';

exclude_page('store');
//error_reporting(0);

if(empty($_POST) === false){

	$required_fields = array('category', 'product_name', 'description','quantity','unit_price', 'recieved_from', 'dept_recieved_from');
	foreach ($_POST as $key=>$value){
		if (empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with asterisk are required';
			break 1;
		}	
	} 	
		if (category_exists('category', $_POST['category'], 'store', 'store_product', $_POST['store_product']) === true) {
			$errors[] = 'Store Product Already Exists';
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
<title> Hotel | New Store </title>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Add New Store Item
</h3>
<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	alert_success('New store item has been added');
}else{ if(empty($_POST) === false && empty($errors) === true){
	

	$update_data = array(
		'category' 				=> $_POST['category'],
		'store_product' 		=> $_POST['store_product'],
		'description' 			=> $_POST['description'],
		'recieved_by' 			=> $user_data['last_name'].' '.$user_data['first_name'],
		'recieved_from' 		=> $_POST['recieved_from'],
		'dept_recieved_from'	=> $_POST['dept_recieved_from'],
		'quantity' 				=> $_POST['quantity'],
		'unit_price' 			=> $_POST['unit_price'],
		'total' 				=> (($_POST['quantity']) * ($_POST['unit_price'])),
		'time' 					=> date("h:i:a"),
		'date'					=> date("d/M/Y"),
	);
	
	add_customer($update_data, 'store');
	header('Location: addnewstore.php?success');
	exit();
	
}else if(empty($errors) === false){

	alert_danger(output_errors($errors));
}


?>
	<form action="" method="post" role="form"  class="form-horizontal text-center">
		<div class="form-group"> 


			<div class="col-md-4">
				<label for="category" ><h5>Category</h5></label>
					<select name= "category" id="category" class="form-control drink_sales_category" required>
						<option value="" disabled selected >Category</option>
						<?php if(isset($_POST['category'])){	?>
                 <option selected="selected" value="<?php echo $_POST['category']; ?>"><?php echo $_POST['category'];?></option>
					<?php }  
						foreach (get_categories('store_categories') as $category){
							?>
							<option value = "<?php echo $category['category'];?>"><?php echo $category['category'];?></option>
							<?php
						}
						?>
				</select>
			</div>


			<div class="col-md-4">
					<label for="store_product" ><h5>Product Name</h5></label>
					<select name= "store_product" id="store_product" class="form-control drink_sales_bar_product" required readonly>


						<?php if(isset($_POST['store_product'])){	?>
             				<option selected="selected" value="<?php echo $_POST['store_product']; ?>"><?php echo $_POST['store_product'];?></option>
						<?php } ?>
						
					</select>
			</div>

			<div class="col-md-4">
				<label for="description" class=""><h5>Description</h5></label>
				<input type="text" id="description" name="description" class="form-control drink_sales_description" placeholder="Description*" value= "<?php if(isset($_POST['description'])){echo $_POST['description'];}?>" readonly>
			</div>
			<div class="col-md-4">
				<label for="recieved_from" class=""><h5>Recieved From</h5></label>
			<input type="text" class="form-control" name="recieved_from" id="recieved_from" placeholder="Recieved From*" value= "<?php if(isset($_POST['recieved_from'])){echo $_POST['recieved_from'];}?>">
			</div>

			<div class="col-md-4">
				<label for="dept_recieved_from" class=""><h5>Department Recieved From</h5></label>
			<input type="text" class="form-control" name="dept_recieved_from" id="dept_recieved_from" placeholder="Department Recieved From*" value= "<?php if(isset($_POST['dept_recieved_from'])){echo $_POST['dept_recieved_from'];}?>">
			</div>
			<div class="col-md-4">
				<label for="unit_price" class=""><h5>Unit price</h5></label>
				<input type="number" name="unit_price" id="unit_price" class="form-control drink_sales_unit_price" id="unit_price"  placeholder="Unit Price" value= "<?php if(isset($_POST['unit_price'])){echo $_POST['unit_price'];}?>"readonly>
			</div>
			<div class="col-md-4">
				<label for="quantity" class=""><h5>Quantity</h5></label>
				<input type="number" name="quantity" id="quantity" class="form-control" id="quantity" placeholder="Quantity*" value= "<?php if(isset($_POST['quantity'])){echo $_POST['quantity'];}?>">
			</div>			
			<div class="col-md-4">
				<label for="total"><h5>Total (Naira)</h5></label>
					
						 <input type="text" name="total"  id="total" class="form-control text-center" placeholder="<?php if(!empty($_POST['quantity'])  && !empty($_POST['unit_price'])){
						 	echo ($_POST['quantity'])* ($_POST['unit_price']);
							}else {
								echo '0';
							}?>" readonly>
					
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<label for="submit" class=""><h5></h5></label>
				<button type="submit" class="btn btn-success">Add Store Item</button>
			</div>
		</div>
	</form>	
		
<?php
}

include ROOT_PATH.'/includes/overall/footer.php';?>