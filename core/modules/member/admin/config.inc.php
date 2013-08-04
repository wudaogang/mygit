<?php
/**
* @author moufer<moufer@163.com>
* @copyright www.modoer.com
*/
(!defined('IN_ADMIN') || !defined('IN_MUDDER')) && exit('Access Denied');

$C =& $_G['loader']->model('config');

if($_POST['dosubmit']) {

    $_POST['modcfg']['passport_list'] = $_POST['modcfg']['passport_list'] ? implode(',',$_POST['modcfg']['passport_list']) : '';
	$C->save($_POST['modcfg'], MOD_FLAG);
    redirect('global_op_succeed', cpurl($module, $act, 'config'));

} else {

    $modcfg = $C->read_all(MOD_FLAG);
    $modcfg['passport_list'] = $modcfg['passport_list'] ? explode(',', $modcfg['passport_list']) : array();
    $admin->tplname = cptpl('config', MOD_FLAG);
}
?>