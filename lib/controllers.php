<?php


class controllers
{
	public $cout;//暂时没用

	public $sess;//session

	public $db = null; 	//数据库实例

	public $view;		//smartyp实例

	public $tpl = '';
	
	private static $instance;

	public function __construct()
	{
		//$this->cout = &$GLOBALS['cout'];
		$this->sess = &$GLOBALS['sess'];
		$this->view = &$GLOBALS['tpl'];
	}

	public function __destruct()
	{
	}

	public static function get_instance()
	{
		if( self::$instance == null )
		{
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * 加载Model层，并返回model 实例！
	 * 
	 * @param $module	文件名、Model名要与文件名保持一至
	 * @param $db		是否检查数据库连接（实例化数据库类）
	 */
	public function  loadModel($module,$db=true)
	{
		static $is_Module = array();

		if( array_key_exists($module, $is_Module) || (isset(base::get_instance()->$module) && is_object(base::get_instance()->$module)) )
		{
			if( !$this->$module )
			{
				$this->$module  = base::get_instance()->$module;
			}
			return base::get_instance()->$module;
		}
        
		if( is_file( MODELS_PATH.$module.'.php' ) )
		{
			require_once( MODELS_PATH.$module.'.php');
		} else {
			return false;
		}

		//检测数据库连接
		if( $db && !$this->db )
		{
			$this->db_link();
		}

		$mod = new $module();
		base::get_instance()->$module = $this->$module  = $mod;
		$is_Module[$module] = true;
		return $mod;
	}

	/**
	 * 初始化数据库
	 */
	private function db_link()
	{
		require_once (VENDORS_PATH . 'db'.DS.'db.php');
		require_once (VENDORS_PATH . 'db'.DS.'drivers'.DS.'mysql_driver.php');
		$this->db = base::get_instance()->db = new mysql_driver($GLOBALS['config_db']);
	}

	public function display($tpl='')// 重定义smarty的display方法
	{
		//模版自动赋值
		$this->put(get_object_vars( $this ));
		
		$tpl = $this->tpl($tpl);
		//显示view
		$this->view->display($tpl);
		exit;
	}

	//返回生成页面内容
	protected function fetch($tpl='')// 重定义smarty的fetch方法
	{
		//模版自动赋值
		$this->put(get_object_vars( $this ));
		$tpl = $this->tpl($tpl);
		return $this->view->fetch($tpl);
	}

	private function put($array)
	{
		if ( !is_array( $array ) )
		{
			return false;
		}
		foreach ( $array as $k => $v )
		{
			$this->assign($k,$v);
		}
	}

	private function assign($name, $value)
	{
		$this->view->assign($name, $value);
	}

	private function set($name, $value)
	{
		$this->assign($name, $value);
	}

	protected function tpl($tpl = '')
	{
		if ( !empty( $tpl ) )return $tpl . '.tpl';

		$tpl = $_GET[0] . '.' . $_GET[1].'.tpl';
		
		//if( !is_file($this->view->template_dir.DS.$tpl) ) exit('No tpl file');
		
		return $tpl;
	}
}

?>