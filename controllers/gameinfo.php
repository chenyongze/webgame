<?PHP

//游戏工具条内的左侧信息列表或新闻公告

class gameinfo extends main
{
	public function __construct()
	{
		parent::__construct();
	}

	public function main()
	{
		$this->view->assign('skip_header',true);
		$this->view->assign('skip_left',true);
		$this->view->assign('skip_links',true);
		$this->view->assign('skip_footer',true);
		$this->view->display('gameinfo.tpl');
		exit();
	}
	
	public function createJS(){
		$jsoncb  = $_GET['jsoncallback'];
		$fname   = $_REQUEST['fname'];
		$content = urldecode($_REQUEST['content']);
		$dirname = ROOT_PATH.'web/js/game/';
		
		if(!empty($fname) && !empty($content)){
			$shtml = '';
			$content = str_replace(array("\r\n", "\r", "\n"), " ", addslashes($content));
			$shtml .= "document.write('" . $content . "');";
			
			file_put_contents($dirname.$fname, $shtml);
			
			echo empty($jsoncb) ? json_encode(array('status'=>'succ')) : 
	    	$jsoncb ."(". json_encode(array('status'=>'succ')).")";
			exit();
		}
		exit();
	}
	
	public function __destruct()
	{
	}
}
?>
