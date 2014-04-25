<?php

class mysql_driver extends db
{
	protected function db_connect($tag)
	{
		if($this->config[$tag]['pconnect'])
			return @mysql_pconnect($this->config[$tag]['dbhost'], $this->config[$tag]['username'], $this->config[$tag]['password']);
		else
			return @mysql_connect($this->config[$tag]['dbhost'], $this->config[$tag]['username'], $this->config[$tag]['password'], true);
	}

	protected function db_select($tag)
	{
		return @mysql_select_db($this->config[$tag]['dbname'], $this->conn[$tag]);
	}

	protected function db_set_charset($tag)
	{
		return @mysql_query("SET character_set_connection=".$this->config[$tag]['charset'].", character_set_results=".$this->config[$tag]['charset'].", character_set_client=".$this->config[$tag]['charset']."", $this->conn[$tag]);
	}

	protected function _version()
	{
		return "SELECT version() AS ver";
	}

	protected function _query($sql,$conn_id)
	{
		//$sql = $this->_pre_query($sql,$conn_id);
		return @mysql_query($sql, $conn_id);
	}

	protected function escape_str($str)
	{
		if (is_array($str))
    	{
    		foreach($str as $key => $val)
    		{
    			$str[$key] = $this->escape_str($val);
    		}

    		return $str;
    	}

		if (function_exists('mysql_real_escape_string') && is_array($this->conn) && count($this->conn)>0)
		{
			return mysql_real_escape_string($str);
		}
		elseif (function_exists('mysql_escape_string'))
		{
			return mysql_escape_string($str);
		}
		else
		{
			return addslashes($str);
		}
	}

	protected function _fetch_array($type)
	{
		if ($this->queryid === false or $this->num_rows() == 0)
		{
			return array();
		}
		$rs = array();
		$this->_data_seek(0);
		while ($row = $this->_fetch_assoc())
		{
			$rs[] = $row;
		}
		return $rs;
	}

	protected function _fetch_one($type)
	{
		if ($this->queryid === false or $this->num_rows() == 0)
		{
			return array();
		}
		$rs = array();
		$this->_data_seek(0);
		$rs = $type == 'assoc' ? mysql_fetch_assoc($this->queryid) : mysql_fetch_object($this->queryid);

		return $rs;
	}

	protected function _num_rows()
	{
		return mysql_num_rows($this->queryid);
	}

	protected function _affected_rows()
	{
		return mysql_affected_rows();
	}

	protected function _insert_id()
	{
		return mysql_insert_id();
	}

	protected function _fetch_assoc()
	{
		if ($this->queryid === false or $this->num_rows() == 0)
		{
			return array();
		}
		$rs = array();
		$this->_data_seek(0);
		while ($row = mysql_fetch_assoc($this->queryid))
		{
			$rs[] = $row;
		}
		return $rs;
	}

	protected function _fetch_object()
	{
		if ($this->queryid === false or $this->num_rows() == 0)
		{
			return array();
		}
		$rs = array();
		$this->_data_seek(0);
		while ($row = mysql_fetch_object($this->queryid))
		{
			$rs[] = $row;
		}
		return $rs;
	}

	protected function _data_seek($n = 0)
	{
		return mysql_data_seek($this->queryid, $n);
	}

	protected function _insert($table, $keys, $values)
	{
		return 'INSERT INTO '.$this->_table($table).' ('.implode(', ', $keys).') VALUES ('.implode(', ', $values).')';
	}

	protected function _replace($table, $keys, $values)
	{
		return 'REPLACE INTO '.$this->_table($table).' ('.implode(', ', $keys).') VALUES ('.implode(', ', $values).')';
	}

	protected function _update($table, $values, $where)
	{

		return 'UPDATE '.$this->_table($table).' SET '.implode(', ',$values).' WHERE '.implode(" ", $where);
	}

	protected function _delete($table, $where)
	{

		return 'DELETE FROM  '.$this->_table($table).' WHERE '.implode(" ", $where);
	}

	protected function _limit($limit, $offset)
	{
		if ($offset == 0)
		{
			$offset = '';
		}
		else
		{
			$offset .= ", ";
		}

		return " LIMIT ".$offset.$limit;
	}

	protected function _list_tables()
	{
		$sql = "SHOW TABLES FROM `".$this->dbname."`";

		return $sql;
	}

	protected function _list_columns($table = '')
	{
		return "SHOW COLUMNS FROM ".$this->_table($table);
	}

	protected function _truncate($table)
	{
		return "TRUNCATE ".$this->_table($table);
	}

	protected function _table($table)
	{
		return '`' .$table. '`';
	}

	protected function _error_message()
	{
		return mysql_error();
	}

	protected function _error_number()
	{
		return mysql_errno();
	}

	protected function _close($conn_id)
	{
		return @mysql_close($conn_id);
	}

}
?>