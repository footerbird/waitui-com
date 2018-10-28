<?php
class Index_controller extends CI_Controller {
    
    public function article_list(){//文章列表
        
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleCategory方法得到文章分类信息
        $article_category = $this->article->get_articleCategory();
        $data['article_category'] = $article_category;
        //get_articleList方法得到头条列表
        $article_list = $this->article->get_articleList('',0,10);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
            $author_info = $this->article->get_authorinfoById($article->author_id);
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
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //get_userinfoById方法获取用户信息
            $userinfo = $this->user->get_userinfoById($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $this->module = constant('MEMU_ARTICLE');
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
            $author_info = $this->article->get_authorinfoById($article->author_id);
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
        
        $data['keyword'] = urldecode($keyword);
        
        //加载头条模型类
        $this->load->model('waitui/Article_model','article');
        //get_articleSearch方法得到头条搜索列表
        $article_list = $this->article->get_articleSearch(urldecode($keyword),0,10);
        foreach($article_list as $article){
            $article->create_time = format_article_time($article->create_time);
            $author_info = $this->article->get_authorinfoById($article->author_id);
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
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //get_userinfoById方法获取用户信息
            $userinfo = $this->user->get_userinfoById($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $this->module = constant('MEMU_ARTICLE');
        
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
            $author_info = $this->article->get_authorinfoById($article->author_id);
            $article->author_name = $author_info->author_name;
        }
        $data['article_list'] = $article_list;
        
        $this->load->view('waitui/templete/tpl_article',$data);
    }
    
    public function article_detail($article_id){//文章详情
        
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
        
        $author_info = $this->article->get_authorinfoById($article->author_id);
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
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //get_userinfoById方法获取用户信息
            $userinfo = $this->user->get_userinfoById($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $this->module = constant('MEMU_ARTICLE');
        
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
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //get_userinfoById方法获取用户信息
            $userinfo = $this->user->get_userinfoById($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $this->module = constant('MEMU_MARK');
        
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
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //get_userinfoById方法获取用户信息
            $userinfo = $this->user->get_userinfoById($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $this->module = constant('MEMU_MARK');
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
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //get_userinfoById方法获取用户信息
            $userinfo = $this->user->get_userinfoById($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $this->module = constant('MEMU_MARK');
        
        $seo = array(
            'seo_title'=>'商标市场 - 让商标转让更简单 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/mark_detail',$data);
    }
    
    public function domain_list(){//域名首页
        
        $page = $this->input->get('page');//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        
        //加载域名模型类
        $this->load->model('waitui/Domain_model','domain');
        //get_domainCount方法得到域名总数
		$count = $this->domain->get_domainCount();
        
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
        $domain_list = $this->domain->get_domainList($offset,$page_size);
        foreach($domain_list as $domain){
        	$domain->expired_date = format_domain_exptime($domain->expired_date);
        }
        $data['domain_list'] = $domain_list;
        
        $session_userinfo = $this->session->userinfo;//从session中获取用户信息
        if(!empty($session_userinfo->user_id)){
            $user_id = $session_userinfo->user_id;
            //加载用户模型类
            $this->load->model('waitui/User_model','user');
            //get_userinfoById方法获取用户信息
            $userinfo = $this->user->get_userinfoById($user_id);
            $data['userinfo'] = $userinfo;
        }
        
        $this->module = constant('MEMU_DOMAIN');
        
        $seo = array(
            'seo_title'=>'域名市场 - 域名交易就是这么简单 | 外推网',
            'seo_keywords'=>'',
            'seo_description'=>''
        );
        $data['seo'] = json_decode(json_encode($seo));
        
        $this->load->view('waitui/domain_list',$data);
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
            $userinfo = $this->user->get_userinfoByPhone($phone);
            
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
            //add_userinfoOne方法添加新账户
            $createStatus = $this->user->add_userinfoOne($phone,md5($pwd),$phone);
            if($createStatus){//如果添加成功
                
                //根据手机号拿到用户信息
                $userinfo = $this->user->get_userinfoByPhone($phone);
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
                $userinfo = $this->user->get_userinfoByPhone($phone);
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