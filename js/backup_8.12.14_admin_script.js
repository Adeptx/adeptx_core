var page;
$(document).ready(function(){
	page = $("#page").attr("page");
	win.init( $("#great-gatsby"), $("#great-gatsby #window") );
	$(window).resize(function(){
		win.resize();
	});
	admin.init();
});

var jQ = {};
jQ.flag = {};

var admin = {};
var common = {};

admin.init = function(){
	common.menu.init();
	if ( admin[ page ] )
		if ( typeof admin[ page ].init == "function") {
			admin[ page ].init();
			console.error("success :: shop." +page+ ".init()");
		}
		else
			console.error("error :: function admin." +page+ ".init() is not defined");
	else
		console.error("error :: cannot find admin." +page+ ".init()");
};

admin.categories = {};
admin.categories.init = function(){
	/*
	loadmore.init("category_id", 16, function( data ){
		// some function like
		$.each(data, function(index, data){
			// $("#categories-table").append("<p><b>" + data.title + "</b><br />" + data.text + "</p>");
		});
	});
	*/
	jQ.categories = $("#categories");
	admin.categories.setEvents();
	jQ.categories.on("click", ".category-add", function(){
		var me = $(this);
		
		$.ajax({
			url: "admin",
			type: "post",
			data: {do: {
					with: "categories",
					what: "add"
			}},
			success: function(answer){
				var element;
				element  = '<tr class="category">';
					element += '<td class="element-id"><span>'+answer+'</span></td>';
					element += '<td class="category-name"><span>Новая категория</span></td>';
					element += '<td class="options"><div class="category-remove">&#215;</div></td>';
				element += '</tr>';
				$(".category-add").parent().before(element);
				admin.categories.setEvents();
			},
			error: function(err){
				console.log( err );
			}
		});
		
		return false;
	});
};
admin.categories.setEvents = function(){
	common.changeTextField(
		$("#categories .category-name"),
		function( me ){
			return {
				with: "categories",
				what: "update",
				id: me.parent().parent().find(".element-id span").text(),
				change: "category_name",
				set: me.val()
			}
		}
	);
	
	jQ.categories.on("click", ".category-remove", function(){
		var me = $(this);
		var papa = me.parent().parent();
		
		$.ajax({
			url: "admin",
			type: "post",
			data: {do: {
					with: "categories",
					what: "remove",
					id: papa.find(".element-id span").text()
			}},
			success: function(answer){
				papa.remove();
			},
			error: function(err){
				console.log( err );
			}
		});
		
		return false;
	});
}

admin.products = {};
admin.products.init = function(){
	jQ.products = $("#products");
	jQ.trAddButton = jQ.products.find(".product-add").parent();
	jQ.loading = $("#loading");
	
	loadmore.init("product_id", 0, 16, function( data ){
		var element;
		$.each(data, function(index, data){

			element = admin.products.createElement(data);
			/*
			element  = '<tr class="product">';
				element += '<td class="element-id"><span>' + '</span></td>';
				//element += '<td class="element-id"><span>' +data['id']+ '</span></td>';
				element += '<td class="product-category"><span>' +data['category']+ '</span></td>';
				element += '<td class="product-name"><span>' +data['name']+ '</span></td>';
				element += '<td class="product-price"><span>' +data['price']+ '</span></td>';
				element += '<td class="product-image"><span>' +data['image']+ '</span></td>';
				element += '<td class="options"><div class="product-remove">&#215;</div></td>';
			element += '</tr>';
			*/
			$(".product-add").parent().before(element);
			admin.products.setEvents();

		});
	});
	
	loadmore.call(function( data ){
		var element;
		$.each(data, function(index, data){

			element = admin.products.createElement(data);
			$(".product-add").parent().before(element);
			admin.products.setEvents();

		});
	});
	admin.products.setEvents();

	jQ.products.on("click", ".product-add", function(){
		var me = $(this);
		
		win.show(function(){
			win.title.set( $("#msg-product-add-title").text() );
			win.content.set( $("#msg-product-add") );

			$("#window #product-add-button").on("click",function(){
				admin.products.add();
			});
				
		});

		return false;
	});

};
admin.products.createElement = function(data){
	var element;
	element  = '<tr class="product">';
		element += '<td class="element-id"><span>' + '</span></td>';
		//element += '<td class="element-id"><span>' +data['id']+ '</span></td>';
		element += '<td class="product-category"><span>' +data['category']+ '</span></td>';
		element += '<td class="product-name"><span>' +data['name']+ '</span></td>';
		element += '<td class="product-price"><span>' +data['price']+ '</span></td>';
		element += '<td class="product-image"><span>'
				+ '<form id="upload" class="upload" method="post" action="admin" enctype="multipart/form-data">'
				+	'<div id="drop" class="drop">'
				+		'<a>Сменить'
				+		'<img class="photo" src="' +data['image']+ '" alt="product_photo" title="Обновить главное фото этой товарной позиции" data-product-id="' +data['id']+ '">'
				+		'</a>'
				+		'<input type="file" name="product_image-' +data['id']+ '" multiple />'
				+	'</div>'
				+'</form></span></td>';
		element += '<td class="options"><div class="product-remove">&#215;</div></td>';
	element += '</tr>';
	return element;
}
admin.products.setEvents = function(){

	jQ.products.on("click", ".product-category", function(){
		var me = $(this);
		var papa = me.parent().parent();
		
		$.ajax({
			url: "admin",
			type: "post",
			data: {do: {
				with: "product",
				what: "update-category",
				id: papa.find(".element-id span").text(),
				change: "product_category",
				set: me.selected()
			}},
			success: function(answer){
				papa.remove();
			},
			error: function(err){
				console.log( err );
			}
		});
		
		return false;
	});

	common.changeTextField(
		$("#products .product-name"),
		function( me ){
			return {
				with: "products",
				what: "update",
				id: me.parent().parent().find(".element-id span").text(),
				change: "product_name",
				set: me.val()
			}
		}
	);
	common.changeTextField(
		$("#products .product-price"),
		function( me ){
			return {
				with: "products",
				what: "update",
				id: me.parent().parent().find(".element-id span").text(),
				change: "product_price",
				set: me.val()
			}
		}
	);
	// common.changeTextField(
	// 	$("#products .product-image"),
	// 	function( me ){
	// 		return {
	// 			with: "products",
	// 			what: "update",
	// 			id: me.parent().parent().find(".element-id span").text(),
	// 			change: "product_image",
	// 			set: me.val()
	// 		}
	// 	}
	// );


	jQ.products.on("click", ".product-remove", function(){
		var me = $(this);
		var papa = me.parent().parent();
		
		$.ajax({
			url: "admin",
			type: "post",
			data: {do: {
					with: "products",
					what: "remove",
					id: papa.find(".element-id span").text()
			}},
			success: function(answer){
				papa.remove();
			},
			error: function(err){
				console.log( err );
			}
		});
		
		return false;
	});
}
admin.products.add = function (){
	var product = {};
	product.name = $("#product-add-table input[name=name]").val();
	product.price = $("#product-add-table input[name=price]").val();
	product.category = $("#product-add-table select[name=category] option:selected").val();
	product.image = $("#product-add-table input[name=image]").val();
	product.type = "default";

	$.ajax({
		url: "admin",
		type: "post",
		data: {do: {
				with: "products",
				what: "add",
				product: product
		}},
		success: function(answer){
			if ( answer != false ) {
				var element = '';
				element +=	'<tr class="product">';
				element +=		'<td class="element-id"><span>' + '</span></td>';
				//element +=		'<td class="element-id"><span>' +answer+ '</span></td>';
				element +=		'<td class="product-category"><span>' +$("#product-add-table select[name=category] option:selected").text()+ '</span></td>';
				element +=		'<td class="product-name"><span>' +product.name+ '</span></td>';
				element +=		'<td class="product-price"><span>' +product.price+ '</span></td>';
				element +=		'<td class="product-image"><span>' +product.image+ '</span></td>';
				element +=		'<td class="options">';
				element +=			'<div class="product-remove">&#215;</div>';
				element +=		'</td>';
				element +=	'</tr>';

				win.hide(function(){
					$(".product-add").parent().before(element);
					admin.products.setEvents();
				});
			}
			else {
				console.error( "error :: try to add product with wrong request" );
			}
		},
		error: function(err){
			console.log( err );
		}
	});
}



common.changeTextField = function (field, getData){
	var input = field.find("input");
	$(document).on("click", function(){
		field.each(function(){
			var me = $(this).find("input");
			var name = me.val();
			if ( name ) {
				$.ajax({
					url: "admin",
					type: "post",
					data: {do: getData(me)},
					success: function(answer){
						me.parent().html( '<span>' +name+ '</span>' );
					},
					error: function(err){
						console.log( err );
					}
				});
			}
		});
	});
	field.on("click", function(){
		var me = $(this);
		if ( me.find("span").is("span") ) {
			var name = me.find("span").text();
			input.each(function(){
				var me = $(this);
				me.parent().html( '<span>' +me.val()+ '</span>' );
			});
			me.html( '<input autofocus type="text" value="' +name+ '">' );
			me.find("input").select();
		}
		
		return false;
	});

}
common.menu = {};
common.menu.init = function(){
	jQ.menu = $("#menu");
	jQ.submenu = {};
	jQ.submenu.all = $(".submenu");
	jQ.submenu.pages = $("#submenu-link-pages");

	jQ.menu.find("ul > li").on("mouseover",function(){
		var me = $(this);
		switch ( me.find("a").attr("id") ) {
			case "menu-link-pages":
				jQ.submenu.pages.show();
				break;
		}
	});
	jQ.menu.find("ul > li").on("mouseout",function(){
		jQ.submenu.all.hide();
	});
}
common.ajax = function(data, success, fail, beforeSend ){
	// возвращает проверенный ответ в json формате
	$.ajax({
		url: location.base,
		type: "post",
		data: {do: data},
		beforeSend: function() { 
			if ( beforeSend ) beforeSend();
		},
		success: function(data){
			var parsed;
			try {
				parsed = jQuery.parseJSON(data);
			}
			catch (e) {
				console.log( "error :: [common.ajax] json.parse error:" );
				console.log( data );
				if ( fail && typeof(fail) == "function" ) fail();
			}
			if ( parsed ) {
				if ( parsed.error ) {
					console.log( "error :: [common.ajax] server error:" );
					console.log( parsed.error );
					if (failure) failure();
				}
				else {
					if ( success && typeof(success) == "function" ) success( parsed );
				}
			}
		},
		error: function(err){
			console.log( err );
		}
	});
}




var loadmore = {};
loadmore.options = {};
loadmore.init = function( sortBy, startFrom, onPage, handler ) {
	// Используйте вариант $('#more').click(function() для того,
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
	jQ.loading.show();

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
			console.log(e);
		},
		function(){ 
			loadmore.options.inProgress = true;
		}
	);

}

