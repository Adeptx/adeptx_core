<?
class breadcrumbs {
	var $pages;
	var $names;
	var $virtual;
	var $separator;
	var $url;
	
	function init() {
		foreach ($GLOBALS['global'] as $var) {
			global $$var;
		}
		try {
			$json->fileToGlobal($fold['configurations'].$fold['default_configurations'].'breadcrumbs.json');
			$json->fileToGlobal($fold['configurations'].$fold['user_configurations'].'breadcrumbs.json');
		}
		catch (Exception $e) {
			$error->report($e->getMessage(), __LINE__);
		}

		$this->separator = '<span class="breadcrumbs-separator"> '.$modulesConf['breadcrumbs']['separator'].' </span>';

		$this->pages = array(
			"" => array(),
			"index" => array(),
			"profile" => array('',"profile"),
			"registration" => array('',"profile"),
			"cart" => array('',"cart"),
			"paymethods" => array('',"cart","paymethods")
		);

		$this->virtual = array(
			"product" => array("index")
		);
	}
	function show(){
		global $global;
		foreach ($global as $var) {
			global $$var;
		}		
		?>
<div id="breadcrumbs">
<?
	$i = 0;
	if ( isset($this->pages[ $page['url'] ]) ) {
		foreach ( $this->pages[ $page['url'] ] as $key => $value ) {
			echo '<a href="'.$base['href'].$value.'">'.$lang->give($value."-title").'</a>';
			if ( $i++ < count($this->pages[ $page['url'] ]) - 1 ) {
				echo $this->separator;
			}
		}
	}
?>
</div><!-- /breadcrumbs -->
		<?php
	}
	function virtual(){
		global $global;
		foreach ($global as $var) {
			global $$var;
		}

		if ( !isset($_GET['page']) ) $_GET['page'] = "product";

		switch ( $_GET['page'] ) {
			case "product":
				$product = array();
				$tmp = $db->call("SELECT * FROM products WHERE product_id=". $_GET['id']);
				if ($tmp) $product = $db->fetch_array($tmp);
				else {
					// товар не найден
				}
				if ( count($product) > 0 ) {
					$product = $product[0];
					$category = array();
					$tmp = $db->call("SELECT * FROM categories WHERE category_id=".$product["category_id"]);
					if ($tmp) $category = $db->fetch_array($tmp);
					else {
						// категория не найдена
					}
					if ( count($category) > 0 ) {
						$category = $category[0];
					
					}
					else {
						// категория не найдена
					}
				}
				else {
					// товар не найден
				}
				?>
<div id="breadcrumbs">
		<?php
			foreach ($this->virtual[ $_GET['page'] ] as $key => $value) {
				echo '<a href="'.$value.'">'.$lang->give("index-title").'</a>';
				echo $this->separator;
			}
			if ( isset($category["category_id"]) && isset($category["category_name"]) ) {
				echo '<a href="/'.$category["category_url"].'/">'.$category["category_name"].'</a>';
			}
			echo $this->separator;
			if ( isset($product["product_id"]) && isset($product["product_name"]) ) {
				echo '<a href="' .$products->product_full_path($product["product_id"],false). '">'.$product["product_name"].'</a>';
			}
		?>
</div>
				<?php
				break;
		}
		
	}
}