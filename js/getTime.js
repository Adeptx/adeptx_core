function update(data){
	$.ajax({
		type: 'post',
		url: 'update.php',
		dataType: 'text json',
		data: data,
		success: function (up) {
			$.each(up, function(key, val){
				$(key).html(val);
			});
		}
	});
}

$(document).ready(function(){
	update({date:'.', msg:'.', epigraph:'.'});

	setInterval(function(){
		update({date:'.', msg:'.'});
	}, 1000);
});
