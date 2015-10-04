$.ajaxSetup({
	type: "get",
	error: function(error) {
		console.log(error);
	}
});

$(document).ready(function(){

	$('#frame').load(function(){
		alert(document.
getElementsByTagName("iframe")[0].contentDocument.getElementsByTagName("html")[0].innerHTML);
	});

<!-- -->
	

	// $.ajax({
	// 	url: 'http://www.holprop.ru/s/sale-property~id~AL13243413~site~1~c~y.htm',
	// 	success: function(page_source) {
	// 		alert(page_source);
	// 		// $.ajax({
	// 		// 	url: '',
	// 		// 	data: {source: page_source}
	// 		// });
	// 	}
	// });
});