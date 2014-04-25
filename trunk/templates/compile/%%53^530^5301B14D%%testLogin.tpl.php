<?php /* Smarty version 2.6.14, created on 2011-11-21 12:59:28
         compiled from testLogin.tpl */ ?>
    <link type="text/css" rel="stylesheet" href="http://jwfy.51yx.com/20110512/css/style.css" />
<style>
	#main {margin:200px auto;width: 306px;}
	#bg1 {background:url('') no-repeat left bottom }
</style>
    <script type="text/javascript" src="<?php echo @STATIC_URL; ?>
js/jquery/jquery.min.js"></script>
    
    <script>
	    $(document).ready(function() { 
	    	$('#pwd').keydown(function(event){ 
				if(event.keyCode==13){
					login();
					}
			})
	    }); 
    	function login(){
			$('#loginForm').submit();
		}
		function getServ(){
			var game_id = $('#game option:selected').val();
			if(game_id == 0 ){
				$("#serv").empty();
				$("#serv").append('<option>-------</option>');
				return false;
			}
			$.ajax({
				   type: "GET",
				   url: "/ajax/getServ/",
				   data: 'game_id='+game_id,
				   dataType:"json",
				   success: function(rs){
						$("#serv").empty();
						for(i=0; i<rs.length; i++){
							var str = "<option value="+rs[i].server_id+">"+rs[i].server_name+"</option>"
							$("#serv").append(str);
					   }
				   }
				 });
		}
		function play(){
			var game_id = $('#game option:selected').val();
			var serv_id = $('#serv option:selected').val();
			var url = "http://yy.51yx.com/playgame/index/"+game_id+"/"+serv_id;
			window.location.href = url;
		}
    </script>
<?php if ($_SESSION['wg_sess_user'] == ''): ?>
    	<div class="fl" >
            <div class="bd_fl">
                <form id="loginForm" action="/member/test" method="POST">
                <div id="login" style="margin:50px auto ;">
                	<h2>玩家登录</h2>
                    <ul class="bd">
                    	<li id="loginFail"></li>
                    	<li><b>用户名：</b><input type="text" id="user_name" name="user_name"/></li>
                        <li><b>密&nbsp;&nbsp;码：</b><input id="pwd" type="password" name="password"/></li>
                        <li class="on">
                        	<a href="#" title="登录" onclick="login()">登录</a>
                        </li>
                    </ul>
                    <div class="ft"></div>
                </div>
                </form>
                </div>
                </div>
<?php else: ?>
	<div class="fl" >
            <div class="bd_fl">
                <form id="loginForm" action="/member/test" method="POST">
                <div id="login" style="margin:50px auto ;width: 263px;" >
                	<h2>玩家登录</h2>
                    <ul class="bd">
                    	<li id="loginFail"></li>
                    	<li><b>游&nbsp;&nbsp;戏：</b>
	                    	<select id="game" onchange="getServ()">
	                    		<option value="0">----请选择游戏----</option>
	                    		<option value="16">----神魔杀-------</option>
	                    		<option value="17">----封神世界----</option>
	                    	</select>
                    	 </li>
                        <li><b>服务器：</b>
	                        <select id="serv">
		                    		<option>-------</option>
		                    </select></li>
                        <li class="on">
                        	<a href="#" title="登录" onclick="play()">登录</a>
                        	<a href="/member/logout/" title="退出" >退出</a>
                        </li>
                    </ul>
                    <div class="ft"></div>
                </div>
                </form>
                </div>
                </div>
<?php endif; ?>