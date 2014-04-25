<div id="container">
        <h3>
            <a title="系统消息">系统消息</a>
        </h3>
        <div class="systemBox">
            <h2 class="title">
               <{$msg.title|sslash}><span><{$msg.msgdate|date_format:"%Y-%m-%d %H:%M"}></span>
            </h2>
            <div class="articleMain">
                <{$msg.content|sslash }>
            </div>
            <div class="systemBtn">
                <input type="button" id="backSystem" onclick="location.href='/msg/main'" value="返回系统消息" />
                <input type="button" id="deleteMsg" onclick="location.href='/msg/delMsgOne/<{$msg.id}>' " value="删除本消息" />
            </div>
        </div>
    </div>