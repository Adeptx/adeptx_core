<?
class products {
	var $names;
	function init(){
		
	}
	function getProductImagesLinks($product_id, $cut=false) {
		global $cms;
		$real_dir = $fold['images'] . 'product/chairschairs/';
		$imgs_names = scandir($real_dir.'original/'.$product_id.'/');
		unset($imgs_names[0], $imgs_names[1]);
		$product_images = array();
		foreach ($imgs_names as $im) {
			if ($cut) {
				$product_images[] = $im;
			}
			else {
				$product_images[] = $cms->src( $real_dir.'80x80/'.$product_id.'/'.$im );
			}
		}
		if (empty($product_images)) {
			if ($cut) {
				$product_images = 'no-image.png';
			}
			else {
				$product_images = array( $cms->src( $fold['images'] . 'product/no-image.png' ) );
			}
		}
		return $product_images;
	}
	function product_full_path(){
		if ( func_num_args() > 0) {
			$product_id = func_get_arg(0);
		}
		if ( func_num_args() > 1) {
			$flag = func_get_arg(1);
		}

		global $db;
		$tmp = $db->call("SELECT * FROM `products` WHERE product_id=".$product_id." LIMIT 1");
		if ($tmp) {
			$product = array();
			$product = $db->fetch_array($tmp);
			if ( !empty($product) ) {
				$tmp = $db->call("SELECT * FROM `categories` WHERE category_id=".$product[0]['category_id']);
				if ($tmp) {
					$category = array();
					$category = $db->fetch_array($tmp);
					if ( !empty($category) ) {
						if ( isset($flag) ) {
							return $category[0]['category_url']."/".$product[0]['product_url'];
						}
						else {
							echo $category[0]['category_url']."/".$product[0]['product_url'];
						}
					}
					else return false;
				}
				else return false;
			}
			else return false;
		}
		else return false;
	}
	function formatPrice( $price, $return_result=false ){
		if ( isset($_SESSION['shop']['course']) ) {
			$result = round( $price * $_SESSION['shop']['course'] );
			$result = preg_replace('/(\d)(?=(\d{3})+(?!\d))/', '$1 ', $result);
			$result = $result.' руб.';
			if ( $return_result ) return $result;
			else echo $result;
		}/*
		// это временный код, который следует удалить после переноса сайта
		else {
			$result = round( $price * 55 );
			$result = preg_replace('/(\d)(?=(\d{3})+(?!\d))/', '$1 ', $result);
			$result = $result.' руб.';
			if ( $return_result ) return $result;
			else echo $result;
		}*/
	}
	function formatProductBlock($product, $num=false) {
		global $global;
		foreach ($global as $var) {
			global $$var;
		}

		$original_img_dir	= sprintf(
			$product_image['dir'],
			$product_image['original'],
			$product["product_id"]
		);
		$large_img_dir		= sprintf(
			$product_image['dir'],
			$product_image['large'],
			$product["product_id"]
		);
		$middle_img_dir		= sprintf(
			$product_image['dir'],
			$product_image['middle'],
			$product["product_id"]
		);
		$small_img_dir		= sprintf(
			$product_image['dir'],
			$product_image['small'],
			$product["product_id"]
		);

		$imgs_names = scandir($original_img_dir);
		unset($imgs_names[0], $imgs_names[1]);
		if (isset($imgs_names[2])) $main_img = $imgs_names[2];
		else $main_img = $product_image['no_exist'];
		if (isset($imgs_names[2])) $second_img = $imgs_names[3];
		else $second_img = $product_image['no_exist'];

		// большое изображение
		if ( is_readable( $original_img_dir.$second_img ) ) {
			$zoom_img_link = $cms->src( $original_img_dir.$second_img );
		}
		else {
			$zoom_img_link =  $product_image['no_exist'];
		}
		// показываемое изображение
		if ( is_readable( $middle_img_dir.$main_img ) ) {
			$main_image_src = $cms->src( $middle_img_dir.$main_img );
		}
		else {
			$main_image_src = $product_image['no_exist'];
		}
		// изображение при наведении
		if ( is_readable( $middle_img_dir.$second_img ) ) {
			$second_image_src = $cms->src( $middle_img_dir.$second_img );
		}
		else {
			$second_image_src = $product_image['no_exist'];
		}

		$product_block  = '<div';

			if ($num) $product_block .= ' num="'. $product["product_id"] .'"';

			$product_block .= ' class="product-block '. $product["product_type"] .'">
				<div class="product-image-container">';

				if ($zoom_img_link != $no_img) {
					$product_block .= "<a href='$zoom_img_link'>
						<img class='product-image' src='$main_image_src' data-main='$main_image_src' data-second='$second_image_src'>
						</a>";
				}
				else {
					$product_block .= "<img class='product-image' src='$main_image_src' data-main='$main_image_src' data-second='$second_image_src'>";
				}

			$product_block .= "</div>";

			if (!empty($product["product_old_price"]) && $product["product_old_price"] > $product["product_price"] && $product["product_type"] == 'discount') {
				$product_block .= '<div class="product-old-price currency" data-real-price="'. $product["product_old_price"] .'"><strike>'. $this->formatPrice($product["product_old_price"], true) .'</strike></div>';
			}
			$product_block .= '<div class="product-price currency" data-real-price="'. $product["product_price"] .'">'. $this->formatPrice($product["product_price"], true).'</div>
			<a href="'. $base['href'] . $this->product_full_path($product['product_id'], true) .'">
				<div class="product-name">'. $product["product_name"] .'</div>
				<input type="button" class="lang-phrase" data-en="button_product_buy" value="'. $dic['chairschairs']['button_product_buy'] .'">
			</a>
		</div>';
		return $product_block;
	}
	function show(){
		global $global;
		foreach ($global as $var) {
			global $$var;
		}
		
		if ( func_num_args() > 2) {
			$type = func_get_arg(0);
			$start = func_get_arg(1);
			$quantity = func_get_arg(2);
		}
		if ( func_num_args() > 3) {
			$id = func_get_arg(3);
		}

		if ($start < 1) $start = 1;

		switch ( $type ) {
			case 'random':
				$query = "products";
				$tmp = $db->call("SELECT * FROM ".$query." LIMIT " .($start-1)*$quantity. ",".$quantity);
				break;
			case 'hits':
				$query = "products WHERE product_type='hit'";
				$tmp = $db->call("SELECT * FROM ".$query." LIMIT " .($start-1)*$quantity. ",".$quantity);
				break;
			case 'categories':
				$query = "products WHERE category_id=".$id;
				$tmp = $db->call("SELECT * FROM ".$query." LIMIT " .($start-1)*$quantity. ",".$quantity);
				break;
			case 'subcategories':
				$query = "products WHERE product_subcategory_id=".$id;
				$tmp = $db->call("SELECT * FROM ".$query." LIMIT " .($start-1)*$quantity. ",".$quantity);
				break;
			case 'buymore':
				// выборка товаров "с этим также покупают"
				$query = "products";
/*
				$tmp = $db->call("SELECT COUNT(*) FROM products WHERE product_type='discount' OR product_type='hit' OR product_type='actia'");
				$count = $db->fetch_row($tmp);
				$count = (int)$count[0][0];	// count();
				$start = rand(0, $count - 3); // так?

				$tmp = $db->call("SELECT * FROM products WHERE product_type='discount' OR product_type='hit' OR product_type='actia' LIMIT ".$start.",3");
				$discounts = $db->fetch_array($tmp);
*/
				$tmp = $db->call("SELECT * FROM ".$query." LIMIT " .($start-1)*$quantity. ",".$quantity);
				break;
			default: return; break;
		}

		if ($tmp) $productsarray = $db->fetch_array($tmp);
		if (empty($productsarray)) {
			?>
			<div id="so-sorry">
			Приносим свои глубочайшие извинения, но, к нашему величайшему сожалению, 
			мы еще не добавили на сайт товары, которые должны отображаться на данной странице. 
			Попробуйте заглянуть чуть позже, 
			а пока Вы можете попробовать выбрать другую страницу или перейти на <a href="<?=$base['href']?>">главную</a>.
			</div>
			<?php
			return;
		}

		for ($i = 0; $i < $quantity, !empty($productsarray[$i]); $i++) {
			echo $this->formatProductBlock($productsarray[$i], $num=true);
		}
		
	}
	function pages() {
		global $db;

		if ( func_num_args() > 2) {
			$type = func_get_arg(0);
			$page = func_get_arg(1);
			$quantity = func_get_arg(2);
		}
		if ( func_num_args() > 3) {
			$id = func_get_arg(3);
		}

		switch ($type) {
			case 'random': $query = "products"; $link = $base['href']; break;
			case 'hits': $query = "products WHERE product_type='hit'"; $link = "/"; break;
			case 'categories':
				$query = "products WHERE category_id=".$id;
				$tmp = $db->call("SELECT * FROM `categories` WHERE category_id=".$_GET["id"]." LIMIT 1");
				if ($tmp) {
					$category = array();
					$category = $db->fetch_array($tmp);
					if ( count($category) > 0) {
						$link = $base['href'].$category[0]['category_url']."/";
					}
					else {
						// нет такой категории
					}
				}
				else {
					// ошибка бд
				}
				break;
			case 'subcategories':
				$query = "products WHERE product_subcategory_id=".$id;
				$tmp = $db->call("SELECT * FROM `subcategories` WHERE subcategory_id=".$_GET["id"]." LIMIT 1");
				if ($tmp) {
					$subcategory = $db->fetch_array($tmp);
					if ( !empty($subcategory) ) {
						$mysqlResult = $db->call('SELECT * FROM `categories` WHERE category_id='.$subcategory[0]['category_id'].' LIMIT 1');
						if ( $mysqlResult ) {
							$category = $db->fetch_array( $mysqlResult );
							if ( !empty($category) ) {
								$link = $base['href'].$category[0]['category_url']."/".$subcategory[0]['subcategory_url']."/";
							}
							else {
								// нет такой категории
							}
						}
						else {
							// mysql error
						}
					}
					else {
						// нет такой подкатегории
					}
				}
				else {
					// mysql error
				}

				return;
				break;
			default: return; break;
		}
		
		global $db;
		if ( $page < 3 ) $page_middle = 3;
		else $page_middle = $page;
		?>
						<div class="arrows">
							<a<?php if ($page > 1) echo  ' href="'.$base['href'].$link.($page-1). '/"'; ?>>
								<div class="arrows-previous">&lt;</div>
							</a>
						<?php
							for ( $i = 0; $i < 5; $i++ ) {
								?>
							<a<?php
								$tmp = $db->call("SELECT * FROM ".$query." LIMIT ".(($page_middle+$i-3)*$quantity).",".$quantity);
								if ($tmp) {
									$tmp2 = array();
									$tmp2 = $db->fetch_array($tmp);
									if ( count($tmp2) > 0 ) {
										echo  ' href="'.$base['href'].$link.($page_middle+$i-2). '/"';
									}
									else {
										// нет результатов
									}
								}
								else {
									// ошибка дб
								}
							?>>
								<?php
									if ($page == ($page_middle+$i-2)) {
										echo '<div class="arrows-page active">';
									}
									else {
										echo '<div class="arrows-page">';
									}
								echo ($page_middle+$i-2);
								?></div>
							</a>
								<?php
							}
						?>
							<a<?php
								$tmp = $db->call("SELECT * FROM ".$query." LIMIT ".($page*$quantity).",".$quantity);
								if ($tmp) {
									$tmp2 = array();
									$tmp2 = $db->fetch_array( $tmp );
									if ( count($tmp2) > 0 ) {
										echo ' href="'.$base['href'].$link .($page+1). '/"';
									}
									else {
										// нет результатов
									}
								}
								else {
									// ошибка бд
								}
							?>>
								<div class="arrows-next">&gt;</div>
							</a>
						</div>
						
		<?php
	}
}