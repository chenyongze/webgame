<?php

class playgame extends main
{

    public function __construct()
    {
        parent::__construct();
       // $this->is_login();
    }

    /**
     * 从官网登陆游戏
     */
	public function index()
	{    
		if (! isset($_GET[2]) || ! isset($_GET[3])) {
			$this->report("登录参数错误！");
		}
		
		$gameid		= intval($_GET[2]);
		$serverid	= intval($_GET[3]);
		
        if(!$this->is_login() ){
			$this->loadModel('game_manager');
//			$game = $this->game_manager->get_game($gameid);
			$this->gotourl("http://www.263wan.com/login.html?reurl=".urlencode("http://go.263wan.com/playgame/index/{$gameid}/{$serverid}/"));
        }
		$visitor_ip	= getClientIP();

		//判断用户登陆，未登陆跳转到登陆页 TODO:未完成
		$user = $_SESSION[SESS_USER];
		if(empty($user['account_id'])){
			$this->loadModel('game_manager');
//			$game = $this->game_manager->get_game($gameid);
//			$this->report("您还未登录,或已登陆超时！请您从官网登陆游戏！",$game['url']);
			$this->gotourl("http://www.263wan.com/login.html?reurl=".urlencode("http://go.263wan.com/playgame/index/{$gameid}/{$serverid}/"));
        }
        
		$login_info = $this->check_game($user,$gameid,$serverid,$visitor_ip);

		switch ($login_info['flag']){
			case 1://无此游戏
				$this->report("参数错误！");die;
				break;
			case 2://服务器与游戏不匹配
				$this->report("参数错误！",$login_info['game_url']);die;
				break;
			case 3://游戏维护
				$this->gotourl($login_info['tip_url']);//维护时跳转到维护页
				
//				if($login_info['game_id'] == 19){ //19：热血武林激活页！
//					$this->gotourl('http://hd.51yx.com/20111201/');
//				}else {
//					$this->report("游戏正在维护，请您稍后重新登录！",$login_info['game_url']);
//				}
				die;
				break;
			case 4://账号需要激活
				if($login_info['game_id'] == 19){ //19：热血武林激活页！
					$this->report("游戏测试阶段，激活账号后方可进入游戏！","http://hd.51yx.com/20111117/");
				}else {
					$this->report("游戏测试阶段，激活账号后方可进入游戏！",$login_info['game_url']);
				}
				die;
				break;
			case 5://游戏未开服
				$this->gotourl($login_info['noopen_url']);//维护时跳转到维护页
				die;
				break;
		}
		
		$location_url = $this->play($login_info,$visitor_ip,$gameid,$serverid);
		
		$this->view->assign('login_info',$login_info);
		$this->view->assign('url',$location_url);
		$this->view->assign('skip_header',true);
		$this->view->assign('skip_left',true);
		$this->view->assign('skip_links',true);
		$this->view->assign('skip_footer',true);
		$this->view->display('game.tpl');
		exit();
	}
	
	/**
     * 从合作方登陆游戏
     */
	public function login()
	{    
		//接收GET参数
		$cooper		= $_GET['cooper']; //合作商标识
		$game_id	= $_GET['gameid']; //游戏ID
		$serverid	= $_GET['serverid']; //服务器ID
		$user		= $_GET['userid']; //用户ID
		$ip			= $_GET['ip']; //IP地址
		$ts			= $_GET['ts']; //时间戳
		$sign		= $_GET['sign']; //加密串
		$furl		= $_GET['furl']; //失败跳转地址
		
		//判断参数是否齐全
		if (!isset($cooper) || !isset($game_id) || !isset($serverid) || !isset($ip) || !isset($ts) || !isset($sign)) {
			echo 1001;
			die();
		}
		
		$this->loadModel('common_model');
		$this->loadModel('member_model');
		
		//第一步 判断cooper是否存在并取出key
		$cooper_result = $this->member_model->from('cooper')->getOne('*', array('name_en'=>$cooper), "wg_cooper_" . $cooper);
		if(empty($cooper_result)){
			echo 1002; //无此合作商
			die();
		}else{
			$from_id	= $cooper_result['from_id'];
			$publicKey 	= $cooper_result['key'];
			$cooper_id	= $cooper_result['coop_id'];
		}
		
		/**
		 * 第二步 判断用户ID是否存在
		 * (1) 用户不存在，调用java接口进行注册并取出account_id
		 * (2) 注册到account表
		 */
		
		$userinfo 		= array();
		$reg_time		= date('Y-m-d H:i:s');
		$user_result 	= $this->member_model->from('account')->getOne('*', array('account'=>$user."|".$cooper_id), "wg_account_" . $user, 3600*2);
		if(empty($user_result)){ //该用户不存在，注册为我们的用户
			//调用java接口验证，取account_id
			$password 	= $realname = $identity = $email = $poster = '';
			$regSign 	= md5($user . $password . $publicKey);
			$data 		= array(
				'passport'	=>	$user,
				'password'	=>	$password,
				'ip'		=>	$ip,
				'unite'		=>	$cooper,
				'realname'	=>	$realname,
				'idcard'	=>	$identity,
				'sign'		=>	$regSign
			);
			$rereg 		= $this->get_request_file(C_REGISTER_URL, $data);
			$re_array 	= json_decode($rereg);
			if(empty($re_array) || $re_array[0]->result == 'fail'){
				echo 1003; //注册失败
				die();
			}
			$account_id = $re_array[0]->account_id;
			
			//注册到account表
			$week 		= date('N');
			$hour 		= date('H');
			$accountArr = array(
				'account_id'	=>	$account_id,
			  	'account'		=>	$user."|".$cooper_id,
				'email'			=>	$email,
				'reg_ip'		=>	$ip,
				'reg_time'		=>	$reg_time,
				'from_id'		=>	empty($from_id) ? 0 : $from_id,
				'game_id'		=>	empty($game_id) ? 0 : $game_id,
				'cooper_id'		=>	$cooper_id,
				'sub_code'		=>	0,
				'week'  		=>	$week,
				'hour'  		=>	$hour
			 );
			$result 	= $this->member_model->from('account')->insert($accountArr);
			
			$userinfo['account_id'] = $account_id;
			
		}else{ //是我们的用户将查询信息
			$userinfo['account_id'] = $user_result['account_id'];
		}
		
		$userinfo['from_id'] 	= $from_id;
		$userinfo['account'] 	= $user;
		$userinfo['coop_id'] 	= $cooper_id;
		$userinfo['reg_time'] 	= $reg_time;
		
		if(empty($userinfo['account_id'])){// 临时增加校验
			echo 1007;die();
        }
        
		//第三步 判断游戏ID和服务器ID是否存在
		$login_info = $this->check_game($userinfo, $game_id, $serverid, $ip);
		if($login_info['flag'] == 1){
			echo 1004; //无此游戏
			die();
		}elseif($login_info['flag'] == 2){
			echo 1005; //服务器与游戏不匹配
			die();
		}elseif($login_info['flag'] == 3){
			echo 1006; //游戏维护
			die();
		}elseif($login_info['flag'] == 5){
			echo 1006; //游戏维护
			die();
		}
		
		//第四步 验证sign是否正确 
		$new_sign = md5($cooper . $game_id . $serverid . $user . $ts . $publicKey);
		if($new_sign !== $sign){
			if(empty($furl)){
				echo 1007; //sign错误
			}else{
				header("Location: ". $furl);
			}
			die();
		}
		
		
		//第五步 登录成功进入游戏
		$location_url = $this->play($login_info, $ip, $game_id, $serverid);
		header("Location: ". $location_url);
		exit();
	}
	
	/**
	 * 游戏校验<br/>
	 * 错误返回一个整型值<br/>
	 * 正确返回登陆用的全部信息
	 * 
	 * @param  $user		用户基本信息
	 * @param  $gameid		游戏ID
	 * @param  $serverid	服务器ID
	 * @param  $coop_id		合作对方登陆，官网登陆可以不写
	 *
	 */
	private function check_game($user,$gameid,$serverid,$ip,$coop_id=''){
		
		$this->loadModel('game_manager');
		$this->loadModel('server_manager');
		$this->loadModel('playgame_model');

		$game = $this->game_manager->get_game($gameid);
		if (! $game) {
			//无此游戏
			return 1;
		}

		$server = $this->server_manager->get_by_serverid($serverid);

		//-------------------重组数据S-----------------------
		$login['game_id']		= $game['game_id'];
		$login['game_code']		= $game['game_code'];
		$login['game_name']		= $game['game_name'];
		$login['game_url']		= $game['url'];		//游戏官网地址
		$login['loginurl']		= $game['loginurl'];
		$login['login_key']		= $game['login_key'];
		$login['login_arg']		= $game['loginurl_argument'];
		$login['login_md5']		= $game['login_md5'];
		$login['is_plugin']		= $game['is_plugin'];
		
//		$login['tip']			= $game['tip'];
		$login['tip_url']		= $game['tip_url'];
		$login['noopen_url']	= $game['noopen_url'];
		
		$login['server_no']		= $server['number'];
		$login['server_id']		= $server['server_id'];
		$login['is_iframe']		= $server['is_iframe'];
		$login['server_name']	= $server['server_name'];
		
		$login['account_id']	= $user['account_id'];
		$login['from_id']		= $user['from_id'];
		$login['invite']		= $user['invite'];
		if($gameid != $user['game_id']) $login['invite']=0; //邀请限游戏
		//------------------重组数据E-----------------------------
		
		$server_no = $server['number'];
		//验证服务器是否是该游戏的
		if ($gameid != $server['game_id']) {
			//TODO 服务器与游戏不匹配
			$login['flag'] = 2;
			return $login;
		}

		//--------------游戏维护判断---------------------------//
		
		//判断游戏是否是维护状态
		if($game['enabled'] == 0 || $server['status'] == 0 ){
			//TODO: 游戏维护状态
			$login['flag'] = 3;
			return $login;
		}
		//判断游戏是否需要激活账号
		if($game['enabled'] == 2){
			//不用激活用户
			if ( ! in_array( strtolower($user['account']), explode( "\r\n", file_get_contents(DATA_PATH.'no_open_users') ) ) ) {
				$this->loadModel('common_model');
				$res = $this->common_model->checkUserActivation($gameid,$user['account']);
				if(!$res){//
					//TODO: 账号需要激活
					$login['flag'] = 4;
					return $login;
				}
			}
		}
		//判断游戏服务器是否是调试状态、未开服时允许测试用户进
		if ($server['status'] == 2) {
			if ( ! in_array( strtolower($user['account']), explode( "\r\n", file_get_contents(DATA_PATH.'no_open_users') ) ) ) {
				//TODO: 调试状态 未开服
				$login['flag'] = 3;
				return $login;
			}
		}
			
		//IP限制登陆判断
		if($server['limit_ip']){
			//用户不限IP用户
			if ( ! in_array( strtolower($user['account']), explode( "\r\n", file_get_contents(DATA_PATH.'no_open_users') ) ) ) {
				$company_ips = array('59.108.35.98');
				if (!in_array($ip,$company_ips)){
					$login['flag'] = 3; //TODO: 提示游戏维护
					return $login;
				}
			}
		}
		//--------------游戏维护判断 end--------------------------//
		
		//判断游戏地址是否为服务器单独配置
		if(!$game['is_dns']){ //0：DNS未对应IP登陆地址从game_servers表取
			$login['loginurl'] = $server['loginurl'];
		}
		
		if (!$coop_id){
			//更新我玩过的游戏
			$this->playgame_model->update_playgame($user, $gameid, $serverid);
		}
		//记录首次登陆
		$this->playgame_model->login_first($user,  $gameid, $serverid);
		
		//每天登陆游戏LOG
		$this->playgame_model->update_playgame_log($user, $gameid, $serverid,$ip);
		
		return $login;
	}
	
	/**
	 * 游戏登陆
	 * 
	 * @param  $user
	 * @param  $visitor_ip
	 * @param  $gameid
	 * @param  $serverid
	 * 
	 * @return	返回游戏登陆地址 
	 */
	private function play($login_info,$visitor_ip,$gameid,$serverid){

		//游戏登陆--扩展方式登陆
		if ($login_info['is_plugin']) {
			//----
			header("Cache-Control: no-cache, must-revalidate");
			$gcode			= $login_info['game_code'];
			require (VENDORS_PATH . 'game_plugin'.DS.$gcode.'_login.php');
			$A				= ucfirst($gcode);
			$model			= $A.'_login';
			$gamelogin		= new  $model();
			$gamelogin->index($login_info);
			exit;
		}

//		uid=$uid&uname=$uname&lgtime=$time&uip=$uip&type=51yx&sid=$sid&key=$key
//		uid=$uid&uname=$uname&lgtime=$time&uip=$uip&type=51yx&sid=$sid&sign=$sign
		$loginurl 	= $login_info['loginurl'];
		$time		= time();									//时间
		$uid 		= $uname 	= $login_info['account_id'];	//用户ID、用户名
		
		$uip		= $visitor_ip;								//用户IP
		$sid 		= $login_info['server_no'];					//服务器编号
		$key		= $login_info['login_key'];					//登陆KEY
		$from_id	= $login_info['from_id'];
		$invite		= $login_info['invite'];
		if($login_info['game_id']==13){	//剑舞风云
			$time		= date('YmdHis');						//日期
		}
//		
		$loginurl = str_replace("{n}", $sid, $loginurl);
		
	
		if($from_id == 2002){//用户为电影网用户时修改登陆参数
			$login_info['login_arg'] = 'partner=m1905&username=$uid&ts=$time&invited=$invite&token=$sign&recommender=$from_id';
			$login_info['login_md5'] = 'm1905$partent$uid$time$invite$key';
		}
		if($login_info['game_id']==20){ //凡人修真
			$login_info['login_arg'] = str_replace("{n}", $sid, $login_info['login_arg']);
			$login_info['login_md5'] = str_replace("{n}", $sid, $login_info['login_md5']);
		}
		if($login_info['game_id']==21){
			$isAdult = -1;
		}
		//生成MD5 密钥
		eval("\$login_md5=\"{$login_info['login_md5']}\";");
		$sign = md5($login_md5);
		
		//生成URL
		$location_url = $loginurl.$login_info['login_arg'];
		eval("\$location_url=\"$location_url\";");
		
		@log_info(var_export($login_info,true),'game_login_');
		@log_info($location_url,'game_login_');
		
		//判断游戏是否嵌入到iframe
		if (!$login_info['is_iframe']) {
			header("Location:".$location_url);
			exit();
		}
		return $location_url;		
    }
    
    public function test(){
    	$location_url = 'http://yy.51yx.com/playgame/index/16/121';
		$this->view->assign('skip_header',true);
		$this->view->assign('skip_left',true);
		$this->view->assign('skip_links',true);
		$this->view->assign('skip_footer',true);
		//$this->view->assign('login_info',$login_info);
		$this->view->assign('url', $location_url);
		$this->view->display('game.tpl');
    }
    
}
