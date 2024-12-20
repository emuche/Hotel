<?php
require_once '../init.php';
include_once ROOT_PATH.'/includes/overall/header.php';
exclude_page('admin');
?>
<title>Hotel | Admin Bar</title>
<?php include_once ROOT_PATH.'/includes/menus/'.$user_data['department'].'_bar_submenu.php'; ?>
<h3 class="text-center text-info"><?php echo strtoupper($user_data['department']) .' DEPARTMENT <br><br> '. ucwords($user_data['last_name'].' '.$user_data['first_name']); ?>'s Bar Today Sales page</h3>
<?php include_once ROOT_PATH.'/includes/overall/footer.php'; ?>
	
