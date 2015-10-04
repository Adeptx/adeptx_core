<?






if ( !empty($_FILES) ) {
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
  				$img->resize($to, 140, 140);
				exit('{"status":"success","profile_image":"' . HOST . DIR_SITE . PATH_SITE . USER_IMG . $newname . '"}');
			}
		}
		exit('{"status":"error","error":"upload error"}');
		break;
	}

	/*
    $_FILES['uploadfile']['name'] - имя файла до его отправки на сервер, например, pict.gif;
    $_FILES['uploadfile']['size'] - размер принятого файла в байтах;
    $_FILES['uploadfile']['type'] - MIME-тип принятого файла (если браузер смог его определить), например: image/gif, image/png, image/jpeg, text/html;
    $_FILES['uploadfile']['tmp_name'] (так мы назвали поле загрузки файла) - содержит имя файла во временном каталоге, например: /tmp/phpV3b3qY;
    $_FILES['uploadfile']['error'] - Код ошибки, которая может возникнуть при загрузке файла. Ключ ['error'] был добавлен в PHP 4.2.0. С соответствующими кодами ошибок вы можете ознакомиться здесь
	*/

	if( $_POST['act'] == 'upload_images') {
		$product_id = $_POST['id'];
		$product_color = $_POST['color'];
		if (empty($product_color)) exit('{"fail":"color no choose"}');

		foreach ($_FILES['product_images']['tmp_name'] as $i=>$tmp_name) {
			$dir		= ROOT . DIR_SITE . PATH_SITE . PRODUCT_IMG;
			# list of permitted file extensions
			$allowed	= array('png', 'jpg', 'jpeg', 'ico', 'gif');

			if (
				$_FILES['product_images']['error'][$i] == 0 &&
				$_FILES['product_images']['size'][$i] < 10*1024*1024
			) {
				$extension = pathinfo($_FILES['product_images']['name'][$i], PATHINFO_EXTENSION);

				if (!in_array(strtolower($extension), $allowed)) {
					exit('{"status":"error","error":"not allowed extension for product photos"}');
				}
				$newname = md5_file($tmp_name) . '.' . $extension;

				$format = ROOT . DIR_SITE . PATH_SITE . PRODUCT_IMG . "%s" . $product_id . '/';
				$original = sprintf($format, ORIGINAL_IMG_SIZE);
				$large = sprintf($format, LARGE_IMG_SIZE);
				$middle = sprintf($format, MIDDLE_IMG_SIZE);
				$small = sprintf($format, SMALL_IMG_SIZE);
				if (!is_dir($original)) { mkdir($original, 0777, true); }
				if (!is_dir($large)) { mkdir($large, 0777, true); }
				if (!is_dir($middle)) { mkdir($middle, 0777, true); }
				if (!is_dir($small)) { mkdir($small, 0777, true); }
				$original .= $newname;
				$large .= $newname;
				$middle .= $newname;
				$small .= $newname;

				if (move_uploaded_file($tmp_name, $original)) 
				if (is_readable($original)) {
					$format = 'INSERT INTO `pictures_colors` (product_id, product_color, product_picture) VALUES (%u, "%s", "%s")';
					$query = sprintf(
						$format,
						$product_id,
						$product_color,
						$newname
					);
					$db->call($query);

					// $db->call('UPDATE `products` SET product_image="' . $newname . '" WHERE product_id=' . $product_id);

					// exit('{"status":"success","product_image":"' . HOST . DIR_SITE . PATH_SITE . PRODUCT_IMG . $newname . '"}');
  					copy($original, $large);
  					$img->resize($large, 400, 400);
  					copy($large, $middle);
  					$img->resize($middle, 130, 130);
  					copy($middle, $small);
  					$img->resize($small, 80, 80);
				}
			}
			//exit('{"status":"error","error":"upload error"}');
			//break;
		}
	}
}

	if (isset($_POST['do'])) {
		if ( !isset($_POST['do']['with']) ) $admin->fail('dump');

		if ( $_POST['do']['with'] == 'cart' ) {
			switch ($_POST['do']['what']) {
				case 'remove':
					if ( isset( $_POST['do']['id'] ) ) {
						unset( $_SESSION['cart']['products'][ $_POST['do']['id'] ] );
					}
					$admin->fail('dump');
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
					else $admin->fail('dump');
					break;
				case 'load':
					$products_arr = array();
					$list = $admin->prepareIN( array_keys( $_SESSION['cart']['products'] ) );
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
						else $admin->fail();
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
							else $admin->fail('dump');
						}
						ok();
					}
					else $admin->fail('dump');
					break;
				default: $admin->unknown(); break;
			}
		}
		if ( $_POST['do']['with'] == 'reviews' ) {
			switch ($_POST['do']['what']) {

				case 'add':
					if ( !isset($_POST['do']['id']) ) $admin->fail('dump');
					else {
						$request = sprintf('INSERT INTO `reviews` (product_id, review_author, review_text) VALUES ("%s","%s","%s")',
							$_POST['do']['id'],
							$_SESSION['customer']['id'],
							$_POST['do']['text']);
						$db->call($request) or $admin->fail('mysql');

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
					if ( !isset($_POST['do']['id']) ) $admin->fail('dump');
					else {
						$request = sprintf('DELETE FROM `reviews` WHERE review_id="%s"',
							$_POST['do']['review_id']);
						$db->call($request) or $admin->fail('mysql');

						$result['review_id'] = $_POST['do']['review_id'];

						$result = JSON_encode( $result );
						exit( $result );
					}
					break;

				case 'load':
					if ( !isset($_POST['do']['id']) ) $admin->fail('dump');
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
									else $admin->fail('mysql');
									$temp['text'] = $review['review_text'];
									$result[] = $temp;
								}
								$result = JSON_encode( $result );
								exit( $result );
						}	
							else $admin->fail('not-found');
						}
						else $admin->fail('mysql');
					}
					break;
				default: $admin->unknown(); break;
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
					$admin->success( $_SESSION['shop']['course'] );
					break;
				default: $admin->unknown(); break;
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
				default: $admin->unknown(); break;
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
					else $admin->fail('dump');

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
										else $admin->fail('пользователь не найден');
									}
									else $admin->fail('mysql');
								}
							}
							else {
								if ( !empty($_POST['do']['user_name']) && !empty($_POST['do']['user_email']) && !empty($_POST['do']['user_phone']) ) {
									$order['user_name'] = $_POST['do']['user_name'];
									// провести verify этих полей
									
									if ( $verify->phone($_POST['do']['user_phone']) )
										$order['user_phone'] = $_POST['do']['user_phone'];
									else $admin->success('wrong-phone');
									
									if ( $verify->email($_POST['do']['user_email']) )
										$order['user_email'] = $_POST['do']['user_email'];
									else $admin->success('wrong-email');
									
								}
								else $admin->success('too-few-data');
							}

							$products_arr = array();
							$list = $admin->prepareIN( array_keys( $_SESSION['cart']['products'] ) );
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
								else $admin->fail('товары из корзины не найдены в базе данных');
							}
							else $admin->fail('ошибка функции $admin->prepareIN()');
							
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

								
								$admin->success($order['paymethod']);
								
							}
						}
						else $admin->fail('пустая корзина');
					}
					else $admin->fail('пустая корзина');

					break;
				default: $admin->unknown(); break;
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
			else $admin->fail('not-found','[start] or [quantity]');
			
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
					else $admin->fail('empty');
				}
				else $admin->fail('mysql');
			}
			else $admin->fail('too few data');
		}

		if ( $_POST['do']['with'] == 'profile' ) {
			switch ( $_POST['do']['what'] ) {
				case 'login':
					if ( isset($_POST['do']['login']) && isset($_POST['do']['pass']) ) {
						if ( !$verify->email($_POST['do']['login']) ) {
							$admin->fail('incorrect email address');
						}
						if ( isset($_SESSION['customer']) ) {
							if ( isset($_SESSION['customer']['online']) ) {
								if ( $_SESSION['customer']['online'] ) {
									$admin->fail('online');
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
								else $admin->fail('wrong login or password');
							}
							else $admin->fail('cannot find user with such login');
						}
						else $admin->fail('dump');
					}
					else $admin->fail('not found login or password field');
					break;

				case 'reg':
					if ( !empty($_POST['do']['login'])) {
						if ( !$verify->email($_POST['do']['login']) ) {
							$admin->fail('incorrect email address');
						}

						// есть ли пользователь уже в бд
						$tmp = $db->call('SELECT * FROM `users` WHERE user_email="'.$_POST['do']['login'].'"');
						if ( $tmp ) {
							$user = $db->fetch_array($tmp);
							if ( !empty($user) ) {
								$user = $user[0];
								$admin->fail( 'Пользователь с почтовым адресом ' .$user['user_email']. ' уже зарегистрирован на сайте. Если вы забыли пароль, воспользуйтесь формой восстановления пароля.' );
							}
						}
						else $admin->fail('dump');

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

							$admin->success( $_SESSION['customer']['email'] );
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

							$admin->success( $_SESSION['customer']['email'] );
						}
						
					}
					else $admin->fail('empty','login');
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
								$admin->fail('mysql error');
								break;
							case 'last-name':
								$tmp = $db->call('UPDATE `users` SET user_last_name="'.$_POST['do']['set'].'" WHERE user_id="'.$_SESSION['customer']['id'].'"');
								$_SESSION['customer']['last_name'] = $_POST['do']['set'];
								if ( $tmp ) {
									exit( JSON_encode(array( 'success' => $_POST['do']['field'] )) );
								}
								$admin->fail('mysql error');
								break;
							case 'sex':
								if ( $_POST['do']['set'] == 1 || $_POST['do']['set'] == 2 ) {
									$tmp = $db->call( 'UPDATE `users` SET user_sex="'.$_POST['do']['set'].'" WHERE user_id="'.$_SESSION['customer']['id'].'"' );
									$_SESSION['customer']['sex'] = $_POST['do']['set'];
									if ( $tmp ) {
										exit( JSON_encode(array( 'success' => $_POST['do']['field'] )) );
									}
									$admin->fail('mysql error');
								}
								$admin->fail( 'incorrect', $_POST['do']['field'] );
								break;
							case 'email':
								if ( $verify->email($_POST['do']['set']) ) {
									$tmp = $db->call('UPDATE `users` SET user_email="'.$_POST['do']['set'].'" WHERE user_id="'.$_SESSION['customer']['id'].'"');
									// mail($_POST['do']['set'], 'Смена e-mail адреса в профиле', 'Подтвердите смену переходом по ссылке: ');
									$_SESSION['customer']['email'] = $_POST['do']['set'];
									if ( $tmp ) {
										exit( JSON_encode(array( 'success' => $_POST['do']['field'] )) );
									}
									$admin->fail('mysql error');
								}
								$admin->fail( 'incorrect', $_POST['do']['field'] );
								break;
							case 'pass':
								if ( preg_match('/(.*){6-32}/', $_POST['do']['set']) ) {
									$tmp = $db->call('UPDATE `users` SET user_hash="'.md5($_SESSION['customer']['user_email'].$_POST['do']['set']).'" WHERE user_id="'.$_SESSION['customer']['id'].'"');
									$_SESSION['customer']['hash'] = md5($_SESSION['customer']['user_email'].$_POST['do']['set']);
									if ( $tmp ) {
										exit( JSON_encode(array( 'success' => $_POST['do']['field'] )) );
									}
									$admin->fail('mysql error');
								}
								$admin->fail( 'incorrect', $_POST['do']['field'] );
								break;
							case 'image':
								//
								break;
							default:
								$admin->fail( 'unknown', $_POST['do']['field'] );
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
									else $admin->fail('cannot find user');
								}
								else $admin->fail('mysql error');
							}
						}
					}
					$admin->fail('offline');
					break;
				default: $admin->unknown(); break;
			}
		}
		
		if ( $_POST['do']['with'] == 'paymethods' ) {
			switch ( $_POST['do']['what'] ) {
				case "try":
					if ( !empty( $_SESSION['customer'] ) ) {
						$admin->success('online');
					}
					else {
						$admin->success('offline');
					}
					break;
				case "pay":
					if ( empty( $_POST['do']['method'] ) ) {
						$admin->fail('dump');
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
										else $admin->fail('пользователь не найден');
									}
									else $admin->fail('mysql');
								}
							}
							else {
								if ( !empty($_POST['do']['user_name']) && !empty($_POST['do']['user_email']) && !empty($_POST['do']['user_phone']) ) {
									$order['user_name'] = $_POST['do']['user_name'];
									// провести verify этих полей
									
									if ( $verify->phone($_POST['do']['user_phone']) )
										$order['user_phone'] = $_POST['do']['user_phone'];
									else $admin->success('wrong-phone');
									
									if ( $verify->email($_POST['do']['user_email']) )
										$order['user_email'] = $_POST['do']['user_email'];
									else $admin->success('wrong-email');
									
								}
								else $admin->success('too-few-data');
							}

							$products_arr = array();
							$list = $admin->prepareIN( array_keys( $_SESSION['cart']['products'] ) );
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
								else $admin->fail('товары из корзины не найдены в базе данных');
							}
							else $admin->fail('ошибка функции $admin->prepareIN()');
							

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
									$admin->success($_POST['do']['method']);
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
								
									$admin->success( $query );
									//$admin->success( $response );
								}
							}
						}
						else $admin->fail('пустая корзина');
					}
					else $admin->fail('пустая корзина');

					break;
				default: $admin->unknown(); break;
			}
		}


# admin.func from here


/***********************************
 ******* ПРОВОДИМ АВТОРИЗАЦИЮ ******
 ***********************************/

if ( isset( $_POST['login'] ) && isset( $_POST['pass'] ) ) {
	// записать значения в сессию
	// дальнейший код сам проверит корректность данных
	$_SESSION['admin'] = array();
	$_SESSION['admin']['online'] = true;
	$_SESSION['admin']['login'] = $_POST['login'];
	$_SESSION['admin']['hash']  = md5($_POST['login'].$_POST['pass']);
}
// else if ( isset($_POST['do']) /*|| (isset($_FILES['uploadfile'])) */|| !empty($_FILES)  ) {
// 	include ROOT . DIR_SITE . ADMIN_PATH . 'ajax.php';
// }


/*
	Админка -- получение списков товаров и прочего и работа с ними
*/


	# только для административных функций (функций изменения и удаления) необходима авторизация
	// if ( $_SESSION['admin']['online'] != true ) {
	// 	$admin->fail('access-denied');
	// }

	$where_names = array(
		'users' => 'user_id',
		'infopages' => 'infopage_id',
		'categories' => 'category_id',
		'products' => 'product_id',
		'products_details' => 'product_id',
		'news' => 'news_id',
		'options' => 'option_id',
		'articles' => 'article_id'
	);

	switch ($_POST['do']['with']) {
	case 'loadMore':
		if ( isset($_POST['do']['from']) ) {
			switch ( $_POST['do']['from'] ) {
				case 'categories':
					if ( empty($_POST['do']['sort']) ) {
						$_POST['do']['sort'] = 'category_order';
					}
					// if ( empty($_POST['do']['order']) ) {
					// 	$_POST['do']['order'] = ' ';
					// }
					break;
				case 'options':
					// if ( empty($_POST['do']['order']) ) {
					// 	$_POST['do']['order'] = ' ';
					// }
					break;
				case 'products':
					if ( empty($_POST['do']['order']) ) {
						$_POST['do']['order'] = 'DESC';
					}
					break;
				// case 'products':
				// case 'news':
				// case 'users':
				// case 'articles':
				// case 'infopages':
				// 	break;
				// default:
				// 	$admin->fail('unknown command [do > from] : ', $_POST['do']['from']);
				// 	// неправильное значение $_POST["do"]["from"]
				// 	// неизвестная страница
				// 	break;
			}
			if ( empty($_POST['do']['sort']) ) $_POST['do']['sort'] = $where_names[$_POST['do']['from']];
			if ( empty($_POST['do']['order']) ) $_POST['do']['order'] = ''; //'DESC';
			if ( empty($_POST['do']['start']) ) $_POST['do']['start'] = 0;
			if ( empty($_POST['do']['quantity']) ) $_POST['do']['quantity'] = 16;
			
			$admin->loadMore( $_POST['do']['from'] );
		}
		else {
			// не хватает $_POST["do"]["from"]
		}
		break;
	case 'users':
		if ( isset( $_POST["do"]["id"] ) ) {
			switch ( $_POST["do"]["what"] ) {
				case 'update':
					$db->update(
						$_POST["do"]["with"],
						$_POST["do"]["change"],
						$_POST["do"]["set"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				case 'remove':
					$db->delete(
						$_POST["do"]["with"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				default:
					$admin->error("no switched act (3)");
					break;
			}
		}
		else {
			switch ( $_POST["do"]["what"] ) {
				case 'add':
					if (!empty($_POST["do"]["infopage"]["link"])) {
						$query = sprintf('INSERT INTO `infopages` (
							infopage_text,
							infopage_link
							) VALUES("%s", "%s")',
							$_POST["do"]["infopage"]["text"],
							$_POST["do"]["infopage"]["link"]
						);
						$db->call($query) or exit('false');
						$result['public'] = 0;
						$result['views'] = 0;
						$result['text'] = $_POST["do"]["infopage"]["text"];
						$result['link'] = $_POST["do"]["infopage"]["link"];
						$result['id'] = $db->last_insert_id();
						$result = JSON_encode($result);
						exit($result);
					}
					break;
				default:
					$admin->error("ajax-error");
					break;
			}
		}
		$admin->fail('dump');
		exit;
		break;
	case 'infopages':
		if ( isset( $_POST["do"]["id"] ) ) {
			switch ( $_POST["do"]["what"] ) {
				case 'update':
					$db->update(
						$_POST["do"]["with"],
						$_POST["do"]["change"],
						$_POST["do"]["set"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				case 'remove':
					$db->delete(
						$_POST["do"]["with"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				default:
					$admin->error("no switched act (3)");
					break;
			}
		}
		else {
			switch ( $_POST["do"]["what"] ) {
				case 'add':
					if (!empty($_POST["do"]["infopage"]["link"])) {
						$query = sprintf('INSERT INTO `infopages` (
							infopage_text,
							infopage_link
							) VALUES("%s", "%s")',
							$_POST["do"]["infopage"]["text"],
							$_POST["do"]["infopage"]["link"]
						);
						$db->call($query) or exit('false');
						$result['public'] = 0;
						$result['views'] = 0;
						$result['text'] = $_POST["do"]["infopage"]["text"];
						$result['link'] = $_POST["do"]["infopage"]["link"];
						$result['id'] = $db->last_insert_id();
						$result = JSON_encode($result);
						exit($result);
					}
					break;
				default:
					$admin->error("ajax-error");
					break;
			}
		}
		$admin->fail('dump');
		exit;
		break;
	case 'news':
		if ( isset( $_POST["do"]["id"] ) ) {
			switch ( $_POST["do"]["what"] ) {
				case 'update':
					$db->update(
						$_POST["do"]["with"],
						$_POST["do"]["change"],
						$_POST["do"]["set"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				case 'remove':
					$db->delete(
						$_POST["do"]["with"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				default:
					$admin->error("no switched act (news)");
					break;
			}
		}
		else {
			switch ( $_POST["do"]["what"] ) {
				case 'add':
					if (!empty($_POST["do"]["news"]["text"])) {
						$query = sprintf('INSERT INTO `news` (
							news_preview,
							news_title,
							news_text,
							news_date
							) VALUES("%s","%s","%s",%u)',
							$_POST["do"]["news"]["preview"],
							$_POST["do"]["news"]["title"],
							$_POST["do"]["news"]["text"],
							time()
						);
						$db->call($query) or exit('false');
						$result['news_id'] = $db->last_insert_id();
						$result['news_preview'] = '';
						$result['news_title'] = '';
						$result['news_text'] = $_POST["do"]["news"]["text"];
						$result['news_public'] = 0;
						$result['news_date'] = date('d/m/Y',time());
						$result['news_views'] = 0;
						$result = JSON_encode($result);
						exit($result);
					}
					break;
				default:
					$admin->error("ajax-error");
					break;
			}
		}
		$admin->fail('dump');
		exit;
		break;
	case 'articles':
		if ( isset( $_POST["do"]["id"] ) ) {
			switch ( $_POST["do"]["what"] ) {
				case 'update':
					$db->update(
						$_POST["do"]["with"],
						$_POST["do"]["change"],
						$_POST["do"]["set"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				case 'remove':
					$db->delete(
						$_POST["do"]["with"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				default:
					$admin->error("no switched act (articles)");
					break;
			}
		}
		else {
			switch ( $_POST["do"]["what"] ) {
				case 'add':
					if (!empty($_POST["do"]["article"]["text"])) {
						$query = sprintf('INSERT INTO `articles` (
							article_text,
							article_date
							) VALUES("%s",%u)',
							//$_POST["do"]["article"]["title"],
							$_POST["do"]["article"]["text"],
							time()
						);
						$db->call($query) or exit('false');
						$result['article_id'] = $db->last_insert_id();
						$result['article_preview'] = '';
						$result['article_title'] = '';
						$result['article_text'] = $_POST["do"]["article"]["text"];
						$result['article_public'] = 0;
						$result['article_date'] = date('d/m/Y',time());
						$result['article_views'] = 0;
						$result = JSON_encode($result);
						exit($result);
					}
					break;
				default:
					$admin->error("ajax-error");
					break;
			}
		}
		$admin->fail('dump');
		exit;
		break;
	case 'categories':
		if ( isset( $_POST["do"]["id"] ) ) {
			switch ( $_POST["do"]["what"] ) {
				case 'update':
					$db->update(
						$_POST["do"]["with"],
						$_POST["do"]["change"],
						$_POST["do"]["set"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				case 'remove':
					$db->delete(
						$_POST["do"]["with"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				default:
					$admin->error("no switched act");
					break;
			}
		}
		else {
			switch ( $_POST["do"]["what"] ) {
				case 'add':
					if (!empty($_POST["do"]["category"]["url"])) {
						$query = sprintf('INSERT INTO `categories` (
							category_name,
							category_url
							) VALUES("%s", "%s")',
							$_POST["do"]["category"]["name"],
							$_POST["do"]["category"]["url"]
						);
						$result['url'] = $_POST["do"]["category"]["url"];
					}
					else {
						$query = sprintf('INSERT INTO `categories` (
							category_name
							) VALUES("%s")',
							$_POST["do"]["category"]["name"]
						);
					}
					$link = $db->call($query);
					$result['order'] = $_POST["do"]["category"]["order"];
					$result['name'] = $_POST["do"]["category"]["name"];
					$result['id'] = $db->last_insert_id();
					$result = JSON_encode($result);
					exit($result);
					break;
				case 'get-all':
					$tmp = $db->call('SELECT * FROM `categories`');
					if ( $tmp ) {
						$categories = array();
						$categories = $db->fetch_array($tmp);
						if ( count($categories) > 0 ) {
							echo JSON_encode($categories);
							exit();
						}
						else $admin->fail('empty');
					}
					else $admin->fail('mysql');
					break;
				case 'order':
					foreach ($_POST["do"]["ids"] as $i => $id) {
						$db->call("UPDATE `categories` SET category_order=".($i+1)." WHERE category_id=$id");
					}
					die('true');
					break;
				default:
					$admin->fail("no switched act (2)");
					break;
			}
		}
		break;
	case 'products':
		if ( isset( $_POST["do"]["id"] ) ) {
			switch ( $_POST["do"]["what"] ) {
				case 'update':
					foreach ($_POST["do"] as $key=>$do) {
						if (is_string($do)) {
							$s[$key] = '"%s"';
							$_POST["do"][$key] = addslashes($do);
						}
						else $s[$key] = '%s';
					}
					if ($_POST["do"]["change"] == 'product_name') {
						$format = "UPDATE `products` SET %s='%s' WHERE product_id=%u";
						$request = sprintf($format,
							'product_url',
							$cms->trans($_POST["do"]["set"]),
							$_POST["do"]["id"]);
						$mysqli_res = $db->call($request);
					}
					$format = "UPDATE `products` SET %s=$s[set] WHERE product_id=%u";
					$request = sprintf($format,
						$_POST["do"]["change"],
						$_POST["do"]["set"],
						$_POST["do"]["id"]);

					$mysqli_res = $db->call($request);
					if ($mysqli_res) {
						$result = JSON_encode($_POST["do"]);
						exit($result);
					}
					else {
						exit('bad request');
					}
					break;
				case 'remove':
					$db->delete(
						$_POST["do"]["with"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				case 'set-image-color':
					$mysqlResult = $db->call(sprintf('SELECT * FROM `pictures_colors` WHERE product_id=%u AND product_picture="%s" LIMIT 1',
						$_POST["do"]["id"],
						$_POST["do"]["change"]
					));
					if ( $mysqlResult ) {
						$color_products = $db->fetch_array();
						if ( !empty($color_products) ) {
							$query = sprintf('UPDATE `pictures_colors` SET product_color="%s" WHERE product_id=%u AND product_picture="%s"',
								$_POST["do"]["set"],
								$_POST["do"]["id"],
								$_POST["do"]["change"]
							);
							$db->call($query);
						}
						else {
							$query = sprintf('INSERT INTO `pictures_colors` (picture_color_id,product_color,product_id,product_picture) VALUES(0,"%s",%u,"%s")',
								$_POST["do"]["set"],
								$_POST["do"]["id"],
								$_POST["do"]["change"]
							);
							$db->call($query);
						}
						$mysqlResult = $db->call(sprintf('SELECT * FROM `pictures_colors` WHERE product_id=%d',
							$_POST["do"]["id"]
						));
						if ( $mysqlResult ) {
							$product_colors = $db->fetch_array( $mysqlResult );
							if ( !empty($product_colors) ) {
								$colors = '';
								$added = array();
								$i = 0;
								foreach ($product_colors as $prod) {
									if ( !in_array($prod['product_color'], $added) ) {
										$added[] = $prod['product_color'];
										if ( $i > 0 ) {
											$colors .= ',';
										}
										$colors .= $prod['product_color'];
										$i++;
									}
								}
								$db->call(sprintf('UPDATE `products` SET product_colors="%s" WHERE product_id=%d',
									$colors,
									$_POST["do"]["id"]
								));
								$admin->success($_POST['do']);
							}
							else $admin->fail('empty-2');
						}
						else $admin->fail('mysql-2');
					}
					else $admin->fail('mysql');
					break;
				case 'set-main-image':
					$sizes = array(ORIGINAL_IMG_SIZE, LARGE_IMG_SIZE, MIDDLE_IMG_SIZE, SMALL_IMG_SIZE);

					foreach($sizes as $size) {
						$mainPrefix = '..!';
						$secondPrefix = '..$';

						$dir = ROOT.DIR_SITE.PATH_SITE.PRODUCT_IMG.$size.$_POST['do']['id'].'/';
						$imgs_names = scandir($dir);

						$currentMainImage = $dir . $imgs_names[2];
						$nonMainImage = str_replace($mainPrefix, '', $imgs_names[2]);
						$candidate = $_POST['do']['image'];
						$newMainImage = $dir . $candidate;
						$newMainImageWithPrefix = $dir . $mainPrefix . str_replace(array($secondPrefix, $mainPrefix), '', $candidate);

						// if (strpos($imgs_names[3], $secondPrefix) !== 0) {	# if second hasn't prefix add it
						// 	rename($dir . $imgs_names[3], $dir . $secondPrefix . $imgs_names[3]);
						// }
						if (strpos($candidate, $mainPrefix) !== 0) {			# if already main -- do nothing
							if (strpos($candidate, $secondPrefix) === 0) {	# if now second -- reverse with main
								rename($currentMainImage, $dir . $secondPrefix . $nonMainImage);
							}
							else {											# if candidat ordinary image
								rename($currentMainImage, $dir . $nonMainImage);	# current main do orinary
							}
							rename($newMainImage, $newMainImageWithPrefix);	# do mainly
						}
					}
					$admin->success('true');
					break;
				case 'set-second-image':
					$sizes = array(ORIGINAL_IMG_SIZE, LARGE_IMG_SIZE, MIDDLE_IMG_SIZE, SMALL_IMG_SIZE);
					foreach($sizes as $size) {
						$mainPrefix = '..!';
						$secondPrefix = '..$';

						$dir = ROOT.DIR_SITE.PATH_SITE.PRODUCT_IMG.$size.$_POST['do']['id'].'/';
						$imgs_names = scandir($dir);

						$currentSecondImage = $dir . $imgs_names[3];
						$nonSecondImage = str_replace($secondPrefix, '', $imgs_names[3]);
						$candidate = $_POST['do']['image'];
						$newSecondImage = $dir . $candidate;
						$newSecondImageWithPrefix = $dir . $secondPrefix . str_replace(array($secondPrefix, $mainPrefix), '', $candidate);

						if (strpos($imgs_names[2], $mainPrefix) !== 0) {
							rename($dir . $imgs_names[2], $dir . $mainPrefix . $imgs_names[2]);
						}
						if (strpos($candidate, $secondPrefix) !== 0) {			# if already second -- do nothing
							if (strpos($candidate, $mainPrefix) === 0) {
								rename($currentSecondImage, $dir . $mainPrefix . $nonSecondImage);
							}
							else {
								rename($currentSecondImage, $dir . $nonSecondImage);
							}
							rename($newSecondImage, $newSecondImageWithPrefix);
						}
					}
					$admin->success('true');
					break;
				case 'remove-image':

					$format = ROOT . DIR_SITE . PATH_SITE . PRODUCT_IMG . "%s" . $_POST['do']['id'] . '/';
					$original = sprintf($format, ORIGINAL_IMG_SIZE);
					$large = sprintf($format, LARGE_IMG_SIZE);
					$middle = sprintf($format, MIDDLE_IMG_SIZE);
					$small = sprintf($format, SMALL_IMG_SIZE);

  					if (
  						unlink($original . $_POST['do']['image']) &&
  						unlink($large . $_POST['do']['image']) &&
  						unlink($middle . $_POST['do']['image']) &&
  						unlink($small . $_POST['do']['image'])
  					) {
						$db->delete(
							'pictures_colors',
							'product_id',$_POST["do"]["id"]
						);
						@rmdir($original);
						@rmdir($large);
						@rmdir($middle);
						@rmdir($small);
  						$admin->success('true');
  					}
  					$admin->fail('false');
					break;
				case 'details':
					global $products;

					$db_result = $db->call('SELECT * FROM `products` WHERE product_id=' . $_POST["do"]["id"]);
					$results = $db->fetch_array($db_result);
					$result = $results[0];

					$result["product_images"] = $products->getProductImagesLinks($result["product_id"]);
					$result["product_cut_images"] = $products->getProductImagesLinks($result["product_id"], 'cut');

					$db_result = $db->call('SELECT * FROM `pictures_colors` WHERE product_id=' . $_POST["do"]["id"]);
					$images_colors = $db->fetch_array($db_result);

					foreach ($images_colors as $i=>$image_color) {
						$result['product_picture_color'][
							$image_color['product_picture']
						] = substr($image_color['product_color'], 6);	// cut "color-"
					}

					$db_result = $db->call('SELECT details FROM `products_details` WHERE product_id=' . $_POST["do"]["id"]);
					$details = $db->fetch_array($db_result);

					$result['product_details'] = $details[0][0];

					exit(JSON_encode($result));
					break;
				default:
					$admin->error("ajax-error");
					break;
			}
		}
		else {
			switch ( $_POST["do"]["what"] ) {
				case 'get-cats':
					$mysqlResult = $db->call('SELECT * FROM `subcategories`');
					if ( $mysqlResult ) {
						$cats = $db->fetch_array( $mysqlResult );
						if ( !empty($cats) ) {
							$admin->success($cats);
						}
						else $admin->fail('empty');
					}
					else $admin->fail('mysql');
					break;
				case 'add':
					$my = $_POST['do']['product'];
					if ( empty($my['name']) ) $admin->fail('empty');
					if ( empty($my['type']) ) $my['type'] = 'default';
					if ( empty($my['image']) ) $my['image'] = 'no-image.png';
					if ( empty($my['url']) ) $my['url'] = $cms->trans($my['name']);
					foreach ( $my as $value ) {
						if ( empty($value) ) die(false);
					}
					$datetime = time();

					$query = sprintf('INSERT INTO `products` (
						product_name,
						product_price,
						product_old_price,
						product_image,
						product_type,
						category_id,
						product_description,
						product_delivery,
						product_rating,
						product_colors,
						product_url,
						datetime
						) VALUES("%s", %u, %u, "%s", "%s", %u, "", "", 0, "","%s",%u)',
						$my['name'],
						$my['price'],
						$my['price'],
						$my['image'],
						$my['type'],
						$my['category'],
						$my['url'],
						$datetime
					);
					$mysqli_res = $db->call( $query );
					if (!empty($mysqli_res)) {
						$result = array();
						$tmp = array();

						$tmp['product_id'] = $db->last_insert_id();
						$tmp['product_name'] = $my["name"];
						$tmp['product_price'] = $my["price"];
						if (!empty($my["old_price"])) $tmp['product_old_price'] = $my["old_price"];
						$tmp['product_image'] = $cms->src(PRODUCT_IMG.SMALL_IMG_SIZE.$my["image"]);
						$tmp['product_type'] = $my["type"];
						$tmp['category_id'] = $my["category"];
						$tmp['product_datetime'] = $datetime;
						
						$query = sprintf("INSERT INTO `products_details` (
							product_id,
							details
							) VALUES(%u, '%s')",
							$tmp['product_id'],
							''
						);
						$db->call( $query );

						$mysqli_res = $db->call("SELECT * FROM `categories`");
						$categories = $db->fetch_array($mysqli_res);
						foreach ($categories as $category) {
							if ( $category["category_id"] == $my["category"] ) {
								$tmp["product_category"] = $category["category_name"];
								$tmp["product_category_id"] = $category["category_id"];
								break;
							}
						}

						$dir = ROOT.DIR_SITE.PATH_SITE.PRODUCT_IMG.ORIGINAL_IMG_SIZE.$tmp["product_id"];
						if (!is_dir($dir)) {
							mkdir($dir);
						}
						$dir = ROOT.DIR_SITE.PATH_SITE.PRODUCT_IMG.LARGE_IMG_SIZE.$tmp["product_id"];
						if (!is_dir($dir)) {
							mkdir($dir);
						}
						$dir = ROOT.DIR_SITE.PATH_SITE.PRODUCT_IMG.MIDDLE_IMG_SIZE.$tmp["product_id"];
						if (!is_dir($dir)) {
							mkdir($dir);
						}
						$dir = ROOT.DIR_SITE.PATH_SITE.PRODUCT_IMG.SMALL_IMG_SIZE.$tmp["product_id"];
						if (!is_dir($dir)) {
							mkdir($dir);
						}

						$result = JSON_encode($tmp);
						exit($result);
					}
					else {
						exit('false');
					}
					break;
				default:
					$admin->error("ajax-error");
					break;
			}
		}
		break;
	case 'products_details':
		if ( isset( $_POST["do"]["id"] ) ) {
			switch ( $_POST["do"]["what"] ) {
				case 'update':
					$db->update(
						$_POST["do"]["with"],
						$_POST["do"]["change"],
						$_POST["do"]["set"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				default:
					$admin->error("ajax-error");
					break;
			}
		}
		break;
	case 'news':
		if ( isset( $_POST["do"]["id"] ) ) {
			switch ( $_POST["do"]["what"] ) {
				case 'update':
					$db->update(
						$_POST["do"]["with"],
						$_POST["do"]["change"],
						$_POST["do"]["set"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				case 'remove':
					$db->delete(
						$_POST["do"]["with"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				default:
					$admin->fail('unknown','do.what = '.$_POST["do"]["what"]);
					break;
			}
		}
		else {
			switch ( $_POST["do"]["what"] ) {
				case 'add':
					$my = $_POST["do"]["element"];
					foreach ( $my as $key => $value ) {
						if ( $value == "" ) $admin->fail('empty', 'do.element.'.$key);
					}
					$my["views"] = 0;
					$my["date"] = time();
					$values = $my["date"]. ',' .$my["views"]. ',"' .$my['text']. '"';
					$link = $db->call("INSERT INTO `news` VALUES(0," .$values. ")");
					echo $db->last_insert_id();
					exit;
					break;
				default:
					$admin->fail();
					break;
			}
		}
		break;
	case 'options':
		if ( isset( $_POST["do"]["id"] ) ) {
			switch ( $_POST["do"]["what"] ) {
				case 'update':
					$db->update(
						$_POST["do"]["with"],
						$_POST["do"]["change"],
						$_POST["do"]["set"],
						$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
					) or exit('false');
					exit('true');
					break;
				default:
					$admin->error("no switched act (options)");
					break;
			}
		}
		$admin->fail('dump');
		exit;
	default:
		$admin->error("ajax-error");
		$admin->fail('dump');
		break;
	}
}
ok();

// if (isset($_FILES['product_images'])) {
// 	$img		= $_FILES['product_images'];
// 	$dir		= ROOT . DIR_SITE . PATH_SITE . PRODUCT_IMG;
// 	# list of permitted file extensions
// 	$allowed	= array('png', 'jpg', 'jpeg', 'ico', 'gif');

// 	if ($img['error'] == 0) {
// 		$extension = pathinfo($img['name'], PATHINFO_EXTENSION);

// 		if (!in_array(strtolower($extension), $allowed)) {
// 			exit('{"status":"error","error":"not allowed extension for product photos"}');
// 		}
		
// 		//$db->call('SELECT `users` SET user_image="' . $newname . '" WHERE user_id=' . $_SESSION['customer']['id']);
// 		$newname = $_SESSION['customer']['id'] . '.' . $extension;

// 		if (!is_dir($dir)) {
// 			mkdir($dir);
// 		}
// 		$to = $dir . $newname;

// 		if (move_uploaded_file($img['tmp_name'], $to)) {
// 			$db->call('UPDATE `products` SET product_images="' . $newname . '" WHERE user_id=' . $_SESSION['customer']['id']);
// 			exit('{"status":"success","product_images":"' . HOST . DIR_SITE . PATH_SITE . PRODUCT_IMG . $newname . '"}');
// 		}
// 	}
// 	exit('{"status":"error","error":"upload error"}');
// 	break;
// }


if (isset($result)) echo JSON_encode($result);