<?
	# Отправляет письмо  получателю.
	# Исправить: нет проверки введенных данных, нужно чтобы введённый uid точно соответствовал существующему пользователю.

	$to_uid = $arg[1];
	$subject = $arg[2];
	$messsage = $arg[3];
	// $reaplyto = $_SESSION['nickname'] . ' (' . $_SESSION['email'] . ')';
	$from_uid = $_SESSION['id'];
	$sender_ip = $_SERVER['REMOTE_ADDR'];
	$date_sent = date('Y-m-d H:i:h');
	$was_read = 0;
	$copy_to_email = 0;		# позволит отправить копию письма на почту указанного пользователя

	$query = sprintf('INSERT INTO `%suser_message` (to_uid, subject, message, from_uid, sender_ip, date_sent, was_read) VALUES(%u,"%s","%s",%u,"%s","%s",%u)'
		,$database['prefix']
		,$to_uid
		,$subject
		,$messsage
		,$from_uid
		,$sender_ip
		,$date_sent
		,$was_read
	);
	$status = $db->call($query);
	if (!$status) {
		$return .= "Сообщение не отправлено, \$err_message_mysql_5\n";
	} else {
		$return .= "Сообщение успешно отправлено получателю\n";
	}

	if ($copy_to_email) {
		# select into db email for $to_uid
		# run mail($to_email, $subject, $messsage)...
	}

	return $return;