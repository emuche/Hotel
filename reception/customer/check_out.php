<?php 
require_once '../../init.php';
include ROOT_PATH.'/includes/overall/header.php';


exclude_page('reception');
//error_reporting(0);

if (empty($_GET['customer_id']) ===true && empty($_POST) === true) {
	header('Location: '.$root_path.'index.php');
}

if(isset($_GET['customer_id'])){
	$customer_id = $_GET['customer_id'];
	
	$customer_data = customer_data_by_id($customer_id, 'customer_code','customer_id','date', 'time', 'address','customer_name', 'phone_number', 'room_number', 'no_of_days', 'room_rate', 'total','security_deposite');
}

$customer_id 	= $customer_data['customer_id'];
$customer_name	= $customer_data['customer_name'];
$customer_code	= $customer_data['customer_code'];



if(isset($_POST['check_out'])){
	check_out($customer_id);
	update_cell('rooms_available', 'customer_code', '', 'room_number', $customer_data['room_number']);
	update_cell('rooms_available', 'available', '1', 'room_number', $_POST['room_number']);
	header("location: allcustomers.php?checkout=".$customer_name);
}

if(isset($_POST['print'])){
	
}


?>
<title>Hotel | Check Out</title>

<?php
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_customer_submenu.php';	
?>

<h2 class="text-center">Check Out</h2>
<div id="CheckOut">
<h2> &ensp; EZIAFAKAEGO</h2><h5> &ensp;&ensp;&ensp; GARDEN RESORT LTD.</h5>
<div class="col-md-4">
<table class="table table-striped table-hover table-bordered table-responsive">
	<tr>
		<td><b>Guest Name:</b></td>
		<td><?php echo $customer_data['customer_name'] ;?></td>
	</tr>
	<tr>
		<td><b>Guest Code:</b></td>
		<td><?php echo $customer_data['customer_code'] ;?></td>
	</tr>
	<tr>
		<td><b>Room Number:</b></td>
		<td><?php echo $customer_data['room_number'] ;?></td>
	</tr>
	<tr>
		<td><b>Room Rate:</b></td>
		<td><?php echo $customer_data['room_rate'] ;?></td>
	</tr>
	<tr>
		<td><b>No of Days:</b></td>
		<td><?php echo $customer_data['no_of_days'] ;?></td>
	</tr>
	<tr>
		<td><b>Address:</b></td>
		<td><?php echo $customer_data['address'] ;?></td>
	</tr>
	<tr>
		<td><b>Phone Number:</b></td>
		<td><?php echo $customer_data['phone_number'] ;?></td>
	</tr>
	<tr>
		<td><b>Date:</b></td>
		<td><?php echo $customer_data['date'] ;?></td>
	</tr>
</table>	
</div>

<div class="col-md-12">
<h3 class="text-center">Service Summary</h3>		
<table class="table table-striped table-hover table-bordered table-responsive">
	<tr>
		<th>Date</th>
		<th>Category</th>
		<th>Name</th>
		<th>Description</th>
		<th>Unit Cost</th>
		<th>Qty</th>
		<th>Total Price</th>
	</tr>
	
<?php foreach(get_categories('kitchen_sales', $customer_code, 'customer_code') as $customer_data){ ?>
			<tr>
				<td><?php echo $customer_data['time'].' '.$customer_data['date'] ; ?></td>
				<td><?php echo $customer_data['category']; ?></td>
				<td><?php echo $customer_data['food_name']; ?></td>
				<td><?php echo $customer_data['description']; ?></td>
				<td><?php echo $customer_data['unit_price']; ?></td>
				<td><?php echo $customer_data['quantity']; ?></td>
				<td class="total"><?php echo $customer_data['total']; ?></td>

				
			</tr>
<?php } 
		
		foreach (get_categories('bar_sales', $customer_code, 'customer_code') as $customer_data) { ?>
			<tr>
				<td><?php echo $customer_data['time'].' '.$customer_data['date'] ; ?></td>
				<td><?php echo $customer_data['category']; ?></td>
				<td><?php echo $customer_data['bar_product']; ?></td>
				<td><?php echo $customer_data['description']; ?></td>
				<td><?php echo $customer_data['unit_price']; ?></td>
				<td><?php echo $customer_data['quantity']; ?></td>
				<td class="total"><?php echo $customer_data['total']; ?></td>

			</tr>

<?php } ?>	

	<tr>
		<th colspan="6">Grand Total</th>
		<th colspan="1" class="grand_total"></th>
	</tr>
	
</table>	
</div>	
</div>

<br><br><br>		
<br><br><br>		

<div class="col-md-10 centerDiv">

	<table  class="table table-responsive">
		<tr>
			<th class="col-md-6">
				<form method="post" action="" role="form" class="form-horizontal text-center">
					<input type="hidden" name="check_out" value="1" id="check_out">
					<button type="button" name="check_out" class="btn btn-danger col-md-12" data-toggle="modal" data-target="#confirmDelete">
					Chech Out</button>
				</form>
			</th>
			<th class="col-md-12">
				<button type="button" class="form-control btn btn-success" id="printCheckOut"  name="print" value="" >Print</button>
			</th>
		</tr>
	</table>
</div>
		
<?php include ROOT_PATH.'/includes/overall/footer.php';?>