<? !defined('IN_MUDDER') && exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?=$_HEAD['title']?></title>
<meta name="description" content="<?=$_HEAD['description']?>" /> 
<meta name="keywords" content="<?=$_HEAD['keywords']?>" />
<link rel="stylesheet" href="<?=URLROOT?>/<?=$_G['tplurl']?>common_main.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?=URLROOT?>/static/javascript/login.js"></script>
<script type="text/javascript" src="<?=URLROOT?>/static/javascript/validator.js"></script>
</head>
<body>
<div id="login_head"><div></div></div>
<div id="login_main">
	<div class="login_txt">
		<form method="post" action="<?php echo url("member/login/op/login/rand/{$_G['random']}"); ?>" onsubmit="return validator(this);">
                <? if($passport) { ?>
                <input type="hidden" name="passport" value="<?=$passport_type?>">
                <input type="hidden" name="passport_id" value="<?=$passport_id?>">
                <? } ?>
    	<div class="login_table">
            <table width="358" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td class="login_td1">用户名：</td>
                <td><input name="username" type="text" class="qh_input4" validator="{'empty':'N','errmsg':'请填写您的登录用户名。'}" /></td>
              </tr>
              <tr>
                <td class="login_td1">密 码：</td>
                <td><input name="password" type="text" class="qh_input4" validator="{'empty':'N','errmsg':'请填写您的登录密码。'}"/><span><a href="<?php echo url("member/login/op/forget"); ?>">忘记密码？</a></span></td>
              </tr>
              <tr>
                <td></td>
                <td><p><input name="life" id="life" type="checkbox" value="2592000" /> 下次自动登录</p><p>还不是学会不难用户？ <a href="<?php echo url("member/reg"); ?>">赶紧注册去</a></p></td>
              </tr>
              <tr>
                <td></td>
                <td><input name="onsubmit" type="image" src="<?=URLROOT?>/<?=$_G['tplurl']?>/images/login_an.jpg" /></td>
              </tr>
            </table>
            <dl class="mtop10">
            	<dd>或者：</dd>       
                <dd class="weibo"><a href="#" target="_blank">用微博账号登录</a></dd>
                <dd class="qq"><a href="#" target="_blank">用QQ账号登录</a></dd>
            </dl>
        </div>
        </form>
    </div>
</div>

<div id="footer">
    <p><a href="#" target="_blank">关于我们</a>|<a href="#" target="_blank">联系我们</a>|<a href="#" target="_blank">服务条款</a>|<a href="#" target="_blank">商家入驻</a>|<a href="#" target="_blank">友情链接</a>|<a href="#" target="_blank">广告服务</a>|<a href="#" target="_blank">纠错建议</a>|<a href="#" target="_blank">网站导航</a></p>
    <p>Copyright @ 2012 Hunla.cc All Rights Reserved. 版权所有  信息产业部icp备案：皖ICP备12009593号-1</p>
</div>
</body>
</html>