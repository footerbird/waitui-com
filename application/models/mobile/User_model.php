<?php
class User_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_userDetail($user_id){//根据用户id查询用户信息
        $sql = "select * from user_info where user_id = ".$user_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function get_userByPhone($phone){//根据用户手机号查询用户信息
        $sql = "select * from user_info where user_phone = '".$phone."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function get_phoneRegStatus($phone){//判断手机号是否已注册,如果返回值为1，则为已注册，0为未注册
        $sql = "select * from user_info where user_phone = '".$phone."'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function add_userOne($phone,$pwd,$name){//创建用户新账户
        $sql = "insert into user_info(user_phone,user_pwd,user_name)values('".$phone."','".$pwd."','".$name."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function reset_userPassword($phone,$pwd){//重设用户密码
        $sql = "update user_info set"
            ." user_pwd='".$pwd
            ."' where user_phone='".$phone."'";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function add_userLoginOne($login_userid,$login_phone,$login_name,$login_client,$login_ip,$login_city,$login_time){//记录登录日志
        $sql = "insert into login_record(login_userid,login_phone,login_name,login_client,login_ip,login_city,login_time)values('".
            $login_userid."','".$login_phone."','".$login_name."','".$login_client."','".$login_ip."','".$login_city."','".$login_time."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function get_unreadMsg($user_id){//获取未读消息数
        $sql = "select * from user_msg_info where status = 'unread' and msg_userid = ".$user_id;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function edit_userScore($user_id,$user_score){//改变用户积分
        $sql = "update user_info set"
            ." user_score=".$user_score
            ." where user_id=".$user_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_userSignScore($user_id,$user_score,$sign_time){//改变用户积分和签到日期
        $sql = "update user_info set"
            ." user_score=".$user_score
            .", sign_time='".$sign_time
            ."' where user_id=".$user_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function isvalid_pwdPhone($phone,$pwd){//判断手机号，登录密码是否正确,1表示登录成功，0表示登录失败
        $sql = "select * from user_info where user_phone = '".$phone."' and user_pwd = '".$pwd."'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function add_userScoreRecord($user_id,$score_amount,$score_type,$score_source_id){//记录积分领取
        $sql = "insert into user_score_record(score_userid,score_amount,score_type,score_source_id)values(".
            $user_id.",".$score_amount.",'".$score_type."',".$score_source_id.")";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function ispick_userAdScore($user_id,$score_source_id){//判断该用户的该广告红包当天是否已经领取过,大于0表示领取过，0表示未领取
        $sql = "select * from user_score_record where score_type = 'ad' and score_userid = ".$user_id.
            " and score_source_id = ".$score_source_id." and datediff(now(),score_time)=0";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function edit_userFigure($user_id,$user_figure){//改变用户头像
        $sql = "update user_info set"
            ." user_figure='".$user_figure
            ."' where user_id=".$user_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_userName($user_id,$user_name){//改变用户昵称
        $sql = "update user_info set"
            ." user_name='".$user_name
            ."' where user_id=".$user_id;
        $query = $this->db->query($sql);
        return $query;
    }
}
?>