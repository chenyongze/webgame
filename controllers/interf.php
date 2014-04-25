<?PHP
/**
 * 接口文件interface
 * @author happiness
 *
 */
class interf extends main
{

	public function __construct()
	{
		parent::__construct();
		
	}
	/**
	 * 为Java提供写Cookie 用
	 */
	public function getCookie(){
		$u = $_GET[2];
		$p = $_GET[3];
		$crypt_key = md5($u.time().ENCRYPT_KEY);
		$user  	=  crypt_encode($u,$crypt_key);
		$pwd	=  crypt_encode($p,$crypt_key);
		echo $crypt_key."_".$user."_".$pwd;
		setcookie(SDK, $crypt_key, time() + 3600*2, '/', DOMAIN);
		setcookie(SDU, $user, time() + 3600*2, '/', DOMAIN);
		setcookie(SDP, $pwd, time() + 3600*2, '/', DOMAIN);
			
		exit;
	}
	
	/**
	 * 为Java提供解Cookie用
	 */
	public function decodeCookie(){	
		$k	= base64_decode(@$_POST['k']);
		$u 	= base64_decode(@$_POST['u']);
		$p 	= base64_decode(@$_POST['p']);
		$s  = @$_POST['s'];//加密串
		$sk = "!@#456";				
		$ss = md5($k.$u.$p.$sk);		
		if($ss==$s){	
			$user = crypt_decode($u,$k);
			$pwd  = crypt_decode($p,$k);			
			echo $user.",".$pwd;
		}else{
			echo -1;
		}
		exit;
	}	
	
	
	/**
	 * 查询注册用户
	 * http://yy.51yx.com/interf/getRegUserInfo/?platformID=站长ID&beginDate=开始时间&endDate=结束时间&sign=验证码
	 * $key = ""
	 */
	public function getRegUserInfo(){
		$key		= "fjdsakpfy89=$%^&*";
		$from_id 	= $_REQUEST['platformID'];
		$sDate 		= $_REQUEST['beginDate'];
		$eDate 		= $_REQUEST['endDate'];
		$sign		= $_REQUEST['sign'];
		//如果空返回参数错误
		if (empty($from_id) || empty($sDate) || empty($eDate) || empty($sign)) {
			echo json_encode(array('msg'=>'Parameter Error'));
			exit;
		}
		if($sign != md5($from_id.$key)){  //如果Key
			echo json_encode(array('msg'=>'Sign Error'));
			exit;
		}
		$mod = $this->loadModel('interf_model'); //查询数据 返回数组
		$result = $mod->getRegUser($from_id,$sDate,$eDate);
		echo json_encode(array('msg'=>'Succeed',
				'result' => $result
				));
		exit;	
	}
	/**
	 * 取PlatformID 平台下自定义时间范围内的cps消费数据信息
	 * http://yy.51yx.com/interf/getRegUserInfo/?platformID=站长ID&beginDate=开始时间&endDate=结束时间&sign=验证码
	 */
	public function getRecharge(){
		$key		= "fjdsakpfy89=$%^&*";
		$from_id 	= $_REQUEST['platformID'];
		$sDate 		= $_REQUEST['beginDate'];
		$eDate 		= $_REQUEST['endDate'];
		$sign		= $_REQUEST['sign'];
		if (empty($from_id) || empty($sDate) || empty($eDate) || empty($sign)) {
			echo json_encode(array('msg'=>'Parameter Error'));
			exit;
		}
		if($sign != md5($from_id.$key)){  //如果Key
			echo json_encode(array('msg'=>'Sign Error'));
			exit;
		}
		$mod = $this->loadModel('interf_model'); //查询数据 返回数组
		$result = $mod->getCharge($from_id,$sDate,$eDate);
		echo json_encode(array('msg'=>'Succeed',
				'result' => $result
				));
		exit;
	}
	
	//--------------------------------------合作接口-------------------------------------------
	/**
	 * 从合作方注册（E家通）
	 * 
	 *  用户名	passport	必填		6-16位小写英文字母、数字以及下划线_组成,首位为字母
	 *	密码		pwd			必填		6-12位英文字母及数字组成
	 *	IP		ip			必填		用户IP地址
	 *	游戏ID	gid			选填		用户游戏来源
	 *	真实姓名	realname	选填		2-6汉字
	 *	身份证号	idcard		选填	
	 *	邮箱		mail		必填	
	 *	合作ID	uid			必填		合作方唯一ID
	 *	签名		sign		必填		MD5(passport+pwd+key)
	 *
	 *	result	ok 表示成功 fail表示失败
	 *	msg	错误提示
 	 *
	 */
	public function register(){
		$passport	= $_GET['passport'];
		$pwd		= $_GET['pwd'];
		$ip			= $_GET['ip'];
		$gid		= $_GET['gid'];
		$realname 	= $_GET['realname'];
		$idcard 	= $_GET['idcard'];
		$mail 		= $_GET['mail'];
		$uid 		= $_GET['uid'];
		$sign 		= $_GET['sign'];
		
		if(empty($passport) || empty($pwd) || empty($ip) || empty($mail) || empty($uid) || empty($sign)){
			die(json_encode(array('result'=>'fail','msg'=>'Missing argument')));
		}
		$this->loadModel('member_model');
		$coop = $this->member_model->from('cooper')->getOne('*',array('coop_id'=>$uid),"wg_cooper_$uid");
		
		if($sign != md5($passport.$pwd.$coop['key'])){
			die(json_encode(array('result'=>'fail','msg'=>'sign error')));
		}
		
		$res = $this->regCommon($passport,$pwd,$realname,$idcard,$mail,$coop['from_id'],$ip,$gid);
		if($res){
			die(json_encode(array('result'=>'ok','msg'=>'success')));
		}else{
			die(json_encode(array('result'=>'fail','msg'=>'Registration failure')));
		}
	}
	
	/**
	 * 检查用户是否存在
	 * 
	 * passport	用户名	必填		6-16位小写英文字母、数字以及下划线_组成。用户名不能以”SD”,”LK”开头
	 * sign	签名	string	必填		MD5(passport+key)
	 * uid	合作方标识	必填
	 */
	public function checkuser(){
		$userQuery['passport']	= $_GET['passport'];
		$uid 		= $_GET['uid'];
		$sign 		= $_GET['sign'];
		
		if(empty($userQuery['passport']) || empty($uid) || empty($sign)){
			die(json_encode(array('result'=>'fail','msg'=>'Missing argument')));
		}
		
		$this->loadModel('member_model');
		$coop = $this->member_model->from('cooper')->getOne('*',array('coop_id'=>$uid),"wg_cooper_$uid");
		
		if($sign != md5($userQuery['passport'].$coop['key'])){
			die(json_encode(array('result'=>'fail','msg'=>'sign error')));
		}
		
		$userNameReg = "^[a-zA-Z0-9][a-zA-Z0-9\_\.\@\-]{5,30}$";//账号格式
		
		//帐号检测
		$rest = strtoupper(substr($userQuery['passport'], 0, 2));
		if($rest=="SD"||$rest=="LK")
		{
			die(json_encode(array('result'=>'fail','msg'=>'Account format error')));//
		}
		//帐号检测
		if(!ereg($userNameReg,$userQuery['passport']))
		{
			die(json_encode(array('result'=>'fail','msg'=>'Account format error')));//
		}
		
		//1009 表示有用户
		//0 表示没有用户		
		$reCheck = $this->curl_request(CHECK_USER_EXIST_URL,$userQuery,true);
		if ($reCheck == 1009){//用户已存在
			die(json_encode(array('result'=>'fail','msg'=>'Account already exists')));//
		}else {
			die(json_encode(array('result'=>'ok','msg'=>'success')));
		}
	}
	/**
	 * 登陆游戏
	 * uid		合作方ID		必填
	 * passport	用户名		必填
	 * pwd		密码			必填
	 * gameid	游戏id		必填
	 * ip		用户IP		必填
	 * sign		签名			必填		MD5(passport+ pwd +key)
	 */
	public function login(){
		$uid 		= $_GET['uid'];
		$passport	= $_GET['passport'];
		$pwd		= $_GET['pwd'];
		$ip			= $_GET['ip']; //ip木有用到
		$gid		= $_GET['gid'];
		$sign 		= $_GET['sign'];
		
		if(empty($passport) || empty($pwd) || empty($gid) || empty($uid) || empty($sign)){
			die(json_encode(array('result'=>'fail','msg'=>'Missing argument')));
		}
		
		$this->loadModel('member_model');
		$coop = $this->member_model->from('cooper')->getOne('*',array('coop_id'=>$uid),"wg_cooper_$uid");
		
		if($sign != md5($passport.$pwd.$coop['key'])){
			die(json_encode(array('result'=>'fail','msg'=>'sign error')));
		}
		
		$password = base64_decode($pwd);
		$password 	= md5(strtoupper(md5($password)));
		$res = $this->login_arg($passport,$password);
		
		if(!$res){
			die(json_encode(array('result'=>'fail','msg'=>'Login error')));//
		}
		
		$crypt_key 	= md5($passport.time().ENCRYPT_KEY);
		$u_name 	= crypt_encode($passport,$crypt_key);
		$u_pwd		= crypt_encode($password,$crypt_key);
		log_info($crypt_key);
		log_info($u_name);
		log_info($u_pwd);
		//TODO 暂时只有一个服务器。如果多个服务器。修改跳转连接到服务器选择页面。页面需要取key 用户名 密码
		$key  = str_ireplace('=','-',base64_encode($crypt_key));
		$uname= str_ireplace('=','-',base64_encode($u_name));
		$upwd = str_ireplace('=','-',base64_encode($u_pwd));
		
		if($gid == 16){//神魔杀
			$url = "yy.51yx.com/interf/play/16/121/{$key}/{$uname}/{$upwd}";//TODO: 平台登陆地址
			die(json_encode(array('result'=>'ok','msg'=>$url)));//
		}
	}
	/**
	 * 登陆平台成功后 进入游戏 
	 */
	public function play(){
		 //www.xxx.com/interf/play/游戏ID/服务器ID/KEY/用户名/密码

		if (! isset($_GET[2]) || ! isset($_GET[3])) {
			$this->report("登录参数错误！");
		}
		
		$gameid		= intval($_GET[2]);
		$serverid	= intval($_GET[3]);
		
    	$this->loadModel('game_manager');
		$game = $this->game_manager->get_game($gameid);
		if(empty($game)){
			$this->report("登录参数错误！");
		}
		
//		if (empty($_SESSION[SESS_USER])){
			$temp_key 	= str_ireplace('-','=',$_GET[4]);
			$temp_name 	= str_ireplace('-','=',$_GET[5]);
			$temp_pwd 	= str_ireplace('-','=',$_GET[6]);

			$crypt_key	= base64_decode($temp_key);
			$user_name 	= crypt_decode(base64_decode($temp_name),$crypt_key);
			$password	= crypt_decode(base64_decode($temp_pwd),$crypt_key);

			$res = $this->login_arg($user_name,$password);
			
			if(!$res){
				$this->report("您还未登录,或已登陆超时！请您从官网登陆游戏！",$game['url']);
			}
			
			//-----写用户名 密码 重新写 Cookie  有效期12小时
			$crypt_key = md5($user_name.time().ENCRYPT_KEY);
			setcookie(SDK, $crypt_key, time() + 3600*12, '/', DOMAIN);
			setcookie(SDU, crypt_encode($user_name,$crypt_key), time() + 3600*12, '/', DOMAIN);
			setcookie(SDP, crypt_encode($password,$crypt_key), time() + 3600*12, '/', DOMAIN);
//		}
		
		header("Location: http://yy.51yx.com/playgame/index/$gameid/$serverid");//TODO: 平台登陆地址
	}
	//----------------------------注册-------------------------------------------
	  /**
	   * 注册通用的方法
	   * @param $user_name 	用户名
	   * @param $pwd		密码 已base64_encode (原始密码)
	   * @param $realname	真实姓名
	   * @param $idcard		身份证
	   * @param $email		邮件
	   * @param $from_id	来源
	   * @param $ip			用户IP
	   * @param $game_id	游戏ID
	   * @param $sub_code	字站长
	   */
	private function regCommon($user_name,$pwd,$realname='',$idcard='',$email='',$from_id='',$ip='',$game_id='',$sub_code=''){
		//调用Java接口 验证,取account_id.
		$regSign = md5($user_name.$pwd.REG_USER_KEY);
		$data = array('passport'=>$user_name,'password'=>$pwd,'ip'=>$ip,'realname'=>$realname,'idcard'=>$idcard,'sign'=>$regSign);
		$rereg = $this->get_request_file(REG_USER_URL,$data);
		$re_array = json_decode($rereg);
		if(empty($re_array) || $re_array[0]->result == 'fail'){
			return false;//注册失败
		}
		$account_id = $re_array[0]->account_id;

		$this->loadModel('member_model');
	
		$reg_time = date('Y-m-d H:i:s');
		$week = date('N');
		$hour = date('H');
		$user = array(	'account_id'	=>	$account_id,
					  	'account'		=>	$user_name,
						'email'			=>	$email,
						'reg_ip'		=>	$ip,
						'reg_time'		=>	$reg_time,
						'from_id'		=>	empty($from_id)?0:$from_id,
						'game_id'		=>	empty($game_id)?0:$game_id,
						'poster'		=>	0,
						'type'			=>	0,
						'period'		=>	0,
						'cooper_id'		=>	0,
						'sub_code'		=>	empty($sub_code)?0:$sub_code,
						'cps_end_time'  =>	$reg_time,
						'week'  		=>	$week,
						'hour'  		=>	$hour
					 );
		$a = $this->member_model->from('account')->insert($user);
		
		$_SESSION[SESS_USER] = $user;
		$crypt_key = md5($user_name.time().ENCRYPT_KEY);
		setcookie(SDK, $crypt_key, time() + 3600, '/', DOMAIN);
		setcookie(SDU, crypt_encode($user_name,$crypt_key), time() + 3600, '/', DOMAIN);
		setcookie(SDP, crypt_encode( md5(strtoupper(md5($pwd))),$crypt_key), time() + 3600, '/', DOMAIN);
		
		return true;
	}
	
/**
	 * 用户登录 通过参数
	 * 
	 * @param $username 用户名
	 * @param $pwd		密码    md5(strtoupper(md5($password)));
	 */
	private function login_arg($user_name = '',$password = ''){
		
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
	//----------------------------取游戏维护信息----------------------------------
	/**
	 * 取游戏维护信息
	 * g：游戏ID
	 */
	public  function getGameInfo(){
		$jsoncb 	= $_GET['jsoncallback']; //jsoncallback
		$game_id = $_GET['g'];
		$mod = $this->loadModel('game_manager');
		$info = $mod->get_game($game_id);
		unset($info['loginurl']);
		unset($info['loginurl_argument']);
		unset($info['login_key']);
		unset($info['login_md5']);
		unset($info['is_plugin']);
		unset($info['cps_ratio']);
		unset($info['cpa_ratio']);
		unset($info['type']);
		unset($info['is_dns']);
		echo empty($jsoncb) ? json_encode($info) : $jsoncb ."(". json_encode($info).")";
		die;
	}
	
	public function __destruct()
	{
		parent::__destruct();
	}
}
?>
