<?php
/**
* user register
* @author moufer<moufer@163.com>
* @copyright Moufer Studio(www.modoer.com)
*/
!defined('IN_MUDDER') && exit('Access Denied');
define('SCRIPTNAV', 'reg');

if($user->isLogin) redirect('member_reg_logined');

$forward = $_GET['forward'] ? $_GET['forward'] : $_G['cfg']['siteurl'];
if(strposex($forward,'op=logout') || !strposex($forward, $_G['web']['domain'])) {
    $forward = $_G['cfg']['siteurl'];
}
$forward = _T(rawurldecode(rawurldecode($forward)));

$_G['loader']->helper('validate');
switch($_GET['op']) {
case 'check_username':
    if(!$username = trim($_POST['username'])) {
        echo lang('member_reg_ajax_name_empty'); exit;
    }
    if($_G['charset'] != 'utf-8') {
        $_G['loader']->lib('chinese', NULL, FALSE);
        $CHS = new ms_chinese('utf-8', $_G['charset']);
        $username = _T($CHS->Convert($username));
    }
    $user->check_username($username, true);
    if($user->check_username_exists($username)) {
        echo lang('member_reg_ajax_name_exists');
        exit;
    }
    echo lang('member_reg_ajax_name_normal'); exit;
    break;
case 'check_email':
    if(!$email = trim($_POST['email'])) {
        echo lang('member_reg_ajax_email_empty'); exit;
    }
    if(!validate::is_email($email)) {
        echo lang('member_reg_ajax_email_invalid'); exit;
    }
    if(!$MOD['existsemailreg'] && $user->check_email_exists($email)) {
        echo lang('member_reg_ajax_email_exists');
        exit;
    }
    echo lang('member_reg_ajax_email_normal'); exit;
    break;
case 'reg':
    break;
default:
    break;
}

if($user->passport['enable']) {
    location($user->passport['reg_url']);
    exit;
}

if($MOD['closereg']) redirect('member_reg_closed');

if($_POST['dosubmit']) {

    if($MOD['seccode_reg']) check_seccode($_POST['seccode']);
    $sync = $user->register($user->get_post($_POST));
    redirect(lang('member_reg_succeed') . $sync, $forward);

} else {

    $passport_type = _get('passport', '', MF_TEXT);
    if($passport_type == 'weibo') {
        if(!$MOD['passport_login'] || $MOD['passport_weibo']) redirect('member_passport_enable');
        include_once MUDDER_ROOT . 'api' . DS . 'saetv2.ex.class.php';
        $c = new SaeTClientV2($MOD['passport_weibo_appkey'], $MOD['passport_weibo_appsecret'],
            $_G['cookie']['passport_weibo_oauth_token']);
        //$ms  = $c->home_timeline(); // done
        $uid_get = $c->get_uid();
        $uid = $uid_get['uid'];
        $me = $c->show_user_by_id($uid);//userinfo
        if(strtoupper($_G['charset']) != 'UTF-8') {
            $_G['loader']->lib('chinese', NULL, FALSE);
            $CHS = new ms_chinese('utf-8', $_G['charset']);
            foreach($me as $k => $v) {
                if(is_string($v)) $me[$k] = $CHS->Convert($v);
            }
        }
        $passport = true;
        $username = $me['screen_name'];
        $passport_id = $me['id'];
    }

    if($passport) {
        $PT =& $_G['loader']->model('member:passport');
        if($uid = $PT->get_uid($passport_type, $passport_id)) {
            $sync = $user->login_passport($uid);
            redirect(lang('member_login_succeed') . $sync, url("member/index"));
        }
        $typename = lang('member_passport_type_'. $passport_type);
        $title = lang('member_passport_reg', array($typename, $username, $typename));
    }

    $subtitle = lang('member_reg_title');
    require_once template('member_reg');
		
}
?>