<?
	# PDO
	# syntax: $db = new db($database);

	class db {
		var $link;
		var $error;

		# ранее __construct еще ранее db() # здесь было conneсt()
		function __construct(/*$database = null*/) {
			# ранее подключение не происходило при каждом запросе
			# а только при создании класса $db

			# теперь же я подключение создается только при первом обращении к БД через метод $this->call(), все остальные методы либо не обращаютяс к БД либо обращаются к ней через него
			# это позволяет избежать лишних подключений к БД при каждом запросе страницы, если БД не используется
			# для этого подключение пытается создать толкьо при вызове $this->call(), который предварительно проверяет не было ли создано подключение ранее
			# в дальшейшем при обращении к БД ипользуется уже созданное подключение

			global $database;
			// if (empty($database)) {
				// $database = $GLOBALS['database'];
			// }
			if (empty($this->link)) {
				try {
					$this->link = new mysqli(
						 $database['host']
						,$database['user']
						,$database['pass']
						#,$database['name']
					);
				}
				catch(mysqli_sql_exception $e) {
					// $lang->give('mysqlerr');
					global $error;
					$error->report('Ошибка при подключении к Базе данных: ' . mysqli_connect_error() . ' :: ' . $e->getCode(), __LINE__, 'Fatal Error', $e->getCode());
				}
			}
			$query = "CREATE DATABASE IF NOT EXISTS `${database['name']}` CHARACTER SET utf8 COLLATE utf8_general_ci";
			$this->link->query($query);
			$this->link->select_db($database['name']);
			# неплохо бы сперва узнать есть база или нет, нету создавать её,записать лог, а уже потом выбирать её.
			$this->link->set_charset("utf8");

			// $dns = $database['driver'];
			// $dns .= ':host=' . $database['host'];
			// $dns .= (($database['port']) ? (';port=' . $database['port']) : '');
			// $dns .= ';dbname=' . $database['name'];
			// # SQLite  имеет другой синтаксис.... $DBH = new PDO("sqlite:my/database/path/database.db");

			// try {
			// 	$line = __LINE__ + 1;
			// 	$DBH = new PDO($dns, $database['user'], $database['pass']);
			// 	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			// }
			// catch(PDOException $e) {
			// 	global $error;
			// 	$error->report($e->getMessage(), $line, 'Fatal Error', __FILE__);
			// }

			#$query = "CREATE DATABASE IF NOT EXISTS `${mysql['db']}` CHARACTER SET utf8 COLLATE utf8_general_ci;";

	// $mysqli = mysqli_init()
	// 	or die($msg['error']['mysqli']['init']);
 // 	$mysqli->real_connect($database['host'], $database['user'], $database['pass'])
	// 	or die($msg['error']['mysqli']['real_connect']);
	// $mysqli->select_db($database['name'])
	// 	or die($msg['error']['mysqli']['select_db']);

		}
		
		function escape( $q ) {
			return $this->link->real_escape_string($q);
		}
		function query( $q ){
			return $this->call( $q );
		}
		function call( $q ){
			# создаем первое  и единственное подключение, если оно не было создано
			// $this->connect();

			# $q = $this->link->real_escape_string($q);
			# блин, неплохо бы всё таки экранировать поданный код ...
			$result = $this->link->query($q);
			if ($result === false) echo "Error :: db->call() :: " . mysqli_error($this->link);
			return $result;
		}
		function delete($query_array) {
			/*
				$query = [
					'from' => $table,
					'where' => [
						'id' => 1,
						'email' => 'e.grinec@gmail.com',
						'nickname' => 'x-positive'
						...
					]
				]
			*/
			$query_array['from'] = $this->link->real_escape_string($query_array['from']);
			$query = 'DELETE FROM `' . $database['prefix'] . $query_array['from'] . '` WHERE ';
			foreach ($query_array['where'] as $where_what => $where_is) {
				$where_what = $this->link->real_escape_string($where_what);
				$where_is = $this->link->real_escape_string($where_is);
				$query .= $where_what . '="' . $where_is . '"';
				# здесь нужны разделители - OR AND etc
			}
			$res = $this->call($query);
			if (!$res) return false;
			return true;
		}
		# just alias for delete()
		function remove($table, $where_what, $where_is) {
			$this->delete($table, $where_what, $where_is);
		}
		function insert($table, $where_what, $where_is) {
			$query = sprintf('INSERT INTO `%s` (nickname, email, hash, salt) VALUES ("%s","%s","%s","%s")',
				 $database['prefix'] . $table
				,$nickname
				,$email
				,$hash
				,$salt
			);
			# $q = $this->link->real_escape_string($q);
			$res = $this->call("INSERT INTO `$table` SET $fild=$value WHERE $where_what=$where_is");
			$result = $this->link->query($q);
			if ($result === false) echo "Error :: db->call() :: " . mysqli_error($this->link);
			return $result;
		}
		function update($table, $fild, $value, $where_what, $where_is) {
			if (!is_numeric($value)) {
				$value = "'". $this->real_escape_string($value)."'";
			}
			$res = $this->call("UPDATE `$table` SET $fild=$value WHERE $where_what=$where_is");
			if (!$res) return false;
			return true;

			// foreach ($_POST["do"] as $key=>$do) {
			// 	if (is_string($do)) {
			// 		$s[$key] = '"%s"';
			// 		$_POST["do"][$key] = $this->real_escape_string($do);
			// 	}
			// 	else $s[$key] = '%s';
			// }
			// $format = "UPDATE `products_details` SET %s=$s[set] WHERE product_id=%u";
			// $request = sprintf($format,
			// 	$_POST["do"]["change"],
			// 	$_POST["do"]["set"],
			// 	$_POST["do"]["id"]);

			// $mysqli_res = $db->call($request);
			// if ($mysqli_res) {
			// 	$result = JSON_encode($_POST["do"]);
			// 	exit($result);
			// }
			// else {
			// 	exit('bad request');
			// }
		}
		function fetch_row( $arr ){
			$tmp = array();
			while( $row = mysqli_fetch_row( $arr ) ){
				$tmp[] = $row;
			}
			return $tmp;
		}
		function fetch_array( $arr ){
			$tmp = array();
			while( $row = mysqli_fetch_array( $arr ) ){
				$tmp[] = $row;
			}
			return $tmp;
		}
		function fetch_assoc( $arr ){
			$tmp = array();
			while( $row = mysqli_fetch_assoc( $arr ) ){
				$tmp[] = $row;
			}
			return $tmp;
		}
		function table_exist( $table ){
			global $database;
			
			$table_list = $this->call( "SHOW TABLES FROM `" . $database['name'] . "`" );
			while( $arr = mysqli_fetch_array( $table_list ) ){
				if ($table == $arr[0]) {
					return true;
				}
			}
			return false;
		}
		function tables_that_not_exist( $candidates ){
			global $database;

			// принимает массив таблиц-кандидатов
			// возвращает обратно массив тех таблиц, которые не существуют
			$tmp = $this->call( "SHOW TABLES FROM `" . $database['name'] . "`" );
			if ( $tmp ) {
				$tables = $this->fetch_array($tmp);
				foreach ( $tables as $i=>$table_arr ){
					$tables[$i] = $table_arr[0];
				}
				$result = array();
				foreach ( $candidates as $candidate ){
					if ( !in_array( $candidate, $tables ) ) {
						$result[] = $candidate;
					}
				}
				return $result;
			}
			else exit( 'mysql error' );
		}
		function create_table( $name, $vars ){
			$varsString = "";
			$i = 0;
			foreach ($vars as $var) {
				if ($i > 0) {
					$varsString .= ", ";
					if ($var[1] == "VARCHAR")
						$varsString .= $var[0]." ".$var[1]."(".$var[2].") CHARACTER SET utf8 COLLATE utf8_general_ci";
					else if ($var[1] == "SET") {
						$varsString .= $var[0]." ".$var[1]."(".$var[2].") NOT NULL";
					}
					else if ( isset($var[3]) ) {
						$varsString .= $var[0]." ".$var[1]."(".$var[2].") ".$var[3];
					}
					else
						$varsString .= $var[0]." ".$var[1]."(".$var[2].")";
				}
				else {
					$varsString .= $var[0]." ".$var[1]."(".$var[2].") NOT NULL AUTO_INCREMENT";
				}
				$i++;
			}
			$varsString .= ", PRIMARY KEY (`".$vars[0][0]."`)";
			$this->call("CREATE TABLE `".$name."` (".$varsString.")");
		}
		function last_insert_id(){
			return mysqli_insert_id($this->link);
		}
		# just alias for last_insert_id()
		function last_primary_key(){
			return $this->last_insert_id($this->link);
		}
	}