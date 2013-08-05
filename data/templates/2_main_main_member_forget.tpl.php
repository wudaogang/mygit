<? !defined('IN_MUDDER') && exit('Access Denied'); include template('modoer_header'); ?>
<script type="text/javascript" src="<?=URLROOT?>/static/javascript/validator.js"></script>
<div id="body">
<div class="link_path"><a href="<?php echo url("modoer/index"); ?>">首页</a>&nbsp;&raquo;&nbsp;找回密码</div>
<div class="mainrail rail-border-1">
    <h1 class="rail-h-1 rail-h-bg-1">找回密码</h1>
    <div class="post">
        <div style="float:left;margin-bottom:10px;width:50%;border-right:1px solid #eee;">
            <? if($op=='forget') { ?>
            <form method="post" action="<?php echo url("member/login/op/forget/rand/{$_G['random']}"); ?>" onsubmit="return validator(this);">
                <table class="table" cellspacing="0" cellpadding="0" style="margin:10px 0;">
                    <tr>
                        <td align="right" width="100">用户名：</td>
                        <td width="*"><input type="text" name="username" class="t_input" style="width:200px;" validator="{'empty':'N','errmsg':'请填写您的登录用户名。'}" /></td>
                    </tr>
                    <tr>
                        <td align="right">E-mail：</td>
                        <td><input type="text" name="email" class="t_input" style="width:200px;" validator="{'empty':'N','errmsg':'请填写您注册时的E-Mail地址。'}" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><button type="submit" name="dosubmit" value="yes" class="button">提交</button></td>
                    </tr>
                </table>
            </form>
            
<? } elseif($op=='updatepw') { ?>
            <form method="post" action="<?php echo url("member/login/op/updatepw/rand/{$_G['random']}"); ?>" onsubmit="return validator(this);">
            <input type="hidden" name="getpwid" value="<?=$getpwid?>" />
            <input type="hidden" name="secode" value="<?=$secode?>" />
                <table class="table" cellspacing="0" cellpadding="0" style="margin:10px 0;">
                    <tr>
                        <td align="right" width="100">用户名：</td>
                        <td width="*"><a href="<?php echo url("space/index/uid/{$member['uid']}"); ?>" target="_blank"><?=$member['username']?></a></td>
                    </tr>
                    <tr>
                        <td align="right">新密码：</td>
                        <td><input type="password" class="t_input" name="newpassword" size="30" validator="{'empty':'N','errmsg':'请填写您的新密码。'}" /></td>
                    </tr>
                    <tr>
                        <td align="right">再次输入：</td>
                        <td><input type="password" class="t_input" name="newpassword2" size="30" validator="{'empty':'N','errmsg':'请在此输入您的新密码。'}"  /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><button type="submit" name="dosubmit" value="yes" class="button">提交</button></td>
                    </tr>
                </table>
            </form>
            <? } ?>
        </div>
        <div style="float:right;width:49%;font-size:14px;color:#808080;">
            <div style="margin:10px 5px;">已经有帐号？<a href="<?php echo url("member/login"); ?>">马上登陆</a></div>
            <div style="margin:10px 5px;">还没有帐号？<a href="<?php echo url("member/reg"); ?>">现在注册</a></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
</div><?php footer(); ?>