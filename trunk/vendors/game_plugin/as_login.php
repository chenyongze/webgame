<?php

class As_login
{
	public function index($login)
	{
		$user		= $_SESSION['user'];
		$accid		= $user['user_id'];
		$accname	= $user['user_code'];
		$server_id	= $login['serverid'];
		$tstamp		= time();
		$fcm		= 1;
		$base_key	= $login['loginkey'];
		$ticket		= strtolower(md5($accid.$accname.$server_id.$tstamp.$fcm.md5($base_key)));
		$loginurl	= str_replace("{n}", $login['serverno'], $login['loginurl']);
		//prestart.action
		$prestart_url = $loginurl."/prestart.action?accid=$accid&tstamp=$tstamp";
		$prestart_return = file_get_contents($prestart_url);
		if ($prestart_return == "rec_succ") {
			//start.action
			$start_url = $loginurl."/start.action?accid=$accid&accname=$accname&serverid=$server_id&tstamp=$tstamp&ticket=$ticket&fcm=$fcm";

			if (! $login['is_frame']) {
				header("Location:".$start_url);
			} else {
				$html = '<html><head><meta http-equiv="content-language" content="zh-CN" /><meta http-equiv="content-type" content="text/html; charset=UTF-8" /><title>我顶-'.$login['gname'].'-'.$login['sname'].'</title></head><body style="margin:0; padding:0px; width:100%; height:100%;"><iframe marginwidth="0" style="z-index:1;" marginheight="0" src="'.$start_url.'" width="100%" frameborder="0" marginheight="0" marginwidth="0"  height="100%" scrolling="auto"></iframe><!-- 在线客服代码开始--><div style="display:none"><a href="http://www.looyu.com">在线客服</a><a href="http://www.looyu.com">乐语</a></div><script type="text/javascript" src="http://j.looyu.com/j.jsp?c=32875&f=77840"></script><!-- 在线客服代码结束--></body></html>';
				echo $html;
			}
		}elseif ($prestart_return == "rec_fail"){
			exit("prestart.action:服务器拒绝接受该请求");
		}else {
			exit("参数错误");
		}
	}
}