<?PHP
define('SCRIPT_NAME', 'soap');
define('DS', DIRECTORY_SEPARATOR);
//echo (dirname(__FILE__).DS.'..'.DS);exit;
define('ROOT_PATH', realpath(dirname(__FILE__).DS.'..'.DS).DS);
require(ROOT_PATH.'include'.DS.'global.php');

$server = new SoapServer(null, array('uri' => $_SERVER['REQUEST_URI']));
//$server->setClass('test');
//$server->setClass('mem');
$server->addFunction('get');

$server->handle();
//echo "<-- ".microtime_run()." -->";
function get($act='',$args=array(),$token='')
{
	global $server;
	$arr = array();
	if (empty($act) || !preg_match("/^([a-z_]+)\.([a-z_]+)$/i",$act,$arr))
	{
		$server->fault('permission_denied', 'empty act.');
		return false;
	}
	if (empty($token))
	{
		$server->fault('permission_denied', 'empty token.');
		return false;
	}
	$check = check_soapclient($args, $token);
	if ( !$check ){
		$server->fault('permission_denied', 'error token.');
		return false;
	}
	$f = new $arr[1];
	if ( !method_exists( $f, $arr[2] ) )
	{
		$server->fault('permission_denied', 'do not find method.');
		return false;
	}
	return $f->$arr[2]($args);
}
?>