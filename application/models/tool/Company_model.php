<?php
class Company_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
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
    
}
?>