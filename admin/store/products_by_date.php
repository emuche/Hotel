<?php 
require_once '../../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');

?>
<title> Hotel | store Requisition</title>



<?php
	
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_store_submenu.php';	
?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Search Product by Date Page</h3>
	
<div class="col-md-4 centerDiv">
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
}else {
	$date = date('d/M/Y');
}

?>

	<table  class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Date Sold</th>
				<th>Supplied By</th>
				<th>Category</th>
				<th>Store Product</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Request Dept</th>
				<th>Requested By</th>
			</tr>
<?php foreach(get_available_store($date, 'store_requisition') as $store_data){ ?>

			<tr>
				<td><?php echo $store_data['time'].' '.$store_data['date']; ?></td>
				<td><?php echo $store_data['sold_by']; ?></td>
				<td><?php echo $store_data['category']; ?></td>
				<td><?php echo $store_data['store_product']; ?></td>
				<td><?php echo $store_data['description']; ?></td>
				<td><?php echo $store_data['quantity']; ?></td>
				<td><?php echo $store_data['request_dept']; ?></td>
				<td><?php echo $store_data['requested_by']; ?></td>
			</tr>
<?php } ?>

	</table>
<?php  include_once ROOT_PATH.'/includes/overall/footer.php';?>