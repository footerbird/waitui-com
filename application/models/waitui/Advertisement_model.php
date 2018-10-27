<?php
class Advertisement_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_adList($limit){//随机查询广告列表
        if($limit != ""){
            $sql = "select * from advertisement_info where ad_status = 1 and deadline_time > now() order by rand() limit 0,".$limit;
        }else{
            $sql = "select * from advertisement_info where ad_status = 1 and deadline_time > now() order by rand()";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_adListImage($limit){//随机查询广告列表()只有图片
        if($limit != ""){
            $sql = "select * from advertisement_info where ad_status = 1 and ad_type = 'image' and deadline_time > now() order by rand() limit 0,".$limit;
        }else{
            $sql = "select * from advertisement_info where ad_status = 1 and ad_type = 'image' and deadline_time > now() order by rand()";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_adListImageVideo($limit){//随机查询广告列表()只有图片、视频
        if($limit != ""){
            $sql = "select * from advertisement_info where ad_status = 1 and ad_type in ('image','video') and deadline_time > now() order by rand() limit 0,".$limit;
        }else{
            $sql = "select * from advertisement_info where ad_status = 1 and ad_type in ('image','video') and deadline_time > now() order by rand()";
        }
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_adinfoById($id){//根据广告id查询广告信息
        $sql = "select * from advertisement_info where ad_id = ".$id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function edit_adinfoAward($id,$award_amount){////根据广告id对该广告的推广积分做修改
        if($award_amount > 0){//如果剩余积分大于0，则is_award=1，否则为0
            $sql = "update advertisement_info set"
            ." is_award=1, award_amount=".$award_amount
            ." where ad_id=".$id;
        }else{
            $sql = "update advertisement_info set"
            ." is_award=0, award_amount=".$award_amount
            ." where ad_id=".$id;
        }
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_adinfoHeart($id,$heart_amount){////根据广告id对该广告的点赞数做修改
        $sql = "update advertisement_info set"
        ." heart_amount=".$heart_amount
        ." where ad_id=".$id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function add_adHeartRecord($ad_id,$heart_amount,$user_id){//记录点赞
        $sql = "insert into ad_heart_record(ad_id,heart_amount,user_id)values(".
            $ad_id.",".$heart_amount.",".$user_id.")";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function isheart_adUserHeart($ad_id,$user_id){//判断该广告是否被该用户点赞过,0表示未点赞过过，1表示点赞过
        $sql = "select sum(heart_amount) as heart_amount from ad_heart_record where ad_id = ".$ad_id." and user_id = ".$user_id;
        $query = $this->db->query($sql);
        return $query->row()->heart_amount;
    }
}
?>