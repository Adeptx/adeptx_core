admin.infopages = {};
admin.infopages.init = function(){
	loadmore.init("infopage_id", 0, 16, function(data){
		var element;
		$.each(data, function(index, data){
			element = admin.infopages.createElement(data);
			$(".admin-table tbody").append(element);

		});
	});
	loadmore.call(function(data){
		var element;
		$.each(data, function(index, data){
			element = admin.infopages.createElement(data);
			$(".admin-table tbody").append(element);
		});
	});
}
admin.infopages.add = function(){
	var element = {};
	element.link = $("#window input[name=name]").val();
	element.text = $("#window textarea").val();
	common.ajax({
			with: "infopages",
			what: "add",
			infopage: element
		},
		function( answer ){
			console.log( answer );
			element = answer;
			element.public = 0;
			element.views = 0;
			// element.date = "только что";
			$('.admin-table tbody').append(
				admin.infopages.createElement(element)
			);
			win.hide();
		}
	);
}
admin.infopages.createElement = function(data){
	var element = '';

	element += '<tr class="infopages" data-id="' +data['infopage_id']+ '">';
	element += 	'<td class="infopages-text">';
	element += 	 '<textarea name="infopage_text">' +data['infopage_text']+ '</textarea>';
	element += 	'</td>';
	element += 	'<td class="infopages-show">';
	element += 		'<select name="infopage_public">';
	element += 			'<option value="1"';
	if (data['infopage_public'] == 1) {
		element += ' selected="selected"';
	}
	element += 			'>ДА</option>';
	element += 			'<option value="0"';
	if (data['infopage_public'] == 0) {
		element += ' selected="selected"';
	}
	element += 			'>НЕТ</option>';
	element += 		'</select>';
	element += 	'</td>';
	element += '<td class="infopages-views">' +data['infopage_views']+ '</td>';
	element += '<td class="options"><div class="remove">&#215;</div></td>';
	element += '</tr>';
			
	//element += '<tr data-id="0"><td>Информационных страниц не найдено.</td></tr>';
	return element;
}