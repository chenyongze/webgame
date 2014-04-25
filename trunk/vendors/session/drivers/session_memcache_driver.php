<?php
class session_memcache_driver extends session{

	private $mc;
	private $config;


	public function __construct($domain = '')
	{
		parent::__construct($domain);
		$this->config = &$GLOBALS['cache_server'];
	}

	public function session_memcache_driver($domain = '')
	{
		$this->__construct($domain);

	}

	protected function  _start()
	{
		if ( !$this->mc = new memcached($this->config) )
		{
			return false;
		}
		/*
		if ( !$this->mc->pconnect($this->config) )
		{
			return false;
		}
		*/
		if ( $this->sess_id && $data = $this->mc->get($this->sess_id) )
        {
			return $data;
        }else
        {
        	return array();
        }
	}

	protected function _set($data) 
	{
		return $this->mc->set($this->sess_id,$data,$this->sess_time);
    }

	protected function _get($key)
	{
		return $this->mc->get($key);
	}

	protected function _destroy() 
	{
        $this->mc->del($this->sess_id);
		return true;
    }   
	
	protected function _count() 
	{
        $info = $this->mc->getStats();
		return $info['curr_items'];
    }
	protected function _issess($id) 
	{
        $sess = $this->mc->get($id);
		if ( !empty( $sess ) )
		{
			return true;
		}else
		{
			return false;
		}
    }

}


?>