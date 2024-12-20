<?php 

require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';

exclude_page('kitchen');

?>
<title> Hotel | Sold Food</title>
<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Sold Food Page</h3>	




<?php   

$sold_by =  $user_data['last_name'].' '.$user_data['first_name'];

?>

	<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Date Sold</th>
				<th>Sold By</th>
				<th>Food Category</th>
				<th>Food Name</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>customer Name</th>
				<th>customer Code</th>
			</tr>
<?php foreach(get_available_store(date("d/M/Y"), 'kitchen_sales', $sold_by) as $store_data){ ?>

			<tr>
				<td><?php echo $store_data['date']; ?></td>
				<td><?php echo $store_data['sold_by']; ?></td>
				<td><?php echo $store_data['category']; ?></td>
				<td><?php echo $store_data['food_name']; ?></td>
				<td><?php echo $store_data['description']; ?></td>
				<td><?php echo $store_data['quantity']; ?></td>
				<td><?php echo $store_data['customer_name']; ?></td>
				<td><?php echo $store_data['customer_code']; ?></td>
			</tr>
<?php } ?>

	</table>
<?php include_once ROOT_PATH.'/includes/overall/footer.php';?>