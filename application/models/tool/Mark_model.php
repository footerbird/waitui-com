<?php
class Mark_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function add_markOne($mark_regno,$regno_md,$mark_name,$image_path,$mark_category,$mark_type,$mark_group,$app_range,$mark_length,$mark_status,$mark_flow,$mark_applicant,$app_date,$announce_issue,$announce_date,$reg_issue,$reg_date,$private_limit,$mark_price,$mark_agent){//新增一条商标记录
        $sql = "insert into mark_info(mark_regno,regno_md,mark_name,image_path,mark_category,mark_type,mark_group,app_range,mark_length,mark_status,mark_flow,mark_applicant,app_date,announce_issue,announce_date,reg_issue,reg_date,private_limit,mark_price,mark_agent"
            .")values('".$mark_regno."','".$regno_md."','".$mark_name."','".$image_path."',".$mark_category.",'".$mark_type."','".$mark_group."','".$app_range."',".$mark_length.",'".$mark_status."','".$mark_flow."','".$mark_applicant."','".$app_date."','".$announce_issue."','".$announce_date."','".$reg_issue."','".$reg_date."','".$private_limit."',".$mark_price.",'".$mark_agent."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function get_regnoCount($mark_regno){//检测添加或者修改的商标的注册号是否已经存在
        $sql = "select * from mark_info where mark_regno = '".$mark_regno."'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
}
?>