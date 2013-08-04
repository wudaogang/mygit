<? !defined('IN_MUDDER') && exit('Access Denied'); ?><?php $_HEAD['title'] = $MOD['name'];
 include template('modoer_header'); ?>
<div id="body">

    <div id="ex_left">
        <div class="mainrail rail-border-1">
            <em class="font_3">我的金币: <span class="font_2"><?=$user->coin?></span></em>
            <h2 class="rail-h-1 rail-h-bg-1"><b>最新兑换</b></h2>
            <ul class="newexchanges">
                
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('new_exchange',array('rows'=>6,),'exchange');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                <li><div><a href="<?php echo url("exchange/gift/id/{$val['giftid']}"); ?>"><img src="<?=URLROOT?>/<?=$val['thumb']?>" alt="<?=$val['name']?>" title="<?=$val['name']?>" /></a></div><p class="font_2"><?=$val['price']?> 金币</p></li>
                <?php } ?>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="mainrail" style="margin-top:10px;">
            <em class="font_3">目前可兑换礼品: <span class="font_2"><?=$total?></span></em>
            <h2 class="rail-h-1 rail-h-bg-5"><b>全部礼品</b></h2>
            <ul class="giftlist">
                
<? if($list) { while($val = $list->fetch_array()) { ?>
                <li>
                    <div class="g_thumb"><a href="<?php echo url("exchange/gift/id/{$val['giftid']}"); ?>"><img src="<?=URLROOT?>/<?=$val['thumb']?>" alt="<?=$val['name']?>" /></a></div>
                    <div class="g_info">
                        <h3><a href="<?php echo url("exchange/gift/id/{$val['giftid']}"); ?>"><?=$val['name']?></a></h3>
                        <span class="item">金币:</span><span class="font_2"><?=$val['price']?></span>,
                        <span class="item">目前库存:</span><span class="font_2"><?=$val['num']?></span><br />
                        <span class="item"><? if($val['salevolume']) { ?>
已有 <span class="font_2"><?=$val['salevolume']?></span> 个被兑换
<? } else { ?>
还没人来兑换<? } ?>
</span>
                        <div class="exchange">
                            <a class="abtn1" href="<?php echo url("exchange/member/ac/exchange/giftid/{$val['giftid']}"); ?>"><span>兑换</span></a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </li>
                
<? } } ?>
            </ul>
            <div class="clear"></div>
        </div>

        <div class="multipage"><?=$multipage?></div>
    </div>

    <div id="ex_right">
        <div class="mainrail rail-border-2">
            <h1 class="rail-h-2 rail-h-bg-2">财富榜</h1>
            <ul class="rail-list">
            
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('table',array('table'=>"dbpre_members",'orderby'=>"coin DESC",'rows'=>10,'cachetime'=>1000,),'');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
            <li><img src="<?php echo get_face($val['uid']);; ?>" width="20" height="20" /><cite><?=$val[$point]?>&nbsp;金币</cite><a href="<?php echo url("space/index/uid/{$val['uid']}"); ?>"><?=$val['username']?></a></li>
            <?php } ?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>

    <div class="clear"></div>
</div><?php footer(); ?>