<?
	class module {
		var $name;
		var $header;
		var $content;

		function display($asset_name)
		{
			foreach ($GLOBALS['global'] as $var) {
				global $$var;
			}

			?>
			<div id="<?=$moduleAlias?>" class="module">
				<h2><?=$this->header?></h2>
				<?=$this->content?>
			</div>
			<?
		}
	}

	if (!empty($site['module-cart'])) {
		$cart = new module();
		$cart->header = 'В корзине: <a class="cart-count" href="'.$base['href'].'cart">
			<span class="cart-count"></span>
		</a>';
		$cart->content = 'На сумму: <span id="cart-sum">
			<span id="cart-sum-number">&nbsp;</span>
		</span>
		<a href="'.$base['href'].'cart">
			<input type="button" value="Совершить покупки"
		</a>';
	}