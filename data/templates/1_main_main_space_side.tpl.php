<? !defined('IN_MUDDER') && exit('Access Denied'); ?>
<div class="mainrail rail-border-1">
    <h3 class="rail-h-1 rail-h-bg-1"><?=$member['username']?></h3>
    <div style="text-align:center;"><a href="<?php echo url("space/index/uid/{$uid}"); ?>"><img src="<?php echo get_face($member['uid']); ?>" /></a></div>
    <ul class="rail-list">
        <li style="text-align:center;"><a href="javascript:add_friend(<?=$uid?>);">加为好友</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:send_message(<?=$uid?>);">发送短信</a></li>
        <li>加入：<?php echo newdate($member['regdate'], 'Y-m-d H:i'); ?></li>
        <li>登录：<?php echo newdate($member['logintime'], 'Y-m-d H:i'); ?></li>
        <li>等级：<?php echo template_print('member','group',array('groupid'=>$member['groupid'],));?></li>
        <li>积分：<span class="font_2"><?=$member['point']?></span></li>
        <li>金币：<span class="font_2"><?=$member['coin']?></span></li>
        <li>点评：<span class="font_2"><?=$member['reviews']?></span></li>
        <li>登记：<span class="font_2"><?=$member['subjects']?></span></li>
        <li>鲜花：<span class="font_2"><?=$member['flowers']?></span></li>
    </ul>
</div>