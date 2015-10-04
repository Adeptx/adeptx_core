<?
	class asset {
		function show2($asset_name)
		{
			foreach ($GLOBALS['global'] as $var) {
				global $$var;
			}
			switch ($asset_name) {
				case 'stickers':
					break;
			}
		}
		function show($asset_name) {
			foreach ($GLOBALS['global'] as $var) {
				global $$var;
			}

			switch ($asset_name) {
				case 'stickers':

					echo '<section>';

					foreach($page['stickers'] as $stick) { ?>
						<a class="box" href="<?=$stick[0]?>"><span class="box <?=$stick[1]?>"><div class="stick"><?=$stick[2]?></div></span></a>
					<? }

					if ($_SESSION['permissions']['home']['add_link']) { ?>
						<script>
							$('.box .stick').each(function(){
								$(this).html('<input value="' + $(this).html() + '">');
							});
						</script>
					<? }

					echo '</section>';
					break;

				case 'loginza':
					?>
						<div id="<?=$asset_name?>">
							Войти через: &nbsp;
							<a class="yandex" href="404" title="https://oauth.yandex.ru/authorize?response_type=code&client_id=c55f9c35cbc54d4e8e67b60ed1d48d83">Yandex</a>
							<a href="https://loginza.ru/api/widget?token_url=http%3A%2F%2Fgrinec.tk%2Fupdate&provider=google&lang=<?=$page['lang']?>" class="loginza google">Google</a>
							<a href="https://loginza.ru/api/widget?token_url=http%3A%2F%2Fgrinec.tk%2Fupdate&provider=yandex&lang=<?=$page['lang']?>" class="loginza yandex">Yandex</a>
							<a href="https://loginza.ru/api/widget?token_url=http%3A%2F%2Fgrinec.tk%2Fupdate&provider=facebook&lang=<?=$page['lang']?>" class="loginza facebook">Facebook</a>
							<a href="https://loginza.ru/api/widget?token_url=http%3A%2F%2Fgrinec.tk%2Fupdate&provider=vkontakte&lang=<?=$page['lang']?>" class="loginza vkontakte">Vkontakte</a>
							<a href="https://loginza.ru/api/widget?token_url=http%3A%2F%2Fgrinec.tk%2Fupdate&provider=twitter&lang=<?=$page['lang']?>" class="loginza twitter">Twitter</a>
							<a href="https://loginza.ru/api/widget?token_url=http%3A%2F%2Fgrinec.tk%2Fupdate&provider=webmoney&lang=<?=$page['lang']?>" class="loginza webmoney">Webmoney</a>
						</div>
					<?
					break;

				case 'analog_clock':
					?>
						<div id="<?=$asset_name?>">
							<div id="container">
								<canvas id="canvas" height="50" width="50"></canvas>
							</div>
						</div>
					<?
					break;

				case 'logo':
					?>
					<div href="<?=$base['href']?>" id="logotype"><div id="<?=$asset_name?>">A</div>DEPT<span id="logolast">X</span><div id="nulldomen">.TK</div></div>
					<?
					break;

				case 'site_epigraph':
					?>
						<div id="<?=$asset_name?>">$epigraph</div>
					<?
					break;

				case 'copyright2':
					?>
						<ul id="<?=$asset_name?>">&copy; <?=date('Y').' ADEPTX '.$lang->give('all rights reserved').'. '.$lang->give('copyright')?>
							<a target="_blank" href="http://api.hostinger.ru/redir/583686"><?=$lang->phrase('hosting')?></a>.
							<a href="<?=$page['link']['contacts'][0]?>"><?=$admins['1']['name'].' '.$admins['1']['surname']?></a>
						</ul>
					<?
					break;
				
				case "buymore-block":
					if (empty($site['module-buymore'])) break;
					$product = $data;
					?>
					<div id="<?=$asset_name?>" class="module">
						<h3>С ЭТИМ ТАКЖЕ ПОКУПАЮТ</h3>
						<?php
							// считывать поле "product_buy_also"  в таблице и выводить товары, которые покупают наряду с этими
							$products->show("buymore", 1, 5);
						?>
					</div>
					<?php
					break;









				case "site-logotype":
					?>
					<a href="<?=$base['href']?>">
						<div id="header-logo"></div>
					</a>
					<?
					break;
				case "site-description":
					?>
					<div id="header-description">
						<?=$site['shop_description']?>
					</div>
					<?
					break;
				case "product-images-block":
					$product = $data;
					global $product_image;

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

			unset($imgs_names[0], $imgs_names[1]);
			if (isset($imgs_names[2])) $main_img = $imgs_names[2];
			else $main_img = $product_image['no_exist'];
			if (isset($imgs_names[2])) $second_img = $imgs_names[3];
			else $second_img = $product_image['no_exist'];

			// большое изображение
			if ( is_readable( $original_img_dir.$main_img ) ) {
				$zoom_img_link = $cms->src( $original_img_dir.$main_img );
			}
			else {
				$zoom_img_link =  $product_image['no_exist'];
			}
			// показываемое изображение
			if ( is_readable( $large_img_dir.$main_img ) ) {
				$main_image_src = $cms->src( $large_img_dir.$main_img );
			}
			else {
				$main_image_src = $product_image['no_exist'];
			}
			// изображение при наведении
			if ( is_readable( $large_img_dir.$second_img ) ) {
				$second_image_src = $cms->src( $large_img_dir.$second_img );
			}
			else {
				$second_image_src = $product_image['no_exist'];
			}
					?>
							<div id="product-images-block">
								<div id="product-main-image">
									<a href='<?php echo $zoom_img_link; ?>'>
										<img src='<?php echo $main_image_src; ?>' data-main='<?php echo $main_image_src; ?>' data-second='<?php echo $second_image_src; ?>'>
									</a>
								</div>
								<div id="product-preview-images">
									<?php

									if ( empty( $imgs_names ) ) {
										// no miniatures
									}
									else {
										$nofirst = 0;
										foreach ($imgs_names as $i=>$product_mini_img) {
										?>
										<img class="product-preview-image<?php if($nofirst) echo ' nonactive'; ?>" src="<?php echo $cms->src($small_img_dir.$product_mini_img); ?>">
									<?php
										$nofirst = 1;
										}
									}
									?>
								</div>
							</div>
					<?php
					break;
				case "pluses-block":
					if (empty($site['module-pluses'])) break;
					?>
					<div id="<?=$asset_name?>">
						<div class="plus-block">
							<div id="plus0" border="none" class="plus-image"></div>
							<div class="plus-name">Доставка по<br>всей России</div>
						</div>
						<div class="plus-block">
							<div id="plus1" border="none" class="plus-image"></div>
							<div class="plus-name">Гарантия</div>
						</div>
						<div class="plus-block">
							<div id="plus2" border="none" class="plus-image"></div>
							<div class="plus-name">3Д проекты</div>
						</div>
						<div class="plus-block">
							<div id="plus3" border="none" class="plus-image"></div>
							<div class="plus-name">Удобный способ оплаты и рассрочка</div>
						</div>
					</div>
					<?
					break;
				case "reviews-block":
					if (empty($site['module-reviews'])) break;
					$product = $data;
					?>
					<div id="<?=$asset_name?>">
						<h4>
							<a id="reviews-block-description-show">Полное описание товара</a>
							<a id="reviews-block-reviews-show">Отзывы</a>
							<a id="reviews-block-delivery-show">Условия доставки и возврата</a>
						</h4>

						<div hidden id="reviews-block-reviews" data-product-id="<?php echo $_GET['id']; ?>" class="toggle">
							<div id="reviews-block-new-review-form">
								<?php if(isset($_SESSION['customer']['online']) && $_SESSION['customer']['online']) { ?>
									Оставьте свой отзыв о товаре<?php if(!$_SESSION['customer']['first_name']) { ?>:<br>
										<form id="add-review-form" method="post" data-user-id="<?php echo $_SESSION['customer']['id']; ?>">
											<input id="reviews-block-new-review-author" name="name" placeholder="Ваше имя">
										<?php } else {
											echo ', ' . $_SESSION['customer']['first_name'] . ':<br>';
											?>
												<form id="add-review-form" method="post" data-user-id="<?php echo $_SESSION['customer']['id']; ?>">
										<?php } ?>

										<img id="reviews-block-new-review-author-photo" class="review-image" src="<?php $cms->link( USER_IMG . $_SESSION['customer']['image'] ); ?>" alt="Фото пользователя <?php echo $_SESSION['customer']['first_name'].' '.$_SESSION['customer']['last_name']; ?>">
										<textarea id="reviews-block-new-review-fild" name="review" placeholder="Текст отзыва"></textarea>
										<input type="submit" id="reviews-add-button" value="Отправить">
									</form>
								<?php } else { ?>
									Чтобы оставить отзыв <a href="#profile-module-block" class="sign-link-decree">авторизуйтесь</a> или <a href="<?=$base['href']?>registration" class="sign-link-decree">зарегистрируйтесь</a>.
								<?php } ?>
							</div>

							<!-- ajax result here-->
						</div>

						<div id="reviews-block-description" class="toggle">
							<?php
								if (!empty($product["product_description"])) {
									echo $product["product_description"]; 
								}
								else {
									echo 'Еще нет подробного описания этого товара.';
								}
							?>
						</div>
						<div hidden id="reviews-block-delivery" class="toggle">
							<?php
								if ($product["product_delivery"]) {
									echo $product["product_delivery"]; 
								}
								else {
									echo 'Доставка товара занимает от 4х недель.';
								}
							?>
						</div>
					</div>
					<?
					break;

				case "characteristics-block":
					if (empty($site['module-characteristics'])) break;
					$product = $data;
					?>
						<div id="<?=$asset_name?>" class="module">
							<h3><?php echo $product["product_name"]; ?></h3>
							<div class="line">
								Цена товара: <span id="cart-sum"><span class="currency"><?php $products->formatPrice($product["product_price"]); ?></span>
							</div>
							<div class="line">
								Технические характеристики:
							</div>
							<div class="line-big">
								<?php
									$mysqlResult = $db->call('SELECT * FROM `products_details` WHERE product_id="' .$_GET['id']. '" LIMIT 1');
									if ( $mysqlResult ) {
										$details = $db->fetch_array( $mysqlResult );
										if ( !empty($details) ) {
											$chs = explode("\n", $details[0]['details']);
											foreach ($chs as $ch) {
												echo "<p>$ch</p>";
											}
										}
										else {
											// ничего не найдено
										}
									}
									else {
										// ошибка бд
									}
								?>
							</div>
							<div class="line product-color">
								<?php
									if ( !empty($product['product_colors']) ) {
										$colors = explode( ',', $product['product_colors'] );
										// каждому цвету находим соответствие в таблице pictures_colors
										// $cms->prepareIN
										// выводим ссылки на пикчу, если она есть в этой таблице
										$colors_in = $cms->prepareIN( $colors );
										$mysqlResult = $db->call('SELECT * FROM `pictures_colors` WHERE product_id='.$_GET['id']);
										if ( $mysqlResult ) {
											$pictures_colors = $db->fetch_array( $mysqlResult );
											if ( !empty($pictures_colors) ) {
												foreach ($colors as $color) {
													$picture = '';
													foreach ( $pictures_colors as $pic_color ) {
														// найти в массиве найденных pictures_colors нужный нам цвет.
														if ( $color == $pic_color['product_color'] ) {
															$large_img_dir		= sprintf(
																$product_image['dir'],
																$product_image['large'],
																$_GET['id']
															);
															$picture = $large_img_dir.$pic_color['product_picture'];
														}
													}
													if ( !empty($picture) ) {
														echo '<span class="' .$color. '" data-color="' .$color. '" data-picture="' .$picture. '"></span>';
													}
													else {
														echo '<span class="' .$color. '" data-color="' .$color. '"></span>';
													}
												}
											}
											else {
												// к цветам не привязаны картинки
												foreach ($colors as $color) {
													echo '<span class="' .$color. '" data-color="' .$color. '"></span>';
												}
											}
										}
										else {
											// к цветам не привязаны картинки или ошибка бд
											foreach ($colors as $color) {
												echo '<span class="' .$color. '" data-color="' .$color. '"></span>';
											}
										}
									}
									else {
										// у товара не найдены цвета
									}
								?>
							</div>
							<div class="line">
								<div data-rating="<?php echo $product["product_rating"]; ?>" class="rating stars_<?php echo $product["product_rating"]; ?>"></div><a class="view-reviews sign-link" href="#reviews-block">Читать отзывы клиентов ↲</a>
							</div>
							<div class="line">
								<div id="add-to-cart" class="add-to-cart" data-id="<?php echo $_GET['id']; ?>">Добавить товар в корзину</div>
							</div>
							<div class="line">
								<div>
									<input id="buy-one-click" type="button" class="button" value="Купить в 1 клик">
								</div>
							</div>

							<?$this->show("pluses-block")?>
						</div>

					<?php
					break;

				case "auth-module":
					if (empty($site['module-auth'])) break;

					if ( isset( $_GET["call"] ) && $_GET["call"] == "exit" ) {
						unset( $_SESSION["customer"] );
					}

					if(!isset($_SESSION['customer']['online'])) { ?>	
						<form id="profile-module-block" class="module" method="post">
							<h3>Авторизация</h3>
							<input name="login" id="login" type="text" placeholder="Email">
							<input name="password" id="password" type="password" placeholder="Пароль">
							<a href="<?=$base['href']?>profile"><input id="sign-in-button" type="submit" value="Войти"></a>
							<a id="reg-link" class="sign-link" href="<?=$base['href']?>registration">Регистрация →</a>
						</form>
					<?php } else {
						$this->show("avatar-module");
					} ?>

					<?php
					break;
				case "reg-module":
					?>
					<form id="<?=$asset_name?>-block" class="module" method="post">
						<h3>Регистрация</h3>
						<input name="login" id="login" placeholder="Email" type="text">
						<input name="password" id="password" placeholder="Пароль" type="password">
						<a href="<?=$base['href']?>profile"><input id="reg-in-button" type="submit" value="Продолжить"></a>
						<a id="auth-link" class="sign-link" href="<?=$base['href']?>profile">← Авторизация</a>
					</form>
					<?
					break;
				case "avatar-module":
					if (empty($site['module-avatar'])) break;
					
					if ( isset( $_GET["call"] ) && $_GET["call"] == "exit" ) {
						unset( $_SESSION["customer"] );
					}
					?>
						<div id="avatar-block" class="module">
							<a href="<?=$base['href']?>profile">
								<h3 title="Нажмите, чтобы изменить персональные данные">
									<?php
									if ( isset($_SESSION['customer']['first_name']) || isset($_SESSION['customer']['last_name']) ) {
										if ($_SESSION['customer']['first_name'] || $_SESSION['customer']['last_name']) {
											echo $_SESSION['customer']['first_name'] . '<br>' .  $_SESSION['customer']['last_name'];
										}
										else {
											echo 'ИМЯ<br>ФАМИЛИЯ';
										}
									}
									else {
										echo 'ИМЯ<br>ФАМИЛИЯ';
									}
									?>
								</h3>
							</a>
							<form id="upload" method="post" enctype="multipart/form-data">
								<div id="drop">
									<a>Сменить фотографию профиля
									<img id="profilePhoto" class="photo" src="<?
										if ( !empty($_SESSION['customer']['image']) ) {
											echo $fold['images'] . 'profile/' . $_SESSION['customer']['image'];
											// $cms->link( USER_IMG . $_SESSION['customer']['image'] );
										}
										else {
											echo $fold['images'] . 'profile' . 'no-image.jpg';
											// $cms->link( USER_IMG . "no-image.jpg" );
										}
									?>" alt="Фото пользователя <?php echo $_SESSION['customer']['first_name'].' '.$_SESSION['customer']['last_name']; ?>" title="Вы можете перетащить фотографию прямо в это поле" data-user-id="<?php echo $_SESSION['customer']['id']; ?>">
									</a>
									<input type="file" name="profile_image">
								</div>
							</form>
							<a id="exit" class="sign-link" href="?call=exit">Выйти</a>
						</div>
					<?php
					break;
				case "profile-settings-module":
					$user = $data;
					?>
						<div id="profile-block" class="module">
							<h3>Ваш аккаунт</h3>
							<div id="profile-settings">
								<div class="option">
									<div class="option-name">Имя:</div>
									<input placeholder="имя" tabindex=1 class="option-value option-field" type="text" name="first-name" value="<?php echo $user['user_first_name']; ?>">
									<a><input class="button-field button" type="submit" field="first-name" value="Редактировать"></a>
								</div>
								<div class="option">
									<div class="option-name">Фамилия:</div>
									<input placeholder="фамилия" tabindex=2 class="option-value option-field" type="text" name="last-name" value="<?php echo $user['user_last_name']; ?>">
									<a><input class="button-field button" type="submit" field="last-name" value="Редактировать"></a>
								</div>
								<div class="option">
									<div class="option-name">Пол:</div>
										<select id="sex-on-fire" tabindex=3>
											<option value="0" <?php if ($user['user_sex'] != 1 && $user['user_sex'] != 2) echo ' selected'; ?> disabled>Не указан</option>
											<option value="1"<?php if ($user['user_sex'] == 1) echo ' selected'; ?>>Мужской</option>
											<option value="2"<?php if ($user['user_sex'] == 2) echo ' selected'; ?>>Женский</option>
										</select>
									<a><input class="button-field button" type="submit" field="sex" value="Редактировать"></a>
								</div>
								<div class="option">
									<div class="option-name">Email:</div>
									<input tabindex=4 class="option-value option-field" type="text" name="email" value="<?php echo $user['user_email']; ?>">
									<a><input class="button-field button" type="submit" field="email" value="Редактировать"></a>
								</div>
								<div class="option">
									<div class="option-name">Пароль</div>
									<input tabindex=5 class="option-value option-field" type="password" name="pass" placeholder="новый пароль">
									<a><input class="button-field button" type="submit" field="pass" value="Редактировать"></a>
								</div>
								<div class="empty"></div>
							</div>
						</div>
					<?php
					break;
				case "costumer-orders-module":
					$user = $data;
					?>
						<div id="costumer-orders" class="module">
							<h3>Ваши заказы</h3>
							<div id="orders-table">
								<?php
									$mysqlResult = $db->call(sprintf('SELECT * FROM `orders` WHERE order_user_id=%u LIMIT 3', $_SESSION['customer']['id']));
									//
								?>


								<div class="order">
									<div class="order-image"></div>
									<div class="order-desc">Название товара</div>
									<input class="order-status-button" type="button" value="Статус заказа">
								</div>
								<div class="order">
									<div class="order-image"></div>
									<div class="order-desc">Название товара</div>
									<input class="order-status-button" type="button" value="Статус заказа">
								</div>
								<div class="order">
									<div class="order-image"></div>
									<div class="order-desc">Название товара</div>
									<input class="order-status-button" type="button" value="Статус заказа">
								</div>



							</div>
						</div>
					<?php
					break;
				case "cart-module":
					if (empty($site['module-cart'])) break;
					?>
						<div id="cart-block" class="module">
							<h3>В корзине: 
								<a class="cart-count" href="<?php echo HOST."cart"; ?>">
								<span class="cart-count"></span>
								</a>
							</h3>
							На сумму: <span id="cart-sum"><span id="cart-sum-number">&nbsp;</span></span>
							<a href="<?=$base['href']?>cart"><input type="button" value="Совершить покупки"></a>
						</div>
					<?php
					break;
				case "filters-module":
					if (empty($site['module-filters'])) break;
					?>
						<div id="filters-block" class="module">
							<h3>Фильтры по параметрам</h3>
							<span>Цвет:</span>
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
							<span>Цена:</span><br>
							<input id="filter-price-from" placeholder="от"> - <input id="filter-price-to" placeholder="до">
							<input id="filters-apply" type="button" value="Применить фильтры">
						</div>
					<?php
					break;
				case "social-module":
					if (empty($site['module-social'])) break;
					?>
						<div id="social-block" class="module">
							<h3>Социальные сети</h3>
							<div id="vk_groups"></div>

							<!-- facebook даже здесь умудрился налажать -->
							<div id="fb-root"></div>
							<div class="fb-like-box" data-href="https://www.facebook.com/chairsandcompany" data-width="105" data-height="250" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
							
						</div>
					<?php
					break;
				case "page-product_block-center":
					$product = $data;
					global $breadcrumbs;
					?>
					<div id="block-center">
						<?
							$breadcrumbs->virtual();
							$this->show("product-images-block", $product);
							$this->show("buymore-block", $product);
							$this->show("reviews-block", $product);
						?>
					</div>
					<?php
					break;

				case "module-profitable":
					if (empty($site['module-profitable'])) break;
					?>
						<div id="<?=$asset_name?>" class="module">
							<h3>Выгодные предложения</h3>

							<?
								$tmp = $db->call("SELECT COUNT(*) FROM products WHERE product_type='discount' OR product_type='hit' OR product_type='actia'");
								$count = $db->fetch_row($tmp);
								$count = (int)$count[0][0];
								$start = rand(0, $count - 3);

								$discounts = array();
								$tmp = $db->call("SELECT * FROM products WHERE product_type='discount' OR product_type='hit' OR product_type='actia' LIMIT ".$start.",3");
								if ($tmp) $discounts = $db->fetch_array($tmp);
								if ( !empty($discounts) ) {
									foreach ($discounts as $discount) {
										echo $products->formatProductBlock($discount);
									}
								}
							?>
						</div>

					<?
					break;
				case "module-news":
					if (empty($site['module-news'])) break;
					?>

						<div id="block-news" class="module">
							<h3>Наши новости</h3>
							<?
								$news = array();
								$tmp = $db->call("SELECT * FROM `news` ORDER BY `news_id` DESC LIMIT 3");
								if ( $tmp ) {
									$news = $db->fetch_array( $tmp );
									if ( count( $news ) > 0 ) {
										foreach ( $news as $me ) {
											if ($me['news_public']) {
												?>
												<a href="<?=$base['href']?>news?id=<?=$me['news_id']?>" title="Читать подробнее"><p><?=$me['news_preview']?></p></a><div class="news_date"><?=date('d/m/Y', $me['news_date'])?></div>
												<?
											}
										}
									}
									else {
										echo "<p>На сайте пока нет новостей</p>";
									}
								}
								else {
									// ошибка базы данных
								}
							?>
						</div>

					<?
					break;

				case "search":
					global $site;
					?>
						<div id="header-search">
							
							<!-- script>
							  (function() {
							    var cx = '004991358980009109902:pxd8xe5e54u';
							    var gcse = document.createElement('script');
							    gcse.type = 'text/javascript';
							    gcse.async = true;
							    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
							        '//www.google.com/cse/cse.js?cx=' + cx;
							    var s = document.getElementsByTagName('script')[0];
							    s.parentNode.insertBefore(gcse, s);
							  })();
							</script -->
							<gcse:search></gcse:search>
							<input id="header-search-input" placeholder="Поиск">
							<input id="header-search-button" type="button">
							<a href="partnership" id="header-partnership-link">
								<span>
									<?=$site['partnership_button']?>
								</span>
								<!--<input id="header-partnership-button" type="button" value="Партнерская программа для дизайнеров">-->
							</a>
						</div>
					<?
					break;

				case "menu":
					global $db;
					?>
					<div id="header-menu">
						<ul>
							<?
							
							$tmp = $db->call("SELECT * FROM `categories`");
							$categories = $db->fetch_array($tmp);

							$mysqlResult = $db->call('SELECT * FROM `subcategories`');
							if ( $mysqlResult ) {
								$subcategories_arr = $db->fetch_array( $mysqlResult );
								if ( !empty($subcategories_arr) ) {
									$submenu = array();
									foreach ( $subcategories_arr as $sub) {
										if ( empty($submenu[ $sub['category_id'] ]) ) {
											$submenu[ $sub['category_id'] ] = array();
										}
										$submenu[ $sub['category_id'] ][ $sub['subcategory_url'] ] = $sub['subcategory_name'];
									}
								}
								else {
									// в базе нет субкатегорий
								}
							}
							else {
								// ошибка mysql
							}
							
							foreach ($categories as $category) {
								?>
							<span class="menu-item">
								<a href="<?=$base['href']?><?php echo $category['category_url']; ?>"><li><?php echo $category["category_name"]; ?></li></a>
								<div class="submenu">
								<?
									if (!empty($submenu[$category['category_id']])) {
										foreach ($submenu[$category['category_id']] as $subcategory_url => $subcategory_name) {
											?>
												<a href='<?=$base['href'].$category['category_url'].'/'.$subcategory_url?>'><li><?=$subcategory_name?></li></a>
											<?
									}
								} ?>
								</div>
							</span>
							<? } ?>
							<a href="<?=$base['href']?>contacts"><li>Контакты</li></a>
							<a href="<?=$base['href']?>about_us"><li>О нас</li></a>
							<a href="<?=$base['href']?>service"><li>Сервис</li></a>
						</ul>
					</div>
					<?
					break;

				case 'second-menu':
					?>
					<div id="footer-menu">
						<ul>
							<a href="<?=$base['href']?>about_us"><li>О нас</li></a>
							<a href="<?=$base['href']?>vacancies"><li>Наши вакансии</li></a>
							<a href="<?=$base['href']?>partnership"><li>Стать партнером</li></a>
							<a href="<?=$base['href']?>contacts"><li>Контакты</li></a>
							<a href="<?=$base['href']?>sitemap"><li>Карта сайта</li></a>
						</ul>
					</div>
					<?
					break;

				case 'copyright':
					?>
					<div class="footer-copy">
						Технологии ADEPTX
						<br>
						<?=$site['shop_copyright']?>
					</div>
					<?
					break;
			}
		}
	}