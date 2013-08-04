<?php (!defined('IN_ADMIN') || !defined('IN_MUDDER')) && exit('Access Denied'); ?>
<div id="body">
<form method="post" name="myform" action="<?=cpurl($module,$act,'save')?>">
    <div class="space">
        <div class="subtitle">其他设置[<?=$detail['name']?>]</div>
        <table class="maintable" border="0" cellspacing="0" cellpadding="0" trmouse="Y">
            <tr>
                <td class="altbg1" valign="top"><strong>分类名称：</strong>设置当前分类的名称</td>
                <td>
                    <?=form_input('name',$detail['name'],'txtbox')?>
                </td>
            </tr>
            <tr>
                <td class="altbg1" valign="top"><strong>启用分类：</strong>在前台允许会员添加本分类的主题</td>
                <td>
                    <?=form_bool('enabled',$detail['enabled'])?>
                </td>
            </tr>
            <?if($attcats = $_G['loader']->variable('att_cat','item',false)):?>
            <tr>
                <td class="altbg1" valign="top"><strong>启用属性组筛选：</strong>在主题列表页当前子分类时可进行属性组筛选</td>
                <td>
					<?if($detail['level']<3):?>
					<div><input type="checkbox" name="set2subcat" id="set2subcat" /><label for="set2subcat"><span class="font_1">将下列属性组筛选选择应用到子分类</span></label></div>
					<?endif;?>
                    <?foreach($attcats as $key => $val):?>
                    <input type="checkbox" name="config[attcat][]" id="attcat_<?=$key?>" value="<?=$val['catid']?>"<?if($detail['config'] && in_array($val['catid'], $detail['config']['attcat']))echo' checked';?> />&nbsp;<label for="attcat_<?=$key?>"><?=$val['name']?>&nbsp;(<?=$val['des']?>)</label><br />
                    <?endforeach;?>
                </td>
            </tr>
            <?endif;?>
        </table>
        <center>
            <input type="hidden" name="catid" value="<?=$_GET['catid']?>" />
			
            <button type="submit" class="btn" name="onsubmit" value="yes"> 提交 </button>
            <button type="button" class="btn" onclick="location.href='<?=cpurl($module,'category_edit','subcat',array('catid'=>$detail['pid']))?>'" /><?=lang('global_return')?></button>
        </center>
    </div>
</form>
</div>