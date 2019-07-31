<?php
class Certify_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_certifyByUser($user_id){//企业认证列表页面,传入user_id
        $sql = "select * from company_certify "
            ." where certify_userid = ".$user_id." order by create_time desc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_certifyDetail($user_id,$certify_id){//企业认证详情页面,传入user_id,certify_id
        $sql = "select * from company_certify where certify_id = ".$certify_id." and certify_userid = ".$user_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function add_certifyOne($user_id,$business_license,$company_name,$oper_name,$contact_phone,$contact_email,$contact_address,$status,$create_time){//添加企业认证信息
        $sql = "insert into company_certify(certify_userid,business_license,company_name,oper_name,contact_phone,contact_email,contact_address,status,create_time"
            .")values(".$user_id.",'".$business_license."','".$company_name."','".$oper_name."','".$contact_phone."','".$contact_email."','".$contact_address."','".$status."','".$create_time."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_certifyOne($certify_id,$business_license,$company_name,$oper_name,$contact_phone,$contact_email,$contact_address,$status,$create_time){//重新企业认证,传入user_id
        $sql = "update company_certify set"
            ." business_license='".$business_license
            ."', company_name='".$company_name
            ."', oper_name='".$oper_name
            ."', contact_phone='".$contact_phone
            ."', contact_email='".$contact_email
            ."', contact_address='".$contact_address
            ."', status='".$status
            ."', create_time='".$create_time
            ."' where certify_id=".$certify_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>