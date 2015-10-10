<?	
	return select($argv, $argc);

	function select($argv, $argc) {
		global $database, $db;

		// if ($_SESSION['status'] == 'ghost') {
		// 	throw new Exception('Эта операция доступна только авторизованным пользователям', 403);
		// }
		if ($argc < 1) {
			throw new Exception('Указано слишком мало аргументов', 1007);
		}

		$obj = $argv[1];
		
		if ($obj == 'mail') {
			$query = sprintf(
				'SELECT * FROM `%suser_message` WHERE to_uid=%u AND was_read IS NOT TRUE limit 50'
				,$database['prefix']
				,$_SESSION['id']
			);
			try {
				$res = $db->call($query);
			}
			catch(Exception $e) {
				$error->report($e->getMessage(), __LINE__, 'Database Query Error', __FILE__, $e->getCode());
			}
			finally {
				if (!$res) {
					throw new Exception("Ошибка чтения из БД", 6589);	# $err_select_mysql_6
				}
			}
			$res = $db->fetch_assoc($res);

			// $to_uid = $res[0]['to_uid'];
			// $subject = $res[0]['subject'];
			// $messsage = $res[0]['message'];
			// $reaplyto = $res[0]['reaplyto'];
			// $from_uid = $res[0]['from_uid'];
			// $sender_ip = $res[0]['sender_ip'];
			// $date_sent = $res[0]['date_sent'];
			// $was_read = $res[0]['was_read'];

			if (!$res) {
				# не знаю оставить исключением или же просто вернуть.
				# throw new Exception('$msg_select_no_new_letters: Новых непрочитанных писем нет.', 6590);
				return 'Новых непрочитанных писем нет.';
			}

			$return .= "Последние непрочитанные сообщения (LIMIT 50):\n";
			foreach ($res as $data) {
				$return .= sprintf(
					"\nОтправитель: #%u %s\nТема: %s\nСообщение: %s\nДата: %s\n"
					,$data['from_uid']
					,'$from_nickname ($from_email)'	# вытянуть из БД эти данные и вывести
					,$data['subject']
					,$data['message']
					,$data['date_sent']
				);
			}
			# остаётся отправить запрос в БД в этом месте, пометить письма как was_read.
			return $return;
		}
	}