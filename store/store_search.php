<?php 

require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';

exclude_page('store');

?>
<title> Hotel | Search product</title>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Search product by Date Page</h3>
	
	
<div class="centerDiv col-md-4">
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
				<th>Date supplied</th>
				<th>Supplied By</th>
				<th>Category</th>
				<th>Store Product</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Requested By</th>
				<th>Request Department</th>
			</tr>
<?php foreach(get_available_store($date, 'store_requisition') as $store_data){ ?>

			<tr>
				<td><?php echo $store_data['date']; ?></td>
				<td><?php echo $store_data['sold_by']; ?></td>
				<td><?php echo $store_data['category']; ?></td>
				<td><?php echo $store_data['store_product']; ?></td>
				<td><?php echo $store_data['description']; ?></td>
				<td><?php echo $store_data['quantity']; ?></td>
				<td><?php echo $store_data['requested_by']; ?></td>
				<td><?php echo $store_data['request_dept']; ?></td>
			</tr>
<?php } ?>

	</table>
<?php } include ROOT_PATH.'/includes/overall/footer.php';?>