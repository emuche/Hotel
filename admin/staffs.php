<?php
include_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');
?>
<title>Hotel | Admin Staffs View</title>
<div class="container-fluid">
<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Staffs View page</h3>
<?php
if (isset($_POST['activate']) && isset($_POST['user_id'])) {
	update_cell('users', 'active', $_POST['activate'], 'user_id', $_POST['user_id']);
	alert_success('Staff Has Been Activated');
}
if (isset($_POST['deactivate']) && isset($_POST['user_id'])) {
	update_cell('users', 'active', $_POST['deactivate'], 'user_id', $_POST['user_id']);	
	alert_success('Staff Has Been Dectivated');
}
?>


	<table class="table table-striped table-hover table-bordered table-responsive">
			<tr>
				<th>Staff Name</th>
				<th>Staff username</th>
				<th>Department</th>
				<th>Phone Number</th>
				<th>Address</th>
				<th>Salary</th>
				<th>Active</th>
				<th>Activate</th>
			</tr>
<?php foreach(get_categories('users', 'admin', 'department', null, null, '!=') as $customer_data): ?>
			<tr>
				<td><?= $customer_data['first_name'].' '.$customer_data['last_name'] ; ?></td>
				<td><?= $customer_data['username']; ?></td>
				<td><?= $customer_data['department']; ?></td>
				<td><?= $customer_data['phone_number']; ?></td>
				<td><?= $customer_data['address']; ?></td>
				<td><?= $customer_data['salary']; ?></td>
				<td><?php if ($customer_data['active'] == '1'): ?>
						<button class="btn btn-success">Yes</button>
					<?php elseif ($customer_data['active'] == '0'): ?>
						<button class="btn btn-danger">No</button>
					<?php endif; ?>
				</td>
				<td class="text-center">
					<form method="post" action="">
						<input type="hidden" name="user_id" value="<?php echo $customer_data['user_id']; ?>">
						<?php if($customer_data['active'] == '1'): ?>
							<input type="hidden" name="deactivate" value="0">
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete">Deactivate</button>
						<?php elseif ($customer_data['active'] == '0') :?>
							<input type="hidden" name="activate" value="1">
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmDelete">Activate</button>
						<?php endif; ?>
					</form>
				</td>
			</tr>
<?php endforeach; ?>

	</table>
<?php include_once ROOT_PATH.'/includes/overall/footer.php'; ?>
</div>