<?php
/**
* @author moufer<moufer@163.com>
* @copyright www.modoer.com
*/
!defined('IN_MUDDER') && exit('Access Denied');
define('SCRIPTNAV', 'article');

$sid = _get('sid',null,MF_INT); //主题ID
if($sid > 0) {
    $I =& $_G['loader']->model('item:subject');
    if(!$subject = $I->read($sid)) redirect('item_empty');
    $subject_field_table_tr = $I->display_listfield($subject);
    $subtitle = '<a href="">'.trim($subject['name'] . '&nbsp;' . $subject['subname']).'</a>';
} elseif($catid = (int) $_GET['catid']) {
    $_G['loader']->helper('misc','article');
    $subtitle = misc_article::category_path($catid,'&nbsp;&raquo;&nbsp;',url("article/list/catid/_CATID_"));
} else {
    $subtitle = $_GET['keyword'] ? _T($_GET['keyword']) : lang('global_all');
}

$A =& $_G['loader']->model(':article');
$category = $A->variable('category');
//投稿权限
$access_post = $user->check_access('article_post',$A,0);

if($catid && !$category[$catid]['pid']) {
    $tplname = 'article_list_root';
} else {
    $pid = $category[$catid]['pid'];
    $tplname = 'article_list_sub';
    $select = 'articleid,subject,dateline,pageview,comments,digg,uid,author,copyfrom,thumb,picture,introduce';
    $orderby = array('dateline'=>'DESC');
    $offset = $MOD['list_num'] > 0 ? $MOD['list_num'] : 10;
    $start = get_start($_GET['page'],$offset);
    $_GET['status'] = 1;
    list($total,$list) = $A->search($select,$orderby,$start,$offset);
    if($total) $multipage = multi($total, $offset, $_GET['page'], url("article/list/catid/$catid/keyword/$_GET[keyword]/sid/$sid/page/_PAGE_"));
}

$_HEAD['keywords'] = $MOD['meta_keywords'];
$_HEAD['description'] = $MOD['meta_description'];
if($subject && $subject['templateid'] && $MOD['use_itemtpl']) {
    include template('article_list', 'item', $subject['templateid']);
} else {
    include template($tplname);
}
?>