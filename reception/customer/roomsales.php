<?php 
require_once '../../init.php';
include ROOT_PATH.'/includes/overall/header.php';

exclude_page('reception');
?>
<title> Hotel | Room Sales</title>


<?php
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_customer_submenu.php';	

?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Room Sales Page</h3>	



<br><br>
<div>
	<form action="" method="post" class="form-horizontal text-center" role="form">
		<div class="col-md-4">
			<input type="text" name="customer_code" class="form-control" placeholder="Customer Identity" value="<?php if(isset($_POST['customer_code'])){echo $_POST['customer_code'];}?>" >
		</div>
		<div class="col-md-1">
				<button type="submit" class="btn btn-success">Search</button>
		</div>
	</form>
</div>
<br><br><br>

	
	
<?php

if(isset($_POST['customer_code']) && !empty($_POST['customer_code'])){	


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
			<td><?php echo $customer_data['customer_name'];?></td>
			<td><?php echo $customer_data['customer_code'];?></td>
			<td><?php echo $customer_data['phone_number'] ;?></td>
			<td><?php echo $customer_data['occupation'] ;?></td>
			<td><?php echo $customer_data['address'] ;?></td>
			<td>
				<button class="btn btn-success" onclick="window.location.href='update_customer.php?customer_code=<?php echo $customer_data['customer_code'] ;?>'">Edit Customer</button>
			</td>
		</tr>
	</table>

</div>



<?php }include ROOT_PATH.'/includes/overall/footer.php';?>