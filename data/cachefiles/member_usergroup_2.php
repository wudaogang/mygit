<?php
!defined('IN_MUDDER') && exit('Access Denied');
return array (
  'groupid' => '2',
  'grouptype' => 'system',
  'groupname' => '禁止访问',
  'point' => '0',
  'color' => '#808080',
  'access' => 
  array (
    'member_forbidden' => '1',
    'item_subjects' => '-1',
    'item_reviews' => '-1',
    'item_pictures' => '-1',
    'comment_disable' => '1',
  ),
); 
?>