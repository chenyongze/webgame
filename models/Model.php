<?php
class Model{
	/**
	 * 数据库链接对象
	 *
	 * @var object
	 */
	public static $db = null;
	private static $instance;
	
	public $cache;

	protected $_select = array();
	protected $_join = array();
	protected $_from = array();
	protected $_distinct = false;

	protected $_where = array();

	protected $_like = array();

	protected $_instr = array();

	protected $_offset = '';

	protected $_limit = '';

	protected $_group = array();

	protected $_order = array();

	protected $_autoData = array();


	/**
	 * 数据表前缀
	 *
	 * @var string
	 * @access protected
	 */
	protected $_tablePrefix = '';


	/**
	 * 数据库表字段信息
	 * 包括字段名，字段类型，是否为空，是否有默认值
	 *
	 * @access protected
	 */
	protected $_fields = null;

	/**
	 * 字段值集合
	 *
	 * @var array
	 * @access protected
	 */
	protected $_fieldsData = array();

	/**
	 * 构造函数
	 *
	 */
	function __construct()
	{
		// 获取数据库操作对象
		if( self::$db == null )
		{
			self::$db = base::get_instance()->db;
		}
		$this->cache = &$GLOBALS['memcached'];
	}

	public static function get_instance()
	{
		if(self::$instance == null)
		{
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function dbprefix($table = '')
	{
		if( $table == '' )
		{
			die('table is null');
		}

		return $this->_tablePrefix.$table;
	}

	public function select($field='*')
	{
		if( !is_array( $field ) )
		{
			$field = explode(',', $field);
		}

		foreach( $field as $v )
		{
			// $v != '*' &&
			if( !strpos($v, '.') && count( $field ) > 1 )
			{
				$val = $this->_tableName.'.'.$v;
			} else 	{
				$val = $v;
			}

			$this->_select[] = $val;
		}

		return $this;
	}

	/**
     * 取得某个字段的最大值
	 *
     * @access public
     * @param string $field  字段名
     * @param mixed $where  条件
     * @return integer
     */
	public function max( $field,$alias='max' )
	{
		$alias = ($alias != '') ? $alias : $field;

		$sql = 'MAX('.$field.') AS '.$alias;
		$this->_select[] = $sql;
		return $this;
	}

	public function version()
	{
		# code...
		// echo "string";exit;
		$init = $this->version();
		return $init;
	}

	/**
     * 取得某个字段的最小值
	 *
     * @access public
     * @param string $field  字段名
     * @param mixed $where  条件
     * @return integer
     */
	public function min( $field,$alias='min' )
	{
		$alias = ($alias != '') ? $alias : $field;

		$sql = 'MIN('.$field.') AS '.$alias;
		$this->_select[] = $sql;
		return $this;
	}

	/**
     * 统计某个字段的平均值
	 *
     * @access public
     * @param string $field  字段名
     * @param mixed $condition  条件
     * @return integer
     */
	public function avg( $field,$alias='avg' )
	{
		$alias = ($alias != '') ? $alias : $field;

		$sql = 'AVG('.$field.') AS '.$alias;
		$this->_select[] = $sql;
		return $this;
	}

	/**
     * 统计某个字段的总和
	 *
     * @access public
     * @param string $field  字段名
     * @param mixed $where  条件
     * @return integer
     */
	public function sum( $field,$alias='sum' )
	{
		$alias = ($alias != '') ? $alias : $field;

		$sql = 'SUM('.$field.') AS '.$alias;
		$this->_select[] = $sql;
		return $this;
	}

	/**
     * 统计满足条件的记录个数
	 *
     * @access public
     * @param mixed $where  条件
	 * @param string $field  字段名
     * @return integer
     */
	public function count( $field='*',$alias='count' )
	{
		$alias = ($alias != '') ? $alias : $field;

		$sql = 'COUNT('.$field.') AS '.$alias;
		$this->_select[] = $sql;
		return $this;
	}

	 //'user'=>'id=uid'
	public function join($table,$type = 'LEFT')
	{
		$type = strtoupper($type);

		foreach ( $table as $k => $v )
		{
			$ar = explode( '=', $v );
			if ( !strstr('.',$ar[0]) )
			{
				$ar[0] = $k.'.'.$ar[0];
			}
			if ( !strstr('.',$ar[1]) )
			{
				$ar[1] = $this->_tableName.'.'.$ar[1];
			}

			$this->_join[] = $type.' JOIN '.$this->dbprefix($k).' ON '.$ar[0].' = '.$ar[1];
		}

		return $this;
	}

	public function distinct($val = true)
	{
		$this->_distinct = (is_bool($val)) ? $val : true;
		return $this;
	}

	public function notin($where,$type = 'AND')
	{
		return $this->in($where,true,$type);
	}

	public function in($where,$not=false, $type = 'AND')
	{
		foreach ( $where as $k => $v )
		{
			$prefix = (count($this->_where) == 0) ? '' : $type.' ';
			$not = ($not) ? ' NOT' : '';
			$arr = array();
			$values = explode( ',', $v );
			foreach ( $values as $value )
			{
				$arr[] = self::$db->escape($value);
			}

			$this->_where[] = $prefix . $k . $not . " IN (" . implode(", ", $arr) . ") ";
		}
		return $this;
	}

	public function orwhere($where)
	{
		return $this->where($where,'OR');
	}

	public function where($where,$type = 'AND',$type2='')
	{
		foreach ( $where as $k => $v )
		{
			$prefix = (count($this->_where) == 0) ? '' : $type.' ';

			if ( !self::$db->_parse($k) && is_null($v) )
			{
				$k .= ' IS NULL';
			}

			if ( !self::$db->_parse($k))
			{
				$k .= ' =';
			}
			if ( !is_null($v) )
			{
				$v = self::$db->escape($v);
			}
			if ( !empty($type2) ){
				$_where[] = $k.' '.$v;
			}else{
				$this->_where[] = $prefix.$k.' '.$v;
			}
		}

		if ( !empty($type2) && !empty($_where))
		{
			$this->_where[] = $prefix .'('.  implode(" $type2 ", $_where) . ') ';
		}

		if(empty($this->_where)) $this->_where[] = '1';

		return $this;
	}

	public function orlike($where, $not=false, $like='all')
	{
		return $this->like($where,$not,'OR',$like);
	}

	public function like($where, $not=false, $type = 'AND', $like='all')
	{
		foreach ( $where as $k => $v )
		{
			$prefix = (count($this->_like) == 0) ? '' : $type.' ';
			$not = ($not) ? ' NOT' : '';
			$arr = array();
			$v = str_replace("+", " ", $v);
			$values = explode( ' ', $v );
			foreach ( $values as $value )
			{
				if ( $like == 'left' )
				{
					$keyword = "'%{$value}'";
				}else if ( $like == 'right' )
				{
					$keyword = "'{$value}%'";
				}else
				{
					$keyword = "'%{$value}%'";
				}
				$arr[] =  $k . $not.' LIKE '.$keyword;
			}

			$this->_like[] = $prefix .'('.  implode(" OR ", $arr) . ') ';
		}
		return $this;
	}

	public function orinstr($where)
	{
		return $this->instr($where,'OR');
	}

	public function instr($where,$type="AND")
	{
		foreach ( $where as $k => $v )
		{
			$prefix = (count($this->_instr) == 0) ? '' : $type.' ';
			$arr = array();
			$v = str_replace("+", " ", $v);
			$values = explode( ' ', $v );
			foreach ( $values as $value )
			{
				$arr[] =  'INSTR('.$k.', '.self::$db->escape($value).')';
			}
			$this->_instr[] = $prefix .'('.  implode(" OR ", $arr) . ') ';
		}
		return $this;
	}

	public function group($by)
	{
		if (is_string($by))
		{
			$by = explode(',', $by);
		}
		foreach ( $by as $v )
		{
			$this->_group[] = $v;
		}
		return $this;
	}

	public function by($by,$direction="desc")
	{
		$direction = strtoupper($direction);

		if ( $direction == "RAND" )
		{
			$direction = "RAND()";
		}

		$this->_order[] = $by.' '.$direction;
		return $this;
	}

	public function limit($value, $offset = '')
	{
		if ( is_object( $value ) )
		{
			$offset = $value->offset();
			$value = $value->size();
		}

		$this->_limit = $value;

		if ($offset != '') $this->_offset = $offset;

		return $this;
	}

	public function offset($value)
	{
		$this->_offset = $value;
		return $this;
	}

	public function _compile_select($auto=true)
	{
		$sql = ( !$this->_distinct) ? 'SELECT ' : 'SELECT DISTINCT ';

		$sql .= (count($this->_select) == 0) ? '*' : implode(', ', $this->_select);

		$sql .= " FROM ";

		$sql .= $this->_tableName;

		$sql .= " ";

		$sql .= implode(" ", $this->_join);

		if (count($this->_where) > 0 OR count($this->_like) > 0 OR count($this->_instr) > 0)
		{
			$sql .= " WHERE ";
		}

		$sql .= implode(" ", $this->_where);

		if (count($this->_like) > 0)
		{
			if (count($this->_where) > 0)
			{
				$sql .= " AND ";
			}

			$sql .= implode(" ", $this->_like);
		}

		if (count($this->_instr) > 0)
		{
			if (count($this->_where) > 0 OR count($this->_like) > 0)
			{
				$sql .= " AND ";
			}

			$sql .= implode(" ", $this->_instr);
		}

		if (count($this->_group) > 0)
		{
			$sql .= "GROUP BY ";

			$sql .= implode(', ', $this->_group);
		}

		if (count($this->_order) > 0)
		{
			$sql .= " ORDER BY ";
			$sql .= implode(', ', $this->_order);

		}

		if (is_numeric($this->_limit))
		{
			$sql .= self::$db->limit($this->_limit, $this->_offset);
		}
		
		$this->_reset_select();

		if ( $auto )
		{
			return self::$db->query($sql);
		}

		return $sql;
	}

	public function from( $table )
	{
		$this->_tableName	=	$table;
		return $this;
	}

	public function _reset_run($vars)
	{
		foreach($vars as $item => $default_value)
		{

				$this->$item = $default_value;
		}
	}
	
	public function _reset_select()
	{
		$vars = array(
			'_select' => array(),
			'_join' => array(),
			'_where' => array(),
			'_like' => array(),
			'_instr' => array(),
			'_group' => array(),
			'_having' => array(),
			'_order' => array(),
			'_wherein' => array(),
			'_distinct' => false,
			'_limit' => false,
			'_offset' => false,
		);

		$this->_reset_run($vars);
	}
	
	public function _reset_write()
	{
		$this->_where = array();
		$this->_autoData = array();
	}

	
	
	
	
	




	//以下是具体的数据操作，返回真实的数据。常用的数据操作可以封装在这里
	public function insert($data)
	{
		$sql =  self::$db->insert($this->_tableName,array_merge( $data,$this->_autoData ));
//		echo $sql;die;
		$this->_reset_write();
		return self::$db->query($sql)->insert_id();
	}

	public function replace($data,$cache_key='')
	{
		if( !empty( $cache_key ) && is_object($this->cache) )
		{
			$this->cache->del($cache_key);
		}
		$sql =  self::$db->replace($this->_tableName,array_merge( $data,$this->_autoData ));
		$this->_reset_write();
		return self::$db->query($sql)->insert_id();
	}

	public function update($data,$where,$cache_key='')
	{
		if( !isset($where) || !is_array($where) ) exit('参数错误');
		if ( !empty( $cache_key ) && is_object($this->cache) )
		{
			$this->cache->del($cache_key);
		}
		$this->where($where);
		$sql = self::$db->update($this->_tableName,$data,$this->_where);
		$this->_reset_write();
		return self::$db->query($sql)->affected_rows();
	}

	public function increment($data,$where,$cache_key='')
	{
		if( !isset($where) || !is_array($where) ) exit('参数错误');
		if ( !empty( $cache_key ) && is_object($this->cache) )
		{
			$this->cache->del($cache_key);
		}

		$this->where($where);
		$sql = self::$db->increment($this->_tableName,$data,$this->_where);
		$this->_reset_write();
		return self::$db->query($sql)->affected_rows();
	}

	public function delete($where,$cache_key='')
	{
		if( !isset($where) || !is_array($where) ) exit('参数错误');
		if ( !empty( $cache_key ) && is_object($this->cache) )
		{
			$this->cache->del($cache_key);
		}

		$this->where($where);
		$sql = self::$db->delete($this->_tableName,$this->_where);
		$this->_reset_write();
		return self::$db->query($sql)->affected_rows();
	}

	public function getAll($field='*',$where=array(),$cache_key='',$exp=0)
	{
		if ( !empty( $cache_key ) && is_object($this->cache) )
		{
			if ( $rs = $this->cache->get($cache_key) )
			{
				$this->_reset_select();
				return $rs;
			}
		}

		$rs = $this->select($field)->where($where)->_compile_select()->fetch_array();

		if ( !empty( $cache_key ) && is_object($this->cache) )
		{
			 $this->cache->set($cache_key,$rs,$exp);
		}
		
		return $rs;
	}
	
	public function getOne($field='*',$where=array(),$cache_key='',$exp=0)
	{
		if ( !empty( $cache_key ) && is_object($this->cache) )
		{
			if ( $rs = $this->cache->get($cache_key) )
			{
				$this->_reset_select();
				return $rs;
			}
		}

		$rs = $this->select($field)->where($where)->_compile_select()->fetch_one();

		if ( !empty( $cache_key ) && is_object($this->cache) && !empty($rs) )
		{
			$this->cache->set($cache_key,$rs,$exp);
		}

		return $rs;
	}

	//select from master DB
	public function getOneFM($sql,$cache_key='')
	{
		if ( !empty( $cache_key ) && is_object($this->cache) )
		{
			if ( $rs = $this->cache->get($cache_key) )
			{
				$this->_reset_select();
				return $rs;
			}
		}

		$rs = self::$db->query($sql,true)->fetch_one();

		if ( !empty( $cache_key ) && is_object($this->cache) )
		{
			$this->cache->set($cache_key,$rs);
		}

		return $rs;
	}

/**
	 * 执行SQL语句进行查询
	 * 
	 * @param  $sql			
	 * @param  $cache_key
	 * @param  $exp 		自动消毁时间  单位：秒
	 * @return false/ArrayObject
	 */
	public function execQuery($sql='',$cache_key='',$exp=300){
		
		if(empty($sql)) return false;
		
		if ( !empty( $cache_key ) && is_object($this->cache) )
		{
			if ( $rs = $this->cache->get($cache_key) )
			{
				return $rs;
			}
		}
		
		$rs = self::$db->query($sql)->fetch_array();
		
		if ( !empty( $cache_key ) && is_object($this->cache) )
		{
			 $this->cache->set($cache_key,$rs,$exp);
		}
		return $rs;
	}
	/**
	 * 返回影响行数
	 * @param unknown_type $sql
	 */
	public function execUpdate($sql){
		return self::$db->query($sql)->affected_rows();
	}
	/**
	 * 返回ID
	 * @param  $sql
	 */
	public function execInsert($sql){
		return self::$db->query($sql)->insert_id();
	}

	public function getCount($col='*',$where=array())
	{
		return $res = $this->count($col)->where($where)->_compile_select()->fetch_one('count');
	}

	public function getCol($field,$where=array())
	{
		$res = $this->select($field)->where($where)->_compile_select()->fetch_one();
		return isset($res[$field])?$res[$field]:false;
	}


}
?>