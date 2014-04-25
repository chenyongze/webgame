<?php /* Smarty version 2.6.14, created on 2011-11-17 15:26:44
         compiled from theme.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
<meta http-equiv="content-language" content="zh-CN" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link rel="icon" href="<?php echo @STATIC_URL; ?>
images/favicon.ico" mce_href="<?php echo @STATIC_URL; ?>
images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo @STATIC_URL; ?>
images/favicon.ico" mce_href="<?php echo @STATIC_URL; ?>
images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico">
<title><?php echo $this->_tpl_vars['title']; ?>
</title>
<?php $_from = $this->_tpl_vars['meta']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<meta content="<?php echo $this->_tpl_vars['item']; ?>
" name="<?php echo $this->_tpl_vars['key']; ?>
">
<?php endforeach; endif; unset($_from);  $_from = $this->_tpl_vars['css']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['val']):
?>
<link media="screen" href="<?php echo @STATIC_URL; ?>
css/<?php echo $this->_tpl_vars['val']; ?>
.css" type="text/css" rel="stylesheet">
<?php endforeach; endif; unset($_from); ?>
<script type="text/javascript" src="<?php echo @STATIC_URL; ?>
js/jquery/jquery.min.js"></script>
<?php $_from = $this->_tpl_vars['js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['val']):
?>
<script type="text/javascript" src="<?php echo @STATIC_URL; ?>
js/<?php echo $this->_tpl_vars['val']; ?>
.js"></script>
<?php endforeach; endif; unset($_from); ?>
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
	<?php if (! $this->_tpl_vars['skip_header']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['theme_header'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<!-- head:end -->

	<!-- center -->
	<div id="main">
	<?php if (! $this->_tpl_vars['skip_left']): ?>
		<div class="gy_left">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['theme_left'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	<?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['theme_content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if ($this->_tpl_vars['skip_links']): ?>
		<!--div class="yl">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['theme_links'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div -->
	<?php endif; ?>
	</div>
	<!-- center：end -->

	<!-- foot -->
	<?php if (! $this->_tpl_vars['skip_footer']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['theme_footer'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</body>
</html>