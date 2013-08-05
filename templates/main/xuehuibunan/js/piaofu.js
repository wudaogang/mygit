lastScrollY=0;
function heartBeat(){ 
var diffY;
if (document.documentElement && document.documentElement.scrollTop)
    diffY = document.documentElement.scrollTop;
else if (document.body)
    diffY = document.body.scrollTop
else
    {/*Netscape stuff*/}
    
//alert(diffY);
percent=.1*(diffY-lastScrollY); 
if(percent>0)percent=Math.ceil(percent); 
else percent=Math.floor(percent); 
document.getElementById("lovexin12").style.top=parseInt(document.getElementById("lovexin12").style.top)+percent+"px";

lastScrollY=lastScrollY+percent; 
//alert(lastScrollY);
}
suspendcode12="<DIV id='lovexin12' style='left:0%;POSITION:absolute;top:210%;z-index:100'>";
var recontent="<div id='rtpf'><ul><li><a href='#' title='首页'></a></li><li><a href='#' title='琴行介绍'></a></li><li><a href='#' title='琴行相册'></a></li><li><a href='#' title='琴行课程'></a></li><li><a href='#' title='乐器展示'></a></li><li><a href='#' title='琴行动态'></a></li><li class='top'><a href='#header' title='返回顶部'></a></li></ul></div>";

document.write(suspendcode12); 
document.write(recontent); 
document.write("</div>"); 
window.setInterval("heartBeat()",1);

function far_close()
{
	document.getElementById("lovexin12").innerHTML="";
}

function setfrme()
{
	var tr=document.getElementById("lovexin12");
	var twidth=tr.clientWidth;
	var theight=tr.clientHeight;
	var fr=document.getElementById("frame55la");
	fr.width=twidth-10;
	fr.height=theight-30;
}