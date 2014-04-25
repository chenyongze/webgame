function checkUserExist(){
	var passportName = $("#user_name").val();

	if(passportName == "") {
		$("#username").html("游戏帐号不能为空").removeClass('grey').addClass('red1');
		$("#user_name").css('background-color', '#FFCCCC');		
		return false;
	}
	var PNstate = regexPassportName(passportName);	//判断是否合法 ？  提交 / 返回	//帐号名
	if(PNstate == -1){
		$("#username").html("游戏帐号不能以“SD”开头").removeClass('grey').addClass('red1');
		$("#user_name").css('background-color', '#FFCCCC');	
		return false;
	}
	if(PNstate == -2){
		$("#username").html("游戏帐号不能以“SD”开头").removeClass('grey').addClass('red1');
		$("#user_name").css('background-color', '#FFCCCC');
		return false;
	}
	if(PNstate == -4){
		$("#username").html("游戏帐号必须以字母开头").removeClass('grey').addClass('red1');
		$("#user_name").css('background-color', '#FFCCCC');	
		return false;
	}
	if(PNstate == -5){
		$("#username").html("游戏帐号由6-16位小写英文字母、数字以及下划线_组成,首位为字母").removeClass('grey').addClass('red1');
		$("#user_name").css('background-color', '#FFCCCC');	
		return false;
	}
	if(PNstate == -6){
		$("#username").html("游戏帐号至少6个字符").removeClass('grey').addClass('red1');
		$("#user_name").css('background-color', '#FFCCCC');	
		return false;
	}
	if(PNstate == -7){
		$("#username").html("游戏帐号不能多于16个字符").removeClass('grey').addClass('red1');
		$("#user_name").css('background-color', '#FFCCCC');	
		return false;
	}
	var judge;
	$.ajax({
	   type: "GET",
	   url: "/member/userExist/",
	   data: 'jsoncallback=?&userName='+passportName,
	   async: false,
	   dataType:"jsonp",
	   success: function(rs){
		//	var errors={'0':'账号可以注册','-100':'非法调用中间件或传入的参数不符合规则','992':"对不起，暂时不能提供注册服务。",'-200':'系统错误','-1407':'帐号已存在','-999':'账号不能以LK,SD开头','-998':'两次输入的密码不一致!','-997':'密码中不能有汉字和空格,必须包含字母数字!','-996':'玩家名称长度不合法 目前限制为最多4个汉字!','-994':'邮件地址不合法!','-995':'验证码错误!','-995':'验证码错误!','-993':'用户名格式不正确！'};
			if(parseInt(rs.result)==0){
				$("#username").html("账号可以使用").removeClass('red1').addClass('green');
				$("#user_name").css('background-color', '#fff');
				judge = true;
			}else{
				$("#username").html("帐号已存在").removeClass('grey').addClass('red1');
				$("#user_name").css('background-color', '#FFCCCC');	
				judge = false;
			}
	   }
	 });
	return judge;
}
function checkPwd(pwd)
{
	if (pwd.match(/^[A-Za-z0-9]{6,12}$/g) == null)
	{
		$("#pwdTip").html("由6-12位英文字母及数字组成").removeClass('grey').addClass('red1');
		$("#user_password").css('background-color', '#FFCCCC');		
		return false;
	}
	else
	{
		$("#pwdTip").html("填写正确").removeClass('red1').addClass('green');
		$("#user_password").css('background-color', '#fff');
		return true;
	}
}
function checkPwdRepeat(pwd)
{
	if( pwd == '' )
	{
		$("#pwdTip2").html("密码不能为空").removeClass('grey').addClass('red1');
		$("#user_password2").css('background-color', '#FFCCCC');
		return false;				
	}
	else if ( pwd !== $("#user_password").val() )
	{
		$("#pwdTip2").html("您输入的密码不一致").removeClass('grey').addClass('red1');
		$("#user_password2").css('background-color', '#FFCCCC');		
		return false;
	}	
	else
	{
		$("#pwdTip2").html("填写正确").removeClass('red1').addClass('green');
		$("#user_password2").css('background-color', '#fff');
		return true;		
	}
}
function checkInfoEmail(email)
{
	if( email.match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/) )
	{
		$("#emailTip").html("填写正确").removeClass('red1').addClass('green');
		$("#email").css('background-color', '#fff');
		return true;
	}
	else if ( email == '' )
	{
		$("#emailTip").html("邮箱不能为空").removeClass('grey').addClass('red1');
		$("#email").css('background-color', '#FFCCCC');
		return false;	
	}
	else
	{
		$("#emailTip").html("请输正确的邮箱格式").removeClass('grey').addClass('red1');
		$("#email").css('background-color', '#FFCCCC');
		return false;
	}
}
function checkValid(valid){
	if(valid == ''){
		$("#validTip").html("验证码不能为空").removeClass('grey').addClass('red1');
		$("#valid").css('background-color', '#FFCCCC');
		return false;	
	}
	var judge = false;
	$.ajax({
		   type: "GET",
		   url: "/ajax/checkValid/",
		   data: 'jsoncallback=?&valid='+valid,
		   async: false,
		   dataType:"jsonp",
		   success: function(rs){
//				alert(rs.result);
				if(!rs.result){
					$("#validTip").html("验证码输入有误").removeClass('grey').addClass('red1');
					$("#valid").css('background-color', '#FFCCCC');
					$("#valid_src").attr("src","http://yy.51yx.com/member/validn/?f="+Math.random());
					judge = false;
				}else{
					$("#validTip").html("").removeClass('red1').addClass('grey');
					$("#valid").css('background-color', '#fff');
					judge = true;
				}
		   }
		 });
	return judge;
}
function checkId(sId){
var aCity={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江 ",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北 ",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏 ",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外 "}
var iSum=0
var info=""
if(!/^\d{17}(\d|x)$/i.test(sId))return "身份证位数不正确";
sId=sId.replace(/x$/i,"a");
if(aCity[parseInt(sId.substr(0,2))]==null)return "Error:非法地区";
sBirthday=sId.substr(6,4)+"-"+Number(sId.substr(10,2))+"-"+Number(sId.substr(12,2));
var d=new Date(sBirthday.replace(/-/g,"/"))
if(sBirthday!=(d.getFullYear()+"-"+ (d.getMonth()+1) + "-" + d.getDate()))return "Error:非法生日";
for(var i = 17;i>=0;i --) iSum += (Math.pow(2,i) % 11) * parseInt(sId.charAt(17 - i),11)
if(iSum%11!=1)return "Error:非法证号";
return sId;
}
function getInfo(id){
    id=checkId(id)
    var fid=id.substring(0,16),lid=id.substring(17);
    if (isNaN(fid)|| ( isNaN(lid) && (lid!="a") )) return "请输入真实的身份证号";
    return true;
}
function checkid(){
	var id = $("#identity").val();
	var res = getInfo(id);
	if (res != true) {
		$("#idtip").html("请正确填写身份证号").removeClass('grey').addClass('red1');
		$("#identity").css('background-color', '#FFCCCC');
		return false;
	} else {
		$("#idtip").html("填写正确").removeClass('red1').addClass('green');
		$("#identity").css('background-color', '#fff');
		return true;
	}
}
function checkTrueNames(nameString)
{
    if (nameString.length <= 0) {
        $("#truenameTip").html("请填写真实姓名").removeClass('grey').addClass('red1');
        $("#truename").css('background-color', '#FFCCCC');
        return false;
    }
    if(nameString.match(/^[\u4e00-\u9fa5]*$/) != null) {
        $("#truenameTip").html("填写正确").removeClass('red1').addClass('green');
        return true;
    }
    $("#truenameTip").html("请输入全中文姓名").removeClass('grey').addClass('red1');
    	return false;
}
function submitForm(){
	// 注册协议同意检查
	if ($("#chkAgreement").attr("checked") != true) {
		alert('请同意服务条款');
		return false;
	}
	var pwd 		= $('#user_password').val();
	var pwdre 		= $('#user_password2').val();
	var email 		= $('#email').val();
	var valid 		= $('#valid').val();
	var nameString	= $('#truename').val();

	if(checkUserExist()&& checkPwd(pwd)&& checkPwdRepeat(pwdre)&&checkInfoEmail(email)&&checkTrueNames(nameString)&&checkid()&&checkValid(valid)){
		$('#submitForm').submit();
	}
}
//判断用户名是否合法
function regexPassportName(passportName) {

	if(passportName == ""){
		//document.getElementById('dd1')html = "<font color=red>游戏帐号不能为空</font>";
		return false;
	 }

	var pn = passportName.toLowerCase();
	var regex = /^sd/;
	if(regex.test(pn)) {
		//document.getElementById('dd1')html = "<font color=red>游戏帐号不能以“SD”开头</font>";
		return -1;
	}
	
	var regex = /^[a-z]/;
	if(!regex.test(pn)) {
		//document.getElementById('dd1')html = "<font color=red>游戏帐号必须以字母或数字开头</font>";
		return -4;
	}
	var regex = /^[a-z0-9_]*$/;
	if(!regex.test(passportName)) {
		//document.getElementById('dd1')html = "<font color=red>您的游戏帐号含非法字符</font>";
		return -5;
	}
	if(passportName.length < 6){
		//document.getElementById('dd1')html = "<font color=red>游戏帐号至少6个字符!</font>";
		return -6;
	}
	if(passportName.length > 16){
		//document.getElementById('dd1')html = "<font color=red>游戏帐号不能多于16个字符!</font>";
		return -7;
	}

	//getthis('/reg.php','nameback','name','passportName');
	return PNstate = 1;		
	
}

