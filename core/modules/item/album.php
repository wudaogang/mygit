<?php
/**
* @author moufer<moufer@163.com>
* @copyright www.modoer.com
*/
!defined('IN_MUDDER') && exit('Access Denied');
define('SCRIPTNAV', 'item_album');

$A =& $_G['loader']->model('item:album');
$op = _input('op',null,'_T');
$albumid = _input('id',null,MF_INT_KEY);
$picid = _input('picid',null,MF_INT_KEY);
$sid = _input('sid',null,MF_INT_KEY);
$catid = _input('catid',null,MF_INT_KEY);
$urlpath = array();

if($albumid > 0 || $picid > 0) {

    if($picid > 0) {
        $IP =& $_G['loader']->model('item:picture');
        $pic = $IP->read($picid);
        $albumid = $pic['albumid'];
    }
	if(!$detail = $A->read($albumid)) redirect('item_album_empty');
	$S =& $_G['loader']->model('item:subject');
    if(!$subject = $S->read($detail['sid'])) redirect('item_empty');

	$P =& $_G['loader']->model('item:picture');
	$where = array();
	$where['albumid'] = $albumid;
	list($total, $list) = $P->find('*', $where, array('addtime'=>'DESC'), 0, 0, 1);
	if(!$total) redirect('item_picture_empty');

    $A->pageview($albumid);
	$urlpath[] = url_path($subject['name'].($subject['subname']?"($subject[subname])":''), url("item/detail/id/$subject[sid]"));
	$urlpath[] = url_path(lang('item_album_title'), url("item/album/sid/$subject[sid]"));
	$urlpath[] = url_path($detail['name'], url("item/album/id/$detail[albumid]"));

    $subject_field_table_tr = $S->display_listfield($subject);

	$_HEAD['keywords'] = $MOD['meta_keywords'];
	$_HEAD['description'] = $MOD['meta_description'];

	if($subject['templateid']) {
		include template('pic', 'item', $subject['templateid']);
	} else {
		include template('item_pic');
	}

} elseif($sid > 0) {

    if($op == 'selectpic') {
        $_G['in_ajax'] = 1;
        $where = array();
        $where['sid'] = (int) $_GET['sid'];
        $page = (int)$_GET['page'];
        $offset = 6;
        $start = get_start($page, $offset);
		$P =& $_G['loader']->model('item:picture');
        list($total, $list) = $P->find('picid,thumb', $where, array('addtime'=>'DESC'), $start, $offset);
        if($total) {
            echo '<table width="100%">';
            $i = 0;
            while($value = $list->fetch_array()) {
                $i++;
                if($i % 3 == 1) echo '<tr>';
                echo '<td width="125"><img src="'.URLROOT.'/'.$value['thumb'].'" width="120" onclick="insert_subject_thumb(\''.$value['thumb'].'\');" style="cursor:pointer;" /></td>';
                if($i % 3 == 0) echo '</tr>';
            }
            if($x = $i % 3) {
                echo str_repeat('<td width="125">&nbsp;</td>', (3 - $x));
                echo '</tr>';
            }
            echo '</table><br /><center>';
            if($page > 1) echo '<a href="javascript:select_subject_thumb('.$where[sid].','.($page-1).');">&lt;&lt;</a>&nbsp;&nbsp;&nbsp;&nbsp;';
            if($start + $offset < $total) echo '<a href="javascript:select_subject_thumb('.$where[sid].','.($page+1).');">&gt;&gt;</a>';
            echo '</center>';
        }
		output();
	}

	$S =& $_G['loader']->model('item:subject');
	if(!$subject = $S->read($sid)) redirect('item_empty');

	$where = array();
	$where['sid'] = $sid;
	list($total, $list) = $A->find('*',$where,array('lastupdate'=>'DESC'),0, 0, 1);

	$urlpath[] = url_path($subject['name'].($subject['subname']?"($subject[subname])":''), url("item/detail/id/$subject[sid]"));
	$urlpath[] = url_path(lang('item_album_title'), url("item/album/sid/$subject[sid]"));

	$subject_field_table_tr = $S->display_listfield($subject);

	$_HEAD['keywords'] = $MOD['meta_keywords'];
	$_HEAD['description'] = $MOD['meta_description'];

	if($subject['templateid']) {
		include template('album', 'item', $subject['templateid']);
	} else {
		include template('item_subject_album');
	}

} else {

	$category = $_G['loader']->variable('category','item');
	$urlpath[] = url_path(lang('item_album_title'), url("item/album"));
	if($catid > 0) $urlpath[] = url_path($category[$catid]['name'], url("item/allpic/catid/$pid"));

	$where = array();
	$keyword = _get('keyword',null,'_T');
	if($keyword) $where['a.name'] = array('where_like',array("%$keyword%"));
	if($catid > 0) $where['s.pid'] = (int) $catid;
	$where['num'] = array('where_more',array(1));

	$orderby = _cookie('list_display_item_album_orderby','normal','_T');
	$orderby_arr = array(
		'normal'=>array('albumid'=>'ASC'),
		'pageview'=>array('pageview'=>'DESC'),
		'num'=>array('num'=>'DESC'),
	);
	!isset($orderby_arr[$orderby]) and $orderby='normal';

	$offset = 16;
	$start = get_start($_GET['page'], $offset);

	list($total, $list) = $A->find('a.*', $where, $orderby_arr[$orderby], $start, $offset, TRUE, 's.name as sname,s.subname,s.pid');
	if($total) {
		$multipage = multi($total, $offset, $_GET['page'], url("item/album/catid/$catid/keyword/$keyword/page/_PAGE_"));
	}

    if($keyword) $urlpath[] = url_path(lang('item_album_search',$keyword),null);

	$active = array();
	$active['cate'][(int)$catid] = ' class="selected"';
	$active['view'][$view] = ' class="selected"';
	$active['orderby'][$orderby] = ' class="selected"';

	$tplname = 'item_album_list';

	$_HEAD['keywords'] = $MOD['meta_keywords'];
	$_HEAD['description'] = $MOD['meta_description'];
	include template('item_album_list');
}

?>