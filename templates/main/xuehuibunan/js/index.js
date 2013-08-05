$(function(){
	function mytab(menu,content,on){
	//初始化显示状态
	//点击显示对应区块
	$(menu).click(function(){
		var i= $(this).index();
		$(menu).removeClass(on);
		$(this).addClass(on);
		$(content).hide();
		$(content).eq(i).show();
	})
	//自动切换
	setInterval(function(){
		var index = $(content+":visible").index();
		index=index+1;
		if(index>=5){index=0};
		$(content).eq(index).show().siblings().hide();
		$(menu).eq(index).addClass(on).siblings().removeClass(on)
	},3000);
	}
 	mytab(".focus dd",".focus li","current");
	mytab(".nyfocus dd",".nyfocus li","current");
	
})