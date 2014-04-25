<?PHP //-*-coding: utf-8;-*-

/* 初始化设置 */
@ini_set('memory_limit',          '64M');
@ini_set('session.cache_expire',  180);
@ini_set('session.use_cookies',   1);
@ini_set('session.auto_start',    0);
@ini_set('display_errors',        1);
@ini_set("arg_separator.output","&amp;");
ini_set('date.timezone','Asia/Shanghai');
// date_default_timezone_set('PRC');
error_reporting(E_ALL);// ^ E_NOTICE);

// 要求定义好 _PATH_ 和 SCRIPT_NAME ，及定义 DS 为路径分隔符
if (!defined('DS'))				{ die("Error : (".realpath(__FILE__).") not defined 'DS' "); }
if (!defined('ROOT_PATH'))		{ die("Error : (".realpath(__FILE__).") not defined 'ROOT_PATH' "); }
if (!defined('SCRIPT_NAME'))	{ die("Error : (".realpath(__FILE__).") not defined 'SCRIPT_NAME' "); }

/* Set the include path. */

define("CONTROLLERS_PATH", ROOT_PATH.'controllers'.DS);
define("CONFIG_PATH", ROOT_PATH.'config'.DS);
define("VENDORS_PATH", ROOT_PATH.'vendors'.DS);
define("MODELS_PATH", ROOT_PATH.'models'.DS);
define("DATA_PATH", ROOT_PATH.'data'.DS);
define("LIB_PATH", ROOT_PATH.'lib'.DS);

// 函数
require (CONFIG_PATH . 'functions.php');

/* Include $cout Array */
require (CONFIG_PATH . 'config.cout.php');

/* Include $Constants Array */
require (CONFIG_PATH . 'config.constants.php');

/* Include MySQL CONFIG File */
require (CONFIG_PATH . 'config.db.php');

/* Include Smarty CONFIG File */
require (CONFIG_PATH . 'config.tpl.php');

/* Include Mail CONFIG File */
//require (CONFIG_PATH . 'config.mail.php');


$tpl = "";

/* DB 
require_once (VENDORS_PATH . 'db'.DS.'db.php');
require_once (VENDORS_PATH . 'db'.DS.'drivers'.DS.'mysql_driver.php');
$db = base::get_instance()->db = new mysql_driver(MYDB_HOST,MYDB_LIBR, MYDB_USER, MYDB_PASS, 'utf8', true);
$db->init();
*/

//cache
/*require (VENDORS_PATH .'cache'.DS. 'memcached.php');

$memcached = new memcached($cache_server);
require (VENDORS_PATH .'session'.DS. 'session.php');
require (VENDORS_PATH .'session'.DS. 'drivers'.DS.'session_memcache_driver.php');

$sess = new session_memcache_driver(DOMAIN);
$_SESSION = $sess->start();*/



//if (true) //需要加载Smarty的条件
//{
//加载Smarty
header('Cache-control: private');
header('Content-type: text/html; charset=utf-8');

/* Create Smarty Object */
require (VENDORS_PATH . 'smarty'.DS.'Smarty.class.php');
$tpl = new Smarty;
$tpl->left_delimiter	=	TPL_LEFT_DELIMITER;
$tpl->right_delimiter	=	TPL_RIGHT_DELIMITER;
$tpl->caching			=	TPL_CACHING;
$tpl->cache_lifetime	=	TPL_CACHE_LIFETIME;
$tpl->cache_dir			=	TPL_CACHE;
$tpl->template_dir		=	TPL_TEMPLATE;
$tpl->compile_dir		=	TPL_COMPILE;
$tpl->compile_check		=	true;
$tpl->register_function("insert_scripts", "insert_scripts");
$tpl->register_modifier("sslash","stripslashes");
//}
?>
