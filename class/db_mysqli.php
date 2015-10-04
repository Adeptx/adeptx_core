<?
	class myqsli {
		var $link;
		var $error;

		// ранее __construct еще ранее db() 
		function __construct() {
			global $mysql;

			# ранее подключение не происходило при каждом запросе
			# а только при создании класса $db

			# теперь же я подключение создается только при первом обращении к БД через метод $this->call(), все остальные методы либо не обращаютяс к БД либо обращаются к ней через него
			# это позволяет избежать лишних подключений к БД при каждом запросе страницы, если БД не используется
			# для этого подключение пытается создать толкьо при вызове $this->call(), который предварительно проверяет не было ли создано подключение ранее
			# в дальшейшем при обращении к БД ипользуется уже созданное подключение
			if (empty($this->link)) {
				$this->link = new mysqli(
					 $database['host']
					,$database['user']
					,$database['pass']
					,$database['name']
				);
				if (mysqli_connect_errno()) {
					// $lang->give('mysqlerr');
					printf("Ошибка при подключении к Базе данных: %s\n", mysqli_connect_error());
					exit();
				}
			}

	// $mysqli = mysqli_init()
	// 	or die($msg['error']['mysqli']['init']);
 // 	$mysqli->real_connect($database['host'], $database['user'], $database['pass'])
	// 	or die($msg['error']['mysqli']['real_connect']);
	// $mysqli->select_db($database['name'])
	// 	or die($msg['error']['mysqli']['select_db']);

		}
		
		function query( $q ){
			return $this->call( $q );
		}
		function call( $q ){
			# создаем первое  и единственное подключение, если оно не было создано
			$this->connect();

			$result = $this->link->query($q);
			if ($result === false) echo "Error :: db->call() :: " . mysqli_error($this->link);
			return $result;
		}
		function delete($table, $where_what, $where_is) {
			$res = $this->call("DELETE FROM `$table` WHERE $where_what='$where_is'");
			if (!$res) return false;
			return true;
		}
		# just alias for delete()
		function remove($table, $where_what, $where_is) {
			$this->delete($table, $where_what, $where_is);
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
			global $mysql;
			
			$table_list = $this->call( "SHOW TABLES FROM `".$database['name']."`" );
			while( $arr = mysqli_fetch_array( $table_list ) ){
				if ($table == $arr[0]) {
					return true;
				}
			}
			return false;
		}
		function tables_that_not_exist( $candidates ){
			global $mysql;

			// принимает массив таблиц-кандидатов
			// возвращает обратно массив тех таблиц, которые не существуют
			$tmp = $this->call( "SHOW TABLES FROM `".$database['name']."`" );
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