//member注册页
function checkName(code)
{	
	if(code.match(/^[A-Za-z0-9_]{3,15}$/g) == null)
	{
		$("#user_code_notice").html("<div class='note_error'>4-16位,必须是数字和字母组合!<span class='error_top'></span><span class='error_bot'></span><span class='error_arrow'></span></div>");
		$("#user_code").css('background-color', '#FFCCCC');			
		return false;	
	}
	var address = site_url + "member/ajax_register/";
	$.post(address,{'name' : code},function(data) 
	{
		switch(data)
		{
			case '1':
					$("#user_code_notice").html("<div class='note_error'>用户名已存在<span class='error_top'></span><span class='error_bot'></span><span class='error_arrow'></span></div>");
					$("#user_code").css('background-color', '#FFFFFF');	
			break;
			case '2':
					$("#user_code_notice").html("<div class='note_error'>用户名不能被注册<span class='error_top'></span><span class='error_bot'></span><span class='error_arrow'></span></div>");
					$("#user_code").css('background-color', '#FFFFFF');	
			break;				
			default:
			    	$("#user_code_notice").html("<div class='note_ok' id='code'></div>");
					$("#user_code").css('background-color', '#FFFFFF');	
			break;
		}
	});
	return true;
}

function checkPwd(pwd)
{
	if (pwd.match(/^[A-Za-z0-9_]{6,16}$/g) == null)
	{
		$("#user_password_notice").html("<div class='note_error'>6-16位,只允许数字、字母、下划线<span class='error_top'></span><span class='error_bot'></span><span class='error_arrow'></span></div>");
		$("#user_password").css('background-color', '#FFCCCC');		
		return false;
	}
	else
	{
		$("#user_password_notice").html("<div class='note_ok' id='code'></div>");
		$("#user_password").css('background-color', '#FFFFFF');	
		return true;
	}
}

function checkPwdRepeat(pwd)
{
	if( pwd == '' )
	{
		$("#user_password2_notice").html("<div class='note_error'>您输入的密码不能为空<span class='error_top'></span><span class='error_bot'></span><span class='error_arrow'></span></div>");
		$("#user_password2").css('background-color', '#FFCCCC');
		return false;				
	}
	else if ( pwd !== $("#user_password").val() )
	{
		$("#user_password2_notice").html("<div class='note_error'>您输入的密码不一致<span class='error_top'></span><span class='error_bot'></span><span class='error_arrow'></span></div>");
		$("#user_password2").css('background-color', '#FFCCCC');		
		return false;
	}	
	else
	{
		$("#user_password2_notice").html("<div class='note_ok' id='code'></div>");
		$("#user_password2").css('background-color', '#FFFFFF');	
		return true;		
	}
}

function checkValidn(validn)
{
	if ($("#validn").val().match('^\\d{4}$') == null)
	{
		$("#validn").css('background-color', '#FFCCCC');
		return false;
	}
	else
	{
		$("#validn").css('background-color', '#FFFFFF');		
		$("#validn_notice").html("");
		return true;			
	}
}

function focusIpt(obj)
{
	$(obj).css('background-color', '#fffde7');
	$(obj).css('border-color', '#999999');
}

$(document).ready(function(){
	$("#refurbish").click(function(){
		$("#valid_src").attr("src", site_url+'index/validn/index/'+Math.random());
	});	
});

function checkaccept()
{
	if($(":checkbox:checked").val()!=1)
	{
		tipsWindown("提示","text:<dd class='psw_wrong'>请同意服务条款</dd> <dd class='psw_log_li'><input type='button' id='button_close' value='确 认' class='inp_little common_colse' /></dd>", "361", "150", "true", "", "true", "text");
		return false;
	}
	if( !checkName( $("#user_code").val() ) || !checkPwd( $("#user_password").val() ) || !checkPwdRepeat( $("#user_password2").val() ) || !checkValidn( $("validn").val() ) ) 
	{	
			var msg_form = '<div>以下原因导致提交失败：</div>';
			if( !checkName( $("#user_code").val() ) )            msg_form += '<div>用户名不合法</div>';
			if( !checkPwd( $("#user_password").val() ) )         msg_form += '<div>密码不合法</div>';
			if( !checkPwdRepeat( $("#user_password2").val() ) )  msg_form += '<div>两次输入的密码不一致</div>';
			if( !checkValidn( $("validn").val() ) )              msg_form += '<div>请输入正确的验证码</div>';	
			
			tipsWindown("提示","text:<dd class='psw_wrong_common'>" + msg_form + "</dd> <dd class='psw_log_li'><input type='button' id='button_close' value='确 认' class='inp_little common_colse' /></dd>", "361", "150", "true", "", "true", "text");
		return false;
	}
	return true;
}

//找回密码

function getSelect()
{
	$(".get_select").css('display','block');
}
function getSelect2()
{
	$(".get_select2").css('display','block');
}

$(document).ready(function(){
	$(".get_select a").each(function(){
		$(this).click(function(){
			$(".user_question").val($(this).text());
			$(".get_select").css('display','none');
		});
	});
	$(".get_select2 a").each(function(){
		$(this).click(function(){
			$(".user_question2").val($(this).text());
			$(".get_select2").css('display','none');
		});
	});	
	if( $("#ans_err").val() == 1 )
	{
		alertTip('很遗憾，您的资料输入有误！');
	}
});

//getpassMail

$(document).ready(function(){
	if( $("#mail_err").val() == 1 )
	{
		alertTip('验证码不正确！');
	}
	if ( $("#mail_err").val() == 2 )
	{
		var m_email = $("#m_email").val();
		tipsWindown("请查收密码邮件","text:<dd class='psw_succ_mobil'><div>已经向您的认证邮箱发送密码邮件<span>请登录邮箱查收</span></div><p>邮箱帐号："+ m_email +"</p><p>如果您在一分钟内没有收到邮件，请点击</p><p class='user_back_btn'><input type='button' class='common_colse' value='重 发' /></p><p>或者联系客服， 获得帮助</p></dd>", "361", "180", "true", "", "true", "text");
	}
	if( $("#mail_err").val() == 3 )
	{
		alertTip('此账号没有认证邮箱！');
	}
	if( $("#mail_err").val() == 4 )
	{
		alertTip('账号不存在！');
	}
	if( $("#mail_err").val() == 5 )
	{
		alertTip('请输入您的通行证！');
	}
	if( $("#mail_err").val() == 6 )
	{
		alertTip('提交频繁！');
	}						
});

//getpassCus

$(document).ready(function(){
	if( $("#cus_err").val() == 1 )
	{
		alertTip('留言标题不能为空');
	}
	if( $("#cus_err").val() == 2 )
	{
		alertTip('留言内容不能为空');
	}
	if( $("#cus_err").val() == 3 )
	{
		alertTip('提交太频繁了。');
	}
	if( $("#cus_err").val() == 4 )
	{
		tipsWindown("提示","text:<dd class='psw_succ_service'><div>谢谢，我们已经成功收到您的找回密码请求</div><p>我们的客服人员会尽快通过您留下的联系方式与您取得联系。</p><p>如果您还有其他问题，请拨打我们的客服电话<b>400-800-345</b></p></dd>", "361", "150", "true", "", "true", "text");
	}				
});

//helpMessage

$(document).ready(function(){
	if( $("#help_cus_err").val() == 1 )
	{
		alertTip('留言标题不能为空');
	}
	if( $("#help_cus_err").val() == 2 )
	{
		alertTip('留言内容不能为空');
	}
	if( $("#help_cus_err").val() == 3 )
	{
		alertTip('提交太频繁了。');
	}
	if( $("#help_cus_err").val() == 4 )
	{
		tipsWindown("提示","text:<dd class='psw_succ_service'><div>我们已经成功收到您的反馈信息</div><p>感谢您给我们提出建议！您留下的每个字都将被用来改善我们的服务。</p></dd>", "361", "150", "true", "", "true", "text");
	}				
});

//getpassTel


$(document).ready(function(){
	if( $("#tel_err").val() == 1 )   //为空
	{
		alertTip('请输入您的通行证');
	}
	if( $("#tel_err").val() == 2 )   //不存在
	{
		alertTip('账号不存在');
	}
	if( $("#tel_err").val() == 3 )   //没做认证
	{
		alertTip('账号没做手机认证');
	}	
	if( $("#tel_err").val() == 4 )   //频繁
	{
		alertTip('提交太频繁了。');
	}
	if( $("#tel_err").val() == 6 )   //验证码不正确
	{
		alertTip('验证码不正确');
	}	
	if( $("#tel_err").val() == 5 )   //成功
	{
		var t_mobile = $("#tel_email").val();
		tipsWindown("请查收密码邮件","text:<dd class='psw_succ_mobil'><div>已经向您的手机发送密码短信<span>请查收短信</span></div><p>手机账号："+ t_mobile +"</p><p>如果您没有收到短信，请点击</p><p class='user_back_btn'><input type='button' class='common_colse' value='重 发' /></p><p>或者联系客服， 获得帮助</p></dd>", "361", "180", "true", "", "true", "text");
	}				
});

//账号安全
//ucenter.info
function checkInfoRealname(rname)
{
	if( rname.match(/^[\u4e00-\u9fa5]{2,5}$/) )
	{
		$("#info_realname_notice").html("<div class='note_ok'></div>");
		return false;
	}
	else
	{
		$("#info_realname_notice").html("<div class='note_error'>请输入您的真实姓名<span class='error_arrow1'></span></div>");
		return false;
	}
}

function checkInfoIdentity(iden)
{
	if( iden.length = 15 && iden.match(/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/) )
	{
		$("#info_identity_notice").html("<div class='note_ok'></div>");
		return true;
	}
	else if ( iden.length = 18 && iden.match(/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/) )
	{
		$("#info_identity_notice").html("<div class='note_ok'></div>");
		return true;
	}
	else
	{
		$("#info_identity_notice").html("<div class='note_error'>请输入真实的身份证号<span class='error_arrow1'></span></div>");
		return false;
	}
}

function checkInfomobile(mobile)
{
	if( mobile.match(/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/) )
	{
		$("#info_mobile_notice").html("<div class='note_ok'></div>");
		return true;
	}
	else
	{
		$("#info_mobile_notice").html("<div class='note_error'>请输正确的手机号码<span class='error_arrow1'></span></div>");
		return false;
	}
}

function checkInfoEmail(email)
{
	if( email.match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/) )
	{
		$("#info_email_notice").html("<div class='note_ok'></div>");
		return true;
	}
	else
	{
		$("#info_email_notice").html("<div class='note_error'>请输正确的邮箱格式<span class='error_arrow1'></span></div>");
		return false;
	}
}

//ucenter.getpwd
function checkGetPwd(pwd)
{
	if( pwd.match(/^[\da-zA-Z]{6,16}$/) )
	{
		$("#newpwd_notice").html("密码由6-16位数字和字母组成");
		if( pwd.match(/^[\da-zA-Z]*(\d+[a-zA-Z]+|[a-zA-Z]+\d+)[\da-zA-Z]*$/) )
		{
			$("#getpwd_notice").html("<img src='"+ site_url +"images/safe_img/hig.gif' width='161' height='17' /><p>密码强度：高</p>");
		}
		else
		{
			$("#getpwd_notice").html("<img src='"+ site_url +"images/safe_img/low.gif' width='161' height='17' /><p>密码强度：低</p>");
		}
	}
	else
	{
		$("#newpwd_notice").html("<font color='red'>密码由6-16位数字和字母组成</font>");
	}
}

function checkGetPwd2(pwd)
{
	if( pwd == $("#newpwd").val() )
	{
		$("#newpwd2_notice").html("");
	}
	else
	{
		$("#newpwd2_notice").html("<font color='red'>两次密码输入不一致</font>");
	}
}


$(document).ready(function(){
	//密码认证 ucenter.info
	if( $("#u_info_msg").val() == 1 )
	{
		alertTip('所填内容不能为空');
	}
	if( $("#u_info_msg").val() == 2 )
	{
		alertTip('每次提交时间不得少于３０秒');
	}
	
	//手机认证 ucenter.mobile
	if( $("#u_mobile_msg").val() == 1 )   
	{
		$("#u_mobile_err").css("display","block");
		$("#u_mobile_err").html("此手机已被认证，请不要重复认证");
	}
	if( $("#u_mobile_msg").val() == 2 )   
	{
		$("#u_mobile_err").css("display","block");
		$("#u_mobile_err").html("每次提交时间不得少于３０秒");
	}
	if( $("#u_mobile_msg").val() == 3 )   
	{
		$("#u_mobile_err").css("display","block");
		$("#u_mobile_err").html("您提交的手机格式不正确，请重新输入！");
	}
	if( $("#u_mobile_msg").val() == 4 )   
	{
		$("#u_mobile_err").css("display","block");
		$("#u_mobile_err").html("每个手机24小时内最多只允许成功申请3次短信验证码");
	}	
	//邮箱认证
	if( $("#u_email_msg").val() == 1 )   
	{
		$("#u_email_err").css("display","block");
		$("#u_email_err").html("此邮箱已被认证，请不要重复认证");
	}
	if( $("#u_email_msg").val() == 2 )   
	{
		$("#u_email_err").css("display","block");
		$("#u_email_err").html("每次提交时间不得少于３０秒");
	}
	if( $("#u_email_msg").val() == 3 )   
	{
		$("#u_email_err").css("display","block");
		$("#u_email_err").html("您输入的邮箱格式有误");
	}
	//修改密码 ucenter.getpwd
	if( $("#u_getpwd_msg").val() == 1 )   
	{
		alertTip('密码修改成功');
	}		
	if( $("#u_getpwd_msg").val() == 2 )   
	{
		$("#u_oldpass").html("<font color='red'>密码输入错误</font>");
	}
	if( $("#u_getpwd_msg").val() == 4 )   
	{
		alertTip('密码输入不能为空');
	}
	if( $("#u_getpwd_msg").val() == 3 )   
	{
		alertTip('两次密码输入不一致');
	}			
});

function alertTip(msg)
{
	tipsWindown("提示","text:<dd class='psw_wrong_common'>"+ msg +"</dd> <dd class='psw_log_li'><input type='button' id='button_close' value='确 认' class='inp_little common_colse' /></dd>", "361", "150", "true", "", "true", "text");
}