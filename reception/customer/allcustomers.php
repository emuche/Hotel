<?php 


require_once '../../init.php';
include ROOT_PATH.'/includes/overall/header.php';


exclude_page('reception');

?>
<title> Hotel | All Customer</title>


<?php
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_customer_submenu.php';	

?>


<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Transaction View
</h3>		

<?php   

if(isset($_GET['checkout'])){

	alert_success('customer "'.$_GET['checkout'] .'" has been checked out');
	
}

?>

	<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Date and Time</th>
				<th>Customer Name </th>
				<th>Customer Code </th>
				<th>Occupation </th>
				<th>Room No</th>
				<th>Amount<br> (Naira)</th>
				<th>Security Deposit <br> (Naira)</th>
				<th>Edit Customer</th>
				<th>Check Out</th>
			</tr>
<?php foreach(get_customers() as $customer_data){ ?>
			<tr>
				<td><?php echo $customer_data['time'].' '.$customer_data['date'] ; ?></td>
				<td><?php echo $customer_data['customer_name']; ?></td>
				<td><?php echo $customer_data['customer_code']; ?></td>
				<td><?php echo $customer_data['occupation']; ?></td>
				<td><?php echo $customer_data['room_number']; ?></td>
				<td><?php echo $customer_data['total']; ?></td>
				<td><?php echo $customer_data['security_deposite']; ?></td>
				<td class="text-center">
					<form method="get" action="update_customer.php">
						<input type="hidden" name="customer_code" value="<?php echo $customer_data['customer_code'] ;?>">
						<button class="btn btn-info">Edit</button>
					</form>
				</td>
				<td class="text-center">
					<form method="get" action="check_out.php">
						<input type="hidden" name="customer_id" value="<?php echo $customer_data['customer_id'] ;?>">
						<button class="btn btn-warning">Check Out</button>
					</form>
				</td>
			</tr>
<?php } ?>

	</table>
<?php include ROOT_PATH.'/includes/overall/footer.php';?>