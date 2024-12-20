<?php 
require_once '../../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');




if (isset($_GET['category'])) {
	$category = $_GET['category'];
	
}else {
	$category = null;
}

?>
<title> Hotel | All Drinks</title>

<?php  

	
include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_bar_submenu.php';	 

$sold_by =  $user_data['last_name'].' '.$user_data['first_name'];

?>


<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s All Drinks Page</h3>
	

	<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Category</th>
				<th>Drink Name</th>
				<th>Description</th>
				<th>Unit Price</th>
				<th>Quantity</th>
				<th>Total</th>
				<th>Added By</th>
				<th>Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
<?php foreach(get_bar_category('bar_products', $category) as $store_data){ ?>

			<tr>
				<td><?php echo $store_data['category']; ?></td>
				<td><?php echo $store_data['drink_name']; ?></td>
				<td><?php echo $store_data['description']; ?></td>
				<td><?php echo $store_data['unit_price']; ?></td>
				<td><?php echo $store_data['quantity']; ?></td>
				<td><?php echo $store_data['total']; ?></td>
				<td><?php echo $store_data['added_by']; ?></td>
				<td><?php echo $store_data['date']; ?></td>
				<td>
					<form method="get" action="edit_drink.php">
						<input type="hidden" name="id" value="<?php echo $store_data['id'] ;?>">
						<button type="submit" class="btn btn-success">Edit</button>
					</form>
				</td>
				<td>
					<form method="post" action="delete_drink.php">
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