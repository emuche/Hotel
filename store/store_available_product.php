<?php 

require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';

exclude_page('store');

?>
<title> Hotel | Available product</title>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Available product Page</h3>	

	
<?php   


?>

	<table class = "table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Date supplied</th>
				<th>Recieved By</th>
				<th>Category</th>
				<th>Store Product</th>
				<th>Description</th>
				<th>Unit Price</th>
				<th>Quantity</th>
				<th>Total</th>
				<th>Update</th>
			</tr>
<?php foreach(get_available_store(null,'store') as $store_data){ ?>

			<tr>
				<td><?php echo $store_data['date']; ?></td>
				<td><?php echo $store_data['recieved_by']; ?></td>
				<td><?php echo $store_data['category']; ?></td>
				<td><?php echo $store_data['store_product']; ?></td>
				<td><?php echo $store_data['description']; ?></td>
				<td><?php echo $store_data['unit_price']; ?></td>
				<td><?php echo $store_data['quantity']; ?></td>
				<td class="total"><?php echo $store_data['total']; ?></td>
				<td>
					<button class="btn btn-success" onclick="window.location.href='update_store.php?id=<?php echo $store_data['id'] ;?>'">Update</button>
				</td>
			</tr>
<?php } ?>
			<tr>
				<th colspan="6">Grand Total</th>
				<th colspan="3" class="grand_total"></th>
			</tr>
	</table>
<?php include ROOT_PATH.'/includes/overall/footer.php';?>