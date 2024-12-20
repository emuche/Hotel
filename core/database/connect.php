<?php
$conn_error ='sorry we are experiencing connection problems';
$link = mysqli_connect('localhost','root','','eziafakaego');

$root_path = '/hotel/';


if (!$link){
	die($conn_error); 
}

?>

 