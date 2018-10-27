<?php
require 'QueryList/phpQuery.php';
require 'QueryList/QueryList.php';
use QL\QueryList;
  
class SpiderPage_controller extends CI_Controller {
    
  public function index(){//抓取企业资产详情页面
//    $data = QueryList::Query('https://www.marksmile.com/co_2867382.html',array("image"=>array('img','src')))->data;
//    var_dump($data);
    //可以先手动获取要采集的页面源码
      $html = file_get_contents('https://www.marksmile.com/co_2867382.html');
      //然后可以把页面源码或者HTML片段传给QueryList
      $available = QueryList::Query($html,array(//判断页面是否有效(是否有企业logo)
        'qiye_logo' => array('body > div.bg-e9eff4 > div > div.company-base > table > tbody > tr:nth-child(1) > td:nth-child(1) > img','src')
      ))->data;
      if(empty($available)){
        continue;
      }
      
      $data = QueryList::Query($html,array(
        'qiye_logo' => array('body > div.bg-e9eff4 > div > div.company-base > table > tbody > tr:nth-child(1) > td:nth-child(1) > img','src'),
        'legal_name' => array('body > div.bg-e9eff4 > div > div.company-base > table > tbody > tr:nth-child(2) > td:nth-child(1)','text'),
        'capital' => array('body > div.bg-e9eff4 > div > div.company-base > table > tbody > tr:nth-child(2) > td:nth-child(2)','text'),

//以下为以前采集融途网的一些相关数据
//      'platcapital_leader' => array('body > div.j-box > div.conbox.margauto > div > div.gongsi > div.gongsi_mid > dl:nth-child(1) > dd','text'),
//      'reg_address' => array('body > div.j-box > div.conbox.margauto > div > div.gongsi > div.gongsi_mid > dl:nth-child(4) > dd','text'),
//      'plat_website' => array('body > div.j-box > div.conbox.margauto > div > div.gongsi > div.gongsi_mid > dl.cur > dd > a','href'),
//      'online_time' => array('body > div.j-box > div.conbox.margauto > div > div.gongsi > div.gongsi_mid > dl:nth-child(2) > dd','text'),
//      'reg_capital' => array('body > div.j-box > div.conbox.margauto > div > div.gongsi > div.gongsi_mid > dl:nth-child(5) > dd','text'),
//      'annual_yield' => array('body > div.j-box > div.conbox.margauto > div > div.gongsi > div.gongsi_mid > dl:nth-child(3) > dd','text'),
//      'plat_intro' => array('body > div.j-box > div.conbox.margauto > div > div.danganintro > ul > li.li1','text','-h2')//去除公司简介标题
      ))->data;
      
      var_dump($data);
      
  }
  
}
?>