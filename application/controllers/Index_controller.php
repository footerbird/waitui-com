<?php
class Index_controller extends CI_Controller {
    
    public function index(){//主页路由
        
        //301重定向，将waitui.com跳转到www.waitui.com
        $the_host = $_SERVER['HTTP_HOST'];//取得当前域名   
        $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';//判断地址后面是否有参数   
        
        if($the_host == 'waitui.com'){
            header('HTTP/1.1 301 Moved Permanently');//发出301头部   
            header('Location: http://www.waitui.com/');//跳转到你希望的地址格式   
            exit;
        }
        if($the_host == 'm.waitui.com'){
            header('HTTP/1.1 301 Moved Permanently');//发出301头部   
            header('Location: http://www.waitui.com/m'.$request_uri);//跳转到你希望的地址格式   
            exit;
        }
//      if($the_host != 'www.waitui.com')//把这里的域名换上你想要的   
//      {
//          header('HTTP/1.1 301 Moved Permanently');//发出301头部   
//          header('Location: http://www.waitui.com'.$request_uri.'?redirect='.$the_host);//跳转到你希望的地址格式   
//          exit;
//      }
        
        $this->load->library('user_agent');
        if($this->agent->is_mobile()){//跳转到手机端
            redirect(base_url().'m/');
        }else{//PC端主页
            $redirect = $this->input->get_post('redirect');//得到重定向host
            if($redirect){
                $data['redirect'] = $redirect;
            }
            
            $session_userinfo = $this->session->userinfo;//从session中获取用户信息
            if(!empty($session_userinfo->user_id)){
                $user_id = $session_userinfo->user_id;
                //加载用户模型类
                $this->load->model('waitui/User_model','user');
                //get_userinfoById方法获取用户信息
                $userinfo = $this->user->get_userinfoById($user_id);
                $data['userinfo'] = $userinfo;
            }
            
            $this->module = constant('MEMU_HOME');
            
            $seo = array(
                'seo_title'=>'',
                'seo_keywords'=>'',
                'seo_description'=>''
            );
            $data['seo'] = json_decode(json_encode($seo));
            
            $this->load->view('waitui/index',$data);
        }
    }
    
}
?>