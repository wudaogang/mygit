<?php
/**
* user login
* @author moufer<moufer@163.com>
* @package modoer
* @copyright Moufer Studio(www.modoer.com)
*/
!defined('IN_MUDDER') && exit('Access Denied');
define('SCRIPTNAV', 'login');

$op = _get('op');
$forward = $_GET['forward'] ? _T(base64_decode(rawurldecode($_GET['forward']))) : get_forward(url('member/index'));
if(strposex($forward,'logout') || strposex($forward,'login') || !strposex($forward, $_G['web']['domain'])) {
    $forward = $_G['cfg']['siteurl'];
}

switch($op) {
case 'forget':
    if($user->isLogin) redirect('member_login_logined');
    if(check_submit('dosubmit')) {
        $user->forget($_POST['username'], $_POST['email']);
        redirect('member_forget_mail_succeed', url('member/login'));
    } else {
        require_once template('member_forget');
    }
    break;
case 'updatepw':
    if($user->isLogin) redirect('member_login_logined');
    if(check_submit('dosubmit')) {
        $user->update_password((int)$_POST['getpwid'], _T($_POST['secode']), trim($_POST['newpassword']), trim($_POST['newpassword2']));
        redirect('member_getpassword_succeed', url('member/login'));
    } else {
        $getpwid = _get('id', null, MF_INT_KEY);
        $secode = _get('sec', null, MF_TEXT);
        $uid = $user->check_getpassword($getpwid, $secode);
        if(!$member = $user->read($uid, false, 'uid,username,groupid')) redirect('member_getpassword_username_empty');
        require_once template('member_forget');
    }
    break;
case 'logout':
    $sync = $user->logout();
    redirect(lang('global_op_succeed') . $sync, $forward);
    break;
case 'check':

    if(defined('IN_AJAX')) {
        $search = array('"',"\r\n","\r","\n","\n\r");
        $replace = array('\\"',"{LF}","{LF}","{LF}","{LF}");
        if($user->isLogin) {
            echo '{ type:"login",username:' . '"' . str_replace($search, $replace, $user->username) . '",newmsg:"'.$user->newmsg.'" }';
        } elseif($_G['cookie']['activationauth'] && $_G['cookie']['username']) {
            echo '{ type:"activationauth",username:' . '"' . str_replace($search, $replace, $_G['cookie']['username']) . '" }';
        } else {
            echo '';
        }
        output();
    }
    break;
case 'login':
    if($user->isLogin) location(url('member/index'));//redirect('member_login_logined');
	if($user->passport['enable']) location($user->passport['login_url']);
    if(!$_POST['onsubmit']) location(url('member/login'));
    if($MOD['seccode_login']) check_seccode($_POST['seccode']);
    if(!$sync = $user->login($_POST['username'], $_POST['password'], $_POST['life'])) {
        redirect('member_login_lost');
    }
    $url = get_forward(url('member/index'),1);
    if(strpos($url,'reg')||strpos($url,'login')) $url = url('member/index');
    redirect(lang('member_login_succeed') . $sync, $url);
    break;
case 'passport_login':
    switch(_get('type',null,MF_TEXT)) {
        case 'weibo':
            if(!$MOD['passport_login'] || $MOD['passport_weibo']) redirect('member_passport_enable');
            include_once MUDDER_ROOT . 'api' . DS . 'saetv2.ex.class.php';
            $o = new SaeTOAuthV2($MOD['passport_weibo_appkey'], $MOD['passport_weibo_appsecret']);
            $callbackurl = str_replace('&amp;','&',url("member/login/op/passport_callback/type/weibo",'',1,1));
            $aurl = $o->getAuthorizeURL( $callbackurl );
            location($aurl);
            break;
        default:
            redirect('global_op_unkown');
    }
case 'passport_callback':
    switch(_get('type')) {
        case 'weibo':
            if(!$MOD['passport_login'] || $MOD['passport_weibo']) redirect('member_passport_enable');
            include_once MUDDER_ROOT . 'api' . DS . 'saetv2.ex.class.php';
            $o = new SaeTOAuthV2($MOD['passport_weibo_appkey'], $MOD['passport_weibo_appsecret']);
            $keys = array();
            $keys['code'] = $_REQUEST['code'];
            $keys['redirect_uri'] = str_replace('&amp;','&',url("member/login/op/passport_callback/type/weibo",'',1,1));
            try {
                $token = $o->getAccessToken( 'code', $keys );
            } catch (OAuthException $e) {}
            if($token) {
                set_cookie('passport_weibo_oauth_token', $token['access_token'], 3600*24);
                $c = new SaeTClientV2($MOD['passport_weibo_appkey'], $MOD['passport_weibo_appsecret'],
                $token['access_token']);
                //$ms = $c->home_timeline(); // done
                $uid_get = $c->get_uid();
                $uid = $uid_get['uid'];
                $me = $c->show_user_by_id($uid); // userinfo
                $passport_id = $me['id'];
            } else {
                redirect('member_passport_lost');
            }
            break;
        default:
            redirect('global_op_unkown');
    }

    $message = lang('member_passport_succeed');
    $PT =& $_G['loader']->model('member:passport');
    if(!$passport_id) {
        $message = lang('member_passport_test_access');
    } elseif($uid = $PT->get_uid(_get('type'), $passport_id)) {
        $url = url("member/index");
        $sync = $user->login_passport($uid);
    } else {
        $url = url("member/reg/passport/"._get('type'), '', 1);
    }
    redirect($message . $sync, $url);
    break;
case 'passport_bind':
    $passport_type = _get('passport');
    switch($passport_type) {
        case 'weibo':
            if(!$MOD['passport_login'] || $MOD['passport_weibo']) redirect('member_passport_enable');
            include_once MUDDER_ROOT . 'api' . DS . 'saetv2.ex.class.php';
            $c = new SaeTClientV2($MOD['passport_weibo_appkey'], $MOD['passport_weibo_appsecret'],
                $_G['cookie']['passport_weibo_oauth_token']);
            //$ms  = $c->home_timeline(); // done
            $uid_get = $c->get_uid();
            $uid = $uid_get['uid'];
            $me = $c->show_user_by_id($uid); // userinfo
            if(strtoupper($_G['charset']) != 'UTF-8') {
                $_G['loader']->lib('chinese', NULL, FALSE);
                $CHS = new ms_chinese('utf-8', $_G['charset']);
                foreach($me as $k => $v) {
                    if(is_string($v)) $me[$k] = $CHS->Convert($v);
                }
            }
            $username = $me['screen_name'];
            $passport_id = $me['id'];
            break;
    }

    if(!$username||!$passport_id) redirect('member_passport_bind_invalid');

    $PT =& $_G['loader']->model('member:passport');
    if($uid = $PT->get_uid($passport_type, $passport_id)) redirect('member_passport_bind');

    $typename = lang('member_passport_type_'. $passport_type);
    $title = lang('member_passport_login', array($typename, $username, $_G['sitename']));

    $passport = true;
    $subtitle = lang('member_login_title');
    require_once template('member_login');
    break;
default:
    if($user->isLogin) redirect('member_login_logined');
	if($user->passport['enable']) location($user->passport['login_url']);
    $subtitle = lang('member_login_title');
    require_once template('member_login');
}
?>
