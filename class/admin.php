<? # for backward compatibility

class admin {
	var $template;
	function init() {
		$this->template = '/';
		$this->check_tables();
	}
	function check_tables(){
		global $db;
		$musthave = [
			"admins",
			"categories",
			"products",
			"reviews",
			"users",
			"news",
			"infopages",
			"articles",
			"orders",
			"products_details",
			"pictures_colors",
			"subcategories",
			"options",
			"customers"
		];
		$notexists = $db->tables_that_not_exist( $musthave );
		
		foreach ($notexists as $table) {
			switch ( $table ) {
				case "customers":
					$vars = [
						 ["customer_id","INT","11"]
						,["customer_ip","VARCHAR","255"]
						,["customer_visit","VARCHAR","255"]
						,["datetime","BIGINT","20"]
					];
					break;
				case "admins":
					$vars = array(
						array("admin_id","INT","11"),
						array("login","VARCHAR","255"),
						array("hash","VARCHAR","255")
					);
					break;
				case "categories":
					$vars = array(
						array("category_id","INT","11"),
						array("category_order","INT","11"),
						array("category_name","VARCHAR","255"),
						array("datetime","BIGINT","20"),
						array("category_url","VARCHAR","255")
					);
					break;
				case "products":
					$vars = array(
						array("product_id","INT","11"),
						array("product_name","VARCHAR","255"),
						array("product_price","INT","11"),
						array("product_old_price","INT","11"),
						array("product_image","VARCHAR","255"),
						array("product_type","VARCHAR","255"),
						array("category_id","INT","11"),
						array("datetime","BIGINT","20"),
						array("product_url","VARCHAR","255"),
						array("product_rating","INT","11"),
						array("product_description","VARCHAR","65535"),
						array("product_delivery","VARCHAR","255"),
						array("product_colors","SET","'color_0','color_1','color_2','color_3','color_4','color_5','color_6','color_7','color_8','color_9','color_10','color_11','color_12','color_13','color_14'"),
						array("product_subcategory_id","INT","11")
					);
					break;
				case "reviews":
					$vars = array(
						array("review_id","INT","11"),
						array("product_id","INT","11"),
						array("review_author","VARCHAR","255"),
						array("review_text","VARCHAR","255")
					);
					break;
				case "users":
					$vars = array(
						array("user_id","INT","11"),
						array("user_first_name","VARCHAR","255"),
						array("user_last_name","VARCHAR","255"),
						array("user_sex","INT","11"),
						array("user_image","VARCHAR","255"),
						array("user_email","VARCHAR","255"),
						array("user_hash","VARCHAR","255")
					);
					break;
				case "news":
					$vars = array(
						array("news_id","INT","11"),
						array("news_title","VARCHAR","255"),
						array("news_public","INT","1"),
						array("news_preview","VARCHAR","255"),
						array("news_text","VARCHAR","65535"),
						array("news_views","INT","11"),
						array("news_date","BIGINT","20")
					);
					break;
				case "infopages":
					$vars = array(
						array("infopage_id","INT","11"),
						array("infopage_text","TEXT","65535"),
						array("infopage_public","TINYINT","1"),
						array("infopage_views","INT","11"),
						array("infopage_link","VARCHAR","255")
					);
					break;
				case "articles":
					$vars = array(
						array("article_id","INT","11"),
						array("article_title","VARCHAR","255"),
						array("article_text","TEXT","65535"),
						array("article_public","TINYINT","1"),
						array("article_views","INT","11"),
						array("article_date","BIGINT","20")
					);
					break;
				case "orders":
					$vars = array(
						array("order_id","INT","11"),
						array("order_user_id","INT","11"),
						array("order_user_name","VARCHAR","256"),
						array("order_user_email","VARCHAR","256"),
						array("order_user_phone","VARCHAR","256"),
						array("order_total","INT","11"),
						array("order_paymethod","VARCHAR","20"),
						array("order_status","TINYINT","1"),
						array("datetime","BIGINT","20")
					);
					break;
				case "products_details":
					$vars = array(
						array("detail_id","INT","11"),
						array("product_id","INT","11"),
						array("details","TEXT","65535")
					);
					break;
				case "pictures_colors":
					$vars = array(
						array("picture_color_id","INT","11"),
						array("product_id","INT","11"),
						array("product_color","VARCHAR","255"),
						array("product_picture","VARCHAR","255")
					);
					break;
				case "subcategories":
					$vars = array(
						array("subcategory_id","INT","11"),
						array("category_id","INT","11"),
						array("subcategory_name","VARCHAR","255"),
						array("datetime","BIGINT","20"),
						array("subcategory_url","VARCHAR","255")
					);
					break;
				case "options":
					$vars = array(
						array("option_id","INT","11"),
						array("option_name","VARCHAR","255"),
						array("option_value","VARCHAR","255"),
						array("option_rewriter","INT","11"),
						array("datetime","BIGINT","20")
					);
					break;
			}
			$db->create_table($table, $vars);
		}
	}
	function error($err) {
		switch ($err) {
			case "autorization":
				echo "<p>autorization error</p>";
				die();
				break;
			case "ajax-error":
				die('{"error":"ajax error"}');
				break;
			default:
				die("admin->error");
				break;
		}
	}
	function tpl(){
		echo $this->template;
	}
	function link( $short ){
		echo $this->template.$short;
	}

function ok(){
	echo 'true';
	#	if (isset($result)) echo JSON_encode($result);
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

function loadMore( $items ) {
	global $db, $products;

	$query = sprintf(
		"SELECT * FROM `%s` ORDER BY %s %s LIMIT %s,%s",
		$items,
		$_POST["do"]["sort"],
		$_POST["do"]["order"],
		$_POST["do"]["start"],
		$_POST["do"]["quantity"]
	);

	$result = false;

	switch ( $items ) {
		case "products":
		case "categories":
		case "users":
		case "infopages":
		case "news":
		case "articles":
		case "options":
			$db_result = $db->call($query);
			$result = $db->fetch_array($db_result);
			break;
		default:
			fail("loadMore(unknown_items): '$items'");
			break;
	}
	switch ( $items ) {
		case "products":
			foreach($result as $i=>$product) {
				$result[$i]["product_images"] = $products->getProductImagesLinks($product["product_id"]);
			}
			break;
		case "news":
			foreach ($result as $k=>$v) {
				$result[$k]['news_date'] = date('d/m/Y', $v['news_date']);
			}
			break;
		case "articles":
			foreach ($result as $k=>$v) {
				$result[$k]['article_date'] = date('d/m/Y', $v['article_date']);
			}
			break;
	}
	exit( JSON_encode( $result ) );
}



	function user_autorized(){
		global $db;
		
		if ( $db->table_exist( "admins" ) ){
			
			if ( !empty( $_SESSION["admin"]["login"] ) && !empty( $_SESSION["admin"]["hash"] ) ) {				
				$tmp = $db->call("SELECT * FROM `admins` WHERE login='".$_SESSION["admin"]["login"]."' LIMIT 1");
				$user = $db->fetch_array( $tmp );
				$user = $user[0];

				if ( strcasecmp($user["hash"], $_SESSION["admin"]["hash"]) == 0 ) {
					return true;
				}
			}
			
			return false;
		}
		// вывести сообщение, что данные для доступа отсутствуют
		// нет таблицы, где должны храниться данные доступа
		return false;
	}
	function insert( $what ){
		foreach ($GLOBALS['global'] as $var) {
			global $$var;
		}

		switch ( $what ) {
			case "great-gatsby":
				?>
<div id="<?php echo $what; ?>">
	<div id="window" style="display: none;">
		<div class="window-close close"></div>
		<div class="window-title"></div>
		<div class="window-content"></div>
	</div>
</div>
				<?php
				break;

			case "msg-products-details":
				?>
<div class="invisible">
	<div id="msg-product-details-title"><?=$lang->phrase('product-details-title')?></div>
	<div id="msg-product-details-body">
		<table id="product-details" data-product-id="0">
			<tr class="line" hidden>
				<td class="left"><?=$lang->phrase('product-details-rating-fild')?></td>
				<td class="right">
					<p>4.37 / 20 <?=$lang->phrase('product-details-rating-fild2')?></p>
				</td>
			</tr>
			<tr class="line" hidden>
				<td class="left"><?=$lang->phrase('product-details-url-fild')?></td>
				<td class="right">
					<input placeholder="<?=$lang->give('product-details-url-placeholder')?>">
				</td>
			</tr>
			<tr class="line">
				<td class="left"><?=$lang->phrase('product-details-colors-fild')?></td>
				<td class="right">
				<div id="filter-colors">
					<span class="filter-color" id="color-0" data-color="0"></span>
					<span class="filter-color" id="color-1" data-color="1"></span>
					<span class="filter-color" id="color-2" data-color="2"></span>
					<span class="filter-color" id="color-3" data-color="3"></span>
					<span class="filter-color" id="color-4" data-color="4"></span>
					<span class="filter-color" id="color-5" data-color="5"></span>
					<span class="filter-color" id="color-6" data-color="6"></span>
					<span class="filter-color" id="color-7" data-color="7"></span>
					<span class="filter-color" id="color-8" data-color="8"></span>
					<span class="filter-color" id="color-9" data-color="9"></span>
					<span class="filter-color" id="color-10" data-color="10"></span>
					<span class="filter-color" id="color-11" data-color="11"></span>
					<span class="filter-color" id="color-12" data-color="12"></span>
					<span class="filter-color" id="color-13" data-color="13"></span>
					<span class="filter-color" id="color-14" data-color="14"></span>
				</div>
				</td>
			</tr>
			<tr class="line">
				<td class="left"><?=$lang->phrase('product-details-characteristics-fild')?></td>
				<td class="right">
					<textarea class="product-characteristics"></textarea>
				</td>
			</tr>
			<tr class="line">
				<td class="left"><?=$lang->phrase('product-details-description-fild')?></td>
				<td class="right">
					<textarea class="product-description" placeholder="<?=$lang->give('product-details-description-fild')?>" value="<?=$lang->give('product-details-description-fild')?>"></textarea>
				</td>
			</tr>
			<tr class="line">
				<td class="left"><?=$lang->phrase('product-details-delivery-fild')?></td>
				<td class="right">
					<textarea class="product-delivery" placeholder="<?=$lang->give('product-details-delivery-placeholder')?>" value="<?=$lang->give('product-details-delivery-placeholder')?>"></textarea>
				</td>
			</tr>
			<tr class="line" hidden>
				<td class="left"><?=$lang->phrase('product-details-reviews-fild')?></td>
				<td class="right">
					<?=$lang->phrase('product-details-reviews-placeholder')?>
				</td>
			</tr>
			<tfoot>
				<tr>
					<tr id="details-loading">
						<td colspan="9">
							<img width="32" height="8" src="<?='img/loading/loading-orange.gif' ?>">
						</td>
					</tr>
					<td colspan="2">
						<input id="product-details-save" type="submit" value="<?=$lang->give('product-details-save')?>">
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
				<?php
				break;

			case "msg-products-images":
				?>
<div class="invisible">
	<div id="msg-product-images-title"><?=$lang->phrase('product-images-title')?></div>
	<div id="msg-product-images-body">
		<form id="product-images-form" method="post" enctype="multipart/form-data" target="hiddenframe">
			<table id="product-images">
				<tr class="line">
					<td class="left">
						<?=$lang->phrase('product-images-title')?>
					</td>
					<td class="right">
						<input hidden name="act" value="upload_images">
						<input hidden id="product-id" name="id" value="0">
						<input hidden id="images-color" name="color" value="color-0">
						<!-- Можно создать здесь поле невидимых чекбоксов, а вместо span использовать label для выбора -->

						<input type="file" name="product_images[]" multiple>
						<a>
							<img id="product-image" src="img/uploader/add-file.png" alt="product_photo" title="<?=$lang->give('product-images-photo-fild-title')?>">
						</a>
					</td>
				</tr>
					<tr>
						<tr id="images-loading" style="display: none;">
							<td colspan="9">
								<img width="32" height="8" src="<?='img/loading/loading-orange.gif'?>">
							</td>
						</tr>
						<td colspan="2">
							<input id="product-images-save" type="submit" value="<?=$lang->give('product-images-save-fild')?>" title="<?=$lang->give('product-images-save-fild-title')?>">
						</td>
					</tr>
				<!-- <tr class="line">
					<td class="left">
						<p><?=$lang->phrase('product-images-color-fild')?></p>
					</td>
					<td class="right">
		<div id="filter-colors">
			<span class="filter-color active" id="color-0" data-color="0"></span>
			<span class="filter-color" id="color-1" data-color="1"></span>
			<span class="filter-color" id="color-2" data-color="2"></span>
			<span class="filter-color" id="color-3" data-color="3"></span>
			<span class="filter-color" id="color-4" data-color="4"></span>
			<br>
			<span class="filter-color" id="color-5" data-color="5"></span>
			<span class="filter-color" id="color-6" data-color="6"></span>
			<span class="filter-color" id="color-7" data-color="7"></span>
			<span class="filter-color" id="color-8" data-color="8"></span>
			<span class="filter-color" id="color-9" data-color="9"></span>
			<br>
			<span class="filter-color" id="color-10" data-color="10"></span>
			<span class="filter-color" id="color-11" data-color="11"></span>
			<span class="filter-color" id="color-12" data-color="12"></span>
			<span class="filter-color" id="color-13" data-color="13"></span>
			<span class="filter-color" id="color-14" data-color="14"></span>
		</div>
					</td>
				</tr> -->
				<tr>
					<td colspan="2" id="product-images-table">
						
					</td>
					<!-- <td colspan="2" id="product-images-box">
						
					</td> -->
				</tr>
				<tfoot>
				</tfoot>
			</table>
		</form>
		<iframe id="hiddenframe" name="hiddenframe" style="width:0px; height:0px; border:0px"></iframe>
	</div>
</div>
				<?php
				break;
			case "msg-products-add":
				?>
				<form id="product-add-form" action="" method="post">
					<tr class="line">
						<td class="left"><?=$lang->phrase('products-name-fild')?></td>
						<td class="right"><input name="name" type="text" autofocus></td>
					</tr>
					<tr class="line">
						<td class="left"><?=$lang->phrase('products-price-fild')?></td>
						<td class="right"><input name="price" type="text"></td>
					</tr>
					<tr class="line">
						<td class="left"><?=$lang->phrase('products-category-fild')?></td>
						<td class="right">
							<select name="category">
							<?php
								global $db;
								$tmp = $db->call("SELECT * FROM categories");
								$categories = $db->fetch_array( $tmp );

								$i = 0;
								foreach ( $categories as $category ) {
									?>
								<option <?php if ($i = 0) echo "selected"; ?> value="<?php echo $category["category_id"]; ?>">
									<?php echo $category["category_name"]; ?>
								</option>
									<?php
									$i++;
								}
							?>
							</select>
						</td>
					</tr>
					<!--tr class="line">
						<td class="left"><?=$lang->phrase('products-image-fild')?></td>
						<td class="right">
							<input id="add-product-image-button" type="submit" value="Выбрать">
							<input name="image" type="file" accept="image/jpeg,image/png,image/gif,image/ico" multiple>
						</td>
					</tr-->
				</form>
				<?php
				break;
			case "msg-news-add":
				?>
				<tr class="line">
					<form id="<?=$page['alias']?>-add-form" action="" method="post">
						<td class="both">
							<?=$lang->phrase('news-text-fild')?><br><br>
							<textarea name="<?=$page['alias']?>"></textarea>
						</td>
					</form>
				</tr>
				<?php
				break;

			case "msg-articles-add":
				?>
				<script>
					tinymce.init({selector:".add-article-textarea"});
				</script>
				<tr class="line">
					<form id="articles-add-form" action="" method="post">
						<td class="both">
							<textarea name="articles" class="add-article-textarea"></textarea>
						</td>
					</form>
				</tr>
				<?php
				break;
				
			case "msg-infopages-add":
				?>
				<form id="info-add-form" action="" method="post">
					<tr class="line">
						<td class="both">
							<input name="name" placeholder="<?=$lang->give('infopages-url-fild')?>">
						</td>
					</tr>
					<tr class="line">
						<script>
							tinymce.init({selector:".add-info-textarea"});
						</script>
						<td class="both">
							<textarea class="add-info-textarea" name="info" placeholder="<?=$lang->give('infopages-text-fild')?>"></textarea>
						</td>
					</tr>
				</form>
				<?php
				break;
				
				
			case "msg-users-add":
				break;
				
				
			case "msg-categories-add":
				?>
				<form id="category-add-form" action="" method="post">
					<tr class="line">
						<td class="left"><?=$lang->phrase('category-name-fild')?></td>
						<td class="right"><input name="name" type="text" autofocus placeholder="<?=$lang->phrase('category-name-placeholder')?>"></td>
					</tr>
					<tr class="line">
						<td class="left"><?=$lang->give('category-url-fild')?></td>
						<td class="right"><input name="url" type="text" placeholder="<?=$lang->phrase('category-url-placeholder')?>"></td>
					</tr>
					<tr hidden class="line">
						<td class="left"><?=$lang->give('category-order-fild')?></td>
						<td class="right"><input name="order" type="number" value="0"></td>
					</tr>
					<tr hidden class="line">
						<td class="left"><?=$lang->give('category-url2-fild')?></td>
						<td class="right"><input disabled name="url" placeholder="<?=$lang->phrase('category-url2-placeholder')?>" type="text"></td>
					</tr>
				</form>
				<?php
				break;
				
				
			case "msg-options-add":
				// здесь можно будет добавлять свои переменные и позже использовать их в любом месте сайта (пока напрямую в код вписывать, а там и интерфес подтянем)
				break;
		}
	}
}