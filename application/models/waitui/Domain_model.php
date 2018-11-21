<?php
class Domain_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_domainList($keyword,$start,$length,$domain_type){//域名列表页面,输出前$length条数
        $sql = "select domain_name,register_registrar,expired_date,domain_price,domain_summary from domain_info "
            ." where concat(domain_name,register_registrar,domain_summary) like '%".$keyword."%'";
        if($domain_type != ""){
        	$sql = $sql." and domain_type = '".$domain_type."'";
        }
        $sql = $sql." limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_domainCount($keyword,$domain_type){//在售域名总数
        $sql = "select domain_name from domain_info"
            ." where concat(domain_name,register_registrar,domain_summary) like '%".$keyword."%'";
        if($domain_type != ""){
            $sql = $sql." and domain_type = '".$domain_type."'";
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_domainDetail($domain_name){//域名详情页面,传入domain_name
        $sql = "select * from domain_info where domain_name = '".$domain_name."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function get_domainRecommend($start,$length){//推荐域名列表,输出前$length条数
        $sql = "select domain_name,domain_price,domain_summary from domain_info "
            ." order by rand() limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
}
?>