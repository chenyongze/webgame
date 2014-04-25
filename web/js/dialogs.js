

var dialogFirst = true;
function dialog(title, content, width, height, dragCssName) {

    if (dialogFirst == true) {
        var temp_float = new String;
//        temp_float = "<div id=\"floatBoxBg\" style=\"height: " + $(document).height() + "px; filter:alpha(opacity=50); opacity:0.5;\"></div>";
        temp_float += "<div id=\"floatBox\" class=\"floatBox\">";
        temp_float += "</div>";
        $("body").append(temp_float);
        dialogFirst = false;
    }
    contentType = content.substring(0, content.indexOf(":"));
    content = content.substring(content.indexOf(":") + 1, content.length);
    switch (contentType) {
        case "url":
            var content_array = content.split("?");
            $("#floatBox").ajaxStart(function () {
                $(this).html("loading...");
            });
            $.ajax({
                type: content_array[0],
                url: content_array[1],
                data: content_array[2],
                error: function () {
                    $("#floatBox").html("error...");
                },
                success: function (html) {
                    $("#floatBox").html(html);
                }
            });
            break;
        case "text":
            $("#floatBox").html(content);
            break;
        case "id":
            $("#floatBox").html($("#" + content + "").html());
            break;
        case "iframe":
            $("#floatBox").html("<iframe src=\"" + content + "\" width=\"100%\" height=\"" + (parseInt(height) - 30) + "px" + "\" scrolling=\"auto\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\"></iframe>");
			break;
		default :
			break;
    }
    $("#floatBoxBg").show();
    //$("#floatBox").attr("class", "floatBox " + cssName);
    var _top = (PageHeight() - parseInt((height == "auto" ? $("#floatBox").height() : parseInt(height)))) / 2;
    $("#floatBox").css({ display: "block", left: (($(document).width()) / 2 - (parseInt(width) / 2)) + "px", top: $(document).scrollTop() + (_top <= 0 ? 2 : _top) + "px", width: parseInt(width) + "px", height: (height == "auto" ? "auto" : parseInt(height) + "px") });
    // register drag 
    if (dragCssName != null && dragCssName != "") {
        DragAndDrop.Register($("#floatBox")[0], $("#floatBox ." + dragCssName)[0]);
    }
    else {
        DragAndDrop.Register($("#floatBox")[0], $("#floatBox .dialogMsg_title")[0]);
    }
}



var DragAndDrop = function () {

    // 客户端当前屏幕尺寸 （忽略滚动条）
    var _clientWidth;
    var _clientHeight;

    // 拖拽控制区
    var _controlObj;
    // 拖拽对象
    var _dragObj;
    // 拖动状态
    var _flag = false;

    // 拖拽对象的当前位置
    var _dragObjCurrentLocation;
    // 鼠标最后位置
    var _mouseLastLocation;

    // 使用异步的JavaScript使拖拽效果更为流畅

    //var _timer;
    // 定时移动，由_timer定时调用
    //var intervalMove = function() {
    //$("#_dragObj").css("left", _dragObjCurrentLocation.x + "px");
    //$("#_dragObj").css("top", _dragObjCurrentLocation.y + "px");
    //};

    var getElementDocument = function () {
        return element.ownerDocument || element.document;
    };

    // 鼠标按下 
    var dragMouseDownHandler = function (evt) {
        if (_dragObj) {
            evt = evt || window.event;

            // 获取客户端屏幕尺寸 
            _clientWidth = document.body.clientWidth;
            _clientHeight = document.documentElement.scrollHeight;

            // iframe 遮罩
            //$("#jd_dialog_m_b_1").css("display", "block");

            //标记 
            _flag = true;

            // 拖拽对象位置初始化 
            _dragObjCurrentLocation = {
                x: $(_dragObj).offset().left,
                y: $(_dragObj).offset().top
            };

            // 鼠标最后位置初始化 
            _mouseLastLocation = {
                x: evt.screenX,
                y: evt.screenY
            };

            // 注：mouseover与mouseup事件均针对document注册，以解决鼠标离开_controlObj时事件丢失问题
            // 注册事件（鼠标移动）
            $(document).bind("mousemove", dragMouseMoveHandler);
            // 注册事件（鼠标松开）
            $(document).bind("mouseup", dragMouseUpHandler);

            // 取消事件的默认动作 
            if (evt.preventDefault) {
                evt.preventDefault();
            }
            else {
                evt.returnValue = false;
            }

            // 开启异步移动 
            // _timer = setInterval(intervalMove, 10);
        }
    };

    // 鼠标移动 
    var dragMouseMoveHandler = function (evt) {

        if (_flag) {
            evt = evt || window.event;

            // 当前鼠标的x，y坐标 
            var _mouseCurrentLocation = {
                x: evt.screenX,
                y: evt.screenY
            };

            // 拖拽对象坐标更新（变量）
            _dragObjCurrentLocation.x = _dragObjCurrentLocation.x + (_mouseCurrentLocation.x - _mouseLastLocation.x);
            _dragObjCurrentLocation.y = _dragObjCurrentLocation.y + (_mouseCurrentLocation.y - _mouseLastLocation.y);

            // 将鼠标最后位置赋值为当前位置
            _mouseLastLocation = _mouseCurrentLocation;

            // 拖拽对象坐标更新（位置）
            $(_dragObj).css("left", _dragObjCurrentLocation.x + "px");
            $(_dragObj).css("top", _dragObjCurrentLocation.y + "px");

            // 取消事件的默认动作 
            if (evt.preventDefault) {
                evt.preventDefault();
            }
            else {
                evt.returnValue = false;
            }
        }
    };

    // 松开鼠标 
    var dragMouseUpHandler = function (evt) {
        if (_flag) {
            evt = evt || window.event;

            // 取消iframe遮罩
            //$("jd_dialog_m_b_1").css("display","none");

            // 注销鼠标事件 （mousemove mouseup）
            cleanMouseHandlers();

            // 标记
            _flag = false;

            // 清除异步移动
            //if(_timer) {
            //  clearInterval(_timer);
            //  _timer = null;
            //}
        }
    };

    // 注销鼠标事件（mousemove mouseup）
    var cleanMouseHandlers = function () {
        if (_controlObj) {
            $(_controlObj.document).unbind("mousemove");
            $(_controlObj.document).unbind("mouseup");
        }
    };

    return {
        // 注册拖拽（参数为dom对象）
        Register: function (dragObj, controlObj) {
            // 赋值
            _dragObj = dragObj;
            _controlObj = controlObj;
            // 注册事件（鼠标按下）
            $(_controlObj).bind("mousedown", dragMouseDownHandler);
        }
    }
} ();

function DialogClose() {
    //$("#floatBoxBg").animate({ opacity: "0" }, "normal", function() { $(this).hide(); });
    //$("#floatBox").animate({ top: ($(document).scrollTop() - 300) + "px" }, "normal", function() { $(this).hide(); });
    $("#floatBoxBg").hide();
    $("#floatBox").hide();
    $("#dingZhegaiImg").hide();
    $("#dialogPassportLogin").hide();
}

function reloadHtml(content, gid) {
    $(".tag_dialog a").removeClass("selectedGame");
    $("#" + gid).addClass("selectedGame");
    $("#floatBox").html($("#" + content).html());
    DragAndDrop.Register($("#floatBox"), $("#floatBox .dialogHead"));
}

// 获取当前窗口的视图高度
function PageHeight() {
    if ($.browser.msie) {
        return document.compatMode == "CSS1Compat" ? document.documentElement.clientHeight :
	document.body.clientHeight;
    } else {
        return self.innerHeight;
    }
}; 

function upimgpc(e){  //选项卡
	var j = new Array('imgs','mtvs');
	for(var i=0;i<j.length;i++){
			if(j[i]==e){
				$('.'+e).show();
			}else{
				$('.'+j[i]).hide();	
			}
	}

}


