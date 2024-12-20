<?php 
require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('bar');
?>
<title> Hotel | Search product</title>

<h3 class="text-center text-info"><?= strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Search product by Date Page</h3>
	
<div class="col-md-6 centerDiv">
	<form action="" method="post" role="form" class="form-horizontal text-center">
	<div class="form-group">
		<input type="text" name="search_product" class="form-control  date" placeholder="Type in Date here" value="<?php if(isset($_POST['search_product'])){echo $_POST['search_product'] ;} ?>">&ensp;&ensp;
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
				<th>Customer Code</th>
			</tr>
<?php foreach(get_available_store($date, 'bar_sales') as $store_data): ?>
			<tr>
				<td><?= $store_data['time'].' '.$store_data['date']; ?></td>
				<td><?= $store_data['sold_by']; ?></td>
				<td><?= $store_data['bar_product']; ?></td>
				<td><?= $store_data['description']; ?></td>
				<td><?= $store_data['quantity']; ?></td>
				<td><?= $store_data['unit_price']; ?></td>
				<td class="total"><?= $store_data['total']; ?></td>
				<td><?= $store_data['customer_name']; ?></td>
				<td><?= $store_data['customer_code']; ?></td>
			</tr>
<?php endforeach; ?>
			<tr>
				<th colspan="6">Grand Total</th>
				<th colspan="3" class="grand_total"></th>
			</tr>
	</table>
<?php } include_once ROOT_PATH.'/includes/overall/footer.php';?>