<div id="menu">
	<ul>
		<li><a href="<?=$base['href']?>admin/products" id="menu-link-products">Товары</a></li>
		<li><a href="<?=$base['href']?>admin/categories" id="menu-link-categories">Категории</a></li>
		<li>
			<a id="menu-link-pages" href="<?=$base['href']?>admin/infopages">Страницы</a>
			<div class="submenu" id="submenu-link-pages">
				<ul>
					<li class="menu-sublink"><a href="<?=$base['href']?>admin/news">Новости</a></li>
					<li class="menu-sublink"><a href="<?=$base['href']?>admin/articles">Статьи</a></li>
				</ul>
			</div>
		</li>
		<li><a href="<?=$base['href']?>admin/users" id="menu-link-users">Пользователи</a></li>
		<li><a href="<?=$base['href']?>admin/options" id="menu-link-options">Настройки</a></li>
		<li class="menu-external"><a id="external-link" href="<?=$base['href']?>" target="_blank"></a></li>
		<li class="menu-external"><a id="exit" href="<?=$base['href'].$site['alias'].'/'.$page['alias']?>?call=exit"></a></li>
	</ul>
</div>