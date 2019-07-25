<?php
class Admin_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_adminList($start,$length){//管理员列表页面,输出前$length条数
        $sql = "select * from admin_info "
            ." order by create_time desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_adminCount(){//管理员总数
        $sql = "select * from admin_info";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_adminDetail($admin_id){//管理员编辑页面,传入admin_id
        $sql = "select * from admin_info where admin_id = ".$admin_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function get_adminByName($admin_name){//根据登录账号查询管理员信息
        $sql = "select * from admin_info where admin_name = '".$admin_name."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function add_adminOne($admin_name,$admin_pwd,$real_name,$status){//新增一条管理员记录
        $sql = "insert into admin_info(admin_name,admin_pwd,real_name,status"
            .")values('".$admin_name."','".$admin_pwd."','".$real_name."','".$status."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_adminOne($admin_id,$admin_name,$admin_pwd,$real_name,$status){//修改管理员信息
        $sql = "update admin_info set"
            ." admin_name='".$admin_name
            ."', admin_pwd='".$admin_pwd
            ."', real_name='".$real_name
            ."', status='".$status
            ."' where admin_id=".$admin_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_adminLoginTime($admin_id,$login_time){//修改管理员登录时间
        $sql = "update admin_info set"
            ." login_time='".$login_time
            ."' where admin_id=".$admin_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function isvalid_pwdName($admin_name,$admin_pwd){//判断登录账号，登录密码是否正确,1表示登录成功，0表示登录失败
        $sql = "select * from admin_info where admin_name = '".$admin_name."' and admin_pwd = '".$admin_pwd."'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
}
?>