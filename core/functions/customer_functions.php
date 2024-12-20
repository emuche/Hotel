<?php 
function room_available($room_number){
	global $link;

	$room_number = mysqli_real_escape_string($link, $room_number);

	$query = "SELECT `available` FROM `rooms_available` WHERE `room_number` = '$room_number'";
	$query = mysqli_query($link, $query);


	return mysqli_result($query,0,'available');


}

function update_cell($table, $cell, $cell_value, $condition, $condition_value){
	global $link;

	$table 				= mysqli_real_escape_string($link, $table);
	$cell 				= mysqli_real_escape_string($link, $cell);
	$cell_value 		= mysqli_real_escape_string($link, $cell_value);
	$condition 			= mysqli_real_escape_string($link, $condition);
	$condition_value 	= mysqli_real_escape_string($link, $condition_value);

	$query = "UPDATE `$table` SET `$cell`= '$cell_value' WHERE `$condition` = '$condition_value' ";

	$query = mysqli_query($link, $query);


}

function category_exists($field, $value, $section_categories_table, $condition = null, $condition_value = null){

	global $link;
	
	$field = mysqli_real_escape_string($link, $field);
	$value = mysqli_real_escape_string($link, $value);
	$section_categories_table = mysqli_real_escape_string($link, $section_categories_table);
	
	$query = "SELECT COUNT(1) FROM `$section_categories_table` WHERE `{$field}` ='{$value}' ";

	if (isset($condition) && !empty($condition) && isset($condition_value) && !empty($condition_value)) {
		$condition_value = mysqli_real_escape_string($link, $condition_value);
		$condition = mysqli_real_escape_string($link, $condition);

		$query .= " AND `$condition` = '$condition_value'";
	}
	
	$query = mysqli_query($link, $query) or die(mysqli_error($link));
	return (mysqli_result($query,0)=="0") ? false: true;
	
}

function add_category($category, $section_categories_table){
	global $link;
	
	$category = mysqli_real_escape_string($link, $category);
	$section_categories_table = mysqli_real_escape_string($link, $section_categories_table);
	
	mysqli_query($link, " INSERT INTO `$section_categories_table` SET `category` ='{$category}' ");
	
}


function cat_by_id($table, $id){
	global $link; 

	$table = mysqli_real_escape_string($link, $table); 
	$id = (int)($id);
	$query3 = mysqli_query($link, "SELECT `category` FROM `$table` WHERE `id` = '$id'") ;	
	return mysqli_result($query3,0,'category');
}


function delete_cat($table, $id){
	global $link;
	
	$table = mysqli_real_escape_string($link, $table); 
	$id = (int) $id;
	
	mysqli_query($link, "DELETE FROM `{$table}` WHERE `id` = {$id}") or die(mysqli_error($link));
	
//	mysqli_query($link, "UPDATE `post` SET `cat_id` = '1' WHERE `cat_id` = {$id}") or die(mysqli_error($link));
	
}


function get_categories($table, $category_name = null, $category = null, $condition_value = null, $condition = null, $assignment = '='){
	global $link;
	
	$table = mysqli_real_escape_string($link, $table); 


	$categories = array();
	$query =  "SELECT * FROM `$table` ";
	if (isset($category_name) && isset($category)) {

		$category_name = mysqli_real_escape_string($link, $category_name); 
		$category = mysqli_real_escape_string($link, $category); 

		$query .= " WHERE `$category` $assignment '$category_name' ";

		if (isset($condition) && isset($condition_value)) {

			$condition = mysqli_real_escape_string($link, $condition); 
			$condition_value = mysqli_real_escape_string($link, $condition_value); 

			$query .= " AND `$condition` $assignment '$condition_value' ";
		}
	}

	$query = mysqli_query($link, $query) or die(mysqli_error($link));
	
	while($row = mysqli_fetch_assoc($query)){
		$categories[] = $row;
	}
	
	return $categories;
}



function update_customer($update_data, $customer_code = null, $table, $id = null){
	global $link;
	
	array_walk($update_data, 'array_sanitize');
	
	foreach($update_data as $field=>$data){
		$update[] = '`'.$field.'`=\''.$data.'\'';
	}
	
	$query = "UPDATE `$table` SET ".implode (', ', $update) ;
	
	if(!isset($customer_code)){

		if(isset($id) && !empty($id)){
		$id = (int)$id;
		$query .= " WHERE `id` = $id";
		
		}elseif(!isset($id)){

		$customer_id = $update_data['customer_id'];
		$customer_id = (int)$customer_id;
		
		$query .= " WHERE `customer_id` = $customer_id";
		}
	}
	if(isset($customer_code)){
		
		$query .= " WHERE `customer_code` = $customer_code";
	}
	
	mysqli_query($link, $query) or die(mysqli_error($link));
	
	
}


function add_customer($register_data, $table ='new_customer'){
	global $link;
	
	array_walk($register_data, 'array_sanitize');
	
	$fields = '`'.implode('`,`',array_keys($register_data)).'`';
	$data = '\''.implode('\',\'',$register_data).'\'';
	mysqli_query($link, "INSERT INTO `$table` ($fields) VALUE ($data)") or die(mysqli_error($link));

	if ( $table == 'new_customer') {
		mysqli_query($link, "UPDATE `$table` SET `customer_code` = `customer_id` + 2000 ORDER BY `customer_id` DESC LIMIT 1 ") or die(mysqli_error($link));
	}


	
}

function ncuser_count(){
	global $link;
	$query = mysqli_query($link, "SELECT COUNT(`user_id`) FROM `new_customer` WHERE `active` = 1");
	return mysqli_result($query,0);
}

function ncuser_exists($username){
	global $link; 
	$username = sanitize($username);
	$query1 = mysqli_query($link, "SELECT COUNT(`user_id`) FROM `new_customer` WHERE `username` = '$username'") ;	
	return (mysqli_result($query1,0) == 1) ? true : false;
}


function customer_exists($customer_code){
	global $link;
	$customer_code = (int)($customer_code);

	$query1 = mysqli_query($link, "SELECT COUNT(`customer_id`) FROM `new_customer` WHERE `customer_code` = '$customer_code'") ;	
	return (mysqli_result($query1,0) == 1) ? true : false;
}


function ncemail_exists($email){
	global $link; 
	$email = sanitize($email);
	$query8 = mysqli_query($link, "SELECT COUNT(`user_id`) FROM `new_customer` WHERE `email` = '$email'") ;	
	return (mysqli_result($query8,0) == 1) ? true : false;
}

function ncuser_id_from_email($email){
	global $link; 
	$email = sanitize($email);
	$query5 = mysqli_query($link, "SELECT `user_id` FROM `new_customer` WHERE `email` = '$email'") ;	
	return mysqli_result($query5,0,'user_id');
}

function ncuser_id_from_username($username){
	global $link; 
	$username = sanitize($username);
	$query3 = mysqli_query($link, "SELECT `user_id` FROM `new_customer` WHERE `username` = '$username'") ;	
	return mysqli_result($query3,0,'user_id');
}


function nclogin($username, $password){
	global $link; 
	$user_id = user_id_from_username($username);
	
	$username = sanitize($username);
	$password = md5($password);
	
	$query4 = mysqli_query($link, "SELECT COUNT(`user_id`) FROM `new_customer` WHERE `username` = '$username' AND `password` = '$password'");	
	return (mysqli_result($query4, 0) == 1) ? $user_id : false;
}

function customer_data($customer_code){
	global $link;
	$data = array();
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	if($func_num_args > 1){
		unset($func_get_args[0]);
		$fields = '`' .implode('`,`', $func_get_args) .'`';

		$query= "SELECT $fields FROM `new_customer` WHERE `customer_code` = $customer_code"; 		

		$data = mysqli_fetch_assoc(mysqli_query($link, $query));
		 
		return $data;
	}
	
}
function customer_data_by_id($customer_id){
	global $link;
	$data = array();
	
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	
	if($func_num_args > 1){
		unset($func_get_args[0]);
		$fields = '`' .implode('`,`', $func_get_args) .'`';

		$query= "SELECT $fields FROM `new_customer` WHERE `customer_id` = $customer_id"; 		

		$data = mysqli_fetch_assoc(mysqli_query($link, $query));
		 
		return $data;
	}
	
}

function product_quantity($table, $field, $category, $category_name){
	global $link;
	
	$query = "SELECT `$field` FROM `$table` WHERE `$category` = '$category_name'" ;
	$query5  = mysqli_query($link, $query) or die(mysqli_error($link));
	
	//$query5 = mysqli_query($link, "SELECT `user_id` FROM `users` WHERE `email` = '$email'") ;	
	return mysqli_result($query5, 0, $field); 
}

function update_product_quantity($table, $field, $field_value, $category, $category_name){
	global $link;
	
	$query = "UPDATE  `$table` SET `$field` = $field_value WHERE `$category` = '$category_name'" ;
	$query5  = mysqli_query($link, $query) or die(mysqli_error($link));

}
	
function get_customers($date = null){
	global $link;
	
	$customer_data 	= array();
	
	$query = "SELECT * FROM `new_customer` ";
	if(isset($date) && !empty($date)){
		$query .= " WHERE `date` = '$date'"; 
	}else{
		$query .="WHERE `check_out` = 0";
	}
	
	$query = mysqli_query($link, $query);
	
	while($row = mysqli_fetch_assoc($query)){
		$customer_data[] =$row;
	}
	
	return $customer_data;
	
}

function get_sales($customer_id = null){
	global $link;
	
	$sales_data 	= array();
	$date			= date("d/M/Y");
	
	$query = "SELECT * FROM `sales` ";
	
	if(isset($customer_id) && !empty($customer_id)){
	
		$query .= "WHERE `customer_id` = '$customer_id'";
	}else{
		$query .= "WHERE `date` = '$date'";
	}

				
				
	$query = mysqli_query($link, $query);
	
	while($row = mysqli_fetch_assoc($query)){
		$sales_data[] =$row;
	}
	
	return $sales_data;
	
}

function get_expenses($customer_id = null){
	global $link;
	
	$expenses_data 	= array();
	$customer_id = (int)$customer_id;
	$date			= date("d/M/Y");
	
	$query 			= "SELECT * FROM `expenses` ";
	
	if(isset($customer_id) && !empty($customer_id)){
			$query .= " WHERE `customer_id` = '$customer_id'";
		}
		else{
			$query .= " WHERE `date` = '$date'";
		}
				
	$query = mysqli_query($link, $query) or die(mysqli_error($link));
	
	while($row = mysqli_fetch_assoc($query)){
		$expenses_data[] =$row;
	}
	
	return $expenses_data;

}

function check_out($customer_id){
	global $link;
	
	$customer_id = (int)$customer_id;
	
	mysqli_query($link, "UPDATE `new_customer` SET `check_out` = 1 WHERE `customer_id` = '$customer_id'") or die(mysqli_error($link));
}

	
function get_available_store($date = null, $table, $sold_by = null, $id = null){
	global $link;
	
	$store_data 	= array();

	$query = "SELECT * FROM `$table` ";

	if(isset($date) && !empty($date)){
		$query .= " WHERE `date` = '$date'"; 

		if(isset($sold_by) && !empty($sold_by)){
			$query .=" AND `sold_by` = '$sold_by'";
		}
	}elseif(isset($id) && !empty($id)){
		$id = (int)$id;
		$query .=" WHERE `id` = $id";
	}else{
		$query .=" WHERE `quantity` >= 0";
	}
	
	$query = mysqli_query($link, $query);
	
	while($row = mysqli_fetch_assoc($query)){
		$store_data[] =$row;
	}
	
	return $store_data;
}

function get_bar_category($table, $category = null){
	global $link;
	
	$store_data 	= array();

	$query = "SELECT * FROM `$table` ";
		
		if (isset($category)) {
	 		$query .= " WHERE `category` = '$category' "; 
	 	}else {
	 		$query .= " WHERE `id` >= 1 "; 
	 	}

	$query = mysqli_query($link, $query);

	while($row = mysqli_fetch_assoc($query)){
		$store_data[] =$row;
	}
	
	return $store_data;

}
?> 