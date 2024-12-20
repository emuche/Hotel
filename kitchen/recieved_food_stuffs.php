<?php 

require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';

exclude_page('kitchen');



//error_reporting(0);

if(empty($_POST) === false){

	$required_fields = array('category','food_name', 'description','quantity','recieved_from', 'dept_recieved_from');
	foreach ($_POST as $key=>$value){
		if (empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with asterisk are required';
			break 1;
		}	
	} 
		if (category_exists('category', $_POST['category'], 'kitchen', 'food_name', $_POST['food_name']) === true) {
			$errors[] = 'Food Product Already Exists';
		}
		if(!filter_var($_POST['quantity'], FILTER_VALIDATE_INT)){
			$errors[] = 'numbers is required in Quantity field';
		}
		if(strlen($_POST['quantity'])> 7){
			$errors[] = 'maximum of 7 digits are required in room rate field';
		}
}

?>
<title> Hotel | Recieved Food</title>



<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Recieved Food Page</h3>	



<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	alery_success('Food Stuff Drink has been added Successfully');
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
		'date'					=> date("d/M/Y")
	);
	
	add_customer($update_data, 'kitchen');
	header('Location: recieved_food_stuffs.php?success');
	exit();
	
}else if(empty($errors) === false){
	alert_warning(output_errors($errors));
}


?>
	<form action="" method="post" role="form"  class="form-horizontal text-center" >
	
		<div class="form-group">
			<div class="col-md-4">
				<label for="category" >Food Category</label>
					<select name= "category" id="category" class="form-control drink_sales_category" required>
						<option value="" disabled selected >Food Category</option>
						<?php if(isset($_POST['category'])){	?>
                 <option selected="selected" value="<?php echo $_POST['category']; ?>"><?php echo $_POST['category'];?></option>
					<?php }  
						foreach (get_categories('kitchen_products','raw' ,'food_type') as $category){
							?>
							<option value = "<?php echo $category['category'];?>"><?php echo $category['category'];?></option>
							<?php
						}
						?>
				</select>
			</div>
			<div class="col-md-4">
						<label for="food_name" >Available Food Stuff</label>
						<select name= "food_name" id="food_name" class="form-control drink_sales_bar_product" required readonly>


							<?php if(isset($_POST['food_name'])){	?>
                 				<option selected="selected" value="<?php echo $_POST['food_name']; ?>"><?php echo $_POST['food_name'];?></option>
							<?php } ?>
							
					</select>
					</div>
				<div class="col-md-4">
				<label for="description" class="">Description</label>
				<input type="text" class="form-control drink_sales_description" name="description" id="description" placeholder="Description*" value= "<?php if(isset($_POST['description'])){echo $_POST['description'];}?>" readonly>
			</div>		

						<label for="food_type" class="sr-only">Food Type</label>
					
						<input type="hidden" name="food_type" id="food_type" class="form-control food_type" placeholder="Food Type*" id="food_type" value="prepared" readonly> 
				
			<div class="col-md-4">
				<label for="quantity" class="">Quantity</label>
				<input type="text" class="form-control" name="quantity" id="quantity" placeholder="Qty*" value= "<?php if(isset($_POST['quantity'])){echo $_POST['quantity'];}?>">
			</div>
		
			<div class="col-md-4">
				<label for="recieved_from" class="">Supplier</label>
			<input type="text" class="form-control" name="recieved_from" id="recieved_from" placeholder="Recieved From*" value= "<?php if(isset($_POST['recieved_from'])){echo $_POST['recieved_from'];}?>">
			</div>

			<div class="col-md-4">
				<label for="dept_recieved_from" class="">Supplier Department</label>
			<input type="text" class="form-control" name="dept_recieved_from" id="dept_recieved_from" placeholder="Department Recieved From*" value= "<?php if(isset($_POST['dept_recieved_from'])){echo $_POST['dept_recieved_from'];}?>">
			</div>
			

		</div>
		
		<div class="form-group">
			<div class="col-md-12">
				<label for="submit" class=""><h5></h5></label>
				<button type="submit" class="btn btn-success">Recieve Food Stuff</button>
			</div>
		</div>
	</form>	


<?php } include ROOT_PATH.'/includes/overall/footer.php';?>