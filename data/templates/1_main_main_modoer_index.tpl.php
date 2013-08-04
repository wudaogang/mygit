<? !defined('IN_MUDDER') && exit('Access Denied'); include template('modoer_header'); ?>
<div id="body">

    <div class="ix_foo">

        <div class="ix1_left">
            <script type="text/javascript" src="<?=URLROOT?>/static/javascript/jquery.d.imagechange.js"></script>
            <div class="l1_pics" id="l1_pics">
                
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('bcastr',array('groupname'=>"index",),'');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                <a href="<?=$val['item_url']?>" title="<?=$val['itemtitle']?>" target="_blank"><img src="<?=URLROOT?>/<?=$val['link']?>" height="200" width="348" /></a>
                <?php } ?>
            </div>
            <script type="text/javascript">
                $('#l1_pics').d_imagechange({width:300,height:250,repeat:'repeat'});
            </script>
        </div>

        <div class="ix1_center">
            <ul class="hl">
                
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('table',array('table'=>"dbpre_articles",'select'=>"articleid,subject,introduce",'where'=>"att=1 AND status=1",'orderby'=>"listorder",'rows'=>1,'cachetime'=>1000,),'');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                <li>
                    <h2><a href="<?php echo url("article/detail/id/{$val['articleid']}"); ?>"><?=$val['subject']?></a></h2>
                    <p><?php echo trimmed_title($val['introduce'],52,'...'); ?>...</p>
                </li>
                <?php } ?>
            </ul>
            <div class="ix1_line"></div>
            <ul class="hl2">
                
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('table',array('table'=>"dbpre_articles",'select'=>"articleid,subject,catid,author,dateline",'where'=>"att=2 AND status=1",'orderby'=>"listorder",'rows'=>8,'cachetime'=>1000,),'');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                <li><a href="<?php echo url("article/detail/id/{$val['articleid']}"); ?>" title="<?=$val['subject']?>"><?php echo trimmed_title($val['subject'],14); ?></a></li>
                <?php } ?>
            </ul>
            <div class="clear"></div>
            <ul class="hl3">
                
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('table',array('table'=>"dbpre_articles",'select'=>"articleid,subject,thumb",'where'=>"att=3 AND status=1",'orderby'=>"listorder",'rows'=>4,'cachetime'=>1000,),'');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                <li><div><a href="<?php echo url("article/detail/id/{$val['articleid']}"); ?>"><img src="<?=URLROOT?>/<?=$val['thumb']?>" width="88" height="60" title="<?=$val['subject']?>" /></a></div></li>
                <?php } ?>
            </ul>
        </div>

        <div class="ix1_right">
            <div class="btns">
                <a href="<?php echo url("member/reg"); ?>" title="免费注册">免费注册</a>
                <a href="<?php echo url("member/login"); ?>" title="快速登录">快速登录</a>
                <a href="<?php echo url("review/member/ac/add"); ?>" title="发表点评">发表点评</a>
                <a href="<?php echo url("item/member/ac/subject_add"); ?>" title="添加主题">添加主题</a>
                <div class="clear"></div>
            </div>
            <ul class="comm">
                <h2><a href="<?php echo url("index/announcement/do/list"); ?>">网站公告</a></h2>
                
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('table',array('table'=>"dbpre_announcements",'select'=>"id,title,dateline",'where'=>"available=1",'orderby'=>"orders",'rows'=>5,'cachetime'=>1000,),'');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                <li><div><a href="<?php echo url("index/announcement/id/{$val['id']}"); ?>"><?php echo trimmed_title($val['title'],18); ?></a></div></li>
                <?php } ?>
            </ul>
        </div>

        <div class="clear"></div>

    </div>

    <div class="index_1">
        <div class="ixf_left">
            <!-- 推荐主题 begin --->
            <div class="ix_foo">
                <div class="ix_finer">
                    <div class="ix_left1_more">
                        <div class="ix_tab">
                            <div id="btn_subject1" class="selected"><a href="###" onclick="tabSelect(1,'subject')" onfocus="this.blur()">综合</a></div>
                            <?php $i=2; ?>                            
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('category',array('pid'=>0,),'item');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                            <div id="btn_subject<?=$i?>"><a href="###" onclick="tabSelect(<?=$i?>,'subject')" onfocus="this.blur()"><?=$val['name']?></a></div>
                            <?php $i++; ?>                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="ix_left1_body" id="subject1" style="height:270px;_height:245px;">
                    <ul class="index_subject_pic">
                        
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('table',array('table'=>"dbpre_subject",'select'=>"sid,aid,name,subname,avgsort,thumb,description",'where'=>"finer>0 AND status=1",'orderby'=>"finer DESC",'rows'=>10,'cachetime'=>1000,),'');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                        <li>
                            <div><a href="<?php echo url("item/detail/id/{$val['sid']}"); ?>"><img src="<?=URLROOT?>/<? if($val['thumb']) { ?>
<?=$val['thumb']?>
<? } else { ?>
static/images/noimg.gif<? } ?>
" alt="<?=$val['name'].$val['subname']?>" title="<?=$val['name'].$val['subname']?>" /></a></div>
                            <p><a href="<?php echo url("item/detail/id/{$val['sid']}"); ?>" title="<?=$val['name'].$val['subname']?>"><?php echo trimmed_title($val['name'].$val['subname'],10); ?></a></p>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php $i=2; ?>                
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('category',array('pid'=>0,),'item');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                <div class="ix_left1_body none" style="height:270px;_height:245px;" id="subject<?=$i?>" datacallname="首页_推荐主题" params="{'pid':'<?=$val['catid']?>'}"></div>
                <?php $i++; ?>                <?php } ?>
                <div class="ix_left1_bottom"></div>
            </div>
            <!-- 推荐主题 end --->

			<!-- 需要加载的广告位置 -->
			<div id="adv_1"></div>

            <!-- 最新点评 end --->
            <div class="ix_foo">
                <div class="ix_review">
                    <div class="ix_left1_more"><span class="arrow-ico"><a href="<?php echo url("item/reviews"); ?>">更多</a></span></div>
                </div>
                <div class="ix_left1_body" style="height:435px;">
                    
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('review',array('orderby'=>"posttime DESC",'rows'=>5,'cachetime'=>500,),'review');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                    <div class="review">
                        <div class="member">
                            <a href="<?php echo url("space/index/uid/{$val['uid']}"); ?>"><img src="<?php echo get_face($val['uid']); ?>" class="face"></a>
                        </div>
                        <div class="field">
                            <div class="feed">
                                <? if($val['uid']) { ?>
                                <span class="member-ico"><a href="<?php echo url("space/index/uid/{$val['uid']}"); ?>"><?=$val['username']?></a></span>&nbsp;在&nbsp;<?php echo newdate($val['posttime'], 'w2style'); ?>                                
<? } else { ?>
                                <span class="font_3">游客(<?php echo preg_replace("/^([0-9]+)\.([0-9]+)\.([0-9]+)\.([0-9]+)$/","\\1.\\2.*.*", $val['ip']); ?>)</span>
                                <? } ?>
                                点评了&nbsp;<strong><a href="<?php echo template_print('review','typeurl',array('idtype'=>$val['idtype'],'id'=>$val['id'],));?>"><?=$val['subject']?></a></strong>
                            </div>
                            <div class="info">
                                <ul class="score">
                                    
<?php $_QUERY['get__val']=$_G['datacall']->datacall_get('reviewopt',array('catid'=>$val['pcatid'],),'review');
if(is_array($_QUERY['get__val']))foreach($_QUERY['get__val'] as $_val_k => $_val) { ?>
                                    <li><?=$_val['name']?></li><li class="start<?php echo cfloat($val[$_val['flag']]); ?>"></li>
                                    <?php } ?>
                                </ul>
                                <div class="clear"></div>
                                <?php $reviewurl = '...<a href="' . url("review/detail/id/".$val['rid']) . '">查看全文</a>'; ?>                                <p><?php echo trimmed_title($val['content'],42,$reviewurl); ?></p>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>
                </div>
                <div class="ix_left1_bottom"></div>
            </div>
            <!-- 最新点评 end --->
        </div>
        <div class="ixf_right">
            
            <!-- 会员卡 begin -->
            <? if(check_module('card')) { ?>
            <div class="ix_foo">
                <div class="ix_right_top"></div>
                <div class="ix_right_body" style="height:220px;">
                    <h2><a href="<?php echo url("card/index"); ?>">会员卡折扣</a></h2>
                    <ul class="ix_card">
                    
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('list_finer',array('row'=>10,'cachetime'=>1000,),'card');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                    <li><cite><?=$val['discount']?>&nbsp;折</cite><a href="<?php echo url("item/detail/id/{$val['sid']}"); ?>"><?php echo trimmed_title(trim($val['name'].$val['subname']),15); ?></a></li>
                    <?php } ?>
                    </ul>
                </div>
                <div class="ix_right_bottom"></div>
            </div>
            <? } ?>
            <!-- 会员卡 end -->

            <!-- 热门优惠券 begin -->
            <? if(check_module('exchange')) { ?>
            <div class="ix_foo">
                <div class="ix_right_top"></div>
                <div class="ix_right_body" style="height:195px;">
                    <h2><a href="<?php echo url("coupon/index"); ?>">优惠券</a></h2>
                    <ul class="ix_coupon">
                    
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('list_new',array('row'=>7,'cachetime'=>1000,),'coupon');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                        <? if($val_k <= 1) { ?>
                            <li class="thumb"><a href="<?php echo url("coupon/detail/id/{$val['couponid']}"); ?>" title="<?=$val['subject']?>"><img src="<?=URLROOT?>/<?=$val['thumb']?>" alt="<?=$val['subject']?>" /></a></li>
                        
<? } else { ?>
                            <li class="c"><cite><?php echo newdate($val['dateline'], 'm-d'); ?></cite><a href="<?php echo url("coupon/detail/id/{$val['couponid']}"); ?>"><?php echo trimmed_title($val['subject'],15); ?></a></li>
                        <? } ?>
                    <?php } ?>
                    </ul>
                </div>
                <div class="ix_right_bottom"></div>
            </div>
            <? } ?>
            <!-- 热门优惠券 end -->

            <!-- 点评分类 begin -->
            <div class="ix_foo">
                <div class="ix_right_top"></div>
                <div class="ix_right_body" style="height:400px; overflow:auto; overflow-x:hidden;">
                    <h2>主题分类</h2>
                    
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('category',array('pid'=>0,),'item');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                    <div class="ix_category">
                        <h3><a href="<?php echo url("item/list/catid/{$val['catid']}"); ?>"><?=$val['name']?></a></h3>
                        
<?php $_QUERY['get__val']=$_G['datacall']->datacall_get('category',array('pid'=>$val['catid'],),'item');
if(is_array($_QUERY['get__val']))foreach($_QUERY['get__val'] as $_val_k => $_val) { ?>
                        <a href="<?php echo url("item/list/catid/{$_val['catid']}"); ?>"><?=$_val['name']?></a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="ix_right_bottom"></div>
            </div>
            <!-- 点评分类 end -->
        </div>
        <div class="clear"></div>
    </div>

    <div class="index_1">
        <div class="ixf_left">
            <!-- 最新图片 begin --->
            <div class="ix_foo">
                <div class="ix_picture">
                    <div class="ix_left1_more"><span class="arrow-ico"><a href="<?php echo url("item/allpic"); ?>">更多</a></span></div>
                </div>
                <div class="ix_left1_body" style="height:90px;">
                    <ul class="index_pic">
                    
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('picture',array('select'=>"picid,title,thumb,sid",'orderby'=>"addtime DESC",'rows'=>7,'cachetime'=>1000,),'item');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                    <li><div><a href="<?php echo url("item/detail/id/{$val['sid']}"); ?>"><img src="<?=URLROOT?>/<?=$val['thumb']?>" alt="<?=$val['title']?>" title="<?=$val['title']?>" /></a><b></b></div></li>
                    <?php } ?>
                    </ul>
                </div>
                <div class="ix_left1_bottom"></div>
            </div>
            <!-- 最新图片 end --->
        </div>
        <div class="ixf_right">
            <!-- 最新标签 begin -->
            <div class="ix_foo">
                <div class="ix_right_top"></div>
                <div class="ix_right_body">
                    <h2><a href="<?php echo url("item/tag"); ?>">最新标签</a></h2>
                    <div class="ix_tag" style="height:92px;">
                        
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('tag',array('orderby'=>"dateline DESC",'row'=>20,'cachetime'=>1000,),'item');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                        <span><a href="<?php echo url("item/tag/tagid/{$val['tagid']}"); ?>"<? if($val['total']) { ?>
 class="<?php echo template_print('item','tagclassname',array('total'=>$val['total'],));?>"<? } ?>
><?php echo trimmed_title($val['tagname'],6); ?></a></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="ix_right_bottom"></div>
            </div>
            <!-- 最新标签 end -->
        </div>
        <div class="clear"></div>
    </div>

    <!-- 友情链接 begin -->
    <? if(check_module('link')) { ?>
    <div class="mainrail rail-border-3">
        <div class="rail-h-bg-3">
            <em>
                <a href="<?php echo url("link/apply"); ?>">申请链接</a>&nbsp;
                <span class="arrow-ico"><a href="<?php echo url("link/index"); ?>">更多</a></span>
            </em>
            <h2 class="rail-h-3">友情链接</h2>
        </div>
        <div class="index_links">
            <div class="links">
                
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('links',array('type'=>"char",),'link');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                <a href="<?=$val['link']?>" title="<?=$val['des']?>" target="_blank"><?=$val['title']?></a>
                <?php } ?>
            </div>
            <div class="line"></div>
            <div class="links">
                
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('links',array('type'=>"logo",),'link');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                <a href="<?=$val['link']?>" title="<?=$val['des']?>" target="_blank"><img src="<?=$val['logo']?>" alt="<?=$val['title']?>" /></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <? } ?>
    <!-- 友情链接 end -->

</div>
<div id="adv_1_content" style="display:none;">
<? if($_incfile_=display('adv:show','name/首页_中部广告'))include_once($_incfile_);?>
</div>
<script type="text/javascript">
//加载广告
replace_content('adv_1=adv_1_content');
</script><?php footer(); ?>