<?
	ini_set('date.timezone', $_SESSION['timezone'] );

	$date_time = "<span class='dd'>".$dic['adeptx']['date']['day']['day_of_week_2'][date('N')]."</span>"
		." <span class='DD'>".date('d')."</span>"
		." <span class='MM'>".$dic['date']['month']['months'][date('n')]."</span>"
		." <span class='YY'>".date('Y')."</span>"
		." <span class='hh'>".date('H')."</span>"
		.":<span class='mm'>".date('i')."</span>"
		.":<span class='ss'>".date('s')."</span>";
	$select_timezone = " <select class='timezone'>";

	asort($dic['adeptx']['timezone']['europe']);
	foreach($dic['adeptx']['timezone']['europe'] as $timezone=>$translate) {
		$select_timezone .= "<option value='$timezone'".(($timezone==$_SESSION['timezone'])?(' selected'):('')).">$translate</option>";
	}
	$select_timezone .= "</select>";
	
	$result['.date'] = $date_time . $select_timezone;
	if ($from_cmd) $result['#' . $ajax['id']['cmd']['answer'] ] = $date_time;
		
	function timeColor($hour, $min, $sec) {
		$h = date('H');
		$m = date('i');
		$s = date('s');
		$red = mt_rand(255 -  5*$h, 255);
		$green = mt_rand(255 -  2*$m, 255);
		$blue = mt_rand(255 -  2*$s, 255);
		return "rgb($red, $green, $blue);";
	}

	return $result['.date'];