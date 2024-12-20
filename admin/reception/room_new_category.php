<?php
include_once '../../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');



if(empty($_POST) === false){
	$category = trim($_POST['category']);
	
	if(empty($category)){
		$errors[] = 'You must submit a category name.';
	}elseif(strlen($category) > 50){
		$errors[] = 'Category names can only be up to 50 characters.';	
	
	}elseif(category_exists('category',$category, 'room_categories')){
		$errors[] = 'The "'.$_POST['category'].'" category already exists.';
	}
}



?>
<title>Hotel | Add Room Category</title>

<?php
	
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_reception_submenu.php';	
?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Add Room Category page</h3>


<?php
	if(empty($errors) === false){
		echo '<h4 class="alert alert-danger text-center fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove"></span></a>'.output_errors($errors).'</h4>';
	}
	if(isset($_GET['success']) && empty($_GET['success'])){
	echo '<h4 class="alert alert-success text-center fade in">
			Category Has Been Added Successfully 
			<a href="#" class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove"></span></a>
		 </h4>';
	}
	if(empty($_POST) === false && empty($errors) === true){
		add_category($category,'room_categories');
		header('Location: room_new_category.php?success');
		exit();
		
	} 





?>


<form action="" method="post" role="form"  class="form-horizontal text-center" >
	<div class="form-group">
		<div class="col-md-4 centerDiv">
			<label for="category"><h5>Category</h5></label><br>
			<input type="text" id="category" name="category" class="form-control" value="<?php if(isset($_POST['category'])){echo $_POST['category'];}?>" placeholder="Type New Room Category Here" />
		</div>
	</div>	
	<div class="form-group">
		<div class="">
		<button type="submit" class="btn btn-success">Add Room Category</button>
		</div>
		</div>
	</div>
</form>




<?php
include_once ROOT_PATH.'/includes/overall/footer.php';
 ?>
	
