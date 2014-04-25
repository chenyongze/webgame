<?PHP
class main extends controllers
{
	public $js;
	public $css;
	public function __construct()
	{

		parent::__construct();

		$this->theme_header = 'theme_header.tpl';
		$this->theme_footer = 'theme_footer.tpl';
		$this->theme_left	= 'theme_left.tpl';
		$this->theme_links	= 'theme_links.tpl';
		
		$this->js = array('dialogs','register');
		$this->css = array('index');
		$this->title = '神雕网络_让梦想在游戏里飞翔_北京神雕展翅科技有限公司<';
		$this->meta['keywords'] = 'keywords';
		$this->meta['description'] = '北京神雕展翅科技有限公司；让梦想在游戏里飞翔；神雕网络；我要游戏；幻想封神、独孤九剑、金山第二代武侠品牌、3D新派逍遥武侠、十大新锐企业；华瓴资本投资；';


		//给模板赋值是否全部验证(安全信息是否全)
		/**
		if ($this->is_login() AND $_SESSION['user']['user_authquestion_status'] AND $_SESSION['user']['user_authemail_status'] AND $_SESSION['user']['user_authmobile_status']){
			$this->all_status = 1;
		}
		*/
	}

	public function display($tpl='')
	{
		$tpl = $this->tpl($tpl);
		$this->theme_content = $tpl;
		parent::display('theme');
	}

	/**
	 * 名称
	 * @return void
	 * @param args array 请求参数
	 * @param act string  请求方法
	 */
	protected function soap($args,$act='')
	{
		$soap_uri = 'http://'.$_SERVER["HTTP_HOST"].'/web/index.php';
		$soap_host = PASSPORT_URL;
		$token = create_token($args);
		$client = new SoapClient(null, array('location' => $soap_host.'soap.php','uri' => $soap_uri));
		//
		if ( empty($act) ){
			return array(0,'缺少方法');
		}

		try {
			if($rs = $client->get($act,$args,$token)) {
				return $rs;
			}

		} catch (SoapFault $e) {
			die('SOAP Error: '.$e->getMessage());
		}
		exit;
	}

	protected function is_login()
	{
//		log_info("main　：".getClientIP()."\t".var_export($_SESSION[SESS_USER],true));
		if( !empty($_SESSION[SESS_USER]) ) return true;
//		log_info("main no session_user：".getClientIP());
		if( isset($_COOKIE[SDK]) && isset($_COOKIE[SDU]) && isset($_COOKIE[SDP]) )
		{
			
			$crypt_key 	= $_COOKIE[SDK];
			$user_name 	= crypt_decode($_COOKIE[SDU],$crypt_key);
			$password	= crypt_decode($_COOKIE[SDP],$crypt_key);
//			$password	= md5(strtoupper(md5($pwd)));
			$logSign = md5($user_name.$password.LOGIN_KEY);
		
			$data = array('passport'=>$user_name,'password'=>$password,'sign'=>$logSign);
		
			$resp = $this->curl_request(LOGIN_URL,$data);
			$resp = json_decode($resp,true);
			$user_java = $resp[0];
			unset($resp);
			
			if (empty($user_java) ||  $user_java['result'] == 'fail'){
				return false;
			}
		
			$this->loadModel('member_model'); //初始model
			$userInfo = $this->member_model->getOne("*",array('account_id'=>$user_java['account_id']),USER_INFO.$user_java['account_id'],3600*2);
			
			$userInfo['account']	= $user_name;
			$userInfo['account_id'] = $user_java['account_id'];
			$userInfo['reg_ip'] 	= empty($userInfo['reg_ip'])?long2ip($user_java['active_ip']):$userInfo['reg_ip'];
			$userInfo['reg_time'] 	= empty($userInfo['reg_time'])?$user_java['active_time']:$userInfo['reg_time'];
			
			$_SESSION[SESS_USER] = $userInfo;
			return true;
		}
		return false;
	}

	//跳转页面
	public function report($message = '', $url = '', $auto_refresh=true)
	{
		//查看cookie返回页面
		if( ! empty($_COOKIE['referer']))
		{
			$referer = $_COOKIE['referer'];
			unset($_COOKIE['referer']);
			setcookie('referer', '', -86400);
			$url = empty($url) ? $referer : $url;
		}

		$this->message = $message;
		$this->url = empty($url) ? SITE_URL : $url;
		$this->auto_refresh = $auto_refresh;
//		$this->skip_header = TRUE;
//		$this->skip_footer = TRUE;
		$this->skip_left = TRUE;
		$this->skip_links = TRUE;

//		$this->css[] = 'account';
		$this->display('404');
	}

	/**
	 +----------------------------------------------------------
	 * 直接跳转函数
	 +----------------------------------------------------------
	 * @access	public
	 * @static
	 +----------------------------------------------------------
	 * @param string $url 跳转的地址
	 +----------------------------------------------------------
	 * @return void
	 +----------------------------------------------------------
	 */
	function gotourl($url){
		if (headers_sent()){
			echo "<script language='JavaScript' type='text/javascript'>window.location.href='$url';</script>";
			die();
		}else{
			header("Location: ".$url);
			die();
		}
	}

	/**	
	 * 模拟get操作，file_get_contents
	 * @param $url string | 要提交的URL地址
	 * @param $optional_headers | 基本上这个不用理会
	 */
	function get_request_file($url,$data=array(),$str="?",$optional_headers = null)
	{
		$exec_start=microtime(true);
		//构造与通信参数
        $opts = array(
			'http'=>array(
				'timeout' => 25,
				'method'  => "GET"
			)
		);
		
		if ($optional_headers !== null) 
		{
			$opts['http']['header'] = $optional_headers;
		}
		$context = stream_context_create($opts);
		$url .= $str.http_build_query($data);
		$url = str_ireplace('amp;','',$url);
		$resp  = file_get_contents($url, false, $context);
		
		$times = $exec_start - microtime(true);
		@log_info('file_get_contents: '.$url.": ".$times.'s','remoteCall_');
//		@log_info(var_dump($resp,true),'remoteCall_');
		return $resp;
	}
	/**
	 * 抓取页面或 获得返回参数
	 * @param $url			请求URL
	 * @param $data			参数
	 * @param $is_post		1：post调用 	0:get调用
	 */
	function curl_request($url,$data=array(),$is_post=0)
	{
		$exec_start=microtime(true);
		
		$curlPost = http_build_query($data);
		$curlPost = str_ireplace('amp;','',$curlPost);
		$ch = curl_init();

		curl_setopt( $ch, CURLOPT_URL,$url);
		curl_setopt( $ch, CURLOPT_POST,$is_post);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT,25);
		curl_setopt( $ch, CURLOPT_TIMEOUT,25);
		curl_setopt( $ch, CURLOPT_POSTFIELDS,$curlPost);
		$result = curl_exec($ch);
		curl_close($ch);
		
		$times = $exec_start - microtime(true);
		@log_info('curl: '.$url.' param: '.$curlPost.": ".$times.'s','remoteCall_');
		@log_info(var_export($result,true),'remoteCall_');
		return $result;

	}
	function socket_request($url,$data,$referrer='',$timeout=6)
	{
		$exec_start=microtime(true);
		$userQuery	 =	$data;
	
		$URL_Info	 = 	parse_url($url);
		
		$request	 = '';
		$result      = '';
		$referrer="";
		if($referrer=="")
		{
			$referrer=$_SERVER['REQUEST_URI'];
		}
		
		$data_string = http_build_query($data);
		$data_string = str_ireplace('amp;','',$data_string);
//		echo $data_string;
//		echo "<br/>";
		$request.="POST ".$URL_Info["path"]." HTTP/1.1\n";
		$request.="Host: ".$URL_Info["host"]."\n";
		$request.="Referer: $referrer\n";
		$request.="Content-type: application/x-www-form-urlencoded\n";
		$request.="Content-length: ".strlen($data_string)."\n";
		$request.="Connection: close\n";
		$request.="\n";
		$request.=$data_string."\n";
		//fsockopen的用法就这样子了，不做多说明
		$fp = @fsockopen($URL_Info["host"], $URL_Info["port"]);
		if (!$fp) {
			return -999;
			exit;
		} else {
			fputs($fp, $request);//把HTTP头发送出去
			while(!feof($fp)) 
			{
				$result .= fgets($fp, 1024);//$result 是提交后返回的数据
			}
			fclose($fp);
			$result = split("\n",$result);
			$res = trim($result[7]);
		}	
		$times = $exec_start - microtime(true);
		@log_info('socket: '.$url.' param: '.$data_string.": ".$times.'s','remoteCall_');
		return $res;
	}
		
	public function __destruct()
	{
		parent::__destruct();
	}
}
?>