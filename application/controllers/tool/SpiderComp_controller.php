<?php
require 'QueryList/phpQuery.php';
require 'QueryList/QueryList.php';
use QL\QueryList;
  
class SpiderComp_controller extends CI_Controller {
    
  public function index(){//抓取企业资产详情页面
      //可以先手动获取要采集的页面源码
      for($i=481;$i<=500;$i++){
          $html = file_get_contents('https://www.qichacha.com/g_HAIN_'.$i.'.html');
          //然后可以把页面源码或者HTML片段传给QueryList
          
          $data = QueryList::Query($html,array(
            'Link' => array('#searchlist > a','href'),
          ))->data;
          
          foreach($data as $item){
            echo 'https://www.qichacha.com'.$item['Link'].'<br>';
          }
      }
      
  }
  
}
?>