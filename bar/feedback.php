<?php
require_once '../init.php';


if (isset($_POST['category'])) {
	$category_name = $_POST['category'];
?>
<option value=""  disabled selected >Available Drinks</option>

<?php
	foreach (get_categories('bar_products', $category_name, 'category') as $category){
?>
	<option value = "<?= $category['drink_name'];?>"><?= $category['drink_name'];?></option>


<?php
	}
exit();	
}





if (isset($_POST['drink_name'])) {
	$drink_name = $_POST['drink_name'];

	foreach (get_categories('bar_products', $drink_name, 'drink_name') as $category){
		echo $category['description'];
	}

exit();
}



if (isset($_GET['drink_name'])) {
	$drink_name = $_GET['drink_name'];

	foreach (get_categories('bar_products', $drink_name, 'drink_name') as $category){
		echo $category['unit_price'];
	}

exit();
}





?>