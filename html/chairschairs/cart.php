<?php
	if ( isset($_POST['do']) || isset($_FILES['profile_image']) ) {
		include ROOT.DIR_SITE.PATH_SITE."ajax.php";
	}
?>
<!doctype html>
<html lang="<?php $lang->curr(); ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php $lang->tr("cart-title"); ?></title>
	<?php $content->insert("css-js"); ?>
</head>
<body>
	<div id="page" page="cart">
		<?php $content->insert("header"); ?>
		<div id="container">
			<h2><?php $lang->tr("cart-title"); ?></h2>
				
			<div id="content" class="row">
				<?php $breadcrumbs->show(); ?>
				
				<?php
					$i = 0;
					$arr = "";
					foreach ( $_SESSION["cart"]["products"] as $key => $product ) {
						if ( $i > 0 ) $arr .= ",";
						$arr .= $key;
						$i++;
					}

					$products_arr = array();
					if ( $arr ) {
						$query = "SELECT * FROM products WHERE product_id IN (" .$arr. ")";
						$tmp = $db->call( $query );
						
						if ($tmp) {
							$products_arr = $db->fetch_array($tmp);
							if ( count($products_arr) > 0 ) {
								foreach ($products_arr as $key => $product) {
									$products_arr[ $key ]["quantity"] = $_SESSION["cart"]["products"][ $product["product_id"] ]["quantity"];
								}
							}
							else {
								// корзина пуста
							}
						}
					}
					else {
						// корзина пуста
					}
				?>

				<table id="cart-product-table" cellpadding="0" cellspacing="0">
					<tr class="title">
						<td class="title-margin" colspan="2"></td>
						<td>Товар</td>
						<td class="quantity">Кол-во</td>
						<td class="price">Цена ед.</td>
						<td class="sum">Сумма</td>
					</tr>
				<?php
					$total = 0;
					if ( count($products_arr) > 0) {
						foreach ($products_arr as $product) {
							$total += $product["quantity"] * $product["product_price"];
				?>
					<!--
						<tr class="cart-product" product_id="<?php echo $product["product_id"]; ?>">
							<td class="remove">&#10005;</td>
							<td class="image"><img src="<?php $cms->link( PRODUCT_IMG.$product["product_image"] ); ?>"></td>
							<td class="name"><?php echo $product["product_name"]; ?></td>
							<td class="quantity">
								<div class="cart-product-quantity"><?php echo $product["quantity"]; ?>

								</div>
							</td>
							<td class="price"><?php echo $product["product_price"]; ?> руб.</td>
							<td class="sum"><?php echo $product["quantity"] * $product["product_price"]; ?> руб.</td>
						</tr>
						<tr class="separator">
							<td colspan="6"></td>
						</td>-->
				<?php
						}
					}
					
				?>
				<tr id="cart-product-total">
					<td class="total" colspan="6">К оплате: <span class="total-sum"><?php echo $total; ?></span></td>
				</tr>
				<tr id="loading-cart">
					<td colspan="6"><img width="32" height="8" src="<?php $cms->link('images/loading.gif'); ?>" /></td>
				</tr>
				<tr>
					<td class="button" colspan="6"><input value="Оформить заказ,,,,>" type="button"></td>
				</tr>
				</table>
			</div><!-- /content -->
		
		</div><!-- /container -->
		<?php $content->insert("footer"); ?>
	</div><!-- / page -->
</body>
</html>