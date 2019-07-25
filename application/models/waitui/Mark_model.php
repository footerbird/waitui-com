<?php
class Mark_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_markList($category,$start,$length){//商标列表页面,传入mark_category,如'15',输出前$length条数
        if($category == ''){
            $sql = "select * from mark_info "
                ." where is_onsale = 'sale' limit ".$start.",".$length;
        }else{
            $sql = "select * from mark_info "
                ." where is_onsale = 'sale' and mark_category = ".$category." limit ".$start.",".$length;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_markCount($category){//在售商标总数
        $sql = "select mark_regno from mark_info where is_onsale = 'sale' ";
        if($category != ""){
            $sql = $sql." and mark_category = '".$category."'";
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
    
    public function get_markSearch($keyword,$start,$length,$sort,$filter_category,$filter_type,$filter_price,$filter_length){//商标搜索列表页面,输出前$length条数
        $sql = "select * from mark_info "
            ." where is_onsale = 'sale' and concat(mark_regno,mark_name,app_range) like '%".$keyword."%'";
        if($filter_category != ""){
            $sql = $sql." and mark_category = ".$filter_category;
        }
        if($filter_type != ""){
            $sql = $sql." and mark_type = '".$filter_type."'";
        }
        if($filter_price != "" && count(explode("-", $filter_price)) == 2){
            $filter_price_arr = explode("-", $filter_price);
            $sql = $sql." and mark_price >= ".$filter_price_arr[0]." and mark_price < ".$filter_price_arr[1];
        }
        if($filter_length != "" && count(explode("-", $filter_length)) == 2){
            $filter_length_arr = explode("-", $filter_length);
            $sql = $sql." and mark_length >= ".$filter_length_arr[0]." and mark_length < ".$filter_length_arr[1];
        }
        if($sort != ""){
            $sql = $sql." order by ".$sort." desc";
        }
        $sql = $sql." limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_markSearchCount($keyword,$filter_category,$filter_type,$filter_price,$filter_length){//商标搜索列表总数
        $sql = "select mark_regno from mark_info "
            ." where is_onsale = 'sale' and concat(mark_regno,mark_name,app_range) like '%".$keyword."%'";
        if($filter_category != ""){
            $sql = $sql." and mark_category = ".$filter_category;
        }
        if($filter_type != ""){
            $sql = $sql." and mark_type = '".$filter_type."'";
        }
        if($filter_price != "" && count(explode("-", $filter_price)) == 2){
            $filter_price_arr = explode("-", $filter_price);
            $sql = $sql." and mark_price >= ".$filter_price_arr[0]." and mark_price < ".$filter_price_arr[1];
        }
        if($filter_length != "" && count(explode("-", $filter_length)) == 2){
            $filter_length_arr = explode("-", $filter_length);
            $sql = $sql." and mark_length >= ".$filter_length_arr[0]." and mark_length < ".$filter_length_arr[1];
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_myMarkList($user_id,$keyword,$start,$length){//我的商标列表页面,输出前$length条数
        $sql = "select * from mark_info "
            ." where mark_userid = ".$user_id." and concat(mark_regno,mark_name,app_range) like '%".$keyword."%'";
        $sql = $sql." limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_myMarkCount($user_id,$keyword){//我的商标总数
        $sql = "select mark_regno from mark_info "
            ." where mark_userid = ".$user_id." and concat(mark_regno,mark_name,app_range) like '%".$keyword."%'";
        $query = $this->db->query($sql);
        return $query->num_rows();
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
    
}
?>