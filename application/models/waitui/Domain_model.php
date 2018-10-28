<?php
class Domain_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_domainList($start,$length){//域名列表页面,输出前$length条数
        $sql = "select domain_name,expired_date,domain_price,domain_summary from domain_info "
            ."limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_domainCount(){//在售域名总数
    	$sql = "select domain_name from domain_info";
    	$query = $this->db->query($sql);
    	return $query->num_rows();
    }
    
}
?>