<? !defined('IN_MUDDER') && exit('Access Denied'); ?><?php $_HEAD['title'] = (isset($catid)?$category[$catid]['name']:'') . $MOD['name'];
 include template('modoer_header'); ?>
<div id="body">

        <div class="link_path">
			<em>共找到 <span class="font_2"><?=$total?></span> 个产品</em>
            <a href="<?php echo url("modoer/index"); ?>">
<? echo lang('global_index'); ?>
</a>&nbsp;&raquo;&nbsp;<?php echo implode('&nbsp;&raquo;&nbsp;', $urlpath); ?>        </div>

    <div class="product_left">

		<div class="g-list-category">
			<div class="g-list-category-type">
                <h3>分类:</h3>
                <ul class="g-list-category-class">
                
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('category',array('is_item'=>1,),'product');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
                <li<?=$active['catid'][$val['catid']]?>><a href="<?php echo url("product/index/catid/{$val['catid']}"); ?>"><?=$val['name']?></a></li>
                <?php } ?>
                </ul>
                <div class="clear"></div>
            </div>
        </div>

		<div class="subrail">
			显示方式:
			<span<?=$active['view']['normal']?>><a href="javascript:;" onclick="list_display('product_view','normal')">列表</a></span>
			<span<?=$active['view']['pic']?>><a href="javascript:;" onclick="list_display('product_view','pic')">图片</a></span>
			|&nbsp;排序方式:
			<span<?=$active['orderby']['pid']?>><a href="javascript:;" onclick="list_display('product_orderby','pid')">默认</a></span>
			<span<?=$active['orderby']['pageview']?>><a href="javascript:;" onclick="list_display('product_orderby','pageview')">浏览量</a></span>
		</div>
		<div class="product_list product_box">
<? if($list) { while($val = $list->fetch_array()) { if($view=='pic') { ?>
			<ul class="ppics">
				<li>
					<div><a href="<?php echo url("product/detail/id/{$val['pid']}"); ?>"><img src="<?=URLROOT?>/<? if($val['thumb']) { ?>
<?=$val['thumb']?>
<? } else { ?>
static/images/noimg.gif<? } ?>
" alt="<?=$val['subject']?>" /></a></div>
					<h3><a href="<?php echo url("product/detail/id/{$val['pid']}"); ?>"><?=$val['subject']?></a></h3>
					<p>
						<a href="<?php echo url("product/list/sid/{$val['sid']}"); ?>"><?=$val['name']?><? if($val['subname']) { ?>
(<?=$val['subname']?>)<? } ?>
</a><br />
						价格：<span class="font_2"><?=$val['price']?> 元</span>
					</p>
				</li>
			</ul>
<? } else { ?>
<ul class="plist">
				<div class="thumb"><a href="<?php echo url("product/detail/id/{$val['pid']}"); ?>"><img src="<?=URLROOT?>/<? if($val['thumb']) { ?>
<?=$val['thumb']?>
<? } else { ?>
static/images/noimg.gif<? } ?>
" onmouseover="tip_start(this);" /></a></div>
				<div class="info infox">
					<p class="start start<?php echo get_star($val['grade'],5);; ?>"></p>
					<h3><a href="<?php echo url("product/detail/id/{$val['pid']}"); ?>"><?=$val['subject']?></a></h3>
					<div>
						所属：<a href="<?php echo url("product/list/sid/{$val['sid']}"); ?>"><?=$val['name']?><? if($val['subname']) { ?>
(<?=$val['subname']?>)<? } ?>
</a><br />
						价格：<span class="font_2"><?=$val['price']?> 元</span><br />
					</div>
					<p>简介：<?php echo trimmed_title($val['description'],42,'...'); ?></p>
				</div>
				<div class="clear"></div>
			</ul>
			<? } } } ?>
<div class="multipage"><?=$multipage?></div>
		</div>

    </div>

    <div class="product_right">

		<div class="mainrail rail-border-3">
			<h3 class="rail-h-3 rail-h-bg-3">搜索</h3>
			<div class="product-side-search">
				<form method="get" action="<?=URLROOT?>/product.php">
					<input type="hidden" name="catid" value="<?=$catid?>" />
					<input type="text" name="keyword" class="t_input" value="<?=$keyword?>" />&nbsp;
					<button type="submit" class="button">搜索</button>
				</form>
			</div>
		</div>

        <div class="mainrail rail-border-3">
            <h3 class="rail-h-3 rail-h-bg-3">热门产品</h3>
            <ul class="product-side-list">
<?php $_QUERY['get_val']=$_G['datacall']->datacall_get('getlist',array('orderby'=>"pageview DESC",'rows'=>6,'cachetime'=>0,),'product');
if(is_array($_QUERY['get_val']))foreach($_QUERY['get_val'] as $val_k => $val) { ?>
<li>
					<dl>
						<dt><a href="<?php echo url("product/detail/id/{$val['pid']}"); ?>"><img src="<?=URLROOT?>/<? if($val['thumb']) { ?>
<?=$val['thumb']?>
<? } else { ?>
static/images/s_noimg.gif<? } ?>
" alt="<?=$val['subject']?>" /></a></dt>
						<dd>
							<span><a href="<?php echo url("product/detail/id/{$val['pid']}"); ?>"><?=$val['subject']?></a></span><br />
							价格:<span class="font_2"><?=$val['price']?> 元</span>
							<p class="start<?php echo get_star($val['grade'], 5); ?>" style="margin:0;padding:0;height:15px;"></p>
						</dd>
					</dl>
					<div class="clear"></div>
				</li>
				<div class="clear"></div><?php } ?>
            </ul>
        </div>

    </div>

	<div class="clear"></div>

</div><?php footer(); ?>