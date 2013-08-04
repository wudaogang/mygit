<? !defined('IN_MUDDER') && exit('Access Denied'); include template('modoer_header'); ?>
<script type="text/javascript" src="<?=URLROOT?>/static/javascript/validator.js"></script>
<div id="body">
    <div class="link_path"><a href="<?php echo url("modoer/index"); ?>">首页</a>&nbsp;&raquo;&nbsp;注册</div>
    <div class="mainrail rail-border-1">
    <h1 class="rail-h-1 rail-h-bg-1"><? if($passport) { ?>
完善帐号
<? } else { ?>
注册<? } ?>
</h1>
    <div class="post">
        <? if($MOD['closereg']) { ?>
        <div style="text-align:center">网站关闭了注册功能。<a href="javascript:history.go(-1);">返回</a></div>
        
<? } else { ?>
        <div style="float:left;margin-bottom:10px;width:68%;border-right:1px solid #eee;">
            <form method="post" action="<?php echo url("member/reg/rand/{$_G['random']}"); ?>" onsubmit="return validator(this);">
                <input type="hidden" name="forward" value="<?=$forward?>" />
                <input type="hidden" name="uniq" value="<?=$user->uniq?>" />
                <? if($passport) { ?>
                <input type="hidden" name="passport" value="<?=$passport_type?>">
                <input type="hidden" name="passport_id" value="<?=$passport_id?>">
                <? } ?>
                <table class="table" border="0" cellspacing="0" cellpadding="0" style="margin:10px 0;">
                    <? if($title) { ?>
                    <tr>
                        <td align="right"></td>
                        <td width="*" height="30"><?=$title?></td>
                    </tr>
                    <? } ?>
                    <tr>
                        <td align="right" width="100" valign="top">用户名：</td>
                        <td width="*">
                            <input type="text" onblur="check_username(this);" name="username" value="<?=$username?>" class="t_input" style="width:200px;" validator="{'empty':'N','errmsg':'请填写您的登录用户名。'}" />
                            <span id="msg_username" class="formmessage none"></span>
                            <div class="formtip">不能大于<span class="font_2">15</span>个字符</div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">E-mail：</td>
                        <td>
                            <input type="text" onblur="check_email(this);" name="email" value="<?=$email?>" class="t_input" style="width:200px;" validator="{'empty':'N','errmsg':'您未填写邮箱账号。'}" />
                            <span id="msg_email" class="formmessage none"></span><br />
                            <div class="formtip">邮箱地址字符不能大于<span class="font_2">60</span>个字符</div>
                        </td>
                    </tr>
                    <? if(!$passport || ($passport && $MOD['passport_pw'])) { ?>
                    <tr>
                        <td align="right" valign="top">登录密码：</td>
                        <td>
                            <input type="password" name="password" class="t_input" style="width:200px;" validator="{'empty':'N','errmsg':'请填写您的登录密码。'}" />
                            <span id="msg_password" class="formmessage none"></span>
                            <div class="formtip">至少需要<span class="font_2">6</span>个字符</div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">重输密码：</td>
                        <td>
                            <input type="password" name="password2" class="t_input" style="width:200px;" validator="{'empty':'N','errmsg':'请再次输入登录密码。'}" />
                            <span id="msg_password2" class="formmessage none"></span>
                            <div class="formtip">再次输入登录密码</div>
                        </td>
                    </tr>
                    <? } ?>
                    <? if($MOD['seccode_reg']) { ?>
                    <tr>
                        <td align="right" valign="top">验证码：</td>
                        <td><div id="seccode" class="seccode none"></div>
                            <input type="text" name="seccode" class="t_input" style="width:118px;" onblur="check_seccode(this.value);" onfocus="show_seccode();" validator="{'empty':'N','errmsg':'请输入注册验证码'}" />
                            <span id="msg_seccode" class="formmessage none"></span>
                        </td>
                    </tr>
                    <? } ?>
                    <? if($MOD['showregrule']) { ?>
                    <tr>
                        <td align="right" valign="top">注册协议：</td>
                        <td colspan="2">
                            <textarea rows="5" cols="60" class="txt" style="width:90%;height:100px;" readonly><?=$MOD['regrule']?></textarea>
                            <input type="checkbox" id="regrule" value="1" validator="{'empty':'N','errmsg':'您未接受注册协议。'}" />
                            <label for="regrule">我接受注册协议</label>
                        </td>
                    </tr>
                    <? } ?>
                    <tr>
                        <td></td>
                        <td colspan="2"><button type="submit" value="yes" name="dosubmit" class="button">提交注册信息</button></td>
                    </tr>
                </table>
            </form>
        </div>
        <div style="float:right;width:30%;font-size:14px;">
            <? if($passport) { ?>
            <div style="margin:10px 0 0 5px;">
                <a href="<?php echo url("member/login/op/passport_bind/passport/{$passport_type}"); ?>"><img src="<?=URLROOT?>/<?=$_G['tplurl']?>/img/bind_btn.png" title="绑定已存在帐号" /></a>
            </div>
            
<? } else { ?>
            <div style="margin:10px 0 0 5px;">
                <a href="<?php echo url("member/login"); ?>"><img src="<?=URLROOT?>/<?=$_G['tplurl']?>/img/login_btn.png" title="登录已有帐号" /></a>
            </div>
            <? if($_G['passport_apis']) { ?>
            <ul style="list-style:none;margin:20px 0 0 5px;padding:0;">
                <span>使用合作网站帐号登录：</span>
                
<? if(is_array($_G['passport_apis'])) { foreach($_G['passport_apis'] as $passport_name => $passport_title) { ?>
                <li style="margin-top:5px;font-size:12px;color:#3366ff;"><span style="cursor:pointer; display:block; margin-top:5px;">
                        <span onclick="document.location='<?php echo url("member/login/op/passport_login/type/{$passport_name}"); ?>';"><img src="<?=URLROOT?>/static/images/passport/<?=$passport_name?>_n.png" style="margin-right:2px;" /><?=$passport_title?></span></span></li>
                
<? } } ?>
            </ul>
            <? } ?>
            <? } ?>
        </div>
        <div class="clear"></div>
        <? } ?>
    </div>
    </div>
</div><?php footer(); ?>