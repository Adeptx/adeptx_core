<?php

$dir = 'uploads/';

// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif', 'zip', 'txt', 'ico', 'css', 'html', 'ttf', 'woff');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}
	if(move_uploaded_file($_FILES['upl']['tmp_name'], $dir.$_FILES['upl']['name'])){
		echo '{"status":"success"}';
		exit;
	}
}

echo '{"status":"error"}';
exit;