<?php
class Domain_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_domainList($keyword,$register_registrar,$is_onsale,$user_id,$start,$length){//域名列表页面,输出前$length条数,筛选条件(关键词,注册商,出售状态,用户编号)
        $sql = "select * from domain_info"
            ." where 1 = 1 ";
        if($keyword != ""){
            $sql = $sql." and domain_name like '%".$keyword."%'";
        }
        if($register_registrar != ""){
            $sql = $sql." and register_registrar = '".$register_registrar."'";
        }
        if($is_onsale != ""){
            $sql = $sql." and is_onsale = '".$is_onsale."'";
        }
        if($user_id != ""){
            $sql = $sql." and domain_userid = ".$user_id;
        }
        $sql = $sql." order by expired_date asc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_domainCount($keyword,$register_registrar,$is_onsale,$user_id){//域名总数,筛选条件(关键词,注册商,出售状态,用户编号)
        $sql = "select * from domain_info"
            ." where 1 = 1 ";
        if($keyword != ""){
            $sql = $sql." and domain_name like '%".$keyword."%'";
        }
        if($register_registrar != ""){
            $sql = $sql." and register_registrar = '".$register_registrar."'";
        }
        if($is_onsale != ""){
            $sql = $sql." and is_onsale = '".$is_onsale."'";
        }
        if($user_id != ""){
            $sql = $sql." and domain_userid = ".$user_id;
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_domainDetail($domain_name){//域名编辑页面,传入domain_name
        $sql = "select * from domain_info where domain_name = '".$domain_name."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function add_domainOne($domain_name,$register_registrar,$register_name,$register_email,$created_date,$expired_date,$domain_type,$is_onsale,$domain_price,$domain_summary){//新增一条域名记录
        $sql = "insert into domain_info(domain_name,register_registrar,register_name,register_email,created_date,expired_date,domain_type,is_onsale,domain_price,domain_summary"
            .")values('".$domain_name."','".$register_registrar."','".$register_name."','".$register_email."','".$created_date."','".$expired_date."','".$domain_type."','".$is_onsale."','".$domain_price."','".$domain_summary."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_domainOne($domain_name,$register_registrar,$register_name,$register_email,$created_date,$expired_date,$domain_type,$is_onsale,$domain_price,$domain_summary){//修改域名信息
        $sql = "update domain_info set"
            ." register_registrar='".$register_registrar
            ."', register_name='".$register_name
            ."', register_email='".$register_email
            ."', created_date='".$created_date
            ."', expired_date='".$expired_date
            ."', domain_type='".$domain_type
            ."', is_onsale='".$is_onsale
            ."', domain_price='".$domain_price
            ."', domain_summary='".$domain_summary
            ."' where domain_name='".$domain_name."'";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_userDomainOne($user_id,$domain_name,$is_onsale,$domain_price){//给域名分配用户
        $sql = "update domain_info set"
            ." domain_userid=".$user_id
            .", is_onsale='".$is_onsale
            ."', domain_price='".$domain_price
            ."' where domain_name='".$domain_name."'";
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>