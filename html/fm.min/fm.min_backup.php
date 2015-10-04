<?
	$dir = $_REQUEST['dir'];
	$dir = str_replace(array('../', './', '..'), '', $dir);
	if (!$dir) $dir='.';
	if ($dir == '.') $dir='';
	else $dir.='/';

	if ($_REQUEST['del']) {
		unlink($_REQUEST['del']);
		exit($_REQUEST['del']);
	}
	if ($_REQUEST['preview']) {
		exit(file_get_contents($_REQUEST['preview']));
	}
	if ($_REQUEST['rename']) {
		rename($_REQUEST['rename'], $dir.$_REQUEST['newname']);
		exit;
	}
	if ($_REQUEST['open']) {
		exit(file_get_contents($_REQUEST['open']));
	}
	if ($_REQUEST['save']) {
		mkdir($dir);
		$f = fopen($_REQUEST['save'], 'w');
		if ($_REQUEST['v'] != '')
			fprintf($f, "%s", $_REQUEST['v']);
		else {
			unlink($_REQUEST['save']);
			rmdir($dir);
		}
		exit;
	}

	if(isset($_FILES['file']))
		foreach($_FILES['file']['name'] as $file => $t)
		{
			if($_FILES['file']['size'][$file] > 111*1024*1024)
				echo "Размер файла ".$_FILES['file']['name'][$file]." превышает 111 Мб";
			if(is_uploaded_file($_FILES['file']['tmp_name'][$file])) {
				move_uploaded_file($_FILES['file']['tmp_name'][$file], $dir.$_FILES['file']['name'][$file]);
			}
		}
	$dir = $_REQUEST['dir'];
	$dir = str_replace(array('../', './', '..'), '', $dir);
	if (!$dir) $dir = '.';
	$files = scandir($dir);
	if ($dir=='.') $dir = '';
	else $dir.='/';
?>

<script>
 $(function(){

  $.ajax({
   cache:false,
   data:{open:'<?=$_REQUEST['file'];?>'},
   success:function(data){$('#keep').attr('value',data);}
  });

  $('.del').click(function(){
   $.ajax({
    cache:false,
    data:{del:$(this).attr('href')},
    success:function(){$(this).parent().parent().hide();}
   });
   $(this).parent().parent().remove();
   return false;
  });

  document.onkeyup=function(event){if(event.keyCode==220)$.ajax({data:{save:'<?=$_REQUEST[file];?>',v:keep.value}});};

  $('.line[id]').click(function(){$(this).toggleClass('sel');});
  $('a').click(function(){$('.sel').removeClass('sel');});

  $('.line[id]').mouseover(function(){
   var $p=$(this).children().children('.rename').attr('value');
   if(!$p)$p=null;
   $.ajax({
    cache:false,
    data:{preview:$p},
    success:function(a){$('#preread').attr('value',a);/*$('#preview').attr('src',a);*/}
   });
   $('#preview').css('background-image','url("<?=$dir;?>'+$(this).children().children('.rename').attr('value')+'")');
  });

/*
  $('.line[id]').mouseout(function(){
   $('#preread').attr('value','');
   $('#preview').css('background-image','');
  });
*/
/*
  if($(document).width()<500)$('#files').css({'margin-left':0,width:'100%'});
  document.onresize=function(){if($(document).width()<500)$('#files').css({'margin-left':0,width:'100%'});else $('#files').css({'margin-left':'-250px',width:'500px'});};
*/

  $('#replace').click(function(){
   keep.value=keep.value.split(from.value).join(to.value);
  });

  $('.rename').change(function(){
   $.ajax({
    cache:false,
    data:{rename:$(this).parent().next().children().attr('href'),newname:this.value},
    success:function(){document.location.reload();}
   });
  });
  
 });
</script>

  <style>

 html * {cursor:url(img/cur/red1.cur), url(http://cur.cursors-4u.net/cursors/cur-2/cur125.cur), default;}
 body{cursor:url(img/cur/red1.cur), url(http://cur.cursors-4u.net/cursors/cur-2/cur125.cur), default;user-select:text;text-decoration:none;-moz-user-select:none;-khtml-user-select:none;user-select:none;width:100%;height:100%;margin:0;/*color:#09f;*/padding-bottom: 60px; margin-bottom: 60px;}
 a{color:#000/*#09f*/;text-decoration:none !important;border: 0;}
 a:hover{/*color:#4de*/;cursor:url(img/cur/red1.cur), url(http://cur.cursors-4u.net/cursors/cur-2/cur125.cur), default;}

 .line{height:9px;border-bottom:1px dashed #def;/*text-shadow:none;*/font:11px/15px Tahoma,Arial,Helvetica,sans-serif;background-color:#fff;}
 .line:hover{/*color:#0ab;*/background:#eff;}
 .link{display:block;font:11px/15px Tahoma,Arial,Helvetica,sans-serif;}
/*  .link:visited{color:#65f;} */
 .knops{text-align:center;color:#09f;width:15px;display:block;float:left;vertical-align:middle;}
 .file{border:1px dashed #def;width:100%;}
 .sel{background:#e7f7f7;}
 #keep{font:12px monospace,verdana;background:#f7ffff;width:100%;height:100%;top:0;left:0;position:fixed;color:#005;overflow-y:scroll;padding:0;border:2px #e7efef solid;outline:none;resize:none;}
 footer{position:fixed;margin-left:calc(50% - 250px);width:498px;height:56px;border:1px solid #eee;bottom:0;z-index:10;background:#cceeff;text-align:center;font:11px/17px Tahoma,Arial,Helvetica,sans-serif;}
	#files {
		position:	absolute;
		width:		500px;
		border:		1px dashed #def;
		left:			50%;
		margin-left:-250px;
		margin-bottom:70px;
	}
 .replace{position:fixed;right:12px;outline:none;border:1px solid #ccc;}
 #to{top:20px;}
 #replace{top:40px;width:153px;}
 .rename{outline:none;border:0;background:transparent;font:11px Tahoma,Arial,Helvetica,sans-serif;/*color:#09f;*/width:100%;height:13px;cursor:default;}

 footer input{font:11px Tahoma,Arial,Helvetica,sans-serif;cursor:url(img/cur/red1.cur), url(http://cur.cursors-4u.net/cursors/cur-2/cur125.cur), default;border:0;}
 .upload{width:350px;background:#09f;color:#fff;}

	#preread, #preview {
		position:	fixed;
		right:		0px;
		top:			0px;
		width:		calc(50% - 250px);
		height:		100%;
		font:			9px/8px monospace;
		color:		#777;
		border:		0;
		background-color:	#eee;
		background-repeat:no-repeat;
	}
	#preview {
		width:		calc(50% - 250px);
	}
</style>

  <?if($_REQUEST['file']){?>
   <textarea id=keep></textarea>
   <input id=from class=replace placeholder="заменить все"><input id=to class=replace placeholder="на"><input id=replace class=replace type=button value="Заменить все">
  <?}else{?>

  <textarea id="preread"></textarea>
  <div id="preview"></div>

   <table id=files rules=none cellspacing=0 cellpadding=0>
    <tr class=line>
     <td colspan=5>
      <a class=link href="<?='?dir='.substr($dir,0,strrpos($dir,'/',-2));?>"><img src="img/16x16/domain.png" width=15px height=15px>
       Cодержимое&nbsp;<?=str_replace('/',' &raquo; ',substr($dir,0,-1));?>
      </a>
     </td>
    </tr>

    <?for ($i=2; $i<count($files); $i++){?>
     <?if(is_dir($dir.$files[$i])){?>
      <tr class=line id="<?=++$id;?>">
       <td colspan=5 width=100%><a class=link href="?dir=<?=$dir.$files[$i];?>"><div class=knops><img src="img/16x16/dir-lg.png" width=10px height=10px></div>&nbsp;<?=$files[$i];?></a></td>
      </tr>
     <?}?>
    <?}?>

    <?for ($i=2; $i<count($files); $i++){?>
     <?if(!is_dir($dir.$files[$i]))
     {
      $fname = $files[$i];
     ?>
      <tr class=line id="<?=++$id;?>">
       <td width=5><a class=knops target=_blank href="?file=<?=$dir.$files[$i];?>">&#9997;</a></td>
       <td width=100%><input class=rename value="<?=$fname;?>"></td>
       <td><a class=knops target=_blank href="<?=$dir.$files[$i];?>">&#10170;</a></td>
       <td><a class=knops href="?download=<?=$dir.$files[$i];?>">&dArr;</a></td>
       <td><a class="knops del" href="<?=$dir.$files[$i];?>">x</a></td>
      </tr>
     <?}?>
    <?}?>
   </table>

  <?}?>
