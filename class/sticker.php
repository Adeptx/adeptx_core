<?
	class sticker {
		public $href;
		public $class;
		public $text;

		function show() {
			?>
			<section>
				<a class="box" href="<?=$this->$href?>">
					<span class="box <?=$this->$class?>">
						<div class="stick"><?=$this->$text?></div>
					</span>
				</a>
			</section>
			<?
		}
	}
	/*
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
	*/