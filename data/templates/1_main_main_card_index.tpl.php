<? !defined('IN_MUDDER') && exit('Access Denied'); ?><?php $_HEAD['title'] = (isset($catid)?$category[$catid]['name']:'') . $MOD['name'] . $_CFG['titlesplit'] . $MOD['subtitle'];
 include template('modoer_header'); ?>
<div id="body">

    <div id="card_left">

        <div class="link_path">
            <em><a href="<?php echo url("card/member/ac/apply"); ?>"><span class="font_1"><b>申请会员卡</b></span></a></em>
            <a href="<?php echo url("modoer/index"); ?>">
<? echo lang('global_index'); ?>
</a>&nbsp;&raquo;&nbsp;<?php echo implode('&nbsp;&raquo;&nbsp;', $urlpath); ?>        </div>

		<div class="g-list-category">
			<div class="g-list-category-type">
				<h3>分类:</h3>
				<ul class="g-list-category-class">
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('category',array('pid'=>0,),'item');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
<li<?=$active['catid'][$val['catid']]?>><a href="<?php echo url("card/index/catid/{$val['catid']}"); ?>"><?=$val['name']?></a></li><?php } ?>
</ul>
				<div class="clear"></div>
			</div>
		</div>

        
<? if($list) { while($val = $list->fetch_array()) { ?>
        <div class="il_coupon">
            <div class="thumb"><a href="<?php echo url("item/detail/id/{$val['sid']}"); ?>"><img src="<?=URLROOT?>/<? if($val['thumb']) { ?>
<?=$val['thumb']?>
<? } else { ?>
static/images/noimg.gif<? } ?>
" alt="<?=$val['name']?>" /></a></div>
            <ul class="info">
                <li class="full">商户：<a href="<?php echo url("item/detail/id/{$val['sid']}"); ?>"><?=$val['name'].$val['subname']?></a></li>
                <li>折扣：<span class="font_2"><?=$val['discount']?></span>&nbsp;折</li>
                <li>优惠：<span class="font_2"><?=$val['largess']?></span></li>
                <li class="full">说明：<?=$val['exception']?></li>
                <li class="full">现有<span class="font_2"><?=$val['pageviews']?></span>次浏览，<span class="font_2"><?=$val['reviews']?></span>个点评，<span class="font_2"><?=$val['pictures']?></span>张图片</li>
            </ul>
            <div class="clear"></div>
        </div>
        
<? } } ?>
        <div class="multipage"><?=$multipage?></div>

    </div>

    <div id="card_right">

        <div class="link_path">
            <em>现有<span class="font_2"><?=$total?></span>个加盟商</em>&nbsp;
        </div>

        <div class="mainrail rail-border-3">
            <h3 class="rail-h-3 rail-h-bg-3">推荐加盟</h3>
            <ul class="rail-list">
                
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('list_finer',array('row'=>10,),'card');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                <li><cite><?=$val['discount']?>&nbsp;折</cite><a href="<?php echo url("item/detail/id/{$val['sid']}"); ?>"><?php echo trimmed_title(trim($val['name'].$val['subname']),15); ?></a></li>
                <?php } ?>
            </ul>
        </div>

        <div class="mainrail rail-border-3">
            <h3 class="rail-h-3 rail-h-bg-3">最新加盟</h3>
            <ul class="rail-list">
                
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('list_new',array('row'=>10,),'card');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                <li><cite><?php echo newdate($val['addtime'],'m-d'); ?></cite><a href="<?php echo url("item/detail/id/{$val['sid']}"); ?>"><?php echo trimmed_title(trim($val['name'].$val['subname']),15); ?></a></li>
                <?php } ?>
            </ul>
        </div>

    </div>

</div><?php footer(); ?>