<?
	if ( !isset($_GET['id']) ) {
		$tmp = $db->call('SELECT * FROM `products` ORDER BY product_id ASC LIMIT 1');
		if ($tmp) {
			$product = array();
			$product = $db->fetch_array($tmp);
			if ( !empty($product) ) {
				$_GET['id'] = $product[0]['product_id'];
			}
			else {
				// в таблице нет товаров
				exit();
			}
		}
		else {
			// ошибка базы данных
		}
	}
?>

	<div class="invisible">

		<div id="msg-product-add-title">Добавление товара</div>
		<div id="msg-product-add-content">
			<table id="cart-preview-table" cellpadding="0" cellspacing="0">
				<tr class="title">
					<td class="remove"></td>
					<td class="image"></td>
					<td class="name">Товар</td>
					<td class="quantity">Кол-во</td>
					<td class="price">Цена ед.</td>
					<td class="sum">Сумма</td>
				</tr>
				<tr><td colspan="6"><hr></td></tr>
				<!-- содержимое таблицы -->
				<tr id="cart-preview-total">
					<td class="total" colspan="6">К оплате: <span class="total-sum"></span></td>
				</tr>
				<tr id="loading-cart">
					<td>
						<img width="32" height="8" src="<?php $cms->link('images/loading.gif'); ?>" />
					</td>
				</tr>
				<tr>
					<td colspan="4"><a class="button-continue close">Продолжить покупки</a></td>
					<td colspan="2"><input class="button-to-paymethods" value="Оформить заказ,,,,>" type="button"></td>
				</tr>
			</table>
		</div>

		<div id="msg-buy-one-click-title">Купить в 1 клик</div>
		<div id="msg-buy-one-click-content">
			<div id="one-shot-block">
				Укажите ваши имя, номер и e-mail:
				<input id="one-shot-name" class="fontawesome-user one-shot-fild" type="text" name="name" placeholder="Ваше имя"<?php if (!empty($_SESSION['customer']['first_name'])) echo ' value="' . $_SESSION['customer']['first_name'] . '"'; ?>>
				<input id="one-shot-phone" class="fontawesome-phone-sign one-shot-fild" type="text" name="phone" placeholder="Номер телефона"<?php if (!empty($_SESSION['customer']['phone'])) echo ' value="' . $_SESSION['customer']['phone'] . '"'; ?>>
				<input id="one-shot-email" class="fontawesome-email one-shot-fild" type="text" name="email" placeholder="Ваш email"<?php if (!empty($_SESSION['customer']['email'])) echo ' value="' . $_SESSION['customer']['email'] . '"'; ?>>
				<input id="one-shot-one-hit" data-id="<?php echo $_GET['id']; ?>" class="one-shot-button" type="button" value="Оформить заказ">
			</div>
		</div>

	</div><!-- end: .invisible -->

<div id="great-gatsby" hidden>
	<div id="window">
		<div class="window-close close"></div>
		<div class="window-title"></div>
		<div class="window-content"></div>
	</div>
</div>






<div id="block-left">				
	<?$asset->show("auth-module")?>
	<?$asset->show("cart-module")?>
	<?$asset->show("filters-module")?>
	<?$asset->show("social-module")?>
</div>

<div id="block-center">
	<section id="block-center-page">
	<?
		$tmp = $db->call("SELECT * FROM products WHERE product_id=" . $_GET['id']);
		$product = $db->fetch_array($tmp);
		$product = $product[0];

		$asset->show("block-left");
		$asset->show("page-product_block-center", $product);
		$asset->show("page-product_block-right", $product);
	?>
	</section>

	<?$asset->show("avatar-module")?>
	<?$asset->show("profile-settings-module", $user)?>
	<?$asset->show("cart-module")?>
	<?$asset->show("costumer-orders-module", $user)?>
</div>

<div id="block-right">
	<?$asset->show("characteristics-block")?>
</div>