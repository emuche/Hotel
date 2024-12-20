<?php 
require_once '../../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');







if (isset($_POST['id']) && !empty($_POST['id'])) {
	$id = $_POST['id'];
	delete_cat('kitchen_products',$id);
	header('Location: delete_kitchen_product.php?success');

}







?>
<title> Hotel | Delete Food</title>
<?php
	
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_kitchen_submenu.php';	
?>


<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Delete Food Page</h3>
	
<?php   
if(isset($_GET['success']) && empty($_GET['success'])){
	alert_success('Food Has Been Successfully Deleted');

}


?>

	<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Category</th>
				<th>Food Name</th>
				<th>Description</th>
				<th>Unit Price</th>
				<th>Quantity</th>
				<th>Total</th>
				<th>Added By</th>
				<th>Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
<?php foreach(get_available_store(null, 'kitchen_products') as $store_data){ ?>

			<tr>
				<td><?php echo $store_data['category']; ?></td>
				<td><?php echo $store_data['food_name']; ?></td>
				<td><?php echo $store_data['description']; ?></td>
				<td><?php echo $store_data['unit_price']; ?></td>
				<td><?php echo $store_data['quantity']; ?></td>
				<td><?php echo $store_data['total']; ?></td>
				<td><?php echo $store_data['added_by']; ?></td>
				<td><?php echo $store_data['date']; ?></td>
				<td>
					<form method="get" action="edit_kitchen_product.php">
						<input type="hidden" name="id" value="<?php echo $store_data['id'] ;?>">
						<button type="submit" class="btn btn-info">Edit</button>
					</form>
				</td>
				<td>
					<form method="post" action="">
						<input type="hidden" value="<?php echo $store_data['id'] ;?>" name="id">
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete">
						<i class="glyphicon glyphicon-trash"></i>
						Delete</button>
					</form>
				</td>
			</tr>
<?php } ?>

	</table>
<?php include_once ROOT_PATH.'/includes/overall/footer.php';?>