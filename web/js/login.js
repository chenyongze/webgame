/**
 * 51yx login
 * options中包括以下参数。
 * *******************************************************
 * id: 页面中所需要验证的元素。验证提示请在表单属性上加入error
 * keydownObj: 绑定回车事件的元素ID
 * submitBtn: 绑定点击事件的元素ID
 * *******************************************************
 * $.login_init(options); //主登录功能函数
 * $.login(options); //验证登录函数
 * $.checklogin(); //检验用户是否登录(页面载入即执行)
 * $.showAuth(); //载入验证码
 */
 
(function($){
	var request_url = "http://yy.51yx.com";
	var login_succ = function(data){
		$("#login_pre").hide();
		$("#login_succ").show();
		
		$("#login_uname").html(data.account);
		
		if(data.game == null || data.ser == null){
			$("#login_playgame").html("无");
		}else{
			$("#login_playgame").html("《" + data.game + "》" + "【" + data.ser + "】").attr("href", request_url + "/playgame/index/"+ data.result.game_id +"/"+ data.result.server_id);
		}
		$("#login_time").html(data.result.play_time);
		$("#login_logout").attr("href", request_url + "/member/logout/?ref=" + window.location.href);
	}
	
	$.login_init = function(options){
		$("#"+ options.keydownObj).keydown(function(event){ 
			if(event.keyCode == 13){
				$.login(options);
			}
		});
		$("#"+ options.submitBtn).click(function(){
			$.login(options);
		});
	}
	
	$.login = function(options){
		if(!options) return false;
		
		for(var i = 0; i < options.id.length; i++){
			if($("#"+ options.id[i]).val() == ""){
				message.show(options.id[i], $("#"+ options.id[i]).attr("error"));						
				return false;
			}
		}
		var isSave = $("input[name=isSave]:checked").val();
		if(isSave == undefined) isSave = 0;
		$.ajax({
			type: "GET",
			url: request_url + "/member/ajaxLogin/?retype=1&do_md5=1&jsoncallback=?",
			data: {user_name: $("#user_name").val(), password: $("#password").val(), valid: $("#valid").val(), isSave: isSave},
			dataType: "json",
			success: function(data){
				if(data.msg == "loginFail" && data.result == "e1"){
					alert("提示：您输入的验证码有误！");
				}else if(data.msg == "loginFail" && data.result == undefined){
					alert('提示：您的用户名或密码错误！');
					$("#valid").val("");
				}else{
					login_succ(data); //登录成功
				}
			}
		});
	}
	
	$.checklogin = (function(){
		$.ajax({
			type: "GET",
			url: request_url + "/member/ajaxCheckLogin/?jsoncallback=?",
			dataType: "json",
			success: function(data){
				if(data.msg == "loginSucceed"){
					login_succ(data);
				}
			}
		});
	})()
	
	$.showAuth = function(){
		$('#authimg').attr("src", request_url + "/member/validn/?t=" + Math.random());
	}
	
	var message = {
		show: function(id, msg){
			var obj_offset = $("#"+ id).offset();
			var width = $("#"+ id).width() > 160 ? $("#"+ id).width() : 160;
			var len = width-5+"px";
			if($("#show_error").length == 0){
				$("body").append("<div id='show_error' style='position:absolute;height:20px;padding:3px 5px;border:1px #FDB261 solid;background:#FFF9F3;color:#B34043;width:"+ len +"'></div>");
			}
			$("#show_error").html(msg).css({left: obj_offset.left+"px", top: obj_offset.top+29+"px"}).show().fadeOut(3000);
		}
	};
})(jQuery);
