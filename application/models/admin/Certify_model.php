<?php
class Certify_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_certifyList($start,$length){//企业认证列表页面,输出前$length条数
        $sql = "select * from company_certify "
            ." order by create_time desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_certifyCount(){//企业认证总数
        $sql = "select * from company_certify";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_certifyDetail($certify_id){//企业认证编辑页面,传入certify_id
        $sql = "select * from company_certify where certify_id = ".$certify_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function edit_certifyOne($certify_id,$company_name,$oper_name,$regist_capi,$start_date,$credit_code,$econ_kind,$business_term,$address,$scope,$status,$description){//修改企业认证信息
        $sql = "update company_certify set"
            ." company_name='".$company_name
            ."', oper_name='".$oper_name
            ."', regist_capi='".$regist_capi
            ."', start_date='".$start_date
            ."', credit_code='".$credit_code
            ."', econ_kind='".$econ_kind
            ."', business_term='".$business_term
            ."', address='".$address
            ."', scope='".$scope
            ."', status=".$status
            .", description='".$description
            ."' where certify_id=".$certify_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>