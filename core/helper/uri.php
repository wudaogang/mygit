<?php
/**
* @author moufer<moufer@163.com>
* @copyright www.modoer.com
*/
!defined('IN_MUDDER') && exit('Access Denied');

function uri_path() {
}

function uri_html($module='modoer', $scriptname='', $param='', $au='', $full = FALSE, $no_rewrite = FALSE) {
    global $_G;

    $_modules =& _G('modules');

    if(defined('IN_AJAX')) $full = TRUE;
    if($_G['fullalways']) $full = TRUE;

    static $instance = array();
    if(!defined("IN_ADMIN") && !empty($_G['mod'])) {
        $cmod =& _G('mod');
        //$current_empty_dir = empty($cmod['directory']);
        $current_empty_dir = TRUE;
    }

    $siteurl = _G('cfg', 'siteurl');
    $empty_dir = TRUE;
    //$empty_dir = !isset($_modules[$module]) || empty($_modules[$module]['directory']);
    $fullrooturl = $siteurl . (!$empty_dir ? $_modules[$module]['directory'] . '/' : '');
    $rooturl = !$empty_dir ? ($_modules[$module]['directory'] . '/') : '';

    if(isset($cmod) && $cmod['flag'] == $module) {
        $urlpre = $full ? $fullrooturl : '';
    } elseif(isset($cmod)) {
        $urlpre = $full ? $fullrooturl : ((!$current_empty_dir ? '../' : '') . $rooturl);
    } else {
        $urlpre = $full ? $fullrooturl : $rooturl;
    }

    if($empty_dir && ($module != 'modoer' || !$module)) {
        if(!$param) $param = array();
        if($scriptname && is_array($param)) {
            array_unshift($param, array('act' => $scriptname));
        } elseif($scriptname && is_string($param)) {
            $param = 'act=' . $module . ($param ? ('&' . $param) : '');
        }
        $scriptname = $module;
    }

    $scriptname && $scriptname .= '.php';

    if(is_array($param) && $param) {
        $paramstr = $scriptname . '?' . http_query($param,0,!$no_rewrite);
    } elseif(is_string($param) && $param) {
        $paramstr = $scriptname .'?' . $param;
    } else {
        $paramstr = $scriptname;
    }

    if(!$no_rewrite && _G('cfg','rewrite') && $paramstr) {
        if(preg_match("/^([a-z0-9_]+)\.php$/i", $paramstr, $match)) {
            $paramstr = $match[1].'.html';
        } elseif($empty_dir) {
            $paramstr = str_replace(array('.php?act=','&','='),'-', $paramstr) . '.html';
        } else {
            $paramstr = str_replace(array('.php?','&','='),'-', $paramstr) . '.html';
        }
    }
	$austr = '';
    $au && $austr = '#' . $au;
    return $urlpre . $paramstr . $austr;
}
