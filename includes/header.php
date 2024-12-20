<?php 
if(logged_in() === true){
	

?>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">

			<!-- Logo -->	
			<div class="navbar-header">
				<a href="#" class=" dropdown dropdown-toggle navbar-brand" data-toggle="dropdown">
					<span class="glyphicon glyphicon-th"></span>
				</a>
					<ul class="dropdown-menu" role="menu" style="background-color: #222;">
						<li><a class="navbar-brand" href="<?php echo $root_path; ?><?php echo $user_data['username'];?>">My Profile</a></li>
						<li><a class="navbar-brand" href="<?php echo $root_path; ?>changepassword.php">Change Password</a></li>
						<li><a class="navbar-brand" href="<?php echo $root_path; ?>logout.php">Log Out</a></li>
					</ul>
				<a href="<?php echo $root_path; ?>index.php" class="navbar-brand">HOTEL</a>	
				
				
				<button class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<div class="navbar-right">
				<a  class="navbar-brand navbar-right" href="<?php echo $root_path; ?><?php echo $user_data['username'];?>">Welcome <?php echo $user_data['username'];?> </a>
				
			</div>
			</div>

			
				<div class="collapse navbar-collapse navbar-right" id="mainNavBar">
					<ul class="nav navbar-nav">

<?php
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_menu.php';
?>


					</ul>
				</div>
				
		</div>	
	
	</nav>

<?php

}elseif (logged_in() === false) {
?>

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">

			<!-- Logo -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="<?php echo $root_path; ?>index.php" class="navbar-brand">HOTEL</a>	
			</div>

				<!-- Menu Items -->
				<div class="collapse navbar-collapse" id="mainNavBar">
					<ul class="nav navbar-nav navbar-right" >
						<li class=""><a href="#" data-toggle="modal" data-target="#loginpopup">Log In</a></li>
						
					

				</div>
				
		


		</div>
		
	</nav>
<?php include_once ROOT_PATH.'/includes/widgets/login.php'; 




}
?>
