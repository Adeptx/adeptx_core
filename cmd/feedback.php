<?
	function phattach($file,$name) 
	{
		global $boundary;
		$fp	= @fopen($file, 'r');
		$str = @fread($fp, filesize($file));
		$str = @chunk_split(base64_encode($str));
		$message = "--".$boundary."\n";
		$message.= "Content-Type: application/octet-stream; name=\"".$name."\"\n";
		$message.= "Content-disposition: attachment; filename=\"".$name."\"\n"; 
		$message.= "Content-Transfer-Encoding: base64\n";
		$message.= "\n";
		$message.= "$str\n";
		$message.= "\n";
		return $message;
	}
	
	$error = "";
	$allowattach = "1";
	
	if (!empty($_POST)) {
		
		if($error) {
			$display_message = $error;
		} else {
			$boundary = md5(uniqid(time()));

			$headers = "From: " . $_POST['name'] . " <" . $_POST['email'] . ">\r\n";
			$headers.= "Reply-To: " . $_POST['email'] . "\r\n";
			$headers.= "MIME-Version: 1.0\n";
			$headers.= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\n";
			$headers.= "X-Sender: " . $_SERVER['REMOTE_ADDR'] . "\n";

			//Message
				
			$message = "--".$boundary."\n";
			
			switch($_POST['format'])
			{
				case 'html': 
					$message.="Content-Type: text/html; charset=\"utf-8\"\n";
				break;
				case 'text':
					$message.="Content-Type: text/plain; charset=\"utf-8\"\n";
				break;
			}
			$message.="Content-Transfer-Encoding: quoted-printable\n";
			$message.="\n";
			if (isset($_POST['msg'])) $message.= nl2br($_POST['msg']);
			$message.="\n";

			//Lets attach to something! =)
			
			if($allowattach > 0)
				for($i=0; $i <= $allowattach-1; $i++)
					if($_FILES['attachment']['name'][$i])
						$message.= phattach($_FILES['attachment']['tmp_name'][$i], $_FILES['attachment']['name'][$i]);
				
			// End the message
			
			$message.="--".$boundary."--\n";
			
			// Send the completed message
			mail($_POST['one'], $_POST['subj'], $message, $headers);
		}
		
	}
	
	/*************************************************************
	 * Дальше идет непосредственно составление письма - отправка *
	 *************************************************************/
	 
	$boundary = md5(uniqid(time()));
	
	$headers = "From: $from_name <$from_email>\r\n";
	$headers.= "Reply-To: $reaplyto\r\n";
	$headers.= "MIME-Version: 1.0\n";
	$headers.= "Content-Type: multipart/mixed; boundary=\"$boundary\"\n";
	$headers.= "X-Sender: " . $_SERVER['REMOTE_ADDR'] . "\n";

	$message = "--$boundary\nContent-Type: text/$format; charset=\"utf-8\"\nContent-Transfer-Encoding: quoted-printable\n\n" . nl2br($_POST['msg']) . "\n";
	if ($files) foreach($files as $file)		// See: http://www.php.net/manual/ru/features.file-upload.multiple.php
		if(is_readable($file)) {
			$dir = explode('/', $file);
			$fname = $dir[count($dir) - 1];
			$str = @chunk_split(base64_encode(@fread(@fopen($file, "r"), filesize($file))));
			$message.="--$boundary\nContent-Type: application/octet-stream; name=\"$fname\"\nContent-disposition: attachment; filename=\"$fname\"\nContent-Transfer-Encoding: base64\n\n$str\n\n";
	}
	$message.="--$boundary--\n";

	/**********************************************************************************/
	
	if(isset($_POST['subject'], $_POST['msg'],$_POST['format'], $_POST['from_email'], $_POST['reaplyto'])) {
		mail($to, $subject, $message, $headers) or die("Письмо не отправлено!");	# See: php.net/mail
		echo 'Письмо успешно отправлено!';
	}