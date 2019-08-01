<?php
class Company_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_companyList($province,$start,$length){//企业列表页面,输出前$length条数
        $sql = "select * from company_info"
            ." where 1 = 1 ";
        if($province != ""){
            $sql = $sql." and province like '%".$province."%'";
        }
        $sql = $sql." limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_companyCount($province){//企业名录总数
        $sql = "select * from company_info"
            ." where 1 = 1 ";
        if($province != ""){
            $sql = $sql." and province like '%".$province."%'";
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_companySearch($keyword,$start,$length){//企业搜索列表页面,输出前$length条数
        $sql = "select * from company_info"
            ." where 1 = 1 ";
        if($keyword != ""){
            $sql = $sql." and concat(name,oper_name) like '%".$keyword."%'";
        }
        $sql = $sql." limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_companySearchCount($keyword){//企业搜索列表总数
        $sql = "select * from company_info"
            ." where 1 = 1 ";
        if($keyword != ""){
            $sql = $sql." and concat(name,oper_name) like '%".$keyword."%'";
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_companyDetail($company_id){//企业详情页面,传入company_id
        $sql = "select * from company_info where company_id = '".$company_id."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
}
?>