
<!DOCTYPE html>
<html lang="en">
<?php include_once ROOT_PATH.'/includes/head.php'; 


$file_name = basename($_SERVER['PHP_SELF'], '.php');
if ($file_name !== 'index') {
?>

<body class="embed-responsive">

<?php
}else {
?>
<body class="embed-responsive">
<?php
}
include_once ROOT_PATH.'/includes/header.php';?>