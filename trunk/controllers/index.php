<?PHP
class index extends main
{

	public function __construct()
	{
		
//		$this->css[] = 'css';//在这里可以添加CSS文件
//		$this->js[] = 'js';//在这里可以添加JS文件
		$this->member = $this->loadModel('member_model');//初始化model
		//$this->c_title = '系统消息'; //设置页面变量
		
		
		//if(!parent::is_login()){  //TODO 判断用户是否登陆
		//	header("Location:".PASSPORT_URL.'member/login/');
		//}
		parent::__construct();
		$this->css[] = 'dialog';
		$this->js[] = 'dialogs';
		define("VALID_NUMBER", "<img id='valid_src' src='".SITE_URL."member/validn/?f=".rand(0,1000)."' onclick=\"this.src='".SITE_URL."member/validn/?f='+Math.random()\" style='cursor:pointer;'  />");
	}

	public function main()
	{
		// echo "string";exit;
		$result = $this->member->test();
		var_dump($result);exit;
		// echo __file__,__line__;exit;
		// $this->tpl='index';

//		$this->gotourl("http://jwfy.51yx.com");
//		exit;
	}
	
	/**
	 * 广告跳转来的连接(cps)
	 * www.xxx.com/action/Method/站长ID/游戏ID/子ID/?ref=url
	 */
	public function gg(){
		$master_id 	= $_GET[2];	//站长ID
		$game_id	= $_GET[3];	//游戏ID
//		$type		= $_GET[4];	//推广类型 cpa/cps
		$sub_code	= $_GET[4];	//子站长ID
		$ref 		= $_GET['ref'];
		setcookie(WEBMASTER,	$master_id,	0, '/', DOMAIN);
		setcookie(AD_GAME_ID, 	$game_id,	0, '/', DOMAIN);
		setcookie(SPREAD_TYPE, 	2,			0, '/', DOMAIN);//CPS 为2	
		setcookie(SUB_CODE, 	$sub_code,	0, '/', DOMAIN);
		
		$ip = getClientIP();
		$content = $master_id.','.$game_id.',\''.$sub_code.'\' '.$ip;
		@log_info($content,$file="tg_click_"); 

		if(!empty($ref))$this->gotourl($ref);
		else $this->gotourl(SITE_URL.'member/register/');
		exit;
	}
	/**
	 * 推广连接
	 * www.xxx.com/action/Method/站长ID/游戏ID/cpa、cps、。。。/子ID/?ref=url
	 * yy.51yx.com/index/tg/12312312/13/2/11/?ref=url
	 */
	public function tg(){
		$master_id 	= $_GET[2];	//站长ID
		$game_id	= $_GET[3];	//游戏ID
		$type		= $_GET[4];	//推广类型 cpa/cps
		$sub_code	= $_GET[5];	//子站长ID
		$ref 		= $_GET['ref'];
		setcookie(WEBMASTER,	$master_id,	0, '/', DOMAIN);
		setcookie(AD_GAME_ID, 	$game_id,	0, '/', DOMAIN);
		setcookie(SPREAD_TYPE, 	$type,		0, '/', DOMAIN);//CPS 为2	CPA:1   其它：0
		setcookie(SUB_CODE, 	$sub_code,	0, '/', DOMAIN);
		$ip = getClientIP();

		//记点击日志
		//站长ID，游戏ID，子站长ID，访问IP
		$content = $master_id.','.$game_id.',\''.$sub_code.'\' '.$ip;
		@log_info($content,$file="tg_click_"); 

		if($ref)$this->gotourl($ref);
		else $this->gotourl('/member/register');
		exit;
	}
	
	public function __destruct()
	{
		parent::__destruct();
	}
}
?>
