<?php
class Mark_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_markList($keyword,$filter_category,$is_onsale,$user_id,$start,$length){//商标列表页面,输出前$length条数,筛选条件(关键词,商标类别,出售状态,用户编号)
        $sql = "select * from mark_info"
            ." where 1 = 1 ";
        if($keyword != ""){
            $sql = $sql." and concat(mark_regno,mark_name,app_range) like '%".$keyword."%'";
        }
        if($filter_category != ""){
            $sql = $sql." and mark_category = ".$filter_category;
        }
        if($is_onsale != ""){
            $sql = $sql." and is_onsale = '".$is_onsale."'";
        }
        if($user_id != ""){
            $sql = $sql." and mark_userid = ".$user_id;
        }
        $sql = $sql." limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_markCount($keyword,$filter_category,$is_onsale,$user_id){//在售商标总数,筛选条件(关键词,商标类别,出售状态,用户编号)
        $sql = "select * from mark_info"
            ." where 1 = 1 ";
        if($keyword != ""){
            $sql = $sql." and concat(mark_regno,mark_name,app_range) like '%".$keyword."%'";
        }
        if($filter_category != ""){
            $sql = $sql." and mark_category = ".$filter_category;
        }
        if($is_onsale != ""){
            $sql = $sql." and is_onsale = '".$is_onsale."'";
        }
        if($user_id != ""){
            $sql = $sql." and mark_userid = ".$user_id;
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_markCategory(){//商标页面,输出商标大类信息
        $sql = "select * from mark_category "
            ." order by category_id asc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_markDetail($regno_md){//商标详情页面,传入regno_md
        $sql = "select * from mark_info where regno_md = '".$regno_md."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function get_categoryName($category_id){//根据商标大类获取商标大类名称
        $sql = "select * from mark_category where category_id = ".$category_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function edit_markPrice($regno_md,$is_onsale,$mark_price){//改变商标价格
        $sql = "update mark_info set"
            ." is_onsale='".$is_onsale
            ."', mark_price='".$mark_price
            ."' where regno_md='".$regno_md."'";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_userMarkOne($user_id,$mark_regno,$is_onsale,$mark_price){//给商标分配用户,一标多类的多个商标分配给同一个用户,所以用mark_regno
        $sql = "update mark_info set"
            ." mark_userid=".$user_id
            .", is_onsale='".$is_onsale
            ."', mark_price='".$mark_price
            ."' where mark_regno='".$mark_regno."'";
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>