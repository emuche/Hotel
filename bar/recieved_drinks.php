<?php
require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('bar');

//error_reporting(0);

if(empty($_POST) === false){

	$required_fields = array('category','bar_product', 'description','quantity','recieved_from', 'dept_recieved_from');
	foreach ($_POST as $key=>$value){
		if (empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with asterisk are required';
			break 1;
		}	
	}
		if (category_exists('category', $_POST['category'], 'bar', 'drink_name', $_POST['drink_name']) === true) {
			$errors[] = 'Drink Product Already Exists';
		}
		if(!filter_var($_POST['quantity'], FILTER_VALIDATE_INT)){
			$errors[] = 'numbers is required in Quantity field';
		}
		if(strlen($_POST['quantity'])> 7){
			$errors[] = 'maximum of 7 digits are required in room rate field';
		}
}

?>
<title> Hotel | Recieve bar </title>
<h3 class="text-center text-info"><?= strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Receive To Bar Page
</h3>
<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	alert_success('New Bar Drink has been added');
	
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
		'date'					=> date("d/M/Y")
	);
	
	add_customer($update_data, 'bar');
	header('Location: recieved_drinks.php?success');
	exit();
	
}else if(empty($errors) === false){
	alert_warning(output_errors($errors));
}


?>
	<form action="" method="post" role="form"  class="form-horizontal text-center" >
	
		<div class="form-group">
			<div class="col-md-4">
				<label for="category" ><h5>Drink Category</h5></label>
					<select name= "category" id="category" class="form-control drink_sales_category" required>
						<option value="" disabled selected >Drink Category</option>
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
						<label for="drink_name" ><h5>Available drinks</h5></label>
						<select name= "drink_name" id="drink_name" class="form-control drink_sales_bar_product" required readonly>


							<?php if(isset($_POST['drink_name'])){	?>
                 				<option selected="selected" value="<?= $_POST['drink_name']; ?>"><?= $_POST['drink_name'];?></option>
							<?php } ?>
							
					</select>
					</div>
				<div class="col-md-4">
				<label for="description" class=""><h5>Description</h5></label>
				<input type="text" class="form-control drink_sales_description" name="description" id="description" placeholder="Description*" value= "<?php if(isset($_POST['description'])){echo $_POST['description'];}?>" readonly>
			</div>		
			<div class="col-md-4">
				<label for="quantity" class=""><h5>Quantity</h5></label>
				<input type="text" class="form-control" name="quantity" id="quantity" placeholder="Qty*" value= "<?php if(isset($_POST['quantity'])){echo $_POST['quantity'];}?>">
			</div>
		
			<div class="col-md-4">
				<label for="recieved_from" class=""><h5>Recieved From</h5></label>
			<input type="text" class="form-control" name="recieved_from" id="recieved_from" placeholder="Recieved From*" value= "<?php if(isset($_POST['recieved_from'])){echo $_POST['recieved_from'];}?>">
			</div>

			<div class="col-md-4">
				<label for="dept_recieved_from" class=""><h5>Department Recieved From</h5></label>
			<input type="text" class="form-control" name="dept_recieved_from" id="dept_recieved_from" placeholder="Department Recieved From*" value= "<?php if(isset($_POST['dept_recieved_from'])){echo $_POST['dept_recieved_from'];}?>">
			</div>
			

		</div>
		
		<div class="form-group">
			<div class="col-md-12">
				<label for="submit" class=""><h5></h5></label>
				<button type="submit" class="btn btn-success">Recieve Drinks </button>
			</div>
		</div>
	</form>	

<?php
}

include_once ROOT_PATH.'/includes/overall/footer.php';?>