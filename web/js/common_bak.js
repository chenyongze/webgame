// JavaScript Document
var site_url = "http://"+location.host+"/";

var w3c=(document.getElementById)? true: false;
var agt=navigator.userAgent.toLowerCase();
var ie = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1) && (agt.indexOf("omniweb") == -1));

function IeTrueBody(){
    return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body;
}

function GetScrollTop(){
    return ie ? IeTrueBody().scrollTop : window.pageYOffset;
}

//随机title
var WD_DocumentTitles = new Array
	(
		'要知道你用食指指着别人大骂时，手中另外三个指头是指向自己',
		'友谊可以筑起一道坚实的防线',
		'在命运的颠沛中，最可以看出人们的气节',
		'自己活着，就是为了使别人活得更美好',
		'百学须先立志',
		'察己则可以知人,察今则可以知古',
		'出师未捷身先死,长使英雄泪沾襟',
		'大丈夫宁可玉碎,不能瓦全',
		'人间没有永恒的夜晚，世界没有永恒的冬天',
		'君子喻于义 , 小人喻于利',
		'君子坦荡荡，小人长戚戚',
		'人生只有必然，没有偶然',
		'当断不断,反受其乱',
		'工欲善其事,必先利其器',
		'古之成大事者,不惟有超士之才,亦有坚忍不拔之志',
		'君子成人之美,不成人之恶',
		'莫愁前路无知己,天下谁人不识君',
		'锲而不舍,金石可镂',
		'三军可夺帅也,匹夫不可夺志也',
		'生当作人杰,死亦为鬼雄',
		'士为知己者死',
		'星星之火,可以燎原',
		'有志者,事竟成',
		'曾经沧海难为水,除却巫山不是云',
		'沧海横流，方显英雄本色',
		'你必须相信自己，这是成功的关键',
		'积极思考造成积极人生，消极思考造成消极',
		'人生只有一事算得是成功的─能够依照你自己',
		'不入虎穴，焉得虎子',
		'使人站起来的不是双脚，而是理想、智慧、意志和创造力。',
		'如果是支真正的宝剑，迟早都会显示出锋芒',
		'宁愿壮丽而生，不愿肮脏而死',
		'在人生的征途上，每一个行进的足印都伴着一个梦',
		'人长着大脑为的是思索人生；人长着双手为的是创造未来',
		'友谊是没有羽翼的爱',
		'并非地球引力使人坠入爱河',
		'一个能思想的人，才真是一个力量无边的人',
		'雄心出胆略，恒心出意志，信心出勇气，决心出力量',
		'不是烦恼太多，而是心胸不够开阔',
		'天赋之手若不举起勤奋的利斧，也劈不开成功的道路',
		'不要把希望寄托在漂泊不定的“也许”上'
	);
var WD_DocumentTitleIndex = Math.floor(Math.random() * WD_DocumentTitles.length);
document.title += ' | ' + WD_DocumentTitles[WD_DocumentTitleIndex];

function addHome()
{
	if (window.sidebar)
	{
		try {
			netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
		}
		catch (e)
		{
			alert("此操作被浏览器拒绝！请在浏览器地址栏输入“about:config”并回车，然后将 [signed.applets.codebase_principal_support]设置为true");
		}
		var prefs = Components.classes["@mozilla.org/preferences-service;1"].getService( Components.interfaces.nsIPrefBranch );
		prefs.setCharPref("browser.startup.homepage","http://yy.51yx.com/");
	}
	else if(document.all)
	{
		document.body.style.behavior="url(#default#homepage)";
		document.body.setHomePage("http://www.5ding.com/");
	}
}

function checkGameList()
{
	$("#header_gamelist").css('display', 'block');
}

function noneGameList()
{
	$("#header_gamelist").css('display', 'none');
}

$(document).ready(function(){
	$("#header_gamelist").click(function(){
		$("#header_gamelist").css('display', 'none');
	});
});


$(document).ready(function() {
	if( $("#login_alert").val() == 1 &&$("#cookie_login_alert").val() != 1 )
	{
		var static_url = "http://tstatic.5ding.com/";
		tipsWindown("提示信息","text:<dl><dd class='psw_wrong'> 您当前的账号安全级别教低！</dd><dd class='normal'> 为了提高您的账号安全性，您可以：</dd><dd class='psw_log_li'><div class='index_tk'><div class='box0'><div class='ico0 shuxian0'><img src='"+ static_url +"images/safe_img/info_bg1.gif' width='84' height='52' /></div><div class='title0'><a href='#'>填写密保资料</a></div></div><div class='box0 shuxian0'><div class='ico0'><img src='"+ static_url +"images/safe_img/info_bg2.gif' width='81' height='52' /></div><div class='title0'><a href='#'>申请邮箱认证</a></div></div><div class='box0'><div class='ico0'><img src='"+ static_url +"images/safe_img/info_bg3.gif' width='81' height='52' /></div><div class='title0'><a href='#'>申请手机认证</a></div></div></div></dd><dd class='note'><form method='POST' action='' id='formrr'><label><input type='checkbox' value='1' name='cookie_login_alert' id='cookie_login_alert' onclick=\"x(this.value)\" />下次不再提示</label><span class='long'><a href='#' class='common_colse'>以后再说</a></span></form></dd></dl>", "361", "200", "true", "", "true", "text");
	}
});

function x(code)
{
	var address = site_url + "index/ajax_login_alert/";
	$.post(address,{'name' : code});
	$("#windownbg").remove();
	$("#windown-box").fadeOut("slow",function(){$(this).remove();});	
}