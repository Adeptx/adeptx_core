<?
define('MAINDIR','../');
define('NOWDIR','maxsens');

$page['id']=$_REQUEST['page'];

if($page['id']=='durov_perehodit_iz_vk_v_telegram')$page['id']=1;

if(!is_readable("page${page['id']}.php"))$page['id']=0;
include_once "page${page['id']}.php";
require_once MAINDIR.'template/index.php';