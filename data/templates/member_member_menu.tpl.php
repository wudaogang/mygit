<? !defined('IN_MUDDER') && exit('Access Denied'); ?>
<script type="text/javascript">
$(document).ready(function(){
    $("table[trmouse=Y] tr").each(function(i) {
        if(!this.className) {
            $(this).mouseover( function() { this.style.background='#FFFFCC'; } );
            $(this).mouseout( function() { this.style.background='#FFF'; } );
        }
    });
});

function expand(self, id) {
    var obj = document.getElementById(id).childNodes;
    for(var i=0;i<obj.length;i++) {
        if(obj[i].nodeName == "DIV") {
            switch(obj[i].style.display) {
                case "":
                case "block":
                 obj[i].style.display = "none";
                 $('#'+id+' > [class=c_folder]').attr('class',"e_folder");
                 break;
                case "none":
                 obj[i].style.display = "block";
                 $('#'+id+' > [class=e_folder]').attr('class',"c_folder");
                 break; 
            }
        }
    }
}
</script>
<div class="myleft_home"><a href="<?php echo url("member/index"); ?>" onfocus="this.blur()">助手首页</a></div>
<div class="myleft_top"></div>
<div class="my_menus myleft_middle">
    <div id='div_1' class='menu'>
        <p><a href='javascript:expand(this, "div_1");' class='c_folder'>我的助手</a></p>
        
<? if(is_array($_G['assistant_menu']['member'])) { foreach($_G['assistant_menu']['member'] as $k => $val) { ?>
        <?php list($name,$url) = explode(',', $val);
            if($_G['menu_mapping']) foreach($_G['menu_mapping'] as $re) $re['src']==$url&&$url = $re['dst'];
         ?>        <div id='div_1_<?=$k?>' class='menu'>&nbsp;<a href="<?php echo url($url); ?>"><?=$name?></a></div>
        
<? } } ?>
    </div><? if($_G['subject_owner']) { ?>
    <div id='div_2' class='menu'>
        <p><a href='javascript:expand(this, "div_2");' class='c_folder'>主题管理</a></p>
        
<? if(is_array($_G['assistant_menu']['manage'])) { foreach($_G['assistant_menu']['manage'] as $k => $val) { ?>
        <?php list($name,$url) = explode(',', $val);
            if($_G['menu_mapping']) foreach($_G['menu_mapping'] as $re) $re['src']==$url&&$url = $re['dst'];
         ?>        <div id='div_2_<?=$k?>' class='menu'>&nbsp;<a href="<?php echo url($url); ?>"><?=$name?></a></div>
        
<? } } ?>
    </div><? } ?>
    <div id='div_3' class='menu'>
        <p><a href='javascript:expand(this, "div_3");' class='c_folder'>个人信息</a></p>
        
<? if(is_array($_G['assistant_menu']['myset'])) { foreach($_G['assistant_menu']['myset'] as $k => $val) { ?>
        <?php list($name,$url) = explode(',', $val);
            if($_G['menu_mapping']) foreach($_G['menu_mapping'] as $re) $re['src']==$url&&$url = $re['dst'];
         ?>        <div id='div_3_<?=$k?>' class='menu'>&nbsp;<a href="<?php echo url($url); ?>"><?=$name?></a></div>
        
<? } } ?>
    </div>
</div>