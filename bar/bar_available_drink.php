<?php 
require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('bar');
?>
<title> Hotel | Available Drinks</title>
<h3 class="text-center text-info"><?= strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Available Drink Page</h3>	
	<table class="table table-striped table-hover table-bordered table-responsive">
		<tr>
			<th>Date Recieved</th>
			<th>Recieved By</th>
			<th>Category</th>
			<th>Drink Name</th>
			<th>Quantity</th>
			<th>Recieved From</th>
			<th>Update</th>
		</tr>
<?php foreach(get_available_store(null,'bar') as $store_data){ ?>
			<tr>
				<td><?= $store_data['date']; ?></td>
				<td><?= $store_data['recieved_by']; ?></td>
				<td><?= $store_data['category']; ?></td>
				<td><?= $store_data['drink_name']; ?></td>
				<td><?= $store_data['quantity']; ?></td>
				<td><?= $store_data['recieved_from']; ?></td>
				<td>
					<button class="btn btn-success" onclick="window.location.href='update_bar.php?id=<?= $store_data['id'] ;?>'">Update</button>
				</td>
			</tr>
<?php } ?>

	</table>
<?php include_once ROOT_PATH.'/includes/overall/footer.php';?>