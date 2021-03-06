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
    
    public function edit_realName($user_id,$real_name){//改变真实姓名
        $sql = "update user_info set"
            ." real_name='".$real_name
            ."' where user_id=".$user_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_userPhone($user_id,$user_phone){//改变手机号码
        $sql = "update user_info set"
            ." user_phone='".$user_phone
            ."' where user_id=".$user_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_userQQ($user_id,$user_qq){//改变QQ号码
        $sql = "update user_info set"
            ." user_qq='".$user_qq
            ."' where user_id=".$user_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_userEmail($user_id,$user_email){//改变用户邮箱
        $sql = "update user_info set"
            ." user_email='".$user_email
            ."' where user_id=".$user_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_userWechat($user_id,$user_wechat){//改变微信号码
        $sql = "update user_info set"
            ." user_wechat='".$user_wechat
            ."' where user_id=".$user_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_userButler($user_id,$user_butler){//改变品牌管家
        $sql = "update user_info set"
            ." user_butler=".$user_butler
            ." where user_id=".$user_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function get_loginRecord($user_id,$start,$length){//登录日志列表页面,输入用户编号$user_id,输出前$length条数
        $sql = "select * from login_record "
            ." where login_userid = ".$user_id." order by login_time desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_loginCount($user_id){//登录日志总数
        $sql = "select * from login_record"
            ." where login_userid = ".$user_id;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_butlerListAll(){//管家列表,输出全部条数
        $sql = "select * from butler_info order by create_time desc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_butlerDetail($butler_id){//控制台管家信息,传入butler_id
        $sql = "select * from butler_info where butler_id = ".$butler_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function add_myMessageOne($user_id,$msg_title,$msg_source,$msg_content){//添加消息
        $sql = "insert into user_msg_info(msg_userid,msg_title,msg_source,msg_content"
            .")values(".$user_id.",'".$msg_title."','".$msg_source."','".$msg_content."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function get_myMessageList($user_id,$status,$start,$length){//获取我的消息列表
        if($status != ''){
            $sql = "select * from user_msg_info "
                ." where status = '".$status."' and msg_userid = ".$user_id." order by create_time desc limit ".$start.",".$length;
        }else{//全部消息(状态为0或1)
            $sql = "select * from user_msg_info "
                ." where status != 'del' and msg_userid = ".$user_id." order by create_time desc limit ".$start.",".$length;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_myMessageCount($user_id,$status){//获取我的消息总数
        if($status != ''){
            $sql = "select * from user_msg_info "
                ." where status = '".$status."' and msg_userid = ".$user_id;
        }else{//全部消息(状态为0或1)
            $sql = "select * from user_msg_info "
                ." where status != 'del' and msg_userid = ".$user_id;
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function edit_myMessageStatusBatch($msgid_arr,$status){//批量修改消息状态
        $msgid_arrs = implode(",",$msgid_arr);
        $sql = "update user_msg_info set"
            ." status='".$status
            ."' where msg_id in (".$msgid_arrs.")";
        $query = $this->db->query($sql);
        return $query;
    }
}
?>