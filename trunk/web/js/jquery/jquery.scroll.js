Scroller=function(config,callback){
    this.Obj=config.Obj;//滚屏对象
    this.ul=this.Obj.eq(0).find("ul:first");
    this.lineH=this.ul.find("li:first").height();
    this.line=config.line?parseInt(config.line,10):parseInt(this.Obj.height()/this.lineH,10);//滚屏行数
    this.speed=config.speed?parseInt(config.speed,10):500;//滚屏速度，越大越慢
    this.timer=config.timer?parseInt(config.timer,10):3000;//滚屏间隔时间
    this.timerID=null;
    if(this.line==0) this.line=1;
    this.upHeight=0-this.line*this.lineH;
    this.scrollUp=function(){
        this.ul.animate({
                marginTop:this.upHeight
            },this.speed,function(){
                for(var j=1;j<=this.ScrollBox.line;j++){
                    $(this).find("li:first").appendTo($(this));
                }
                $(this).css({marginTop:0});
        });
        var SBox=this;
        SBox.timerID=setTimeout(function(){
            GobalScroll.apply(this,[SBox]);
        },SBox.timer);
    }
    this.ul[0].ScrollBox=this;
    this.stop=function(){
        var ScrollBox=this.ScrollBox;
        clearTimeout(ScrollBox.timerID);
    }
   
    this.scroll=function(){
        var ScrollBox=this.ScrollBox;
        ScrollBox.timerID=setTimeout(function(){
            GobalScroll.apply(this,[ScrollBox]);
        },ScrollBox.timer);
    }
   
    this.ul.hover(this.stop,this.scroll);
    var ScrollBox1=this;
    ScrollBox1.timerID=setTimeout(function(){
        GobalScroll.apply(this,[ScrollBox1]);
    },ScrollBox1.timer);
}

function GobalScroll(obj){
    obj.scrollUp();
}