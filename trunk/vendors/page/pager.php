<?php

class pager
{
	public $keyword    = 'page';
	/*
	public $first_page = '首页';
    public $last_page  = '尾页';
	public $pre_page   = '上一页';
	public $next_page  = '下一页';
	*/
	public $baseLink   = '';

	public $pageNum;
	
	/**
	* 每页显示条数
	* @var integer
	* @access private
	*/
    public $size = 3;

	/**
	* 总条数
	* @var integer
	* @access private
	*/
    public $total;

    /**
    * 分页样式
    * @var integer
    * @access private
    */
    public $style = '';

	public $ajax = '';

   
	function __construct()
	{
		if (isset($_COOKIE['PAGE']['size']) && intval($_COOKIE['PAGE']['size']) > 0)
		{
			$this->size = intval($_COOKIE['PAGE']['size']);
		}
	}

	function __destruct()
	{
	}

	public function set($var)
	{
		$vars = get_object_vars($this);
		foreach ( $vars as $k => $v )
		{
			if ( !empty( $var[$k] ) )
			{
				if ( is_array( $var[$k] ) )
				{
					$this->$k = $var[$k]['count'];
				}else if ( is_object( $var[$k] ) )
				{
					$info = $var[$k]->count()->_compile_select()->fetch_one();
					$this->$k = $info['count'];
				}else
				{
					$this->$k = $var[$k];
				}
				
			}
		}
		$this->pageNum = $this->pageNum();
		return $this;
	}
	/**
	 * 名称 取得当前页号
	 * @return void
	 * @since 1.0
	 */
	public function current()
	{
		$pageNo = empty($_REQUEST[$this->keyword])?0:intval($_REQUEST[$this->keyword]);
		if ($pageNo <= 0) {
			$pageNo = 1;
		}
		return min($pageNo, $this->pageNum);
	}
	/**
	 * 名称 取得上一页号
	 * @return void
	 * @since 1.0
	 */
	public function pre() 
	{
		$current = $this->current();
		return $current < $this->pageNum ? ($current - 1) : $this->pageNum;
	}
	/**
	 * 名称 取得下一页号
	 * @return void
	 * @since 1.0
	 */
	public function next() 
	{
		$current = $this->current();
		return $current < $this->pageNum ? ($current + 1) : $this->pageNum;
	}

	/**
	 * 取得记录开始的偏移量
	 *
	 * @return void
	 */	
	function offset() 
	{
		$offset = $this->size * ($this->current() - 1);
		if ($offset < 0) {
			$offset = 0;
		}
		return $offset;
	}

	function size()
	{
		return $this->size;
	}


	public function pageNum()
	{

		return ceil($this->total/$this->size);
	}

	public function url($page)
	{
		if ( $this->baseLink )
		{
			return $this->baseLink.'&'.$this->keyword.'='.$page;
		}else
		{
			//自动获取
			//ereg_replace("(^|&){$this->_pageVar}={$this->_currentPage}","",$url_query);
			return str_replace( '/'.$this->keyword.'/'.$this->current(),'' , $_SERVER['REQUEST_URI'] ).'&'.$this->keyword.'='.$page;
		}
	}

	public function get_link($page,$location='')
	{
		if($this->ajax){ 
            //如果是使用AJAX模式 
            return 'javascript:'.$this->ajax."('".$this->url('')."'+".$page.");"; 
        }else if ( $location )
        {
			return "window.location='".$this->url('')."'+".$page.";return false;";
        }else{ 
            return $this->url($page); 
        }
	}
}

?>