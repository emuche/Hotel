<?php 
require_once 'init.php';
include ROOT_PATH.'/includes/overall/header.php';

if(isset($_GET['username']) === true && empty($_GET['username']) === false) {
	$username = $_GET['username'];
	
	if(user_exists($username) === false){
		echo  '<h4 class="alert alert-danger text-center fade in">
			Sorry, that user does not exist
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove"></span></a></h4>';
		
	}else if(user_exists($username) === true){
		$user_id		= user_id_from_username($username,'hotel');
		$profile_data	= user_data($user_id, 'username','first_name','last_name','email','department', 'address', 'phone_number');
		
?>
<h2 class="text-center text-info"><?php echo ucwords($profile_data['first_name']); ?>'s Profile</h2>	

	<form action="" method="post" role="form" class="form-horizontal text-center">
		<div class="form-group">
			<div class="col-md-6">
				<label for="username"><h4><strong>USERNAME</strong></h4></label>
				<fieldset disabled>
					<input type="text" id="username" class="form-control text-center" placeholder="<?php echo $profile_data['username'];?>">
				</fieldset>
			</div>
			<div class="col-md-6">
				<label for="first_name"><h4><strong>FIRST NAME</strong></h4></label>
				<fieldset disabled>
					<input type="text" id="first_name" class="form-control text-center" placeholder="<?php echo $profile_data['first_name'];?>">
				</fieldset>
			</div>
			<div class="col-md-6">
				<label for="last_name"><h4><strong>LAST NAME</strong></h4></label>
				<fieldset disabled>
					<input type="text" id="last_name" class="form-control text-center" placeholder="<?php echo $profile_data['last_name'];?>">
				</fieldset>
			</div>
			<div class="col-md-6">
				<label for="email" class=""><h4><strong>E-MAIL</strong></h4></label>
				<fieldset disabled>
					<input type="text" id="email" class="form-control text-center" placeholder="<?php echo $profile_data['email'];?>">
				</fieldset>
			</div>
			<div class="col-md-6">
				<label for="phone_number" class=""><h4><strong>PHONE NUMBER</strong></h4></label>
				<fieldset disabled>
					<input type="text" id="phone_number" class="form-control text-center" placeholder="<?php echo $profile_data['phone_number'];?>">
				</fieldset>
			</div>
			<div class="col-md-6">
				<label for="address" class=""><h4><strong>ADDRESS</strong></h4></label>
				<fieldset disabled>
					<input type="text" id="address" class="form-control text-center" placeholder="<?php echo $profile_data['address'];?>">
				</fieldset>
			</div>
			<div class="col-md-6">
				<label for="department" class=""><h4><strong>DEPARTMENT</strong></h4></label>
				<fieldset disabled>
					<input type="text" id="department" class="form-control text-center" placeholder="<?php echo $profile_data['department'];?>">
				</fieldset>
			</div>
			<div class="col-md-6">
				
			</div>
		</div>
	</form>	

		
		
<?php


	}
}else{
	header('Location: index.php');
	exit();
}


include ROOT_PATH.'/includes/overall/footer.php';
?>