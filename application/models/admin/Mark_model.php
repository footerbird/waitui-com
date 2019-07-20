<?php
class Mark_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_markList($category,$start,$length){//商标列表页面,传入mark_category,如'15',输出前$length条数
        if($category == ''){
            $sql = "select * from mark_info "
                ." limit ".$start.",".$length;
        }else{
            $sql = "select * from mark_info "
                ." where mark_category = ".$category." limit ".$start.",".$length;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_markCount($category){//在售商标总数
        $sql = "select * from mark_info";
        if($category != ""){
            $sql = $sql." where mark_category = '".$category."'";
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_markDetail($mark_regno){//商标详情页面,传入mark_regno
        $sql = "select * from mark_info where mark_regno = '".$mark_regno."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function get_categoryName($category_id){//根据商标大类获取商标大类名称
        $sql = "select * from mark_category where category_id = ".$category_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function edit_markPrice($mark_regno,$mark_price){//改变商标价格
        $sql = "update mark_info set"
            ." mark_price=".$mark_price
            ." where mark_regno=".$mark_regno;
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>