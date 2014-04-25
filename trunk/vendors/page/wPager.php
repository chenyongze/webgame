<?php

class wPager
{
    private $total =  0;
    private $page = null;
    private $per_page = 1;
    private $pages = 1;
    private $link = '';

    private function getDefaultPage($page = null)
    {
        if ($page === null) {
            $page = intval(@$_GET['page_no']);
            $page < 1 && $page = 1;
        }

        return $page;
    }

    function __construct($per_page)
    {
        $this->per_page = $per_page;
    }

    public function getLimit($page = null)
    {
        $this->page = $page;

        if ($this->page === null) {
        	
            $page = $this->getDefaultPage($page);
            return 'LIMIT '.($page - 1) * $this->per_page.', '.($this->per_page + 1);
        }

        return 'LIMIT '.($this->page - 1) * $this->per_page.', '.$this->per_page;
    }

    public function generate(&$total, &$page = null, $link = '')
    {
        $page = $this->getDefaultPage($page);

        $this->link = $link;
        if (empty($this->link) && !empty($_SERVER['REQUEST_URI']))
        {// 自动处理分页链接
            $uri = preg_replace('/?page_no=\d+/i', '', $_SERVER['REQUEST_URI']);
            $this->link = $uri . '&#63;page_no=[#]';
        }

        if (is_array($total))
        {
            $this->total = count($total);
            if ($this->total > $this->per_page)
            {
                array_pop($total);
                $this->pages = $page + 1;
            }
            else
            {
                $this->pages = $page;
            }
        }
        else
        {
            $this->total = $total;
            $this->pages = ceil($this->total / $this->per_page);
            $this->pages < 1 && $this->pages = 1;
        }

        $page > $this->pages && $page = $this->pages;
        $this->page = $page;

        return $this->pages > 1;
    }

    public function getPagesArray($num = null)
    {
        if ($num === null) {
            return range(1, $this->pages);
        }
        $per = floor($num / 2);
        $min = $this->page - $per;

        if ($num % 2) {
            $max = $this->page + ceil($num / 2) - 1;
        } else {
            $max = $this->page + $per - 1;
        }

        if ($max > $this->pages) {
            $min -= $max - $this->pages;
            $max = $this->pages;
        } elseif ($min < 1) {
            $max += 1 - $min;
            $min = 1;
        }

        $max > $this->pages && $max = $this->pages;
        $min < 1 && $min = 1;

        return range($min, $max);
    }

    public function link($page)
    {
        return str_replace("[#]", $page, $this->link);
    }

    public function next()
    {
        return ($this->page + 1) > $this->pages ? $this->pages : ($this->page + 1);
    }

    public function prev()
    {
        return ($this->page - 1) > 0 ? ($this->page - 1) : 1;
    }

    public function begin()
    {
        return 1;
    }

    public function end()
    {
        return $this->pages;
    }

    public function getPage()
    {
        return $this->page;
    }


    public function getPages()
    {
        return $this->pages;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getPerPage()
    {
        return $this->per_page;
    }
}
?>