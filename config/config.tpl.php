<?PHP //-*-coding: utf-8;-*-
/* 模板的相对路径 */
define('TPL_TEMPLATE', ROOT_PATH.'templates'.DS.'tpl'.DS);

/* 编译的相对路径 */
define('TPL_COMPILE', ROOT_PATH.'templates'.DS.'compile'.DS);

/* 缓冲的相对路径 */
define('TPL_CACHE', ROOT_PATH.'templates'.DS.'cache'.DS);

/* 是否打开缓冲 */
define('TPL_CACHING',false);
/* 缓存时间 */
define('TPL_CACHE_LIFETIME',3600);

/* 编译的时候 Check 否 */
define('TPL_COMPILE_CHECK',true);

/* 模板开始的左标记 */
define('TPL_LEFT_DELIMITER','<{');

/* 模板开始的右标记 */
define('TPL_RIGHT_DELIMITER','}>');

function insert_scripts($args)
{
	static $scripts = array();

	$arr = explode(',', str_replace(' ', '', $args['files']));

	$str = '';
	foreach ($arr AS $val)
	{
		if (in_array($val, $scripts) == false)
		{
			$scripts[] = $val;
			if ($val{0} == '.')
			{
				$str .= '<script type="text/javascript" src="' . $val . '"></script>';
			}
			else
			{
				$str .= '<script type="text/javascript" src="js/' . $val . '"></script>';
			}
		}
	}

	return $str;
}
?>