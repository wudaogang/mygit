<?php
/**
* @author moufer<moufer@163.com>
* @copyright (c)2001-2009 Moufersoft
* @website www.modoer.com
*/
!defined('IN_MUDDER') && exit('Access Denied');

class msm_member_passport extends ms_model {

    var $table = 'dbpre_member_passport';
    var $key = 'uid';
    var $model_flag = 'member';

    function __construct() {
        parent::__construct();
        $this->modcfg = $this->variable('config');
    }

    function msm_member_passport() {
        $this->__construct();
    }

    function get_uid($type,$id) {
        $this->db->from($this->table);
        $this->db->select('uid');
        $this->db->where($type,$id);
        return $this->db->get_value();
    }

    function check_exists($uid) {
        $this->db->from($this->table);
        $this->db->where('uid',$uid);
        return $this->db->count() > 0;
    }

    function bind_exists($uid,$type,$id) {
        $this->db->from($this->table);
        $this->db->where('uid',$uid);
        $this->db->where($type,$id);
        return $this->db->count() > 0;
    }

    function bind($uid,$type,$id) {
        $exists = $this->check_exists($uid);
        $this->db->from($this->table);
        if($exists) {
            $this->db->where('uid',$uid);
        } else {
            $this->db->set('uid',$uid);
        }
        $this->db->set($type,$id);
        $exists ? $this->db->update() : $this->db->insert();
    }

    function unbind($uid,$api) {
        if(!$api) return;
        $this->loader->helper('sql');
        if(sql_exists_field(str_replace('dbpre_','',$this->table),$api)) {
            $this->db->from($this->table)
                ->where('uid', $uid)
                ->set($api,'')
                ->update();
        }
    }
}
?>