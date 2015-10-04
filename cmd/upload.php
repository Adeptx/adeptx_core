<?
	# как загрузить массив файлов $arg по их именам? реально ли это или нужно перекидывать на форму загрузки...
	
	foreach($_FILES['file']['name'] as $file => $t)
	{
		if($_FILES['file']['size'][$file] > $site['upload_max_filesize']*1024*1024)
			$return .=
				$lang['file size']
				. " "
				. $_FILES['file']['name'][$file]
				. " "
				. $lang['exceeds']
				. " "
				. $site['upload_max_filesize']
				. " "
				. $lang['Mb'];
		if(is_uploaded_file($_FILES['file']['tmp_name'][$file])) {
			move_uploaded_file($_FILES['file']['tmp_name'][$file], $dir.$_FILES['file']['name'][$file]);
		}
	}

	return $return;


/* 		

	if (isset($_FILES['profile_image'])) {
		$img		= $_FILES['profile_image'];
		$dir		= ROOT . DIR_SITE . PATH_SITE . USER_IMG;
		# list of permitted file extensions
		$allowed	= array('png', 'jpg', 'jpeg', 'ico', 'gif');

		if ($img['error'] == 0) {
			$extension = pathinfo($img['name'], PATHINFO_EXTENSION);

			if (!in_array(strtolower($extension), $allowed)) {
				exit('{"status":"error","error":"not allowed extension for profile photo"}');
			}

			$newname = $_SESSION['customer']['id'] . '.' . $extension;

			if (!is_dir($dir)) {
				mkdir($dir);
			}
			$to = $dir . $newname;

			if (move_uploaded_file($img['tmp_name'], $to)) {
				$db->call('UPDATE `users` SET user_image="' . $newname . '" WHERE user_id=' . $_SESSION['customer']['id']);
				exit('{"status":"success","profile_image":"' . $newname . '"}');
			}
		}
		exit('{"status":"error","error":"upload error"}');
		break;
	} */