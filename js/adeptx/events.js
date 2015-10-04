// ajax change timezone
	$('.date').on('change', '.timezone', function(){
		systemMessage('ajax.js:x4<br>Часовой пояс успешно изменён.');	// Timezone successfully set
		update({timezone: $(this).val()}, 'replace');
	});
// ajax add new post
	$('#add_post').on('click', '.ajax', function(){
		systemMessage('ajax.js:x5<br>Publish or save_to_draft new article.');
		update({
			 post:	'.'
			,href:	$('#add_post #new_post_href').val()
			,text:	$('#add_post #new_post_text').val()
			,code:	$('#add_post #new_post_code').val()
			,date:	$('#add_post #new_post_date').val()
			,source:$('#add_post #new_post_source').val()
			,public:$(this).attr('id')
		});
	});
	
/* // ajax link skipping	
	$('nav').on('click', 'a', function(e){
		e.preventDefault();
		
		var url = $(this).attr('href');
		//$.address.value(url);
		if (url == '/') url = '';
		history.pushState('', '', '/' + url);
		$.ajax({
			type: 'post',
			data: 'page=' + url,
			success: function (msg) {
				$('body article').first().html(msg);
			}
		});
		
		return false;
	}); */





/*
var keyhandler = function(e) {
	var e = e||window.event;
	if (e.keyCode == 9 && e.ctrlKey) {
		alert("Ctrl+Tab");
	}
}

if (document.addEventListener) {
	document.addEventListener('keypress', keyhandler, false);
} else if (document.attachEvent) {
	document.attachEvent('onkeypress', keyhandler);
} else {
	document.onkeypress = keyhandler;
}
 */
// $('.cloud').resizable();
	
$(window)	// document only, but many key together with identify key
.bind('keyup', 'ctrl+p', function(e){
	e.preventDefault();
	
	// if ($(e.target).is(".puddle")) $ctx = 'another ctx';
	
	window.previous_focus = 1;		
	window.focus = 1;
	$('.cloud, .puddle').remove();
	return false;
});

$(document)
.bind('keydown', 'ctrl+q', function(e){
	e.preventDefault();
	window.previous_focus = window.process;
	$cloud = $('.cloud[data-pid="' + window.focus++ + '"]');
	$cloud.toggle();
	if (window.focus >= window.process) window.focus = 1;
	return false;
})
.bind('keyup', 'ctrl+x', function(e){
	e.preventDefault();
	$('.cloud').hide();
	return false;
});

$(document).on('click', 'a.toggle', function(e){
	e.preventDefault();
	$(this).next().toggle();
	return false;
});

$(document).on('click', '#taskbar .puddle', function(e){
	window.previous_focus = window.process;
	window.focus = $(this).data('pid');
	$cloud = $('.cloud[data-pid="' + window.focus + '"]');
	$cloud.toggle();
	
	// $('section.cloud').removeClass('focus');
	// $cloud.addClass('focus');
	
	$('section.cloud').css('z-index', 1);
	$cloud.css('z-index', 2);
});

$(document).on('click', 'section.cloud .top .minimize', function(e){
	// window.previous_focus = window.process;
	window.focus = window.previous_focus;
	$(this).parent().parent().hide();
	$('body').removeClass('overflow');
});
$(document).on('click', 'section.cloud .top .maximize', function(e){
	window.previous_focus = window.process;
	window.focus = $(this).parent().parent().data('pid');
	$(this).parent().parent().toggleClass('fullscreen');
	$('body').toggleClass('overflow');
});
$(document).on('click', 'section.cloud .top .close', function(e){
	// window.previous_focus = window.process;
	window.focus = window.previous_focus;
	$process_window = $(this).parent().parent();
	$process_window.remove();
	$('#taskbar .puddle[data-pid="' + $process_window.data('pid') + '"]').remove();
	$.ajax({
		url: 'update',
		type: 'post',
		data: 'cloud_close=' + $process_window.data('pid')
	});
});
// $(function() {
// 	$(".resizable").resizable();
// 	$("#container section").sortable();
//  $("#container section").disableSelection();
// });

$(document).on('mousedown', function(e){
	var $aim = $(e.target);

	if (!$aim.is('.omen') && !$aim.is('.sweetok') && !$aim.parents().is('.sweetok')) {
		$('.sweetok').hide();
		// if ($aim.is('.sweetok')) {
		// 	$aim.show();
		// } else if ($aim.parents().is('.sweetok')) {
		// 	$aim.parents('.sweetok').show();
		// }
	}
	if ($aim.is('.omen') || $aim.parents().is('.omen')) {
		/* voluta (исп.), sukuroru (яп.), в англ. нет достойного аналога этого слова (там это scroll...), я остановился на русском варианте:) */
		if ($aim.is('.omen')) {
			$aim.next('.sweetok').toggle();
		} else if ($aim.parents().is('.omen')) {
			$aim.parents('.omen').next('.sweetok').toggle();
		}
	} else if ($aim.is('a.box')) {
		e.preventDefault();
		new_cloud($(this).attr('href'));
	}
	if ($aim.is('.cloud .top')) {
		window.previous_focus = window.process;
		window.focus = $(this).parent().data('pid');
		mouse($(this).parent(), 'move', 'xy');
	}
	if ($aim.is('.cloud .resize')) {
		window.previous_focus = window.process;
		window.focus = $(this).parent().data('pid');
		mouse($aim.parent(), 'resize', 'xy');
	} else if ($aim.is('.cloud') || $aim.parents().is('.cloud')) {
		window.previous_focus = window.process;
		if ($aim.is('.cloud')) {
			window.focus = $aim.data('pid');
		}
		else {
			window.focus = $aim.parents('.cloud').data('pid');
		}
	}
});











		$(document).on('mouseover', function(e){
			var me = $(e.target);

			if ( me.is('header nav a[href^="#"]') || me.is('header nav a[href^="#"] > span') ) {
				if ( me.is('header nav a[href^="#"] > span') ) me = me.closest('a[href^="#"]');
				var target = me.attr('href');
				$( target ).css({display:'block'});
				e.preventDefault();
			}
			else if ( me.is('.popup') ) {
				me.css({display:'none'});
				e.preventDefault();
			}
			else if ( me.is('.checkbox') ) {
				var target = me.attr('data-name');
				var value = me.attr('data-value');
				switch ( value ) {
					case 'true':
						me.attr('data-value','false');
						$('input[name="'+target+'"]').prop("checked", false);
						break;
					case 'false':
						me.attr('data-value','true');
						$('input[name="'+target+'"]').prop("checked",true);
						break;
				}
			}

		});












$(document).on('click', function(e){
	var $aim = $(e.target);

	if ($aim.is('#cmd-line .float-left')) {
		run();
	} else if ($aim.is('#cmd-line .float-right')){
		clr_line();
	} else if ($aim.is('.system-message')){
		$(this).hide();
	}
});

$(document).on('contextmenu', function(e){
	var $aim = $(e.target);
	
	if ($aim.is('#cmd-answer, #cmd-line')) {
		e.preventDefault();
	}
});

// если повесить на document, мы перезапишем его текущее событие
$(document).on('selectstart', function(e) {
	var $aim = $(e.target);
	var $darts = $aim.parents();

	// селекторы не перечисляются через запятую??? =_=
	// или не работает patents() в переменной???  =_=
	// или выделение вообще не здесь запрещено??? =(
	// все утверждения оказалис ьне верными! оказывается .not исключает селектор из выборки, но никак не связан с .is, который проверяет селектор. можно использовать только !.is
	if (!$aim.is('#cmd, #cmd-answer') && !$darts.is('#cmd, #cmd-answer')) {
		e.preventDefault();
	}
});

//$(document).bind('keydown', 'ctrl+return', 'cmd_toggle()');
window.onkeydown = function(e) {
	if (e.altKey) {		// почему-то не отрабатывает
		if (e.keyCode == 13) {
			e.preventDefault();
		}
	} else if (e.ctrlKey) {
		if (e.keyCode == 13) {		// Ctrl + Enter
			e.preventDefault();
			cmd_toggle();
		}
		if (e.keyCode == 72) {		// Ctrl + H
			e.preventDefault();
			run('help', 'append');
		}
		// if (e.keyCode == 76) {	// Ctrl + L
		// 	e.preventDefault();
		// 	run('auth', 'append');
		// }
		if (e.keyCode == 32) {		// Ctrl + Space
			e.preventDefault();
			// выполняем поэтапное считывание. если количество неэкранированных кавычек (перед котоыми не стоит нечетное количетсов обратных слешей) в тексте непарно то не выполняем этап, а добавляем к массиву и выводим что-то пользователю или делаем другое действиев зависимости от контекста
		}
		if (e.keyCode == 86) {		// Ctrl + V
			$('#cmd-line-input').focus();
		}
		// if (e.keyCode == 67) {		// Ctrl + C
		// 	e.preventDefault();
		// 	clrscr();
		// }
	} else {
		systemMessage('cmd.js:x1<br>Нажата клавиша e.keyCode=' + e.keyCode);

		$('#cmd-line-input').focus();

		if (e.keyCode == 13) {		// Enter
			e.preventDefault();
			if ($('#cmd-line-input').val()) run();
		}
		if (e.keyCode == 27) {		// Esc
			e.preventDefault();
			clrscr();
		}
		// if (e.keyCode == 32) {	// Space
		// 	e.preventDefault();
		// 	// выполняем поэтапное считывание. если количество неэкранированных кавычек в тексте непарно то не выполняем этап
		// }
		if (e.keyCode == 38) {		// Up
			e.preventDefault();
			$('#cmd-line-input').val($history[--$line]).focus();
			if($line < 0) {
				$line = 0;
				$('#cmd-line-input').val('').focus();
			}

			// when $site['update'] file return special sign --line
		}
		if (e.keyCode == 40) {		// Down
			e.preventDefault();
			$('#cmd-line-input').val($history[++$line]).focus();
			if($line > $history.length) {
				$line = $history.length;
			}
		}
	}
}