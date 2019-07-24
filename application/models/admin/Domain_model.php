<?php
class Domain_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_domainList($start,$length){//域名列表页面,输出前$length条数
        $sql = "select * from domain_info "
            ." order by expired_date asc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_domainCount(){//域名总数
        $sql = "select * from domain_info";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_domainDetail($domain_name){//域名编辑页面,传入domain_name
        $sql = "select * from domain_info where domain_name = '".$domain_name."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function add_domainOne($domain_name,$register_registrar,$register_name,$register_email,$created_date,$expired_date,$domain_type,$domain_price,$domain_summary){//新增一条域名记录
        $sql = "insert into domain_info(domain_name,register_registrar,register_name,register_email,created_date,expired_date,domain_type,domain_price,domain_summary"
            .")values('".$domain_name."','".$register_registrar."','".$register_name."','".$register_email."','".$created_date."','".$expired_date."','".$domain_type."','".$domain_price."','".$domain_summary."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_domainOne($domain_name,$register_registrar,$register_name,$register_email,$created_date,$expired_date,$domain_type,$domain_price,$domain_summary){//修改域名信息
        $sql = "update domain_info set"
            ." register_registrar='".$register_registrar
            ."', register_name='".$register_name
            ."', register_email='".$register_email
            ."', created_date='".$created_date
            ."', expired_date='".$expired_date
            ."', domain_type='".$domain_type
            ."', domain_price='".$domain_price
            ."', domain_summary='".$domain_summary
            ."' where domain_name='".$domain_name."'";
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>