<?php


class pager_ggwhm_driver extends pager {
	public $action;
	public $is_ajax=1;
	function __toString() 
	{
        $page = array();
		$page['begin'] = "<div id='turn-page'>";
		$page['count'] = "{$GLOBALS['_LANG']['total_records']}<span id='totalRecords'> {$this->total} </span>";
		$page['total'] = "{$GLOBALS['_LANG']['total_pages']}<span id='totalPages'> {$this->pageNum} </span>";
		$page['current'] = "{$GLOBALS['_LANG']['page_current']}<span id='pageCurrent'> " . $this->current() . " </span>";
		$page['size'] = "{$GLOBALS['_LANG']['page_size']} <input type='text' size='3' id='size' value='{$this->size}' onkeypress='return listTable.changePageSize(event)' />";
        $page['no'] = "<span id='page-link'>";
        $page['first'] = " <a href='javascript:listTable.gotoPageFirst()'>{$GLOBALS['_LANG']['page_first']}</a>";
        $page['pre'] = " <a href='javascript:listTable.gotoPagePrev()'>{$GLOBALS['_LANG']['page_prev']}</a>";
        $page['next'] = " <a href='javascript:listTable.gotoPageNext()'>{$GLOBALS['_LANG']['page_next']}</a>";
        $page['last'] = " <a href='javascript:listTable.gotoPageLast()'>{$GLOBALS['_LANG']['page_last']}</a>";
		$page['select'] = " <select id='gotoPage' onchange='listTable.gotoPage(this.value)'>{%create_pages count=$page_count page=$filter.page%}</select>";
        $page['end'] = "</span></div>";

		//构造页码显示
        $string = implode("", $page);

        return $string;
	}
}

?>