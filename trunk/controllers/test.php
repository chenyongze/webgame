<?PHP
class test extends main
{

	public function __construct()
	{
		
//		$this->css[] = 'css';//在这里可以添加CSS文件
//		$this->js[] = 'js';//在这里可以添加JS文件
		
		//$this->tt = $this->loadModel('test');//初始化model
		//$this->c_title = '系统消息'; //设置页面变量
		
		
		//if(!parent::is_login()){  //TODO 判断用户是否登陆
		//	header("Location:".PASSPORT_URL.'member/login/');
		//}
		parent::__construct();
	}

	public function main()
	{
//		$this->loadModel('test_manager');//初始化model
//		echo "<pre>"; 
////		var_dump($this);
//		$list = $this->test_manager->getList();
//		//$list = $mod->getList();
//		print_r($list);
//		$this->view->assign("list",$list);
//		$this->tpl='index/test';

//		sign = md5(用户名.密码.校验码)
//		passport 用户名
//		password 密码		base64_encode(密码)
//		realname 真实姓名
//		idcard 身份证号
//echo "start <br/>";
//		
//		$passport ='testwww00000002';
//		$password = base64_encode('1234567');
//		$realname = '王王王';
//		$idcard   = '110108198708184182';
//
//		$regSign = md5($passport.$password.'condor#game7911$');
//		echo $password ,"<br/>";
//		echo base64_decode($password),'<br/>';
//		$url = "http://192.168.1.12:8080/passport/webgameregister?";
//		$url = 'http://192.168.1.110:8080/passport/webgamelogin?';
//		$var = $this->crul_request($url,array('passport'=>$passport,'password'=>$password,'realname'=>$realname,'idcard'=>$idcard,'sign'=>$regSign));
//		var_dump($var);
//		$va = json_decode($var);
//		echo " login: <br/>";
//		$logSign = md5($passport.md5(strtoupper(md5('1234567'))).'conor$game$#919Lk7');
//		$url = 'http://192.168.1.12:8080/passport/webgamelogin?';
//		$var = $this->crul_request($url,array('passport'=>$passport,'password'=>md5(strtoupper(md5('1234567'))),'sign'=>$logSign));
//		var_dump($var);
			phpinfo();
		 
echo "<br/>end";
		die;
	}
	
	
	public function __destruct()
	{
		parent::__destruct();
	}
}
?>
