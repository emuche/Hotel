<?php 

require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';

exclude_page('kitchen');

?>
<title> Hotel | Available Foods Stuffs</title>
<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Available Food Stuff Page</h3>	
<?php   


?>

	<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Recieved By</th>
				<th>Food Category</th>
				<th>Food Name</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Supplier</th>
				<th>Supplier Department</th>
				<th>Update</th>
			</tr>
<?php foreach(get_available_store(null,'kitchen') as $store_data){ ?>

			<tr>
				<td><?php echo $store_data['recieved_by']; ?></td>
				<td><?php echo $store_data['category']; ?></td>
				<td><?php echo $store_data['food_name']; ?></td>
				<td><?php echo $store_data['description']; ?></td>
				<td><?php echo $store_data['quantity']; ?></td>
				<td><?php echo $store_data['recieved_from']; ?></td>
				<td><?php echo $store_data['dept_recieved_from']; ?></td>
				<td>
					<button class="btn btn-success" onclick="window.location.href='update_food.php?id=<?php echo $store_data['id'] ;?>'">Update</button>
				</td>
			</tr>
<?php } ?>

	</table>
<?php include ROOT_PATH.'/includes/overall/footer.php';?>