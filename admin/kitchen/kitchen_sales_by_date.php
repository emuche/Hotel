<?php 
require_once '../../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');

?>
<title> Hotel | Kitchen Sales</title>



<?php
	
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_kitchen_submenu.php';	
?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Search Kitchen Sales by Date Page</h3>
	
<div class="centerDiv col-md-4">
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
	$date = $_POST['search_product'];
}else {
	$date = date('d/M/Y');
}

?>

	<table  class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Date Sold</th>
				<th>Sold By</th>
				<th>Food</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Total</th>
				<th>Customer Name</th>
				<th>Customer code</th>
			</tr>
<?php foreach(get_available_store($date, 'kitchen_sales') as $store_data){ ?>

			<tr>
				<td><?php echo $store_data['time'].' '.$store_data['date']; ?></td>
				<td><?php echo $store_data['sold_by']; ?></td>
				<td><?php echo $store_data['food_name']; ?></td>
				<td><?php echo $store_data['description']; ?></td>
				<td><?php echo $store_data['quantity']; ?></td>
				<td><?php echo $store_data['unit_price']; ?></td>
				<td><div class="total">
				<?php echo $store_data['total']; ?>
				</div></td>
				<td><?php echo $store_data['customer_name']; ?></td>
				<td><?php echo $store_data['customer_code']; ?></td>
			</tr>
<?php } ?>
			<tr>
				<td colspan="6"><strong>Grand Total</strong></td>
				<td colspan="3"><strong><div class="grand_total"></div></strong></td>
			</tr>

	</table>
<?php  include_once ROOT_PATH.'/includes/overall/footer.php';?>