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
    
    public function login(){//管理员登录初始页
        $session_admininfo = $this->session->admininfo;//从session中获取管理员信息
        if(!empty($session_admininfo->admin_id)){
            redirect(base_url().'admin');
        }else{
            $this->load->view('admin/login');
        }
    }
    
    public function login_do(){//管理员登录
        
        $admin_name = $this->input->get_post('admin_name');//得到用户名
        $admin_pwd = $this->input->get_post('admin_pwd');//得到登录密码
        
        //加载用户模型类
        $this->load->model('admin/Admin_model','admin');
        //isvalid_pwdName方法判断用户名密码是否正确
        $login_status = $this->admin->isvalid_pwdName($admin_name,$admin_pwd);
        
        if($login_status == 1){//如果正确，则登录
            //根据登录账号拿到管理员信息
            $admininfo = $this->admin->get_adminByName($admin_name);
            if($admininfo->status != 1){
                $data['state'] = 'failed';
                $data['msg'] = '该用户已被冻结，请联系管理员';
            }elseif(isset($admininfo) && !empty($admininfo)){
                $login_time = date("Y-m-d H:i:s", time());
                //edit_adminLoginTime方法修改管理员登录时间
                $recordLogin = $this->admin->edit_adminLoginTime($admininfo->admin_id,$login_time);
                
                $this->load->library('user_agent');
                $this->load->helper('cookie');
                //设session
                $this->session->admininfo = $admininfo;
                //设cookie
                set_cookie('admin_name',$admininfo->admin_name,259200);
                $data['state'] = 'success';
                $data['msg'] = '登录成功';
                $data['admininfo'] = array(
                    'admin_name'=>$admininfo->admin_name
                );
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '程序错误，请重试';
            }
        }else{
            $data['state'] = 'failed';
            $data['msg'] = '用户名密码错误，请重试';
        }
        
        echo json_encode($data);
    }
    
    public function index(){//管理员主页
        $this->module = 'console';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $this->load->view('admin/index',$data);
    }
    
    public function admin_list(){//管理员列表
        $this->module = 'admin';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $page = $this->input->get('page');//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        
        //加载管理员模型类
        $this->load->model('admin/Admin_model','admin');
        //get_adminCount方法得到管理员总数
        $count = $this->admin->get_adminCount();
        
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
        $config['base_url'] = base_url().'admin/admin_list';
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
        
        //get_adminList方法到管理员列表信息
        $admin_list = $this->admin->get_adminList($offset,$page_size);
        $data['admin_list'] = $admin_list;
        
        $this->load->view('admin/admin_list',$data);
    }
    
    public function admin_update(){//管理员编辑初始页
        $this->module = 'console';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $admin_id = $this->input->get('admin_id');//得到管理员编号
        if(!empty($admin_id)){
            $data['operate'] = 'update';
            //加载管理员模型类
            $this->load->model('admin/Admin_model','admin');
            //get_adminDetail方法得到管理员详情
            $admin = $this->admin->get_adminDetail($admin_id);
            if(empty($admin)){
                $heading = '404 Page Not Found';
                $message = 'The page you requested was not found.';
                show_error($message, 404, $heading );
                exit;
            }
            $data['admin'] = $admin;
        }else{
            $data['operate'] = 'add';
        }
        
        $this->load->view('admin/admin_update',$data);
    }
    
    public function admin_update_do(){//管理员编辑
        
        $operate = $this->input->get_post('operate');//得到操作
        $admin_id = $this->input->get_post('admin_id');//管理员编号
        $admin_name = $this->input->get_post('admin_name');//用户名
        $real_name = $this->input->get_post('real_name');//真实姓名
        $admin_pwd = $this->input->get_post('admin_pwd');//密码
        $admin_pwd_confirm = $this->input->get_post('admin_pwd_confirm');//确认密码
        $status = $this->input->get_post('status');//状态
        if($admin_pwd != $admin_pwd_confirm){
            $data['state'] = 'failed';
            $data['msg'] = '密码与确认密码不一致！请重新填写';
        }
        //加载管理员模型类
        $this->load->model('admin/Admin_model','admin');
        if($operate == 'add'){//添加
            //根据登录账号拿到管理员信息
            $admininfo = $this->admin->get_adminByName($admin_name);
            if(isset($admininfo) && !empty($admininfo)){
                $data['state'] = 'failed';
                $data['msg'] = '该账号已被使用，请更换';
            }else{
                //add_adminOne方法添加一条管理员记录
                $addStatus = $this->admin->add_adminOne($admin_name,$admin_pwd,$real_name,$status);
                if($addStatus){
                    $data['state'] = 'success';
                    $data['msg'] = '添加成功';
                }else{
                    $data['state'] = 'failed';
                    $data['msg'] = '添加失败，请重试';
                }
            }
        }else{//修改
            //edit_adminOne方法修改管理员信息
            $updateStatus = $this->admin->edit_adminOne($admin_id,$admin_name,$admin_pwd,$real_name,$status);
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
    
    public function butler_list(){//品牌管家列表
        $this->module = 'butler';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $page = $this->input->get('page');//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        
        //加载品牌管家模型类
        $this->load->model('admin/Butler_model','butler');
        //get_butlerCount方法得到管家总数
        $count = $this->butler->get_butlerCount();
        
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
        $config['base_url'] = base_url().'admin/butler_list';
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
        
        //get_butlerList方法到管家列表信息
        $butler_list = $this->butler->get_butlerList($offset,$page_size);
        $data['butler_list'] = $butler_list;
        
        $this->load->view('admin/butler_list',$data);
    }
    
    public function butler_update(){//管家编辑初始页
        $this->module = 'butler';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $butler_id = $this->input->get('butler_id');//得到管家编号
        if(!empty($butler_id)){
            $data['operate'] = 'update';
            //加载品牌管家模型类
            $this->load->model('admin/Butler_model','butler');
            //get_butlerDetail方法得到管家详情
            $butler = $this->butler->get_butlerDetail($butler_id);
            if(empty($butler)){
                $heading = '404 Page Not Found';
                $message = 'The page you requested was not found.';
                show_error($message, 404, $heading );
                exit;
            }
            $data['butler'] = $butler;
        }else{
            $data['operate'] = 'add';
        }
        
        $this->load->view('admin/butler_update',$data);
    }
    
    public function butler_update_do(){//品牌管家编辑
        
        $operate = $this->input->get_post('operate');//得到操作
        $butler_id = $this->input->get_post('butler_id');//管家编号
        $butler_name = $this->input->get_post('butler_name');//管家昵称
        $real_name = $this->input->get_post('real_name');//真实姓名
        $butler_phone = $this->input->get_post('butler_phone');//电话号码
        $butler_qq = $this->input->get_post('butler_qq');//QQ号码
        $butler_wechat = $this->input->get_post('butler_wechat');//微信二维码
        $status = $this->input->get_post('status');//状态
        //加载品牌管家模型类
        $this->load->model('admin/Butler_model','butler');
        if($operate == 'add'){//添加
            //根据登录账号拿到管理员信息
            $butlerinfo = $this->butler->get_butlerByName($butler_name);
            if(isset($butlerinfo) && !empty($butlerinfo)){
                $data['state'] = 'failed';
                $data['msg'] = '该昵称已被使用，请更换';
            }else{
                //add_butlerOne方法添加一条管家记录
                $addStatus = $this->butler->add_butlerOne($butler_name,$real_name,$butler_phone,$butler_qq,$butler_wechat,$status);
                if($addStatus){
                    $data['state'] = 'success';
                    $data['msg'] = '添加成功';
                }else{
                    $data['state'] = 'failed';
                    $data['msg'] = '添加失败，请重试';
                }
            }
        }else{//修改
            //edit_butlerOne方法修改管家信息
            $updateStatus = $this->butler->edit_butlerOne($butler_id,$butler_name,$real_name,$butler_phone,$butler_qq,$butler_wechat,$status);
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
    
    public function upload_butlerWechatTemp(){//本地上传微信二维码到临时目录
        $wechatUpload = $_FILES['file'];
        $result = upload_images_temp($wechatUpload);
        echo json_encode($result);
    }
    
    public function upload_butlerWechatAjax(){//ajax上传管家微信二维码临时路径
    
        $wechat_path = $this->input->get_post('wechat_path');//得到管家微信二维码临时目录
        
        $imgInfo = getimagesize($wechat_path);
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
        $html = file_get_contents($wechat_path);
        $rand = rand(pow(10, 5), (pow(10, 6)-1));
        file_put_contents('uploads/images/butler_wechat/wechat_'.md5($rand).'.'.$imgType, $html);
        $butler_wechat = '/uploads/images/butler_wechat/wechat_'.md5($rand).'.'.$imgType;
        
        $data['state'] = 'success';
        $data['wechat'] = $butler_wechat;
        echo json_encode($data);
    }
    
    public function user_list(){//用户列表
        $this->module = 'user';
        $this->sub_menu = 'user';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $page = $this->input->get('page');//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        
        //加载用户模型类
        $this->load->model('admin/User_model','user');
        //get_userCount方法得到用户总数
        $count = $this->user->get_userCount();
        
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
        $config['base_url'] = base_url().'admin/user_list';
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
        
        //get_userList方法到用户列表信息
        $user_list = $this->user->get_userList($offset,$page_size);
        $data['user_list'] = $user_list;
        
        $this->load->view('admin/user_list',$data);
    }
    
    public function user_update(){//用户编辑初始页
        $this->module = 'user';
        $this->sub_menu = 'user';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $user_id = $this->input->get('user_id');//得到用户编号
        if(!empty($user_id)){
            $data['operate'] = 'update';
            //加载用户模型类
            $this->load->model('admin/User_model','user');
            //get_userDetail方法得到用户详情
            $user = $this->user->get_userDetail($user_id);
            if(empty($user)){
                $heading = '404 Page Not Found';
                $message = 'The page you requested was not found.';
                show_error($message, 404, $heading );
                exit;
            }
            $data['user'] = $user;
        }else{
            $data['operate'] = 'add';
        }
        
        $this->load->view('admin/user_update',$data);
    }
    
    public function domain_list(){//出售域名列表
        $this->module = 'domain';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $page = $this->input->get('page');//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        
        //加载域名模型类
        $this->load->model('admin/Domain_model','domain');
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
        $config['base_url'] = base_url().'admin/domain_list';
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
        
        //get_domainList方法到域名列表信息
        $domain_list = $this->domain->get_domainList($offset,$page_size);
        foreach($domain_list as $domain){
            $domain->expired_date = format_domain_exptime($domain->expired_date);
        }
        $data['domain_list'] = $domain_list;
        
        $this->load->view('admin/domain_list',$data);
    }
    
    public function domain_update(){//域名编辑初始页
        $this->module = 'domain';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $domain_name = $this->input->get('domain_name');//得到域名
        if(!empty($domain_name)){
            $data['operate'] = 'update';
            //加载域名模型类
            $this->load->model('admin/Domain_model','domain');
            //get_domainDetail方法得到域名详情
            $domain = $this->domain->get_domainDetail($domain_name);
            if(empty($domain)){
                $heading = '404 Page Not Found';
                $message = 'The page you requested was not found.';
                show_error($message, 404, $heading );
                exit;
            }
            $data['domain'] = $domain;
        }else{
            $data['operate'] = 'add';
        }
        
        $this->load->view('admin/domain_update',$data);
    }
    
    public function domain_update_do(){//域名编辑
        
        $operate = $this->input->get_post('operate');//得到操作
        $domain_name = $this->input->get_post('domain_name');//域名
        $register_registrar = $this->input->get_post('register_registrar');//注册商
        $register_name = $this->input->get_post('register_name');//注册人
        $register_email = $this->input->get_post('register_email');//注册邮箱
        $created_date = $this->input->get_post('created_date');//注册日期
        $expired_date = $this->input->get_post('expired_date');//过期日期
        $domain_type = $this->input->get_post('domain_type');//域名类型
        $domain_price = $this->input->get_post('domain_price');//域名价格
        $domain_summary = $this->input->get_post('domain_summary');//域名价格
        //加载域名模型类
        $this->load->model('admin/Domain_model','domain');
        if($operate == 'add'){//添加
            //根据域名名称拿到域名信息
            $domaininfo = $this->domain->get_domainDetail($domain_name);
            if(isset($domaininfo) && !empty($domaininfo)){
                $data['state'] = 'failed';
                $data['msg'] = '该域名已被添加，请更换';
            }else{
                //add_domainOne方法添加一条域名记录
                $addStatus = $this->domain->add_domainOne($domain_name,$register_registrar,$register_name,$register_email,$created_date,$expired_date,$domain_type,$domain_price,$domain_summary);
                if($addStatus){
                    $data['state'] = 'success';
                    $data['msg'] = '添加成功';
                }else{
                    $data['state'] = 'failed';
                    $data['msg'] = '添加失败，请重试';
                }
            }
        }else{//修改
            //edit_domainOne方法修改域名信息
            $updateStatus = $this->domain->edit_domainOne($domain_name,$register_registrar,$register_name,$register_email,$created_date,$expired_date,$domain_type,$domain_price,$domain_summary);
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
    
    public function mark_list(){//出售商标列表
        $this->module = 'mark';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $page = $this->input->get('page');//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        
        //加载商标模型类
        $this->load->model('admin/Mark_model','mark');
        //get_markCount方法得到商标总数
        $count = $this->mark->get_markCount('');
        
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
        $config['base_url'] = base_url().'admin/mark_list';
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
        
        //get_markList方法到商标列表信息
        $mark_list = $this->mark->get_markList('',$offset,$page_size);
        foreach($mark_list as $mark){
            //get_categoryName获取大类名称
            $category = $this->mark->get_categoryName($mark->mark_category);
            $mark->category_name = $category->category_name;
        }
        $data['mark_list'] = $mark_list;
        
        $this->load->view('admin/mark_list',$data);
    }
    
    public function mark_update(){//商标编辑初始页
        $this->module = 'mark';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $mark_regno = $this->input->get('mark_regno');//得到商标注册号
        if(!empty($mark_regno)){
            $data['operate'] = 'update';
            //加载商标模型类
            $this->load->model('admin/Mark_model','mark');
            //get_markDetail方法得到商标详情
            $mark = $this->mark->get_markDetail($mark_regno);
            //get_categoryName获取大类名称
            $category = $this->mark->get_categoryName($mark->mark_category);
            $mark->category_name = $category->category_name;
            if(empty($mark)){
                $heading = '404 Page Not Found';
                $message = 'The page you requested was not found.';
                show_error($message, 404, $heading );
                exit;
            }
            $data['mark'] = $mark;
        }else{
            $data['operate'] = 'add';
        }
        
        $this->load->view('admin/mark_update',$data);
    }
    
    public function mark_update_do(){//商标编辑
        
        $operate = $this->input->get_post('operate');//得到操作
        $mark_regno = $this->input->get_post('mark_regno');//商标注册号
        $mark_price = $this->input->get_post('mark_price');//商标价格
        //加载商标模型类
        $this->load->model('admin/Mark_model','mark');
        if($operate == 'add'){//添加
            //添加商标记录不能手动添加,需要通过接口添加
            $data['state'] = 'failed';
            $data['msg'] = '只能修改价格，不能添加';
        }else{//修改
            //edit_markPrice方法修改商标价格
            $updateStatus = $this->mark->edit_markPrice($mark_regno,$mark_price);
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
    
    public function login_out(){//退出登录
        //删除登录信息session
        if(isset($_SESSION['admininfo'])){
            unset($_SESSION['admininfo']);
        }
        redirect(base_url().'admin/login');
    }
    
}
?>