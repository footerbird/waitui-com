<?php
class Article_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_articleList($category,$start,$length){//文章列表页面,传入article_category,如'qccx(汽车出行)',输出前$length条数
        if($category == ''){
            $sql = "select * from article_info "
                ." order by create_time desc limit ".$start.",".$length;
        }else{
            $sql = "select * from article_info "
                ." where article_category = '".$category."' order by create_time desc limit ".$start.",".$length;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_articleCount($category){//文章总数
        $sql = "select * from article_info";
        if($category != ""){
            $sql = $sql." where article_category = '".$category."'";
        }
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function get_articleDetail($article_id){//阅读全文页面,传入article_id
        $sql = "select * from article_info where article_id = ".$article_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function add_articleOne($article_title,$thumb_path,$article_lead,$article_tag,$article_content,$status,$author_id,$article_category,$create_time){//新增一条文章记录
        $sql = "insert into article_info(article_title,thumb_path,article_lead,article_tag,article_content,status,author_id,article_category,create_time"
            .")values('".addslashes($article_title)."','".$thumb_path."','".addslashes($article_lead)."','".$article_tag."','".addslashes($article_content)."','".$status."',".$author_id.",'".$article_category."','".$create_time."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_articleOne($article_id,$article_title,$thumb_path,$article_lead,$article_tag,$article_content,$status,$author_id,$article_category,$create_time){//修改文章信息
        $sql = "update article_info set"
            ." article_title='".addslashes($article_title)
            ."', thumb_path='".$thumb_path
            ."', article_lead='".addslashes($article_lead)
            ."', article_tag='".$article_tag
            ."', article_content='".addslashes($article_content)
            ."', status='".$status
            ."', author_id=".$author_id
            .", article_category='".$article_category
            ."', create_time='".$create_time
            ."' where article_id=".$article_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function get_articleCategory(){//文章类型页面,输出文章分类信息
        $sql = "select * from article_category "
            ." order by category_order asc";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_categoryName($category_type){//根据文章类型取得类型名称
        $sql = "select * from article_category where category_type = '".$category_type."'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function get_articleAuthor(){//获取文章作者
        $sql = "select * from article_author";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    public function get_authorDetail($author_id){//获取作者信息，传入author_id
        $sql = "select * from article_author where author_id = ".$author_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    public function add_authorOne($author_name,$author_motto,$figure_path){//新增一条作者记录
        $sql = "insert into article_author(author_name,author_motto,figure_path"
            .")values('".$author_name."','".$author_motto."','".$figure_path."')";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function edit_authorOne($author_id,$author_name,$author_motto,$figure_path){//修改作者信息
        $sql = "update article_author set"
            ." author_name='".$author_name
            ."', author_motto='".$author_motto
            ."', figure_path='".$figure_path
            ."' where author_id=".$author_id;
        $query = $this->db->query($sql);
        return $query;
    }
    
}
?>