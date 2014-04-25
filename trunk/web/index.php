<?PHP
//$visitor_ip 			= $_SERVER['REMOTE_ADDR'];
//if('119.161.156.76'!=$visitor_ip)
//{
//	header("Content-Type: text/html; charset=UTF-8");
//print_r("网站升级");exit;
//}
//var_dump(ini_get('arg_separator.output'));exit;
define('SCRIPT_NAME', 'index');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', realpath(dirname(__FILE__).DS.'..'.DS).DS);
require(ROOT_PATH.'config'.DS.'global.php');
$StartTime = microtime_float();
action();
echo "<-- ".microtime_run()." -->";
?>
