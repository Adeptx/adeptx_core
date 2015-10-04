var win = {};
win.init = function( bg, body, handler ){
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

	$(document).on("click", function(e){
		e = e || window.event;
		var me = $(e.target);
		if ( me.is( win.bg ) ) {
			win.hide();
		}
		else if ( me.is( win.close ) ) {
			win.hide();
		}
	});
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

	win.close = win.body.find(".close");
	win.close.on("click",function(){
		win.hide();
		// return false;
	});
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