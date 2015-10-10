<?

if (!isset($_POST['page'])) {
	if (!empty($page['url'])) {
		$package_main_file = $fold['repository'] . $page['url'] . $site['extensions'];
		if (is_file($package_main_file)){
			echo '<script>window.onload = function(){new_cloud("' . $package_main_file . '");}</script>';
		}
	}
} else {
	include_once $page['path'];
}