<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
<meta http-equiv="content-language" content="zh-CN" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="icon" href="<{$smarty.const.STATIC_URL}>images/favicon.ico" mce_href="<{$smarty.const.STATIC_URL}>images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<{$smarty.const.STATIC_URL}>images/favicon.ico" mce_href="<{$smarty.const.STATIC_URL}>images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico">
<title><{$title}></title>
<{foreach from=$meta key=key item=item}>
<meta content="<{$item}>" name="<{$key}>">
<{/foreach}>
<{foreach from=$css item=val}>
<link media="screen" href="<{$smarty.const.STATIC_URL}>css/<{$val}>.css" type="text/css" rel="stylesheet">
<{/foreach}>
<script type="text/javascript" src="<{$smarty.const.STATIC_URL}>js/jquery/jquery.min.js"></script>
<{foreach from=$js item=val}>
<script type="text/javascript" src="<{$smarty.const.STATIC_URL}>js/<{$val}>.js"></script>
<{/foreach}>
<script type="text/javascript"> 
function addCookie()
{
    if (document.all)
       {
         window.external.addFavorite('http://www.51yx.com','神雕网络');
       }
      else if (window.sidebar)
      {
          window.sidebar.addPanel('神雕网络', 'http://www.51yx.com', "");
    }
}
 
function setHomepage()
{
if (document.all)
    {
        document.body.style.behavior='url(#default#homepage)';
       document.body.setHomePage('http://www.51yx.com');
 
    }
    else if (window.sidebar)
    {
    if(window.netscape)
    {
         try
   { 
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect"); 
         } 
         catch (e) 
         { 
  
         }
    } 
    var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService
 
(Components. interfaces.nsIPrefBranch);
    prefs.setCharPref('browser.startup.homepage','http://www.51yx.com/');
}
}
 
 
</script>
</head>
<body id="bg1">
	<!-- head -->
	<{if !$skip_header}>
		<{include file=$theme_header}>
	<{/if}>
	<!-- head:end -->

	<!-- center -->
	<div id="main">
	<{if !$skip_left}>
		<div class="gy_left">
			<{include file=$theme_left}>
		</div>
	<{/if}>
		<{include file=$theme_content}>
	<{if $skip_links}>
		<!--div class="yl">
			<{include file=$theme_links}>
		</div -->
	<{/if}>
	</div>
	<!-- center：end -->

	<!-- foot -->
	<{if !$skip_footer}>
			<{include file=$theme_footer}>
	<{/if}>
</body>
</html>