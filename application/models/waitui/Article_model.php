<?php
class Article_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_articleList($category,$start,$length){//文章列表页面,传入article_category,如'qccx(汽车出行)',输出前$length条数
        if($category == ''){
            $sql = "select article_id,article_title,thumb_path,article_lead,article_tag,author_id,create_time from article_info "
                ." where status = 'active' order by create_time desc limit ".$start.",".$length;
        }else{
            $sql = "select article_id,article_title,thumb_path,article_lead,article_tag,author_id,create_time from article_info "
                ." where status = 'active' and article_category = '".$category."' order by create_time desc limit ".$start.",".$length;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_articleCategory(){//文章列表页面,输出文章分类信息
        $sql = "select category_type,category_name from article_category "
            ." order by category_order asc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_articleSearch($keyword,$start,$length){//文章搜索列表页面,输出前$length条数
        $sql = "select article_id,article_title,thumb_path,article_lead,article_tag,author_id,create_time from article_info "
            ." where status = 'active' and article_content like '%".$keyword."%' order by create_time desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function add_articleHotword($keyword){//添加资讯热搜词
        $sql = "insert into article_hotword(hotword_name)values('".$keyword."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function get_articleRecommend($start,$length){//推荐文章列表,输出前$length条数
        $sql = "select article_id,article_title,thumb_path,article_lead,article_tag,author_id,create_time from article_info "
            ." where status = 'active' order by article_read desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_articleHotword($start,$length){//热搜词列表,输出前$length条数
        $sql = "select hotword_name,COUNT(hotword_name) as hotword_count from article_hotword"
            ." where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(create_time) group by hotword_name order by hotword_count desc limit ".$start.",".$length;
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_articleDetail($article_id){//阅读全文页面,传入article_id
        $sql = "select * from article_info where article_id = ".$article_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function edit_articleRead($article_id){//改变文章阅读数
        $sql = "update article_info set"
            ." article_read=article_read+1"
            ." where article_id=".$article_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function get_authorDetail($author_id){//获取作者信息，传入author_id
        $sql = "select * from article_author where author_id = ".$author_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
}
?>