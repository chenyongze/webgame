<?PHP
/**
 * 接口文件interface
 * @author happiness
 *
 */
class ajax extends main
{

	public function __construct()
	{
		parent::__construct();
		
	}
	/**
	 * 校验验证码是否正确
	 */
	public function checkValid(){
		$valid 		= $_GET['valid'];
		$callback   = $_GET['jsoncallback'];
		//file_put_contents("d:/aaa.txt","sss: ".$_SESSION['validn']." v :".$valid);
		if(empty($callback)){
			echo json_encode(array('result'=>$_SESSION['validn']==$valid));die;
		}else{
			echo $callback."(".json_encode(array('result'=>$_SESSION['validn']==$valid)).")";
			exit;
		}
	}
	
	public function getServ(){
		$this->loadModel(server_manager);
		$game_id 	= $_GET['game_id'];
		$callback   = $_GET['jsoncallback'];
		$servArr	= $this->server_manager->get_by_gameid($game_id);
		if(empty($callback)){
			echo json_encode($servArr);die;
		}else{
			echo $callback."(".json_encode($servArr).")";
			exit;
		}
	}
	
	//激活码激活
	public function activation(){
		$this->loadModel('common_model');
		$json		= $_GET['jsoncallback'];
		$user_name 	= $_REQUEST['user_name'];
		$game_id	= $_REQUEST['game_id'];
		$card_no 	= $_REQUEST['card_no'];
		
		//判断激活码是否有效
		$query = $this->common_model->checkActivationCode($card_no);
		if($query){
			if(empty($json)){
				echo json_encode(array('actionErrors'=>'e1'));
			}else{
				echo $json . "(".json_encode(array('actionErrors'=>'e1')).")";
			}
			exit();
		}
		
		//判断账号是否已经被激活过
		$query = $this->common_model->checkUserActivation($game_id, $user_name);
		if($query){
			if(empty($json)){
				echo json_encode(array('actionErrors'=>'e3'));
			}else{
				echo $json . "(".json_encode(array('actionErrors'=>'e3')).")";
			}
			exit();
		}
		
		//判断用户或激活码是否可用
		$query = $this->common_model->checkActivation($game_id, $user_name, $card_no);
		if($query){
			if(empty($json)){
				echo json_encode(array('actionErrors'=>'e2'));
			}else{
				echo $json . "(".json_encode(array('actionErrors'=>'e2')).")";
			}
			exit();
		}
		
		$active_ip	= getClientIP(); //IP地址
		$result 	= $this->common_model->activation($card_no, $user_name, $active_ip, $game_id);
		if($result){
			if(empty($json)){
				echo json_encode(array('actionErrors'=>'succ'));
			}else{
				echo $json . "(".json_encode(array('actionErrors'=>'succ')).")";
			}
		}
		exit();
	}
	
	//判断用户是否激活过
	public function check_activation(){
		$this->loadModel('common_model');
		
		$json		= $_GET['jsoncallback'];
		$user_name 	= $_REQUEST['user_name'];
		$game_id	= $_REQUEST['game_id'];
		
		$query 		= $this->common_model->checkUserActivation($game_id, $user_name);
		if(!$query){
			if(empty($json)){
				echo json_encode(array('actionErrors'=>'fail'));
			}else{
				echo $json . "(".json_encode(array('actionErrors'=>'fail')).")";
			}
			exit();
		}
		
		if(empty($json)){
			echo json_encode(array('actionErrors'=>'succ'));
		}else{
			echo $json . "(".json_encode(array('actionErrors'=>'succ')).")";
		}
		exit();
	}
	
	public function __destruct()
	{
		parent::__destruct();
	}
}
?>
