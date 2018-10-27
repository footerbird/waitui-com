<?php
class Article_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_articleList($category,$start,$length){//文章列表页面,传入category_type,如'venture',输出前$length条数
        if($category == ''){
            $sql = "select article_id,article_title,thumb_path,article_tag,create_time from article_info "
                ." where status = 1 order by create_time desc limit ".$start.",".$length;
        }else{
            $sql = "select article_id,article_title,thumb_path,article_tag,create_time from article_info "
                ." where status = 1 and article_category = '".$category."' order by create_time desc limit ".$start.",".$length;
        }
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
    
    public function get_authorinfoById($author_id){//获取作者信息，传入author_id
        $sql = "select * from article_author where author_id = ".$author_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
}
?>