<?PHP
class member extends main
{

	public function __construct()
	{
		parent::__construct();
		//验证码
		define("VALID_NUMBER", "<img id='valid_src' src='".SITE_URL."member/validn/?f=".rand(0,1000)."' onclick=\"this.src='".SITE_URL."member/validn/?f='+Math.random()\" style='cursor:pointer;'  />");
	}

	public function register()
	{
		
		if(empty($_POST)){
			$this->view->assign('game_id',$_GET[2]);//官网跳转过来的要带游戏ID
			$this->theme_left = true;
			$this->display('register');
			exit;
		}
		
		$user_name 	= $_POST['user_name'];
		$pwd		= base64_encode($_POST['password']);
		$repwd		= $_POST['repassword'];
		$email		= $_POST['email'];
		$realname	= $_POST['realname'];
		$identity	= $_POST['identity'];
		$valid		= $_POST['valid'];
		$from_id	= empty($_POST['from_id']) ? 0 : $_POST['from_id'];
		
		empty($_COOKIE[AD_GAME_ID])?$_COOKIE[AD_GAME_ID] = $_POST['game_id']:0;
		
		if($_SESSION['validn'] !=$valid ){
			$_SESSION['validn'] = '';
			echo "验证码错误！";
			exit;
		}
		$_SESSION['validn'] = '';
		//校验密码是否相同
		if ($repwd != $_POST['password']) {
			echo "密码与重复密码不相等";
			exit;
		}
		//校验email
//		if (!eregi("^[a-z'0-9]+([._-][a-z'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$",$email)) {
//			echo "邮箱错误";
//			exit;
//		}
		$result = $this->regCommon($user_name, $pwd, 0, $realname, $identity, $email, $from_id);
		if($result){
			$game_id  = $_COOKIE[AD_GAME_ID];
			$server_id= $_COOKIE[INV_SERVER_ID];
			if(empty($game_id)){
				$this->gotourl('/');
			}else{
				if(!empty($server_id)){
					$this->gotourl("http://yy.51yx.com/playgame/index/{$game_id}/{$server_id}/");
					die;
				}
				$this->loadModel('game_manager');
				$rs = $this->game_manager->get_game($game_id);
				$this->report("恭喜您，成功注册神雕通行证！",$rs['url']);
			}
		}else{
		    $this->report("注册失败！！","/");
		}
		
	}
    /**
	 * 快速注册的方法
	 */
	public function reg(){
		$user_name 	= $_POST['user_name'];
		$pwd		= base64_encode($_POST['password']);
		$repwd		= $_POST['repassword'];
		$game_id 	= $_POST['gid'];//根据游戏ID获取最新服务器
		$poster 	= $_POST['poster'];
		$from_id	= $_POST['from_id'];//推广来源
		$ser_id		= $_POST['sid'];//服务器ID 广告指定的登陆服务器
		
	    if($user_name==""){
	    	$this->report("用户名不能为空！","/");
	    	exit;
	    }
	    if($pwd==""){
	    	$this->report("密码不能为空！","/");
	    	exit;
	    }
	    if($from_id == 12465){
	    	$game_id = 21;
	    }
	    empty($_COOKIE[AD_GAME_ID])?$_COOKIE[AD_GAME_ID] = $game_id:0;
	    empty($_COOKIE[WEBMASTER])?$_COOKIE[WEBMASTER] = $from_id:0;
	    
		//校验密码是否相同
		$result = $this->regCommon($user_name, $pwd, $poster);
		if($result){
			if(empty($ser_id)){
				$this->loadModel('server_manager');
				$rs = $this->server_manager->get_gameServer_info($game_id);
				if($rs){
					if($rs[0]['status'] == 0){
						if(empty($rs[1]['server_id'])){ //新开游戏有新服情况下
							$rows = $this->server_manager->get_game_info($game_id);
							$this->gotourl(empty($rows[0]['noopen_url'])?'http://www.263wan.com/':$rows[0]['noopen_url']);
							exit();
						}else{ //游戏服务器超过1个以上的情况取上一个服务器
							$ser_id = $rs[1]['server_id'];
						}	
					}else if($rs[0]['status'] == 1){
						$ser_id = $rs[0]['server_id'];
					}else if($rs[0]['status'] == 2){
						$ser_id = $rs[1]['server_id'];
					}
				}
			}
			$request_url = SITE_URL . "playgame/index/{$game_id}/{$ser_id}/";
			$this->gotourl($request_url);
		}else{
		    $this->report("注册失败！！", "/");
		}
	}

	/**
	 * 快速注册的方法(ajax)
	 */
	public function ajaxReg(){
		$json   	= $_GET['jsoncallback'];
		$user_name 	= empty($_GET['user_name'])?empty($_POST['user_name'])?$_REQUEST['user_name']:$_POST['user_name']:$_GET['user_name'];
		$pwd		= base64_encode(empty($_GET['password'])?empty($_POST['password'])?$_REQUEST['password']:$_POST['password']:$_GET['password']);
		$repwd		= empty($_GET['repassword'])?empty($_POST['repassword'])?$_REQUEST['repassword']:$_POST['repassword']:$_GET['repassword'];
		$game_id 	= $_REQUEST['gid'];//根据游戏ID获取最新服务器
		$poster 	= $_REQUEST['poster'];
		$realname 	= $_REQUEST['realname'];
		$identity 	= $_REQUEST['idcard'];
		$valid 		= $_REQUEST['valid'];
		$check_v 	= $_REQUEST['v']; //为空时做验证码校验、不为空时不做验证码校验
		
		if (empty($check_v)){
	    	if(empty($valid) || $_SESSION['validn'] != $valid){
	    		$_SESSION['validn']='';
				if(empty($json)){
					echo json_encode(array('result'=>'fail','code'=>'e1','msg'=>'验证码错误！'));
					exit;
				}else{
					echo $json."(".json_encode(array('result'=>'fail','code'=>'e1','msg'=>'验证码错误！')).")";
					exit;
				}
			}
	    }
	    $_SESSION['validn']='';
	    
	    if($user_name==""){
	    	if(empty($json)){
		    	echo json_encode(array('result'=>'fail','msg'=>"用户名不能为空！"));
		    	exit;
	    	}else {
	    		echo $json."(".json_encode(array('result'=>'fail','msg'=>"用户名不能为空！")).")";
				exit;
	    	}
	    }
	    if($pwd==""){
	    	if(empty($json)){
		    	echo json_encode(array('result'=>'fail','msg'=>"密码不能为空！"));
		    	exit;
	    	}else {
	    		echo $json."(".json_encode(array('result'=>'fail','msg'=>"密码不能为空！")).")";
				exit;
	    	}
	    }
	    
	    empty($_COOKIE[AD_GAME_ID])?$_COOKIE[AD_GAME_ID] = $game_id:0;

		$result = $this->regCommon($user_name,$pwd,$poster,$realname,$identity);
		if($result){
			$this->loadModel('server_manager');
			$rs = $this->server_manager->get_by_gameid($game_id);
			$server_id = $rs[0]['server_id']; 
			if(empty($json)){
				echo json_encode(array('result'=>'ok','msg'=>SITE_URL."playgame/index/{$game_id}/{$server_id}/"));
				exit;
			}else {
				echo $json."(".json_encode(array('result'=>'ok','msg'=>SITE_URL."playgame/index/{$game_id}/{$server_id}/")).")";
				exit;
			}
		}else{
			if(empty($json)){
			    echo json_encode(array('result'=>'fail','msg'=>"注册失败！"));
			    exit;
		    }else {
		    	echo $json."(".json_encode(array('result'=>'fail','msg'=>"注册失败！")).")";
				exit;
		    }
		}
	}
	
	/**
	 * 用户登陆()
	 * 
	 */
	public function login()
	{
		$user_name  = $_POST['user_name'];
		$pwd 		= $_POST['password'];
		$isSave 	= $_POST['loginsave'];
		$password 	= md5(strtoupper(md5($pwd)));
		$result = $this->loginCommon($user_name,$password,$isSave,86400*30);
		if ($result) {
			$this->gotourl('/');	
		}else {
			//用户名密码错误
			$this->report( "用户名密码错误");
		}
		
	}
	/**
	 * 海报的用户登陆()，登录后直接进入游戏
	 * 
	 */
	public function adj_login()
	{
		$json   	= $_GET['jsoncallback'];
		$user_name	= $_REQUEST['user_name'];
		$password	= $_REQUEST['password'];
//		log_info(var_export($_REQUEST,true));
		if(empty($password)){ //密码空
			if(empty($json)){
				echo json_encode(array('msg'=>2));die;
			}else{
				echo $json."(".json_encode(array('msg'=>2)).")";
				exit;
			}
		}
		$password	= md5(strtoupper(md5($password)));
		$game_id 	= $_REQUEST['gid'];//根据游戏ID获取最新服务器
		
		$result = $this->loginCommon($user_name,$password);
		
		if ($result) {
			$this->loadModel('server_manager');
			
			$rs = $this->server_manager->get_by_gameid($game_id);
			$server_id = $rs[0]['server_id'];
			//$returnVal=$game_id;
			$returnVal = 3;
		}else {
			//用户名密码错误
			$returnVal = 1;
		}
		if(empty($json)){
			echo json_encode(array('msg'=>$returnVal,'server_id'=>$server_id));die;
		}else{
			echo $json."(".json_encode(array('msg'=>$returnVal,'server_id'=>$server_id)).")";
			exit;
		}
	}
		/**
	 * 用户登陆(iframe)
	 * jwfy游戏官网 登陆
	 */
	public function webLogin()
	{
		$this->view->assign('msg','');
		if(empty($_POST)){
			$this->view->display('login.tpl');
			die;
		}
		$user_name  = $_POST['user_name'];
		$pwd 		= $_POST['password'];
		$password 	= md5(strtoupper(md5($pwd)));
		$game_id	= $_POST['game_id'];
		$result = $this->loginCommon($user_name,$password,true,86400*30);
		if ($result) {
			$sessJson = $_SESSION[SESS_USER];
			$mod = $this->loadModel('server_manager');
			
			$lastLogins = $mod->lastLoginSer($user_name);
			$servers = $mod->get_by_gameid($game_id);
			foreach ($lastLogins as $key=>$val){
				foreach ($servers as $k=>$v){
					if ($v['server_id'] == $val['server_id']) {
						$lastLogins[$key]['ser_name'] = $v['server_name'];
					}
				}
			}
			$this->view->assign('lastLogins',$lastLogins);
		}else {
			$this->view->assign('msg','用户名密码错误');
		}
		$this->view->display('login.tpl');
		exit;
	}
	
	public function ajaxLogin(){
		$json   	= $_GET['jsoncallback'];
		$user_name  = empty($_GET['user_name'])?empty($_POST['user_name'])?$_REQUEST['user_name']:$_POST['user_name']:$_GET['user_name'];
		$password	= empty($_GET['password'])?empty($_POST['password'])?$_REQUEST['password']:$_POST['password']:$_GET['password']; 
		$game_id	= $_REQUEST['game_id'];
		$valid		= $_REQUEST['valid'];
		$retype		= $_REQUEST['retype']; //是否验证码
		$isSave		= empty($_REQUEST['isSave']) ? 0 : 1;
		if(intval($_SESSION['err_times'])>2){ //错误两次后必须有验证码
			$retype = 1;
		}
		//验证码
		if(empty($retype)){
			if(!empty($valid) && $_SESSION['validn'] != $valid){
				if(empty($json)){
					echo json_encode(array('msg'=>'loginFail','result'=>'e1'));
					exit;
				}else{
					echo $json."(".json_encode(array('msg'=>'loginFail','result'=>'e1')).")";
					exit;
				}
			}
		}
		
		if($_GET['do_md5']){ //密码未做MD5加密，做MD5加密
			$password = md5(strtoupper(md5($password)));
		}
		
//		if(empty($user_name) || empty($password)){
//			$result = $this->is_login();
//			$user_name = $_SESSION[SESS_USER]['account'];
//		}else{
		$result = $this->loginCommon($user_name,$password,1);
//		}
		
		if ($result) {
			$_SESSION['err_times'] = 0;
			setcookie('err_times', 0, time() -3600, '/', DOMAIN);//清除错误次数
			
			$sessJson = $_SESSION[SESS_USER];
			$mod = $this->loadModel('server_manager');
			
			//在没有game_id的情况下处理
			if(empty($game_id)){
				$result = $this->lastLogins($mod, $sessJson['account_id']);
				$lastLogins = $result['lastinfo'];
				$gameNames = $result['game'];
				$serverNames = $result['ser'];
				$game_id = $result['game_id'];
				$server_id = $result['server_id'];
			}else{
				//如果有game_id，取游戏最后登陆的三个服务器
				$lastLogins = $mod->lastLoginSer($sessJson['account_id'], $game_id);
				$servers = $mod->get_by_gameid($game_id);
				$newServer = $mod->newServer($game_id);
				foreach ($lastLogins as $key=>$val){
					foreach ($servers as $k=>$v){
						if ($v['server_id'] == $val['server_id']) {
							$lastLogins[$key]['ser_name'] = $v['server_name'];
						}
					}
				}
			}
			
			$u_info = json_encode(array('msg'=>'loginSucceed','result'=>$lastLogins,'account_id'=>$sessJson['account_id'],'account'=>$user_name,'game'=>$gameNames[$game_id],'ser'=>$serverNames[$server_id],'newServer'=>$newServer));
			setcookie('servers', $u_info, time() + 3600, '/', '.51yx.com');
			
			if(empty($json)){
				echo json_encode(array('msg'=>'loginSucceed','result'=>$lastLogins,'account_id'=>$sessJson['account_id'],'account'=>$user_name,'game'=>$gameNames[$game_id],'ser'=>$serverNames[$server_id],'newServer'=>$newServer));
				exit;
			}else{
				echo $json."(".json_encode(array('msg'=>'loginSucceed','result'=>$lastLogins,'account_id'=>$sessJson['account_id'],'account'=>$user_name,'game'=>$gameNames[$game_id],'ser'=>$serverNames[$server_id],'newServer'=>$newServer)).")";
				exit;
			}		
		}else {
			$_SESSION['err_times'] +=1;
			setcookie('err_times',$_SESSION['err_times'], time() + 30, '/', DOMAIN);
			if(empty($json)){
				echo json_encode(array('msg'=>'loginFail','err_times'=>$_SESSION['err_times']));
			}else {
				echo $json."(".json_encode(array('msg'=>'loginFail','err_times'=>$_SESSION['err_times'])).")";
			}
			exit;
		}
		exit;
	}
	
	public function ajaxCheckLogin(){
		$json   = $_GET['jsoncallback'];
		if ($this->is_login()) {
			$sessJson = $_SESSION[SESS_USER];
			$user_name = $sessJson['account'];
			$game_id  = $_GET['game_id'];
			$mod = $this->loadModel('server_manager');
			
			if(empty($game_id)){
				$result = $this->lastLogins($mod, $sessJson['account_id']);
				$lastLogins = $result['lastinfo'];
				$gameNames = $result['game'];
				$serverNames = $result['ser'];
				$game_id = $result['game_id'];
				$server_id = $result['server_id'];
			}else{
				$lastLogins = $mod->lastLoginSer($sessJson['account_id'], $game_id);
				$servers = $mod->get_by_gameid($game_id);
				$newServer = $mod->newServer($game_id);
				foreach ($lastLogins as $key=>$val){
					foreach ($servers as $k=>$v){
						if ($v['server_id'] == $val['server_id']) {
							$lastLogins[$key]['ser_name'] = $v['server_name'];
						}
					}
				}
				if(empty($lastLogins)){
					$lastLogins[0]['ser_name']='';
					$lastLogins[0]['game_id']='';
					$lastLogins[0]['server_id']='';
				}
			}
			echo $json."(".json_encode(array('msg'=>'loginSucceed', 'result'=>$lastLogins, 'account_id'=>$sessJson['account_id'], 
			'account'=>$sessJson['account'], 'game'=>$gameNames[$game_id], 'ser'=>$serverNames[$server_id], 'newServer'=>$newServer)).")";
			exit;
		}else {
			
			echo $json."(".json_encode(array('msg'=>'loginFail')).")";
			log_info(var_export($_SESSION[SESS_USER],true));
			exit;
		}
	}
	/**
	 * 退出
	 */
	public function logout(){
		$referer = $_GET['ref'];
		$_SESSION[SESS_USER] = '';
		setcookie(SDK, "", time()-3600, '/', DOMAIN);
		setcookie(SDU,  "", time()-3600, '/', DOMAIN);
		setcookie(SDP,  "", time()-3600, '/', DOMAIN);
		setcookie('servers',  "", time()-3600, '/', DOMAIN);
		unset($_COOKIE[session_name()]); //清cookie里的session_id
		$sess = &$GLOBALS['sess'];
		@$sess->destroy();
		
		@header('Location: http://hd2.51yx.com/login/logout/');
		
		if (empty($referer)) {
			$this->gotourl("/");
		}else{
			$this->gotourl($referer);
		}
		
	}
	/**
	 * 生成验证码
	 */
	public function validn()
	{
		$checkcode					=	new validn();
		$checkcode->width			=	60;
		$checkcode->height			=	30;
		$checkcode->codelength		=	4;
		$checkcode->fontSize		=	14;
		$checkcode->checkCodeType	=	2;
		$checkcode->fontFile		=	"font/tahoma.ttf";
		$checkcode->pictrues();
		exit;
	}
	/**
	 * 检验用户是否存在
	 */
	public function userExist(){
		$json   = $_GET['jsoncallback'];
//		exit($json."(".json_encode(array('result'=>-999)).")");
		$userNameReg = "^[a-zA-Z0-9][a-zA-Z0-9\_\.\@\-]{5,30}$";//账号格式
		$userQuery['passport']	= $_GET['userName'];
		
		//帐号检测
		$rest = strtoupper(substr($userQuery['passport'], 0, 2));
		if($rest=="SD"||$rest=="LK")
		{
			die($json."(".json_encode(array('result'=>-999)).")");//
		}
		//帐号检测
		if(!ereg($userNameReg,$userQuery['passport']))
		{
			die($json."(".json_encode(array('result'=>-1111)).")");//
		}
//		$userQuery['validate']	= md5($userQuery['userName'].CHECK_USER_KEY);
		/****************************
		请求注册服务器，进行用户注册
		*****************************/
		$referrer="";
		if($referrer=="")
		{
			$referrer=$_SERVER["SCRIPT_URI"];
		}
		$reCheck = $this->curl_request(CHECK_USER_EXIST_URL,$userQuery,true);
		die($json."(".json_encode(array('result'=>intval($reCheck))).")");
	}
	/**
	 * 通过接口登陆通用的方法
	 *
	 * @param request的用户名 $user_name
	 * @param request的密码 $pwd，做过两级md5
	 * @param 是否记住登陆 $isSave
	 * @return 布尔型 ture（登陆成功） 或 false（登陆失败）
	 */
	private function loginCommon($user_name,$password,$isSave=false,$time=86400)
	{
		//$password	= md5(strtoupper(md5($pwd)));
		$logSign = md5($user_name.$password.LOGIN_KEY);
		
		$data = array('passport'=>$user_name,'password'=>$password,'sign'=>$logSign);

		$resp = $this->curl_request(LOGIN_URL,$data); //通过curl，校验用户名密码
		$resp = json_decode($resp,true);
		$user_java = $resp[0];
		
		unset($resp);
		if (empty($user_java) ||  $user_java['result'] == 'fail'){
			return false;
		}	
		$this->loadModel('member_model'); //初始model
		$userInfo = $this->member_model->getOne("*",array('account_id'=>$user_java['account_id']),USER_INFO.$user_java['account_id'],3600*2);
		
		$userInfo['account_id'] = $user_java['account_id'];
		$userInfo['account'] 	= $user_name;
		$userInfo['reg_ip'] 	= empty($userInfo['reg_ip'])?long2ip($user_java['active_ip']):$userInfo['reg_ip'];
		$userInfo['reg_time'] 	= empty($userInfo['reg_time'])?$user_java['active_time']:$userInfo['reg_time'];
		
		$_SESSION[SESS_USER]  = $userInfo;
		$crypt_key = md5($user_name.time().ENCRYPT_KEY);
		$cookie_pwd = crypt_encode($password,$crypt_key);
		
		if( $isSave ) //记住登陆
		{
			setcookie(SDK, $crypt_key, time() + $time, '/', DOMAIN);
			setcookie(SDU, crypt_encode($user_name,$crypt_key), time() + $time, '/', DOMAIN);
			setcookie(SDP, $cookie_pwd, time() + $time, '/', DOMAIN);
		}else{
			setcookie(SDK, $crypt_key, 0, '/', DOMAIN);
			setcookie(SDU, crypt_encode($user_name,$crypt_key), 0, '/', DOMAIN);
			setcookie(SDP, $cookie_pwd, 0, '/', DOMAIN);
		}
		return true;
	}	
     /**
      * 通过接口注册通用的方法
      * 
      * @param $user_name	用户名
      * @param $pwd			密码，做过base64编码
      * @param $poster		海报码
      * @param $realname	真实姓名
      * @param $identity	身份证
      * @param $email		邮箱
      */
	private function regCommon($user_name, $pwd, $poster='', $realname='', $identity='', $email='', $reg_from_id = 0){
//		$user_name = strtolower($user_name);
		$ip = getClientIP();
		//取站长信息
		$from_id  = $_COOKIE[WEBMASTER];
		$game_id  = $_COOKIE[AD_GAME_ID];
		$type	  = $_COOKIE[SPREAD_TYPE];
		$sub_code = $_COOKIE[SUB_CODE];
		$invite	  = $_COOKIE[INVITE];
		//调用Java接口 验证,取account_id.
		$regSign = md5($user_name.$pwd.REG_USER_KEY);
		$data = array('passport'=>$user_name,'password'=>$pwd,'ip'=>$ip,'realname'=>$realname,'idcard'=>$identity,'sign'=>$regSign);
		$rereg = $this->get_request_file(REG_USER_URL,$data);
		$re_array = json_decode($rereg);
		if(empty($re_array) || $re_array[0]->result == 'fail'){
			return false;//注册失败
		}
		$account_id = $re_array[0]->account_id;
		//取站长推广有效期
		$period = 0;
		$cps_end_time = date('Y-m-d H:i:s');
		$this->loadModel('member_model');
		
		if ($type == 2){//cps
			$union = $this->member_model->from('union_webmaster')->getOne('*',array('webmaster_id'=>$from_id),UNION_.$from_id,3600*12);
			if($union['status'] == 1){
				$period = empty($union['share_month'])?0:$union['share_month'];	
			}
//			$period = empty($union['share_month'])?0:$union['share_month'];
			
			$cps_end_time = date('Y-m-d',strtotime("+$period	month"));
			if($game_id == 14 ){ //炼狱世界发卡
				$this->getAndUseCard($game_id,$account_id,$user_name,$pwd,$ip);
			}
		}
		$week = date('N');
		$hour = date('H');
		$user = array(	'account_id'	=>	$account_id,
					  	'account'		=>	$user_name,
						'email'			=>	$email,
						'reg_ip'		=>	$ip,
						'reg_time'		=>	date('Y-m-d H:i:s'),
						'from_id'		=>	empty($from_id) ? $reg_from_id : $from_id,
						'game_id'		=>	empty($game_id)?0:$game_id,
						'poster'		=>	empty($poster)?0:$poster,
						'type'			=>	empty($type)?0:$type,
						'period'		=>	$period,
						'cooper_id'		=>	0,
						'sub_code'		=>	empty($sub_code)?0:$sub_code,
						'cps_end_time'  =>	$cps_end_time,
						'week'  		=>	$week,
						'hour'  		=>	$hour,
						'invite'		=>  empty($invite)?0:$invite
					 );
		$a = $this->member_model->from('account')->insert($user);
		$_SESSION['validn'] = '';
		$_SESSION[SESS_USER] = $user;
		$crypt_key = md5($user_name.time().ENCRYPT_KEY);
		
		$inter_pwd = md5(strtoupper(md5(base64_decode($pwd))));
		$cookie_pwd = crypt_encode($inter_pwd,$crypt_key);
		
//		log_info("member　：".getClientIP()."\t".var_export($_SESSION[SESS_USER],true));
		setcookie(SDK, $crypt_key, time() + 3600*5, '/', DOMAIN);
		setcookie(SDU, crypt_encode($user_name,$crypt_key), time() + 3600*5, '/', DOMAIN);
		setcookie(SDP, $cookie_pwd, time() + 3600*5, '/', DOMAIN);
		
		//记录用户登陆 分流页用
		$other = json_encode(array('msg'=>'loginSucceed','result'=>'','account_id'=>$account_id,'account'=>$user_name));
		setcookie('servers', $other, time() + 1800, '/', '.51yx.com');
		
		//TODO 调用广告注册  
//		md5 = Constants.getMD5(Constants.JAVA_TO_PHP_KEY+svalue+registerIP+userName).substring(0,16).toLowerCase();
//		url = new URL(" http://c.51yx.com/client/regdata.php?cid="+svalue+"&pp="+userName+"&ip="+registerIP+"&key="+md5);
//		JAVA_TO_PHP_KEY = "!@#Condor)(*";
		$condor_adsys_id = $_COOKIE['condor_adsys_id'];
		if(!empty($condor_adsys_id)){
			$adsys_pub_key = "!@#Condor)(*";
			$adsys_key = strtolower(substr(md5($adsys_pub_key.$condor_adsys_id.$ip.$user_name),0,16));
			$adsys_url = "http://c.51yx.com/client/regdata.php?cid=$condor_adsys_id&pp=$user_name&ip=$ip&key=$adsys_key";
			@$this->curl_request($adsys_url);
		}
		return true;
	}
//	------------------------取卡用卡-------------------------
	/**
	 * 发送并激活礼品卡（客户端游戏）
	 * 
	 * @param $game_id	游戏ID
	 * @param $user_id	玩家ID
	 * @param $user_name 玩家用户名
	 * @param $pwd		原始密码
	 * @param $ip		玩家IP
	 */
	private function getAndUseCard($game_id,$user_id,$user_name,$pwd,$ip){
		$this->loadModel('member_model'); //初始model
		$card = $this->member_model->from('cards')->limit(1)->getOne('*',array('game_id'=>$game_id,'status'=>0));
		$this->member_model->from('cards')->update(array('status'=>1,'uid'=>$user_id,'apply_time'=>date('Y-m-d H:i:s')),array('id'=>$card['id']));
		
		$data = array(  'userName'=>$user_name,
						'password'=>md5(base64_decode($pwd)),
						'gameid'=>$game_id,
						'userIP'=>$ip,
						'activeCode'=>$card['code'],
						'validate'=>md5($user_name.CARD_KEY)
					);
		$this->curl_request(CARD_URL,$data);//调用卡激活
	}
//	------------------------测试登陆-------------------------
	/**
	 * 用户登陆()
	 * 
	 */
	public function test()
	{
		$this->skip_header = true;
		$this->skip_links = true;
		$this->skip_left = true;
		$this->skip_footer = true;
		if(empty($_POST)){
			$this->display('testLogin');
		}
		$user_name  = $_POST['user_name'];
		$pwd 		= $_POST['password'];
		$password 	= md5(strtoupper(md5($pwd)));
		$result = $this->loginCommon($user_name,$password,1,86400*30);
		if ($result) {
			$this->gotourl('/member/test/');	
		}else {
			//用户名密码错误
			$this->report( "用户名密码错误",'/member/test/');
		}
	}
	
	/**
	 * 重置数组
	 *
	 * @param  $arr 原始数组
	 * @param  $key 数组的键
	 * @param  $val 数组的值
	 * @return  $key=>$val 新数组
	 */
	public function resetArr($arr,$key,$val){
		foreach ($arr as $k=>$v){
			if(empty($key)){
				$newArr[] = $v[$val];
			}else {
				$newArr[$v[$key]] = $v[$val];
			}
		}
		return $newArr;
	}
	
	/**
	 * 返回游戏和服务器
	 * @param $mod				类对象
	 * @param $account_id		用户ID
	 */
	private function lastLogins($mod, $account_id){
		$lastLogins = $mod->from('play_game')->by('play_time')->getOne('*', array('account_id'=>$account_id), LAST_PLAY.$account_id, 3600*12);
		$game_id = $lastLogins['game_id'];
		$server_id = $lastLogins['server_id'];
		
		$games = $mod->from('games')->getAll('*','',GAME_ALL); //全部游戏信息
		$servers = $mod->from('game_servers')->getAll('*','',SERVER_ALL); //全部服务器信息
		
		$gameNames = $this->resetArr($games,'game_id','game_name');
		$serverNames = $this->resetArr($servers,'server_id','server_name');
		
		return array('lastinfo'=>$lastLogins, 'game'=>$gameNames, 'ser'=>$serverNames, 'game_id'=>$game_id, 'server_id'=>$server_id);
	}
	
	public function __destruct()
	{
		parent::__destruct();
	}
}
?>
