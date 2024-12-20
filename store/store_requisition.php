<?php

require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';

exclude_page('store');
//error_reporting(0);

if(empty($_POST) === false){

	$required_fields = array('category','store_product', 'description','quantity','requested_by', 'request_dept');
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
<title> Hotel | Store Requisition </title>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Store Requisition Form</h3>

<?php


if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	alert_success('Request has been added');

}else{ if(empty($_POST) === false && empty($errors) === true){
	

	$update_data = array(
		'category' 				=> $_POST['category'],
		'store_product'		 	=> $_POST['store_product'],
		'description' 			=> $_POST['description'],
		'quantity' 				=> $_POST['quantity'],
		'requested_by' 			=> $_POST['requested_by'],
		'request_dept' 			=> $_POST['request_dept'],
		'sold_by' 				=> $user_data['last_name'].' '.$user_data['first_name'],
		'time' 					=> date("h:i:a"),
		'date'					=> date("d/M/Y"),
	);
	
	$old_quantity 		= (int)product_quantity('store','quantity','store_product', $_POST['store_product']);
	$requested_quantity = (int)$_POST['quantity'];
	$new_quantity		= $old_quantity - $requested_quantity;
	if( $new_quantity < 0){

		alert_warning('Request is more than available');

		
	}else{


		//function update_product_quantity($table, $field, $field_value, $category, $category_name){

		update_product_quantity('store','quantity', $new_quantity, 'store_product', $_POST['store_product']);
		add_customer($update_data, 'store_requisition');
		header('Location: store_requisition.php?success');
		exit();
	}
	
}else if(empty($errors) === false){
	alert_warning(output_errors($errors));
}


?>
	<form action="" method="post" role="form" class="form-horizontal text-center">	
		<div class="form-group"> 


			<div class="col-md-4">
				<label for="category" >Category</label>
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
				<label for="category">Store Product</label>
				<select name= "store_product" id="store_product" class="form-control drink_sales_bar_product" required readonly>
					<?php if(isset($_POST['store_product'])){	?>
	     				<option selected="selected" value="<?php echo $_POST['store_product']; ?>"><?php echo $_POST['store_product'];?></option>
					<?php } ?>
					
				</select>
			</div>
			<div class="col-md-4">
				<label for="description">Description</label>
				<input type="text" name="description" id="description" class="form-control drink_sales_description" placeholder="Description*" value= "<?php if(isset($_POST['description'])){echo $_POST['description'];}?>" readonly>
			</div>
		 
			<div class="col-md-4">
				<label for="quantity">Quantity</label>
				<input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity*" value= "<?php if(isset($_POST['quantity'])){echo $_POST['quantity'];}?>">
			</div>
			<div class="col-md-4">
				<label for="request_dept">Request Department</label>
				<input type="text" name="request_dept" id="request_dept" class="form-control" placeholder="Request Department*" value= "<?php if(isset($_POST['request_dept'])){echo $_POST['request_dept'];}?>">
			</div>

			<div class="col-md-4">
				<label for="requested_by">Requested By</label>
				<input type="text" name="requested_by" id="requested_by" class="form-control" placeholder="Requested By*" value= "<?php if(isset($_POST['requested_by'])){echo $_POST['requested_by'];}?>">
			</div>
			
		</div>		
		<div class="form-group">
			<div class="col-md-12">
				<button type="submit" class="btn btn-success" >Make Request</button>
			</div>

		</div>
	</form>	

<?php
}

include ROOT_PATH.'/includes/overall/footer.php';?>