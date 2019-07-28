<?php
require 'QueryList/phpQuery.php';
require 'QueryList/QueryList.php';
use QL\QueryList;

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
        
        $admin_name = trim($this->input->get_post('admin_name'));//得到用户名
        $admin_pwd = trim($this->input->get_post('admin_pwd'));//得到登录密码
        
        //加载用户模型类
        $this->load->model('admin/Admin_model','admin');
        //isvalid_pwdName方法判断用户名密码是否正确
        $login_status = $this->admin->isvalid_pwdName($admin_name,$admin_pwd);
        
        if($login_status == 1){//如果正确，则登录
            //根据登录账号拿到管理员信息
            $admininfo = $this->admin->get_adminByName($admin_name);
            if($admininfo->status != 'active'){
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
        
        $page = trim($this->input->get('page'));//得到页码
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
        $this->module = 'admin';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $admin_id = trim($this->input->get('admin_id'));//得到管理员编号
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
        
        $operate = trim($this->input->get_post('operate'));//得到操作
        $admin_id = trim($this->input->get_post('admin_id'));//管理员编号
        $admin_name = trim($this->input->get_post('admin_name'));//用户名
        $real_name = trim($this->input->get_post('real_name'));//真实姓名
        $admin_pwd = trim($this->input->get_post('admin_pwd'));//密码
        $admin_pwd_confirm = trim($this->input->get_post('admin_pwd_confirm'));//确认密码
        $status = trim($this->input->get_post('status'));//状态
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
        
        $page = trim($this->input->get('page'));//得到页码
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
        
        $butler_id = trim($this->input->get('butler_id'));//得到管家编号
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
        
        $operate = trim($this->input->get_post('operate'));//得到操作
        $butler_id = trim($this->input->get_post('butler_id'));//管家编号
        $butler_name = trim($this->input->get_post('butler_name'));//管家昵称
        $real_name = trim($this->input->get_post('real_name'));//真实姓名
        $butler_phone = trim($this->input->get_post('butler_phone'));//电话号码
        $butler_qq = trim($this->input->get_post('butler_qq'));//QQ号码
        $butler_wechat = trim($this->input->get_post('butler_wechat'));//微信二维码
        $status = trim($this->input->get_post('status'));//状态
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
    
        $wechat_path = trim($this->input->get_post('wechat_path'));//得到管家微信二维码临时目录
        
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
        
        $page = trim($this->input->get('page'));//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        $keyword = trim($this->input->get('keyword'));//得到域名关键词
        $user_id = trim($this->input->get('user_id'));//得到用户编号
        
        //加载用户模型类
        $this->load->model('admin/User_model','user');
        //get_userCount方法得到用户总数
        $count = $this->user->get_userCount($keyword,$user_id);
        
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
        $user_list = $this->user->get_userList($keyword,$user_id,$offset,$page_size);
        $data['user_list'] = $user_list;
        $data['keyword'] = $keyword;
        $data['user_id'] = $user_id;
        
        $this->load->view('admin/user_list',$data);
    }
    
    public function user_update(){//用户编辑初始页
        $this->module = 'user';
        $this->sub_menu = 'user';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $user_id = trim($this->input->get('user_id'));//得到用户编号
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
    
    public function company_certify_list(){//企业认证列表
        $this->module = 'user';
        $this->sub_menu = 'company_certify';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $page = trim($this->input->get('page'));//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        $keyword = trim($this->input->get('keyword'));//得到域名关键词
        $user_id = trim($this->input->get('user_id'));//得到用户编号
        
        //加载企业认证模型类
        $this->load->model('admin/Certify_model','certify');
        //get_certifyCount方法得到企业认证总数
        $count = $this->certify->get_certifyCount($keyword,$user_id);
        
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
        $config['base_url'] = base_url().'admin/company_certify_list';
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
        
        //get_certifyList方法到企业认证列表信息
        $certify_list = $this->certify->get_certifyList($keyword,$user_id,$offset,$page_size);
        $data['certify_list'] = $certify_list;
        $data['keyword'] = $keyword;
        $data['user_id'] = $user_id;
        
        $this->load->view('admin/company_certify_list',$data);
    }
    
    public function company_certify_update(){//企业认证编辑初始页
        $this->module = 'user';
        $this->sub_menu = 'company_certify';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $certify_id = trim($this->input->get('certify_id'));//得到企业认证编号
        if(!empty($certify_id)){
            $data['operate'] = 'update';
            //加载企业认证模型类
            $this->load->model('admin/Certify_model','certify');
            //get_certifyDetail方法得到企业认证详情
            $certify = $this->certify->get_certifyDetail($certify_id);
            if(empty($certify)){
                $heading = '404 Page Not Found';
                $message = 'The page you requested was not found.';
                show_error($message, 404, $heading );
                exit;
            }
            $data['certify'] = $certify;
        }else{
            $data['operate'] = 'add';
        }
        
        $this->load->view('admin/company_certify_update',$data);
    }
    
    public function company_certify_update_do(){//企业认证编辑
        
        $operate = trim($this->input->get_post('operate'));//得到操作
        $certify_id = trim($this->input->get_post('certify_id'));//认证编号
        $company_name = trim($this->input->get_post('company_name'));//公司名称
        $oper_name = trim($this->input->get_post('oper_name'));//法定代表人
        $regist_capi = trim($this->input->get_post('regist_capi'));//注册资本
        $start_date = trim($this->input->get_post('start_date'));//成立日期
        $credit_code = trim($this->input->get_post('credit_code'));//统一社会信用代码
        $econ_kind = trim($this->input->get_post('econ_kind'));//企业类型
        $business_term = trim($this->input->get_post('business_term'));//营业期限
        $address = trim($this->input->get_post('address'));//企业地址
        $scope = trim($this->input->get_post('scope'));//经营范围
        $status = trim($this->input->get_post('status'));//认证状态
        $description = trim($this->input->get_post('description'));//备注
        //加载企业认证模型类
        $this->load->model('admin/Certify_model','certify');
        if($operate == 'add'){//添加
            //添加企业认证记录不能后台添加,需要在用户中心添加
            $data['state'] = 'failed';
            $data['msg'] = '只能认证操作，不能添加';
        }else{//修改
            //edit_certifyOne方法修改企业认证
            $updateStatus = $this->certify->edit_certifyOne($certify_id,$company_name,$oper_name,$regist_capi,$start_date,$credit_code,$econ_kind,$business_term,$address,$scope,$status,$description);
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
    
    public function domain_list(){//出售域名列表
        $this->module = 'domain';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $page = trim($this->input->get('page'));//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        $keyword = trim($this->input->get('keyword'));//得到域名关键词
        $is_onsale = trim($this->input->get('is_onsale'));//得到出售状态
        $register_registrar = trim($this->input->get('register_registrar'));//得到注册商
        $user_id = trim($this->input->get('user_id'));//得到用户编号
        
        //加载域名模型类
        $this->load->model('admin/Domain_model','domain');
        //get_domainCount方法得到域名总数
        $count = $this->domain->get_domainCount($keyword,$register_registrar,$is_onsale,$user_id);
        
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
        $domain_list = $this->domain->get_domainList($keyword,$register_registrar,$is_onsale,$user_id,$offset,$page_size);
        foreach($domain_list as $domain){
            $domain->expired_date = format_domain_exptime($domain->expired_date);
        }
        $data['domain_list'] = $domain_list;
        $data['keyword'] = $keyword;
        $data['register_registrar'] = $register_registrar;
        $data['is_onsale'] = $is_onsale;
        $data['user_id'] = $user_id;
        
        $this->load->view('admin/domain_list',$data);
    }
    
    public function domain_update(){//域名编辑初始页
        $this->module = 'domain';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $domain_name = trim($this->input->get('domain_name'));//得到域名
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
        
        $operate = trim($this->input->get_post('operate'));//得到操作
        $domain_name = trim($this->input->get_post('domain_name'));//域名
        $register_registrar = trim($this->input->get_post('register_registrar'));//注册商
        $register_name = trim($this->input->get_post('register_name'));//注册人
        $register_email = trim($this->input->get_post('register_email'));//注册邮箱
        $created_date = trim($this->input->get_post('created_date'));//注册日期
        $expired_date = trim($this->input->get_post('expired_date'));//过期日期
        $domain_type = trim($this->input->get_post('domain_type'));//域名类型
        $is_onsale = trim($this->input->get_post('is_onsale'));//是否出售
        $domain_price = trim($this->input->get_post('domain_price'));//域名价格
        $domain_summary = trim($this->input->get_post('domain_summary'));//域名简介
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
                $addStatus = $this->domain->add_domainOne($domain_name,$register_registrar,$register_name,$register_email,$created_date,$expired_date,$domain_type,$is_onsale,$domain_price,$domain_summary);
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
            $updateStatus = $this->domain->edit_domainOne($domain_name,$register_registrar,$register_name,$register_email,$created_date,$expired_date,$domain_type,$is_onsale,$domain_price,$domain_summary);
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
    
    public function user_domain_add(){//添加用户域名初始页
        $this->module = 'user';
        $this->sub_menu = 'user';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $user_id = trim($this->input->get('user_id'));//得到用户编号
        $data['user_id'] = $user_id;
        
        $this->load->view('admin/user_domain_add',$data);
    }
    
    public function user_domain_add_do(){//添加用户域名
        
        $user_id = trim($this->input->get_post('user_id'));//用户编号
        $domain_name = trim($this->input->get_post('domain_name'));//域名
        $is_onsale = trim($this->input->get_post('is_onsale'));//是否出售
        $domain_price = trim($this->input->get_post('domain_price'));//域名价格
        //加载域名模型类
        $this->load->model('admin/Domain_model','domain');
        //edit_userDomainOne方法给域名分配用户
        $updateStatus = $this->domain->edit_userDomainOne($user_id,$domain_name,$is_onsale,$domain_price);
        if($updateStatus){
                $data['state'] = 'success';
                $data['msg'] = '分配成功';
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '分配失败，请重试';
            }
        
        echo json_encode($data);
    }
    
    public function mark_list(){//出售商标列表
        $this->module = 'mark';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $page = trim($this->input->get('page'));//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        $keyword = trim($this->input->get('keyword'));//得到商标关键词
        $is_onsale = trim($this->input->get('is_onsale'));//得到出售状态
        $filter_category = trim($this->input->get('filter_category'));//得到商标类别
        $user_id = trim($this->input->get('user_id'));//得到用户编号
        
        //加载商标模型类
        $this->load->model('admin/Mark_model','mark');
        //get_markCategory方法得到商标大类信息
        $mark_category = $this->mark->get_markCategory();
        $data['mark_category'] = $mark_category;
        
        //get_markCount方法得到商标总数
        $count = $this->mark->get_markCount($keyword,$filter_category,$is_onsale,$user_id);
        
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
        $mark_list = $this->mark->get_markList($keyword,$filter_category,$is_onsale,$user_id,$offset,$page_size);
        foreach($mark_list as $mark){
            //get_categoryName获取大类名称
            $category = $this->mark->get_categoryName($mark->mark_category);
            $mark->category_name = $category->category_name;
        }
        $data['mark_list'] = $mark_list;
        $data['keyword'] = $keyword;
        $data['filter_category'] = $filter_category;
        $data['is_onsale'] = $is_onsale;
        $data['user_id'] = $user_id;
        
        $this->load->view('admin/mark_list',$data);
    }
    
    public function mark_update(){//商标编辑初始页
        $this->module = 'mark';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $regno_md = trim($this->input->get('regno_md'));//得到注册号加大类的md5值
        if(!empty($regno_md)){
            $data['operate'] = 'update';
            //加载商标模型类
            $this->load->model('admin/Mark_model','mark');
            //get_markDetail方法得到商标详情
            $mark = $this->mark->get_markDetail($regno_md);
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
        
        $operate = trim($this->input->get_post('operate'));//得到操作
        $regno_md = trim($this->input->get_post('regno_md'));//注册号加大类的md5值
        $is_onsale = trim($this->input->get_post('is_onsale'));//是否出售
        $mark_price = trim($this->input->get_post('mark_price'));//商标价格
        //加载商标模型类
        $this->load->model('admin/Mark_model','mark');
        if($operate == 'add'){//添加
            //添加商标记录不能手动添加,需要通过接口添加
            $data['state'] = 'failed';
            $data['msg'] = '只能修改价格，不能添加';
        }else{//修改
            //edit_markPrice方法修改商标价格
            $updateStatus = $this->mark->edit_markPrice($regno_md,$is_onsale,$mark_price);
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
    
    public function user_mark_add(){//添加用户商标初始页
        $this->module = 'user';
        $this->sub_menu = 'user';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $user_id = trim($this->input->get('user_id'));//得到用户编号
        $data['user_id'] = $user_id;
        
        $this->load->view('admin/user_mark_add',$data);
    }
    
    public function user_mark_add_do(){//添加用户商标
        
        $user_id = trim($this->input->get_post('user_id'));//用户编号
        $mark_regno = trim($this->input->get_post('mark_regno'));//商标注册号
        $is_onsale = trim($this->input->get_post('is_onsale'));//是否出售
        $mark_price = trim($this->input->get_post('mark_price'));//商标价格
        //加载商标模型类
        $this->load->model('admin/Mark_model','mark');
        //edit_userMarkOne方法给商标分配用户,一标多类的多个商标分配给同一个用户,所以用mark_regno
        $updateStatus = $this->mark->edit_userMarkOne($user_id,$mark_regno,$is_onsale,$mark_price);
        if($updateStatus){
                $data['state'] = 'success';
                $data['msg'] = '分配成功';
            }else{
                $data['state'] = 'failed';
                $data['msg'] = '分配失败，请重试';
            }
        
        echo json_encode($data);
    }
    
    public function company_list(){//企业名录列表
        $this->module = 'company';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $page = trim($this->input->get('page'));//得到页码
        if(empty($page)) $page = 1;//默认页码为1
        $keyword = trim($this->input->get('keyword'));//得到企业关键词
        
        //加载企业模型类
        $this->load->model('admin/Company_model','company');
        //get_companyCount方法得到企业总数
        $count = $this->company->get_companyCount($keyword);
        
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
        $config['base_url'] = base_url().'admin/company_list';
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
        
        //get_companyList方法到企业列表信息
        $company_list = $this->company->get_companyList($keyword,$offset,$page_size);
        $data['company_list'] = $company_list;
        $data['keyword'] = $keyword;
        
        $this->load->view('admin/company_list',$data);
    }
    
    public function spider_company_detail($url){//爬取企查查单个企业的详细信息
        
        $html = file_get_contents($url);
        $data = QueryList::Query($html,array(
                'Name' => array('#company-top > div.row > div.content > div.row.title.jk-tip > h1','text'),
                'OperName' => array('#Cominfo > table h2.seo','text'),
                'Info'=> array('#Cominfo > table','text'),
              ))->data;
        
        if(is_array($data) && !empty($data[0]) && !empty($data[0]['Name']) && !empty($data[0]['OperName']) && !empty($data[0]['Info'])){
            $company = array();
            $company['Name'] = $data[0]['Name'];//公司名称
            $company['OperName'] = $data[0]['OperName'];//法定代表人
            
            preg_match_all('/注册资本([\s\S]*?)实缴资本/i',$data[0]['Info'],$resRegistCapi);
            $company['RegistCapi'] = trim($resRegistCapi[1][0]);//注册资本
            
            preg_match_all('/实缴资本([\s\S]*?)经营状态/i',$data[0]['Info'],$resRealCapi);
            $company['RealCapi'] = trim($resRealCapi[1][0]);//实缴资本
            
            preg_match_all('/经营状态([\s\S]*?)成立日期/i',$data[0]['Info'],$resStatus);
            $company['Status'] = trim($resStatus[1][0]);//经营状态
            
            preg_match_all('/成立日期([\s\S]*?)统一社会信用代码/i',$data[0]['Info'],$resStartDate);
            $company['StartDate'] = trim($resStartDate[1][0]);//成立日期
            
            preg_match_all('/统一社会信用代码([\s\S]*?)纳税人识别号/i',$data[0]['Info'],$resCreditCode);
            $company['CreditCode'] = trim($resCreditCode[1][0]);//统一社会信用代码
            
            preg_match_all('/纳税人识别号([\s\S]*?)注册号/i',$data[0]['Info'],$resTaxNo);
            $company['TaxNo'] = trim($resTaxNo[1][0]);//纳税人识别号
            
            preg_match_all('/注册号([\s\S]*?)组织机构代码/i',$data[0]['Info'],$resNo);
            $company['No'] = trim($resNo[1][0]);//注册号
            
            preg_match_all('/组织机构代码([\s\S]*?)企业类型/i',$data[0]['Info'],$resOrgNo);
            $company['OrgNo'] = trim($resOrgNo[1][0]);//组织机构代码
            
            preg_match_all('/企业类型([\s\S]*?)所属行业/i',$data[0]['Info'],$resEconKind);
            $company['EconKind'] = trim($resEconKind[1][0]);//企业类型
            
            preg_match_all('/所属行业([\s\S]*?)核准日期/i',$data[0]['Info'],$resIndustry);
            $company['Industry'] = trim($resIndustry[1][0]);//所属行业
            
            preg_match_all('/核准日期([\s\S]*?)登记机关/i',$data[0]['Info'],$resCheckDate);
            $company['CheckDate'] = trim($resCheckDate[1][0]);//核准日期
            
            preg_match_all('/登记机关([\s\S]*?)所属地区/i',$data[0]['Info'],$resBelongOrg);
            $company['BelongOrg'] = trim($resBelongOrg[1][0]);//登记机关
            
            preg_match_all('/所属地区([\s\S]*?)英文名/i',$data[0]['Info'],$resProvince);
            $company['Province'] = trim($resProvince[1][0]);//所属地区
            
            preg_match_all('/英文名([\s\S]*?)曾用名/i',$data[0]['Info'],$resEnName);
            $company['EnName'] = trim($resEnName[1][0]);//英文名
            
            preg_match_all('/曾用名([\s\S]*?)参保人数/i',$data[0]['Info'],$resOriginalName);
            $company['OriginalName'] = trim($resOriginalName[1][0]);//曾用名
            
            preg_match_all('/参保人数([\s\S]*?)人员规模/i',$data[0]['Info'],$resInsuredPerson);
            $company['InsuredPerson'] = trim($resInsuredPerson[1][0]);//参保人数
            
            preg_match_all('/人员规模([\s\S]*?)营业期限/i',$data[0]['Info'],$resStaffSize);
            $company['StaffSize'] = trim($resStaffSize[1][0]);//人员规模
            
            preg_match_all('/营业期限([\s\S]*?)企业地址/i',$data[0]['Info'],$resBusinessTerm);
            $company['BusinessTerm'] = trim($resBusinessTerm[1][0]);//营业期限
            
            preg_match_all('/企业地址([\s\S]*?)经营范围/i',$data[0]['Info'],$resAddress);
            $company['Address'] = trim(explode('查看地图',$resAddress[1][0])[0]);//企业地址
            
            $company['Scope'] = trim(substr($data[0]['Info'],strpos($data[0]['Info'],"经营范围")+12));//经营范围
            
            return $company;
        }else{
            return 'error => '.$url;
        }
    }
    
    public function company_update(){//企业名录编辑初始页
        $this->module = 'company';
        $this->sub_menu = '';
        $data['admininfo'] = $this->get_admininfo();//验证是否登录,并获取管理员信息
        
        $site_list = trim($this->input->get_post('site_list'));//得到企业抓取网址
        if(!empty($site_list)){
            $data["site_list"] = $site_list;
            $result_list = array();
            $site_list_arr = explode("\r\n", $site_list);
            foreach ($site_list_arr as $item){
                $base_info = $this->spider_company_detail(trim($item));
                if(is_array($base_info)){//如果采到了企业基础数据
                    if(strpos($base_info['Name'],"公司") !== false){//是公司的才去采集
                        //加载企业模型类
                        $this->load->model('admin/Company_model','company');
                        //get_companyNameStatus方法根据企业名称判断该企业是否已经录入，1为已录入，0为未录入
                        $nameStatus = $this->company->get_companyNameStatus($base_info['Name']);
                        if($nameStatus){//修改企业信息
                            $updateStatus = $this->company->edit_companyByName($base_info['Name'],$base_info['OperName'],$base_info['RegistCapi'],$base_info['RealCapi'],$base_info['Status'],$base_info['StartDate'],$base_info['CreditCode'],$base_info['TaxNo'],$base_info['No'],$base_info['OrgNo'],$base_info['EconKind'],$base_info['Industry'],$base_info['CheckDate'],$base_info['BelongOrg'],$base_info['Province'],$base_info['EnName'],$base_info['OriginalName'],$base_info['InsuredPerson'],$base_info['StaffSize'],$base_info['BusinessTerm'],$base_info['Address'],$base_info['Scope'],'');
                            if($updateStatus){
                                $result["state"] = 'success';
                                $result["msg"] = "修改成功，企业名称 => ".$base_info['Name'];
                            }else{
                                $result["state"] = 'failed';
                                $result["msg"] = $base_info['Name']." => 修改失败";
                            }
                        }else{//添加企业信息
                            $company_id = md5($base_info['Name'].$base_info['OperName'].random_string_numlet(6));
                            $addStatus = $this->company->add_companyOne($company_id,$base_info['Name'],$base_info['OperName'],$base_info['RegistCapi'],$base_info['RealCapi'],$base_info['Status'],$base_info['StartDate'],$base_info['CreditCode'],$base_info['TaxNo'],$base_info['No'],$base_info['OrgNo'],$base_info['EconKind'],$base_info['Industry'],$base_info['CheckDate'],$base_info['BelongOrg'],$base_info['Province'],$base_info['EnName'],$base_info['OriginalName'],$base_info['InsuredPerson'],$base_info['StaffSize'],$base_info['BusinessTerm'],$base_info['Address'],$base_info['Scope'],'');
                            if($addStatus){
                                $result["state"] = 'success';
                                $result["msg"] = "插入成功，企业名称 => ".$base_info['Name'];
                            }else{
                                $result["state"] = 'failed';
                                $result["msg"] = $base_info['Name']." => 插入失败";
                            }
                        }
                    }else{
                        $result["state"] = 'failed';
                        $result["msg"] = $base_info['Name']." => 企业类型不匹配";
                    }
                }else{
                    $result["state"] = 'failed';
                    $result["msg"] = $base_info;
                }
                array_push($result_list,$result);
                sleep(1);
            }
            $data["result_list"] = $result_list;
        }else{
            
        }
        
        $this->load->view('admin/company_update',$data);
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