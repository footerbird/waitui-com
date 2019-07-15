<?php
class Index_controller extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        if(in_array($_SERVER["REMOTE_ADDR"],$this->config->item('forbid_ips'))){
            die("Your IP Address is forbiden to view this page!");
        }
    }
    
    public function index(){//得到初始的广告列表
        
        //加载广告模型类
        $this->load->model('mobile/Advertisement_model','advertisement');
        //get_adList方法得到广告列表
        $ad_list = $this->advertisement->get_adList(10);
        //加载用户模型类
        $this->load->model('mobile/User_model','user');
        foreach($ad_list as $advertisement){
            $author_info = $this->user->get_userDetail($advertisement->author_id);
            $advertisement->author_name = $author_info->user_name;
            $advertisement->author_figure = $author_info->user_figure;
        }
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            
            foreach($ad_list as $advertisement){
                //ispick_userAdScore方法判断该用户的该广告红包当天是否已经领取过
                $advertisement->is_pick = $this->user->ispick_userAdScore($user_id,$advertisement->ad_id);
                //isheart_adUserHeart方法判断该广告是否被该用户点赞过
                $advertisement->is_heart = $this->advertisement->isheart_adUserHeart($advertisement->ad_id,$user_id);
            }
            
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $data['ad_list'] = $ad_list;
        
        $seo = array(
            'seo_title'=>'专业的品牌广告分享平台 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        $data['styles'] = array(
            '/htdocs/mobile/dist/css/swiper.min.css?'.CACHE_TIME,
            '/htdocs/mobile/dist/css/animate.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            '/htdocs/mobile/dist/js/swiper.min.js?'.CACHE_TIME,
            '/htdocs/mobile/dist/js/swiper.animate.min.js?'.CACHE_TIME
        );
        
        $this->load->view('mobile/index',$data);
    }
    
    public function get_advertisementAjax(){//获取新的广告信息
        
        $limit = $this->input->get_post('limit');//得到广告限制条数
        $limit = $limit?$limit:1;
        //加载广告模型类
        $this->load->model('mobile/Advertisement_model','advertisement');
        //get_adList方法得到广告列表
        $ad_list = $this->advertisement->get_adList($limit);//获取广告
        //加载用户模型类
        $this->load->model('mobile/User_model','user');
        foreach($ad_list as $advertisement){
            $author_info = $this->user->get_userDetail($advertisement->author_id);
            $advertisement->author_name = $author_info->user_name;
            $advertisement->author_figure = $author_info->user_figure;
        }
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            
            foreach($ad_list as $advertisement){
                //ispick_userAdScore方法判断该用户的该广告红包当天是否已经领取过
                $advertisement->is_pick = $this->user->ispick_userAdScore($user_id,$advertisement->ad_id);
                //isheart_adUserHeart方法判断该广告是否被该用户点赞过
                $advertisement->is_heart = $this->advertisement->isheart_adUserHeart($advertisement->ad_id,$user_id);
            }
            
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $data['ad_list'] = $ad_list;
        
        echo json_encode($data);
    }
    
    public function get_advertisementAjaxImage(){//获取新的广告信息(只有图片)，提供给微信小程序的接口
        
        $limit = $this->input->get_post('limit');//得到广告限制条数
        $limit = $limit?$limit:1;
        //加载广告模型类
        $this->load->model('mobile/Advertisement_model','advertisement');
        //get_adList方法得到广告列表
        $ad_list = $this->advertisement->get_adListImage($limit);//获取广告
        //加载用户模型类
        $this->load->model('mobile/User_model','user');
        foreach($ad_list as $advertisement){
            $author_info = $this->user->get_userDetail($advertisement->author_id);
            $advertisement->author_name = $author_info->user_name;
            $advertisement->author_figure = $author_info->user_figure;
        }
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            
            foreach($ad_list as $advertisement){
                //ispick_userAdScore方法判断该用户的该广告红包当天是否已经领取过
                $advertisement->is_pick = $this->user->ispick_userAdScore($user_id,$advertisement->ad_id);
                //isheart_adUserHeart方法判断该广告是否被该用户点赞过
                $advertisement->is_heart = $this->advertisement->isheart_adUserHeart($advertisement->ad_id,$user_id);
            }
            
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $data['ad_list'] = $ad_list;
        
        echo json_encode($data);
    }
    
    public function get_advertisementAjaxImageVideo(){//获取新的广告信息(只有图片、视频)，提供给微信小程序的接口
        
        $limit = $this->input->get_post('limit');//得到广告限制条数
        $limit = $limit?$limit:1;
        //加载广告模型类
        $this->load->model('mobile/Advertisement_model','advertisement');
        //get_adList方法得到广告列表
        $ad_list = $this->advertisement->get_adListImageVideo($limit);//获取广告
        //加载用户模型类
        $this->load->model('mobile/User_model','user');
        foreach($ad_list as $advertisement){
            $author_info = $this->user->get_userDetail($advertisement->author_id);
            $advertisement->author_name = $author_info->user_name;
            $advertisement->author_figure = $author_info->user_figure;
        }
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            
            foreach($ad_list as $advertisement){
                //ispick_userAdScore方法判断该用户的该广告红包当天是否已经领取过
                $advertisement->is_pick = $this->user->ispick_userAdScore($user_id,$advertisement->ad_id);
                //isheart_adUserHeart方法判断该广告是否被该用户点赞过
                $advertisement->is_heart = $this->advertisement->isheart_adUserHeart($advertisement->ad_id,$user_id);
            }
            
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $data['ad_list'] = $ad_list;
        
        echo json_encode($data);
    }
    
    public function get_advertisementAjax_tpl(){//获取新的广告信息（模板加載）
        
        //加载广告模型类
        $this->load->model('mobile/Advertisement_model','advertisement');
        //get_adList方法得到广告列表
        $ad_list = $this->advertisement->get_adList(1);//获取一条广告
        //加载用户模型类
        $this->load->model('mobile/User_model','user');
        foreach($ad_list as $advertisement){
            $author_info = $this->user->get_userDetail($advertisement->author_id);
            $advertisement->author_name = $author_info->user_name;
            $advertisement->author_figure = $author_info->user_figure;
        }
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            
            foreach($ad_list as $advertisement){
                //ispick_userAdScore方法判断该用户的该广告红包当天是否已经领取过
                $advertisement->is_pick = $this->user->ispick_userAdScore($user_id,$advertisement->ad_id);
                //isheart_adUserHeart方法判断该广告是否被该用户点赞过
                $advertisement->is_heart = $this->advertisement->isheart_adUserHeart($advertisement->ad_id,$user_id);
            }
            
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $data['ad_list'] = $ad_list;
        
        $this->load->view('mobile/templete/tpl_advertisement',$data);
    }
    
    public function share($ad_id){//分享的单条广告页面
        
        //加载广告模型类
        $this->load->model('mobile/Advertisement_model','advertisement');
        //get_adinfoById方法得到广告详情
        $ad_info = $this->advertisement->get_adinfoById($ad_id);
        //加载用户模型类
        $this->load->model('mobile/User_model','user');
        $author_info = $this->user->get_userDetail($ad_info->author_id);
        $ad_info->author_name = $author_info->user_name;
        $data['ad_info'] = $ad_info;
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $seo = array(
            'seo_title'=>'专业的品牌广告分享平台 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        $data['styles'] = array(
            '/htdocs/mobile/dist/css/swiper.min.css?'.CACHE_TIME,
            '/htdocs/mobile/dist/css/animate.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            '/htdocs/mobile/dist/js/swiper.min.js?'.CACHE_TIME,
            '/htdocs/mobile/dist/js/swiper.animate.min.js?'.CACHE_TIME
        );
        
        $this->load->view('mobile/share',$data);
    }
    
    public function article_list(){//文章列表
        
        //加载头条模型类
        $this->load->model('mobile/Article_model','article');
        //get_articleList方法得到头条列表
        $article_list = $this->article->get_articleList('',0,10);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
        }
        $data['article_list'] = $article_list;
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('mobile/User_model','user');
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $seo = array(
            'seo_title'=>'专业的品牌资讯分享平台 | 外推头条',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('mobile/article_list',$data);
    }
    
    public function get_articleAjax(){//文章列表加载更多
        
        $category = $this->input->get_post('category');//得到文章类型
        $category = $category?$category:'';
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        
        //加载头条模型类
        $this->load->model('mobile/Article_model','article');
        //get_articleList方法得到头条列表
        $article_list = $this->article->get_articleList($category,$offset,$page_size);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
        }
        $data['article_list'] = $article_list;
        
        echo json_encode($data);
    }
    
    public function get_articleAjax_tpl(){//文章列表加载更多（模板加載）
        
        $category = $this->input->get_post('category');//得到文章类型
        $category = $category?$category:'';
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        //加载头条模型类
        $this->load->model('mobile/Article_model','article');
        //get_articleList方法得到头条列表
        $article_list = $this->article->get_articleList($category,$offset,$page_size);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
        }
        $data['article_list'] = $article_list;
        
        $this->load->view('mobile/templete/tpl_article',$data);
    }
    
    public function article_detail($article_id){//文章详细页面
        
        //加载头条模型类
        $this->load->model('mobile/Article_model','article');
        
        //edit_articleRead方法改变文章阅读数
        $updateStatus = $this->article->edit_articleRead($article_id);
        
        //get_articleDetail方法得到文章详情
        $article = $this->article->get_articleDetail($article_id);
        $article->create_time = format_article_time($article->create_time);
        
        $author_info = $this->article->get_authorDetail($article->author_id);
        $article->author_name = $author_info->author_name;
        $article->figure_path = $author_info->figure_path;
        $data['article'] = $article;
        
        $seo = array(
            'seo_title'=>$article->article_title.' | 外推头条',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('mobile/article_detail',$data);
    }
    
    public function get_articleDetailAjax(){//ajax文章详细页面
        
        $article_id = $this->input->get_post('article_id');//得到文章编号
        //加载头条模型类
        $this->load->model('mobile/Article_model','article');
        
        //edit_articleRead方法改变文章阅读数
        $updateStatus = $this->article->edit_articleRead($article_id);
        
        //get_articleDetail方法得到文章详情
        $article = $this->article->get_articleDetail($article_id);
        $article->create_time = format_article_time($article->create_time);
        
        $author_info = $this->article->get_authorDetail($article->author_id);
        $article->author_name = $author_info->author_name;
        $article->figure_path = $author_info->figure_path;
        $data['article'] = $article;
        
        $seo = array(
            'seo_title'=>$article->article_title.' - 外推头条',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        echo json_encode($data);
    }
    
    public function welfare_list(){//福利列表
        
        //加载福利模型类
        $this->load->model('mobile/Welfare_model','welfare');
        //get_welfareList方法得到福利列表
        $welfare_list = $this->welfare->get_welfareList();
        foreach($welfare_list as $welfare){
            $welfare->create_time = date('Y-m-d',strtotime($welfare->create_time));
        }
        $data['welfare_list'] = $welfare_list;
        
        //加载头条模型类
        $this->load->model('mobile/Article_model','article');
        //get_articleList方法得到头条列表
        $article_list = $this->article->get_articleList('',0,6);
        $data['article_list'] = $article_list;
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('mobile/User_model','user');
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $seo = array(
            'seo_title'=>'品牌生活广场，传递品牌价值 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        $data['styles'] = array(
            '/htdocs/mobile/dist/css/swiper.min.css?'.CACHE_TIME,
            '/htdocs/mobile/dist/css/animate.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            '/htdocs/mobile/dist/js/swiper.min.js?'.CACHE_TIME,
            '/htdocs/mobile/dist/js/swiper.animate.min.js?'.CACHE_TIME
        );
        
        $this->load->view('mobile/welfare_list',$data);
    }
    
    public function get_welfareAjax(){//ajax获取福利列表
        
        //加载福利模型类
        $this->load->model('mobile/Welfare_model','welfare');
        //get_welfareList方法得到福利列表
        $welfare_list = $this->welfare->get_welfareList();
        foreach($welfare_list as $welfare){
            $welfare->create_time = date('Y-m-d',strtotime($welfare->create_time));
        }
        $data['welfare_list'] = $welfare_list;
        
        echo json_encode($data);
    }
    
    public function welfare_entry(){//热门活动等
        
        //加载福利模型类
        $this->load->model('mobile/Welfare_model','welfare');
        //get_welfareList方法得到福利列表
        $welfare_list = $this->welfare->get_welfareList();
        foreach($welfare_list as $welfare){
            $welfare->create_time = date('Y-m-d',strtotime($welfare->create_time));
        }
        $data['welfare_list'] = $welfare_list;
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('mobile/User_model','user');
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $seo = array(
            'seo_title'=>'品牌生活广场，传递品牌价值 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('mobile/welfare_entry',$data);
    }
    
    public function account(){//账户中心
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('mobile/User_model','user');
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            $data['userinfo'] = $userinfo;
            //get_unreadMsg方法获取未读消息数量
            $msg_count = $this->user->get_unreadMsg($user_id);
            $data['msg_count'] = $msg_count;
            //判断当天是否签到
            if(empty($userinfo->sign_time)){//如果没签到过，则可以签到
                $data['is_signed'] = 0;//设置未签到过
            }else{//否则只能当天没签到过才能签到
                $sign_time = date('Y-m-d',strtotime($userinfo->sign_time));
                $curr_time = date('Y-m-d',time());
                if(strtotime($curr_time) - strtotime($sign_time) > 0){//如果当天签到过，则相等
                    $data['is_signed'] = 0;//设置未签到过
                }else{
                    $data['is_signed'] = 1;//设置签到过
                }
            }
        }else{
            redirect(base_url().'m/');
            exit;
        }
        
        $seo = array(
            'seo_title'=>'账户中心 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('mobile/account',$data);
    }
    
    public function userinfo(){//个人信息
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('mobile/User_model','user');
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            $data['userinfo'] = $userinfo;
        }else{
            redirect(base_url().'m/');
            exit;
        }
        
        $seo = array(
            'seo_title'=>'个人信息 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $data['scripts'] = array(
            '/htdocs/mobile/dist/js/jquery.form.min.js?'.CACHE_TIME,
        );
        
        $this->load->view('mobile/userinfo',$data);
    }
    
    public function nickname(){//修改昵称
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('mobile/User_model','user');
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            $data['userinfo'] = $userinfo;
        }else{
            redirect(base_url().'m/');
            exit;
        }
        
        $seo = array(
            'seo_title'=>'修改昵称 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('mobile/nickname',$data);
    }
    
    public function upload_userFigureAjax(){//ajax上传用户头像临时路径
    
        $figure_path = $this->input->get_post('figure_path');//得到用户头像临时目录
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('mobile/User_model','user');
            //get_userDetail方法获取用户信息
            $userinfo = $this->user->get_userDetail($user_id);
            
            $imgInfo = getimagesize($figure_path);
            switch($imgInfo[2]){
                case 1:
                    $imgType = 'gif';
                    break;
                case 2:
                    $imgType = 'jpg';
                    break;
                case 3:
                    $imgType = 'png';
                    break;
                default:
                    $imgType = 'png';
                    break;
            }
            $html = file_get_contents($figure_path);
            $rand = rand(pow(10, 5), (pow(10, 6)-1));
            file_put_contents('uploads/images/figure/figure_'.md5($userinfo->user_phone.$rand).'.'.$imgType, $html);
            $user_figure = '/uploads/images/figure/figure_'.md5($userinfo->user_phone.$rand).'.'.$imgType;
            //edit_userFigure方法改变用户头像
            $updateStatus = $this->user->edit_userFigure($user_id,$user_figure);
            if($updateStatus){
                $data['state'] = 'success';
                $data['figure'] = $user_figure;
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '程序错误，请重试';
            }
        }else{
            $data['state'] = 'failed';
            $data['msg'] = '程序错误，请重试';
        }
        echo json_encode($data);
    }
    
    public function edit_userNameAjax(){//ajax修改用户昵称
    
        $user_name = $this->input->get_post('user_name');//得到用户昵称
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('mobile/User_model','user');
            //edit_userName方法改变用户昵称
            $updateStatus = $this->user->edit_userName($user_id,$user_name);
            if($updateStatus){
                $data['state'] = 'success';
                $data['user_name'] = $user_name;
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '程序错误，请重试';
            }
        }else{
            $data['state'] = 'failed';
            $data['msg'] = '程序错误，请重试';
        }
        echo json_encode($data);
    }
    
    public function get_randScoreAjax(){//点击红包随机获取积分
    
        $ad_id = $this->input->get_post('ad_id');//得到广告Id
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(empty($session_userinfo->user_id)){
            return;
        }
        $user_id = $session_userinfo->user_id;
        //加载用户模型类
        $this->load->model('mobile/User_model','user');
        //get_userDetail方法获取用户信息
        $userinfo = $this->user->get_userDetail($user_id);
        
        $randScore = rand(1,5);
        //加载广告模型类
        $this->load->model('mobile/Advertisement_model','advertisement');
        //get_adinfoById方法得到广告详情
        $ad_info = $this->advertisement->get_adinfoById($ad_id);//根据id获取广告信息
        if($ad_info->is_award == 1){//如果有奖励
            $leftScore = $ad_info->award_amount - $randScore;
            $updateStatus = $this->advertisement->edit_adinfoAward($ad_id,$leftScore);//返回修改广告积分状态
            if($updateStatus){//改变用户积分
                $newScore = $userinfo->user_score + $randScore;
                $update_score = $this->user->edit_userScore($user_id,$newScore);//返回修改用户积分状态
            }
            if($update_score){//如果修改成功
                //add_userScoreRecord记录用户积分领取日志
                $record_score = $this->user->add_userScoreRecord($user_id,$randScore,'ad',$ad_id);
                
                $data['state'] = 'success';
                $data['rand_score'] = $randScore;
                $data['new_score'] = $newScore;
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '红包领取失败，请重试';
            }
        }else{
            $data['state'] = 'failed';
            $data['msg'] = '红包余额不足，请下次再来';
        }
        
        echo json_encode($data);
    }
    
    public function get_signScoreAjax(){//签到随机获取积分
    
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(empty($session_userinfo->user_id)){
            return;
        }
        $user_id = $session_userinfo->user_id;
        //加载用户模型类
        $this->load->model('mobile/User_model','user');
        //get_userDetail方法获取用户信息
        $userinfo = $this->user->get_userDetail($user_id);
        
        $randScore = rand(1,5);
        
        //判断当天是否签到
        if(empty($userinfo->sign_time)){//如果没签到过，则可以签到
            $is_signed = 0;
        }else{//否则只能当天没签到过才能签到
            $sign_time = date('Y-m-d',strtotime($userinfo->sign_time));
            $curr_time = date('Y-m-d',time());
            if(strtotime($curr_time) - strtotime($sign_time) > 0){//如果当天签到过，则相等
                $is_signed = 0;//设置未签到过
            }else{
                $is_signed = 1;//设置签到过
            }
        }
        
        if($is_signed == 0){//如果没签到过
            $newScore = $userinfo->user_score + $randScore;
            $update_score = $this->user->edit_userSignScore($user_id,$newScore,date('Y-m-d H:i:s',time()));//返回修改用户积分状态
            if($update_score){//如果修改成功
                //add_userScoreRecord记录用户积分领取日志
                $record_score = $this->user->add_userScoreRecord($user_id,$randScore,'sign','NULL');
                
                $data['state'] = 'success';
                $data['rand_score'] = $randScore;
                $data['new_score'] = $newScore;
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '程序错误，请重试';
            }
        }else{
            $data['state'] = 'failed';
            $data['msg'] = '程序错误，请重试';
        }
        
        echo json_encode($data);
    }
    
    public function send_smsCodeAjax(){//发送验证码
    
        $phone = $this->input->get_post('phone');//得到手机号
        
        $randCode = rand(pow(10, 5), (pow(10, 6)-1));//生成6位随机数
        
        //加载短信验证模型类
        $this->load->model('mobile/Smsvalid_model','smsvalid');
        //add_smsvalidOne方法向短信验证码表中添加一条记录
        $addStatus = $this->smsvalid->add_smsvalidOne($phone,$randCode);//返回添加记录状态
        if($addStatus){
            $data['state'] = 'success';
            $api_callback = send_sms_api($phone,$randCode);
            $data['api_callback'] = $api_callback;
        }else{
            $data['state'] = 'failed';
            $data['msg'] = '程序错误，请重试';
        }
        
        echo json_encode($data);
    }
    
    public function check_phoneRegister($phone){//判断手机号是否已注册
    
        //加载用户模型类
        $this->load->model('mobile/User_model','user');
        //get_phoneRegStatus方法得到手机号注册状态，1为已注册，0为未注册
        $regStatus = $this->user->get_phoneRegStatus($phone);
        return $regStatus;
    }
    
    public function check_phoneRegisterAjax(){//判断手机号是否已注册
        
        $phone = $this->input->get_post('phone');//得到手机号
        //加载用户模型类
        $this->load->model('mobile/User_model','user');
        //get_phoneRegStatus方法得到手机号注册状态，1为已注册，0为未注册
        $regStatus = $this->user->get_phoneRegStatus($phone);
        if($regStatus){
            $data['state'] = 'reg';
        }else{
            $data['state'] = 'unreg';
        }
        
        echo json_encode($data);
    }
    
    function record_user_login_info($userinfo,$ip_address){//记录用户登录日志
    
        if(isset($userinfo) && !empty($userinfo)){
            
            $this->load->library('user_agent');
            $this->load->helper('cookie');
            //加载用户模型类
            $this->load->model('mobile/User_model','user');
            
            //记录登录信息
            $login_userid = $userinfo->user_id;
            $login_phone = $userinfo->user_phone;
            $login_name = $userinfo->user_name;
            $login_client = "";
            if($this->agent->is_mobile()){
                $login_client = $login_client.$this->agent->mobile();
            }
            if($this->agent->is_browser()){
                $login_client = $login_client.' '.$this->agent->browser().' '.$this->agent->version();
            }
            $login_ip = $ip_address;
            $city_array = get_city_byip($login_ip);
            $login_city = is_array($city_array)?$city_array['country'].' '.$city_array['region'].' '.$city_array['city']:'';
            $login_time = date("Y-m-d H:i:s", time());
            //add_userLoginOne方法记录用户登录信息
            $recordLogin = $this->user->add_userLoginOne($login_userid,$login_phone,$login_name,$login_client,$login_ip,$login_city,$login_time);
            
            //设session
            $this->session->userinfo = $userinfo;
            //设cookie
            set_cookie('user_phone',$userinfo->user_phone,259200);
            set_cookie('user_name',$userinfo->user_name,259200);
            
        }
    }
    
    public function send_phoneLoginAjax(){//登录账号
        
        $login_type = $this->input->get_post('login_type');//得到登录方式
        $phone = $this->input->get_post('phone_num');//得到手机号
        $pwd = $this->input->get_post('pwd_num');//得到登录密码
        $code = $this->input->get_post('code_num');//得到短信验证码
        $ip_address = $this->input->get_post('ip_address');//得到IP地址
        
        //判断手机号是否已注册,1为已注册，0为未注册
        $regStatus = $this->check_phoneRegister($phone);
        if($regStatus == 0){//提示未注册
            $data['state'] = 'failed';
            $data['msg'] = '该手机号未注册，请先注册';
            echo json_encode($data);
            exit;
        }
        
        if($login_type == 'sms_login'){//如果当前是验证码登录
            //加载短信验证模型类
            $this->load->model('mobile/Smsvalid_model','smsvalid');
            //isvalid_smsCode方法判断短信验证码是否正确
            $smsValid = $this->smsvalid->isvalid_smsCode($phone,$code);
            $login_success = $smsValid;
        }else{
            //isvalid_pwdPhone方法判断用户名密码是否正确
            $pwdValid = $this->user->isvalid_pwdPhone($phone,md5($pwd));
            $login_success = $pwdValid;
        }
        
        
        if($login_success == 1){//如果正确，则登录
            //根据手机号拿到用户信息
            $userinfo = $this->user->get_userByPhone($phone);
            
            if(isset($userinfo) && !empty($userinfo)){
                //记录用户登录日志
                $this->record_user_login_info($userinfo,$ip_address);
                
                $data['state'] = 'success';
                $data['msg'] = '登录成功';
                $data['userinfo'] = array(
                    'user_phone'=>$userinfo->user_phone,
                    'user_name'=>$userinfo->user_name
                );
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '程序错误，请重试';
            }
            
        }else{
            $data['state'] = 'failed';
            if($login_type == 'sms_login'){//如果当前是验证码登录
                $data['msg'] = '验证码错误，请重试';
            }else{
                $data['msg'] = '账号密码错误，请重试';
            }
        }
        
        echo json_encode($data);
    }
    
    public function send_phoneRegisterAjax(){//注册账号
        
        $this->load->helper('cookie');
        $this->load->library('user_agent');
        
        $phone = $this->input->get_post('phone_reg');//得到手机号
        $pwd = $this->input->get_post('pwd_reg');//得到登录密码
        $code = $this->input->get_post('code_reg');//得到短信验证码
        $ip_address = $this->input->get_post('ip_address');//得到IP地址
        
        //判断手机号是否已注册,1为已注册，0为未注册
        $regStatus = $this->check_phoneRegister($phone);
        if($regStatus == 1){//提示已注册
            $data['state'] = 'failed';
            $data['msg'] = '该手机号已被注册，请更换';
            echo json_encode($data);
            exit;
        }
        
        //加载短信验证模型类
        $this->load->model('mobile/Smsvalid_model','smsvalid');
        //isvalid_smsCode方法判断短信验证码是否正确
        $smsValid = $this->smsvalid->isvalid_smsCode($phone,$code);
        if($smsValid == 1){//如果正确，则添加新账户
            //加载用户模型类
            $this->load->model('mobile/User_model','user');
            //add_userOne方法添加新账户
            $createStatus = $this->user->add_userOne($phone,md5($pwd),$phone);
            if($createStatus){//如果添加成功
                
                //根据手机号拿到用户信息
                $userinfo = $this->user->get_userByPhone($phone);
                if(isset($userinfo) && !empty($userinfo)){
                    //记录用户登录日志
                    $this->record_user_login_info($userinfo,$ip_address);
                    
                    $data['state'] = 'success';
                    $data['msg'] = '注册成功';
                    $data['userinfo'] = array(
                        'user_phone'=>$userinfo->user_phone,
                        'user_name'=>$userinfo->user_name
                    );
                }else{
                    $data['state'] = 'failed';
                    $data['msg'] = '程序错误，请重试';
                }
                
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '程序错误，请重试';
            }
        }else{
            $data['state'] = 'failed';
            $data['msg'] = '验证码错误，请重试';
        }
        
        echo json_encode($data);
    }
    
    public function send_phoneFindpwdAjax(){//找回密码
        
        $this->load->helper('cookie');
        $this->load->library('user_agent');
        
        $phone = $this->input->get_post('phone_find');//得到手机号
        $pwd = $this->input->get_post('pwd_find');//得到登录密码
        $code = $this->input->get_post('code_find');//得到短信验证码
        
        //判断手机号是否已注册,1为已注册，0为未注册
        $regStatus = $this->check_phoneRegister($phone);
        if($regStatus == 0){//提示未注册
            $data['state'] = 'failed';
            $data['msg'] = '该手机号未注册，请先注册';
            echo json_encode($data);
            exit;
        }
        
        //加载短信验证模型类
        $this->load->model('mobile/Smsvalid_model','smsvalid');
        //isvalid_smsCode方法判断短信验证码是否正确
        $smsValid = $this->smsvalid->isvalid_smsCode($phone,$code);
        if($smsValid == 1){//如果正确，则重设密码
            //加载用户模型类
            $this->load->model('mobile/User_model','user');
            //reset_userPassword方法重设密码
            $resetStatus = $this->user->reset_userPassword($phone,md5($pwd));
            if($resetStatus){//如果重设密码成功
                
                //根据手机号拿到用户信息
                $userinfo = $this->user->get_userByPhone($phone);
                if(isset($userinfo) && !empty($userinfo)){
                    
                    $data['state'] = 'success';
                    $data['msg'] = '密码已重设';
                    $data['userinfo'] = array(
                        'user_phone'=>$userinfo->user_phone,
                        'user_name'=>$userinfo->user_name
                    );
                }else{
                    $data['state'] = 'failed';
                    $data['msg'] = '程序错误，请重试';
                }
                
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '程序错误，请重试';
            }
        }else{
            $data['state'] = 'failed';
            $data['msg'] = '验证码错误，请重试';
        }
        
        echo json_encode($data);
    }
    
    public function login_out(){//退出登录
        //删除登录信息session
        if(isset($_SESSION['userinfo'])){
            unset($_SESSION['userinfo']);
        }
        redirect(base_url().'m/');
    }
    
    public function set_adHeartAjax(){//ajax点赞广告或者取消广告
        $ad_id = $this->input->get_post('ad_id');//得到广告id
        $heart_num = $this->input->get_post('heart_num');//得到点赞数量（1或者-1）
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(empty($session_userinfo->user_id)){
            return;
        }
        $user_id = $session_userinfo->user_id;
        
        //加载广告模型类
        $this->load->model('mobile/Advertisement_model','advertisement');
        //get_adinfoById方法得到广告详情
        $ad_info = $this->advertisement->get_adinfoById($ad_id);//根据id获取广告信息
        if(isset($ad_info->heart_amount)){//如果存在该广告
            $newHeart = $ad_info->heart_amount + $heart_num;
            $updateStatus = $this->advertisement->edit_adinfoHeart($ad_id,$newHeart);//返回修改广告点赞数状态
            if($updateStatus){//如果修改成功
                //add_adHeartRecord记录用户点赞日志
                $record_heart = $this->advertisement->add_adHeartRecord($ad_id,$heart_num,$user_id);
                
                $data['state'] = 'success';
                $data['new_heart'] = $newHeart;
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '程序错误，请重试';
            }
        }else{
            $data['state'] = 'failed';
            $data['msg'] = '程序错误，请重试';
        }
        
        echo json_encode($data);
    }
    
    public function about(){//关于我们
        
        $seo = array(
            'seo_title'=>'关于我们 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('mobile/about',$data);
    }
    
    public function agreement(){//用户协议
        
        $seo = array(
            'seo_title'=>'用户协议 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('mobile/agreement',$data);
    }
    
}
?>