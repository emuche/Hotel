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
<title> Hotel | All Rooms Number</title>

<?php  

	
include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_reception_submenu.php';	 

$sold_by =  $user_data['last_name'].' '.$user_data['first_name'];

?>


<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s All Rooms Number Page</h3>
	

	<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Category</th>
				<th>Room Number</th>
				<th>Description</th>
				<th>Unit Price</th>
				<th>Available</th>
				<th>Customer Code</th>
				<th>Added By</th>
				<th>Date</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
<?php foreach(get_bar_category('rooms_available', $category) as $store_data){ ?>

			<tr>
				<td><?php echo $store_data['category']; ?></td>
				<td><?php echo $store_data['room_number']; ?></td>
				<td><?php echo $store_data['description']; ?></td>
				<td><?php echo $store_data['unit_price']; ?></td>

				<td><?php if ($store_data['available'] == '1') {
								echo 'Yes';
							}else {
								echo 'No';
							}
					?></td>
				<td><?php echo $store_data['customer_code']; ?></td>
				<td><?php echo $store_data['added_by']; ?></td>
				<td><?php echo $store_data['date']; ?></td>
				<td>
					<form method="get" action="edit_room.php">
						<input type="hidden" name="id" value="<?php echo $store_data['id'] ;?>">
						<button type="submit" class="btn btn-info">Edit</button>
					</form>
				</td>
				<td>
					<form method="post" action="delete_room_number.php">
						<input type="hidden" value="<?php echo $store_data['id'] ;?>" name="id">
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete">
						<i class="glyphicon glyphicon-trash"></i>Delete</button>
					</form>
				</td>
			</tr>
<?php } ?>


	</table>
<?php include_once ROOT_PATH.'/includes/overall/footer.php';?>