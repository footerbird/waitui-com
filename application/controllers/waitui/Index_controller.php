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
    
    public function get_userinfo(){//验证是否登录,并获取用户信息
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $userinfo = $session_userinfo;
            return $userinfo;
        }else{
            if($this->module == constant('MEMU_MY')){
                redirect(base_url());
                exit;
            }
        }
    }
    
    public function article_list(){//文章列表
        $this->module = constant('MEMU_ARTICLE');
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleCategory方法得到文章分类信息
        $article_category = $this->article->get_articleCategory();
        $data['article_category'] = $article_category;
        //get_articleList方法得到头条列表
        $article_list = $this->article->get_articleList('',0,10);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
            $author_info = $this->article->get_authorDetail($article->author_id);
            $article->author_name = $author_info->author_name;
        }
        $data['article_first'] = $article_list[0];
        $data['article_second'] = $article_list[1];
        $data['article_third'] = $article_list[2];
        $data['article_list'] = array_slice($article_list, 3);
        
        //get_articleRecommend方法得到推荐阅读列表
        $article_recommend = $this->article->get_articleRecommend(0,3);
        $data['article_recommend'] = $article_recommend;
        
        //get_articleHotword方法得到热搜词列表
        $article_hotword = $this->article->get_articleHotword(0,10);
        $data['article_hotword'] = $article_hotword;
        
        //加载快讯模型类
        $this->load->model('waitui/Flash_model','flash');
        //get_flashList方法得到头条列表
        $flash_list = $this->flash->get_flashList(0,5);
        foreach($flash_list as $flash){
            $flash->create_time = format_article_time($flash->create_time);
        }
        $data['flash_list'] = $flash_list;
        
        $this->footer = 'no';//默认有底部
        
        $seo = array(
            'seo_title'=>'外推头条 - 专业的品牌资讯分享平台 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $data['styles'] = array(
            '/htdocs/waitui/css/swiper.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            '/htdocs/waitui/js/swiper.min.js?'.CACHE_TIME,
            '/htdocs/waitui/js/swiper.animate.min.js?'.CACHE_TIME
        );
        
        $this->load->view('waitui/article_list',$data);
    }
    
    public function get_articleListAjax_tpl(){//文章列表加载更多（模板加載）
        
        $category = $this->input->get_post('category');//得到文章类型
        $category = $category?$category:'';
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $repeat = $this->input->get_post('repeat');//得到过滤的重复文章id数组
        $repeat = $repeat?$repeat:[];
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleList方法得到头条列表
        $article_list = $this->article->get_articleList($category,$offset,$page_size);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
            $author_info = $this->article->get_authorDetail($article->author_id);
            $article->author_name = $author_info->author_name;
        }
        
        if(count($repeat) != 0){
            foreach($article_list as $key => $article){
                if(in_array($article->article_id, $repeat)){
                    unset($article_list[$key]);
                }
            }
        }
        
        $data['article_list'] = $article_list;
        
        $this->load->view('waitui/templete/tpl_article',$data);
    }
    
    public function article_search($keyword){//文章搜索
        $this->module = constant('MEMU_ARTICLE');
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $data['keyword'] = urldecode($keyword);
        
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleSearch方法得到头条搜索列表
        $article_list = $this->article->get_articleSearch(urldecode($keyword),0,10);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
            $author_info = $this->article->get_authorDetail($article->author_id);
            $article->author_name = $author_info->author_name;
        }
        $data['article_list'] = $article_list;
        
        //get_articleRecommend方法得到推荐阅读列表
        $article_recommend = $this->article->get_articleRecommend(0,3);
        $data['article_recommend'] = $article_recommend;
		
        //add_articleHotword方法添加热搜词
        $this->article->add_articleHotword(urldecode($keyword));
        
		//get_articleHotword方法得到热搜词列表
		$article_hotword = $this->article->get_articleHotword(0,10);
		$data['article_hotword'] = $article_hotword;
        
        //加载快讯模型类
        $this->load->model('waitui/Flash_model','flash');
        //get_flashList方法得到头条列表
        $flash_list = $this->flash->get_flashList(0,5);
        foreach($flash_list as $flash){
            $flash->create_time = format_article_time($flash->create_time);
        }
        $data['flash_list'] = $flash_list;
        
        $seo = array(
            'seo_title'=>'外推头条 - 专业的品牌资讯分享平台 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $data['styles'] = array(
            '/htdocs/waitui/css/swiper.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            '/htdocs/waitui/js/swiper.min.js?'.CACHE_TIME,
            '/htdocs/waitui/js/swiper.animate.min.js?'.CACHE_TIME
        );
        
        $this->load->view('waitui/article_search',$data);
    }
    
    public function get_articleSearchAjax_tpl(){//文章搜索加载更多（模板加載）
        
        $keyword = $this->input->get_post('keyword');//得到文章类型
        $keyword = $keyword?$keyword:'';
        $page = $this->input->get_post('page');//得到页码
        $page = $page?$page:1;
        $page_size = 10;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleSearch方法得到头条搜索列表
        $article_list = $this->article->get_articleSearch(urldecode($keyword),$offset,$page_size);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
            $author_info = $this->article->get_authorDetail($article->author_id);
            $article->author_name = $author_info->author_name;
        }
        $data['article_list'] = $article_list;
        
        $this->load->view('waitui/templete/tpl_article',$data);
    }
    
    public function article_detail($article_id){//文章详情
        $this->module = constant('MEMU_ARTICLE');
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //edit_articleRead方法改变文章阅读数
        $updateStatus = $this->article->edit_articleRead($article_id);
        
        //get_articleDetail方法得到文章详情
        $article = $this->article->get_articleDetail($article_id);
        if(empty($article)){
            $heading = '404 Page Not Found';
            $message = 'The page you requested was not found.';
            show_error($message, 404, $heading );
            exit;
        }
        $article->create_time = format_article_time($article->create_time);
        
        $author_info = $this->article->get_authorDetail($article->author_id);
        $article->author_name = $author_info->author_name;
        $article->figure_path = $author_info->figure_path;
        $data['article'] = $article;
        
        //加载相关阅读
        $category = $article->article_category;
        $article_relative = $this->article->get_articleList($category,0,10);
        foreach($article_relative as $key => $relative){
            if($relative->article_id == $article_id){
                unset($article_relative[$key]);
            }
        }
        $data['article_relative'] = $article_relative;
        
        //加载快讯模型类
        $this->load->model('waitui/Flash_model','flash');
        //get_flashList方法得到头条列表
        $flash_list = $this->flash->get_flashList(0,5);
        foreach($flash_list as $flash){
            $flash->create_time = format_article_time($flash->create_time);
        }
        $data['flash_list'] = $flash_list;
        
        $seo = array(
            'seo_title'=>$article->article_title.' | 外推头条',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $data['styles'] = array(
            '/htdocs/waitui/css/swiper.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            '/htdocs/waitui/js/swiper.min.js?'.CACHE_TIME,
            '/htdocs/waitui/js/swiper.animate.min.js?'.CACHE_TIME
        );
        
        $this->load->view('waitui/article_detail',$data);
    }
    
    public function mark_list(){//商标首页
        $this->module = constant('MEMU_MARK');
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        //加载商标模型类
        $this->load->model('waitui/Mark_model','mark');
        //get_markCategory方法得到商标大类信息
        $mark_category = $this->mark->get_markCategory();
        $data['mark_category'] = $mark_category;
        
        $mark_list = array();
        for($i=0;$i<5;$i++){
            //get_markList方法得到商标列表
            array_push($mark_list,$this->mark->get_markList($i*9+1,0,8));
        }
        $data['mark_list'] = $mark_list;
        
        $seo = array(
            'seo_title'=>'商标市场 - 让商标转让更简单 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/mark_list',$data);
    }
    
    public function get_markBlockAjax_tpl(){
        
        $category = $this->input->get_post('category');//得到商标大类
        $category = $category?$category:'';
        
        //加载商标模型类
        $this->load->model('waitui/Mark_model','mark');
        //get_markList方法得到商标列表
        $mark_block = $this->mark->get_markList($category,0,8);
        $data['mark_block'] = $mark_block;
        
        $this->load->view('waitui/templete/tpl_mark_block',$data);
        
    }
    
    public function mark_search($keyword = ''){//商标搜索
        $this->module = constant('MEMU_MARK');
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $data['keyword'] = urldecode($keyword);
        $filter_category = $this->input->get_post('filter_category');//得到商标大类
        $data['filter_category'] = $filter_category;
        
        //加载商标模型类
        $this->load->model('waitui/Mark_model','mark');
        //get_markCategory方法得到商标大类信息
        $mark_category = $this->mark->get_markCategory();
        $data['mark_category'] = $mark_category;
        
        //get_markSearch方法得到搜索商标列表
        $mark_list = $this->mark->get_markSearch(urldecode($keyword),0,25,'',$filter_category,'','','');//一页25条
        $data['mark_list'] = $mark_list;
        //get_markSearchCount方法得到搜索商标总量
        $mark_count = $this->mark->get_markSearchCount(urldecode($keyword),$filter_category,'','','');
        $data['mark_count'] = $mark_count;
        
        $this->footer = 'no';//默认有底部
        
        $seo = array(
            'seo_title'=>'商标市场 - 让商标转让更简单 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/mark_search',$data);
    }
    
    public function get_markSearchAjax_tpl(){//商标搜索加载更多（模板加載）
        
        $keyword = $this->input->get_post('keyword');//得到商标关键字
        $keyword = $keyword?$keyword:'';
        
        $filter_category = $this->input->get_post('filter_category');//得到商标大类
        $filter_category = $filter_category?$filter_category:'';
        
        $filter_type = $this->input->get_post('filter_type');//得到商标类型
        $filter_type = $filter_type?$filter_type:'';
        
        $filter_price = $this->input->get_post('filter_price');//得到商标价格区间
        $filter_price = $filter_price?$filter_price:'';
        
        $filter_length = $this->input->get_post('filter_length');//得到商标长度区间
        $filter_length = $filter_length?$filter_length:'';
        
        $mark_sort = $this->input->get_post('mark_sort');//得到商标排序方式
        $mark_sort = $mark_sort?$mark_sort:'';
        
        $page = $this->input->get_post('mark_page');//得到页码
        $page = $page?$page:1;
        $page_size = 25;//单页记录数
        $offset = ($page-1)*$page_size;//偏移量
        //加载商标模型类
        $this->load->model('waitui/Mark_model','mark');
        //get_markSearch方法得到商标搜索列表
        $mark_list = $this->mark->get_markSearch(urldecode($keyword),$offset,$page_size,$mark_sort,$filter_category,$filter_type,$filter_price,$filter_length);
        $data['mark_list'] = $mark_list;
        
        $this->load->view('waitui/templete/tpl_mark',$data);
    }
    
    public function get_markSearchCountAjax(){//商标搜索结果个数
        
        $keyword = $this->input->get_post('keyword');//得到商标关键字
        $keyword = $keyword?$keyword:'';
        
        $filter_category = $this->input->get_post('filter_category');//得到商标大类
        $filter_category = $filter_category?$filter_category:'';
        
        $filter_type = $this->input->get_post('filter_type');//得到商标类型
        $filter_type = $filter_type?$filter_type:'';
        
        $filter_price = $this->input->get_post('filter_price');//得到商标价格区间
        $filter_price = $filter_price?$filter_price:'';
        
        $filter_length = $this->input->get_post('filter_length');//得到商标长度区间
        $filter_length = $filter_length?$filter_length:'';
        
        //加载头条模型类
        $this->load->model('waitui/Mark_model','mark');
        //get_markSearchCount方法得到搜索商标总量
        $mark_count = $this->mark->get_markSearchCount(urldecode($keyword),$filter_category,$filter_type,$filter_price,$filter_length);
        $data['mark_count'] = $mark_count;
        
        echo json_encode($data);
    }
    
    public function mark_detail($regno_md){//商标详情
        $this->module = constant('MEMU_MARK');
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        //加载商标模型类
        $this->load->model('waitui/Mark_model','mark');
        //get_markDetail方法得到商标详情
        $mark = $this->mark->get_markDetail($regno_md);
        if(empty($mark)){
            $heading = '404 Page Not Found';
            $message = 'The page you requested was not found.';
            show_error($message, 404, $heading );
            exit;
        }
        //get_categoryName获取大类名称
        $category = $this->mark->get_categoryName($mark->mark_category);
        $mark->category_name = $category->category_name;
        $mark->reg_year = format_markreg_year($mark->reg_date);
        $mark->mark_flow = json_decode($mark->mark_flow);
        $mark->regno_encode = strtoupper(random_string_numlet(6)).str_replace("=","",base64_encode($mark->mark_regno));//把非法字符'='替换掉
        $data['mark'] = $mark;
        
        $seo = array(
            'seo_title'=>'商标市场 - 让商标转让更简单 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/mark_detail',$data);
    }
    
    public function domain_list(){//域名首页
        $this->module = constant('MEMU_DOMAIN');
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $page = $this->input->get('page');//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        
        $keyword = $this->input->get_post('keyword');//得到域名关键字
        $keyword = $keyword?$keyword:'';
        
        $domain_type = $this->input->get_post('domain_type');//得到域名类型
        $domain_type = $domain_type?$domain_type:'';
        
        //加载域名模型类
        $this->load->model('waitui/Domain_model','domain');
        //get_domainCount方法得到域名总数
        $count = $this->domain->get_domainCount($keyword,$domain_type);
        
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
        $config['base_url'] = base_url().'domain_list.html';
        $config['total_rows'] = $count;
        $config['per_page'] = $page_size;// $pagesize每页条数
        $config['num_links'] = $num_links;//设置选中页左右两边的页数
        $this->pagination->initialize($config);
        $data['page_count'] = $count;
        $data['page_size'] = $page_size;
        
        //get_domainList方法得到域名列表信息
        $domain_list = $this->domain->get_domainList($keyword,$offset,$page_size,$domain_type);
        foreach($domain_list as $domain){
            $domain->expired_date = format_domain_exptime($domain->expired_date);
        }
        $data['domain_list'] = $domain_list;
        $data['keyword'] = $keyword;
        $data['domain_type'] = $domain_type;
        
        $seo = array(
            'seo_title'=>'域名市场 - 域名交易就是这么简单 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/domain_list',$data);
    }
    
    public function domain_detail($domain_name){//域名详情
        $this->module = constant('MEMU_DOMAIN');
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        //加载商标模型类
        $this->load->model('waitui/Domain_model','domain');
        //get_domainDetail方法得到域名详情
        $domain = $this->domain->get_domainDetail($domain_name);
        if(empty($domain)){
            $heading = '404 Page Not Found';
            $message = 'The page you requested was not found.';
            show_error($message, 404, $heading );
            exit;
        }
        $domain->expired_distance = format_domain_exptime($domain->expired_date);
        $data['domain'] = $domain;
        
        //get_domainRecommend方法得到推荐域名列表
        $domain_recommend = $this->domain->get_domainRecommend(0,10);
        $data['domain_recommend'] = $domain_recommend;
        
        $seo = array(
            'seo_title'=>'域名市场 - 域名交易就是这么简单 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/domain_detail',$data);
    }
    
    public function agreement(){//用户协议
        $this->module = '';
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $seo = array(
            'seo_title'=>'外推网用户协议 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/agreement',$data);
    }
    
    public function my_console(){//控制台
        $this->module = constant('MEMU_MY');
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        $data['userinfo'] = $userinfo;
        
        $user_id = $userinfo->user_id;
        //加载用户模型类
        $this->load->model('waitui/User_model','user');
        //get_loginRecord方法得到登录日志列表信息
        $login_list = $this->user->get_loginRecord($user_id,0,10);//最近登录10条记录
        $data['login_list'] = $login_list;
        
        //get_butlerDetail方法得到品牌管家信息
        $user_butler = $this->user->get_butlerDetail($userinfo->user_butler);
        $data['user_butler'] = $user_butler;
        
        //get_certifyByUser方法得到用户企业认证信息
        $certify_list = $this->user->get_certifyByUser($user_id);
        if(count($certify_list) == 0){
            $data['company_certify'] = '';
        }else{
            $data['company_certify'] = $certify_list[0];
        }
        
        //get_myMessageCount方法得到我的消息
        $unreadCount = $this->user->get_myMessageCount($user_id,'unread');
        $data['unreadCount'] = $unreadCount;
        
        //加载域名模型类
        $this->load->model('waitui/Domain_model','domain');
        //get_myDomainList方法得到我的域名列表信息
        $domain_list = $this->domain->get_myDomainList($user_id,'',0,3);
        foreach($domain_list as $domain){
            $domain->expired_distance = format_domain_exptime($domain->expired_date);
        }
        $data['domain_list'] = $domain_list;
        
        //加载商标模型类
        $this->load->model('waitui/Mark_model','mark');
        //get_myMarkList方法得到我的商标列表信息
        $mark_list = $this->mark->get_myMarkList($user_id,'',0,3);
        foreach($mark_list as $mark){
            //get_categoryName获取大类名称
            $category = $this->mark->get_categoryName($mark->mark_category);
            $mark->category_name = $category->category_name;
        }
        $data['mark_list'] = $mark_list;
        
        //加载快讯模型类
        $this->load->model('waitui/Flash_model','flash');
        //get_flashList方法得到头条列表
        $flash_list = $this->flash->get_flashList(0,5);
        foreach($flash_list as $flash){
            $flash->create_time = format_article_time($flash->create_time);
        }
        $data['flash_list'] = $flash_list;
        
        $this->leftmenu = 'my_console';
        
        $seo = array(
            'seo_title'=>'控制台 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $data['styles'] = array(
            '/htdocs/waitui/css/swiper.min.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            '/htdocs/waitui/js/swiper.min.js?'.CACHE_TIME,
            '/htdocs/waitui/js/swiper.animate.min.js?'.CACHE_TIME
        );
        
        $this->load->view('waitui/my/my_console',$data);
    }
    
    public function my_domain($page = 1){//我的域名
        $this->module = constant('MEMU_MY');
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        $data['userinfo'] = $userinfo;
        
        $keyword = $this->input->get_post('keyword');//得到域名关键字
        $keyword = $keyword?$keyword:'';
        
        $user_id = $userinfo->user_id;
        //加载域名模型类
        $this->load->model('waitui/Domain_model','domain');
        //get_myDomainCount方法得到我的域名总数
        $count = $this->domain->get_myDomainCount($user_id,$keyword);
        
        $page_size = 10;//单页记录数
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
        $config['page_query_string'] = FALSE;//使用 URI 段
        $config['reuse_query_string'] = TRUE;//将查询字符串参数添加到 URI 分段的后面
        $config['base_url'] = base_url().'my_domain';
        $config['total_rows'] = $count;
        $config['per_page'] = $page_size;// $pagesize每页条数
        $config['num_links'] = $num_links;//设置选中页左右两边的页数
        $this->pagination->initialize($config);
        $data['page_count'] = $count;
        $data['page_size'] = $page_size;
        
        //get_myDomainList方法得到我的域名列表信息
        $domain_list = $this->domain->get_myDomainList($user_id,$keyword,$offset,$page_size);
        foreach($domain_list as $domain){
            $domain->expired_distance = format_domain_exptime($domain->expired_date);
        }
        $data['domain_list'] = $domain_list;
        $data['keyword'] = $keyword;
        
        $this->leftmenu = 'my_domain';
        
        $seo = array(
            'seo_title'=>'我的域名 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/my/my_domain',$data);
    }
    
    public function my_mark($page = 1){//我的商标
        $this->module = constant('MEMU_MY');
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        $data['userinfo'] = $userinfo;
        
        $keyword = $this->input->get_post('keyword');//得到域名关键字
        $keyword = $keyword?$keyword:'';
        
        $user_id = $userinfo->user_id;
        //加载商标模型类
        $this->load->model('waitui/Mark_model','mark');
        //get_myMarkCount方法得到我的商标总数
        $count = $this->mark->get_myMarkCount($user_id,$keyword);
        
        $page_size = 10;//单页记录数
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
        $config['page_query_string'] = FALSE;//使用 URI 段
        $config['reuse_query_string'] = TRUE;//将查询字符串参数添加到 URI 分段的后面
        $config['base_url'] = base_url().'my_mark';
        $config['total_rows'] = $count;
        $config['per_page'] = $page_size;// $pagesize每页条数
        $config['num_links'] = $num_links;//设置选中页左右两边的页数
        $this->pagination->initialize($config);
        $data['page_count'] = $count;
        $data['page_size'] = $page_size;
        
        //get_myMarkList方法得到我的商标列表信息
        $mark_list = $this->mark->get_myMarkList($user_id,$keyword,$offset,$page_size);
        foreach($mark_list as $mark){
            //get_categoryName获取大类名称
            $category = $this->mark->get_categoryName($mark->mark_category);
            $mark->category_name = $category->category_name;
        }
        $data['mark_list'] = $mark_list;
        $data['keyword'] = $keyword;
        
        $this->leftmenu = 'my_mark';
        
        $seo = array(
            'seo_title'=>'我的商标 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/my/my_mark',$data);
    }
    
    public function my_order($page = 1){//我的订单
        $this->module = constant('MEMU_MY');
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $count = 360;
        $page_size = 10;//单页记录数
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
        $config['page_query_string'] = FALSE;//使用 URI 段
        $config['reuse_query_string'] = TRUE;//将查询字符串参数添加到 URI 分段的后面
        $config['base_url'] = base_url().'my_order';
        $config['total_rows'] = $count;
        $config['per_page'] = $page_size;// $pagesize每页条数
        $config['num_links'] = $num_links;//设置选中页左右两边的页数
        $this->pagination->initialize($config);
        $data['page_count'] = $count;
        $data['page_size'] = $page_size;
        
        $this->leftmenu = 'my_order';
        
        $seo = array(
            'seo_title'=>'我的订单 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/my/my_order',$data);
    }
    
    public function my_invoice(){//发票管理
        $this->module = constant('MEMU_MY');
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $this->leftmenu = 'my_invoice';
        
        $seo = array(
            'seo_title'=>'发票管理 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/my/my_invoice',$data);
    }
    
    public function invoice_record(){//发票申请记录
        $this->module = constant('MEMU_MY');
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $this->leftmenu = 'my_invoice';
        
        $seo = array(
            'seo_title'=>'发票申请记录 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/my/invoice_record',$data);
    }
    
    public function my_coupon($page = 1){//优惠券
        $this->module = constant('MEMU_MY');
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        $data['userinfo'] = $userinfo;
        
        $count = 0;
        $page_size = 9;//单页记录数
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
        $config['page_query_string'] = FALSE;//使用 URI 段
        $config['reuse_query_string'] = TRUE;//将查询字符串参数添加到 URI 分段的后面
        $config['base_url'] = base_url().'my_coupon';
        $config['total_rows'] = $count;
        $config['per_page'] = $page_size;// $pagesize每页条数
        $config['num_links'] = $num_links;//设置选中页左右两边的页数
        $this->pagination->initialize($config);
        $data['page_count'] = $count;
        $data['page_size'] = $page_size;
        
        $coupon_list =array();
        $data['coupon_list'] = $coupon_list;
        
        $this->leftmenu = 'my_coupon';
        
        $seo = array(
            'seo_title'=>'优惠券 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/my/my_coupon',$data);
    }
    
    public function my_account(){//账号中心
        $this->module = constant('MEMU_MY');
        $data['userinfo'] = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $this->leftmenu = 'my_account';
        
        $seo = array(
            'seo_title'=>'个人资料 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/my/my_account',$data);
    }
    
    public function upload_userFigureTemp(){//本地上传用户头像到临时目录
        $figureUpload = $_FILES['file'];
        $result = upload_images_temp($figureUpload);
        echo json_encode($result);
    }
    
    public function upload_userFigureAjax(){//ajax上传用户头像临时路径
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
    
        $figure_path = $this->input->get_post('figure_path');//得到用户头像临时目录
        if(!empty($userinfo->user_id)){
            $user_id = $userinfo->user_id;
            $user_phone = $userinfo->user_phone;
            
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
            file_put_contents('uploads/images/figure/figure_'.md5($user_phone.$rand).'.'.$imgType, $html);
            $user_figure = '/uploads/images/figure/figure_'.md5($user_phone.$rand).'.'.$imgType;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //edit_userFigure方法改变用户头像
            $updateStatus = $this->user->edit_userFigure($user_id,$user_figure);
            if($updateStatus){
                $data['state'] = 'success';
                $data['figure'] = $user_figure;
                //修改完用户信息一定要重新载入用户session
                $userinfo_new = $this->user->get_userDetail($user_id);
                $this->session->userinfo = $userinfo_new;
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
    
    public function edit_userNameAjax(){
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $user_name = $this->input->get_post('user_name');//得到用户昵称
        if(!empty($userinfo->user_id)){
            $user_id = $userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //edit_userName方法改变用户昵称
            $updateStatus = $this->user->edit_userName($user_id,$user_name);
            if($updateStatus){
                $data['state'] = 'success';
                $data['user_name'] = $user_name;
                //修改完用户信息一定要重新载入用户session
                $userinfo_new = $this->user->get_userDetail($user_id);
                $this->session->userinfo = $userinfo_new;
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
    
    public function edit_realNameAjax(){
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $real_name = $this->input->get_post('real_name');//得到真实姓名
        if(!empty($userinfo->user_id)){
            $user_id = $userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //edit_realName方法改变真实姓名
            $updateStatus = $this->user->edit_realName($user_id,$real_name);
            if($updateStatus){
                $data['state'] = 'success';
                $data['real_name'] = $real_name;
                //修改完用户信息一定要重新载入用户session
                $userinfo_new = $this->user->get_userDetail($user_id);
                $this->session->userinfo = $userinfo_new;
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
    
    public function edit_userPhoneAjax(){
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $user_phone = $this->input->get_post('user_phone');//得到手机号码
        if($user_phone == $userinfo->user_phone){//如果手机号相同,说明没改
            $data['state'] = 'success';
            $data['user_phone'] = $user_phone;
        }else{//手机号改了
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //根据手机号拿到用户信息
            $phoneInfo = $this->user->get_userByPhone($user_phone);
            if(isset($phoneInfo) && !empty($phoneInfo)){//判断新改手机号是否已经注册
                $data['state'] = 'failed';
                $data['msg'] = '该手机号已被注册，请重新输入';
            }else{
                if(!empty($userinfo->user_id)){
                    $user_id = $userinfo->user_id;
                    //edit_userPhone方法改变手机号码
                    $updateStatus = $this->user->edit_userPhone($user_id,$user_phone);
                    if($updateStatus){
                        $data['state'] = 'success';
                        $data['user_phone'] = $user_phone;
                        //修改完用户信息一定要重新载入用户session
                        $userinfo_new = $this->user->get_userDetail($user_id);
                        $this->session->userinfo = $userinfo_new;
                    }else{
                        $data['state'] = 'failed';
                        $data['msg'] = '程序错误，请重试';
                    }
                }else{
                    $data['state'] = 'failed';
                    $data['msg'] = '程序错误，请重试';
                }
            }
        }
        echo json_encode($data);
    }
    
    public function edit_userQQAjax(){
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $user_qq = $this->input->get_post('user_qq');//得到QQ号码
        if(!empty($userinfo->user_id)){
            $user_id = $userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //edit_userQQ方法改变QQ号码
            $updateStatus = $this->user->edit_userQQ($user_id,$user_qq);
            if($updateStatus){
                $data['state'] = 'success';
                $data['user_qq'] = $user_qq;
                //修改完用户信息一定要重新载入用户session
                $userinfo_new = $this->user->get_userDetail($user_id);
                $this->session->userinfo = $userinfo_new;
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
    
    public function edit_userEmailAjax(){
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $user_email = $this->input->get_post('user_email');//得到用户邮箱
        if(!empty($userinfo->user_id)){
            $user_id = $userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //edit_userEmail方法改变用户邮箱
            $updateStatus = $this->user->edit_userEmail($user_id,$user_email);
            if($updateStatus){
                $data['state'] = 'success';
                $data['user_email'] = $user_email;
                //修改完用户信息一定要重新载入用户session
                $userinfo_new = $this->user->get_userDetail($user_id);
                $this->session->userinfo = $userinfo_new;
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
    
    public function edit_userWechatAjax(){
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $user_wechat = $this->input->get_post('user_wechat');//得到微信号码
        if(!empty($userinfo->user_id)){
            $user_id = $userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //edit_userWechat方法改变微信号码
            $updateStatus = $this->user->edit_userWechat($user_id,$user_wechat);
            if($updateStatus){
                $data['state'] = 'success';
                $data['user_wechat'] = $user_wechat;
                //修改完用户信息一定要重新载入用户session
                $userinfo_new = $this->user->get_userDetail($user_id);
                $this->session->userinfo = $userinfo_new;
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
    
    public function certify_list(){//公司认证列表
        $this->module = constant('MEMU_MY');
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        $data['userinfo'] = $userinfo;
        
        $user_id = $userinfo->user_id;
        //加载用户模型类
        $this->load->model('waitui/User_model','user');
        //get_certifyByUser方法得到用户企业认证信息
        $certify_list = $this->user->get_certifyByUser($user_id);
        if(count($certify_list) == 0){//从未认证,去认证
            redirect(base_url().'company_certify');
        }else{
            $data['certify_list'] = $certify_list;
            
            $this->leftmenu = 'my_account';
            
            $seo = array(
                'seo_title'=>'公司认证 | 外推网',
                'seo_keywords'=>'',
                'seo_description'=>''
            );
            $data['seo'] = json_decode(json_encode($seo));
            
            $this->load->view('waitui/my/certify_list',$data);
        }
    }
    
    public function company_certify(){//公司认证
        $this->module = constant('MEMU_MY');
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        $data['userinfo'] = $userinfo;
        
        $certify_id = $this->input->get('certify_id');//得到企业认证编号
        if(!empty($certify_id)){
            $data['operate'] = 'update';
            $user_id = $userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //get_certifyDetail方法得到用户企业认证信息
            $company_certify = $this->user->get_certifyDetail($user_id,$certify_id);
            if(empty($company_certify)){
                $heading = '404 Page Not Found';
                $message = 'The page you requested was not found.';
                show_error($message, 404, $heading );
                exit;
            }
            $data['company_certify'] = $company_certify;
        }else{
            $data['operate'] = 'add';
        }
        
        $this->leftmenu = 'my_account';
        
        $seo = array(
            'seo_title'=>'公司认证 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $data['styles'] = array(
            '/htdocs/waitui/js/dropzone/css/dropzone.css?'.CACHE_TIME
        );
        $data['scripts'] = array(
            '/htdocs/waitui/js/dropzone/dropzone.min.js?'.CACHE_TIME
        );
        
        $this->load->view('waitui/my/company_certify',$data);
    }
    
    public function upload_businessLicenseTemp(){//本地上传营业执照到临时目录
        $licenseUpload = $_FILES['file'];
        $result = upload_images_temp($licenseUpload);
        echo json_encode($result);
    }
    
    public function upload_businessLicenseAjax(){//ajax上传营业执照临时路径
    
        $license_path = $this->input->get_post('license_path');//得到营业执照临时目录
        
        $imgInfo = getimagesize($license_path);
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
        $html = file_get_contents($license_path);
        $rand = rand(pow(10, 5), (pow(10, 6)-1));
        file_put_contents('uploads/images/business_license/license_'.md5($rand).'.'.$imgType, $html);
        $business_license = '/uploads/images/business_license/license_'.md5($rand).'.'.$imgType;
        
        $data['state'] = 'success';
        $data['license'] = $business_license;
        echo json_encode($data);
    }
    
    public function company_certifyAjax(){
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $operate = $this->input->get_post('operate');//得到操作
        $certify_id = $this->input->get_post('certify_id');//得到认证编号
        $business_license = $this->input->get_post('business_license');//得到营业执照
        $company_name = $this->input->get_post('company_name');//得到公司全称
        $oper_name = $this->input->get_post('oper_name');//得到法定代表人
        $contact_phone = $this->input->get_post('contact_phone');//得到公司电话
        $contact_email = $this->input->get_post('contact_email');//得到公司邮箱
        $contact_address = $this->input->get_post('contact_address');//得到通讯地址
        $create_time = date("Y-m-d H:i:s", time());//发布时间
        
        if(!empty($userinfo->user_id)){
            $user_id = $userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            if($operate == 'add'){//添加
                //add_compCertifyOne方法添加一条企业认证记录
                $status = 'wait';//添加时默认处于认证中状态
                $addStatus = $this->user->add_certifyOne($user_id,$business_license,$company_name,$oper_name,$contact_phone,$contact_email,$contact_address,$status,$create_time);
                if($addStatus){
                    $data['state'] = 'success';
                    $data['msg'] = '添加成功';
                }else{
                    $data['state'] = 'failed';
                    $data['msg'] = '添加失败，请重试';
                }
            }else{//修改
                //edit_certifyOne方法修改公司认证信息
                $status = 'wait';//修改时也需要将状态改为认证中,重新进行认证
                $updateStatus = $this->user->edit_certifyOne($certify_id,$business_license,$company_name,$oper_name,$contact_phone,$contact_email,$contact_address,$status,$create_time);
                if($updateStatus){
                    $data['state'] = 'success';
                    $data['msg'] = '修改成功';
                }else{
                    $data['state'] = 'failed';
                    $data['msg'] = '修改失败，请重试';
                }
            }
        }else{
            $data['state'] = 'failed';
            $data['msg'] = '程序错误，请重试';
        }
        echo json_encode($data);
    }
    
    public function my_message($page = 1){//我的消息
        $this->module = constant('MEMU_MY');
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        $data['userinfo'] = $userinfo;
        
        $status = $this->input->get('status');//得到消息状态
        if(!in_array($status,array('unread','read','del'))) $status = '';//默认全部消息
        
        $user_id = $userinfo->user_id;
        //加载用户模型类
        $this->load->model('waitui/User_model','user');
        //get_myMessageCount方法得到我的消息总数
        $count = $this->user->get_myMessageCount($user_id,$status);
        $allCount = $this->user->get_myMessageCount($user_id,'');
        $unreadCount = $this->user->get_myMessageCount($user_id,'unread');
        $readCount = $this->user->get_myMessageCount($user_id,'read');
        $delCount = $this->user->get_myMessageCount($user_id,'del');
        
        $page_size = 10;//单页记录数
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
        $config['page_query_string'] = FALSE;//使用 URI 段
        $config['reuse_query_string'] = TRUE;//将查询字符串参数添加到 URI 分段的后面
        $config['base_url'] = base_url().'my_message';
        $config['total_rows'] = $count;
        $config['per_page'] = $page_size;// $pagesize每页条数
        $config['num_links'] = $num_links;//设置选中页左右两边的页数
        $this->pagination->initialize($config);
        $data['page_count'] = $count;
        $data['page_size'] = $page_size;
        
        //get_myMessageList方法得到我的消息列表信息
        $message_list = $this->user->get_myMessageList($user_id,$status,$offset,$page_size);
        $data['message_list'] = $message_list;
        $data['status'] = $status;
        
        $data['allCount'] = $allCount;
        $data['unreadCount'] = $unreadCount;
        $data['readCount'] = $readCount;
        $data['delCount'] = $delCount;
        
        $this->leftmenu = 'my_message';
        
        $seo = array(
            'seo_title'=>'我的消息 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/my/my_message',$data);
    }
    
    public function edit_myMessageStatusBatchAjax(){
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        
        $msgid_arr = $this->input->get_post('msgid_arr');//得到消息编号
        $status = $this->input->get_post('status');//得到修改状态
        if(!empty($userinfo->user_id)){
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //edit_myMessageStatusBatch方法修改用户消息状态
            $updateStatus = $this->user->edit_myMessageStatusBatch($msgid_arr,$status);
            if($updateStatus){
                $data['state'] = 'success';
                $data['msg'] = '修改成功';
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '修改失败，请重试';
            }
        }else{
            $data['state'] = 'failed';
            $data['msg'] = '程序错误，请重试';
        }
        echo json_encode($data);
    }
    
    public function login_log($page = 1){//登录日志
        $this->module = constant('MEMU_MY');
        $userinfo = $this->get_userinfo();//验证是否登录,并获取用户信息
        $data['userinfo'] = $userinfo;
        
        $user_id = $userinfo->user_id;
        //加载用户模型类
        $this->load->model('waitui/User_model','user');
        //get_loginCount方法得到登录日志总数
        $count = $this->user->get_loginCount($user_id);
        
        $page_size = 10;//单页记录数
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
        $config['page_query_string'] = FALSE;//使用 URI 段
        $config['reuse_query_string'] = TRUE;//将查询字符串参数添加到 URI 分段的后面
        $config['base_url'] = base_url().'login_log';
        $config['total_rows'] = $count;
        $config['per_page'] = $page_size;// $pagesize每页条数
        $config['num_links'] = $num_links;//设置选中页左右两边的页数
        $this->pagination->initialize($config);
        $data['page_count'] = $count;
        $data['page_size'] = $page_size;
        
        //get_loginRecord方法得到登录日志列表信息
        $login_list = $this->user->get_loginRecord($user_id,$offset,$page_size);
        $data['login_list'] = $login_list;
        
        $this->leftmenu = 'login_log';
        
        $seo = array(
            'seo_title'=>'登录日志 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/my/login_log',$data);
    }
    
    public function send_smsCodeAjax(){//发送验证码
    
        $phone = $this->input->get_post('phone');//得到手机号
        
        $randCode = rand(pow(10, 5), (pow(10, 6)-1));//生成6位随机数
        
        //加载短信验证模型类
        $this->load->model('waitui/Smsvalid_model','smsvalid');
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
        $this->load->model('waitui/User_model','user');
        //get_phoneRegStatus方法得到手机号注册状态，1为已注册，0为未注册
        $regStatus = $this->user->get_phoneRegStatus($phone);
        return $regStatus;
    }
    
    public function check_phoneRegisterAjax(){//判断手机号是否已注册
        
        $phone = $this->input->get_post('phone');//得到手机号
        //加载用户模型类
        $this->load->model('waitui/User_model','user');
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
            $this->load->model('waitui/User_model','user');
            
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
            $this->load->model('waitui/Smsvalid_model','smsvalid');
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
        $this->load->model('waitui/Smsvalid_model','smsvalid');
        //isvalid_smsCode方法判断短信验证码是否正确
        $smsValid = $this->smsvalid->isvalid_smsCode($phone,$code);
        if($smsValid == 1){//如果正确，则添加新账户
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //add_userOne方法添加新账户
            $createStatus = $this->user->add_userOne($phone,md5($pwd),$phone);
            if($createStatus){//如果添加成功
                //根据手机号拿到用户信息
                $userinfo = $this->user->get_userByPhone($phone);
                if(isset($userinfo) && !empty($userinfo)){
                    //get_butlerListAll方法获取所有品牌管家信息
                    $butler_list = $this->user->get_butlerListAll();
                    $rad_butler = $butler_list[array_rand($butler_list,1)];
                    //随机给用户分配品牌管家
                    $butlerStatus = $this->user->edit_userButler($userinfo->user_id,$rad_butler->butler_id);
                    
                    //给用户发送用户注册成功的消息
                    $msgStatus = $this->user->add_myMessageOne($userinfo->user_id,'用户注册成功','用户注册','尊敬的用户您好，恭喜您成功注册外推网！您的登录账号为'.$phone.'，请妥善保管。');
                    
                    //修改完用户信息一定要重新载入用户session
                    $userinfo_new = $this->user->get_userDetail($userinfo->user_id);
                    //记录用户登录日志
                    $this->record_user_login_info($userinfo_new,$ip_address);
                    
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
        $this->load->model('waitui/Smsvalid_model','smsvalid');
        //isvalid_smsCode方法判断短信验证码是否正确
        $smsValid = $this->smsvalid->isvalid_smsCode($phone,$code);
        if($smsValid == 1){//如果正确，则重设密码
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
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
        redirect(base_url());
    }

}
?>