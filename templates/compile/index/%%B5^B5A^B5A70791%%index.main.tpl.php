<?php /* Smarty version 2.6.14, created on 2010-12-06 15:04:14
         compiled from index.main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'index.main.tpl', 118, false),)), $this); ?>
<style type="text/css">
#wd_center{background-image:url(<?php echo $this->_tpl_vars['index_background_img']['article_image1']; ?>
);}
</style>
<div id="index_ad">
<a href="<?php echo $this->_tpl_vars['index_right_top_ad']['article_url']; ?>
" target="_blank"><img src="<?php echo $this->_tpl_vars['index_right_top_ad']['article_image1']; ?>
" /></a>
</div>
<div id="main">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'left_login.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div id="container">
		<div class="flashBox" id="flashBox">
			<ul class="flash_list" id="flash_list">
				<?php $_from = $this->_tpl_vars['index_flash_big']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['bigFlash']):
?>
					<li>
						<a target="_blank" href="<?php echo $this->_tpl_vars['bigFlash']['article_url']; ?>
">
							<img src="<?php echo $this->_tpl_vars['bigFlash']['article_image1']; ?>
" />
						</a>
					</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
			<div class="flash_shadow">
			</div>
			<div class="flash_shadow_l">
			</div>
			<div class="flash_shadow_r">
			</div>
			<ul class="flash_smallimg" id="flash_smallimg">
				<?php $_from = $this->_tpl_vars['index_flash_big']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['bigFlashName'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bigFlashName']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['bigFlash1']):
        $this->_foreach['bigFlashName']['iteration']++;
?>
					<li id="p<?php echo $this->_foreach['bigFlashName']['iteration']; ?>
" name="<?php echo $this->_foreach['bigFlashName']['iteration']; ?>
" <?php if ($this->_foreach['bigFlashName']['iteration'] == 1): ?> class="current"<?php endif; ?>>
						<span name="<?php echo $this->_tpl_vars['bigFlash1']['article_image2']; ?>
" style="background:url('<?php echo $this->_tpl_vars['bigFlash1']['article_image2']; ?>
') no-repeat scroll left top;">
							<?php echo $this->_tpl_vars['bigFlash1']['article_shorttitle']; ?>

						</span>
					</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
			<ul class="flash_smallimg_bg" id="flash_smallimg_bg">
				<?php $_from = $this->_tpl_vars['index_flash_big']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['bigFlashName'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bigFlashName']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['bigFlash']):
        $this->_foreach['bigFlashName']['iteration']++;
?>
					<li id="s<?php echo $this->_foreach['bigFlashName']['iteration']; ?>
">
						<span name="<?php echo $this->_tpl_vars['bigFlash']['article_image2']; ?>
" style="background:url('<?php echo $this->_tpl_vars['bigFlash']['article_image2']; ?>
') no-repeat scroll left top;">
							<?php echo $this->_tpl_vars['bigFlash']['article_shorttitle']; ?>

						</span>
					</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
		<div id="soonRelease">
			<div class="releaseLeft">
			</div>
			<ul class="releaseContent">
				<?php $_from = $this->_tpl_vars['article_index_newgame']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<li><a href="<?php echo $this->_tpl_vars['item']['article_url']; ?>
" target="_blank" title="<?php echo $this->_tpl_vars['item']['article_title']; ?>
"><?php echo $this->_tpl_vars['item']['article_shorttitle']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
			<div class="releaseRight">
			</div>
			<div class="clear">
			</div>
		</div>
		<div id="gameList">
			<div class="gameGuanzhu">
                    <span>今日关注</span>
                    <ul class="gameGuanzhuMsg">
						<?php $_from = $this->_tpl_vars['article_index_guanzhu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
							<li><a href="<?php echo $this->_tpl_vars['item']['article_url']; ?>
" target="_blank" title="<?php echo $this->_tpl_vars['item']['article_title']; ?>
">· <?php echo $this->_tpl_vars['item']['article_shorttitle']; ?>
</a></li>
						<?php endforeach; endif; unset($_from); ?>
                    </ul>
                </div>
			<div class="gameListBox">
				<div class="gameItem_l">
					大型游戏
				</div>
				<ul class="gameItem_r">
					<?php $_from = $this->_tpl_vars['webgame_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['webgame']):
?>
						<li><a href="<?php echo $this->_tpl_vars['webgame']['article_url']; ?>
" target="_blank"<?php if ($this->_tpl_vars['webgame']['article_keywords'] == 'hot'): ?> class="ff6600"<?php endif; ?>><?php echo $this->_tpl_vars['webgame']['article_title'];  if ($this->_tpl_vars['webgame']['article_id'] == 491): ?><img src="<?php echo @STATIC_URL; ?>
images/index/index_main_new.gif"><?php endif; ?></a></li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
				<div class="clear">
				</div>
			</div>
			<div class="gameListBox">
				<div class="gameItem_l">
					娱乐平台
				</div>
				<ul class="gameItem_r">
					<?php $_from = $this->_tpl_vars['ente_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ente']):
?>
						<li><a href="<?php echo $this->_tpl_vars['ente']['article_url']; ?>
" target="_blank"<?php if ($this->_tpl_vars['ente']['article_keywords'] == 'hot'): ?> class="ff6600"<?php endif; ?>><?php echo $this->_tpl_vars['ente']['article_title']; ?>
</a></li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
				<div class="clear">
				</div>
			</div>
			<div class="gameListBox">
				<div class="gameItem_l">
					休闲游戏
				</div>
				<ul class="gameItem_r">
					<?php $_from = $this->_tpl_vars['rela_game_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rela']):
?>
						<li><a href="<?php echo $this->_tpl_vars['rela']['article_url']; ?>
" target="_blank"<?php if ($this->_tpl_vars['rela']['article_keywords'] == 'hot'): ?> class="ff6600"<?php endif; ?>><?php echo $this->_tpl_vars['rela']['article_title']; ?>
</a></li>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
				<div class="clear">
				</div>
			</div>
		</div>
		<div id="huodong">
			<div class="huodongTitle">
				<span>最新动态</span>
				<div id="serInfoTurn" style="margin-left:15px;"></div>
				<a href="<?php echo @SITE_URL; ?>
article/listing/4">更多&gt;&gt;</a>
				<div class="clear">
				</div>
			</div>
			<ul>
				<?php $_from = $this->_tpl_vars['article_indexnews']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['indexnews_name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['indexnews_name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['indexnews_name']['iteration']++;
?>
					<li <?php if ($this->_foreach['indexnews_name']['iteration'] % 2 == 0): ?> class="ml60"<?php endif; ?>>
						<span class="newsTitle">
							<a href="<?php echo $this->_tpl_vars['item']['article_url']; ?>
" target="_blank" title="<?php echo $this->_tpl_vars['item']['article_title']; ?>
">· <?php echo $this->_tpl_vars['item']['article_shorttitle']; ?>
</a>
						</span>
						<span class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['article_updatetime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y.%m.%d") : smarty_modifier_date_format($_tmp, "%Y.%m.%d")); ?>
</span>
						<br class="clear" />
					</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
	</div>
	<div class="clear">
	</div>
</div>

   <div class="friendLink">
        <span>友情链接</span><div class="linkBox">
	<?php $_from = $this->_tpl_vars['link_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vo']):
?>
            <a href="<?php echo $this->_tpl_vars['vo']['url']; ?>
" target="_blank"><?php echo $this->_tpl_vars['vo']['name']; ?>
</a>
	<?php endforeach; endif; unset($_from); ?>
	    <a href="http://wo.5ding.com/" target="_blank">喔喔社区</a>
	    <a href="http://juese.5ding.com/" target="_blank">角色</a>
	    <a href="http://k.5ding.com" target="_blank">快玩</a>
        </div>
        <a href="http://www.5ding.com/aboutus/link" class="more" target="_blank">更多&gt;&gt;</a>
        <div class="clear">
        </div>
    </div>

	<script type="text/javascript">
		var serverInfoIndex = 0;
		var serverInfoArr = new Array();
		<?php $_from = $this->_tpl_vars['serInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['serKey'] => $this->_tpl_vars['serItem']):
?>
			serverInfoArr[<?php echo $this->_tpl_vars['serKey']; ?>
] = "<?php echo $this->_tpl_vars['serItem']; ?>
";
		<?php endforeach; endif; unset($_from); ?>
		$(function(){
			serverInfoFunc();
			setInterval(serverInfoFunc, 6000);
		});
		function serverInfoFunc()
		{
			if (serverInfoArr[serverInfoIndex] != '') {
				$("#serInfoTurn").html(serverInfoArr[serverInfoIndex]);
				$("#serInfoTurn").fadeIn('fast');
				if (serverInfoIndex == 49) {
					serverInfoIndex = 0;
				} else {
					serverInfoIndex++;
				}
				setTimeout("$('#serInfoTurn').fadeOut('fast')", 5000);
			}
		}
	</script>