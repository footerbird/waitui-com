<?php
class Index_controller extends CI_Controller {
    
    public function get_tmkoo_info(){//从标库网info接口获取商标数据
        
        $data = array();
        $regno_list = trim($this->input->get_post('regno_list'));//得到待插入商标列表
        if(!empty($regno_list)){
            
            $data["regno_list"] = $regno_list;
            $result_list = array();
            $regno_list_arr = explode("\r\n", $regno_list);
            
            foreach ($regno_list_arr as $item){
                
                $result = array();
                $regno_item_arr = explode("#", $item);
                if(count($regno_item_arr) != 3){
                    $result["status"] = 0;
                    $result["msg"] = "参数个数不完整";
                    continue;
                }
                $post_regno = trim($regno_item_arr[0]);
                $post_category = trim($regno_item_arr[1]);
                $post_price = trim($regno_item_arr[2]);
                
                if(is_numeric($post_category) && is_numeric($post_price)){//如果都是数字类型
                    
                    //两个免费帐号切换用
//                  $info_json_str = file_get_contents('http://api.tmkoo.com/info.php?apiKey=A_E74x1PZM&apiPassword=FJx3KjJ5Qh&regNo='.$post_regno.'&intCls='.$post_category);
                    $info_json_str = file_get_contents('http://api.tmkoo.com/info.php?apiKey=A_8hqSTQzG&apiPassword=q9JWyv7GmN&regNo='.$post_regno.'&intCls='.$post_category);
                    
                    $info = json_decode($info_json_str);
                    
                    if($info && $info->ret == 0){//0-成功，1-失败
                        
                        $mark_regno = $info->regNo;//商标注册号
                        $regno_md = md5($info->regNo.$info->intCls);//注册号加大类的md5值
                        $mark_name = $info->tmName;//商标名称
                        $image_path = 'http://tmpic.tmkoo.com/'.$info->tmImg;//图片地址
                        $mark_category = $info->intCls;//商标大类
                        $mark_type = 0;//商标分类（0-其他，1-全中文...）
                        
                        $goods = $info->goods;//使用商品（包含群组和适用范围）
                        $mark_group_arr = array();
                        $app_range_arr = array();
                        foreach ($goods as $val){
                            array_push($mark_group_arr,$val->goodsCode);
                            array_push($app_range_arr,$val->goodsName);
                        }
                        $mark_group_arr = array_unique($mark_group_arr);//数组去重
                        $app_range_arr = array_unique($app_range_arr);
                        
                        $mark_group = implode(',',$mark_group_arr);//商标群组
                        $app_range = implode(',',$app_range_arr);//适用范围
                        $mark_length = mb_strlen($info->tmName,"utf-8");//商标名称长度
                        $mark_status = count($info->flow)>0?end($info->flow)->flowName:'';//当前商标状态
                        $mark_flow = json_encode($info->flow,JSON_UNESCAPED_UNICODE);//商标流程
                        $mark_applicant = $info->applicantCn;//商标申请人
                        $app_date = $info->appDate;//商标申请日期
                        $announce_issue = $info->announcementIssue;//初审公告期号
                        $announce_date = $info->announcementDate;//初审公告日期
                        $reg_issue = $info->regIssue;//注册公告期号
                        $reg_date = $info->regDate;//注册公共日期
                        $private_limit = $info->privateDate;//专用期限
                        $mark_price = $post_price;//商标价格
                        $mark_agent = $info->agent;//商标代理公司
                        
                        //加载商标模型类
                        $this->load->model('tool/Mark_model','mark');
                        //get_regnoCount方法得到注册号是否已经存在
                        $count = $this->mark->get_regnoCount($mark_regno);
                        if($count == 0){
                            $addStatus = $this->mark->add_markOne($mark_regno,$regno_md,$mark_name,$image_path,$mark_category,$mark_type,$mark_group,$app_range,$mark_length,$mark_status,$mark_flow,$mark_applicant,$app_date,$announce_issue,$announce_date,$reg_issue,$reg_date,$private_limit,$mark_price,$mark_agent);
                            if($addStatus){
                                $result["status"] = 1;//1-成功，0-失败
                                $result["msg"] = "插入成功，注册号：".$mark_regno."，商标名称：".$mark_name."，商标类别：".$mark_category."，剩余次数：".$info->remainCount;
                            }else{
                                $result["status"] = 0;
                                $result["msg"] = $mark_regno."插入失败";
                            }
                        }else{
                            $result["status"] = 0;
                            $result["msg"] = $mark_regno."注册号已存在，请勿重复插入";
                        }
                        
                    }else{
                        $result["status"] = 0;
                        $result["msg"] = "获取商标信息出错或者商标不存在";
                    }
                    
                }else{
                    $result["status"] = 0;
                    $result["msg"] = "参数类型错误";
                }
                
                array_push($result_list,$result);
                $data["result_list"] = $result_list;
                
            }
            
        }else{
            
        }
        $this->load->view('tool/get_tmkoo_info',$data);
        
    }
    
}
?>