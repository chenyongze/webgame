<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>神雕网络_让梦想在游戏里飞翔_北京神雕展翅科技有限公司</title>

<style type="text/css">

body { font-size:12px; margin:0; padding:0; height:100%;}

#main { border:1px #8FC8F5 solid; background:#F2F9FF; width:270px; margin:0 auto;}
#main h2 { font-size:14px; padding-left:10px; padding-top:10px;}
#main #form { width:200px; margin:0 auto; padding-bottom:10px;}
#main #form ul { list-style:none; padding:0; margin:0;}
#main #form li { line-height:25px; height:25px; margin:5px 0px;}
.tx { text-align:center; margin-top:15px;}
.btn { width:80px; height:30px; text-align:center;}
.inputxt { border:1px #868686 solid; font-weight:bold; width:150px; height:20px;}
.tarea { border:1px #868686 solid; width:475px; height:420px;}

#layout { border:1px #8FC8F5 solid; background:#F2F9FF; width:550px; height:490px; padding:10px; margin:0 auto;}

</style>
<script type="text/javascript" src="<{$smarty.const.STATIC_URL}>js/jquery/jquery.min.js"></script>
</head>

<body>

<div id="main">
	<h2>请登录！</h2>
	<div id="form">
    	<ul>
        	<li>账号：<input type="text" name="user_name" id="user_name" class="inputxt" maxlength="20" /></li>
    		<li>密码：<input type="password" name="password" id="password" class="inputxt" maxlength="20" /></li>
        </ul>
        <div class="tx"><input type="button" value="登 录" class="btn" id="sub_btn" /></div>
    </div>
</div>

<div id="layout" style="display:none;">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    	<tr><td width="13%" height="30">文件名称：</td><td width="87%"><input type="text" name="fname" id="fname" class="inputxt" /> *例如：login.js</td></tr>
        <tr><td valign="top">文件内容：</td><td><textarea name="content" id="content" class="tarea"></textarea></td></tr>
        <tr><td colspan="2" height="30" valign="middle" align="right"><input type="button" value="提交生成" id="create_btn" /></td></tr>
    </table>
</div>

<script type="text/javascript">

var playgame = {
	check: function(){
		var user_name = $("#user_name").val();
		var password  = $("#password").val();
		
		if(user_name == ""){
			alert("神雕账号不能为空");return false;
		}
		if(password == ""){
			alert("神雕账号的密码不能为空");return false;
		}
		$.ajax({
			async: false,
			type: "GET",
			url: "/member/ajaxLogin/?do_md5=1&jsoncallback=?",
			data: {"user_name": user_name, "password": password, "isSave": 0, "retype": 0, "game_id": ""},
			dataType: "json",
			success: function(json){
				if(json.msg == "loginSucceed"){
					$("#main").hide();
					var lay_height = $("#layout").height();
					$("#layout").show().css("margin-top", (win_height-lay_height)/2);
					$("#create_btn").bind("click", function(){
						playgame.create();
					});
				}
			}
		});
	},
	create: function(){
		var fname = $("#fname").val();
		var content = $("#content").val();
		
		if(fname == ""){
			alert("文件名称不能为空");return false;
		}
		if(password == ""){
			alert("文件内容不能为空");return false;
		}
		$.ajax({
			async: false,
			type: "GET",
			url: "/gameinfo/createJS/?jsoncallback=?",
			data: {"fname": fname, "content": encodeURI(content)},
			dataType: "json",
			success: function(json){
				if(json.status == "succ"){
					alert("恭喜您，文件内容生成成功！");
				}
			}
		});
	}
};

$("#sub_btn").bind("click", function(){
	playgame.check();
});

var win_height = $(window).height();
var main_height = $("#main").height();
$("#main").css("margin-top", (win_height-main_height)/2+"px");

</script>

</body>
</html>
