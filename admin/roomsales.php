<?php 
require_once '../init.php';
include ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');
?>
<title> Hotel | Room View</title>
<h3 class="text-center text-info"><?= strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Room View Page</h3>	
<?php
	if (isset($_GET['error'])) {
		alert_danger('The Customer Does <strong>NOT</strong> Exist');
	}
?>
<br><br>
<div>
	<form action="" method="get" class="form-horizontal text-center" role="form">
		<div class="col-md-4">
			<input type="text" name="customer_code" class="form-control" placeholder="Customer Identity" value="<?php if(isset($_GET['customer_code'])){echo $_GET['customer_code'];}?>" >
		</div>
		<div class="col-md-1">
			<button type="submit" class="btn btn-success">Search</button>
		</div>
	</form>
</div>
<br><br><br>
<?php
if(isset($_GET['customer_code']) && !empty($_GET['customer_code'])){	
	if (customer_exists($_GET['customer_code']) === true && is_numeric($_GET['customer_code'])) {
?>
<div>	
	<table class="table table-striped table-hover table-bordered table-responsive">
		<tr>
			<th>Customer Name</th>
			<th>Customer Code</th>
			<th>Phone Number</th>
			<th>Occupation</th>
			<th>Address</th>
			<th>Edit Customer</th>
		</tr>
		<tr>
			<td><?= $customer_data['customer_name']?></td>
			<td><?= $customer_data['customer_code']?></td>
			<td><?= $customer_data['phone_number'] ?></td>
			<td><?= $customer_data['occupation'] ?></td>
			<td><?= $customer_data['address'] ?></td>
			<td>
				<button class="btn btn-success" onclick="window.location.href='update_customer.php?customer_code=<?= $customer_data['customer_code'] ?>'">View Customer</button>
			</td>
		</tr>
	</table>
</div>
<?php 
}else if((customer_exists($_GET['customer_code']) === false || !is_numeric($_GET['customer_code'] ) ) )  {
	header('Location: roomsales.php?error');
}
}
include ROOT_PATH.'/includes/overall/footer.php';?>