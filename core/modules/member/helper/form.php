<?php
/**
* @author moufer<moufer@163.com>
* @copyright (c)2001-2009 Moufersoft
* @website www.modoer.com
*/
function form_member_usergroup($select = '', $type = null, $multiple=null) {
	$loader =& _G('loader');
	$usergroups = $loader->variable('usergroup', 'member');
    if($type && is_string($type)) $type = array($type);
	foreach($usergroups as $key => $val) {
        if($type && !in_array($val['grouptype'],$type)) continue;
		$selected = ($multiple ? in_array($key, $select) : $key == $select) ? ' selected="selected"' : '';
		$content .= "\t<option value=\"$key\"$selected>$val[groupname]</option>\r\n";
	}
	return $content;
}

function form_member_pointgroup($select = '') {
	$loader =& _G('loader');
	$config = $loader->variable('config', 'member');
    $groups = $config['point_group'] ? unserialize($config['point_group']) : '';
    if(!$groups) return '';
	foreach($groups as $key => $val) {
        if(!$val['enabled']) continue;
		$selected = $key == $select ? ' selected' : '';
		$content .= "\t<option value=\"$key\"$selected>$val[name]</option>\r\n";
	}
	return $content;
}
?>