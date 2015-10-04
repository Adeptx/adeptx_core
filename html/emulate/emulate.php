<div id="android" class="landscape">
      <div id="reload"></div>
      <div style="display: none;" id="kbd"></div>
      <input id="url" value="http://www.domain.com" onfocus="if(this.value == 'http://www.domain.com') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'http://www.domain.com'; }">
      <? if ($_GET['device'] = 'android') echo '<iframe id="frame" src="http://gcorp.url.ph"></iframe>'; ?>	
</div>	
	
	<script>
	$(document).ready(function(){
	$('body').append('<div id="like-us-on-facebook"><img src="http://cdn.android-emulator.org/like-us-on-facebook.png" alt="Like us on Facebook please" /></div>');
	$('#like-us-on-facebook').delay(1000).fadeIn(4000);
	$(['http://cdn.android-emulator.org/iphone-emulator-hover.png','http://cdn.android-emulator.org/ipad-emulator-hover.png','http://cdn.android-emulator.org/android-emulator-hover.png','http://cdn.android-emulator.org/blackberry-emulator-hover.png','http://cdn.android-emulator.org/tablet-emulator-hover.png']).preload();
});

$.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
}

var setFrameUrl = function(url) {
  if (!url || url == 'undefined') return;
  if (!url.match('^https?://')) {
    url = 'http://' + url;
  }
  $('#url').val(url);
  $('#frame').attr('src',url);
};

var rotate = function() {
  $('#iphone').toggleClass('landscape').toggleClass('portrait');
}

$(function(){

setFrameUrl($.url.param('url'));
if ($.url.param('portrait')) rotate();

$('#rotate').click(rotate);

$('#reload').click(function(){
  $('#frame').attr('src',$('#frame').attr('src'));
});

$('#url').focus(function(){
  $('#kbd').show();
});

$('#url').blur(function(){
  $('#kbd').hide();
});

$('#url').keyup(function(evt){
  if (evt.keyCode != 13) return;
  $('#url').blur();
  setFrameUrl($(this).val());
});

$('#google').focus(function(){
  $('#kbd').show();
});

$('#google').blur(function(){
  $('#kbd').hide();
});

$('#show_about').click(function(){
  $('#about').slideToggle();
  return false;
});

});
	</script>
<style>
	
	
	.addthis_default_style .at300b,.addthis_default_style .at300m,.addthis_default_style .at300bs{float:none; padding:0; margin:0 2px;}
body{color:#efefef;background-color:#262626;font-family:Arial, Helvetica, sans-serif;scrollbar-base-color:#636;scrollbar-face-color:#9CC;scrollbar-track-color:#969;scrollbar-arrow-color:#303;scrollbar-highlight-color:#FFF;scrollbar-3dlight-color:#CCC;scrollbar-shadow-color:#636;scrollbar-darkshadow-color:#000;background:#262626 url(http://cdn.android-emulator.org/bg_header_top.png) 0 0 repeat-x;min-width:1100px}
body,html{margin:0;padding:0}
a{color:#1e87e1}
#android{margin-left:auto;margin-right:auto;position:relative;left:0;top:0}
#wrapper{width:960px;text-align:center;margin:0 auto}
#android.landscape{background:url(http://cdn.android-emulator.org/android-bg.png);width:362px;height:700px;margin-top:100px}
#android.portrait{background:url(http://cdn.android-emulator.org/android-bg.png);width:386px;height:728px}
#android #rotate{height:42px;position:absolute;left:0;top:0;cursor:pointer}
#android.landscape #rotate{width:1108px}
#android.portrait #rotate{width:852px}
#android #reload{width:37px;height:39px;position:absolute;cursor:pointer;top:89px}
#android.landscape #reload{left:290px;top:97px}
#android.portrait #reload{left:582px}
#android #kbd{position:absolute;left:42px;top:116px;display:none;z-index:10}
#android #url{position:absolute;left:40px;top:105px;height:22px;font-size:18px;background:none;color:#717070;border:none;font-family:'Droid Sans', 'Liberation Sans', FreeSans, 'Helvetica Neue LT Std', 'Helvetica LT Std', Helvetica, Arial, Tahoma, 'Lucida Grande', 'Lucida Sans', sans-serif}
#android.landscape #url{width:234px}
#android.portrait #url{width:300px}
#android #google{position:absolute;top:87px;height:21px;background:#fff;border:none;font-family:'Droid Sans', 'Liberation Sans', FreeSans, 'Helvetica Neue LT Std', 'Helvetica LT Std', Helvetica, Arial, Tahoma, 'Lucida Grande', 'Lucida Sans', sans-serif}
#android.landscape #google{left:790px;width:250px}
#android.portrait #google{left:625px;width:160px}
#android #frame{border:none;position:absolute;left:-114px;top:-73px}
#android.landscape #frame{width:591px;height:877px;
transform: scale(0.50,0.50);
-ms-transform: scale(0.50,0.50); /* IE 9 */
-webkit-transform: scale(0.50,0.50); /* Safari and Chrome */
-o-transform: scale(0.50,0.50); /* Opera */
-moz-transform: scale(0.50,0.50); /* Firefox */
}
#android.portrait #frame{width:838px;height:1230px;-moz-transform:scale(0.75);-moz-transform-origin:0 0;-webkit-transform:scale(0.75);-webkit-transform-origin:0 0;-o-transform:scale(0.75);-o-transform-origin:0 0}
.info{text-align:center;margin:16px auto; }
.custom_images { width:485px; text-align:center; margin:0 auto; }
#about{display:none}
.header-top{height:57px}
.header-block{background:url(http://cdn.android-emulator.org/shine.jpg) no-repeat 259px 57px;height:200px;position:relative;top:0;text-align:center;overflow:visible;margin:0 auto}
.header-panel{background-position:3px 6px;text-align:center;z-index:994;line-height:28px;margin:0 auto;padding:0 68px}
img,#iphone-emulator-btn,#ipad-emulator-btn{border:0;vertical-align:top;border-image:initial}
#like-us-on-facebook{position:absolute;top:42px;left:10px;display:none;width:200px;height:144px}
#social_btn_holder{position:absolute;top:16px;left:25px}
#top-google-ad-right { position:absolute; top:185px; right:10px; width:160px; z-index:-100;}
#top-google-ad-left { position:absolute; top:185px; left:10px; width:160px; z-index:-100;}
#plus_btn_holder{position:absolute;top:16px;right:25px}
#ipad-emulator-btn,#ipad-emulator-btn-on,#iphone-emulator-btn,#iphone-emulator-btn-on,#android-emulator-btn,#android-emulator-btn-on,#blackberry-emulator-btn,#blackberry-emulator-btn-on,#tablet-emulator-btn,#tablet-emulator-btn-on{display:inline-block;text-indent:-9999px;width:151px;height:52px}
#android-emulator-btn-on{background:url(http://cdn.android-emulator.org/android-emulator-on.png) no-repeat 0 0;height:57px}
#iphone-emulator-btn{background:url(http://cdn.android-emulator.org/iphone-emulator.png) no-repeat 0 0}
#ipad-emulator-btn{background:url(http://cdn.android-emulator.org/ipad-emulator.png) no-repeat 0 0}
#android-emulator-btn{background:url(http://cdn.android-emulator.org/android-emulator.png) no-repeat 0 0}
#blackberry-emulator-btn{background:url(http://cdn.android-emulator.org/blackberry-emulator.png) no-repeat 0 0}
#tablet-emulator-btn{background:url(http://cdn.android-emulator.org/tablet-emulator.png) no-repeat 0 0}
input:focus,input:focus,textarea:focus{outline:none}
#iphone-emulator-btn:hover{background:url(http://cdn.android-emulator.org/iphone-emulator-hover.png) no-repeat 0 0}
#ipad-emulator-btn:hover{background:url(http://cdn.android-emulator.org/ipad-emulator-hover.png) no-repeat 0 0}
#blackberry-emulator-btn:hover{background:url(http://cdn.android-emulator.org/blackberry-emulator-hover.png) no-repeat 0 0}
#tablet-emulator-btn:hover{background:url(http://cdn.android-emulator.org/tablet-emulator-hover.png) no-repeat 0 0}
</style>


</html>
