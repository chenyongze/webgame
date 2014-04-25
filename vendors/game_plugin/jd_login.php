<?php
/**
 * 绝地战争 游戏登录配置
 *
 */
class Jd_login extends main
{
	public function index($login)
	{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	    header("Cache-Control: no-cache, must-revalidate");
	    header("Pragma: no-cache");

		$user		= $_SESSION['user'];
		$accid		= $user['user_id'];
		$accname	= $user['user_code'];
		$server_id	= $login['serverid'];
		$base_key = 'GxdQkSKIX0ye3L8cdl47';

		//------验证密钥加密代码 start--------
		$time = (String) time() . "000";
		$loginurl	= str_replace("{n}", $login['serverno'], $login['loginurl']);

		if($login['serverno'] == 999){
//			echo "<pre>";
//			echo "session_id: ",session_id(),"<br/>";
//			print_r($_SESSION);
//			print_r($login);
			if ( ! in_array( strtolower($accname), explode( "\r\n", file_get_contents(DATA_PATH.'no_open_users') ) ) ) {
//				echo DATA_PATH.'no_open_users';
				$this->report('该服务器不存在');
				die;
			}
		//	测试登陆key
		//	LoginKey=123456789asdfghjklmn
			$base_key = '123456789asdfghjklmn';
			$loginurl = "http://122.224.103.244";
		}

		$str = $accid . "&" . $time . "&";
		$vertifyString = strtoupper(md5($str . $base_key));
		$encodeStr = base64_encode($str . $vertifyString);
		//------end--------



		$game_url = rtrim($loginurl,"/")."/?".$encodeStr;
//		echo $game_url;die;
		if (! $login['is_frame']) {
			header("Location:".$game_url);
		} else {
			$html = '<html><head><meta http-equiv="content-language" content="zh-CN" /><meta http-equiv="content-type" content="text/html; charset=UTF-8" /><title>我顶-'.$login['gname'].'-'.$login['sname'].'</title></head><body style="margin:0; padding:0px; width:100%; height:100%;"><iframe marginwidth="0" style="z-index:1;" marginheight="0" src="'.$game_url.'" width="100%" frameborder="0" marginheight="0" marginwidth="0"  height="100%" scrolling="auto"></iframe><!-- 在线客服代码开始--><div style="display:none"><a href="http://www.looyu.com">在线客服</a><a href="http://www.looyu.com">乐语</a></div><script type="text/javascript" src="http://j.looyu.com/j.jsp?c=32875&f=77840"></script><!-- 在线客服代码结束--></body></html>';
			echo $html;
		}
	}
}