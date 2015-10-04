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
	<title><?php $lang->tr("category-title"); ?></title>
	<?php $content->insert("css-js"); ?>
</head>
<body>
	<div id="page" page="categories" <?php if ( isset($_GET["id"]) ) echo 'data-id="'.$_GET["id"].'"'; ?>>
		<?php $content->insert("header"); ?>
		<div id="container">
			<h2><?php
				$category = $content->category_info( $_GET["id"] );
				echo $category["category_name"];
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

						<?php $products->show("categories", $_GET["page"], 16, $_GET["id"]); ?>
						<?php
							// достать категорию и вывести ее название вместо id
							$products->pages("categories", $_GET["page"], 16, $_GET['id']);
						?>
						
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