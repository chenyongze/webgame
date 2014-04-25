<?php /* Smarty version 2.6.14, created on 2011-10-17 13:56:31
         compiled from playgame.tpl */ ?>
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-language" content="zh-CN" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>神雕网络-<?php echo $this->_tpl_vars['login_info']['game_name']; ?>
-<?php echo $this->_tpl_vars['login_info']['server_name']; ?>
</title>
<script src="<?php echo @STATIC_URL; ?>
js/jquery/jquery.js" type="text/javascript"></script>
 
</head>

<body style="margin:0; padding:0px; width:100%; height:100%; position:absolute; "  scroll="no" bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<iframe id="gameif" style="z-index:-9999;" src="<?php echo $this->_tpl_vars['url']; ?>
" width="100%" frameborder="0" marginheight="0" marginwidth="0"  height="100%" scrolling="auto"></iframe>
   
</body>
</html>