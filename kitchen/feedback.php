<?php
require_once '../init.php';


if (isset($_POST['category'])) {
	$category_name = $_POST['category'];
?>
<option value=""  disabled selected >Available Food</option>

<?php
	foreach (get_categories('kitchen_products', $category_name, 'category') as $category){
?>
	<option value = "<?php echo $category['food_name'];?>"><?php echo $category['food_name'];?></option>


<?php
	}
exit();	
}





if (isset($_POST['drink_name']) ) {
	$drink_name = $_POST['drink_name'];

	foreach (get_categories('kitchen_products', $drink_name, 'food_name') as $category){
		echo $category['description'];
	}

exit();
}



if (isset($_GET['drink_name'])) {
	$drink_name = $_GET['drink_name'];

	foreach (get_categories('kitchen_products', $drink_name, 'food_name') as $category){
		echo $category['unit_price'];
	}

exit();
}





?>