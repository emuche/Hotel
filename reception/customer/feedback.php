<?php
require_once '../../init.php';


if (isset($_POST['category'])) {
	$category_name = $_POST['category'];
?>
<option value="" disabled selected >Room Number</option>
<?php
	foreach (get_categories('rooms_available', $category_name, 'category') as $category){
?>
	<option value = "<?php echo $category['room_number'];?>"><?php echo $category['room_number'];?></option>


<?php
	}
exit();	
}





if (isset($_POST['room_number'])) {
	$room_number = $_POST['room_number'];

	foreach (get_categories('rooms_available', $room_number, 'room_number') as $category){
		echo $category['description'];
	}

exit();
}



if (isset($_GET['room_number'])) {
	$room_number = $_GET['room_number'];

	foreach (get_categories('rooms_available', $room_number, 'room_number') as $category){
		echo $category['unit_price'];
	}

exit();
}





?>