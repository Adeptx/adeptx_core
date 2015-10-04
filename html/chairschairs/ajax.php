<?php
    /*
  $w_o и h_o - ширина и высота выходного изображения
  */
  function resize($image, $w_o = false, $h_o = false) {
    if (($w_o < 0) || ($h_o < 0)) {
      echo "Некорректные входные параметры";
      return false;
    }
    list($w_i, $h_i, $type) = getimagesize($image); // Получаем размеры и тип изображения (число)
    $types = array("", "gif", "jpeg", "png"); // Массив с типами изображений
    $ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
    if ($ext) {
      $func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения
      $img_i = $func($image); // Создаём дескриптор для работы с исходным изображением
    } else {
      echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый
      return false;
    }
    /* Если указать только 1 параметр, то второй подстроится пропорционально */
    if (!$h_o) $h_o = $w_o / ($w_i / $h_i);
    if (!$w_o) $w_o = $h_o / ($h_i / $w_i);
    $img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения
    imagecopyresampled($img_o, $img_i, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i); // Переносим изображение из исходного в выходное, масштабируя его
    $func = 'image'.$ext; // Получаем функция для сохранения результата
    return $func($img_o, $image); // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
  }
  /* Вызываем функцию с целью уменьшить изображение до ширины в 100 пикселей, а высоту уменьшив пропорционально, чтобы не искажать изображение */

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
			$_SESSION['customer']['image'] = $newname;

			if (!is_dir($dir)) {
				mkdir($dir);
			}
			$to = $dir . $newname;

			if (move_uploaded_file($img['tmp_name'], $to)) {
				$db->call('UPDATE `users` SET user_image="' . $newname . '" WHERE user_id=' . $_SESSION['customer']['id']);
  				resize($to, 140, 140);
				exit('{"status":"success","profile_image":"' . HOST . DIR_SITE . PATH_SITE . USER_IMG . $newname . '"}');
			}
		}
		exit('{"status":"error","error":"upload error"}');
		break;
	}

	if (isset($_POST['do'])) {
		if ( !isset($_POST['do']['with']) ) fail('dump');

		if ( $_POST['do']['with'] == 'cart' ) {
			switch ($_POST['do']['what']) {
				case 'remove':
					if ( isset( $_POST['do']['id'] ) ) {
						unset( $_SESSION['cart']['products'][ $_POST['do']['id'] ] );
					}
					fail('dump');
					break;
				case 'add':
					if ( isset( $_POST['do']['id'] ) ) {
						if ( !isset($_SESSION['cart']['products'][ $_POST['do']['id'] ]) ) {
							$_SESSION['cart']['products'][ $_POST['do']['id'] ] = array();
							$_SESSION['cart']['products'][ $_POST['do']['id'] ]['quantity'] = 1;
						}
						else {
							$_SESSION['cart']['products'][ $_POST['do']['id'] ]['quantity'] += 1;
						}
						ok();
					}
					else fail('dump');
					break;
				case 'load':
					$products_arr = array();
					$list = prepareIN( array_keys( $_SESSION['cart']['products'] ) );
					if ( $list ) {
						$mysqli_res = $db->call( 'SELECT * FROM `products` WHERE product_id IN (' .$list. ')' );
						if ($mysqli_res) $products_arr = $db->fetch_array($mysqli_res);
						if ( count($products_arr) > 0 ) {
							$result = array();
							$total = 0;
							foreach ($products_arr as $key => $product) {
								$tmp = array();
								$tmp['id'] = $product['product_id'];
								$tmp['name'] = $product['product_name'];
								$tmp['price'] = $product['product_price'];
								$tmp['quantity'] = $_SESSION['cart']['products'][ $product['product_id'] ]['quantity'];
								$tmp['sum'] = $tmp['quantity'] * $product['product_price'];
								$total += $tmp['quantity'] * $product['product_price'];
								if ( file_exists( $cms->src(PRODUCT_IMG.SMALL_IMG_SIZE.$product['product_image']) ) )
									$tmp['image'] = $cms->src(PRODUCT_IMG.SMALL_IMG_SIZE.$product['product_image']);
								else
									$tmp['image'] = $cms->src(PRODUCT_IMG.'no-image.png');
								$result[] = $tmp;
							}
							//$result['total'] = $products->formatPrice( $total, true );
							$result = JSON_encode( $result );
							exit( $result );
						}
						else fail();
					}
					else {
						$result = array();
						$result = JSON_encode( $result );
						exit( $result );
					}
					break;
				case 'change':
					if ( isset( $_POST['do']['id'] ) ) {
						if ( isset($_SESSION['cart']['products'][ $_POST['do']['id'] ]) ) {
							if ( isset( $_POST['do']['set'] ) && $_POST['do']['set'] > 0 ) {
								$_SESSION['cart']['products'][ $_POST['do']['id'] ]['quantity'] = $_POST['do']['set'];
							}
							else fail('dump');
						}
						ok();
					}
					else fail('dump');
					break;
				default: unknown(); break;
			}
		}
		if ( $_POST['do']['with'] == 'reviews' ) {
			switch ($_POST['do']['what']) {

				case 'add':
					if ( !isset($_POST['do']['id']) ) fail('dump');
					else {
						$request = sprintf('INSERT INTO `reviews` (product_id, review_author, review_text) VALUES ("%s","%s","%s")',
							$_POST['do']['id'],
							$_SESSION['customer']['id'],
							$_POST['do']['text']);
						$db->call($request) or fail('mysql');

						$result['review_id'] = $db->last_insert_id();
						$result['image'] = $cms->src(USER_IMG.$_SESSION['customer']['image']);
						$result['text'] = $_POST['do']['text'];

						if (!empty($_POST['do']['name'])) {
							$request = sprintf('UPDATE `users` SET user_first_name="%s" WHERE user_id="%s"',
								$_POST['do']['name'],
								$_SESSION['customer']['id']);
							$db->call($request);	# no fail, its optional function
							$_SESSION['customer']['first_name'] = $_POST['do']['name'];
						}
						$result['author'] = $_SESSION['customer']['first_name'];

						$result = JSON_encode( $result );
						exit( $result );
					}
					break;

				case 'remove':
					if ( !isset($_POST['do']['id']) ) fail('dump');
					else {
						$request = sprintf('DELETE FROM `reviews` WHERE review_id="%s"',
							$_POST['do']['review_id']);
						$db->call($request) or fail('mysql');

						$result['review_id'] = $_POST['do']['review_id'];

						$result = JSON_encode( $result );
						exit( $result );
					}
					break;

				case 'load':
					if ( !isset($_POST['do']['id']) ) fail('dump');
					else {
						$tmp = $db->call('SELECT * FROM `reviews` WHERE product_id='.$_POST['do']['id']);	// .' ORDER BY RAND() LIMIT 0,3'
						if ($tmp) {
							$reviews = $db->fetch_array($tmp);
							if ( count($reviews) > 0 ) {
								// когда достается автор, достается его user_id
								// нужно считать содержимое бд на этот id (или на их список)
								// и вывести имя автора и его пикчу ['image']
								foreach ($reviews as $review) {
									$temp = array();
									$temp['id'] = $review['review_id'];
									$tmp = $db->call('SELECT * FROM `users` WHERE user_id='.$review['review_author'].' LIMIT 1');
									if ($tmp) {
										$author = $db->fetch_array($tmp);
										if ( count($author) > 0 ) {
											$author = $author[0];
											$temp['author'] = $author['user_first_name'];
											$temp['image'] = $cms->src( USER_IMG.$author['user_image']);
										}
										else {
											$temp['author'] = '';
											$temp['image'] = $cms->src( USER_IMG.'user-no-image.jpg', true );
										}
									}
									else fail('mysql');
									$temp['text'] = $review['review_text'];
									$result[] = $temp;
								}
								$result = JSON_encode( $result );
								exit( $result );
						}	
							else fail('not-found');
						}
						else fail('mysql');
					}
					break;
				default: unknown(); break;
			}
		}

		if ( $_POST['do']['with'] == 'shop' ) {
			switch ( $_POST['do']['what'] ) {
				case "currency":
					if (empty($_SESSION['shop']['currency'])) {
						$_SESSION['shop']['currency'] = file_get_contents('https://query.yahooapis.com/v1/public/yql?q=select+*+from+yahoo.finance.xchange+where+pair+=+%22USDRUB,EURRUB%22&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=');
						$currency = $_SESSION['shop']['currency'];
						$currency = JSON_decode( $currency );
						$currency = $currency->query->results->rate['0']->Rate;
						$_SESSION['shop']['course'] = 1;
						// $_SESSION['shop']['course'] = $currency;
					}
					success( $_SESSION['shop']['course'] );
					break;
				default: unknown(); break;
			}
		}

		if ( $_POST['do']['with'] == 'minicart' ) {
			switch ( $_POST['do']['what'] ) {
				case "load":
					$quantity = 0;
					$total = 0;
					if ( isset($_SESSION["cart"]) && isset($_SESSION["cart"]["products"]) ) {
						if ( count( $_SESSION["cart"]["products"] ) > 0 ) {
							$quantity = 0;
							$i = 0;
							$arr = "";
							foreach ( $_SESSION["cart"]["products"] as $key => $product ) {
								if ( $i > 0 ) $arr .= ",";
								$arr .= $key;
								$quantity += $product["quantity"];
								$i++;
							}
							$products_arr = array();
							$tmp = $db->call( "SELECT * FROM products WHERE product_id IN (" .$arr. ")" );
							if ($tmp) $products_arr = $db->fetch_array($tmp);
							if ( count($products_arr) > 0 ) {
								$total = 0;
								foreach ($products_arr as $key => $product) {
									$q = $_SESSION["cart"]["products"][ $product["product_id"] ]["quantity"];
									$total += $q * $product["product_price"];
								}
							}
							else {
								// ошибка чтения из базы данны
							}
						}
					}
					if ( $quantity > 4 && $quantity < 21 ) {
						$word = "товаров";
					}
					else {
						if ( $quantity % 10 == 1 )
							$word = "товар";
						else if ( $quantity % 10 > 1 && $quantity % 10 < 5 )
							$word = "товара";
						else
							$word = "товаров";
					}
					$result = array();
					$result['quantity'] = $quantity;
					$result['word'] = $word;
					$result['total'] = $total;
					$result = JSON_encode( $result );
					exit( $result );
					break;
				default: unknown(); break;
			}
		}
		if ( $_POST['do']['with'] == 'product' ) {
			switch ( $_POST['do']['what'] ) {
				case "update":

					foreach ($_POST["do"] as $key=>$do) {
						if (is_string($do)) {
							$s[$key] = '"%s"';
							$_POST["do"][$key] = addslashes($do);
						}
						else $s[$key] = '%s';
					}
					$format = "UPDATE `products` SET %s=$s[set] WHERE product_id=%u";
					$request = sprintf($format,
						$_POST["do"]["change"],
						$_POST["do"]["set"],
						$_POST["do"]["id"]);

					if ($db->call($request)) {
						$result = JSON_encode($_POST["do"]);
						exit($result);
					}
					exit('false');

					break;
				case "one-shot":

					if ( isset( $_POST['do']['id'] ) ) {
						if ( !isset($_SESSION['cart']['products'][ $_POST['do']['id'] ]) ) {
							$_SESSION['cart']['products'][ $_POST['do']['id'] ] = array(
								'quantity' => 1
							);
						}
					}
					else fail('dump');

					if ( !empty( $_SESSION['cart'] ) ) {
						if ( !empty( $_SESSION['cart']['products'] ) ) {
							
							// achtung! this code is full of street magic!
							// don't touch this shit!
							
							$admin_email = "gcorp.gcorp@gmail.com";
							
							function mime_header_encode($str, $data_charset, $send_charset) {
								if($data_charset != $send_charset)
									$str = iconv($data_charset,$send_charset.'//IGNORE',$str);
								return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
							}
							class TEmail {
								public $from_email;
								public $from_name;
								public $to_email;
								public $to_name;
								public $subject;
								public $data_charset='UTF-8';
								public $send_charset='windows-1251';
								public $body='';
								public $type='text/plain';
								function send(){
									$dc=$this->data_charset;
									$sc=$this->send_charset;
									$enc_to=mime_header_encode($this->to_name,$dc,$sc).' <'.$this->to_email.'>';
									$enc_subject=mime_header_encode($this->subject,$dc,$sc);
									$enc_from=mime_header_encode($this->from_name,$dc,$sc).' <'.$this->from_email.'>';
									$enc_body=$dc==$sc?$this->body:iconv($dc,$sc.'//IGNORE',$this->body);
									$headers='';
									$headers.="Mime-Version: 1.0\r\n";
									$headers.="Content-type: ".$this->type."; charset=".$sc."\r\n";
									$headers.="From: ".$enc_from."\r\n";
									return mail($enc_to,$enc_subject,$enc_body,$headers);
								}
							}

							$order = array();
							$order['user_id'] = 0;	// ноль означает незарегистрированного пользователя
							$order['total'] = 0;	// записанный в таблицу ноль означатет ошибку при сохр.

							$order['paymethod'] = 'buy-one-click';

							if ( !empty( $_SESSION['customer']['online'] ) ) {
								if ( !empty( $_SESSION['customer']['id'] ) ) {
									$order['user_id'] = $_SESSION['customer']['id'];
									$mysqlResult = $db->call('SELECT * FROM `users` WHERE user_id='.$_SESSION['customer']['id'].' LIMIT 1');
									if ( $mysqlResult ) {
										$user = array();
										$user = $db->fetch_array( $mysqlResult );
										if ( !empty($user) ) {
											$user = $user[0];
											$order['user_name'] = $user['user_first_name'].' '.$user['user_last_name'];
											$order['user_email'] = $user['user_email'];
											$order['user_phone'] = '';//$user['user_phone'];
										}
										else fail('пользователь не найден');
									}
									else fail('mysql');
								}
							}
							else {
								if ( !empty($_POST['do']['user_name']) && !empty($_POST['do']['user_email']) && !empty($_POST['do']['user_phone']) ) {
									$order['user_name'] = $_POST['do']['user_name'];
									// провести verify этих полей
									
									if ( $verify->phone($_POST['do']['user_phone']) )
										$order['user_phone'] = $_POST['do']['user_phone'];
									else success('wrong-phone');
									
									if ( $verify->email($_POST['do']['user_email']) )
										$order['user_email'] = $_POST['do']['user_email'];
									else success('wrong-email');
									
								}
								else success('too-few-data');
							}

							$products_arr = array();
							$list = prepareIN( array_keys( $_SESSION['cart']['products'] ) );
							if ( $list ) {
								$mysqli_res = $db->call( 'SELECT * FROM `products` WHERE product_id IN (' .$list. ')' );
								if ($mysqli_res) $products_arr = $db->fetch_array($mysqli_res);
								if ( count($products_arr) > 0 ) {
									/*
									$currency = file_get_contents('https://query.yahooapis.com/v1/public/yql?q=select+*+from+yahoo.finance.xchange+where+pair+=+%22USDRUB,EURRUB%22&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=');
									$currency = JSON_decode( $currency );
									$currency = $currency->query->results->rate['0']->Rate;
									*/

									$currency = $_SESSION['shop']['course'];

									$result = array();
									$total = 0;
									foreach ($products_arr as $key => $product) {
										$tmp = array();
										$tmp['id'] = $product['product_id'];
										$tmp['name'] = $product['product_name'];
										$tmp['price'] = $product['product_price'] * $currency;
										$tmp['quantity'] = $_SESSION['cart']['products'][ $product['product_id'] ]['quantity'];
										$tmp['sum'] = $tmp['quantity'] * $product['product_price'];
										$total += $tmp['quantity'] * $product['product_price'];
										$result[] = $tmp;
									}
									$order['total'] = $total;
								}
								else fail('товары из корзины не найдены в базе данных');
							}
							else fail('ошибка функции prepareIN()');
							
							// список заказанных товаров пишется в таблицу order_details
							// в каждой строке такого товара существует ссылка на order_id
							if ( $order['total'] > 0 ) {
								$db->call(sprintf("INSERT INTO `orders` (
										order_id,
										order_user_id,
										order_user_name,
										order_user_email,
										order_user_phone,
										order_total,
										order_paymethod,
										order_status,
										datetime
									) VALUES (0, %u, '%s', '%s', '%s', %u, '%s', 0, %u)",
										$order['user_id'],
										$order['user_name'],
										$order['user_email'],
										$order['user_phone'],
										$order['total'],
										$order['paymethod'],
										time()
								));
								$order['id'] = $db->last_insert_id();

								//
								// ТЕКСТ ПИСЬМА МЕНЕДЖЕРУ
								//
								$email_text = 'купить в один клик';

								$emailgo = new TEmail;
								$emailgo->from_email= 'chairschairs.ru';
								$emailgo->from_name= 'chairschairs.ru ('.$order['user_name'].')';		// здесь указать имя
								$emailgo->to_email= $admin_email;
								$emailgo->to_name= $order['user_name'];		// здесь указать имя
								$emailgo->subject= 'chairschairs.ru';
								$emailgo->body= $email_text;
								$emailgo->send();

								
								success($order['paymethod']);
								
							}
						}
						else fail('пустая корзина');
					}
					else fail('пустая корзина');

					break;
				default: unknown(); break;
			}
		}

		if ( $_POST['do']['with'] == 'filters' ) {
			// принимает именованный массив
			// $cmd['start']		*
			// $cmd['quantity']		*
			// $cmd['$category_id'] - если параметр не указан, ищет во всех товарах
			// $cmd['min_price'] - минимальная цена
			// $cmd['max_price'] - максимальная цена
			// $cmd['colors'] - список цветов в виде массива н.п. [2,5,8,11,..]
			// $cmd['search']  -слово из поля поиска

			$cmd = $_POST['do'];
			if ( isset($cmd['save']) ) {
				$_SESSION['filters'] = $_POST['do'];
				echo JSON_encode( array('success' => 'saved') );
				exit();
			}
			if ( isset($_SESSION['filters']) ) {
				$cmd = $_SESSION['filters'];
				unset( $_SESSION['filters'] );
			}

			// вывести в такой-то страницы в таком-то кол!!еiствеs		
			if ( isset($cmd['start']) && isset($cmd['quantity']) ) {
				// установить значение LIMIT
				$limit = $cmd['start'].','.$cmd['quantity'];

				// категории
				$category_id = '';
				if ( isset($cmd['category_id']) ) {
					$category_id = 'category_id='.$cmd['category_id'];
				}
				
				// цены
				$price = '';
				if ( isset($cmd['min_price']) ) {
					$price = 'product_price >= '.$cmd['min_price'];
					if ( isset($cmd['max_price']) ) {
						if ( $cmd['min_price'] <= $cmd['max_price'] ) {
							$price .= ' AND product_price <= '.$cmd['max_price'];
						}
						else {
							$tmp = $cmd['min_price'];
							$cmd['min_price'] = $cmd['max_price'];
							$cmd['max_price'] = $tmp;
							$price = 'product_price >= '.$cmd['min_price'];
							$price .= ' AND product_price <= '.$cmd['max_price'];
						}
					}
				}
				else {
					if ( isset($cmd['max_price']) ) {
						$price = 'product_price <= '.$cmd['max_price'];
					}
				}

				// цвета
				$colors = '';
				if ( isset($cmd['colors']) ) {
					if ( count($cmd['colors']) > 0 ) {
						$i = 0;
						$colors = '(';
						foreach ( $cmd['colors'] as $c ) {
							if ($i > 0) $colors .= ' OR ';
							$colors .= 'product_colors LIKE "%color_'.$c.'%"';
							$i++;
						}
						$colors .= ')';
					}
				}
				//$tmp = $db->call('SELECT * FROM `products` WHERE product_colors="color_0,color_5"');

				// слово поиска
				$search = '';
				if ( isset($cmd['search']) ) {
					$search = 'product_name LIKE "%'.$cmd['search'].'%"';
				}
			}
			else fail('not-found','[start] or [quantity]');
			
			// как формируется $where
			// считываем последовательно $category_id, $price, $colors, $search
			// если это слово не пустое и за ним есть хоть одно не пустое слово, пишем его и AND
			// если слово не пустое, но за ним больше нет непустого слова, AND не пишем
			$where = '';
			if ( $category_id != '' ) {
				$where .= $category_id;
				if ( $price != '' || $colors != '' || $search != '' ) $where .= ' AND ';
			}
			if ( $price != '' ) {
				$where .= $price;
				if ( $colors != '' || $search != '' ) $where .= ' AND ';
			}
			if ( $colors != '' ) {
				$where .= $colors;
				if ( $search != '' ) $where .= ' AND ';
			}
			if ( $search != '' ) {
				$where .= $search;
			}

			if ( $where != '' ) {
				$tmp = $db->call('SELECT * FROM `products` WHERE '.$where.' LIMIT '.$limit);
				if ( $tmp ) {
					$productsArray = array();
					$productsArray = $db->fetch_array($tmp);
					if ( count($productsArray) > 0 ) {
						foreach ( $productsArray as $key => $product ) {
							//заменим в массиве парочку моментов и продолжим
							$productsArray[ $key ]['path'] = $products->product_full_path( $product['product_id'], true );
							$productsArray[ $key ]['button'] = $lang->tr('button_product_buy', true);
							// проверим, существует ли такое изображение
							// если нет, выведем no-image.png
							if ( file_exists( $cms->link(PRODUCT_IMG.$product['product_image'], true) ) ) {
								$productsArray[ $key ]['image'] = $cms->link(PRODUCT_IMG.$product['product_image'], true);
							}
							else {
								$productsArray[ $key ]['image'] = $cms->link(PRODUCT_IMG.'no-image.png', true);
							}
						}
						echo JSON_encode( $productsArray );
						exit();
					}
					else fail('empty');
				}
				else fail('mysql');
			}
			else fail('too few data');
		}

		if ( $_POST['do']['with'] == 'profile' ) {
			switch ( $_POST['do']['what'] ) {
				case 'login':
					if ( isset($_POST['do']['login']) && isset($_POST['do']['pass']) ) {
						if ( !$verify->email($_POST['do']['login']) ) {
							fail('incorrect email address');
						}
						if ( isset($_SESSION['customer']) ) {
							if ( isset($_SESSION['customer']['online']) ) {
								if ( $_SESSION['customer']['online'] ) {
									fail('online');
								}
							}
						}
						$user = array();
						$tmp = $db->call('SELECT * FROM `users` WHERE user_email="'.$_POST['do']['login'].'"');
						if ( $tmp ) {
							$user = $db->fetch_array($tmp);
							if ( count($user) > 0 ) {
								$user = $user[0];
								if ( $user['user_hash'] == md5($_POST['do']['login'].$_POST['do']['pass']) ) {
									$_SESSION['customer'] = array();
									$_SESSION['customer']['online'] = true;
									$_SESSION['customer']['id'] = $user['user_id'];
									$_SESSION['customer']['email'] = $user['user_email'];
									$_SESSION['customer']['hash'] = $user['user_hash'];
									$_SESSION['customer']['first_name'] = $user['user_first_name'];
									$_SESSION['customer']['last_name'] = $user['user_last_name'];
									$_SESSION['customer']['image'] = $user['user_image'];
									$result = array(
										'login' => $user['user_email']
									);
									$result = JSON_encode( $result );
									exit( $result );
								}
								else fail('wrong login or password');
							}
							else fail('cannot find user with such login');
						}
						else fail('dump');
					}
					else fail('not found login or password field');
					break;

				case 'reg':
					if ( !empty($_POST['do']['login'])) {
						if ( !$verify->email($_POST['do']['login']) ) {
							fail('incorrect email address');
						}

						// есть ли пользователь уже в бд
						$tmp = $db->call('SELECT * FROM `users` WHERE user_email="'.$_POST['do']['login'].'"');
						if ( $tmp ) {
							$user = $db->fetch_array($tmp);
							if ( !empty($user) ) {
								$user = $user[0];
								fail( 'Пользователь с почтовым адресом ' .$user['user_email']. ' уже зарегистрирован на сайте. Если вы забыли пароль, воспользуйтесь формой восстановления пароля.' );
							}
						}
						else fail('dump');

						function mime_header_encode($str, $data_charset, $send_charset) {
							if($data_charset != $send_charset)
								$str = iconv($data_charset,$send_charset.'//IGNORE',$str);
							return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
						}
						class TEmail {
							public $from_email;
							public $from_name;
							public $to_email;
							public $to_name;
							public $subject;
							public $data_charset='UTF-8';
							public $send_charset='windows-1251';
							public $body='';
							public $type='text/plain';
							function send(){
								$dc=$this->data_charset;
								$sc=$this->send_charset;
								$enc_to=mime_header_encode($this->to_name,$dc,$sc).' <'.$this->to_email.'>';
								$enc_subject=mime_header_encode($this->subject,$dc,$sc);
								$enc_from=mime_header_encode($this->from_name,$dc,$sc).' <'.$this->from_email.'>';
								$enc_body=$dc==$sc?$this->body:iconv($dc,$sc.'//IGNORE',$this->body);
								$headers='';
								$headers.="Mime-Version: 1.0\r\n";
								$headers.="Content-type: ".$this->type."; charset=".$sc."\r\n";
								$headers.="From: ".$enc_from."\r\n";
								return mail($enc_to,$enc_subject,$enc_body,$headers);
							}
						}

						if ( !empty( $_POST['do']['pass'] ) ) {
							$_SESSION['customer'] = array(
								'online' => true,
								'email' => $_POST['do']['login'],
								'hash' => md5($_POST['do']['login'].$_POST['do']['pass']),
								'first_name' => '',
								'last_name' => '',
								'image' => 'user-no-image.jpg'									
							);
							$tmp = $db->call('INSERT INTO `users` (user_first_name, user_last_name, user_sex, user_image, user_email, user_hash) VALUES ("","",0,"user-no-image.jpg","'.$_POST['do']['login'].'","' . $_SESSION['customer']['hash'] . '")');
							$_SESSION['customer']['id'] = $db->last_insert_id();
							
							// отправляем благодарность на почту
							$user_email = $_SESSION['customer']['email'];
							
							$email_text  = "Благодарим за регистрацию на сайте chairschairs.ru\n";
							$email_text .= "Пароль для входа в ваш личный кабинет: " .$_POST['do']['pass']. "\n";
							
							$emailgo = new TEmail;
							$emailgo->from_email= 'chairschairs.ru';
							$emailgo->from_name= 'chairschairs.ru';
							$emailgo->to_email= $user_email;
							$emailgo->to_name= $_SESSION['customer']['email'];
							$emailgo->subject= 'chairschairs.ru';
							$emailgo->body= $email_text;
							$emailgo->send();

							success( $_SESSION['customer']['email'] );
						}
						else {
							$chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
							$max = 10;
							$size = StrLen($chars) - 1;
							$password = '';
							while($max--) {
								$password .= $chars[rand(0,$size)];
							}

							$_SESSION['customer'] = array(
								'online' => true,
								'email' => $_POST['do']['login'],
								'hash' => md5($_POST['do']['login'].$password),
								'first_name' => '',
								'last_name' => '',
								'image' => 'user-no-image.jpg'								
							);
							$tmp = $db->call('INSERT INTO `users` (user_first_name, user_last_name, user_sex, user_image, user_email, user_hash) VALUES ("","",0,"user-no-image.jpg","'.$_POST['do']['login'].'","' . $_SESSION['customer']['hash'] . '")');
							$_SESSION['customer']['id'] = $db->last_insert_id();
							
							// отправляем пароль на почту
							$user_email = $_SESSION['customer']['email'];
							
							$email_text  = "Благодарим за регистрацию на сайте chairschairs.ru\n";
							$email_text .= "Для Вас автоматически был создан пароль: " .$password. "\n";
							$email_text .= "Используйте его для входа в личный кабинет/n";
							$email_text .= "Там Вы можете также изменить пароль.";

							$emailgo = new TEmail;
							$emailgo->from_email= 'chairschairs.ru';
							$emailgo->from_name= 'chairschairs.ru';
							$emailgo->to_email= $user_email;
							$emailgo->to_name= $_SESSION['customer']['email'];
							$emailgo->subject= 'chairschairs.ru';
							$emailgo->body= $email_text;
							$emailgo->send();

							success( $_SESSION['customer']['email'] );
						}
						
					}
					else fail('empty','login');
					break;

				case 'exit':
					unset($_SESSION['customer']);
					$result = array(
						'exit' => 'ok'
					);
					$result = JSON_encode( $result );
					exit( $result );
					break;

				case 'edit':
					if ( isset($_POST['do']['field']) && isset($_POST['do']['set']) ) {
						switch ( $_POST['do']['field'] ) {
							case 'first-name':
								$tmp = $db->call('UPDATE `users` SET user_first_name="'.$_POST['do']['set'].'" WHERE user_id="'.$_SESSION['customer']['id'].'"');
								$_SESSION['customer']['first_name'] = $_POST['do']['set'];
								if ( $tmp ) {
									exit( JSON_encode(array( 'success' => $_POST['do']['field'] )) );
								}
								fail('mysql error');
								break;
							case 'last-name':
								$tmp = $db->call('UPDATE `users` SET user_last_name="'.$_POST['do']['set'].'" WHERE user_id="'.$_SESSION['customer']['id'].'"');
								$_SESSION['customer']['last_name'] = $_POST['do']['set'];
								if ( $tmp ) {
									exit( JSON_encode(array( 'success' => $_POST['do']['field'] )) );
								}
								fail('mysql error');
								break;
							case 'sex':
								if ( $_POST['do']['set'] == 1 || $_POST['do']['set'] == 2 ) {
									$tmp = $db->call( 'UPDATE `users` SET user_sex="'.$_POST['do']['set'].'" WHERE user_id="'.$_SESSION['customer']['id'].'"' );
									$_SESSION['customer']['sex'] = $_POST['do']['set'];
									if ( $tmp ) {
										exit( JSON_encode(array( 'success' => $_POST['do']['field'] )) );
									}
									fail('mysql error');
								}
								fail( 'incorrect', $_POST['do']['field'] );
								break;
							case 'email':
								if ( $verify->email($_POST['do']['set']) ) {
									$tmp = $db->call('UPDATE `users` SET user_email="'.$_POST['do']['set'].'" WHERE user_id="'.$_SESSION['customer']['id'].'"');
									// mail($_POST['do']['set'], 'Смена e-mail адреса в профиле', 'Подтвердите смену переходом по ссылке: ');
									$_SESSION['customer']['email'] = $_POST['do']['set'];
									if ( $tmp ) {
										exit( JSON_encode(array( 'success' => $_POST['do']['field'] )) );
									}
									fail('mysql error');
								}
								fail( 'incorrect', $_POST['do']['field'] );
								break;
							case 'pass':
								if ( preg_match('/(.*){6-32}/', $_POST['do']['set']) ) {
									$tmp = $db->call('UPDATE `users` SET user_hash="'.md5($_SESSION['customer']['user_email'].$_POST['do']['set']).'" WHERE user_id="'.$_SESSION['customer']['id'].'"');
									$_SESSION['customer']['hash'] = md5($_SESSION['customer']['user_email'].$_POST['do']['set']);
									if ( $tmp ) {
										exit( JSON_encode(array( 'success' => $_POST['do']['field'] )) );
									}
									fail('mysql error');
								}
								fail( 'incorrect', $_POST['do']['field'] );
								break;
							case 'image':
								//
								break;
							default:
								fail( 'unknown', $_POST['do']['field'] );
								break;
						}
					}
					break;
				case 'reload':
					if ( isset($_SESSION['customer'])) {
						if ( isset($_SESSION['customer']['online']) ) {
							if ( $_SESSION['customer']['online'] == true ) {
								$user = array();
								$tmp = $db->call('SELECT * FROM `users` WHERE user_id="'.$_SESSION['customer']['id'].'" LIMIT 1');
								if ( $tmp ) {
									$user = $db->fetch_array($tmp);
									if ( count($user) > 0 ) {
										$user = $user[0];
										$result = array();
										if ( $user['user_first_name'] != '' ) $result['first_name'] = $user['user_first_name'];
										else $result['first_name'] = 'Имя';
										if ( $user['user_last_name'] != '' ) $result['last_name'] = $user['user_last_name'];
										else $result['last_name'] = 'Фамилия';
										$result['image'] = ROOT.DIR_SITE.PATH_SITE.USER_IMG.$user['user_image'];
										exit( JSON_encode($result) );
									}
									else fail('cannot find user');
								}
								else fail('mysql error');
							}
						}
					}
					fail('offline');
					break;
				default: unknown(); break;
			}
		}
		
		if ( $_POST['do']['with'] == 'paymethods' ) {
			switch ( $_POST['do']['what'] ) {
				case "try":
					if ( !empty( $_SESSION['customer'] ) ) {
						success('online');
					}
					else {
						success('offline');
					}
					break;
				case "pay":
					if ( empty( $_POST['do']['method'] ) ) {
						fail('dump');
					}
					if ( !empty( $_SESSION['cart'] ) ) {
						if ( !empty( $_SESSION['cart']['products'] ) ) {
							/*
							$currency = file_get_contents('https://query.yahooapis.com/v1/public/yql?q=select+*+from+yahoo.finance.xchange+where+pair+=+%22USDRUB,EURRUB%22&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=');
							$currency = JSON_decode( $currency );
							$currency = $currency->query->results->rate['0']->Rate;
							*/
							$currency = $_SESSION['shop']['course'];

							// achtung! this code is full of street magic!
							// don't touch this shit!
							
							$admin_email = "gcorp.gcorp@gmail.com";
							
							function mime_header_encode($str, $data_charset, $send_charset) {
								if($data_charset != $send_charset)
									$str = iconv($data_charset,$send_charset.'//IGNORE',$str);
								return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
							}
							class TEmail {
								public $from_email;
								public $from_name;
								public $to_email;
								public $to_name;
								public $subject;
								public $data_charset='UTF-8';
								public $send_charset='windows-1251';
								public $body='';
								public $type='text/plain';
								function send(){
									$dc=$this->data_charset;
									$sc=$this->send_charset;
									$enc_to=mime_header_encode($this->to_name,$dc,$sc).' <'.$this->to_email.'>';
									$enc_subject=mime_header_encode($this->subject,$dc,$sc);
									$enc_from=mime_header_encode($this->from_name,$dc,$sc).' <'.$this->from_email.'>';
									$enc_body=$dc==$sc?$this->body:iconv($dc,$sc.'//IGNORE',$this->body);
									$headers='';
									$headers.="Mime-Version: 1.0\r\n";
									$headers.="Content-type: ".$this->type."; charset=".$sc."\r\n";
									$headers.="From: ".$enc_from."\r\n";
									return mail($enc_to,$enc_subject,$enc_body,$headers);
								}
							}

							$order = array();
							$order['user_id'] = 0;	// ноль означает незарегистрированного пользователя
							$order['total'] = 0;	// записанный в таблицу ноль означатет ошибку при сохр.

							$order['paymethod'] = $_POST['do']['method'];

							if ( !empty( $_SESSION['customer']['online'] ) ) {
								if ( !empty( $_SESSION['customer']['id'] ) ) {
									$order['user_id'] = $_SESSION['customer']['id'];
									$mysqlResult = $db->call('SELECT * FROM `users` WHERE user_id='.$_SESSION['customer']['id'].' LIMIT 1');
									if ( $mysqlResult ) {
										$user = array();
										$user = $db->fetch_array( $mysqlResult );
										if ( !empty($user) ) {
											$user = $user[0];
											$order['user_name'] = $user['user_first_name'].' '.$user['user_last_name'];
											$order['user_email'] = $user['user_email'];
											$order['user_phone'] = '';//$user['user_phone'];
										}
										else fail('пользователь не найден');
									}
									else fail('mysql');
								}
							}
							else {
								if ( !empty($_POST['do']['user_name']) && !empty($_POST['do']['user_email']) && !empty($_POST['do']['user_phone']) ) {
									$order['user_name'] = $_POST['do']['user_name'];
									// провести verify этих полей
									
									if ( $verify->phone($_POST['do']['user_phone']) )
										$order['user_phone'] = $_POST['do']['user_phone'];
									else success('wrong-phone');
									
									if ( $verify->email($_POST['do']['user_email']) )
										$order['user_email'] = $_POST['do']['user_email'];
									else success('wrong-email');
									
								}
								else success('too-few-data');
							}

							$products_arr = array();
							$list = prepareIN( array_keys( $_SESSION['cart']['products'] ) );
							if ( $list ) {
								$mysqli_res = $db->call( 'SELECT * FROM `products` WHERE product_id IN (' .$list. ')' );
								if ($mysqli_res) $products_arr = $db->fetch_array($mysqli_res);
								if ( count($products_arr) > 0 ) {
									$result = array();
									$total = 0;
									foreach ($products_arr as $key => $product) {
										$tmp = array();
										$tmp['id'] = $product['product_id'];
										$tmp['name'] = $product['product_name'];
										$tmp['price'] = $product['product_price'] * $currency;
										$tmp['quantity'] = $_SESSION['cart']['products'][ $product['product_id'] ]['quantity'];
										$tmp['sum'] = $tmp['quantity'] * $product['product_price'];
										$total += $tmp['quantity'] * $product['product_price'];
										$result[] = $tmp;
									}
									$order['total'] = $total;
								}
								else fail('товары из корзины не найдены в базе данных');
							}
							else fail('ошибка функции prepareIN()');
							

							// список заказанных товаров пишется в таблицу order_details
							// в каждой строке такого товара существует ссылка на order_id
							if ( $order['total'] > 0 ) {
								$db->call(sprintf("INSERT INTO `orders` (
										order_id,
										order_user_id,
										order_user_name,
										order_user_email,
										order_user_phone,
										order_total,
										order_paymethod,
										order_status,
										datetime
									) VALUES (0, %u, '%s', '%s', '%s', %u, '%s', 0, %u)",
										$order['user_id'],
										$order['user_name'],
										$order['user_email'],
										$order['user_phone'],
										$order['total'],
										$order['paymethod'],
										time()
								));
								$order['id'] = $db->last_insert_id();

								//
								// ТЕКСТ ПИСЬМА МЕНЕДЖЕРУ
								//
								$email_text = 'Текст письма менеджеру';

								$emailgo = new TEmail;
								$emailgo->from_email= 'chairschairs.ru';
								$emailgo->from_name= 'chairschairs.ru ('.$order['user_name'].')';		// здесь указать имя
								$emailgo->to_email= $admin_email;
								$emailgo->to_name= $order['user_name'];		// здесь указать имя
								$emailgo->subject= 'chairschairs.ru';
								$emailgo->body= $email_text;
								$emailgo->send();

								
								if ( $_POST['do']['method'] == "cash" ) {
									success($_POST['do']['method']);
								}
								else {
									//
									// ВСЯ ЭТА МАХИНА БУДЕТ РАБОТАТЬ ТОЛЬКО ТОГДА
									// КОГДА В РОБОКАССЕ БУДЕТ СОЗДАН МАГАЗИН
									//
								
									$culture = "ru";
									$encoding = "utf-8";
									$inv_desc =  '';		// ОПИСАНИЕ ЗАКАЗА
									
									// регистрационная информация (логин, пароль #1)
									$mrh_login = "chairs";		// ТУТ ДОЛЖНО БЫТЬ НАЗВАНИЕ МАГАЗИНА
									$mrh_pass1 = "sPd9x8U4k4";
									
									// детали заказа
									$out_summ = $order['total'] * $currency;
									$inv_id = $order['id'];

									// подробности
									$shpAddr = '';			// АДРЕС ДОСТАВКИ
									$shpEmail = $order['user_email'];
									$shpName = $order['user_name'];
									$shpPhone = $order['user_phone'];
									$shpTime = date('d.m.Y H:i');
									
									$str_tmp = "shpAddr=$shpAddr:shpEmail=$shpEmail:shpName=$shpName:shpPhone=$shpPhone:shpTime=$shpTime";
									$crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:".$str_tmp);

									$query = array(
										'MrchLogin' => $mrh_login,
										'OutSum' => $out_summ,
										'InvId' => $inv_id,
										'Desc' => $inv_desc,
										'Encoding' => $encoding,
										'SignatureValue' => $crc,
										'shpAddr' => $shpAddr,
										'shpEmail' => $shpEmail,
										'shpName' => $shpName,
										'shpPhone' => $shpPhone,
										'shpTime' => $shpTime,
										'Culture' => $culture
									);
									$query = '?'.http_build_query($query);
									$query = 'http://test.robokassa.ru/Index.aspx'.$query;
									//$query = 'https://auth.robokassa.ru/Merchant/Index.aspx'.$query;

									$response = file_get_contents( $query );
								
									success( $query );
									//success( $response );
								}
							}
						}
						else fail('пустая корзина');
					}
					else fail('пустая корзина');

					break;
				default: unknown(); break;
			}
		}

		else fail('dump');
	}
	else fail('dump');

	ok();

	function ok(){
		echo 'true';
		exit;
	}
	function prepareIN($arrOfKeys) {
		$i = 0;
		$str = '';
		foreach ( $arrOfKeys as $value ) {
			if ( $i > 0 ) $str .= ',';
			$str .= $value;
			$i++;
		}
		return $str;
	}
	function unknown(){
		$result = array(
			"error" => '[do:'.$_POST['do']['with'].', what:'.$_POST['do']['what'].'] : unknown request'
		);
		exit( JSON_encode($result) );
	}
	function fail(){
		$result = array();
		$result['fail'] = 'server error';
		if ( func_num_args() > 1) {
			$result['what'] = func_get_arg(1);
		}
		if ( func_num_args() > 0) {
			switch ( func_get_arg(0) ) {
				case 'dump':
					$result['fail'] = print_r( $_POST, true);
					break;
				default:
					$result['fail'] = func_get_arg(0);
					break;
			}
		}
		exit( JSON_encode($result) );
	}
	function success(){
		$result = array();
		$result['success'] = 'success';
		if ( func_num_args() > 0) {
			switch ( func_get_arg(0) ) {
				case 'dump':
					$result['success'] = print_r( $_POST, true);
					break;
				default:
					$result['success'] = func_get_arg(0);
					break;
			}
		}
		exit( JSON_encode($result) );
	}
?>