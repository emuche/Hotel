<?php 
require_once '../../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');

?>
<title> Hotel | Room Sales</title>



<?php
	
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_reception_submenu.php';	
?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Search Room Sales by Date Page</h3>
	
<div class="col-md-4 centerDiv">
	<form action="" method="post" role="form" class="form-horizontal text-center">
	<div class="form-group">
		<input type="text" name="search_product" class="form-control date" placeholder="Type in Date here" value="<?php if(isset($_POST['search_product'])){echo $_POST['search_product'] ;} ?>">&ensp;&ensp;
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-success">Search Product</button>		
	</div>
	</form>
</div>	
<?php   

$sold_by =  $user_data['last_name'].' '.$user_data['first_name'];

if(isset($_POST['search_product'])){
	if ($_POST['search_product'] == '') {
		$date = $_POST['search_product'];
	}else {
		$date = $_POST['search_product'];	
	}
	
}else {
	$date = date('d/M/Y');
}

?>

	<table  class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Date Sold</th>
				<th>Customer Code</th>
				<th>Room Type</th>
				<th>Room Number</th>
				<th>Room Description</th>
				<th>Room Rate</th>
				<th>No of days</th>
				<th>Total</th>
				<th>Security deposit</th>
				<th>Customer Administrator</th>
				
			</tr>
<?php foreach(get_available_store($date, 'new_customer') as $store_data){ ?>

			<tr>
				<td><?php echo $store_data['time'].' '.$store_data['date']; ?></td>
				<td><?php echo $store_data['customer_code']; ?></td>
				<td><?php echo $store_data['room_type']; ?></td>
				<td><?php echo $store_data['room_number']; ?></td>
				<td><?php echo $store_data['room_description']; ?></td>
				<td class="room_rate"><?php echo $store_data['room_rate']; ?></td>
				<td><?php echo $store_data['no_of_days']; ?></td>
				<td><div class="total">
				<?php echo $store_data['total']; ?>
				</div></td>
				<td><?php echo $store_data['security_deposite']; ?></td>
				<td><?php echo $store_data['administrator']; ?></td>

			</tr>
<?php } ?>
			<tr>
				<td colspan="5"><strong>Grand Total</strong></td>
				<td colspan="2"><strong><div class="room_rate_total"></div></strong></td>
				<td colspan="3"><strong><div class="grand_total"></div></strong></td>
			</tr>

	</table>
<?php  include_once ROOT_PATH.'/includes/overall/footer.php';?>