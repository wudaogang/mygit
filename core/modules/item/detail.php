<?php
/**
* @author moufer<moufer@163.com>
* @copyright www.modoer.com
*/
!defined('IN_MUDDER') && exit('Access Denied');

$I =& $_G['loader']->model(MOD_FLAG.':subject');
//随便看看
if(_get('random',null)) {
    $where = array();
    if(!$detail = $I->read_random($where)) redirect('item_random_empty');
    location(url("item/detail/id/$detail[sid]"));
}

if($sid = (int) $_GET['sid']) {
    unset($_GET['id'],$_GET['name']);
} elseif($sid = (int) $_GET['id']) {
    unset($_GET['id'],$_GET['name']);
    $_GET['sid'] = $sid;
} elseif($domain = _T($_GET['name'])) {
    //如果来路domain是act行为列表里的，则跳转到对应act页面
    if(in_array($domain, $acts)) location(url("item/$domain",'',1,1));
    unset($_GET['id'],$_GET['name']);
}

if(!$sid && !$domain) redirect(lang('global_sql_keyid_invalid', 'id'));
$id = $sid;

//取得主题信息
if($sid) {
    $detail = $I->read($sid);
} else {
    $_G['fullalways'] = TRUE;
    //域名合法性检测
    if(!$I->domain_check($domain)) redirect(lang('global_sql_keyid_invalid', 'id'));
    if($detail = $I->read($domain,'*',TRUE,TRUE)) {
        $_GET['sid'] = $id = $sid = (int)$detail['sid'];
    } else {
        http_404();
        //location($_G['cfg']['siteurl']);
    }
}
if(!$detail||!$detail['status']) redirect('item_empty');
define('SCRIPTNAV', 'item_'.$detail['pid']);

//主题管理员标记
$is_owner = $detail['owner'] == $user->username;

$category = $I->get_category($detail['catid']);
if(!$pid = $category['catid']) {
    redirect('item_cat_empty');
}
$modelid = $I->category['modelid'];
$rogid = $I->category['review_opt_gid'];

//取得分类、模型、点评项以及地区信息
$catcfg =& $category['config'];
if(!$model = $I->get_model($modelid)) redirect('item_model_empty');
if($model['usearea']) $area = $I->loader->variable('area');

$R =& $_G['loader']->model(':review');
$reviewpot = $R->variable('opt_' . $rogid);

$urlpath = array();
$pcat = $I->variable('category');
$urlpath[] = url_path($I->category['name'], url("item/list/catid/$pid"));
$category = $_G['loader']->variable('category_'.$I->category['catid'], 'item');
if($category[$detail['catid']]['level'] > 2) {
    $urlpath[] = url_path($category[$category[$detail['catid']]['pid']]['name'], url("item/list/catid/{$detail['pid']}"));
}
if($detail['catid']!=$detail['pid']) $urlpath[] = url_path($category[$detail[catid]]['name'], url("item/list/catid/$detail[catid]"));

define('SUBJECT_CATID', $detail['pid']);
//生成表格内容
$detail_custom_field = $I->display_detailfield($detail);
//前台不显示字段去除
$fields = $I->variable('field_' . $modelid);
foreach($fields as $fd) {
    if(!$fd['show_detail'] && $fd['fieldname']=='content') unset($detail[$fd['fieldname']]);
}

//载入标签
$taggroups = $_G['loader']->variable('taggroup','item');
//增加浏览量
if(!$detail['owner'] || $detail['owner'] && $detail['owner'] != $user->username) $I->pageview($sid);
//加入COOKIE
$I->write_cookie($detail);

//显示点评或留言
$views = array('review','guestbook');
$view = $_GET['view'] = in_array($_GET['view'], $views) ? $_GET['view'] : 'review';

if($view == 'review') {
    if($detail['reviews'] > 0) {
        $review_filter = 'all';
        $review_orderby = 'posttime';
        //取得点评数据
        $where = array();
        $where['idtype'] = 'item_subject';
        $where['id'] = $sid;
        $where['status'] = 1;
        $orderby = array('posttime'=>'DESC');

        $offset = $MOD['review_num'] > 0 ? $MOD['review_num'] : 10;
        $start = get_start($_GET['page'], $offset);
        $select = 'r.*,m.point,m.coin,m.groupid';

        list(,$reviews) = $R->find($select, $where, $orderby, $start, $offset, FALSE, FALSE, TRUE);

        $onclick = "get_review('item_subject',$sid,'all','$review_orderby',{PAGE})";
        $multipage = multi($detail['reviews'], $offset, $_GET['page'], url("item/detail/id/$sid/view/review/page/_PAGE_"), '#review', $onclick);
    }
    //点评行为检测
    $review_access = $I->review_access($detail);
    $review_enable = $review_access['code'] == 1;

} elseif($view == 'guestbook' && $detail['guestbooks'] > 0) {
    //取得留言数据
    $GB =& $_G['loader']->model(MOD_FLAG.':guestbook');
    $where = array();
    $where['sid'] = $sid;
    $where['status'] = 1;
    $orderby = array('dateline'=>'DESC');
    $offset = $MOD['guestbook_num'] > 0 ? $MOD['guestbook_num'] : 10;
    $start = get_start($_GET['page'], $offset);
    list(,$guestbooks) = $GB->find($select, $where, $orderby, $start, $offset, FALSE);
    $onclick = "get_guestbook($sid,{PAGE})";
    $multipage = multi($detail['guestbooks'], $offset, $_GET['page'], SELF.'?sid='.$sid.'&view=guestbook','#guestbook',$onclick);
}

$_HEAD['keywords'] = $category['name'] . ',' . $pcat[$detail[catid]]['name'] . ',' . $catcfg['meta_keywords'];
$_HEAD['description'] = trimmed_title(strip_tags(str_replace("\r\n",'',$detail['content'])), 100) . ',' . $catcfg['meta_description'];

//分类设置默认风格
if($catcfg['templateid'] && !$detail['templateid']) {
    $detail['templateid'] = $catcfg['templateid'];
}

$seo_tags = get_seo_tags();
$seo_tags['root_category_name'] = display('item:category',"catid/$detail[pid]");
$seo_tags['current_category_name'] = display('item:category',"catid/$detail[catid]");
$seo_tags['name'] = $detail['name'] . ($detail['subname']?"($detail[subname])":'');
$seo_tags['description'] = $detail['description'];
$seo_tags['content'] = trimmed_title(strip_tags(str_replace("\r\n",'',$detail['content'])),100);

!$MOD['seo_detail_title'] && $MOD['seo_detail_title'] = '{name}'.$_G['cfg']['titlesplit'].'{site_name}';
!$MOD['seo_detail_keywords'] && $MOD['seo_detail_keywords'] = '{root_category_name},{current_category_name},'.$catcfg['meta_keywords'];
!$MOD['seo_detail_description'] && $MOD['seo_detail_description'] = '{content},'.$catcfg['meta_description'];

$_HEAD['title'] = parse_seo_tags($MOD['seo_detail_title'], $seo_tags);
$_HEAD['keywords'] = parse_seo_tags($MOD['seo_detail_keywords'], $seo_tags);
$_HEAD['description'] = parse_seo_tags($MOD['seo_detail_description'], $seo_tags);

$_G['show_sitename'] = FALSE;

if($detail['templateid']) {
    include template('index', 'item', $detail['templateid']);
} else {
    //载入模型的内容页模板
    include template($I->model['tplname_detail']);
}