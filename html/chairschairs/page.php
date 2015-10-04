<!doctype html>
<html lang="<?php $lang->curr(); ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php $lang->tr("category-title"); ?></title>
	<?php $content->insert("css-js"); ?>
</head>
<body>
	<div id="page" page="categories">
		<?php $content->insert("header"); ?>
		<div id="container">
			<h2><?php
				// $category = $content->category_info( $_GET["page"] );
				// echo $category["category_name"];
				
			?></h2>
			
			<?php if ( !isset($_GET["page"]) ) $_GET["page"] = 1; ?>

			<div id="content" class="row">

				<?php $content->insert("block-left"); ?>
				
				<div id="block-center">
					<section id="block-center-page">
						<h2>Контакты</h2>
						<aside>
							Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. Наши контакты. 
						</aside>
						<h2>О нас</h2>
						<aside>
							Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. Немного о нас. 
						</aside>
						<h2>Сервис</h2>
						<aside>
							Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. Лучший в мире сервис. 
						</aside>
					</section>
				</div>

				<?php $content->insert("block-right"); ?>
				
			</div><!-- /content -->
		
		</div><!-- /container -->
		<?php $content->insert("footer"); ?>
	</div><!-- / page -->
</body>
</html>