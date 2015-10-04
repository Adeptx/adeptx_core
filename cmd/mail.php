<?
	# Добавить прикрепляемость файлов и возможность выбора "от кого" отправлено сообщение и какие контактные данные для ответа открыть получателю
	$_POST['mail'] = explode('&', $_POST['mail']);	# Caution! If sign "&" send in filds, error!
	
	$to			= $admin['email'];
	$from_name	= explode('=', $_POST['mail'][0]); $from_name	= $from_name[1];
	$from_email	= explode('=', $_POST['mail'][1]); $from_email	= $from_email[1];
	$subject	= explode('=', $_POST['mail'][2]); $subject		= $subject[1];
	$msg		= explode('=', $_POST['mail'][3]); $msg			= $msg[1];
	$format		= explode('=', $_POST['mail'][4]); $format		= $format[1];
	$reaplyto	= $admin['email'];
	 
	$boundary = md5(uniqid(time()));
	
	$headers = "From: $from_name <$from_email>\r\n";
	$headers.= "Reply-To: $reaplyto\r\n";
	$headers.= "MIME-Version: 1.0\n";
	$headers.= "Content-Type: multipart/mixed; boundary=\"$boundary\"\n";
	$headers.= "X-Sender: " . $_SERVER['REMOTE_ADDR'] . "\n";

	$message = "--$boundary\nContent-Type: text/$format; charset=\"utf-8\"\nContent-Transfer-Encoding: quoted-printable\n\n" . nl2br($msg) . "\n";
	foreach($files as $file)		// See: http://www.php.net/manual/ru/features.file-upload.multiple.php
		if(is_readable($file)) {
			$dir = explode('/', $file);
			$fname = $dir[count($dir) - 1];
			$str = @chunk_split(base64_encode(@fread(@fopen($file, "r"), filesize($file))));
			$message.="--$boundary\nContent-Type: application/octet-stream; name=\"$fname\"\nContent-disposition: attachment; filename=\"$fname\"\nContent-Transfer-Encoding: base64\n\n$str\n\n";
	}
	$message.="--$boundary--\n";
	
	if(isset($subject, $msg, $format, $from_email)) {
		$status = mail($to, $subject, $message, $headers);	# See: php.net/mail
		if (!$status) {
			$return .= "$err_mail_send_fail\n";
		}
		$return .= "$msg_mail_send_ok\n";	# $msg_mail_send_ok = $msg['cmd']['mail']['luck']
	}
	else die($msg['cmd']['mail']['invalid'] . '"}');

	return $return;