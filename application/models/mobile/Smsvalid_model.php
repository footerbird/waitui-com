<?php
class Smsvalid_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function add_smsvalidOne($phone,$code){//向短信验证表添加一条记录
        //如果之前有该手机号处于激活状态的验证码记录，则先将该历史记录修改为无效
        $activeNum = $this->isactive_smsvalidByPhone($phone);
        if($activeNum > 0){
            $updateStatus = $this->edit_smsvalidByPhone($phone,0);//修改为无效
        }
        
        $sql = "insert into smsvalid_info(sms_phone,sms_code)values('".$phone."','".$code."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_smsvalidByPhone($phone,$status){//根据手机号更改短信验证状态
        $sql = "update smsvalid_info set"
        ." sms_status=".$status
        ." where sms_phone=".$phone;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function isactive_smsvalidByPhone($phone){//根据手机号判断是否有正在激活状态的验证码
        $sql = "select * from smsvalid_info where sms_phone = ".$phone." and sms_status = 1";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function isvalid_smsCode($phone,$code){//判断手机号，短信验证码是否正确,1表示验证码正确，注册成功，0表示失败
        $sql = "select * from smsvalid_info where sms_phone = ".$phone." and sms_code = ".$code." and sms_status = 1";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
}
?>