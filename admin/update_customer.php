<?php
require_once '../init.php';
include ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');
if(!isset($_GET['customer_code']) || customer_exists($_GET['customer_code']) === false){
	header('Location: '.$root_path.'index.php');
}	
?>
<title> Hotel | Customer View</title>
<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Customer View Page</h3>	
	<table  class="table table-striped table-hover table-bordered table-responsive">
		<tr>
			<th>Customer Name</th>
			<th>Customer Code</th>
			<th>Phone Number</th>
			<th>Occuption</th>
			<th>Address</th>
		</tr>
		<tr>
			<td><?= $customer_data['customer_name'] ?></td>
			<td><?= $customer_data['customer_code'] ?></td>
			<td><?= $customer_data['phone_number'] ?></td>
			<td><?= $customer_data['occupation'] ?></td>
			<td><?= $customer_data['address'] ?></td>
		</tr>
		<tr>
			<th>Room Type</th>
			<th>Room Number</th>
			<th>Room Rate</th>
			<th>Room Description</th>
			<th>No of Days</th>
		</tr>
		<tr>
			<td><?= $customer_data['room_type'] ?></td>
			<td><?= $customer_data['room_number'] ?></td>
			<td><?= $customer_data['room_rate'] ?></td>
			<td><?= $customer_data['room_description'] ?></td>
			<td><?= $customer_data['no_of_days'] ?></td>
		</tr>
	</table>

<?php   include ROOT_PATH.'/includes/overall/footer.php';?>