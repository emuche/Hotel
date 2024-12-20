<?php 

require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';

exclude_page('store');

?>
<title> Hotel | Supplied product</title>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Supplied product Page</h3>	
	
<?php   

if(isset($_GET['checkout'])){
	echo '<br><br><h2>customer "'.$_GET['checkout'] .'" has been checked out</h2>';
}

$sold_by =  $user_data['last_name'].' '.$user_data['first_name'];

?>

	<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Date supplied</th>
				<th>Supplied By</th>
				<th>Category</th>
				<th>Store Product</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Requested By</th>
				<th>Request Department</th>
			</tr>
<?php foreach(get_available_store(date("d/M/Y"), 'store_requisition', $sold_by) as $store_data){ ?>
			
			<tr>
				<td><?php echo $store_data['date']; ?></td>
				<td><?php echo $store_data['sold_by']; ?></td>
				<td><?php echo $store_data['category']; ?></td>
				<td><?php echo $store_data['store_product']; ?></td>
				<td><?php echo $store_data['description']; ?></td>
				<td><?php echo $store_data['quantity']; ?></td>
				<td><?php echo $store_data['requested_by']; ?></td>
				<td><?php echo $store_data['request_dept']; ?></td>
			</tr>
<?php } ?>

	</table>
<?php include ROOT_PATH.'/includes/overall/footer.php';?>