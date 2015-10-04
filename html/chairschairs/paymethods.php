<?php
	if ( isset($_POST['do']) ) {
		include ROOT.DIR_SITE.PATH_SITE.'ajax.php';
	}
?>
<!doctype html>
<html lang="<?php $lang->curr(); ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php $lang->tr("paymethods-title"); ?></title>
	<?php $content->insert("css-js"); ?>
</head>
<body>

	<div id="great-gatsby" hidden>
		<div id="window">
			<div class="window-close close"></div>
			<div class="window-title"></div>
			<div class="window-content"></div>
		</div>
	</div>

	<div id="page" page="paymethods">

		<div class="invisible">

			<div id="msg-buy-one-click-title">Контактные данные</div>
			<div id="msg-buy-one-click-content">
				<div id="one-shot-block">
					Укажите ваши имя, номер и e-mail:
					<input id="one-shot-name" class="fontawesome-user one-shot-fild" autofocus type="text" name="name" placeholder="Ваше имя"<?php if (!empty($_SESSION['customer']['first_name'])) echo ' value="' . $_SESSION['customer']['first_name'] . '"'; ?>>
					<input id="one-shot-phone" class="fontawesome-phone-sign one-shot-fild" type="text" name="phone" placeholder="Номер телефона"<?php if (!empty($_SESSION['customer']['phone'])) echo ' value="' . $_SESSION['customer']['phone'] . '"'; ?>>
					<input id="one-shot-email" class="fontawesome-email one-shot-fild" type="text" name="email" placeholder="Ваш email"<?php if (!empty($_SESSION['customer']['email'])) echo ' value="' . $_SESSION['customer']['email'] . '"'; ?>>
					<input id="paymethods-pay" class="one-shot-button" type="button" value="Оформить заказ">
				</div>
			</div>

		</div><!-- end: .invisible -->

	<div id="page" page="paymethods">
		<?php $content->insert("header"); ?>
		<div id="container">
			<h2><?php $lang->tr("paymethods-title"); ?></h2>
				
			<div id="content" class="row">
				<?php $breadcrumbs->show(); ?>
				
				<table id="paymethods-table" cellspacing="2" cellpadding="2">
					<tr class="title">
						<td>
							Выберите способ оплаты
						</td>
					</tr>
					<tr>
						<td class="body">
							<div class="paymethods">
								
								<span class="paymethod active" data-method="cash">
									<span class="selector"></span>
									<span class="body">Рассрочка</span>
								</span>
								<span class="paymethod" data-method="card">
									<span class="selector"></span>
									<span class="paymethod-body">
									Банковские карты<br>
									<span class="paymethod-desc">VISA, MasterCard, Maestro</span>
									</span>
									<span class="paymethod-image">
										<img src="<?php $cms->link(DIR_IMG.'cards.png'); ?>" />
									</span>
								</span>
								<span class="paymethod" data-method="terminal">
									<span class="selector"></span>
									<span class="paymethod-body">
									Терминалы, Электронные кошельки и др.<br>
									<span class="paymethod-desc">Коммисия системы ~7.9%</span>
									</span>
									<span></span>
								</span>

							</div>
							<div class="total">
								К оплате: <span class="total-sum">
									<?php
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
													if ( !empty($_SESSION['shop']['course']) ) {
														echo $total * $_SESSION['shop']['course'];
													}
													else {
														echo "error";
													}
												}
												else {
													// ошибка чтения из базы данны
												}
											}
										}
									?>
								</span>
							</div>
							<div class="button">
								<input value="Оплатить" type="button">
							</div>
						</td>
					</tr>
				</table>

			</div><!-- /content -->
		
		</div><!-- /container -->
		<?php $content->insert("footer"); ?>
	</div><!-- / page -->
</body>
</html>