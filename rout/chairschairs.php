<?
	# можно формировать хлебные крошки исходя из адреса сайта (папка=категория)
	# for download file use syntax: www/download?file=dirname/filename.php

	/* skip link need new scripts and style for pages. we can load them async with adding new tag <script>...*/

	// if (preg_match('!sale/.*!', $page['url'])) {
	// 	if (empty($page['path'])) $page['path'] = 'information';
	// }

# рекомендованный знак разделения слов в ЧПУ это знак дефиса "-" (http://habrahabr.ru/post/136762/)

if ( preg_match("!^/.*/!", $page['url']) ) {
	$url = explode( "/", $page['url'] );
	$tail = parse_url( $url[ count($url) - 1 ] );
	$cms->path = $tail['path'];
	$dir = array();
	for ($i = 1; $i < count($url) - 1; $i++) {
		$dir[] = $url[$i];
	}

	if ( $id = if_category( $dir[0] ) ) {
		if ( !empty($dir[1]) ) {
			// подкатегория либо страница категории page
			if ( isset($dir[1]) && is_numeric($dir[1]) ) {
				// page у категории
				$_GET['id'] = $id;
				$_GET['page'] = $dir[1];
				$cms->path = "categories.php";
				$page['path'] = 'categories';
			}
			else {
				if ( $sub = if_subcategory( $dir[1] ) ) {
					if ( isset($dir[2]) && is_numeric($dir[2]) ) {
						// page у подкатегории
						$_GET['id'] = $sub['id'];
						$_GET['sub'] = $sub['sub'];
						$_GET['page'] = $dir[2];
						$cms->path = "subcategories.php";
						$page['path'] = 'subcategories';
					}
					else {
						// неизвестная страница
					}
				}
				else {
					// неизвестная страница
				}
			}
		}
		else {
			if ( $sub = if_subcategory( $cms->path ) ) {
				// категория/подкатегория
				$_GET['id'] = $sub['id'];
				$_GET['sub'] = $sub['sub'];
				$_GET['page'] = $url[2]; // $dir[2];
				$cms->path = "subcategories.php";
				$page['path'] = 'subcategories';
			}
			else {
				if ( $id = if_product( $cms->path ) ) {
					//категория/товар
					$_GET['id'] = $id;
					$cms->path = "product.php";
					$page['path'] = 'product';
				}
				else {
					// неизвестная страница
				}
			}
		}
	}
	else {
		if ( isset($dir[0]) ) {
			if (is_numeric($dir[0]) ) {
				$_GET['page'] = $dir[0];
				$cms->path = "index.php";
				$page['path'] = 'main';
			}
		}
		else {
			// неизвестная страница
		}
	}
}
else { 
	$url = explode( "/", $page['url'] );
	$tail = parse_url( $url[ count($url) - 1 ] );
	if ( isset($tail['path']) ) {
		$cms->path = $tail['path'];
	}
	// провести проверку $page['url'] на названия всех категорий
	// если его нет в категориях, значит это страница.
	$id = if_category( $cms->path );
	if ( $id ) {
		$_GET['id'] = $id;
		$cms->path = "categories.php";
		$page['path'] = 'categories';
	}
	else {
		// неизвестная страница
	}
}


switch ($page['url']) {
	case "PHPSESSID":
		echo JSON_encode( $_SESSION );
		exit();
		break;
}

// if ( !$cms->path ) $cms->path = "index.php";
// $parse->call( $cms->path );


function if_category( $candidate ){
	global $db;
	global $cms;
	$id = false;
	$tmp = $db->call("SELECT * FROM `categories`");
	if ( $tmp ) {
		$categories = array();
		$categories = $db->fetch_array( $tmp );
		if ( count( $categories ) > 0 ) {
			$not = true;
			foreach ( $categories as $category ) {
				if ( $category['category_url'] == $candidate ) {
					$not = false;
					$id = $category['category_id'];
					break;
				}
			}
			if ($not) {
				// это не категория
			}
		}
		else {
			// в бд нет категорий
		}
	}
	else {
		// ошибка бд
	}
	return $id;
}

function if_subcategory( $candidate ){
	global $db;
	global $cms;
	$result = array();
	$tmp = $db->call("SELECT * FROM `subcategories`");
	if ( $tmp ) {
		$subcategories_arr = array();
		$subcategories_arr = $db->fetch_array( $tmp );
		if ( count( $subcategories_arr ) > 0 ) {
			$not = true;
			foreach ( $subcategories_arr as $subcategory ) {
				if ( $subcategory['subcategory_url'] == $candidate ) {
					$not = false;
					$result['id'] = $subcategory['category_id'];
					$result['sub'] = $subcategory['subcategory_id'];
					break;
				}
			}
			if ($not) return false;
		}
		else return false;
	}
	else return false;
	return $result;
}

function if_product( $candidate ){
	global $db;
	global $cms;
	$id = false;
	$tmp = $db->call("SELECT * FROM `products`");
	if ( $tmp ) {
		$products = array();
		$products = $db->fetch_array( $tmp );
		if ( count( $products ) > 0 ) {
			$not = true;
			foreach ( $products as $product ) {
				if ( $product['product_url'] == $candidate ) {
					$not = false;
					$id = $product['product_id'];
					break;
				}
			}
			if ($not) {
				// это не товар
			}
		}
		else {
			// в бд нет категорий
		}
	}
	else {
		// ошибка бд
	}
	return $id;
}





// if (preg_match('!sale/.*!', $page['url'])) {
// 	if (empty($page['path'])) $page['path'] = 'information';
// }

# рекомендованный знак разделения слов в ЧПУ это знак дефиса "-" (http://habrahabr.ru/post/136762/)

switch($page['url']) {
	case '':
		$page['alias'] = 'main';
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = 'heading-hits';
		break;

	case 'product':
	case "cart":
		$page['alias'] = $page['url'];
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		break;

	case "profile":
		$page['alias'] = $page['url'];
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';
		break;
	case "hits":
		// $_GET['show'] = 'hits';
		$page['alias'] = 'main';
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		//	$page['heading'] = 'Хиты продаж';
		break;
	case "registration":
		// $_GET['reg'] = "true";
		$page['alias'] = 'profile';
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = 'heading-' . $page['url'];
		break;
	case 'partnership':
	case 'contacts':
	case 'about_us':
	case 'service':
	case 'sitemap':
	case 'vacancies':
		$page['heading'] = 'heading-' . $page['url'];
		$page['alias'] = 'information';
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		break;
	case 'news':
		$page['alias'] = $page['url'];
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		if (!empty($news['news_title'])) {
			$page['heading'] = $news['news_title'];
		} else {
			$page['heading'] = 'НОВОСТЬ';
		}
		break;
	default:
		header($header[404]);
		$page['path'] = $fold['templates'] . $fold['404'] . '/404' . $site['extensions'];
		# $page['url'] not changed, you can use it in the page, like: "page $page['url'] not found"
		# $mysqli->query('INSERT INTO `' . $database['prefix'] . 'user` (email, hash, salt) VALUES ("' . $email . '","' . $hash . '","' . $salt . '")') or die('MySQL error #3');
	}