<? !defined('IN_MUDDER') && exit('Access Denied'); ?>
<table cellspacing="0" cellpadding="0" id="readmsg" class="readmsgtable">
    <tr><td><?php echo _T($msg['content']); ?></td></tr>
    <tr><td class="control"><? if($folder=='inbox' && $msg['senduid'] != 0) { ?>
[<a href="<?php echo url("member/index/ac/{$ac}/op/write/recvuid/{$msg['senduid']}/subject/Re:{$msg['subject']}"); ?>">回复</a>]&nbsp;<? } ?>
[<a href="javascript:deletemsg(<?=$msg['pmid']?>);">删除</a>]<? if($msg['uid']>0) { ?>
&nbsp;[<a href="<?=$_modules['space']['url']?>index.php?suid=<?=$msg['uid']?>">空间</a>]<? } ?>
&nbsp;[<a href="javascript:;" onclick="document.getElementById('pmid_<?=$msg['pmid']?>_content').style.display='none';">关闭</a>]</td></tr>
</table>