<? !defined('IN_MUDDER') && exit('Access Denied'); if(!defined('IN_AJAX')) { include template('modoer_header'); ?>
<script type="text/javascript" src="<?=URLROOT?>/static/javascript/item.js"></script>
<style type="text/css">@import url("<?=URLROOT?>/<?=$_G['tplurl']?>css_review.css");</style>
<div id="body">
<div class="myhead"></div>
<div class="mymiddle">
    <div class="myleft">
        
<? include template('menu','member','member'); ?>
    </div>
    <div class="myright">
        <div class="myright_top"></div>
        <div class="myright_middle">
            <h3>
                <? if($ac=='edit') { ?>
编辑点评
<? } else { ?>
添加点评<? } ?>
                <? if(!$user->isLogin) { ?>
(游客)<? } ?>
            </h3><? } ?>
            <div class="mainrail" id="review_foot">
            <? if($ac=='add' && !$id) { ?>
                <table width="100%" cellspacing="0" cellpadding="0" class="maintable">
                    <tr>
                        <td width="100" align="right">搜索点评对象：</td>
                        <td width="*">
							<div id="subject_search"></div>
							<script type="text/javascript">
								$('#subject_search').item_subject_search({
									input_class:'t_input',
									btn_class:'btn2',
									result_css:'item_search_result',
									hide_keyword:true,
                                    location:"<?php echo url("review/member/ac/add/type/item_subject/id/_SID_"); ?>",
                                    appendhtml:{
                                        html:"<li><a href=\"<?php echo url("item/member/ac/subject_add"); ?>\"><span class=\"font_1\">以上都不是，我要添加新主题</span></li>",
                                        inlist:true
                                    }
								});
							</script>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><div id="search_result" style="display:none;"></div></td>
                    </tr>
                </table>
            
<? } else { ?>
                <form method="post" name="frm_review" id="frm_review" action="<?php echo url("review/member/ac/{$ac}/in_ajax/{$_G['in_ajax']}/rand/{$_G['random']}"); ?>">
                <input type="hidden" name="review[idtype]" value="<?=$idtype?>" />
                <input type="hidden" name="review[id]" value="<?=$id?>" />
                <input type="hidden" name="review[subject]" value="<?=$subject?>" />
                <table width="100%" cellspacing="0" cellpadding="0" <? if(!$_G['in_ajax']) { ?>
class="maintable" width="600"
<? } else { ?>
class="item_table"<? } ?>
>
                    <? if(!$_G['in_ajax']) { ?>
                    <tr>
                        <td width="100" align="right">点评对象：</td>
                        <td width="*"><a href="<?php echo url("{$typeinfo['flag']}/detail/id/{$id}"); ?>" target="_blank"><?=$subject?></a></td>
                        <td>&nbsp;</td>
                    </tr>
                    <? } ?>
                    <tr>
                        <td align="right"><span class="font_1">*</span>总体评价：</td>
                        <td><?php echo form_radio('review[best]',array(1=>'好',0=>'不好'),$detail['best']?$detail['best']:1); ?></td></td>
                    </tr>
                    <tr>
                        <td width="100" align="right" valign="top"><span class="font_1">*</span>评价分数：</td>
                        <td width="*">
                            <div style="width:100%;">
                            
<? if(is_array($review_opts)) { foreach($review_opts as $key => $val) { ?>
                            <select name="review[<?=$val['flag']?>]">
                                <option value="">-<?=$val['name']?>-</option>
                                <option value="0"<? if($detail[$val['flag']]=='0') { ?>
 selected<? } ?>
>差</option>
                                <option value="1"<? if($detail[$val['flag']]=='1') { ?>
 selected<? } ?>
>一般</option>
                                <option value="2"<? if($detail[$val['flag']]=='2') { ?>
 selected<? } ?>
>还好</option>
                                <option value="3"<? if($detail[$val['flag']]=='3') { ?>
 selected<? } ?>
>好</option>
                                <option value="4"<? if($detail[$val['flag']]=='4') { ?>
 selected<? } ?>
>很好</option>
                                <option value="5"<? if($detail[$val['flag']]=='5') { ?>
 selected<? } ?>
>非常好</option>
                            </select>
                            
<? } } ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">点评标题：</td>
                        <td><input type="text" name="review[title]" class="t_input" size="40" value="<?=$detail['title']?>" /></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">
                            <span class="font_1">*</span>点评内容：<br />
                        </td>
                        <td>
                            <textarea name="review[content]" style="<? if($_G['in_ajax']) { ?>
width:400px;
<? } else { ?>
width:90%;<? } ?>
height:120px;padding:5px;" onkeyup="record_charlen(this,<?=$MOD['review_max']?>,'review_content');"><?=$detail['content']?></textarea>
                            <div class="font_1">请将点评内容限制在 <?=$MOD['review_min']?> - <?=$MOD['review_max']?> 个字符以内，当前输入：<span id="review_content" class="font_1"><?php echo strlen($detail['content']); ?></span></div>
                            <div class="review_picture_upload">
                                <? if($config['use_review_upload_pic']) { ?>
                                <span class="update-img-ico"><a href="javascript:;" onclick="review_pic_ui(<?=$id?>);">上传图片</a></span>
                                <? } ?>
                                <div id="review_picture">
                                    <? if($detail['pictures']) { ?>
                                    <?php $detail['pictures'] = unserialize($detail['pictures']); ?>                                    
<? if(is_array($detail['pictures'])) { foreach($detail['pictures'] as $picid => $pic) { ?>
                                    <div id="pic_<?=$picid?>_foo" class="review_picture_op">
                                        <input type="hidden" name="review[pictures][]" id="pic_<?=$picid?>" value="<?=$picid?>" />
                                        <a href="<?=URLROOT?>/<?=$pic['picture']?>"><img src="<?=URLROOT?>/<?=$pic['thumb']?>" /></a>
                                        <a href="javascript:;" onclick="review_pic_del(<?=$picid?>);">删除</a>
                                    </div>
                                    
<? } } ?>
                                    <? } ?>
                                    
                                </div>
                                <div class="clear"></div>
                            </div>
                        </td>
                    </tr>
                    <? if($config['useprice']) { ?>
                    <tr>
                        <td align="right"><? if($config['useprice_required']) { ?>
<span class="font_1">*</span><? } ?>
<?=$config['useprice_title']?>：</td>
                        <td><input type="text" name="review[price]" class="t_input" size="10" value="<?=$detail['price']?>" />&nbsp;&nbsp;<?=$config['useprice_unit']?></td>
                    </tr>
                    <? } ?>
                    
<? if(is_array($config['taggroup'])) { foreach($config['taggroup'] as $val) { ?>
                    <tr>
                        <td align="right"><?=$taggroups[$val]['name']?>：</td>
                        <?php $detail_tags = $detail['taggroup'] ? @unserialize($detail['taggroup']) : array(); ?>                        <td>
                            <? if($taggroups[$val]['sort']==1) { ?>
                            <input type="text" name="review[taggroup][<?=$val?>]" id="taggroup_<?=$val?>" size="<? if($_G['in_ajax']) { ?>
35
<? } else { ?>
50<? } ?>
" class="t_input" value="<?php echo @implode(',',$detail_tags[$val]); ?>" />&nbsp;多个标签请用逗号","分开
                            
<? } elseif($taggroups[$val]['sort']==2) { ?>
                            <?php $tagconfig = explode(',', $taggroups[$val]['options']); ?>                            
<? if(is_array($tagconfig)) { foreach($tagconfig as $ky => $tgval) { ?>
                            <input type="checkbox" name="review[taggroup][<?=$val?>][]" value="<?=$tgval?>"<? if((@in_array($tgval,$detail_tags[$val]))) { ?>
 checked<? } ?>
 id="taggroup_<?=$val?>_<?=$ky?>" /><label for="taggroup_<?=$val?>_<?=$ky?>"><?=$tgval?></label>&nbsp;
                            
<? } } ?>
                            <? } ?>
                        </td>
                    </tr>
                    
<? } } ?>
                    <? if($ac == 'add' && (!$user->isLogin && $MOD['seccode_review_guest']) || ($user->isLogin && $MOD['seccode_review'])) { ?>
                    <tr>
                        <td align="right"><span class="font_1">*</span>验证码：</td>
                        <td><div id="seccode" style="float:left;"></div><input type="text" name="seccode" onfocus="show_seccode();" class="t_input" /></td>
                    </tr>
                    <? } ?>
                </table>
                <div class="text_center" id="op_foot">
                    <? if($ac=='edit') { ?>
<input type="hidden" name="rid" value="<?=$rid?>" /><? } ?>
                    <? if($_G['in_ajax']) { ?>
                    <input type="hidden" name="dosubmit" value="yes" />
                    <button type="button" class="button" onclick="ajaxPost('frm_review', '', 'document_reload');">提交</button>&nbsp;&nbsp;
                    <button type="reset" class="button">重置</button>
                    
<? } else { ?>
                    <input type="hidden" name="forward" value="<?php echo get_forward(); ?>" />
                    <button type="submit" name="dosubmit" value="yes">提交</button>&nbsp;&nbsp;
                    <button type="reset">重置</button>&nbsp;&nbsp;
                    <button type="button" onclick="history.go(-1);">返回</button>
                    <? } ?>
                </div>
                </form>
            <? } ?>
            </div><? if(!defined('IN_AJAX')) { ?>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="mybottom"></div>
</div><?php footer(); } ?>
