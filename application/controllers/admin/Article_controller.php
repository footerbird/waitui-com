<?php
class Article_controller extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        if(in_array($_SERVER["REMOTE_ADDR"],$this->config->item('forbid_ips'))){
            die("Your IP Address is forbiden to view this page!");
        }
    }
    
    public function get_admininfo(){//验证是否登录,并获取管理员信息
        $session_admininfo = $this->session->admininfo;//从session中获取管理员信息
        if(!empty($session_admininfo->admin_id)){
            $admininfo = $session_admininfo;
            return $admininfo;
        }else{
            redirect(base_url().'admin/login');
            exit;
        }
    }
    
    public function article_list(){//文章列表
        $this->module = 'article';
        $this->sub_menu = 'article';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $page = $this->input->get('page');//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        $keyword = $this->input->get('keyword');//得到域名关键词
        $filter_category = $this->input->get('filter_category');//得到文章类别
        
        //加载文章模型类
        $this->load->model('admin/Article_model','article');
        //get_articleCategory方法得到文章分类信息
        $article_category = $this->article->get_articleCategory();
        $data['article_category'] = $article_category;
        
        //get_articleCount方法得到文章总数
        $count = $this->article->get_articleCount($keyword,$filter_category);
        
        $page_size = 20;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        switch($page){
            case 1:
                $num_links = 4;//num_links选中页右边的个数
                break;
            case 2:
                $num_links = 3;
                break;
            case ceil($count/$page_size):
                $num_links = 4;
                break;
            case ceil($count/$page_size)-1:
                $num_links = 3;
                break;
            default:
                $num_links = 2;
                break;
        }
        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'admin/article_list';
        $config['total_rows'] = $count;
        $config['per_page'] = $page_size;// $pagesize每页条数
        $config['num_links'] = $num_links;//设置选中页左右两边的页数
        
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li class="paginate_button first">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="paginate_button last">';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="paginate_button next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="paginate_button previous">';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li class="paginate_button">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = ' <li class="paginate_button active"><a>'; // 当前页开始样式   
        $config['cur_tag_close'] = '</a></li>'; 
        $config['first_link'] = '首页'; // 第一页显示   
        $config['last_link'] = '尾页'; // 最后一页显示   
        $config['next_link'] = '下一页'; // 下一页显示   
        $config['prev_link'] = '上一页'; // 上一页显示 
        
        $this->pagination->initialize($config);
        $data['page_count'] = $count;
        $data['page_size'] = $page_size;
        
        //get_articleList方法到文章列表信息
        $article_list = $this->article->get_articleList($keyword,$filter_category,$offset,$page_size);
        foreach($article_list as $article){
            //get_categoryName获取类型名称
            $category = $this->article->get_categoryName($article->article_category);
            $article->category_name = $category->category_name;
            //get_authorDetail获取作者信息
            $author = $this->article->get_authorDetail($article->author_id);
            $article->author_name = $author->author_name;
        }
        $data['article_list'] = $article_list;
        $data['keyword'] = $keyword;
        $data['filter_category'] = $filter_category;
        
        $this->load->view('admin/article_list',$data);
    }
    
    public function article_update(){//文章编辑初始页
        $this->module = 'article';
        $this->sub_menu = 'article';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        //加载文章模型类
        $this->load->model('admin/Article_model','article');
        //get_articleAuthor方法得到作者列表
        $atuhor_list = $this->article->get_articleAuthor();
        //get_articleCategory方法得到文章类型列表
        $category_list = $this->article->get_articleCategory();
        $data['author_list'] = $atuhor_list;
        $data['category_list'] = $category_list;
        
        $article_id = $this->input->get('article_id');//得到商标注册号
        if(!empty($article_id)){
            $data['operate'] = 'update';
            //get_articleDetail方法得到文章详情
            $article = $this->article->get_articleDetail($article_id);
            if(empty($article)){
                $heading = '404 Page Not Found';
                $message = 'The page you requested was not found.';
                show_error($message, 404, $heading );
                exit;
            }
            $data['article'] = $article;
        }else{
            $data['operate'] = 'add';
        }
        
        $this->load->view('admin/article_update',$data);
    }
    
    public function article_update_do(){//文章编辑
        
        $operate = $this->input->get_post('operate');//得到操作
        $article_id = $this->input->get_post('article_id');//文章编号
        $article_title = $this->input->get_post('article_title');//文章标题
        $thumb_path = $this->input->get_post('thumb_path');//缩略图
        $author_id = $this->input->get_post('author_id');//文章作者
        $article_category = $this->input->get_post('article_category');//文章类型
        $article_tag = $this->input->get_post('article_tag');//文章标签
        $article_lead = $this->input->get_post('article_lead');//文章导语
        $article_content = $this->input->get_post('article_content');//文章内容
        $status = $this->input->get_post('status');//状态
        $create_time = date("Y-m-d H:i:s", time());//发布时间
        //加载文章模型类
        $this->load->model('admin/Article_model','article');
        if($operate == 'add'){//添加
            //add_articleOne方法添加一条文章记录
            $addStatus = $this->article->add_articleOne($article_title,$thumb_path,$article_lead,$article_tag,$article_content,$status,$author_id,$article_category,$create_time);
            if($addStatus){
                $data['state'] = 'success';
                $data['msg'] = '添加成功';
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '添加失败，请重试';
            }
        }else{//修改
            //edit_articleOne方法修改文章信息
            $updateStatus = $this->article->edit_articleOne($article_id,$article_title,$thumb_path,$article_lead,$article_tag,$article_content,$status,$author_id,$article_category,$create_time);
            if($updateStatus){
                $data['state'] = 'success';
                $data['msg'] = '修改成功';
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '修改失败，请重试';
            }
        }
        
        echo json_encode($data);
    }
    
    public function upload_articleThumb(){//上传文章缩略图
        $imageUpload = $_FILES['file'];
        $result = upload_images_temp($imageUpload,'uploads/images/article');
        $result['url'] = '/'.$result['url'];
        echo json_encode($result);
    }
    
    public function upload_articleImage(){//文章内容本地上传图片
        $imageUpload = $_FILES['file'];
        $result = upload_images_temp($imageUpload,'uploads/images/article');
        if($result['state'] == 'success'){
            $res['errno'] = 0;
            $res['data'] = ['/'.$result['url']];
        }else{
            $res['errno'] = 1;
            $res['data'] = [''];
        }
        echo json_encode($res);
    }
    
    public function article_category_list(){//文章类型列表
        $this->module = 'article';
        $this->sub_menu = 'article_category';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        //加载文章模型类
        $this->load->model('admin/Article_model','article');
        //get_articleCategory方法到文章类型信息
        $category_list = $this->article->get_articleCategory();
        $data['category_list'] = $category_list;
        
        $this->load->view('admin/article_category_list',$data);
    }
    
    public function article_author_list(){//文章作者列表
        $this->module = 'article';
        $this->sub_menu = 'article_author';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        //加载文章模型类
        $this->load->model('admin/Article_model','article');
        //get_articleAuthor方法到作者列表信息
        $author_list = $this->article->get_articleAuthor();
        $data['author_list'] = $author_list;
        
        $this->load->view('admin/article_author_list',$data);
    }
    
    public function article_author_update(){//作者编辑初始页
        $this->module = 'article';
        $this->sub_menu = 'article_author';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $author_id = $this->input->get('author_id');//得到作者编号
        if(!empty($author_id)){
            $data['operate'] = 'update';
            //加载文章模型类
            $this->load->model('admin/Article_model','article');
            //get_authorDetail方法得到作者详情
            $author = $this->article->get_authorDetail($author_id);
            if(empty($author)){
                $heading = '404 Page Not Found';
                $message = 'The page you requested was not found.';
                show_error($message, 404, $heading );
                exit;
            }
            $data['author'] = $author;
        }else{
            $data['operate'] = 'add';
        }
        
        $this->load->view('admin/article_author_update',$data);
    }
    
    public function article_author_update_do(){//作者编辑
        
        $operate = $this->input->get_post('operate');//得到操作
        $author_id = $this->input->get_post('author_id');//作者编号
        $author_name = $this->input->get_post('author_name');//作者名称
        $author_motto = $this->input->get_post('author_motto');//座右铭
        $figure_path = $this->input->get_post('figure_path');//作者头像
        //加载文章模型类
        $this->load->model('admin/Article_model','article');
        if($operate == 'add'){//添加
            //add_authorOne方法添加一条作者记录
            $addStatus = $this->article->add_authorOne($author_name,$author_motto,$figure_path);
            if($addStatus){
                $data['state'] = 'success';
                $data['msg'] = '添加成功';
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '添加失败，请重试';
            }
        }else{//修改
            //edit_authorOne方法修改作者信息
            $updateStatus = $this->article->edit_authorOne($author_id,$author_name,$author_motto,$figure_path);
            if($updateStatus){
                $data['state'] = 'success';
                $data['msg'] = '修改成功';
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '修改失败，请重试';
            }
        }
        
        echo json_encode($data);
    }
    
    public function upload_authorFigure(){//上传作者头像
        $figureUpload = $_FILES['file'];
        $result = upload_images_temp($figureUpload,'uploads/images/article');
        $result['url'] = '/'.$result['url'];
        echo json_encode($result);
    }
    
}
?>