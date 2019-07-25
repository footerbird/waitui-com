<?php
class Butler_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_butlerList($start,$length){//管家列表页面,输出前$length条数
        $sql = "select * from butler_info "
            ." order by create_time desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_butlerCount(){//管家总数
        $sql = "select * from butler_info";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_butlerDetail($butler_id){//管家编辑页面,传入butler_id
        $sql = "select * from butler_info where butler_id = ".$butler_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function get_butlerByName($butler_name){//根据昵称查询管家信息
        $sql = "select * from butler_info where butler_name = '".$butler_name."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function add_butlerOne($butler_name,$real_name,$butler_phone,$butler_qq,$butler_wechat,$status){//新增一条管家记录
        $sql = "insert into butler_info(butler_name,real_name,butler_phone,butler_qq,butler_wechat,status"
            .")values('".$butler_name."','".$real_name."','".$butler_phone."','".$butler_qq."','".$butler_wechat."','".$status."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_butlerOne($butler_id,$butler_name,$real_name,$butler_phone,$butler_qq,$butler_wechat,$status){//修改管家信息
        $sql = "update butler_info set"
            ." butler_name='".$butler_name
            ."', real_name='".$real_name
            ."', butler_phone='".$butler_phone
            ."', butler_qq='".$butler_qq
            ."', butler_wechat='".$butler_wechat
            ."', status='".$status
            ."' where butler_id=".$butler_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>