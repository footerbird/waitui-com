<?php
class User_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_userList($start,$length){//用户列表页面,输出前$length条数
        $sql = "select * from user_info "
            ." limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_userCount(){//用户总数
        $sql = "select * from user_info";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_userDetail($user_id){//用户编辑页面,传入user_id
        $sql = "select * from user_info where user_id = ".$user_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
}
?>