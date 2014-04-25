<?php
class db
{
	public $config = array();	
	public $conn = array();
	public $queryid;
	public $querys;
	public $sqls = array();

	function __construct($config){
		$this->config = $config;
	}

	public function init($tag)
	{
		if ( isset($this->conn[$tag]) )
		{
			return true;
		}

		$this->conn[$tag] = $this->db_connect($tag);

		if ( !$this->conn[$tag] )
		{
			die('Can not connect to MySQL server:'.$this->config[$tag]['dbhost']);
		}

		if ( !$this->db_set_charset($tag) )
		{
			die('Unable to set database connection charset:'.$this->config[$tag]['charset']);
		}

		if ( !$this->db_select($tag) )
		{
			die('Cannot use database:'.$this->config[$tag]['dbname']);
		}
	}

	public function version()
	{
		// echo __file__;exit;
		$sql = $this->_version();
		$query = $this->query($sql);
		return $query->fetch_one('ver');
	}

	public function query($sql,$tag=false)
	{
		$this->sqls[] = $sql;
		//$handle = @fopen(DATA_PATH.'sql.log', 'a');
		//@fwrite($handle, $sql."\n");
		//@fclose($handle);
		@log_info($sql,'sql_');
		if( $tag || $this->is_write($sql) )
		{
			$this->init('master');
			$this->queryid = $this->_query($sql,$this->conn['master']);
		} else {
			$this->init('slave');
			$this->queryid = $this->_query($sql,$this->conn['slave']);
		}
			
		$this->querys++;

		return $this;
	}

	public function fetch_array($type='assoc')
	{
		$rs = $this->{'_fetch_'.$type}();

		return $rs;
	}

	public function fetch_one($n=0,$type='assoc')
	{
		$array = $this->_fetch_one($type);

		if ( is_numeric( $n ) )
		{
			return $array;
		}

		return $array[$n];
	}

	public function insert($table,$data)
	{
		$fields = array();
		$values = array();

		foreach($data as $key => $val)
		{
			$fields[] = '`'.$key.'`';
			$values[] = $this->escape($val);
		}

		return $this->_insert($table, $fields, $values);
	}

	public function replace($table,$data)
	{
		$fields = array();
		$values = array();

		foreach($data as $key => $val)
		{
			$fields[] = '`'.$key.'`';
			$values[] = $this->escape($val);
		}

		return $this->_replace($table, $fields, $values);
	}

	public function update($table,$data,$where)
	{
		$fields = array();
		foreach($data as $key => $val)
		{
			$fields[] = '`'.$key."` = ".$this->escape($val);
		}

		return $this->_update($table, $fields, $where);
	}

	public function increment($table,$data,$where)
	{
		$fields = array();
		foreach($data as $key => $val)
		{
			$fields[] = '`'.$key.'` = `'.$key.'`+'.$this->escape($val);
		}

		return $this->_update($table, $fields, $where);
	}

	public function delete($table,$where)
	{
		return $this->_delete($table, $where);
	}

	public function limit($limit, $offset)
	{
		return $this->_limit($limit, $offset);
	}

	public function num_rows()
	{
		return $this->_num_rows();
	}

	//返回影响的记录数
	public function affected_rows()
	{
		return $this->_affected_rows();
	}

	//反回当前插入id
	public function insert_id()
	{
		return $this->_insert_id();
	}

	//释放内存
	public function free_result($queryid)
	{
		return $this->_free_result($this->queryID);
	}

	public function is_write($sql)
	{
		if ( ! preg_match('/^\s*"?(SET|INSERT|UPDATE|DELETE|REPLACE|CREATE|DROP|LOAD DATA|COPY|ALTER|GRANT|REVOKE|LOCK|UNLOCK)\s+/i', $sql))
		{
			return false;
		}
		return true;
	}

	function _parse($str)
	{
		$str = trim($str);
		if ( ! preg_match("/(\s|<|>|!|=|is null|is not null)/i", $str))
		{
			return false;
		}

		return true;
	}

	public function escape($str)
	{
		switch (gettype($str))
		{
			case 'string'	:	$str = "'".$this->escape_str($str)."'";
				break;
			case 'boolean'	:	$str = ($str === FALSE) ? 0 : 1;
				break;
			default			:	$str = ($str === NULL) ? 'NULL' : $str;
				break;
		}

		return $str;
	}


	public function list_tables()
	{
		$sql = $this->_list_tables();

		$rs = array();
		$query = $this->query($sql);

		if ($query->num_rows() > 0)
		{
			foreach($query->fetch_array() as $row)
			{
				if (isset($row['TABLE_NAME']))
				{
					$rs[] = $row['TABLE_NAME'];
				}
				else
				{
					$rs[] = array_shift($row);
				}
			}
		}

		return $rs;
	}

	public function list_fields($table = '')
	{
		// Is there a cached result?

		if ($table == '')
		{
			return false;
		}

		$sql = $this->_list_columns($table);

		$query = $this->query($sql);

		$rs = array();

		foreach($query->fetch_array() as $row)
		{
			if (isset($row['COLUMN_NAME']))
			{
				$rs[] = $row['COLUMN_NAME'];
			} else {
				$rs[] = current($row);
			}
		}

		return $rs;
	}

	public function field_exists($field_name, $table)
	{
		return ( ! in_array($field_name, $this->list_fields($table))) ? false : true;
	}

	public function close()
	{
		foreach($this->conn as $val)
		{
			if (is_resource($val) || is_object($val))
			{
				$this->_close($val);
			}
		}
		$this->conn = array();
	}

}
?>