<?php

require_once '../../init.php';
include ROOT_PATH.'/includes/overall/header.php';


exclude_page('reception');
//error_reporting(0);


?>
<title> Hotel | Add New sales </title>




<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Sales Page</h3>	

<strong>
<pre class="col-xs-2 text-center">
	<?php echo ''.date("d/M/Y");?>	
</pre>
</strong>

<table class="table table-striped table-hover table-bordered table-responsive">
		<tr>
			<th>Customer Name </th>
			<th>Phone No</th>
			<th>Item</th>
			<th>Qty</th>
			<th>Unit Price</th>
			<th>Total</th>
			<th>Deposite</th>
		</tr>
<?php foreach(get_sales() as $customer_data){ ?>
			<tr>
				<td><?php echo $customer_data['customer_name']; ?></td>
				<td><?php echo $customer_data['phone_number']; ?></td>
				<td><?php echo $customer_data['item']; ?></td>
				<td><?php echo $customer_data['quantity']; ?></td>
				<td><?php echo $customer_data['unit_price']; ?></td>
				<td><?php echo $customer_data['sales_total']; ?></td>
				<td><?php echo $customer_data['sales_deposite']; ?></td>
			</tr>
		
<?php } ?>
</table>	
		

		
		
		
		
		
<?php include ROOT_PATH.'/includes/overall/footer.php';?>