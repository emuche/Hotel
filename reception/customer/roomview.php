<?php 
require_once '../../init.php';
include ROOT_PATH.'/includes/overall/header.php';

exclude_page('reception');
?>
<title> Hotel | Customer View</title>

<?php
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_customer_submenu.php';	
?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Customer View</h3>	


<div>
	<form action="" method="post" class="form-horizontal text-center" role="form">
		<div class="col-md-4">
			<input type="text" name="input_date" class="form-control date" placeholder="Search by Date" value="<?php if(isset($_POST['input_date'])){echo $_POST['input_date'];}?>" >
		</div>
		<div class="col-md-1">
				<button type="submit" class="btn btn-success">Search</button>
		</div>
	</form>
</div>
<br><br><br>
<div>
	<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Date and Time</th>
				<th>Customer Name </th>
				<th>Customer Code </th>
				<th>Room No</th>
				<th>Amount (Naira)</th>
				<th>Security Deposite (Naira)</th>
				<th>Checked In/Out</th>
				<th>Edit Customer</th>
				<th>Check Out</th>
			</tr>
<?php if(isset($_POST['input_date'])){
	$input_date = $_POST['input_date'];
?>
			
<?php foreach(get_customers($input_date) as $customer_data){ ?>
			<tr>
				<td><?php echo $customer_data['time'].' '.$customer_data['date'] ; ?></td>
				<td><?php echo $customer_data['customer_name']; ?></td>
				<td><?php echo $customer_data['customer_code']; ?></td>
				<td><?php echo $customer_data['room_number']; ?></td>
				<td><?php echo $customer_data['total']; ?></td>
				<td><?php echo $customer_data['security_deposite']; ?></td>
				<td><?php if ($customer_data['check_out'] == '0') {
								echo '<button class="btn btn-success" >Checked In</button>';
							}else if($customer_data['check_out'] == '1'){
								echo '<button class="btn btn-danger" >Checked Out</button>';
							} 
				?></td>


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
<?php } }?>

	</table>
</div>
<?php include ROOT_PATH.'/includes/overall/footer.php';?>