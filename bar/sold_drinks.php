<?php 
require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('bar');

?>
<title> Hotel | Sold Drinks</title>

<h3 class="text-center text-info"><?= strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Sold Drinks Page</h3>
	
<?php   

$sold_by =  $user_data['last_name'].' '.$user_data['first_name'];

?>

	<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Date Sold</th>
				<th>Sold By</th>
				<th>Product Name</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>customer name</th>
				<th>customer Code</th>
			</tr>
<?php foreach(get_available_store(date("d/M/Y"), 'bar_sales', $sold_by) as $store_data){ ?>

			<tr>
				<td><?= $store_data['date']; ?></td>
				<td><?= $store_data['sold_by']; ?></td>
				<td><?= $store_data['bar_product']; ?></td>
				<td><?= $store_data['description']; ?></td>
				<td><?= $store_data['quantity']; ?></td>
				<td><?= $store_data['customer_name']; ?></td>
				<td><?= $store_data['customer_code']; ?></td>
			</tr>
<?php } ?>

	</table>
<?php include_once ROOT_PATH.'/includes/overall/footer.php';?>