<? !defined('IN_MUDDER') && exit('Access Denied'); include template('modoer_header'); ?>
<style>
.linkslist { float:both; width: 100%; padding: 10px 0; overflow: hidden; font-size: 12px; margin:0; }
.linkslist li { float: left; display: inline; width: 18em; height: 70px; overflow: hidden; margin: 0 10px; color: #919191; }
.linkslist li img { margin-bottom:3px; }
.linkslist li a { margin:0; }
</style>
<div id="body">
    <div class="link_path">
        <em><a href="<?php echo url("link/apply"); ?>">申请链接</a></em>
        <a href="<?php echo url("modoer/index"); ?>">首页</a>&nbsp;&raquo;&nbsp;<a href="<?php echo url("link/index"); ?>">友情链接</a>
    </div>
    <div class="mainrail rail-border-1">
        <h1 class="rail-h-1 rail-h-bg-1">文字连接</h1>
        <? if($links['char']) { ?>
            <ul class="linkslist">
            
<? if(is_array($links['char'])) { foreach($links['char'] as $val) { ?>
            <li><a href="<?=$val['link']?>" target="_blank"><?=$val['title']?></a><br /><?=$val['link']?><br /><?=$val['des']?></li>
            
<? } } ?>
            </ul>
        <? } ?>
    </div>
    <div class="mainrail rail-border-1">
        <h1 class="rail-h-1 rail-h-bg-1">图片链接</h1>
        <? if($links['logo']) { ?>
            <ul class="linkslist">
            
<? if(is_array($links['logo'])) { foreach($links['logo'] as $val) { ?>
            <li><a href="<?=$val['link']?>" target="_blank" title="<?=$val['title']?>"><img src="<?=$val['logo']?>"></a><br /><?=$val['des']?></li>
            
<? } } ?>
            </ul>
        <? } ?>
    </div>
</div><?php footer(); ?>