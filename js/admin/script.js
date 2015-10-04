var page;
var jQ = {};
var admin = {};
var common = {};

$(document).ready(function(){
	page = $('body').data('page');
	win.init( $("#great-gatsby"), $("#great-gatsby #window") );
	$(window).resize(function(){
		win.resize();
	});
	common.init();
	admin.init();
});

admin.init = function(){
	common.menu.init();
	if ( admin[ page ] )
		if ( typeof admin[ page ].init == "function") {
			admin[ page ].init();
			console.log("success :: admin." +page+ ".init()");
		}
		else
			console.error("error :: function admin." +page+ ".init() is not defined");
	else
		console.error("error :: cannot find admin." +page+ ".init()");
};

common.init = function(){
	jQ.loading = $("#loading");
	$.ajaxSetup({
		url: "admin",
		type: "post",
		error: function(error) {
			console.log(error);
		}
	});
	common.events.init();
    // common.carusel.autoStart('.carousel');

	$.fn.fancyzoom.defaultsOptions.imgDir = window.fancyImgDir;
	$('a.tozoom').fancyzoom({Speed:1000});
	$('a').fancyzoom({overlay:0.8});
}
common.events = {};
common.events.init = function(){
	common.events.click();
	common.events.focusin();
	common.events.focusout();
	common.events.change();
	// common.events.select();
	common.events.mouseenter();
	common.events.mouseleave();
	common.events.scroll();
}
common.events.scroll = function(){
	var lastScrollTop = 0;
	$(window).scroll(function(e){
		me = $(e.target);
		var scrollTop = $(this).scrollTop();
		if (scrollTop > lastScrollTop){
			// карусель прокрутка вправо
			if (me.is(".carousel-button-right a")) {
			    var carusel = $('.carousel');
			    common.carusel.toRight(carusel);
			}
		} else {
			// карусель прокрутка влево
			if (me.is(".carousel-button-left a")) {
			    var carusel = $('.carousel');
			    common.carusel.toLeft(carusel);
			}
		}
		lastScrollTop = scrollTop;
	});
}
common.events.mouseenter = function(){
	$(document).on('mouseenter', function(e){
		var me = $(e.target);
		// остановка карусели
		if (me.is('.carousel')) {
			me.addClass('hover');
		}
		// else if ( me.is('.carousel img') ) {
		// 	me.closest('.carousel').find('.proguct-image-remove').show();
		// }
	});
}
common.events.mouseleave = function(){
	$(document).on('mouseleave', function(e){
		var me = $(e.target);
		// запуск карусели
		if (me.is('.carousel')) {
			me.removeClass('hover');
		}
		// else if ( me.is('.carousel img') ) {
		// 	me.closest('.carousel').find('.proguct-image-remove').hide();
		// }
	});
}
common.events.click = function(){
	$(document).on('click', function(e){
		e = e || window.event;
		var me = $(e.target);
		var papa = me.closest('tr');
		var id = papa.data('id');

		if (me.is(".categories-name input, .categories-url input")) {
			me.focus();	// bugfix for firefox (see bugreport, bug #191214)
		}
		else if ( me.is('input#product-images-save') ) {	// .admin.products.saveImages
			admin.products.saveImages();
		}
		else if ( me.is('.f-color') ) {
			me.closest('.filter-colors-block').find('.f-color').removeClass('active');
			me.addClass('active');
			admin.products.pictureColorSelect( me );
		}
		else if (me.is("#product-image")) {
			console.log('[common.events.click] :: OK :: .product_image');
	        // simulate a click on the file input button to show the file browser dialog
	        papa.find('input[type=file]').click();
		}

		else if (me.is(".sort-by")) {
			admin.products.sortBy(me.data('by'));
		}
		else if (me.is("#add-product-image-button")) {
			console.log('[common.events.click] :: OK :: #add-product-image-button');
	        // simulate a click on the file input button to show the file browser dialog
	        papa.find('input[type=file]').click();
		}
		else if (me.is("#drop input")) {
			console.log('[common.events.click] :: OK :: #drop input');
		}
		else if (me.is("#products .remove")) {
			console.log('[common.events.click] :: OK :: #products .remove');
			var page = "products";
			var act = "remove";
		}
		/////////////////////////////////////////////////////////////////////////////
		else if (me.is("#products .product-details")) {
			var page = "products";
			var act = "details";
			var me = $('#product-details');

			win.show(function(){
				win.title.set( $("#msg-product-details-title").text() );
				win.content.set( $("#msg-product-details-body") );
				$('#window .window-content').css({
					'height': '100%',
					'overflow-y': 'hidden'
				});
			});

			$('#details-loading').show();
			common.ajax(
				{
					with: page,
					what: act,
					id: id
				},
				function(answer){
					$('#details-loading').hide();
					$('#product-details').data('product-id', id);

					$('#product-details input[type=file]').attr({'name':'product_image-'+answer.product_id});
					///
					$('#product-details #product-image').attr({'src':answer.product_images});
					///
					$('#product-details .product-description').val(answer.product_description);
					$('#product-details .product-delivery').val(answer.product_delivery);
					$('#product-details .product-characteristics').val(answer.product_details);

					var colorita = answer.product_colors.split(',');
					for (var i = 0; i < colorita.length; i++) {
						$('#filter-colors .filter-color[data-color=' + colorita[i].substr(6) + ']').addClass('active');
					}
				}
			);
		}
		else if ( me.is('.carousel-items img') ) {
			e.preventDefault();
			if (me.attr('src') != '/site/gcorp/images/products/no-image.png') {
				me.closest('a').fancyzoom().click();
			}
		}
		else if (me.is(".admin-table .product-images")) {
			admin.products.images(id);
		}
		else if (me.is("#product-images .image-color")) {
			var current_color = me.data('color');
			var next_color = current_color + 1;
			if (next_color > 14) next_color = 0;
			me.data('color', next_color);
			me.removeClass('color-' + current_color);
			me.addClass('color-' + next_color);
			common.ajax(
				{
					with: 'products',
					what: 'set-image-color',
					id: me.data('product'),
					change: me.data('image'),
					set: 'color-' + next_color
				},
				function(answer){
					console.log('answer');
				}
			);
		}
		else if ( me.is('.product-image-remove') ) {
			if (confirm('Удалить изображение?')) {
				admin.products.removeProductImage( me );
			}
		}
		// карусель стрела вправо
		else if (me.is(".carousel-button-right a")) {
		    var carusel = $('.carousel');
		    common.carusel.toRight(carusel);
		}
		// карусель стрелка влево
		else if (me.is(".carousel-button-left a")) {
		    var carusel = $('.carousel');
		    common.carusel.toLeft(carusel);
		}
		else if (me.is("#product-details-save")) {
			// сохраняем значения через ajax запрос и закрываем окно
			console.log( "данные отправляются и сохраняютяс по onchange, кнопка только скрывает окно" );
			win.hide();
		}
		/////////////////////////////////////////////////////////////////////////////
		else if (me.is("#categories .remove")) {
			console.log('[common.events.click] :: OK :: #categories .remove');
			var page = "categories";
			var act = "remove";
		}
		else if (me.is("#products .product-add")) {
			console.log('[common.events.click] :: OK :: #products .product-add');
			win.show(function(){
				win.title.set( $("#msg-product-add-title").text() );
				win.content.set( $("#msg-product-add") );
			});
		}
		else if (me.is("#window #products-add-button")) {
			console.log('[common.events.click] :: OK :: #window #product-add-button');
			admin.products.add();
		}
		else if (me.is("#categories .categories-add")) {
			console.log('[common.events.click] :: OK :: #categories .categories-add');
			win.show(function(){
				win.title.set( $("#msg-categories-add-title").text() );
				win.content.set( $("#msg-categories-add") );
			});
		}
		else if (me.is("#window #categories-add-button")) {
			console.log('[common.events.click] :: OK :: #window #categories-add-button');
			admin.categories.add();
		}
		else if (me.is("#infopages-table .infopages-add")) {
			tinymce.init({selector:".add-info-textarea"});
			console.log('[common.events.click] :: OK :: #infopages-table .infopages-add');
			win.show(function(){
				win.title.set( $("#msg-info-add-title").text() );
				win.content.set( $("#msg-info-add") );
			});
		}
		else if (me.is("#window #info-add-button")) {
			console.log('[common.events.click] :: OK :: #window #info-add-button');
			admin.infopages.add();
		}
		else if (me.is("#users-table .reset-user-pass")) {
			var page = "users";
			var act = "reset-pass";
			if (confirm('Подтвердите сброс пароля')) {
				console.log('Запрошен сброс пароля, но функционал пока не включен');
				alert('Пароль сброшен, пользователь получит письмо с уведомлением');
			}
		}
		else if (me.is("#users-table .remove")) {
			console.log('[common.events.click] :: OK :: #users-table .remove');
			var page = "users";
			var act = "remove";
		}
		else if (me.is("#articles-table .remove")) {
			console.log('[common.events.click] :: OK :: #articles-table .remove');
			var page = "articles";
			var act = "remove";
		}
		else if (me.is("#news-table .remove")) {
			console.log('[common.events.click] :: OK :: #news-table .remove');
			var page = "news";
			var act = "remove";
		}
		else if (me.is("#infopages-table .remove")) {
			console.log('[common.events.click] :: OK :: #infopages-table .remove');
			var page = "infopages";
			var act = "remove";
		}
		else if (me.is("#window #product-add-button")) {
			console.log('[common.events.click] :: OK :: #window #product-add-button');
			admin.products.add();
		}
		else if (me.is("#news-table .news-add")) {
			console.log('[common.events.click] :: OK :: #news-table .news-add');
			win.show(function(){
				win.title.set( $("#msg-news-add-title").text() );
				win.content.set( $("#msg-news-add") );
			});
		}
		else if (me.is("#window #news-add-button")) {
			console.log('[common.events.click] :: OK :: #window #news-add-button');
			admin.news.add();
		}
		else if (me.is("#articles-table .articles-add")) {
			console.log('[common.events.click] :: OK :: #articles-table .articles-add');
			win.show(function(){
				win.title.set( $("#msg-articles-add-title").text() );
				win.content.set( $("#msg-articles-add") );
			});
		}
		else if (me.is("#window #articles-add-button")) {
			console.log('[common.events.click] :: OK :: #window #articles-add-button');
			admin.articles.add();
		}
		else if (me.is("#product-images .filter-color")) {
			$('.filter-color').removeClass('active');
			me.addClass('active');
			$('#product-images #images-color').val('color_' + me.data('color'));
		}
		else if (me.is("#product-details .filter-color")) {
			me.toggleClass('active');
			var colors = '';
			$("#product-details .filter-color").each(function(i){
				if ($(this).hasClass('active')) colors += ',color_' + $(this).data('color');
			});
			common.ajax(
				{
					with: "products",
					what: "update",
					id: $('#product-details').data('product-id'),
					change: "product_colors",
					set: colors.substr(1)
				},
				function(answer){
					if (answer == true) console.log( 'colors in stock successfully refreshed' );
					else console.log( 'error :: colors in stock bad response' );
				}
			);
		}
		// else if (me.is('.product-name-title')) {
		// 	$elements = $('.product-name input');
		// 	$elements.sort(function (a, b) {
		//         var an = $(a).val(),
		//             bn = $(b).val();
		// 		console.log(an + ' vs ' + bn);
		//         if (an && bn) {
		//             return an.toUpperCase().localeCompare(bn.toUpperCase());
		//         }
		//         return 0;
		//     });
		//     //	console.log($(this).find('input').val());
		//     $(".admin-table tbody").append($('#products .product-add').parent());
		else {
			// if (me.is("#categories .categories-name span"))
			// {
			// 	console.log('[common.events.click] :: OK :: #categories .categories-name span');
			// 	var papa = me.closest('tr');
			// 	papa.html( '<input autofocus type="text" value="' +me.text()+ '">' );
			// 	papa.find('input').focus();
			// }
			if ( me.is("#news-table .news-text span") ) {
				console.log('[common.events.click] :: OK :: #news-table .news-text span');
				var papa = me.closest('tr');
				papa.html( '<textarea autofocus>'+me.text()+ '</textarea>' );
				papa.find('textarea').focus();
			}
		}

		if (act == "remove") {
			if (confirm('Подтвердите удаление')) {
				common.ajax(
					{
						with: page,
						what: act,
						id: id
					},
					function(answer){
						papa.remove();
					}
				);
			}
		}
	});
}
common.events.focusin = function(){
	$(document).on('focusin', function(e){
		var me = $(e.target);
		if ( me.is("input, textrea") ) {
			me.data('previous-value', me.val());

			me.data('placeholder', me.attr('placeholder') );
			me.attr('placeholder', '');
		}
	});
}
common.events.focusout = function(){
	$(document).on('focusout', function(e){
		var me = $(e.target);
		if ( me.is("input, textrea") ) {
			me.attr('placeholder', me.data('placeholder') );
		}
	});
}
common.events.change = function(){
	$(document).on('change', function(e){
	// e.preventDefault();
		var me = $(e.target);
		var papa = me.closest('tr');
		var id = papa.data('id');
		var set = me.val();
		var change =  me.attr('name');
		var required = false;
		var what = "update";
		var page = $('body').data('page');

		if (me.is("#categories .categories-name input")) {
			required = true;
		}
		else if (me.is("#site-options")) {
			what = "setup";
			change = "settings";
			required = true;
		}
		else if (me.is("#categories .categories-url input")) {
			required = true;
		}
		else if (me.is("#options .options-value input")) {
			required = true;
		}
		else if (me.is(".admin-table .product-name input")) {
			required = true;
		}
		else if (me.is(".admin-table .product-type select")) {
			if (set == 'discount') {
				papa.find('.product-old-price input').prop('disabled', false);
			}
			else {
				papa.find('.product-old-price input').prop('disabled', true);
			}
		}
		else if (me.is("#product-details .product-characteristics")) {
			change = 'details';
			id = $('#product-details').data('product-id');
		}
		else if (me.is("#product-details .product-description")) {
			change = 'product_description';
			id = $('#product-details').data('product-id');
		}
		else if (me.is("#product-details .product-delivery")) {
			change = 'product_delivery';
			id = $('#product-details').data('product-id');
		}
		else if ( me.is('.product-image-rate') ) {
			if ( me.val() ) {
				var newValue = me.val();
				switch ( newValue ) {
					case '1':
						admin.products.setMainImage(me);
						break;
					case '2':
						admin.products.setSecondImage(me);
						break;
					default:
						console.log( typeof newValue + " : " + newValue );
						break;
				}
				$('.product-image-rate[value=' +me.val()+ ']').val(0);
				me.val( newValue );
			}
		}
		else if (me.is("#product-images input[type=file]")) {
			if (me.val()) {
				$('#product-image').attr('src', '/site/admin/images/plus-ok.png');
			}
			else {
				$('#product-image').attr('src', '/site/admin/images/add-file.png');
			}
		}
		// else if (me.is("#drop input")) {
		// 	page = 'products';
		// 	change = 'product_image';
		// 	// $('#upload').submit();
		// }

		if (set || !required) {
			if (change) {
				common.ajax({
						with: page,
						what: what,
						id: id,
						change: change,
						set: set
					},
					function(answer){
						if ( change === "category_id" ) {
							$('.product[data-id=' +id+ ']').find('.product-subcategory').html( admin.products.selectSubcategory(answer.set) );
						}
						// console.log( answer );
						// me.closest('tr').html( '<span>' +set+ '</span>' );
						me.val(set);
						if (change == "product_name") {
							$('.product[data-id="'+answer.id+'"] .product-id input').val(answer.id + answer.set.substr(0,2).toUpperCase());
						}
						me.data('previous-value', me.val());
					}
				);
			}
			else {
				console.log('[common.events.change] :: changed field is not in send-list');
			}
		}
		else {
			alert('Значение не должно быть пустым!');
			me.val(me.data('previous-value'));
			console.log('[common.events.change] :: changed field is empty');
			return false;
		}

	});
}

common.events.select = function(){
	$(document).on('select', function(e){
		e = e || window.event;
		var me = $(e.target);
		var papa = me.closest('tr');
		var id = papa.data('id');
		var new_val = me.val();
		var change = '';

		if (me.is("#products .product-category select")) {
			change = 'product_category';
		} else if (me.is("#products .product-type select")) {
			change = 'product_type';
		} else {
			change = false;
			console.log('[common.events.select] :: unknown selected element');
		}

		if (change) {
			common.ajax(
				{
					with: "products",
					what: "update",
					id: id,
					change: change,
					set: new_val
				},
				function(answer){
					//me.closest('tr').html( '<span>' +name+ '</span>' );
					me.val(new_val);
				}
			);
		}
	});
}

common.menu = {};
common.menu.init = function(){
	jQ.menu = $("#menu");
	jQ.submenu = {};
	jQ.submenu.all = $(".submenu");
	jQ.submenu.pages = $("#submenu-link-pages");
	
	$("#menu ul > li").on("click",function(){
		if ( $(this).find("a").attr("target") != '_blank' ) {
			var href = $(this).find("a").attr("href");
			if ( href ) {
				location = href;
			}
		}
	});
	jQ.menu.find("ul > li").on("mouseenter",function(){
		var me = $(this);
		switch ( me.find("a").attr("id") ) {
			case "menu-link-pages":
				jQ.submenu.pages.show(300);
				break;
		}
	});
	jQ.menu.find(".submenu").on("mouseleave",function(){
		jQ.submenu.all.hide();
	});
	$(document).on('click', function(){
		jQ.submenu.all.hide();
	});
}
common.ajax = function(data, success, fail, beforeSend ){
	// возвращает проверенный ответ в json формате
	$.ajax({
		data: {do: data},
		beforeSend: function() {
			if ( beforeSend && typeof(beforeSend) == "function" ) beforeSend();
		},
		success: function(data){
			if ( data ) {
				var parsed;
				try {
					parsed = jQuery.parseJSON(data);
				}
				catch (e) {
					console.log( "[common.ajax] :: fail :: json.parse error:" );
					console.log( data );
					if ( fail && typeof(fail) == "function" ) fail();
				}
				if ( parsed ) {
					if ( parsed.fail ) {
						console.log( "[common.ajax] :: fail :: server error :: " + parsed.fail );
						console.log( parsed );
						if ( parsed.fail == 'access-denied' ) {
							// if (confirm('Время сессии истекло. Пожалуйста, авторизуйтесь заново.')) {
							// 	location.reload();
							// }
						}
						if ( fail && typeof(fail) == "function" ) fail( parsed );
					}
					else {
						if ( success && typeof(success) == "function" ) success( parsed );
					}
				}
			}
			else {
				console.log( "[common.ajax] :: fail :: empty server response" );
			}
			
		}
	});
}




var loadmore = {};
loadmore.options = {};
loadmore.init = function( sortBy, startFrom, onPage, handler ) {
	console.log("success :: loadmore.init()");
	// Используйте вариант yажатия кнопки "#products #more"
	// чтобы дать пользователю возможность управлять процессом,
	// кликая по кнопке "Дальше" под блоком статей (см. файл index.php)
	loadmore.restart( sortBy, startFrom, onPage, handler );
	$(window).scroll(function() {
		// Если высота окна + высота прокрутки больше или равны высоте всего документа
		// и ajax-запрос в настоящий момент не выполняется, то запускаем ajax-запрос
		if($(window).scrollTop() + $(window).height() >= $(document).height() - 200 && !loadmore.options.inProgress) {
			loadmore.call( handler );
		}
	});
}
loadmore.restart = function( sortBy, startFrom, onPage, handler ){
	if ( handler && typeof(handler) == "function" ) {
		loadmore.options.onPage = onPage;
		loadmore.options.sortBy = sortBy;

		loadmore.options.unable = false;
		loadmore.options.inProgress = false;
		loadmore.options.startFrom = startFrom;
		loadmore.options.from = page;
	}
	else {
		console.error("error :: incorrect calling loadmore.init()");
	}
}
loadmore.call = function( handler ){
	if ( loadmore.options.unable ) return;
	
	common.ajax({
			with: "loadMore",
			from: loadmore.options.from,
			sort: loadmore.options.sortBy,
			start: loadmore.options.startFrom,
			quantity: loadmore.options.onPage
		},
		function( answer ){
			jQ.loading.hide();
			if (answer.length > 0) {
				if ( typeof(handler) == "function") handler( answer );
				loadmore.options.inProgress = false;
				loadmore.options.startFrom += loadmore.options.onPage;
			}
			else if (!answer) {
				console.log("больше нечего показывать");
				loadmore.options.unable = true;
			}
		},
		function(e){
			jQ.loading.hide();
			console.log( "[loadmore.call] :: ajax.fail" );
		},
		function(){
			jQ.loading.show();
			loadmore.options.inProgress = true;
		}
	);

}