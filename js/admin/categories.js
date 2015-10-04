admin.categories = {};
admin.categories.init = function(){
	jQ.categories = $("#categories");
	jQ.trAddButton = jQ.categories.find(".categories-add").closest('tr');

	// получаем список категорий всего один раз и затем можем использовать его многократно
	// common.ajax({
	// 	with: 'categories',
	// 	what: 'get-all'
	// },
	// function( answer ){
	// 	admin.categories.categories = answer;
	// });

	loadmore.init("category_order", 0, 16, function( data ){
		var element;
		$.each(data, function(index, data){
			element = admin.categories.createElement(data);
			$(".admin-table tbody").append(element);
		});
	});
	loadmore.call(function( data ){
		var element;
		$.each(data, function(index, data){
			element = admin.categories.createElement(data);
			$(".admin-table tbody").append(element);
		});
	});

	jQ.categories.sortable({
		items: "tbody tr:not(.no-sortable)",
		handle: ".move",
		placeholder: "ui-state-highlight"
	});

	jQ.categories.disableSelection();
	$(document).on('mouseup', function(e){
		var me = $(e.target);
		if (me.is('.move')) {
			admin.categories.move();
		}
	});

	/*
	loadmore.init("category_id", 16, function( data ){
		// some function like
		$.each(data, function(index, data){
			// $("#categories-table").append("<p><b>" + data.title + "</b><br />" + data.text + "</p>");
		});
	});
	*/
};

admin.categories.createElement = function(data){
	var element;

	element  = '<tr class="categories" data-id="' +data['category_id']+ '">';
		element += '<td class="move" title="Двигайте за эти стрелки чтобы поменять местами"></td>';
		element += '<td class="order">' +data['category_order']+ '</td>';
		element += '<td class="categories-name" data-id="' +data['category_id']+ '"><input name="category_name" maxlength=40 value="' +data['category_name']+ '"></td>';
		element += '<td class="categories-url"><input name="category_url" value="' +data['category_url']+ '"></td>';
		element += '<td class="options"><div class="remove">&#215;</div></td>';
		// element += '<td class="categories-subcategory" data-id="' +data['subcategory_id']+ '">';
		// element += admin.categories.selectSubcategory( data['subcategory_id'] );
		// element += '</td>';

	element += '</tr>';
	return element;
}
admin.categories.add = function (){
	var page = "categories";
	var act = "add";
	var category = {};
	category.order = $("#categories-add-table input[name=order]").val();
	category.name = $("#categories-add-table input[name=name]").val();
	category.url = $("#categories-add-table input[name=url]").val();

	common.ajax(
		{
			with: page,
			what: act,
			category: category
		},
		function(answer){
			if ( answer != false ) {
				var element = '';
				element += '<tr class="categories" data-id="'+answer.id+'">';
				element +=	'<td class="move"></td>';
				element +=	'<td class="order">' +answer.id+ '</td>';
				element +=	'<td class="categories-name">';
				element +=		'<input value="' +answer.name+ '">';
				element +=	'</td>';
				element +=	'<td class="categories-url">';
				element +=		'<input value="' +answer.url+ '">';
				element +=	'</td>';
				element +=	'<td class="options">';
				element +=		'<div class="remove">&#215;</div>';
				element +=	'</td>';
				element += '</tr>';

				win.hide();
				$(".admin-table tbody").append(element);
				admin.categories.move();
				console.log( "OK :: admin.categories.add" );
			}
			else {
				console.error( "error :: try to add category with wrong request" );
			}
		}
	);
}
admin.categories.move = function(){
	var ids = [];

	setTimeout(function(){	// NOT VISUAL EFFECT, it's needed delay for jquery ui
		$('.order').each(function(i){
			ids[i] = $(this).closest('tr').data('id');
		});
		common.ajax({
			with: 'categories',
			what: 'order',
			ids: ids
		},
		function( answer ){
			if (answer.fail) {
				console.log(answer.fail);
			}
			else {
				$('.order').css({'opacity':'0'}).animate({'opacity':1});
				$('.order').each(function(i){
					$(this).html(i + 1);
				});
			}
		});
	}, 200);	// NOT VISUAL EFFECT, need some delay for jquery ui working first
}