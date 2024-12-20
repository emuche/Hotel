<?php
include_once '../../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');



if(empty($_POST) === false){
	$category = trim($_POST['category']);
	
	if(empty($category)){
		$errors[] = 'You must submit a category name.';
	}
	if(strlen($category) > 50){
		$errors[] = 'Category names can only be up to 50 characters.';	
	
	}
	if(category_exists('category',$category, 'bar_categories')){
		$errors[] = 'The "'.$_POST['category'].'" category already exists.';
	}
}



?>
<title>Hotel | Bar Add New Category</title>

<?php
	
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_bar_submenu.php';	
?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Bar Add New Category page</h3>


<?php
	if(empty($errors) === false){
		alert_warning(output_errors($errors));

	}
	if(isset($_GET['success']) && empty($_GET['success'])){
		alert_success('Category Has Been Added Successfully ');
	}
	if(empty($_POST) === false && empty($errors) === true){
		add_category($category,'bar_categories');
		header('Location: bar_new_category.php?success');
		exit();
		
	} 





?>


<form action="" method="post" role="form"  class="form-horizontal text-center centerDiv" >
	<div class="form-group">
		<div class="col-md-4 centerDiv">
			<label for="category"><h5>Category</h5></label><br>
			<input type="text" id="category" name="category" class="form-control" value="<?php if(isset($_POST['category'])){echo $_POST['category'];}?>" placeholder="Type New Bar Category Here" />
		</div>
		
	</div>	
	<div class="form-group">
		<div class="">
		<button type="submit" class="btn btn-success">Add Bar Category</button>
		</div>
	</div>
	</form>



<?php
include_once ROOT_PATH.'/includes/overall/footer.php';
 ?>
	
