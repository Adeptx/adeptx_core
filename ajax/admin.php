<?

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


	# необходимо настроить только для административных функций, функций изменения и удаления, а считывание товаров например нет смысла ограничивать
	if ( $_SESSION['admin']['online'] != true ) {
		$admin->fail('access-denied');
	}

if ( !empty($_FILES) ) {
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
if ( isset( $_POST['do'] ) ) {

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
			if ( empty($_POST['do']['sort']) ) $_POST['do']['sort'] = $where_names[$_POST['do']['from']];	// 'id'
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
					echo 'do';
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
					if ($_POST["do"]["change"] == 'details') {
						$db->update(
							$_POST["do"]["with"],
							$_POST["do"]["change"],
							$_POST["do"]["set"],
							$where_names[$_POST["do"]["with"]],$_POST["do"]["id"]
						) or exit('false');
						exit('true');
					}
					
					foreach ($_POST["do"] as $key=>$do) {
						if (is_string($do)) {
							$s[$key] = '"%s"';
							$_POST["do"][$key] = $db->real_escape_string($do);
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
				case 'setup':

	// js sent to ajax $('#site-options').val()
	$new_conf = json_decode($_POST["do"]["set"], true);
	if ($new_conf) {
		$pretty_new_conf = json_encode($new_conf, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		if ($pretty_new_conf) {
			// we write new conf as conf/user/ and include it after default conf to rewrite
			// файл должен иметь правильное имя, необходимо проверить
			$f = fopen($_POST["do"]["with"], 'w');
			if (fwrite($f, $pretty_new_conf)) exit('true');
		}
	}
	exit('false');
	
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