<?php //-*-coding: utf-8;-*-

// 系统执行时间
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
// 系统执行时间
function microtime_run()
{
	$StartTime = (empty($GLOBALS['StartTime'])) ? microtime_float() : $GLOBALS['StartTime'];
	$EndTime = microtime_float();
	$RunTime = $EndTime - $StartTime;
	return $RunTime;
}

//路由
function router()
{
	if( PHP_SAPI === 'cli' )
	{
		// Command line requires a bit of hacking
		if( isset($_SERVER['argv'][1]) )
		{
			$current_uri = $_SERVER['argv'][1];

			// Remove GET string from segments
			if( ($query = strpos($current_uri, '?')) !== FALSE )
			{
				list($current_uri, $query) = explode('?', $current_uri, 2);

				// Parse the query string into $_GET
				parse_str($query, $_GET);
			}
		}
	} elseif ( current($_GET) === '' && substr($_SERVER['QUERY_STRING'], -1) !== '=' ) {
		// The URI is the array key, eg: ?this/is/the/uri
		$current_uri = key($_GET);

		// Remove the URI from $_GET
		unset($_GET[$current_uri]);

		// Remove the URI from $_SERVER['QUERY_STRING']
		$_SERVER['QUERY_STRING'] = ltrim(substr($_SERVER['QUERY_STRING'], strlen($current_uri)), '/&');
	} elseif ( isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] ) {
		//self::$current_uri = $_SERVER['PATH_INFO'];
		$current_uri = $_SERVER['REQUEST_URI'];
	} elseif ( isset($_SERVER['ORIG_PATH_INFO']) && $_SERVER['ORIG_PATH_INFO'] ) {
		$current_uri = $_SERVER['ORIG_PATH_INFO'];
	} elseif ( isset($_SERVER['PHP_SELF']) && $_SERVER['PHP_SELF'] ) {
		$current_uri = $_SERVER['PHP_SELF'];
	}

	$query_string = '';
	if( !empty($_SERVER['QUERY_STRING']) )
	{
		$query_string = '?'.trim($_SERVER['QUERY_STRING'], '&/');
	}

	$current_uri = preg_replace('#\.[\s./]*/#', '', $current_uri);

	$current_uri = trim($current_uri, '/');

	$segments	= explode('/', $current_uri);

	foreach( $segments as $key=>$val ) {
		$_GET[$key] = $val;
	}
}


//入口
function action()
{
	router();
	if ( empty($_GET[0]) || $_GET[0] == 'index.php' ) $_GET[0] = SCRIPT_NAME;
	if( empty($_GET[1]) ) $_GET[1] = 'main';

	//$_GET = array_map('strtolower', $_GET);

	// $file = CONTROLLERS_PATH . $_GET[0] . '.php';
	$file = CONTROLLERS_PATH . $_GET[0]  . '.php';
	// var_dump($file ,__FILE__);exit;	

	if( !file_exists( $file ) )
	{
		errors();
		exit();
		//die('The server is busy, please try again later.');
	}
	// echo  $_GET[1];eixt;
	$c = new index();
	// if( !method_exists( $c, $_GET[1] ) )
	// {
	// 	errors();
	// 	exit();
	// 	//die('The server is busy, please try again later.');
	// }

	$c->$_GET[1]();

	// $c->display($c->tpl);

}

function __autoload ($class_name)
{
	if ($class_name=="soap_server" || $class_name=="nusoap_client")	require VENDORS_PATH . 'nusoap' . DS . 'nusoap.php';
	elseif( is_file(CONTROLLERS_PATH . $class_name . '.php') )	require CONTROLLERS_PATH . $class_name . '.php';
	elseif( is_file( LIB_PATH . $class_name . '.php' ) )	require LIB_PATH . $class_name . '.php';
	elseif( is_file( MODELS_PATH . $class_name. '.php') )	require MODELS_PATH . $class_name. '.php';
	elseif( is_file( MODELS_PATH . str_replace('Model','',$class_name) . '.php' ) )	require MODELS_PATH . str_replace('Model','',$class_name) . '.php';
	else	die('no load class '.$class_name);
}

function getClientIP()
{
	if( isset($_SERVER) )
	{
		if( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )
		{
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} elseif ( isset($_SERVER["HTTP_CLIENT_IP"]) ) {
			$realip = $_SERVER["HTTP_CLIENT_IP"];
		} else {
			$realip = $_SERVER["REMOTE_ADDR"];
		}
	} else {
		if( getenv("HTTP_X_FORWARDED_FOR") )
		{
			$realip = getenv("HTTP_X_FORWARDED_FOR");
		} elseif ( getenv("HTTP_CLIENT_IP") ) {
			$realip = getenv("HTTP_CLIENT_IP");
		} else {
			$realip = getenv("REMOTE_ADDR");
		}
    }
    return addslashes($realip);
}

//url redirect
function redirect($uri = '', $method = '302')
{
	$uri = (array) $uri;

	for ($i = 0, $count_uri = count($uri); $i < $count_uri; $i++)
	{
		if (strpos($uri[$i], '://') === FALSE)
		{
			//$uri[$i] = url::site($uri[$i]);
			$uri[$i] = $uri[$i];
		}
	}
	if ($method == '300')
	{
		if ($count_uri > 0)
		{
			header('HTTP/1.1 300 Multiple Choices');
			header('Location: '.$uri[0]);

			$choices = '';
			foreach ($uri as $href)
			{
				$choices .= '<li><a href="'.$href.'">'.$href.'</a></li>';
			}

			exit('<h1>301 - Multiple Choices:</h1><ul>'.$choices.'</ul>');
		}
	}
	else
	{
		$uri = $uri[0];

		if ($method == 'refresh')
		{
			header('Refresh: 0; url='.$uri);
		}
		else
		{
			$codes = array
			(
			'301' => 'Moved Permanently',
			'302' => 'Found',
			'303' => 'See Other',
			'304' => 'Not Modified',
			'305' => 'Use Proxy',
			'307' => 'Temporary Redirect'
			);

			$method = isset($codes[$method]) ? $method : '302';
			header('HTTP/1.1 '.$method.' '.$codes[$method]);
			header('Location: '.$uri);
		}

		exit('<h1>'.$method.' - '.$codes[$method].'</h1><p><a href="'.$uri.'">'.$uri.'</a></p>');
	}
}

function create_token($client_data)
{
	if (empty($client_data) || !is_array($client_data) || count($client_data)<1)
		return false;
	if (!defined('PASSPORT_KEY'))
		return false;
	$str = PASSPORT_KEY;
        //sort($client_data);
        foreach ($client_data as $key=>$val)
            $str .= '|-|'.$val;
        return md5($str);
}

//email格式验证
function valid_email($email)
{
	return (bool) preg_match('/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD', (string) $email);
}

//tel格式验证

function valid_tel($tel)
{
	return (bool) preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|18[0-9]{9}$/", (string) $tel);
}

/*
【身份证合法性检查程序】（计算最后一位检验码）
[ 理论 ]
18位身份证：前6位是区位码（表示区域），接下来8位是表示出生日期，接下来3位是本区域的所有当天出生的人的序列号（奇数为男，偶数为女），最后1位是整个前面17位的运算得出的校验码，算法下面有实现。
15位身份证：前6位是区位码，接下来6位是出生日期（没有19），接下来3位是当天出生的人的序列号（奇数为男，偶数为女）
15位转18位：日期前面增加19，然后得出17位，最后通过这个17位运算得到最后1位校验码
*/
function get_idcard_sign($identity)
{
	$wi = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
	$ai = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
	$sigma = '';
	for ($i = 0;$i < 17;$i++) {
	    $sigma += ((int) $identity{$i}) * $wi[$i];
	}
	return $ai[($sigma % 11)];
}

function valid_identity($identity)
{
	if( strlen($identity) == 15 )
	{
		return (bool) preg_match("^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$", (string) $identity);
	}
	elseif( strlen($identity) == 18 )
	{
		return (bool) preg_match("^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$", (string) $identity);
	}
	else
	{
		return false;
	}
}

//获取客户端ip
function get_ip()
{
	// Server keys that could contain the client IP address
	$keys = array('HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'REMOTE_ADDR');

	foreach ($keys as $key)
	{
		if (@$ip = $_SERVER[$key])
		{
			$ip_address = $ip;

			// An IP address has been found
			break;
		}
	}

	if ($comma = strrpos($ip_address, ',') !== FALSE)
	{
		$ip_address = substr($ip_address, $comma + 1);
	}

	return $ip_address;
}

/**
 *desc:produce activity no. or verify no.
 *@arg
 *@return string
 */
function produce_no($pre='51yx')
{
	$old = array('0','o','1','i','l');
	$new = array('t','s','e','t','3');

	$len = 11 - mb_strlen($pre);
	$tmp = substr(md5(mt_rand(0,128).microtime()), 4, $len);
	$tmp = str_replace($old,$new,$tmp);

	return $pre.$tmp;
}

/**
 *desc:生成随机码
 *@arg int
 *@return string
 */
function randomkeys($length)
{
  $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
  $key = '';
  for($i=0;$i<$length;$i++)
  {
     $key .= $pattern{rand(0,35)};
  }
  return $key;
}

//检测用户名是否合法
function member_legitimate($username)
{
    if (!preg_match('/^[A-Za-z][A-Za-z0-9_]{3,17}/', $username)) {
        return preg_match('/^13\d{1}\d{8}$|15[012356789]{1}\d{8}$|18[6789]{1}\d{8}$|14[57]{1}\d{8}$/', $username);
    }
    return true;
}


function crypt_encode($data,$key)
{
	$size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_NOFB);

	mt_srand();
	$iv = mcrypt_create_iv($size, MCRYPT_RAND);
	$tmp = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_NOFB, $iv);
	return base64_encode($iv.$tmp);
}

function crypt_decode($data,$key)
{
	$data = base64_decode($data);
	$size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_NOFB);

	$iv = substr($data, 0, $size);
	$data = substr($data, $size);

	return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_NOFB, $iv), "\0");
}

function errors()
{	header("HTTP/1.0 404 Not Found");

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

	$tpl->display("404.tpl");
}

function check_soapclient($client_data = array(), $client_token)
{
	$client_legitimate = false;

	$get_token = array();

	if (empty($client_data) || !is_array($client_data) || count($client_data)<1)
	{
		$client_legitimate = false;
	} else if (!defined('PASSPORT_KEY')) {
		$client_legitimate = false;
	} else {
		$get_token = create_token($client_data);
		if ($get_token === $client_token)
			$client_legitimate = true;
		else
			$client_legitimate = false;
	}

	return $client_legitimate;
}

//检测是否ajax请求
function is_ajax()
{
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
}

function log_info($content,$file=""){	
	$rootdir	=	dirname(dirname(__FILE__));
	$date		=	date("Y-m-d");
	$now		=	date("Y-m-d H:i:s");
	$dateDir	= 	date("Y-m");
	if(!is_dir($rootdir."/log/$dateDir/")){ //2011-06-16 
		mkdir($rootdir."/log/$dateDir/");
	}
	$logFile	=	"";
	if ($file)	$logFile =	$rootdir."/log/$dateDir/".$file.$date.".txt";
	else	$logFile	=	$rootdir."/log/$dateDir/".$date.".txt";
	$fp	=	fopen($logFile,"a+");
	flock($fp, LOCK_EX);
	fwrite($fp,$now." ".$content."\n");
	flock($fp,LOCK_UN);
	fclose($fp);		
}
