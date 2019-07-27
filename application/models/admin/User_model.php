<?php
class User_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_userList($keyword,$user_id,$start,$length){//用户列表页面,输出前$length条数,筛选条件(关键词,用户编号)
        $sql = "select * from user_info"
            ." where 1 = 1 ";
        if($keyword != ""){
            $sql = $sql." and concat(user_phone,user_name) like '%".$keyword."%'";
        }
        if($user_id != ""){
            $sql = $sql." and user_id = ".$user_id;
        }
        $sql = $sql." limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_userCount($keyword,$user_id){//用户总数,筛选条件(关键词,用户编号)
        $sql = "select * from user_info"
            ." where 1 = 1 ";
        if($keyword != ""){
            $sql = $sql." and concat(user_phone,user_name) like '%".$keyword."%'";
        }
        if($user_id != ""){
            $sql = $sql." and user_id = ".$user_id;
        }
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