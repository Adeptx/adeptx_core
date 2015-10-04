admin.articles = {};
admin.articles.init = function(){
	loadmore.init("article_id", 0, 16, function(data){
		var element;
		$.each(data, function(index, data){
			element = admin.articles.createElement(data);
			$(".admin-table tbody").append(element);

		});
	});
	loadmore.call(function(data){
		var element;
		$.each(data, function(index, data){
			element = admin.articles.createElement(data);
			$(".admin-table tbody").append(element);
		});
	});
}
admin.articles.add = function(){
	var element = {};
	element.text = document.getElementsByTagName("iframe")[0].contentDocument.getElementById("tinymce").innerHTML;
	common.ajax({
			with: "articles",
			what: "add",
			article: element
		},
		function( answer ){
			console.log( answer );
			element = answer;
			element.views = 0;
			element.date = "только что";
			
			$(".admin-table tbody").append(
				admin.articles.createElement( element )
			);
			win.hide();
		}
	);
}
admin.articles.createElement = function(data){
	var element = '';

	element += '<tr class="article" data-id="' +data['article_id']+ '">';
	element += 	'<td class="article-title">';
	element += 	 '<input name="article_title" placeholder="Заголовок статьи" value="';
	if (data['article_title']) element += data['article_title'];
	element += '">';
	element += 	'</td>';
	element += 	'<td class="article-text">';
	element += 	 '<textarea name="article_text">' +data['article_text']+ '</textarea>';
	element += 	'</td>';
	element += 	'<td class="article-public">';
	element += 		'<select name="article_public">';
	element += 			'<option value="1"';
	if (data['article_public'] == 1) {
		element += ' selected="selected"';
	}
	element += 			'>ДА</option>';
	element += 			'<option value="0"';
	if (!data['article_public'] || data['article_public'] == 0) {
		element += ' selected="selected"';
	}
	element += 			'>НЕТ</option>';
	element += 		'</select>';
	element += 	'</td>';
	element += '<td class="article-views">' +data['article_date']+ '</td>';
	element += '<td class="article-views">';
	if (data['article_views']) element += data['article_views'];
	else element += 0;
	element +=  '</td>';
	element += '<td class="options"><div class="remove">&#215;</div></td>';
	element += '</tr>';

	return element;
}