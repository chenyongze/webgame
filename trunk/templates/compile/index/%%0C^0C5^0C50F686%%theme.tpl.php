<?php /* Smarty version 2.6.14, created on 2010-12-06 15:04:14
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
js/jquery/jquery.js"></script>
<?php $_from = $this->_tpl_vars['js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['val']):
?>
<script type="text/javascript" src="<?php echo @STATIC_URL; ?>
js/<?php echo $this->_tpl_vars['val']; ?>
.js"></script>
<?php endforeach; endif; unset($_from); ?>
</head>
<body>
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
	<div class="wd_center" id="wd_center">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['theme_content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<!-- center：end -->

	<!-- foot -->
	<?php if (! $this->_tpl_vars['skip_footer']): ?>
		<div id="wd_foot">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['theme_footer'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	<?php endif; ?>
	<!-- foot：end -->
<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-16754316-1']);
	_gaq.push(['_setDomainName', '.5ding.com']);
	_gaq.push(['_trackPageview']);
	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();

	var isClientCheck = '<?php echo $_GET['isclient']; ?>
';
</script>
<script src='http://w.cnzz.com/c.php?id=30035188' language='JavaScript' charset='gb2312'></script>
<?php if (! $this->_tpl_vars['skip_jiathis']): ?>
<script type="text/javascript" src=" http://www.jiathis.com/code/jiathis_r.js?move=0&btn=r5.gif" charset="utf-8"></script>
<script type="text/javascript">
$(function(){
	$("#ckepop").live('mouseover', function(){
		$(".ckepopBottom").css("display",'none');
		$(".centerBottom").css("display",'none');
		$("#ckepop").css("zIndex", "99999");
	});
});
</script>
<?php endif; ?>
</body>
</html>