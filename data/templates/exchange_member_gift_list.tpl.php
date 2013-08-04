<? !defined('IN_MUDDER') && exit('Access Denied'); include template('modoer_header'); ?>
<div id="body">
<div class="myhead"></div>
<div class="mymiddle">
    <div class="myleft">
        
<? include template('menu','member','member'); ?>
    </div>
    <div class="myright">
        <div class="myright_top"></div>
        <div class="myright_middle">
            <h3>我的礼品</h3>
            <div class="mainrail">
                <ul class="optabs">
<? if(is_array($status_name)) { foreach($status_name as $k => $v) { ?>
<li<? if($status==$k) { ?>
 class="active"<? } ?>
><a href="<?php echo url("exchange/member/ac/{$ac}/status/{$k}"); ?>"><?=$v?>(<?php echo (int)$status_group[$k]; ?>)</a></li>
<? } } ?>
</ul><div class="clear"></div>
                <input type="hidden" name="giftid" value="<?=$giftid?>" />
                <table width="100%" cellspacing="0" cellpadding="0" class="maintable">
                    <tr class="thbg">
                        <th width="40">编号</th>
                        <th width="*">礼品名称</th>
                        <th width="80">兑换数量</th>
                        <th width="80">花费金币</th>
                        <th width="110">兑换时间</th>
                        <th width="60">状态</th>
                        <th width="60">操作</th>
                    </tr>
                    
<? if($list) { while($val = $list->fetch_array()) { ?>
                    <tr>
                        <td><?=$val['exchangeid']?></td>
                        <td><a href="<?php echo url("exchange/gift/id/{$val['giftid']}"); ?>" target="_blank"><?=$val['giftname']?></a></td>
                        <td><?=$val['number']?></td>
                        <td><?php echo $val['price']*$val['number']; ?></td>
                        <td><?php echo newdate($val['exchangetime'],'Y-m-d H:i'); ?></td>
                        <td><?php echo $status_name[$val['status']]; ?></td>
                        <td><a href="<?php echo url("exchange/member/ac/m_gift/exchangeid/{$val['exchangeid']}"); ?>">详情</a></td>
                    </tr>
                    
<? } } ?>
                    <? if(!$total) { ?>
                    <tr>
                        <td colspan="6">暂无信息。</td>
                    </tr>
                    <? } ?>
                </table>
                <div class="multipage"><?=$multipage?></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="mybottom"></div>
</div><?php footer(); ?>