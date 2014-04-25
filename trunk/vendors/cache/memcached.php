<?php

class memcached
{
	var $mc;
	var $exp = 3600;
	function __construct($server)
	{
		if ( !$this->mc = new Memcache )
		{
			return false;
		}

		$i=1;
		foreach ( $server as $k => $v )
		{
			if ( $i == 1 )
			{
				if ( !$this->mc->pconnect($k,$v) )
				{
					return false;
				}
			}else
			{
				$this->mc->addServer($k,$v);
			}
			$i++;
		}
		
	}

	function __destruct()
	{
	}

	function memcached($server)
	{
		$this->__construct($server);
	}

	function get($key)
	{
		return $this->mc->get($key);
	}

	function set($key, $value, $exp = -1)
	{
		if ($exp < 0)
		{
			$exp = $this->exp;
		}
		
		return $this->mc->set($key, $value, false, $exp);
	}

	function del($key)
	{
		return $this->mc->delete($key);
	}

	function replace($key, $value, $exp = -1)
	{
		if ($exp < 0)
		{
			$exp = $this->exp;
		}
		return $this->mc->replace($key, $value, $exp);
	}

	function getStats()
	{
		return $this->mc->getStats();
	}
}

?>