<?php 

function mysqli_result($res,$row=0,$col=0){ 
	$numrows = mysqli_num_rows($res); 
	if ($numrows && $row <= ($numrows-1) && $row >=0){
		mysqli_data_seek($res,$row);
		$resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
		if (isset($resrow[$col])){
			return $resrow[$col];
		}
	}
	return false;
}

function alert_success($message){
	echo '<div class="col-md-12 " style="margin-bottom: 30px;"><h4 class="alert alert-success col-md-8 centerDiv text-center fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove"></span></a>
			'.$message.'
			 </h4></div>';
}


function alert_danger($message){
	echo '<div class="col-md-12 " style="margin-bottom: 30px;"><h4 class="alert alert-danger col-md-8 centerDiv text-center fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove"></span></a>
			'.$message.'
			 </h4></div>';
}


function alert_warning($message){
	echo '<div class="col-md-12 " style="margin-bottom: 30px;"><h4 class="alert alert-warning col-md-8 centerDiv text-center fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close"><span class="glyphicon glyphicon-remove"></span></a>
			'.$message.'
		 </h4></div>';
}

function email($to, $subject, $body){
	mail($to, $subject, $body, 'From: willhill academy' );
}

function logged_in_redirect(){
	if (logged_in() === true){
		header('Location: index.php');
		exit();
	}
}

function logged_out_redirect(){
	if (logged_in() === false){
		header('Location: index.php');
		exit();
	}
}

function exclude_page($department = null){
	if(isset($department)){
		if(logged_in($department) === false){
		header('Location: exclude.php');
		exit();
		}
	}
	else{
		if(logged_in() === false){
		header('Location: exclude.php');
		exit();
		}
	}
	
}

function array_sanitize(&$item){
	global $link;
	$item = htmlentities(strip_tags(mysqli_real_escape_string($link, $item)));
}

function sanitize($data){
	global $link;
	return htmlentities(strip_tags(mysqli_real_escape_string($link, $data)));
}


function output_errors($errors){
	return '<ul><li>' .implode('</li><li>',$errors) .'</li></ul>';
}


?>