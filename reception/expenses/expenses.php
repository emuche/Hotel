<?php

require_once '../../init.php';
include ROOT_PATH.'/includes/overall/header.php';

exclude_page('reception');
//error_reporting(0);


?>
<title> Hotel | Add New Expenses </title>




<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Expenses Page</h3>	

<strong>
<pre class="col-xs-2 text-center">
	<?php echo ''.date("d/M/Y");?>	
</pre>
</strong>

<table class="table table-striped table-hover table-bordered table-responsive">
		<tr>
			<th>Customer Name</th>
			<th>Description</th>
			<th>Amount</th>
			<th>Approved By</th>
		</tr>
<?php foreach(get_expenses() as $customer_data){ ?>
			<tr>
				<td><?php echo $customer_data['customer_name']; ?></td>
				<td><?php echo $customer_data['description']; ?></td>
				<td><?php echo $customer_data['amount']; ?></td>
				<td><?php echo $customer_data['approval']; ?></td>
			</tr>
		
<?php } ?>

</table>	
		

		
		
		
		
		
<?php include ROOT_PATH.'/includes/overall/footer.php';?>