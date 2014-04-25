<?php
/**
 +------------------------------------------------------------------------------
 * 分页处理类 pagination
 +------------------------------------------------------------------------------
 * 
 +------------------------------------------------------------------------------
 */
class Pagination
{
	private $totalPage=0;	//总页数
	private $totalCounts=0;	//总记录数
	private $currentPage=0;	//当前页数
	private $prePage=0;		//前一页
	private $nextPage=0;	//后一页
	private $pageSize=0;	//页大小
	
	/**
	 +------------------------------------------------------------------------------
	 * 构造函数
	 +------------------------------------------------------------------------------
	 * $totalCounts		总记录数
	 * $pageSize		设置的页大小
	 * $currentPage		当前查询页 注意下标从1开始 
	 +------------------------------------------------------------------------------
	 */
	function __construct($totalCounts,$pageSize,$currentPage) {
		$this->setTotalCounts($totalCounts);
		$this->setPageSize($pageSize);
		$this->setCurrentPage($currentPage);					
		$temp = $totalCounts/$pageSize;		
//		$this->setTotalPage(ceil($temp)+1);	
		if($temp>floor($temp)){
			$this->setTotalPage(floor($temp)+1);			
		}else{
			$this->setTotalPage($temp);
		}		
	}	
	
	public function setTotalPage($s){
		$this->totalPage=$s;
	}
	public function setTotalCounts($s){
		$this->totalCounts=$s;
	}
	public function setCurrentPage($s){		
		$this->currentPage=$s;		
	}
	public function setPageSize($s){
		$this->pageSize=$s;
	}		
	
	public function getPrePage(){
		if($this->currentPage-1<=0){
			return $this->currentPage;
		}else {
			return $this->currentPage-1;
		}	
	}	
	
	public function getNextPage(){		
		if ($this->currentPage + 1 >= $this->totalPage) {			
			return $this->totalPage;			
		} else {
			return ($this->currentPage + 1);
		}		
	}	
	
	public function getTotalPage(){		
		return $this->totalPage;			
	}
		
	public function getPageSize(){
		return $this->pageSize;
	}
	
	public function getTotalCounts(){
		return $this->totalCounts;
	}
	public function getCurrentPage(){
		return $this->currentPage;
	}
	
	
	/**
	 +------------------------------------------------------------------------------
	 * 得到分页的html串 显示的url是html的
	 +------------------------------------------------------------------------------
	 * $totalPage		总页数
	 * $currentPage		当前查询的是第几页 注意下标从1开始
	 * $prePage			当前页的上一页 
	 * $nextPage		当前页的下一页
	 * $lastViewPage	当前页面显示的最后一页的页码(重要)
	 * $viewPage		设定的需要显示的页码数
	 * $control			控制器名
	 * $action			方法名
	 * $params			查询所需额外参数 如果没有可以为空
	 +------------------------------------------------------------------------------
	 */
	public static function getPageHtml($totalPage,$currentPage,$prePage,$nextPage,
								 $lastViewPage,$viewPage=10,$control,$action,$params=''){								 	
		$newLastViewPage  = "";//新的显示的最后页
		$newStartViewPage = "";//新的显示的开始的页
		$startViewPage 	  = $lastViewPage-$viewPage+1;//原来显示的开始的页
		if($startViewPage<0)$startViewPage=0;		
				
		if($currentPage>$lastViewPage){//查询的页大于显示的最后页,页码数需要往后移
			$newLastViewPage	= $currentPage;
			$newStartViewPage 	= $newLastViewPage-$viewPage+1;	
			if($params !=''){
				$params	= $params."-".$newLastViewPage;
			}else{
				$params	= $newLastViewPage;
			}						
			$center = Pagination::getPageHtml_($newStartViewPage,$newLastViewPage,$currentPage,$control,$action,$params);
		}
		
		if($currentPage<$startViewPage){//查询的页小于显示的开始页,页码数需要往前移
			$newLastViewPage	= $lastViewPage-1;
			$newStartViewPage 	= $newLastViewPage-$viewPage+1;			
			if($params !=''){
				$params	= $params."-".$newLastViewPage;
			}else{
				$params	= $newLastViewPage;
			}	
			$center = Pagination::getPageHtml_($newStartViewPage,$newLastViewPage,$currentPage,$control,$action,$params);			
		}
	
		if(($currentPage>=$startViewPage)&&($currentPage<=$lastViewPage)){//查询的页处于中间，页码不必移动	
			$newLastViewPage 	= $lastViewPage;
			$newStartViewPage 	= $startViewPage;
			if($params !=''){
				$params	= $params."-".$newLastViewPage;
			}else{
				$params	= $newLastViewPage;
			}			
			if($totalPage>$viewPage){		
				$center = Pagination::getPageHtml_($startViewPage,$lastViewPage,$currentPage,$control,$action,$params);
			}else{				
				$center = Pagination::getPageHtml_(1,$totalPage,$currentPage,$control,$action,$params);
			}		
		}	
		
		$pre_page 		= Pagination::tourl($control,$action,$params."-".$prePage);
//		$pre_page_str 	="<span class=\"page_preve \"><a href=\"$pre_page\">上一页</a></span>";
		$pre_page_str 	="<a class=\"page_preve \" href=\"$pre_page\">上一页</a>";		
		$next_page 		= Pagination::tourl($control,$action,$params."-".$nextPage);
//		$next_page_str 	="<span class=\"page_next\"><a href=\"$next_page\">下一页</a></span>";
		$next_page_str 	="<a class=\"page_next\" href=\"$next_page\">下一页</a>";		
			
		return $pre_page_str.$center.$next_page_str;
	}
	
	
	private static function getPageHtml_($start,$end,$current,$control,$action,$params){
		$str = "";
		for($i=$start;$i<=$end;$i++){			
			if($current==$i){				
//				$temp = "<span class=\"pageNo selected\">$i</span>";
				$temp = "<a href='#' title={$i}>$i</a><span>|</span>";		
			}else{	
				$tempparams = 	$params."-".$i;		
				$tempurl=Pagination::tourl($control,$action,$tempparams);		
//				$temp = "<span title={$i} class=\"pageNo \"><a href=\"$tempurl\">$i</a></span>";
				$temp = "<a href=\"$tempurl\" title={$i}>$i</a><span>|</span>";	
			}	
			$str = $str.$temp;	
		}
		return $str;
	}	
	
	static function tourl($control, $action='main', $params=null)
	{
		
		if (is_array($params)) {
			$p = '' . implode('-', $params);
		} else if (is_string($params)) {
			$p = '' . $params;
		} else {
			$p='';
		}
		
		$str	=	DS.$control.DS.$action.DS.$p;
		return $str;
		//return 'index.php?module='.(isset($tmp[0])?$tmp[0]:App::$module).'&control='.$control . '&action=' . $action . $p;
	}
	
}
?>