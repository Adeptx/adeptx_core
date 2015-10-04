<?
# модуль позволяет сделать полный бекап сайта вместе с базой данных в архив.
# озможные ошибки - если при архивировании встречается архив архивирование может прерваться
# также если сайт очень большой и содержит много файлов, скрипт может не успеть выполниться по времени или ему может не хватить памяти и он прервёт выполнение
# также есть вероятность, что файлы с кириллическими именами могут прерывать архивирование, но это не точные сведения
# а вот точные сведения в том, что при архивировании также подхватываются предыдущие бекапы и общий вес увеличивается как снежный ком

set_time_limit(0);

/*** Дамп базы данных: ***/

include("../core/config/config.inc.php");
//include("class_mysqldump.php");
include("mysqldump.php");

$ready = false;
if(count($_POST) && !empty($_POST["filename"])) {
  mysql_connect($database_server, $database_user, $database_password) or die("Fucking shit! We have troubles!");
  $dumpFileName = "dumps/".$_POST["filename"].".sql";
  $dumper = new MySQLDump($dbase,$dumpFileName,false,false);
  mysql_query("set names utf8");
  @$dumper->doDump();
  // фикс заменяющий неработающую CURRENT_TIMESTAMP на наших серверах
  $fileContents = file_get_contents($dumpFileName);
  $fileContents = str_ireplace('CURRENT_TIMESTAMP','0000-00-00 00:00:00',$fileContents);
  file_put_contents($dumpFileName , $fileContents);
  $ready = true;
}

$filename = "dump_".date("d-m-Y");
include("dumperview.php");

/*** /дамп базы данных ***/

/*** Архив сайта: ***/

$archiveDir = "archives/";
$srcDir = "../";
$archiveFile = $archiveDir."backup_".date('d-m-Y').".zip";
if(file_exists($archiveFile)) {
  unlink($archiveFile);
}
if(Zip($srcDir, $archiveFile) && file_exists($archiveFile)) {
  return '<a href="/archive/'.$archiveFile.'">Скачать архив</a>';
} else {
  return '<b>Архив не создан</b>';
}

function Zip($source, $destination){
  if (extension_loaded('zip') === true) {
    if (file_exists($source) === true) {
      $zip = new ZipArchive();

      if ($zip->open($destination, ZIPARCHIVE::CREATE) === true) {
        $source = realpath($source);

        if (is_dir($source) === true) {
          
          $zip->addEmptyDir('core/export/');
          $zip->addEmptyDir('core/import/');
          $zip->addEmptyDir('core/cache/');
          $zip->addEmptyDir('archive/archives/');
          
          $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
          foreach ($files as $file) {
            if (is_dir($file) === true && !strpos($file,'.') && !strpos($file,'/core/cache/')) {
              $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true && !strpos($file,'/core/cache/') && !strpos($file,'/archive/archives/')) {
              $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
          }
        }
        else if (is_file($source) === true) {
          $zip->addFromString(basename($source), file_get_contents($source));
        }
        return $zip->close();
      }
    }
  }

  return false;
}

/*** /aрхив сайта ***/