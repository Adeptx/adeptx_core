<?
 session_start();
 header('HTTP/1.0 200 Ok');
 header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // no
 header('Cache-Control: no-store, no-cache,  must-revalidate'); 
 header('Expires: '.date('r'));
 header("Pragma: no-cache"); // no

 //echo date('r');
 
 if($d=$_GET['download']){header("Content-Disposition:attachment;filename=".$d);readfile($d);exit();}

 if($_POST['script']) /* link < select & link < window */
 {
  foreach($_POST['script'] as $f)$j.=file_get_contents($f);
  exit(mb_convert_encoding($j,'utf-8','windows-1251'));
 }

 //$a=file('bd');
 //name_of_function1: $a[7]=substr($a[7],0,-1);
 //name_of_function2: $a[9]=substr($a[9],0,-1);
 //require $address_from_bd_xajax_php;
 require 'x.php';
 $x = new xajax();
 $x->registerFunction('lang');
 $x->registerFunction('auth');
 $x->registerFunction('quit');
 $x->registerFunction('core');
 $x->registerFunction('init');
 $x->registerFunction('keep');
 $x->registerFunction('e404_page');
 $x->registerFunction('change');
 $x->registerFunction('wrap');
 $x->registerFunction('bd_add');
 $x->processRequest();
 $x->printJavascript(/*$address_from_bd_xajax_js*/);

 function lang(){$d = new xajaxResponse();foreach($text as $k=>$v)$d->script("\$lang['$k']='$v';");return $d;}

 function auth($e,$p)
 {
  $d = new xajaxResponse();
  require 'bd_users';
  $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
  require 'lang';
  for($i=0,$n=count($c);$i<$n;$i++)
   if($a[$i]==md5($e)&&$b[$i]==md5($p)&&$c[$i]==md5($e.$p))
   {
    $_SESSION['id']=++$i;
    $d->script("$('#auth_fond,#auth').remove();");
    return $d;
   }
  $d->script("if(confirm('".$text['Access denied. Login or password is incorrect.']."')){xbd_add(auth_mail.value,auth_pass.value);alert('Добро пожаловать!');}");
  return $d;
 }

 function bd_add($e,$p){$d=new xajaxResponse();$fp=fopen('bd_users','a');fwrite($fp,"\$a[]='".md5($e)."';\$b[]='".md5($p)."';\$c[]='".md5($e.$p)."';\n");fclose($fp);return $d;}

 /* ориентироваться на серверное время для избежания ошибки пользовательского времени: var S=<?=date('H');?>; ...  */
 /* GET больше не будет. Имя файла будет передаваться АЯксом. Каталог файлов определяет по базе. */
 // $a=file('bd_files'); - будем обрабатывать каждый файл по базе .... eval('$j = "'.$j.'";'); - мы также будем обрабатывать Php в файлах ... (это можно через ob_start();)
 // запросить пользователь может любой файл и получить его, чтобы так не случилось - проверка if($f=='name')

 function wrap($i,$f){$d=new xajaxResponse();eval(file_get_contents($f));return $d;}
 //function core($js_files){$d=new xajaxResponse();foreach($js_files as $f)$j.=file_get_contents($f);return $d->script($j);}
 function all($dir) {$d=new xajaxResponse();foreach($dir as $f)$s.=file_get_contents($f)."\n\n\n/***/\n\n\n";$d->assign('keep','value',file_get_contents($s));return $d;}
 function keep(){$d=new xajaxResponse();$d->assign('keep','value',file_get_contents($_GET['f']));return $d;}
 function init($i){$d=new xajaxResponse();foreach($i as $f)$j.=file_get_contents($f);$d->script($j);return $d;}
 function quit(){$d = new xajaxResponse();$_SESSION['id']=NULL;$d->assign('keep','value',file_get_contents($file));return $d;}


 function e404_page($href) // функция ещё не универсальна (переход на указанную страницу с любого адреса и возможностью возврата)
 {
  $d = new xajaxResponse();
  $d->script("
   $('#e404_fond,#e404').remove();
   history.pushState(null, null, '/');
   document.title='Искренне рад видеть вас.';
   //window.addEventListener('popstate',function(e){history.pushState(null, null, '/');},false);
  ");
  /* if($href=='')require 'main'; */
  return $d;
 }

 function change($newcode){$d=new xajaxResponse();$f = $_GET['f'];$dir=substr($f,0,strrpos($f,'/'));mkdir($dir);$fp=fopen($f,'w');
  if($l=strlen($newcode))while($l!=fprintf($fp,'%s',$newcode))$n++;else{unlink($f);rmdir($dir);}$d->script("document.title='$n $f сохранён';");
  if($n)$d->script("alert('Осторожно, возможна перегрузка сервера, файл сохранился только с $n раза.');");return $d;
 }

 $site_path = dirname(realpath(__FILE__)).'/';

 $url = $_SERVER['REQUEST_URI'];
 $url=substr($url,1); // вырезать '/'

 $qry=explode('?',$url);
 $page_name=$qry[0];
 $query=explode('&',$qry[0]);

 $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
 require 'lang';
 require 'default_conf';

 $ip=$_SERVER["REMOTE_ADDR"];

 if(substr($ip,0,6)!=$conf['IP']){$log=fopen('log','ab');fwrite($log,$ip.' ['.date('d.m.y H:i:s').']: '.$_SERVER['HTTP_REFERER'].'=>'.$url."\n");fclose($log);}

 $page_language=$lang;                                    // [$_SESSION['id']][$page_name]
 $page_charset='windows-1251';
 $page_favicon='files/favicon.ico';
 $page_title=$text['Very glad to see you'];
 $javascript_files=array(
  'http://code.jquery.com/jquery-latest.min.js',           // вместо jQuery определённо напишем свою библиотеку
  'http://src.jquerysdk.com/latest/script/jQuery/core.js',
  'http://fromvega.com/code/easydrag/jquery.easydrag.handler.beta2.js' // easydrag плагин
 );

 //require 'bd_files'; // при загрузке страницы из базы выбираем данные о файле и подгружаем их.
?>
<!doctype html>
<html lang="<?=$page_language;?>">
 <head>
  <meta charset="<?=$page_charset;?>">
  <title><?=$page_title;?></title>
  <link rel="shortcut icon" type="image/x-icon" href="<?=$page_favicon;?>">
  <?foreach($javascript_files as $js_file)echo '<script type="text/javascript" src="'.$js_file.'"></script>';?>
  <script>/*xlang();*/</script>
  <?require 'css';?>

  <!--fm--title>Управление файлами: <?=(($_GET['f'])?$_GET['f']:(($_GET['show'])?$_GET['show']:($_GET['dir'])?$_GET['dir']:'просмотр главного каталога.'));?></title>
  <link rel="shortcut icon" type="image/x-icon" href="files/favicon.ico"-->
 </head>
 <body>
  <?
   // сделать предварительную js обработку введенных данных и защиту от множественного введения. вставить тут -^, в хэд
   // предлагать войти как гость, если ничего не введено, иначе сделать недоступной кнопку, пока проверка js -^ не пропустит
   //if(!$_SESSION['id'])require 'auth';
   if(/*$_SERVER['SERVER_NAME']!=$conf['Domen']*/0){require 'e404';require 'main';}// помним - адрес не постоянный
   /*if($_SERVER['REDIRECT_STATUS']!=200){$e=$_SERVER['REDIRECT_STATUS'];require 'error';require 'main';}*/
   else
    switch($page_name)  // обязательно проверить запрос - кто запросил, с какого хоста, если не мы - уходим, если фрейм - рушим.
    {
     case '':        require /*$site_path.*/'fm';require 'main';break; // -readfile
     case 'fm_AGB':  require 'fm_AGB';break; // быстрый поиск и замена!!! // иконки favicon страниц должны быть установлены в настройках каждой страницы (в БД)
     case 'adv':     require 'adv';break;
     case 'am':      require 'am';break;
     case 'i':       require 'main';break;
     case 'reg_am':  require 'reg_am';break;
     case 'fm2.php': require 'fm2.php';break;
     /*case 'error': require 'error';break;*/
     case 'algoritm':require 'algoritm';break;
     case 'play':    require 'play';break;
     case 'tv':      require 'tv';break;
     case 'ps':      require 'ps';break;
     case 'fm':      require 'fm';break;
     case 'book':    require 'book';break;
     case 'biser-klass.css':    require 'biser-klass.css';break;
     default:        require 'e404';require 'main'; // не плохо бы, чтобы блок окна (e404_block,auth_block) не повторялся дважды
    }
  ?>
 </body>
</html>
