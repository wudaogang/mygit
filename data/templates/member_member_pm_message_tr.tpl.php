<? !defined('IN_MUDDER') && exit('Access Denied'); if($total) { ?>
<?php while($val = $list->fetch_array()): ?><tr id="pmid_<?=$val['pmid']?>">
    <td width="20"><input type="checkbox" name="pmids[]" value="<?=$val['pmid']?>"></td>
    <td><a href="javascript:readmsg(<?=$val['pmid']?>);"><?=$val['subject']?></a></td>
    <td><? if(empty($val['uid'])) { ?>
系统
<? } else { ?>
<a href="<?php echo url("space/index/suid/{$val['uid']}"); ?>"><?=$val['username']?></a><? } ?>
</td>
    <? if($folder=='inbox') { ?>
    <td><? if(empty($val['new'])) { ?>
已读
<? } else { ?>
<span class="font_1">未读</span><? } ?>
</td>
    <? } ?>
    <td><?php echo newdate($val['posttime'],'Y-m-d H:i'); ?></td>
</tr><?php endwhile; } else { ?>
<tr><td colspan="5">暂无信息。</td></tr><? } ?>
