admin.products = {};
admin.products.current = -1; // исп. для изображений товара
admin.products.colorsBlock = function( selected ){
	var active = new Array();
	if ( selected ) {
		if ( $.isArray(selected) ) {
			active = selected;
		}
		else {
			active[0] = selected;
		}
	}

	var colors = [[0,1,2,3,4],[5,6,7,8,9],[10,11,12,13,14]];
	var result;
	var contains;

	result  = '<div class="filter-colors-block">';
	$.each(colors, function(index, colorRow){
		$.each(colorRow, function(i, color){
			contains = false;
			$.each(active, function(i,me){
				if ( me == color ) {
					contains = true;
					return;
				}
			});
			if ( contains ) {
				result += '<span class="f-color active filter-color-' +color+ '" data-color="' +color+ '"></span>';
			}
			else {
				result += '<span class="f-color filter-color-' +color+ '" data-color="' +color+ '"></span>';
			}
		});
		// colorsBlock += '<br>';
	});
	result += '</div>';
	return result;
}
admin.products.init = function(){
	jQ.products = $("#products");
	jQ.trAddButton = jQ.products.find(".product-add").closest('tr');
	
	// получаем список категорий всего один раз и затем можем использовать его многократно
	common.ajax({
		with: 'categories',
		what: 'get-all'
	},
	function( answer ){
		admin.products.categories = answer;
		
		// здесь получаем ajax-ом список всех подкатегорий.
		common.ajax({
			with: "products",
			what: "get-cats"
		},
		function( answer ){
			if ( answer.success ) {
				console.log( "admin.products.init :: admin.products.cats : success" );
				admin.products.cats = answer.success;
			}
		},
		false,"admin.products.init");

		admin.products.sortBy('id');
	});
};
admin.products.pictureColorSelect = function( me ){
	common.ajax({
		with: 'products',
		what: 'set-image-color',
		id: me.closest('.product-image-options').data('id'),
		change: me.closest('.product-image-options').data('image'),
		set: 'color_' + me.data('color')
	},
	function( answer ){
		console.log( answer );
	},
	false,'admin.products.pictureColorSelect');
}
admin.products.sortBy = function(by){
	// product_id, category_id, product_subcategory_id => id
	var sort = {
		// все таблицы должны не иметь приставок в поле id
		"id": "product_id",
		"category": "category_id",
		"subcategory": "product_subcategory_id"
	};
	$(".admin-table tbody").empty();
	// arr[by] будет просто 'id'
	loadmore.init(sort[by], 0, 16, function( data ){
		var element;
		$.each(data, function(index, data){
			element = admin.products.createElement(data);
			$(".admin-table tbody").append(element);
		});
	});
	loadmore.call(function( data ){
		var element;
		$.each(data, function(index, data){
			element = admin.products.createElement(data);
			$(".admin-table tbody").append(element);
		});
	});
}
admin.products.selectCategory = function( category_id ){
	var element;
	element  = '<select name="category_id">';

	$.each(admin.products.categories, function(index, data){
		element += '<option class="product-category-option" value="' +data['category_id']+ '"';
		if ( category_id == data['category_id'] ) {
			element += ' selected="selected"';
		}
		element += '>' +data['category_name']+ '</option>';
	});

	element += '</select>';
	return element;
}
admin.products.selectSubcategory = function( category_id, subcategory_id ){
	var element = '<select name="product_subcategory_id">';
	var found = false;

	if ( subcategory_id ) {
		element += '<option class="product-subcategory-option" selected="selected">—</option>';
		$.each( admin.products.cats, function(index, subcat){
			if ( subcat['category_id'] == category_id ) {
				found = true;
				element += '<option class="product-subcategory-option" value="' +subcat['subcategory_id']+ '"';
				if ( subcategory_id == subcat['subcategory_id'] ) {
					element += ' selected="selected"';
				}
				element += '>' +subcat['subcategory_name']+ '</option>';
			}
		});
		if ( !found ) {
			element = '<select disabled>';
			element += '<option class="product-subcategory-option"';
			element += ' selected="selected"';
			element += '>Нет подкатегорий</option>';
		}
	}
	else {
		element += '<option class="product-subcategory-option" selected="selected">—</option>';
		$.each( admin.products.cats, function(index, subcat){
			if ( subcat['category_id'] == category_id ) {
				found = true;
				element += '<option class="product-subcategory-option" value="' +subcat['subcategory_id']+ '"';
				element += '>' +subcat['subcategory_name']+ '</option>';
			}
		});
		if ( !found ) {
			element = '<select disabled>';
			element += '<option class="product-subcategory-option"';
			element += ' selected="selected"';
			element += '>Нет подкатегорий</option>';
		}
	}
	element += '</select>';
	return element;
}
admin.products.saveImages = function(){
	console.log( 'admin.products.saveImages' );
	var id = admin.products.current;
	$('#images-loading').show();

	common.ajax({
		with: 'products',
		what: 'details',
		id: id
	},
	function( answer ){
		$('#images-loading').hide();
		$('#product-images #product-id').val(id);

		if ( answer ) {
			var imgs;
			imgs  = '<table>';
			var imgClearName = '';
			var imgShortName = '';
			$.each(answer.product_images, function(index, image){
				imgs += '<tr>';
					imgs += '<td>';
					if (image != '/site/gcorp/images/products/no-image.png') {
						imgClearName = answer.product_cut_images[index].replace('..!', '').replace('..$', '');
						imgShortNameFull = image.substr( image.lastIndexOf('/') + 1, image.length - image.lastIndexOf('/') - 1 );
						imgShortName = imgShortNameFull.replace('..!', '').replace('..!..', '').replace('..$', '');
						imgs += '<a>'
						imgs += '<img src="' + image + '">';
						imgs += '<div class="product-image-remove" data-image="' +imgShortNameFull+ '" data-id="' +id+ '" title="Удалить изображение"></div>';
						imgs += '</a>';
					}
					else {
						imgs += '<a>'
						imgs += '<img src="/site/gcorp/images/products/no-image.png">';
						imgs += '</a>';
					}
					imgs += '</td>';
					// опции
					imgs += '<td>';
					imgs += '<div class="product-image-options" title="Сменить цвет" data-id="' +id+ '" data-image="' +imgClearName+ '">';
						if ( answer.product_picture_color ) {
							imgs += admin.products.colorsBlock( answer.product_picture_color[imgShortName] );
						}
						else {
							imgs += admin.products.colorsBlock();
						}
						imgs += '<select data-image="' +answer.product_cut_images[index]+ '" data-id="' +id+ '" class="product-image-rate">';
							imgs += '<option value="0">По-умолчанию</option>';
							imgs += '<option value="1">Основное</option>';
							imgs += '<option value="2">Дополнительное</option>';
						imgs += '</select>';
					imgs += '</div>';
					imgs += '</td>';
				imgs += '</tr>';
			});
			imgs += '</table>';
			$('#product-images-table').html( imgs );
		}
		else {
			console.log( 'admin.products.saveImages :: fatality : ');
			console.log(  answer );
		}

	},false,'admin.products.saveImages');
}
admin.products.categories = '';
admin.products.cats = {};
admin.products.createElement = function(data){
	var element;
	element  = '<tr class="product" data-id="' +data['product_id']+ '">';

		// element += '<td class="product-image">'
		// 		// + '<form id="upload" class="upload" method="post" action="admin" enctype="multipart/form-data">'
		// 		// +	'<div id="drop" class="drop">'
		// 		+		'<a><img class="photo" src="' +data['image']+ '" alt="product_photo" title="Обновить главное фото этой товарной позиции" data-product-id="' +data['id']+ '"></a>'
		// 		+		'<input type="file" name="product_image-' +data['id']+ '" multiple>';
		// 		// +	'</div>'
		// 		// +'</form>'
		// 		+ '</td>';

		element += '<td class="product-name"><input name="product_name" maxlength=40 value="' +data['product_name']+ '"></td>';

		element += '<td class="product-id"><input disabled value="' +data['product_id'];
		element += data['product_name'].substr(0,2).toUpperCase() + '"></td>';

		// console.log( data );
		element += '<td class="product-category" data-id="' +data['category_id']+ '">';
		element += admin.products.selectCategory( data['category_id'] );
		element += '</td>';

		element += '<td class="product-subcategory" data-id="' +data['product_subcategory_id']+ '">';
		element += admin.products.selectSubcategory( data['category_id'], data['product_subcategory_id'] );
		element += '</td>';

		// var types = ['hit', 'actia', 'discount', 'default'];
		// element += '<input class="product-type" value="' +data['type']+ '">';
		element += '<td class="product-type"><select name="product_type">';

		// Код ниже можно улучшить по следующей схеме:

		// option = [
		// 	['default', 'Не выбрано'],
		// 	['hit', 'Хит продаж'],
		// 	['actia', 'Акция'],
		// 	['discount', 'Скидка']
		// ];

		// $(option).each(function(i){
		// 	element += '<option value="' + option[i][0] + '"';
		// 		if (data['product_type'] == option[0]) {
		// 			element += ' selected="selected"';
		// 		}
		// 	element += '>' + option[i][1] + '</option>';
		// });

		element += '<option value="default"';
			if (data['product_type'] == 'default') {
				element += ' selected="selected"';
			}
		element += '>Не выбрано</option>';
		element += '<option value="hit"';
			if (data['product_type'] == 'hit') {
				element += ' selected="selected"';
			}
		element += '>Хит продаж</option>';
		element += '<option value="actia"';
			if (data['product_type'] == 'actia') {
				element += ' selected="selected"';
			}
		element += '>Акция</option>';
		element += '<option value="discount"';
			if (data['product_type'] == 'discount') {
				element += ' selected="selected"';
			}
		element += '>Скидка</option>';
		element += '</select></td>';

		element += '<td class="product-price"><input name="product_price" type="number" value="' +data['product_price']+ '"></td>';

		element += '<td class="product-old-price"><input name="product_old_price" type="number" ';
		if (data['product_type'] != 'discount') element += 'disabled value="'+data['product_price']+'"';
		else element += ' value="' +data['product_old_price'];
		element += '"></td>';

		element += '<td class="product-images"></td>';

		element += '<td class="options"><div class="remove">&#215;</div></td>';

		element += '<td class="details product-details">...</td>';
	element += '</tr>';
	return element;
}
admin.products.add = function (){
	var product = {};
	product.name = $("#product-add-table input[name=name]").val();
	product.price = $("#product-add-table input[name=price]").val();
	product.category = $("#product-add-table select[name=category] option:selected").val();
	// product.image = $("#product-add-table input[name=image]").val();
	product.type = "default";

	common.ajax(
		{
			with: "products",
			what: "add",
			product: product
		},
		function(answer){
			if ( answer != false ) {
				var element = admin.products.createElement(answer);
				$(".admin-table tbody").prepend(element);
				win.hide();
			}
			else {
				console.error( "error :: try to add product with wrong request" );
			}
		}
	);
}
admin.products.removeProductImage = function( me ){	
	var data = {
		with: 'products',
		what: 'remove-image',
		image: me.data('image'),
		id: me.data('id')
	};

	common.ajax(data,
	function( answer ){
		if (answer.success == 'true') {
			admin.products.saveImages();
			// me.closest('.carousel-block').remove();
		}
		else {
			console.log(answer);
			alert('Удаление не удалось');
		}
	},
	function(){
		alert('Не удаётся удалить картинку');
	},'admin.products.removeProductImage');
}
admin.products.setMainImage = function( me ){
	console.log( admin.products.setMainImage );
	var functionName = 'admin.products.setMainImage';
	var id = me.data('id');
	common.ajax(data = {
		with: 'products',
		what: 'set-main-image',
		image: me.data('image'),
		id: id
	},
	function( answer ){
		console.log( answer );
		if (answer.success == 'true') {
			console.log( answer );
			// $('.already-main').removeClass('already-main').addClass('set-main-image');
			// $('.already-main').attr('title', 'Сделать главным');
			// admin.products.images(id);
		}
		else console.log(functionName + ' :: ' + answer);
	},
	function(){
		console.log(functionName + ' :: ajax-error');
	},
	functionName);
}
admin.products.setSecondImage = function( me ){	
	var functionName = 'admin.products.setSecondImage';
	var id = me.data('id');
	common.ajax({
		with: 'products',
		what: 'set-second-image',
		image: me.data('image'),
		id: id
	},
	function( answer ){
		if (answer.success == 'true') {
			// $('.already-second').removeClass('already-second').addClass('set-second-image');
			// $('.already-second').attr('title', 'Сделать вторым');
			
			// me.removeClass('set-second-image').addClass('already-second');
			// me.attr('title', 'Это второе фото товара');

			// admin.products.images(id);
		}
		else console.log(functionName + ' :: ' + answer);
	},
	function(){
		console.log(functionName + ' :: ajax-error');
	},
	functionName);
}

admin.products.images = function(id) {
	var page = "products";
	var act = "details";
	var me = $('#product-details');

	$('#product-images #product-images-box').empty();

	admin.products.current = id;
	win.show(function(){
		win.title.set( $("#msg-product-images-title").text() );
		win.content.set( $("#msg-product-images-body") );
		$('#window .window-content').css({
			'height': 'calc(100% - 40px)',
			'overflow-y': 'auto'
		});
	});

		/*$('#images-loading').show();
		common.ajax(
			{
				with: page,
				what: act,
				id: id
			},
			function(answer){
				$('#images-loading').hide();
				$('#product-images #product-id').val(id);
				
				var imgs = '';
				imgs += 		'<div class="carousel-button-left"><a></a></div>';
				imgs += '<div class="carousel">';
				imgs += 	'<div class="carousel-wrapper">';
				imgs += 		'<div class="carousel-items">';
				for (var i = 0; i < answer.product_images.length; i++) {
					var imgClearName = answer.product_cut_images[i].replace('..!', '').replace('..$', '');
					// $(answer.product_images).each(function(i){
					imgs += 		'<div class="carousel-block">';
				if (answer.product_images[i] != '/site/gcorp/images/products/no-image.png') {
					imgs += 			'<span title="Сменить цвет" class="image-color filter-color color-';
					imgs += answer.product_picture_color[imgClearName];
					imgs += '" data-color="';
					imgs += answer.product_picture_color[imgClearName];
					imgs += '" data-product="';
					imgs += answer.product_id;
					imgs += '" data-image="';
					imgs += imgClearName;
					imgs += '"';
					imgs += '></span>';
					imgs += 			'<div class="product-image-remove" data-image="' +imgClearName+ '" data-id="' +id+ '" title="Удалить изображение"></div>';
					if (i != 0) {
						imgs += 			'<div class="set-main-image" title="Сделать главным" data-image="' +answer.product_cut_images[i]+ '" data-id="' +id+ '">1</div>';
					}
					else {
						imgs += 			'<div class="already-main" title="Это главное фото товара" data-image="' +answer.product_cut_images[i]+ '" data-id="' +id+ '">1</div>';
					}
					if (i != 1) {
						imgs += 			'<div class="set-second-image" title="Сделать вторым" data-image="' +answer.product_cut_images[i]+ '" data-id="' +id+ '">2</div>';
					}
					else {
						imgs += 			'<div class="already-second" title="Это фото товара которое появляется при наведении курсора на товар">2</div>';
					}
				}
					imgs += 			'<a href="' + answer.product_images[i].split('80x80').join('original') + '">'
					imgs += 			'<img src="' + answer.product_images[i] + '">';
					imgs += 			'</a>';
					imgs += 		'</div>';
				}
				imgs += 		'</div>';
				imgs += 	'</div>';
				imgs += '</div>';
				imgs += 		'<div class="carousel-button-right"><a></a></div>';
				$('#product-images #product-images-box').first().append(imgs);

				// $('.carousel-block a').fancyzoom();
			}
		);*/

	admin.products.saveImages();
}

$(function(){
    var ul = $('#upload ul');
    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({
        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),
        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
    		data.autoUpload = true;
            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');
            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');
            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);
            // Initialize the knob plugin
            tpl.find('input[type=file]').knob();
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
        if (bytes >= 1024*1024*1024) {
            return (bytes / (1024*1024*1024)).toFixed(2) + ' GB';
        }
        if (bytes >= 1024*1024) {
            return (bytes / (1024*1024)).toFixed(2) + ' MB';
        }
        return (bytes / 1024).toFixed(2) + ' KB';
    }
});

// var common.carusel.elements = $(carusel).find(".carousel-items .carousel-block");

common.carusel = {};
common.carusel.toLeft = function(carusel){
	var block_width = $(carusel).find('.carousel-block').outerWidth();
	$(carusel).find(".carousel-items .carousel-block").eq(-1).clone().prependTo($(carusel).find(".carousel-items")); 
	$(carusel).find(".carousel-items").css({"left":"-"+block_width+"px"});
	$(carusel).find(".carousel-items .carousel-block").eq(-1).remove();    
	$(carusel).find(".carousel-items").animate({left: "0px"}, 200);
}
common.carusel.toRight = function(carusel){
	var block_width = $(carusel).find('.carousel-block').outerWidth();
	$(carusel).find(".carousel-items").animate({left: "-"+ block_width +"px"}, 200, function(){ 
		$(carusel).find(".carousel-items .carousel-block").eq(0).clone().appendTo($(carusel).find(".carousel-items"));
		$(carusel).find(".carousel-items .carousel-block").eq(0).remove(); 
		$(carusel).find(".carousel-items").css({"left":"0px"}); 
	});
}


/* 

common.carusel = {};
common.carusel.toLeft = function(carusel){
    // var els = document.getElementsByClassName('carousel-block');
    // var out = document.getElementsByClassName('carousel-items')[0];
    // out.innerHtml = '';
    // out.innerHtml = els[els.length - 1];

    // for (var i = 0; i < els.length - 1; i++) {
    // 	out.innerHtml += els[i];
    // }
   	$(carusel).find(".carousel-items .carousel-block").eq(-1).prependTo($(carusel).find(".carousel-items")[0]);
}
common.carusel.toRight = function(carusel){
	// var left_el = $(carusel).find(".carousel-items .carousel-block").eq(0);
	// var norm_w = left_el.width();
	// left_el.animate({'width':0},200,function(){
	// 	left_el.appendTo($(carusel).find(".carousel-items")[0]);
	// 	// left_el.remove();
	// 	left_el.animate({'width': norm_w}, 200);
	// });
}
 
// автоматическая прокрутка
common.carusel.autoStart = function(carusel){
    setInterval(function(){
        if (!$(carusel).is('.hover'))
            common.carusel.toRight(carusel);
    }, 3000)
}
*/