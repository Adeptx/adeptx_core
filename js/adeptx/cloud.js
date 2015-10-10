function cloude_close($cid) {
	$process_window = $('.cloud[data-pid="' + $cid + '"]');

	// window.previous_focus = window.process;
	window.focus = window.previous_focus;
	$process_window.remove();
	$('#taskbar .puddle[data-pid="' + $cid + '"]').remove();
	$.ajax({
		url: 'update',
		type: 'post',
		data: 'cloud_close=' + $cid
	});
}

function cloud(url){
	if (url == '/') url = '';
	
	$('#taskbar nav').append('<div data-pid="' + window.process + '" class="puddle ' + url + '"></div>');
						 
	$('body').append('<section data-pid="' + window.process + '" class="cloud resizable"><div class="top">Adeptx ' + url + '<div class="weather close"></div><div class="weather maximize"></div><div class="weather minimize"></div></div><div class="steam"></div></section>');	// <div class="resize"></div>
	$cloud = $('section.cloud[data-pid="' + window.process + '"]');
	$cloud.css({top: $('body').scrollTop() + 40 + 'px', left: $('body').scrollLeft() + 'px'});
	
	// $cloud.resizable();

	$(function() {
		$(".cloud").draggable();
		$(".cloud").resizable();
    // $( "#resizable" ).resizable();
	});
	
	$.ajax({
		type: 'post',
		data: {page: url},
		dataType: 'html',
		error: function(error) {
			systemMessage('cloud.js:error1<br>Ошибка запроса. Подробности в консоли.');
			console.error(error);
		},
		success: function(cloud) {
			// ajax - async func, you must process++ only on SUCCESS
			$steam = $('.cloud[data-pid="' + (window.process++) + '"] .steam');
			$steam.html(cloud);
			
			// вслед за html посылаем запрос за соотв. js-файлом. .. НО зачем?!
			// $.ajax({
			// 	type: 'post',
			// 	data: 'page=' + 'js/' + url + '/' + url + '.js',
			// 	success: function(cloud_js){
			// 		eval(cloud_js);
			// 	}
			// });
		}
	});
}

function new_cloud($url) {
	window.previous_focus = window.process;
	window.focus = window.process;
	cloud($url);	// а здесь window.process++ после получения данных
}

/*	<? /*
	$res = $mysqli->query('SELECT line_value FROM `' . $database['prefix'] . 'session` WHERE user_id="' . $_SESSION['id'] .'" AND line_desc="cloud"');
	if (!$res) echo(',"#' . $ajax['id']['cmd']['answer'] . '":"' . $msg['cmd']['cloud']['mysql_error_5'] . '"}');
	$res = $mysqli->fetch_array($res);

	// $res['id'];	// we can use it as $pid & last $pid give us window.proccess value
// or just as is: cloud() autoincrement $pid and window.process
	
	foreach($res['line_value'] as $cloud) {
?>
	cloud('<?=$cloud?>');
<? } *-/ ?>
*/