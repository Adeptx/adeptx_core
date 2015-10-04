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
	<?php
		// ЗДЕСЬ НУЖНО ПОМЕНЯТЬ НА SUBCATEGORY_TITLE
	?>
	<title><?php $lang->tr("subcategory-title"); ?></title>
	<?php $content->insert("css-js"); ?>
</head>
<body>
	<div id="page" page="subcategories" <?php
		if ( isset($_GET['id']) )
			echo 'data-id="'.$_GET['id'].'"';
		if ( isset($_GET['sub']) ) {
			echo 'data-sub="' .$_GET['sub']. '"';
		}
	?>>
		<?php $content->insert("header"); ?>
		<div id="container">
			<h2><?php
			$mysqlResult = $db->call('SELECT * FROM `subcategories` WHERE subcategory_id=' .$_GET['sub']. ' LIMIT 1');
			if ( $mysqlResult ) {
				$subcategories_arr = $db->fetch_array( $mysqlResult );
				if ( $subcategories_arr ) {
					echo $subcategories_arr[0]['subcategory_name'];
				}
				else {
					// нет подкатегории
				}
			}
			else {
				// mysql error
			}
			?></h2>
			
			<?php if ( !isset($_GET["page"]) ) $_GET["page"] = 1; ?>

			<div id="content" class="row">

				<?php $content->insert("block-left"); ?>
				
				<div id="block-center">
					
					<section>
						<script>
							$(document).ready(function(){
								$.fn.fancyzoom.defaultsOptions.imgDir='<?php echo DIR_SITE.PATH_SITE; ?>images/fancyzoom/';
								$('.product-image-container a').fancyzoom();
								$('a.tozoom').fancyzoom({Speed:1000});
								$('a').fancyzoom({overlay:0.8});
								$(".product-image-container").click(function(){
									$(this).find("a").click();
								});
							});
						</script>

						<?php $products->show('subcategories', $_GET['page'], 16, $_GET['sub']); ?>
						<?php $products->pages('subcategories', $_GET['page'], 16, $_GET['sub']); ?>

					</section>
					<section id="block-center-article">
						<h2>Статья</h2>
						<aside>
							Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. Текст статьи. 
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