<?php
class Company_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_companyList($keyword,$start,$length){//企业名录列表页面,输出前$length条数,筛选条件(关键词)
        $sql = "select * from company_info"
            ." where 1 = 1 ";
        if($keyword != ""){
            $sql = $sql." and concat(name,oper_name) like '%".$keyword."%'";
        }
        $sql = $sql." limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_companyCount($keyword){//企业名录总数,筛选条件(关键词)
        $sql = "select * from company_info"
            ." where 1 = 1 ";
        if($keyword != ""){
            $sql = $sql." and concat(name,oper_name) like '%".$keyword."%'";
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_companyDetail($company_id){//企业名录编辑页面,传入company_id
        $sql = "select * from company_info where company_id = '".$company_id."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function get_companyNameStatus($name){//判断企业录入情况,传入name
        $sql = "select * from company_info where name = '".$name."'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    //insert ignore into当违背了唯一约束的时候~就会直接跳过，不会报错
    public function add_companyOne($company_id,$name,$oper_name,$regist_capi,$real_capi,$status,$start_date,$credit_code,$tax_no,$no,$org_no,$econ_kind,$industry,$check_date,$belong_org,$province,$en_name,$original_name,$insured_person,$staff_size,$business_term,$address,$scope,$description){//新增一条企业记录
        $sql = "insert ignore into company_info(company_id,name,oper_name,regist_capi,real_capi,status,start_date,credit_code,tax_no,no,org_no,econ_kind,industry,check_date,belong_org,province,en_name,original_name,insured_person,staff_size,business_term,address,scope,description"
            .")values('".$company_id
            ."','".addslashes($name)
            ."','".addslashes($oper_name)
            ."','".addslashes($regist_capi)
            ."','".addslashes($real_capi)
            ."','".addslashes($status)
            ."','".addslashes($start_date)
            ."','".addslashes($credit_code)
            ."','".addslashes($tax_no)
            ."','".addslashes($no)
            ."','".addslashes($org_no)
            ."','".addslashes($econ_kind)
            ."','".addslashes($industry)
            ."','".addslashes($check_date)
            ."','".addslashes($belong_org)
            ."','".addslashes($province)
            ."','".addslashes($en_name)
            ."','".addslashes($original_name)
            ."','".addslashes($insured_person)
            ."','".addslashes($staff_size)
            ."','".addslashes($business_term)
            ."','".addslashes($address)
            ."','".addslashes($scope)
            ."','".addslashes($description)."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_companyByName($name,$oper_name,$regist_capi,$real_capi,$status,$start_date,$credit_code,$tax_no,$no,$org_no,$econ_kind,$industry,$check_date,$belong_org,$province,$en_name,$original_name,$insured_person,$staff_size,$business_term,$address,$scope,$description){//根据企业名称修改企业记录
        $sql = "update company_info set"
            ." oper_name='".$oper_name
            ."', regist_capi='".$regist_capi
            ."', real_capi='".$real_capi
            ."', status='".$status
            ."', start_date='".$start_date
            ."', credit_code='".$credit_code
            ."', tax_no='".$tax_no
            ."', no='".$no
            ."', org_no='".$org_no
            ."', econ_kind='".$econ_kind
            ."', industry='".$industry
            ."', check_date='".$check_date
            ."', belong_org='".$belong_org
            ."', province='".$province
            ."', en_name='".$en_name
            ."', original_name='".$original_name
            ."', insured_person='".$insured_person
            ."', staff_size='".$staff_size
            ."', business_term='".$business_term
            ."', address='".$address
            ."', scope='".$scope
            ."', description='".$description
            ."' where name='".$name."'";
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>