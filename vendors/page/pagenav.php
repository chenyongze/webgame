<?php
class PageNav
{
    /**#@+
     * @access    private
     */
    var $total;
    var $perpage;
    var $current;
    var $url;
    /**#@-*/

    /**
     * Constructor
     *
     * @param   int     $total_items    Total number of items
     * @param   int     $items_perpage  Number of items per page
     * @param   int     $current_start  First item on the current page
     * @param   string  $start_name     Name for "start" or "offset"
     * @param   string  $extra_arg      Additional arguments to pass in the URL
     **/
    function PageNav($total_items, $items_perpage, $current_start, $url, $extra_arg=null)
    {
        $this->total = intval($total_items);
        $this->perpage = intval($items_perpage);
        $this->current = intval($current_start);
        $this->extra = $extra_arg;
        if ( $extra_arg != '' && ( substr($extra_arg, -5) != '&amp;' || substr($extra_arg, -1) != '&' ) ) {
            $this->extra = '&amp;' . $extra_arg;
        }
        //$this->url = $_SERVER['PHP_SELF'].'?'.trim($start_name).'=';
        $this->url = $url.'/';
    }

    /**
     * Create text navigation
     *
     * @param   integer $offset
     * @return  string
     **/
    function renderNav($offset = 4)
    {
        $ret = '';
        if ( $this->total <= $this->perpage ) {
            return $ret;
        }
        $total_pages = ceil($this->total / $this->perpage);
        if ( $total_pages > 1 ) {
            $ret .= '<div id="paging">';
            $prev = $this->current - $this->perpage;
            if ( $prev >= 0 ) {
                $ret .= '<a class="page_preve" href="'.$this->url.$prev.$this->extra.'">上一页</a> ';
            }
            $counter = 1;
            $current_page = intval(floor(($this->current + $this->perpage) / $this->perpage));
            while ( $counter <= $total_pages ) {
                if ( $counter == $current_page ) {
                    $ret .= '<a href="javascript:void(0);" class="checkedPage">'.$counter.'</a><span>|</span>';
                } elseif ( ($counter > $current_page-$offset && $counter < $current_page + $offset ) || $counter == 1 || $counter == $total_pages ) {
                    if ( $counter == $total_pages && $current_page < $total_pages - $offset ) {
                        $ret .= '... ';
                    }
                    $ret .= '<a class="" href="'.$this->url.(($counter - 1) * $this->perpage).$this->extra.'">'.$counter.'</a><span>|</span>';
                    if ( $counter == 1 && $current_page > 1 + $offset ) {
                        $ret .= '... ';
                    }
                }
                $counter++;
            }
            $next = $this->current + $this->perpage;
            if ( $this->total > $next ) {
                $ret .= '<a class="page_next" href="'.$this->url.$next.$this->extra.'">下一页</a> ';
            }
            $ret .= '</div> ';
        }
        return $ret;
    }

    /**
     * Create a navigational dropdown list
     *
     * @param   boolean     $showbutton Show the "Go" button?
     * @return  string
     **/
    function renderSelect($showbutton = false)
    {
        if ( $this->total < $this->perpage ) {
            return;
        }
        $total_pages = ceil($this->total / $this->perpage);
        $ret = '';
        if ( $total_pages > 1 ) {
            $ret = '<form name="pagenavform">';
            $ret .= '<select name="pagenavselect" onchange="location=this.options[this.options.selectedIndex].value;">';
            $counter = 1;
            $current_page = intval(floor(($this->current + $this->perpage) / $this->perpage));
            while ( $counter <= $total_pages ) {
                if ( $counter == $current_page ) {
                    $ret .= '<option value="'.$this->url.(($counter - 1) * $this->perpage).$this->extra.'" selected="selected">'.$counter.'</option>';
                } else {
                    $ret .= '<option value="'.$this->url.(($counter - 1) * $this->perpage).$this->extra.'">'.$counter.'</option>';
                }
                $counter++;
            }
            $ret .= '</select>';
            if ($showbutton) {
                $ret .= '&nbsp;<input type="submit" value="'._GO.'" />';
            }
            $ret .= '</form>';
        }
        return $ret;
    }
}

?>