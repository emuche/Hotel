<?php
include_once '../../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');



if(isset($_POST['id'])){

	$id = $_POST['id'];
	
	$deleted_cat_name = cat_by_id('store_categories' ,$id);

	delete_cat('store_categories',$id);	

	header('location: delete_store_category.php?category_name='.$deleted_cat_name);


}

?>


<title>Hotel | All Store Category</title>

<?php
	
	include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_store_submenu.php';	
?>

<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s All store Category Page</h3>


<?php


	

	if(isset($_GET['category_name'])){
		//$deleted_cat_name = $_SESSION['deleted_cat_name'];
		$deleted_cat_name = $_GET['category_name'];
		alert_success('"'.$deleted_cat_name.'" category has been deleted from the category list ');
		
		}


?>
<table  class="table table-striped table-hover table-bordered table-responsive">
	<tr>
		<th>Product Category</th>
		<th>View Category</th>
		<th>Delete</th>
	</tr>

<?php foreach(get_categories('store_categories') as $store_data){ ?>

			<tr>
				<td><?php echo $store_data['category']; ?></td>
				<td>
					<form action="all_products.php" method="get">
						<input type="hidden" name="category" value="<?php echo $store_data['category']; ?>">
						<button type="submit" class="btn btn-success">View Category</button>
					</form>
				</td>
				<td>
					<form method="post" action="">
						<input type="hidden" name="id" value="<?php echo $store_data['id']; ?>">
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete">
						<i class="glyphicon glyphicon-trash"></i>Delete</button>
					</form>
				</td>
			</tr>
<?php } ?>
</table>




<?php
include_once ROOT_PATH.'/includes/overall/footer.php';
 ?>
	
