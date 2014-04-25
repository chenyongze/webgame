<?php


class pager_pager_driver extends pager {
	function __toString() 
	{
    	$page = array();

        

		$page["begin"] = "<form action=\"\" onsubmit=\"".$this->get_link('this.pageno.value','win')."\">";
        $page["input"] = "输入页数 <input size=\"3\" type=\"text\" size=\"2\" name=\"pageno\" onblur=\"".$this->get_link('this.value','win')."\"/>  ";
        $page["no"] = "第 ".$this->current()." 页, 共 {$this->pageNum} 页 |  ";
        $page["first"] = ($this->pageNum > 1) ? "<a href=\"".$this->get_link(1)."\" target=\"_self\">首页</a>  ":"首页  ";
        $page["pre"] = ($this->current() > 1)?"| <a href=\"" . $this->get_link($this->current() - 1) . "\" target=\"_self\">上一页</a> ":"| 上一页 ";
        $page["next"] = ($this->current() <= $this->pageNum - 1)?"| <a href=\"" . $this->get_link($this->current() + 1) . "\" target=\"_self\">下一页</a> ":"| 下一页 ";
        $page["last"] = ($this->pageNum > 1)?"| <a href=\"".$this->get_link($this->pageNum)."\" target=\"_self\">尾页</a>":"| 尾页";
        $page["end"] = "</form>";

		//构造页码显示
        $string = implode("", $page);

        
        return $string;
	}
}

?>