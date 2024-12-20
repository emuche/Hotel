<?php 
require_once '../../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');

?>
<title> Hotel | Bar Sales</title>



<?php
	
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_bar_submenu.php';	
?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Search Bar Sales by Date Page</h3>
	
<div class="col-md-4 centerDiv">
	<form action="" method="post" role="form" class="form-horizontal text-center">
	<div class="form-group">
		<input type="text" name="search_product" class="form-control date" placeholder="Type in Date here" value="<?php if(isset($_POST['search_product'])){echo $_POST['search_product'] ;} ?>">&ensp;&ensp;
		<br>
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
				<th>Bar Product</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Total</th>
				<th>Customer Name</th>
			</tr>
<?php foreach(get_available_store($date, 'bar_sales') as $store_data){ ?>

			<tr>
				<td><?php echo $store_data['time'].' '.$store_data['date']; ?></td>
				<td><?php echo $store_data['sold_by']; ?></td>
				<td><?php echo $store_data['bar_product']; ?></td>
				<td><?php echo $store_data['description']; ?></td>
				<td><?php echo $store_data['quantity']; ?></td>
				<td><?php echo $store_data['unit_price']; ?></td>
				<td><div class="total">
				<?php echo $store_data['total']; ?>
				</div></td>
				<td><?php echo $store_data['customer_name']; ?></td>
			</tr>
<?php } ?>
			<tr>
				<td colspan="6"><strong>Grand Total</strong></td>
				<td colspan="2"><strong><div class="grand_total"></div></strong></td>
			</tr>

	</table>
<?php  include_once ROOT_PATH.'/includes/overall/footer.php';?>