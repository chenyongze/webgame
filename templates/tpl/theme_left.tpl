<{if $smarty.session.wg_sess_user eq '' }>
	<script language="javascript">
	function checkForm(){
		if($.trim($('#user_name').val())==''){
//			alert('请填写用户名');
				dialog("用户名", "id:dialogPassportLogin", "270px", "auto", "id");
			$('#user_name').focus();
			return false;
		}
		if($.trim($('#password').val())==''){
			dialog("用户名", "id:dialogPassportLogin", "270px", "auto", "id");
			$('#password').focus();
			return false;
		}
		return true;
	}
	</script>
      <div class="gy_dl">
            <div class="gy_dl_in">
            <form action="/member/login/" onsubmit="return checkForm();" method="POST">
              <div class="dl_title">用户登录</div>
               <table width="222" border="0" cellspacing="0" cellpadding="0">
                   <tr>
                     <td width="154" height="31" colspan="2" valign="top"><input name="user_name" id="user_name" type="text" class="gy_btn1" value="游戏帐号" onfocus="if(this.value=='游戏帐号')this.value='';" /></td>
                     <td width="68" rowspan="2" align="center" valign="top"><input name="input" type="submit" class="aniu" value=" "/></td>
                   </tr>
                   <tr>
                     <td height="30" colspan="2" valign="top">
<!--                     <input name="password" id="password_tx" type="text" class="gy_btn1" value="请输入密码" />-->
                     <input name="password" id="password" type="password" class="gy_btn1" /></td> 
                   </tr>
<!--                   <tr>-->
<!--                     <td width="80" height="24"><input name="" type="text" class="gy_btn2" value="请输入验证码" /></td>-->
<!--                     <td width="65"><img src="<{$STATIC_URL}>images/yzm.jpg" width="55" height="24" /></td>-->
<!--                     <td class="blue"><a href="#">换一个</a></td>-->
<!--                   </tr>-->
                  </table>
            <script type="text/javascript">
			var tx = document.getElementById("password_tx");
			var pwd = document.getElementById("password");
			tx.onfocus = function(){
				if(this.value != "请输入密码") return;
				this.style.display = "none";
				pwd.style.display = "";
				pwd.value = "";
				pwd.focus();
			}
			pwd.onblur = function(){
				if(this.value != "") return;
				this.style.display = "none";
				tx.style.display = "";
				tx.value = "请输入密码";
			}
		</script>
                 <div class="dl_other"><span class="gy_zt">记住我的登录状态</span><input name="loginsave" type="checkbox" value="1" class="dl_oth" /></div>
                 </form>
           </div>
           <div class="gy_zc"><p>没有神雕账号？<a href="/member/register/" target="_blank">&nbsp;立即注册</a></p></div>
       </div>
<{else}>
	  <div class="gy_dl1">
          <div class="gy_dl_later">
               <div class="new_dl">
                    <div class="yh_name">
                          <div class="yg_name_tp"><img src="<{$smarty.const.STATIC_URL}>images/touxiang.jpg" width="95" height="91" /></div>
                          <div class="yg_name_nr">
                            <p class="yg_1">尊敬的：用户名称</p>
                            <p class="yg_2">欢迎您登录51游戏平台</p>
                            <p class="yg_3">最近玩的游戏</p>
                            <p class="yg_4"><a href="http://fs.51yx.com/" target="_blank">幻想封神</a></p>
                          </div>
                      </div>
                      <div class="dl_wl">
                      	<a href="http://passport.6msj.com/index.jsp" target="_blank"></a>
                      	<a href="/member/logout/"></a></div>
                      <div class="webgame">上次登陆时间：2010-12-01 11:12:52</div>
                 </div>
            </div>
       </div>
          
<{/if}> 
       
          <div class="gy_lj">
               <ul>
                   <li><a href="http://passport.6msj.com/index.jsp" target="_blank">账号中心</a></li>
                   <li><a href="http://pay.51yx.com/" target="_blank">在线充值</a></li>
                   <li><a href="http://passport.51yx.com/member/changePassword.jsp" target="_blank">修改密码</a></li>
                   <li><a href="http://passport.51yx.com/" target="_blank">找回密码</a></li>
               </ul>
          </div>
          <div class="gy_game">
               <div class="gy_game_z"><img src="<{$STATIC_URL}>images/hot.jpg" width="110" height="140" /></div>
               <div class="gy_game_y">
                    <p class="hot1">本周人气游戏</p>
                    <p class="name">独孤九剑</p>
                    <p class="pingce">玩家评测 <span class="jibie"></span></p>
                    <p class="pc_nr">斯顿飞神雕客服哈斯顿飞神雕客服哈斯顿宋德福和未成年人家</p>
                    <p><a href="#" target="_blank"><img src="<{$STATIC_URL}>images/star.jpg" width="68" height="23" /></a></p>
               </div>
       </div>
          <div class="gy_kefu"></div>
          <div class="gy_pro">
               <div class="pro_top"></div>
               <div class="pro_m">
                    <ul class="often">
                        <li><a href="#">1.布鲁斯·威利斯最新喜剧动作片，4折！</a></li>
                        <li><a href="#">2.布鲁斯·威利斯最新喜剧动作片，4折！</a></li>
                        <li><a href="#">3.布鲁斯·威利斯最新喜剧动作片，4折！</a></li>
                        <li><a href="#">4.布鲁斯·威利斯最新喜剧动作片，4折！</a></li>
                        <li><a href="#">5.布鲁斯·威利斯最新喜剧动作片，4折！</a></li>
                    </ul>
               </div>
               <div class="pro_b"></div>
          </div>
            <!--登陆弹窗 密码错误       -->
