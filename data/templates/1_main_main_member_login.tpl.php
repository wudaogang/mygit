<? !defined('IN_MUDDER') && exit('Access Denied'); include template('modoer_header'); ?>
<script type="text/javascript" src="<?=URLROOT?>/static/javascript/validator.js"></script>
<div id="body">
<div class="link_path"><a href="<?php echo url("modoer/index"); ?>">首页</a>&nbsp;&raquo;&nbsp;登录</div>
<div class="mainrail rail-border-1">
    <h1 class="rail-h-1 rail-h-bg-1">登录</h1>
    <div class="post">
        <div style="float:left;margin-bottom:10px;width:68%;border-right:1px solid #eee;">
            <form method="post" action="<?php echo url("member/login/op/login/rand/{$_G['random']}"); ?>" onsubmit="return validator(this);">
                <? if($passport) { ?>
                <input type="hidden" name="passport" value="<?=$passport_type?>">
                <input type="hidden" name="passport_id" value="<?=$passport_id?>">
                <? } ?>
                <table class="table" cellspacing="0" cellpadding="0" style="margin:10px 0;">
                    <? if($title) { ?>
                    <tr>
                        <td align="right"></td>
                        <td width="*" height="30"><?=$title?></td>
                    </tr>
                    <? } ?>
                    <tr>
                        <td align="right" width="100">用户名：</td>
                        <td width="*"><input type="text" name="username" class="t_input" style="width:200px;" validator="{'empty':'N','errmsg':'请填写您的登录用户名。'}" /></td>
                    </tr>
                    <tr>
                        <td align="right">密码：</td>
                        <td><input type="password" name="password" class="t_input" style="width:200px;" validator="{'empty':'N','errmsg':'请填写您的登录密码。'}" /></td>
                    </tr>
                    <? if($MOD['seccode_login']) { ?>
                    <tr>
                        <td align="right" valign="top">验证码：</td>
                        <td><div id="seccode" class="none" style="float:left;width:80px;position:relative;top:-3px;"></div>
                            <input type="text" name="seccode" class="t_input" style="width:118px;" onblur="check_seccode(this.value);" onfocus="show_seccode();" validator="{'empty':'N','errmsg':'请输入注册验证码'}" />
                            <span id="msg_seccode" class="formmessage none"></span>
                        </td>
                    </tr>
                    <? } ?>
                    <tr>
                        <td align="right"></td>
                        <td><input type="checkbox" name="life" id="life" value="2592000" /><label for="life">记住密码(30天)</label></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="forward" value="<?=$forward?>" /></td>
                        <td><button type="submit" name="onsubmit" value="yes" class="button">登录</button></td>
                    </tr>
                </table>
            </form>
        </div>
        <div style="float:right;width:30%;font-size:14px;color:#808080;">
            <div style="margin:10px 5px;">还没有帐号？<a href="<?php echo url("member/reg"); ?>">现在注册</a></div>
            <div style="margin:10px 5px;">忘记密码了？<a href="<?php echo url("member/login/op/forget"); ?>">找回密码</a></div>
            <? if($_G['passport_apis']) { ?>
            <ul style="list-style:none;margin:20px 0 0 5px;padding:0;">
                <span>使用合作网站帐号登录：</span>
                
<? if(is_array($_G['passport_apis'])) { foreach($_G['passport_apis'] as $passport_name => $passport_title) { ?>
                <li style="margin-top:5px;font-size:12px;color:#3366ff;"><span style="cursor:pointer; display:block; margin-top:5px;">
                        <span onclick="document.location='<?php echo url("member/login/op/passport_login/type/{$passport_name}"); ?>';"><img src="<?=URLROOT?>/static/images/passport/<?=$passport_name?>_n.png" style="margin-right:2px;" /><?=$passport_title?></span></span></li>
                
<? } } ?>
            </ul>
            <? } ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
</div><?php footer(); ?>