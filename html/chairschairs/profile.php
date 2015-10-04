<? $breadcrumbs->show(); ?>

<div id="block-center">
	<?

	if ( isset( $_GET["call"] ) && $_GET["call"] == "exit" ) {
		unset( $_SESSION["customer"] );
	}

	if ( !isset($_SESSION['customer']) ) {
		if ( !isset( $_SESSION['customer']['online'] ) || $_SESSION['customer']['online'] != true ) {
			if ( $page['url'] == 'registration' ) {
				$asset->show("reg-module");
			}
			else {
				$asset->show("auth-module");
			}
		}
	} else {
		$user = array();
		$tmp = $db->call('SELECT * FROM `users` WHERE user_email="'.$_SESSION['customer']['email'].'" LIMIT 1');
		if ($tmp) {
			$user = $db->fetch_array($tmp);
			if ( count($user) > 0 ) {
				$user = $user[0];
			}
			else {
				exit('#error profile db');
			}
		}
		else {
			exit('#error profile user');
		}
		?>

		<?$asset->show("avatar-module")?>
		<?$asset->show("profile-settings-module", $user)?>
		<?$asset->show("cart-module")?>
		<?$asset->show("costumer-orders-module", $user)?>
	<? } ?>
</div>
