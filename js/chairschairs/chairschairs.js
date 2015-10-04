var shop = {};
shop.currency = {};
shop.currency.value = 1;
shop.currency.RUB_USD = 1;
shop.currency.USD_RUB = 1 / 1;

/*
var $currency = {};
$currency.preSign = '';	// '$ ', '€ ', etc
$currency.value = 1;
$currency.postSign = '';	// ' руб.', ' грн.', etc
*/
$(document).ready(function(){
	if ( $("#vk_groups").is("#vk_groups") )
		VK.Widgets.Group("vk_groups", {mode: 0, width: "135", height: "250", color1: 'FFFFFF', color2: '264963', color3: '5B7FA6'}, VKgroupID);

	// подключать только тогда, когда facebook начнет думать о людях.
	jQ.facebook = $("#fb-root");
	if ( $("#fb-root").is("#fb-root") ) {
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	}

	var timer;
	timer = setInterval(function() {
		// проверяем, появились ли элементы facebook
		// когда появятся - изменяем и удаляем.
		if ( jQ.facebook.html() ) {
			clearInterval(timer);
			console.log( 'must die' );

			var body;
			var counter = 0;
			timer = setInterval(function(){
				body = $('.fb-like-box > span:nth-child(1) > iframe:nth-child(1)');
				body.css({
					'width':'135px',
					'margin-left':'5px',
					'margin-top':'5px'
				});
				if ( counter++ > 6 ) {
					clearInterval( timer );
					console.log( 'must must must' );
				}
			}, 500);
		}
	}, 500);

	common.init();
	shop.init();
});

var jQ = {};
var common = {};
common.ajax = function(data, success, fail, caller){
	// возвращает проверенный ответ в json формате
	$.ajax({
		url: location.base,
		type: "post",
		data: {do: data},
		success: function(data){
			if ( data ) {
				var parsed;
			try {
				parsed = jQuery.parseJSON(data);
				}
				catch (e) {
					if ( caller ) console.error( "error :: [" +caller+ " > common.ajax] json.parse error:" );
					else console.error( "error :: [common.ajax] json.parse error:" );
					console.log( data );
					if ( fail && typeof(fail) == "function" ) fail();
				}
				if ( parsed ) {
					if ( parsed.error ) {
						if ( caller ) console.error( "error :: [" +caller+ " > common.ajax] server error:" );
						else console.error( "error :: [common.ajax] server error:" );
						console.log( parsed.error );
						if ( fail && typeof(fail) == "function" ) fail();
					}
					else if ( parsed ) {
						if ( success && typeof(success) == "function" ) success( parsed );
					}
					else {
						if ( caller ) console.error( "error :: [" +caller+ " > common.ajax] wrong answer from server" );
						else console.error( "error :: [common.ajax] wrong answer from server" );
					}
				}
				else {
					if ( caller ) console.error( "error :: [" +caller+ " > common.ajax] empty server response or parse result" );
					else console.error( "error :: [common.ajax] empty server response or parse result" );
				}
			}
		},
		error: function(err){
			console.error( err );
		}
	});
}

common.events = {};
common.init = function(){
	common.events.init();
	
	$('.product-image-container a').fancyzoom();
	$('a.tozoom').fancyzoom({Speed:1000});
	$('a').fancyzoom({overlay:0.8});
	$(".product-image-container").click(function(){
		$(this).find("a").click();
	});

	// var jQ = {};
	// jQ.modules = $('.module');
	$('.module').sortable({
		items: ".module",
		handle: "h3",
		placeholder: "ui-state-highlight"
	});
}
common.events.init = function(){
	common.events.click();
	common.events.mouseenter();
	common.events.mouseleave();
	common.events.submit();
	common.events.keydown();
	common.events.focusin();
	common.events.focusout();
}
common.events.click = function(){
	$(document).on('click', function(e){
		e = e || window.event;
		var me = $(e.target);
		
		if (me.is(".filter-color")) {
			shop.filters.colorClicked( me );
		}
		else if (me.is('#filters-apply')) {
			shop.filters.submit();
		}
		else if (me.is("#header-search-button")) {
			shop.filters.submit();
		}
		else if (me.is('#reviews-block-description-show')) {
			$('#reviews-block .toggle').hide();
			$('#reviews-block-description').show();
		}
		else if (me.is('#reviews-block-reviews-show, .view-reviews')) {
			$('#reviews-block .toggle').hide();
			$('#reviews-block-reviews').show();
		}
		else if (me.is('#reviews-block-delivery-show')) {
			$('#reviews-block .toggle').hide();
			$('#reviews-block-delivery').show();
		}
		else if (me.is('#exit')) {
			shop.customer.exit();
		}
		else if (me.is('.button-field')) {
			shop.customer.editField( me );
		}
		else if (me.is('#great-gatsby')) {
			win.hide();
		}
		else if (me.is('.rating')) {
			shop.product.setRating(me);
		}
		else if (me.is('#window .close')) {
			win.hide();
		}
		else if (me.is('#exit')) {
			shop.customer.exit();
		}
		else if (me.is('#one-shot-one-hit')) {
			shop.customer.oneShot();
		}
		else if (me.is('.reviews-remove-button')) {
			shop.customer.removeReview(me);
		}
		else if (me.is('.quantity-up')) {
			var new_val = Number( me.parent().find('.cart-product-quantity').val() ) + 1;
			shop.product.productQuantityChange(me, new_val);
		}
		else if (me.is('.quantity-down')) {
			var new_val = Number( me.parent().find('.cart-product-quantity').val() ) - 1;
			shop.product.productQuantityChange(me, new_val);
		}
		else if ( me.is("#add-to-cart") ) {
			shop.product.addToCartClick();
		}
		else if ( me.is("#buy-one-click") ) {
			shop.product.buyOneClick();
		}
		else if ( me.is("#cart-preview-table .remove") ) {
			shop.product.removeFromCart( me );
		}
		else if ( me.is("#cart-product-table .remove") ) {
			shop.product.removeFromCart( me );
		}
		else if ( me.is("#paymethods-table input[type=button]") ) {
			shop.paymethods.try();
		}
		else if ( me.is("#paymethods-pay") ) {
			shop.paymethods.pay();
		}
		else if ( me.is(".product-preview-image") ) {
			jQ.productColors.removeClass('active');
			$('#product-main-image img').attr({
				'src': me.attr('src').split('80x80').join('400x400')
			});
			$('.product-preview-image').addClass('nonactive');
			me.removeClass('nonactive');
		}
		else if ( me.is(".product-color > span") ) {
			shop.product.selectPictureColor( me );
		}
	});
}

common.events.focusin = function(){
	$(document).on('focusin', function(e){
		var me = $(e.target);
		if ( me.is("input, textrea") ) {
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
common.events.mouseenter = function(){
	$('.product-block').on('mouseenter', function(e){
		var me = $(e.target);
		var src = me.attr('src');
		var data = me.data('second');
	 	if (data != '/site/gcorp/images/products/no-image.png') {
	 		me.attr({'src': data});
	 	}
	});
}
common.events.mouseleave = function(){
	$('.product-block').on('mouseleave', function(e){
		var me = $(e.target);
		var src = me.attr('src');
		var data = me.data('main');
	 	me.attr({'src': data});
	});
}
common.events.submit = function(){
	$('form').on('submit', function(e){
		e.preventDefault();

		var me = $(e.target);
		if (me.is('#profile-module-block')) {
		 	shop.customer.login();
		}
		else if (me.is('#reg-module-block')) {
		 	shop.customer.registration();
		}
		else if (me.is('#add-review-form')) {
			shop.customer.addReview();
		}
	});
}
common.events.keydown = function(){
	$(document).on('keydown', function(e){
		var me = $(e.target);
		if( (e.keyCode == 13) && (e.ctrlKey || e.shiftKey) ) {
			if (me.is('#add-review-form')) {
				shop.customer.addReview();
			}
			else if (me.is("#header-search-input")) {
				shop.filters.submit();
			}
		}
		if( (e.keyCode == 13) ) {
			if (me.is("#header-search-input")) {
				shop.filters.submit();
			}
		}
	});

}
common.events.keyup = function(){
	$(document).on('keyup', function(e){
		var me = $(e.target);

		if (me.is('.cart-product-quantity')) {
			shop.product.productQuantityChange(me, me.val());
		}
	});

}




shop.currency.format = function(value, inSign, outSign){
	// возвращает конвертированную сумму + подпись валюты
	if ( value ) {
		if ( inSign && outSign) {
			// конвертируем как задано
		}
		else {
			var result = value * shop.currency.RUB_USD;
			// console.log( "shop.currency.format : " + value + " x " + shop.currency.RUB_USD + " = " + result );
			result = Number.prototype.toFixed.call(parseFloat(result) || 0, 0);
			result = result.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");
		//console.log( "shop.currency.format :: возвращаю: " + result + ' руб.' );
			return result + ' руб.';
		}
	}
	else {
		if ( value == 0 ) {
			return '0 руб.';
		}
	}
}
shop.currency.convert = function( value, inSign, outSign ){
	// возвращает сумму, конвертированную по указанному курсу.
	if ( value ) {
		if ( inSign && outSign) {
			// конвертируем как задано
		}
		else {
			var result = value * shop.currency.RUB_USD;
			result = Number.prototype.toFixed.call(parseFloat(result) || 0, 0);
			return result;
		}
	}
}

shop.init = function(){
	shop.filters.init();
	shop.leftblock.init();
	shop.leftblock.minicartReload();
	
	var page = $("body").data("page");
	if (page == '' || page == 'main') page = 'index';
	if ( shop[ page ] ) {
		if ( typeof shop[ page ].init == "function") {
			shop[ page ].init();
			console.log("success :: shop." +page+ ".init()");
		}
		else {
			console.error("error :: function shop." +page+ ".init() is not defined");
		}
	}
	else {
		console.error("error :: cannot find shop." +page+ ".init()");
	}

	// $('#buymore-block').css({'top':$('#block-right').height()-864+'px'});
}
shop.filters = {};
shop.filters.init = function(){
	jQ.filters = $("#filters-block");
	if ( $("#page").attr("page") == 'index' ) {
		shop.filters.submit();
	}
}
shop.filters.colorClicked = function( filter_clicked ){
	if ( filter_clicked ) {
		if ( filter_clicked.hasClass("active") ) {
			filter_clicked.removeClass("active");
		}
		else {
			filter_clicked.addClass("active");
		}
	}
}
shop.filters.submit = function(){
	var data = {};
	data.with = 'filters';
	data.start = 0;
	data.quantity = 16;
	
	if ( $("#page").attr("page") == 'categories' ) {
		data.category_id = $("#page").attr("data-id");
	}
	else if ( $("#page").attr("page") == 'subcategory' ) {
		data.category_id = $("#page").attr("data-id");
	}
	else if ( $("#page").attr("page") == 'product' ) {
		data.save = true;
	}

	if ( $("#filter-price-from").val() ) {
		data.min_price = $("#filter-price-from").val();
		data.min_price = data.min_price / shop.currency.RUB_USD;
		data.min_price = Number.prototype.toFixed.call(parseFloat(data.min_price) || 0, 0);
	}
	if ( $("#filter-price-to").val() ) {
		data.max_price = $("#filter-price-to").val();
		data.max_price = data.max_price / shop.currency.RUB_USD;
		data.max_price = Number.prototype.toFixed.call(parseFloat(data.max_price) || 0, 0);
	}
	
	var tmp = new Array();
	jQ.filters.find(".active").each(function(){
		tmp[ tmp.length ] = $(this).data("color");
	});
	if ( tmp.length > 0 ) data.colors = tmp;

	if ( $("#header-search-input").val() ) data.search = $("#header-search-input").val();

	// console.log("Отправляем:");
	// console.log(data);

	common.ajax(data,
	function( answer ){
		// console.log("Получаем:");
		// console.log( answer );
		var elements = new Array();
		var element;
		if ( answer.length > 0 ) {
			$.each(answer, function(index, data){
				element = shop.filters.createElement(data);
				elements[ elements.length ] = element;
			});
			$("#products-list").html( elements );
			$('body').scrollTop(830);
		}
		if ( $("#page").attr("page") == 'product' ) {	
			location.href = "/";
		}
		//console.log("Пытаемся вывести:");
		//console.log( elements );
	});
}
shop.filters.createElement = function(data){
	var element;
	element  = '<div num="' +data['product_id']+ '" class="product-block ' +data['product_type']+ '">';
		element += '<div class="product-image-container">';
			element += '<a href="' +data['image']+ '">';
			element += '<img class="product-image" src="' +data['image']+ '"/>';
			element += '</a>';
		element += '</div>';
		if (data['product_old_price'] && data['product_old_price'] > data['product_price'] && data['product_type'] == 'discount') {
			element += '<div class="product-old-price currency"><strike>' +shop.currency.format( data['product_old_price'] )+ '</strike></div>';
		}
		element += '<div class="product-price currency">' +shop.currency.format( data['product_price'] )+ '</div>';
		element += '<a href="' +data['path']+ '">';
		element += '<div class="product-name">' +data['product_name']+ '</div>';
		element += '<input type="button" value="' +data['button']+ '">';
		element += '</a>';
	element += '</div>';
	return element;
}


shop.leftblock = {};
shop.leftblock.init = function(){
	if ( $("#profile-module-block").is("div") ) {
		shop.leftblock.minicartReload();
		jQ.loginField = $("#login");
		jQ.passField = $("#password");
	}
}
shop.leftblock.minicartReload = function(){
	common.ajax({
		with: "minicart",
		what: "load"
	},
	function( answer ){
		console.log( "success: shop.leftblock.minicartReload()" );
		console.log( "shop.leftblock.minicartReload :: answer : " );
		console.log( answer );
		$("span.cart-count").text( answer["quantity"] + " " + answer["word"] );
		$("#cart-sum-number").text( shop.currency.format(answer["total"]) );
	},false,"shop.leftblock.minicartReload");
}
shop.customer = {};
shop.customer.exit = function() {
	common.ajax({
		with: "profile",
		what: "exit"
	},
	function( answer ){
		if ( answer.exit == 'ok' ) {
			location.reload();
			return false;
		}
		else {
			console.log( "autorization error :: incorrect ajax answer: " + answer );
		}
	}, false, "shop.customer.exit");
}
shop.customer.login = function(){
	jQ.loginField = $("#login");
	jQ.passField = $("#password");
	jQ.signInButton = $('#sign-in-button');
	var login = jQ.loginField.val();
	var pass = jQ.passField.val();
	var redirect_page = jQ.signInButton.parent().attr('href');
	common.ajax({
		with: "profile",
		what: "login",
		login: login,
		pass: pass
	},
	function( answer ){
		if ( answer.login == login ) {
			//console.log( answer );
			location.reload();
			// location.href = location.pathname;
			return false;
		}
		else {
			if ( answer.fail ) {
				switch ( answer.fail ) {
					case "online":
						location = redirect_page;
						break;
					default:
						console.log( "autorization error :: " + answer.fail );
						alert('Указанный e-mail не зарегистрирован на сайте или пароль введен неверно.');
						break;
				}
			}
			else {
				console.log( "autorization error :: unknown error" );
				console.log( answer );
			}
		}
	}, false, "shop.customer.login");
}



shop.index = {};
shop.product = {};
shop.categories = {};
shop.subcategories = {};
shop.profile = {};
shop.cart = {};
shop.paymethods = {};

shop.index.init = function(){/*
	$("#cart-block input[type=button]").on("click",function(){
		location = "cart";
	});*/
}

shop.product.init = function(){
	win.init( $("#great-gatsby"), $("#great-gatsby #window") );
	jQ.cartTable = $("#cart-preview-table");
	jQ.productColors = $(".product-color > span");
	
	shop.product.loadReviews();
}
shop.product.setRating = function( me ){
	common.ajax({
		with: 'products',
		what: 'update',
		id: me.data('rating'),
		change: 'rating',
		set: me.data('rating')
	},function(){
		alert('success');
	});
}
shop.product.buyOneClick = function(){
	win.show(function(){
		win.title.set( $("#msg-buy-one-click-title").text() );	// ЗАГОЛОВОК ОКНА
		win.content.set( $("#msg-buy-one-click-content") );		// СОДЕРЖИМОЕ ОКНА
	});
}
shop.product.addToCartClick = function(){
	win.show(function(){
		win.title.set( $("#msg-product-add-title").text() );	// ЗАГОЛОВОК ОКНА
		win.content.set( $("#msg-product-add-content") );		// СОДЕРЖИМОЕ ОКНА
	},
	function(){
		// подгрузить содержимое таблицы через ajax. Получим data
		//$("#loading-cart").show();
		shop.product.addToCart();
	});
}
shop.product.addToCart = function(){
	common.ajax({
		with: "cart",
		what: "add",
		id: $("#add-to-cart").data("id")
	},
	function(){
		shop.product.loadCart();
	}, false, "shop.product.addToCart");
}
shop.product.productQuantityChange = function( me, value ){
	if ( value > 0 ) {
		common.ajax({
			with: "cart",
			what: "change",
			id: me.closest("tr").data("id"),
			set: value
		},
		function(){
			if ( $("#cart-product-table").is("table") ) {
				shop.cart.loadCart();
			}
			else if ( $("#cart-preview-table").is("table") ) {
				shop.product.loadCart();
			}
			console.log( "quantity changed to : " + value );
			console.log( me );
		}, false, "shop.product.productQuantityChange");
	}
}
shop.product.loadCart = function(){
	$("#loading-cart").show();
	shop.leftblock.minicartReload();
	common.ajax({
		with: "cart",
		what: "load"
	},
	function(answer){
		$("#loading-cart").hide();

		var element;
		var total = 0;
		var sum_arr = new Array();

		console.log( "success :: shop.product.loadCart :: answer" );
		console.log( answer );

		$(".cart-product").remove();
		$(".cart-product-hr").remove();
		if (answer.length > 0) {
			$.each(answer, function(index, data){
				element  = '<tr class="cart-product" data-id="'+data["id"]+'">';
					sum_arr[index] = data["quantity"] * data["price"];
					total += sum_arr[index];
					element += '<td class="remove">&#10005;</td>';
					element += '<td class="image"><img src="'+data["image"]+'"></td>';
					element += '<td class="name">'+data["name"]+'</td>';
					element += '<td class="quantity">';
					element += '<input class="cart-product-quantity" type="text" value="'+data["quantity"]+'"/>';
					element += '<div class="quantity-up">+</div>';
					element += '<div class="quantity-down">-</div>';
					element += '</td>';
					element += '<td class="price">'+ shop.currency.format(data["price"]) +'</td>';
					element += '<td class="sum">'+ shop.currency.format(data["sum"]) +'</td>';
				element += '</tr>';
				element += '<tr class="cart-product-hr"><td colspan="6"><hr></td></tr>';
				
				shop.product.setEvents();

				$("#cart-preview-total").before( $( element ) );
				$("#cart-preview-table .total-sum").text( shop.currency.format(total) );
			});
		}
		else {
			// корзина пуста
		}
		
	}, false, "shop.product.loadCart");
}
shop.product.removeFromCart = function( me ){
	var papa = me.closest(".cart-product");
	var id = papa.data("id");
	common.ajax({
		with: "cart",
		what: "remove",
		id: id
	},
	function(){
		$(".cart-product").remove();
		$(".cart-product-hr").remove();
		if ( $("#cart-product-table").is("table") ) {
			shop.cart.loadCart();
		}
		else if ( $("#cart-preview-table").is("table") ) {
			shop.product.loadCart();
		}
	}, false, "shop.product.setEvents");
}
shop.product.setEvents = function(){
	$(".button-to-paymethods").on('click',function(){
		location = 'paymethods';
	});
}
shop.product.selectPictureColor = function( me ){
	jQ.productColors.removeClass('active');
	if ( me.data('picture') ) {
		me.addClass('active');
		$('#product-main-image img').attr( 'src', me.data('picture') );
	}
	else {
		// к цвету товара не привязано изображение
	}
}



shop.customer.oneShot = function() {
	common.ajax({
		with: "product",
		what: "one-shot",
		id: $('#one-shot-one-hit').data('id'),
		user_name: $('#one-shot-name').val(),
		user_phone: $('#one-shot-phone').val(),
		user_email: $('#one-shot-email').val()
	},
	function( answer ){
		console.log( answer );
		if ( answer.success ) {
			$('#one-shot-block input[type=text]').removeClass('incorrect');
			switch ( answer.success ) {
				case 'too-few-data':
					$('#one-shot-block input[type=text]').addClass('incorrect');
					break;
				case 'wrong-phone':
					$('#one-shot-phone').addClass('incorrect');
					break;
				case 'wrong-email':
					$('#one-shot-email').addClass('incorrect');
					break;
				case 'buy-one-click':
					win.hide(function(){
						shop.leftblock.minicartReload();
					},
					function(){
						console.log( 'shop.customer.oneShot :: success :' );
						console.log( answer );
						alert('Спасибо за заказ! Наш оператор в ближайшее время свяжется с вами.');
						// Подробности о заказе мы уже отправили на Ваш e-mail.
					});
					break;
				default:
					console.log( answer );
					break;
			}
		}
		else {
			console.error("shop.customer.oneShot :: error :");
			alert( answer );
		}
	}, false, "shop.customer.oneShot");
}
shop.customer.removeReview = function(me) {
	jQ.reviews = $("#reviews-block-reviews");

	common.ajax({
		with: "reviews",
		what: "remove",
		id: jQ.reviews.data("product-id"),
		review_id: me.data('review-id')
	},
	function( answer ){
		if (!answer.fail) {
			me.parent().remove();
		}
		else {
			console.log("shop.customer.removeReview error :: " + answer.fail);
		}
	}, false, "shop.customer.addReview");
}
shop.customer.addReview = function() {
	jQ.reviews = $("#reviews-block-reviews");

	common.ajax({
		with: "reviews",
		what: "add",
		id: jQ.reviews.data("product-id"),
		name: $('#reviews-block-new-review-author').val(),
		text: $('#reviews-block-new-review-fild').val()
	},
	function( answer ){
		if (!answer.fail) {
			var element;
			element  = '<div class="reviews-block-review">';
				element += '<img src="'+answer.image+'" class="review-image">';
				element += '<div class="reviews-block-name">';
				if (answer.author) element += answer.author;
				else element += 'Анонимно';
				element += '</div>';
				element += '<div class="reviews-block-text">'+answer.text+'</div>';
				element += '<input type="button" class="reviews-remove-button" value="✕" data-review-id="'+answer.review_id+'">';
			element += '</div>';

			jQ.reviews.append( $( element ) );
			$(window).scrollTop(100500);
		}
		else {
			console.log("shop.customer.addReview error :: " + answer.fail);
		}
	}, false, "shop.customer.addReview");
}
shop.product.loadReviews = function(){
	jQ.reviews = $("#reviews-block-reviews");
	common.ajax({
		with: "reviews",
		what: "load",
		id: jQ.reviews.data("product-id")
	},
	function( answer ){
		if (answer.length > 0) {
			var element;
			$.each(answer, function(index, data){
				element  = '<div class="reviews-block-review">';
					element += '<img src="'+data['image']+'" class="review-image">';
					element += '<div class="reviews-block-name">';
					if (data['author']) element += data['author'];
					else element += 'Анонимно';
					element += '</div>';
					element += '<div class="reviews-block-text">'+data['text']+'</div>';
				element += '</div>';

				jQ.reviews.append( $( element ) );
			});
		}
		else {
			jQ.reviews.append( $( "<span>Никто пока не оставил отзыв об этом товаре. Вы будете первым.</span>" ) );
		}
	}, false, "shop.product.loadReviews");
}




shop.cart.title = "";
shop.cart.init = function(){
	jQ.cartTable = $("#cart-product-table");
	jQ.button = $("#content input[type=button]");

	if (shop.cart.title == "") shop.cart.title = $(".title").html();
	$(".title").html("<td class='title-wide' colspan='6'>Корзина пуста</td>");

	shop.cart.loadCart();
	shop.cart.setEvents();
	jQ.button.click(function(){
		location = "paymethods";
		return false;
	});
}
shop.cart.setEvents = function(){
	$("#cart-product-table").on("click", ".remove", function(){
		var me = $(this);
		var papa = me.parent();
		var id = me.data("id");
		common.ajax({
			with: "cart",
			what: "remove",
			id: id
		},
		function(){
			$(".cart-product").remove();
			$(".cart-product-hr").remove();
			shop.cart.loadCart();
		}, false, "shop.cart.setEvents");
	});
}
shop.cart.loadCart = function(){
	$("#loading-cart").show();
	common.ajax({
		with: "cart",
		what: "load"
	},
	function(answer){
		var element;
		var total = 0;
		var sum_arr = new Array();

		$("#loading-cart").hide();

		jQ.cartTable.find(".cart-product").remove();
		jQ.cartTable.find(".cart-product-hr").remove();
		if (answer.length > 0) {
			if ( shop.cart.title != "") {
				$(".title").html( shop.cart.title );
				shop.cart.title = "";
			}

			console.log( "shop.cart.loadCart :: answer: " );
			console.log( answer );

			$.each(answer, function(index, data){
				element  = '<tr class="cart-product" data-id="'+data["id"]+'">';
					sum_arr[index] = data["quantity"] * data["price"];
					total += sum_arr[index];
					element += '<td class="remove">&#10005;</td>';
					element += '<td class="image"><img src="'+data["image"]+'"></td>';
					element += '<td class="name">'+data["name"]+'</td>';
					element += '<td class="quantity">';
					element += '<input class="cart-product-quantity" data-id="' +data["id"]+ '" type="text" value="'+data["quantity"]+'"/>';
					element += '<div class="quantity-up" data-id="' +data["id"]+ '">+</div>';
					element += '<div class="quantity-down" data-id="' +data["id"]+ '">-</div>';
					element += '</td>';
					element += '<td class="price">'+shop.currency.format(data["price"])+'</td>';
					element += '<td class="sum">'+shop.currency.format(sum_arr[index])+'</td>';
				element += '</tr>';
				element += '<tr class="cart-product-hr"><td colspan="6"><hr></td></tr>';
				shop.cart.setEvents();

				//$(".cart-product").empty();
				$("#cart-product-total").before( $( element ) );
				$("#cart-product-table .total-sum").text( shop.currency.format(total) );
			});
		}
		else {
			if (shop.cart.title == "") shop.cart.title = $(".title").html();
			$(".title").html("<td class='title-wide' colspan='6'>Корзина пуста</td>");
		}
		
	},
	function(){
		$("#loading-cart").hide();
	},"shop.cart.loadCart");
}


shop.profile.init = function(){
	jQ.loginField = $("#login");
	jQ.passField = $("#password");
	jQ.userName = $("#avatar-block > h3");
	jQ.userPhoto = $("#avatar-block > img");

	shop.profile.dataReload();
	if ( $("#avatar-block").is("div") ) {
		shop.leftblock.minicartReload();
	}
}
shop.customer.registration = function(){
	jQ.regButton = $('#reg-in-button');
	var login = jQ.loginField.val();
	var pass = jQ.passField.val();
	var redirect_page = jQ.regButton.parent().attr('href');
	common.ajax({
		with: "profile",
		what: "reg",
		login: login,
		pass: pass
	},
	function( answer ){
		if ( answer.success == login ) {
			console.log( answer );
			alert( 'На почтовый ящик ' +login+ ' было отправлено письмо' );
			location = redirect_page;
		}
		else {
			if ( answer.fail ) {
				switch ( answer.fail ) {
					default:
						alert(answer.fail);
						break;
				}
			}
			else {
				console.log( "registration error :: unknown error" );
				console.log( answer );
			}
		}
	}, false ,"shop.customer.registration");
}
shop.customer.editField = function( me ){
	var myname = me.attr("field");
	var fieldValue;
	switch ( myname ) {
		case "first-name":
		case "last-name":
		case "email":
			fieldValue = me.closest('.option').find(".option-field").val();
			break;
		case "sex":
			fieldValue = me.closest('.option').find("#sex-on-fire option:selected").val();
			break;
		case "pass":
			fieldValue = me.closest('.option').find(".option-field").val();
			break;
		default:
			console.log('shop.customer.editField error :: unknown field name input[field=???]');
			break;
	}
	if ( !fieldValue ) {
		fieldValue = '';
	}
	
	common.ajax({
		with: "profile",
		what: "edit",
		field: myname,
		set: fieldValue
	},
	function( answer ){
		shop.profile.dataReload();
		if ( answer.success == myname ) {
			console.log( answer.success );
			alert('Введенная иформация успешно сохранена!');
		}
		else {
			if ( answer.fail ) {
				switch ( answer.fail ) {
					default:
						if ( answer.what ) {
							alert('Поле заполнено некорректно!');
							console.log( "edit error :: [" + answer.what + "] " + answer.fail );
						}
						else {
							alert('Поле заполнено некорректно!');
							console.log( "edit error :: [] " + answer.fail );
						}
						break;
				}
			}
			else {
				console.log( "edit error :: unknown error" );
				console.log( answer );
			}
		}
	}, false ,"shop.customer.editField");

}
shop.profile.dataReload = function(){
	if ( $("#avatar-block").is("div") ) {
		common.ajax({
			with: "profile",
			what: "reload"
		},
		function( answer ){
			jQ.userName.html( answer.first_name + "<br>" + answer.last_name );
			jQ.userPhoto.attr("src", answer.photo );
		}, false ,"shop.profile.dataReload");
	}
}



shop.paymethods.init = function(){
	win.init( $("#great-gatsby"), $("#great-gatsby #window") );
	jQ.cartTable = $("#cart-preview-table");
	
	jQ.allPaymethods = $(".paymethods");
	jQ.eachPaymethod = jQ.allPaymethods.find(".paymethod");
	shop.paymethods.setEvents();
}
shop.paymethods.setEvents = function(){
	jQ.eachPaymethod.on("click",function(){
		var me = $(this);
		jQ.eachPaymethod.removeClass("active");
		if ( !me.hasClass("active") ) {
			me.addClass("active");
		}
	});
}
shop.paymethods.try = function(){
	// проверяем, залогинен ли юзер.
	// если нет, высветим окошко спрашивающее инфу
	common.ajax({
		with: 'paymethods',
		what: 'try'
	},
	function( answer ){

		console.log( answer );

		if ( answer['success'] == 'online' ) {
			shop.paymethods.pay( 'online' );
		}
		else if ( answer['success'] == 'offline' ) {
			win.show(function(){
				win.title.set( $("#msg-buy-one-click-title").text() );
				win.content.set( $("#msg-buy-one-click-content") );
			});
		}
		else {
			console.error( "shop.paymethods.try :: server crazy answer" );
		}
	},false,"shop.paymethods.try");
}
shop.paymethods.pay = function( online ){
	var method = $(".paymethods").find(".active").data("method");
	console.log( "shop.paymethods.pay :: selected " + method );
	var someFieldIsEmpty = false;

	$('#window #one-shot-block input[type=text]').removeClass('incorrect');
	$('#window #one-shot-block input[type=text]').each(function(){
		if ( $(this).val() == "" ) {
			$(this).addClass('incorrect');
			someFieldIsEmpty = true;
		}
	});

	var data;
	if ( !someFieldIsEmpty ) {
		data = {
			with: 'paymethods',
			what: 'pay',
			method: method,
			user_name: $('#window #one-shot-block #one-shot-name').val(),
			user_email: $('#window #one-shot-block #one-shot-email').val(),
			user_phone: $('#window #one-shot-block #one-shot-phone').val()
		};
	}
	else if ( online ) {
		data = {
			with: 'paymethods',
			what: 'pay',
			method: method
		};
	}

	if ( !someFieldIsEmpty || online ) {
		common.ajax(
		data,
		function( answer ){
			console.log( answer );
			if ( answer['success'] == 'too-few-data' ) {
				$('#window #one-shot-block input[type=text]').removeClass('incorrect');
				$('#window #one-shot-block input[type=text]').addClass('incorrect');
			}
			else if ( answer.success == 'wrong-phone' ) {
				console.log( 'wrong-phone' );
				$('#window #one-shot-block #one-shot-phone').removeClass('incorrect');
				$('#window #one-shot-block #one-shot-phone').addClass('incorrect');
			}
			else if ( answer.success == 'wrong-email' ) {
				console.log( 'wrong-email' );
				$('#window #one-shot-block #one-shot-email').removeClass('incorrect');
				$('#window #one-shot-block #one-shot-email').addClass('incorrect');
			}
			else {
				win.hide();
				//location = answer.success;
			}
		},
		false,"shop.paymethods.pay");
	}
}


var win = {};
win.init = function( bg, body ){
	win.bg = bg;
	win.body = body;
	win.close = win.body.find(".close");

	win.title = {};
	win.content = {};
	win.title.inner = win.body.find(".window-title");
	win.content.inner = win.body.find(".window-content");
	win.title.set = function( value ){
		win.title.inner.text( value );
	}
	win.content.set = function( value ){
		if (typeof(value) == "object" ) {
			win.body.css({
				"width": value.css("width"),
				"height": value.css("height")
			});
			win.content.inner.html( value.html() );
		}
		else
			win.content.inner.html( value );
		win.resize();
	}
	$(window).resize(function(){
		win.resize();
	});
	win.bg.hide();
	win.body.hide();
	win.resize();
}
win.resize = function(){
	var w = win.body.css("width");
	var h = win.body.css("height");
	if (w && h) {
		win.width = w.substr(0, w.indexOf("px"));
		win.height = h.substr(0, h.indexOf("px"));
	}
	else {
		win.width = 240;
		win.height = 180;
	}
	if (win.width < 240) win.width = 240;
	if (win.height < 180) win.height = 180;
	win.clientWidth = $(window).width();
	win.clientHeight = $(window).height();
	win.body.css({
		"position": "fixed",
		"top": 0.5 * (Number(win.clientHeight) - Number(win.height)) + "px",
		"left": (0.5 * (Number(win.clientWidth) - Number(win.width)) - 10) + "px"
	});
}
win.show = function( init, handler ){
	if ( init ) init();

	win.bg.show();
	win.body.show();
	
	if ( handler ) handler();
}
win.hide = function( init, handler ) {
	if ( init ) init();
	
	win.bg.hide();
	win.body.hide();

	if ( handler ) handler();
}


















$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }
// ты обратно изменил на 1000 000 000 ?
        if (bytes >= 1024*1024*1024) {
            return (bytes / (1024*1024*1024)).toFixed(2) + ' GB';
        }

        if (bytes >= (1024*1024)) {
            return (bytes / (1024*1024)).toFixed(2) + ' MB';
        }

        return (bytes / 1024).toFixed(2) + ' KB';
    }

});