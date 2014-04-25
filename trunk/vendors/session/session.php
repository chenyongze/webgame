<?php
class session{

	const sess_name = 'SESSSDPHP';

	var $sess_id;

	var $sess_time = 7200;
	
	var $domain;

	protected function __construct($domain)
	{

		$settime = 60*60*24*365*10;//时间修正	
		session_name(self::sess_name);
		$k = array_keys($_REQUEST[0]);
		log_info(getClientIP()."\t  : ".$_COOKIE[session_name()]."\t ".$k[0]."\t".$_COOKIE[SDK]."\t".$_COOKIE[SDU]."\t".$_COOKIE[SDP]);
		$this->sess_id = isset($_GET['sdsid']) ? trim($_GET['sdsid']) :  $_COOKIE[session_name()];
		$this->domain = $domain;
//		$this->sess_id = isset($_GET['sdsid']) ? trim($_GET['sdsid']) : (empty($_COOKIE[session_name()]) ? $this->gen_sid() : $_COOKIE[session_name()]);
//		session_id($this->sess_id);
//		//@setcookie(session_name(),session_id(),time()+$this->sess_time+$settime,'/',$domain); 
//		@setcookie(session_name(),session_id(),time()+900,'/',$domain);
//		@register_shutdown_function(array($this, 'close'));
		return;
	}

	protected function session()
	{
		$this->__construct();

	}

	public function start()
	{
		if(empty($this->sess_id)){
			$this->sess_id = $this->gen_sid();
		}
		session_id($this->sess_id);
		
		@setcookie(session_name(),session_id(),time()+3600,'/',$this->domain);
		@register_shutdown_function(array($this, 'close'));
		return $this->_start();
	}

	public function close()
	{
		return $this->_set($_SESSION);
	}

	public function get($key)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
	}

	public function set($key,$value) 
	{
		 $_SESSION[$key] = $value;
		 return true;
    }
	
	public function del($key) 
	{
        unset($_SESSION[$key]);
		return true;
    }

    public function destroy() 
	{
        return $this->_destroy();
    }

	public function count()
	{
		return $this->_count();
	}

	public function issess($id='')
	{
		if ( !$id )
		{
			return false;
		}
		return $this->_issess($id);
	}

	private function gen_sid()
	{
		return md5(uniqid(microtime() . getClientIP(), true));
	}

}


?>