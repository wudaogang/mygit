<?php
/**
* ===========================================
* Project: Modoer(Mudder)
* Version: 2.6
* Time: 2007-7-17 @ Create
* Copyright (c) 2007 - 2011 Moufer Studio
* Website: http://www.modoer.com
* Developer: 林仕君(Moufer)
* E-mail: moufer@163.com
* ===========================================
*
* @author moufer<moufer@163.com>
* @copyright Moufer Studio(www.modoer.com)
*/
 
if(!is_file(dirname(__FILE__).'/data/install.lock')) {
    exit('<a href="install.php">Unsure whether the system of Modoer has been installed or not.</a><br /><br />If it has already been installed,under the folder of ./data , please create a new empty file named as "install.lock".');
}

//application init
require dirname(__FILE__).'/core/init.php';
if($_G['cfg']['index_module'] && !isset($_GET['m']) && !isset($_GET['act'])) {
    $m = _get('m', null, '_T');
    if(!$m || !preg_match("/^[a-z]+$/", $m)) {
        $m = $_G['cfg']['index_module'];
    } else {
        $m = 'index';
    }
} else {
    $m = _get('m', 'index', '_T');
}

if($m && $m != 'index') {

    if(check_module($m)) {
        $f = $m . DS . 'common.php';
        if(!file_exists(MUDDER_MODULE . $f)) show_error(lang('global_file_not_exist', ('./core/modules/' . $f)));
        include MUDDER_MODULE . $f;
    } else {
        http_404();
    }

} else {
    $_G['m'] = $m = 'index';
    $acts = array('ajax','map','seccode','js','search','announcement','city','upload');
    if(isset($_GET['act']) && in_array($_GET['act'], $acts)) {
        include MUDDER_CORE  . 'modules' . DS . 'modoer' . DS . $_GET['act'] . '.php';
        exit;
    } elseif(!$_GET['act'] || $_GET['act'] == 'index') {
        //page name
        define('SCRIPTNAV', 'index');
        //load template
        include template('modoer_index');
    } else {
        http_404();
    }

}
?>