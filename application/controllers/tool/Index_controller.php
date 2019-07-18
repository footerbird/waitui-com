<?php
require 'QueryList/phpQuery.php';
require 'QueryList/QueryList.php';
use QL\QueryList;

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
    
    public function batch_company_info(){//从企查查网站抓取企业基本数据
        header("Content-Type: text/html;charset=utf-8");
        
        $data = array();
        $site_list = trim($this->input->get_post('site_list'));//得到企业详情页面列表
        if(!empty($site_list)){
            
            $data["site_list"] = $site_list;
            $result_list = array();
            $site_list_arr = explode("\r\n", $site_list);
            
            foreach ($site_list_arr as $item){
                $base_info = $this->get_company_detail(trim($item));
                if(is_array($base_info)){//如果采到了企业基础数据
                    
                    if(strpos($base_info['Name'],"公司") !== false){//是公司的才去采集
                        
                        $company_id = md5($base_info['Name'].$base_info['OperName'].random_string_numlet(6));
                        //加载企业模型类
                        $this->load->model('tool/Company_model','company');
                        $addStatus = $this->company->add_companyOne($company_id,$base_info['Name'],$base_info['OperName'],$base_info['RegistCapi'],$base_info['RealCapi'],$base_info['Status'],$base_info['StartDate'],$base_info['CreditCode'],$base_info['TaxNo'],$base_info['No'],$base_info['OrgNo'],$base_info['EconKind'],$base_info['Industry'],$base_info['CheckDate'],$base_info['BelongOrg'],$base_info['Province'],$base_info['EnName'],$base_info['OriginalName'],$base_info['InsuredPerson'],$base_info['StaffSize'],$base_info['BusinessTerm'],$base_info['Address'],$base_info['Scope'],'');
                        if($addStatus){
                            $result["status"] = 1;//1-成功，0-失败
                            $result["msg"] = "插入成功，企业名称 => ".$base_info['Name'];
                        }else{
                            $result["status"] = 0;
                            $result["msg"] = $base_info['Name']." => 插入失败";
                        }
                        
                    }else{
                        $result["status"] = 0;
                        $result["msg"] = $base_info['Name']." => 企业类型不匹配";
                    }
                    
                }else{
                    $result["status"] = 0;
                    $result["msg"] = $base_info;
                }
                
                array_push($result_list,$result);
                $data["result_list"] = $result_list;
                sleep(1);
                
            }
            
        }else{
            
        }
        $this->load->view('tool/batch_company_info',$data);
        
    }
    
    public function get_company_detail($url){
        header("Content-Type: text/html;charset=utf-8");
        
        $html = file_get_contents($url);
        $data = QueryList::Query($html,array(
                'Name' => array('#company-top > div.row > div.content > div.row.title.jk-tip > h1','text'),
                'OperName' => array('#Cominfo > table h2.seo','text'),
                'Info'=> array('#Cominfo > table:nth-child(4)','text'),
              ))->data;
        
        if(is_array($data) && !empty($data[0]) && !empty($data[0]['Name']) && !empty($data[0]['OperName'])){
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
    
}
?>