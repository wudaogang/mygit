<? !defined('IN_MUDDER') && exit('Access Denied'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=<?=$_G['charset']?>" />
<script type="text/javascript" language="javascript" src="<?=$_CFG['mapapi']?>"<? if($_CFG['mapapi_charset']) { ?>
 charset="<?=$_CFG['mapapi_charset']?>"<? } ?>
></script>
<script type="text/javascript">
var map_id = 'mymap';
var p1 = '<?=$p1?>';
var p2 = '<?=$p2?>';
var mark = 'mark';
var show = '<?=$show?>';
var title = '<?=$title?>';
var content = '<?=$content?>';
var width = <?=$width?>;
var height = <?=$height?>;
var view_level = <?=$level?>;
</script>
</head>
<body style="margin:0;">
<div id="mymap" style="width:<?=$width?>px; height:<?=$height?>px; float:left;"><center style="margin-top:10px;">loading...</center></div>
<input type="button" onclick="markmap();" id="markbtn" style="display:none;" />
<input type="hidden" id="point1" value='' />
<input type="hidden" id="point2" value='' />
<script type="text/javascript" language="javascript" src="<?=URLROOT?>/static/javascript/map/<?=$mapflag?>.js?v=<?=$version?>"></script>
</body>
</html>