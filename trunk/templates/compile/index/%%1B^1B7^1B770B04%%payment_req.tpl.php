<?php /* Smarty version 2.6.14, created on 2010-12-06 15:47:41
         compiled from payment_req.tpl */ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=gb2312">
<title>To YeePay Page</title>
</head>
<body onload="document.yeepay.submit();">
<form name='yeepay' action='<?php echo $this->_tpl_vars['reqURL_onLine']; ?>
' method='post'>
<input type='hidden' name='p0_Cmd'					value='<?php echo $this->_tpl_vars['p0_Cmd']; ?>
'>
<input type='hidden' name='p1_MerId'				value='<?php echo $this->_tpl_vars['p1_MerId']; ?>
'>
<input type='hidden' name='p2_Order'				value='<?php echo $this->_tpl_vars['p2_Order']; ?>
'>
<input type='hidden' name='p3_Amt'					value='<?php echo $this->_tpl_vars['p3_Amt']; ?>
'>
<input type='hidden' name='p4_Cur'					value='<?php echo $this->_tpl_vars['p4_Cur']; ?>
'>
<input type='hidden' name='p5_Pid'					value='<?php echo $this->_tpl_vars['p5_Pid']; ?>
'>
<input type='hidden' name='p6_Pcat'					value='<?php echo $this->_tpl_vars['p6_Pcat']; ?>
'>
<input type='hidden' name='p7_Pdesc'				value='<?php echo $this->_tpl_vars['p7_Pdesc']; ?>
'>
<input type='hidden' name='p8_Url'					value='<?php echo $this->_tpl_vars['p8_Url']; ?>
'>
<input type='hidden' name='p9_SAF'					value='<?php echo $this->_tpl_vars['p9_SAF']; ?>
'>
<input type='hidden' name='pa_MP'						value='<?php echo $this->_tpl_vars['pa_MP']; ?>
'>
<input type='hidden' name='pd_FrpId'				value='<?php echo $this->_tpl_vars['pd_FrpId']; ?>
'>
<input type='hidden' name='pr_NeedResponse'	value='<?php echo $this->_tpl_vars['pr_NeedResponse']; ?>
'>
<input type='hidden' name='hmac'						value='<?php echo $this->_tpl_vars['hmac']; ?>
'>
</form>
</body>
</html>