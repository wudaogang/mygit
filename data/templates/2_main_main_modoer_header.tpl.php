<? !defined('IN_MUDDER') && exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title><?=$_HEAD['title']?></title>
<meta name="description" content="<?=$_HEAD['description']?>" /> 
<meta name="keywords" content="<?=$_HEAD['keywords']?>" />
<link rel="stylesheet" href="<?=URLROOT?>/<?=$_G['tplurl']?>common_main.css" type="text/css" media="screen" />
</head>
<body>
<div id="wrap">
<div id="header">
	<dl>
    	<dt><code>热门搜索：</code><span class="current">琴行</span><span>老师</span><span>课程</span><span>乐器</span></dt>
        <dd>
        <input name="" type="text" class="search" value="搜索您想找的......" /><input name="" type="image" src="<?=URLROOT?>/<?=$_G['tplurl']?>images/btn.jpg" class="rt" />
        </dd>
        <dd class="zix"><a href="#" target="_blank">资讯</a></dd>
    </dl>
</div>
<div id="nav">
	<ul>
    	<li class="nav01"><a href="#" t"templates/main/default/member_login.htm"itle="首页" class="now"></a></li>
        <li class="nav02"><a href="#" title="找琴行"></a></li>
        <li class="nav03"><a href="#" title="找老师"></a></li>
        <li class="nav04"><a href="#" title="乐器维修调律"></a></li>
        <li class="nav05"><a href="#" title="活动预告"></a></li>
        <li class="nav06"><a href="#" title="二手乐器"></a></li>
        <li class="nav07"><a href="#" title="论坛"></a></li>
        
    </ul>
    <dl>
    	<dd><a href="<?php echo url("member/login"); ?>"><img src="<?=URLROOT?>/<?=$_G['tplurl']?>images/login.jpg"/></a></dd>
        <dd><a href="<?php echo url("member/reg"); ?>"><img src="<?=URLROOT?>/<?=$_G['tplurl']?>images/register.jpg" /></a></dd>
        <dd class="weibo"><a href="#" target="_blank">微博登录</a></dd>
        <dd class="qq"><a href="#" target="_blank">QQ登录</a></dd>
    </dl>
</div>