<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="http://jwfy.51yx.com/20110512/css/style.css" />
    <script type="text/javascript" src="<{$smarty.const.STATIC_URL}>js/jquery/jquery.min.js"></script>
    <script>
    	function login(){
			$('#loginForm').submit();
		}
    </script>
</head>
<body>
    	<div class="fl">
        	<div class="hd_fl">
            	<a href="http://passport.51yx.com/register/newAccountRegister.jsp" title="立即注册">立即注册</a>
            </div>
            <div class="bd_fl">
                <form action="" method="POST">
                <div id="login">
                	<h2>玩家登录</h2>
                    <ul class="bd">
                    	<li id="loginFail"></li>
                    	<li><b>用户名：</b><input type="text" id="user_name" name="user_name"/></li>
                        <li><b>密&nbsp;&nbsp;码：</b><input id="pwd" type="password" name="pwd"/></li>
                        <li class="on">
                        	<a href="#" title="登录" onclick="ajaxLogin()"><img src="images/denglu.jpg" alt="登录" /></a> 
							<a href="http://passport.51yx.com/register/newAccountRegister.jsp" target="_blank" title="注册"><img src="images/zhuce.jpg" alt="l" /></a>
                        </li>
                        <li class="on"><a href="http://passport.51yx.com/member/changePassword.jsp" title="忘记密码"><img src="images/wjmm.jpg" alt="忘记密码" /></a></li>
                        <li class="on"><a href="http://pay.51yx.com/" target="_blank" title="快速充值"><img src="images/kscz.jpg" alt="快速充值" /></a></li>
                    </ul>
                    <div class="ft"></div>
                </div>
                </form>
                <div id="login_2" style="display:none;">
                	<h2>玩家登录</h2>
                    <ul class="bd">
                    	<li class="name"><strong id="u_name"></strong><br />
                               以下为您最近登录过的服务器</li>
                        <!--<li id="server0"></li>
                        <li id="server1"></li>
                        <li id="server2"></li>-->
                        <li class="on">
                        	<a href="http://passport.51yx.com/" class="btn_6">账号管理</a><a href="http://pay.51yx.com/" target="_blank" class="btn_6">快速充值</a><b class="btn_06"></b>
        <a href="http://yy.51yxhost.com/member/logout/?ref=http://jwfy.51yx.com"><input name="" type="button" class="btn_6" value="退出登录"/></a>
                        </li>
                    </ul>
                    <div class="ft"></div>
                </div>
                <!--登录-->
            	<div id="service" class="service">
                	<h2>信服推荐</h2>
                    <ul class="bd">
                    	<li><a href="#123" onclick="alert('稍后开放，敬请期待！')" ><img src="images/img.jpg" alt="" /></a></li>
                        <!--<li>&nbsp;·<a href="#" target="_blank">S17 重剑无锋 双网</a><img src="images/new.jpg" alt="" /></li>
                        <li>&nbsp;</li>
                         <li>&nbsp;</li>
                         <li>&nbsp;</li>
                         <li>&nbsp;</li>
                         <li>&nbsp;</li>
                         <li>&nbsp;</li>
                         <li>&nbsp;</li>-->
                        <li class="on">服务器维护时间：每日凌晨6:00-7:00 </li>
                    </ul>
                    <div class="ft"></div>
                </div>
                <div id="service" class="serviceLogin"style="display:none">
                	<h2>信服推荐</h2>
                    <ul class="bd">
                    	<li><a href="#" target="_blank"><img src="images/img.jpg" alt="" /></a></li>
                        <li>&nbsp;<!--·<a href="#" target="_blank">S17 重剑无锋 双网</a><img src="images/new.jpg" alt="" />--></li>
                        <li>&nbsp;</li>
                         <li>&nbsp;</li>
                         <li>&nbsp;</li>
                         <li>&nbsp;</li>
                         <li>&nbsp;</li>
                         <li>&nbsp;</li>
                         <li>&nbsp;</li>
                        <li class="on">服务器维护时间：每日凌晨6:00-7:00 </li>
                    </ul>
                    <div class="ft"></div>
                </div>
</body>
</html>