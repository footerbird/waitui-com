<?php
class SpiderCurl_controller extends CI_Controller {
  
  public function index(){//抓取企业资产详情页面
    
    //初始化
    $ch = curl_init();
    //设置选项，包括URL
//  curl_setopt($ch, CURLOPT_URL, 'http://www.waitui.com');//不是https的可以直接抓取，不用模拟referer
//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//  curl_setopt($ch, CURLOPT_HEADER, 0);
//  $html = curl_exec($ch);
//  var_dump($html);
    
    
    $request = [//找出搜狗搜索（品牌_注册商标_域名 site:marksmile.com）首页的10条
      array(
          'url' => 'https://www.marksmile.com/co_6508991.html',
          'referer' => 'https://www.sogou.com/link?url=hedJjaC291MiQ8WHqtObSW0azamf3gBk-jZrXeswlLeN1Cbmjug1jK4to0wa_Tif'
      ),
      array(
          'url' => 'https://www.marksmile.com/co_6517326.html',
          'referer' => 'https://www.sogou.com/link?url=hedJjaC291MiQ8WHqtObSW0azamf3gBk-LzB8u_09nkl3pIJ6roXlq4to0wa_Tif'
      ),
      array(
          'url' => 'https://www.marksmile.com/co_443174.html',
          'referer' => 'https://www.sogou.com/link?url=hedJjaC291MiQ8WHqtObSW0azamf3gBkr48Y9MoKfozzG34vhdhOfa3mlRzfPLR2'
      ),
      array(
          'url' => 'https://www.marksmile.com/co_454402.html',
          'referer' => 'https://www.sogou.com/link?url=hedJjaC291MiQ8WHqtObSW0azamf3gBke-bdlgwIj2pzfREMVT7lc63mlRzfPLR2'
      ),
      array(
          'url' => 'https://www.marksmile.com/co_6490776.html',
          'referer' => 'https://www.sogou.com/link?url=hedJjaC291MiQ8WHqtObSW0azamf3gBk1KOUiDORropA-2cQmF8via4to0wa_Tif'
      ),
      array(
          'url' => 'https://www.marksmile.com/co_58931.html',
          'referer' => 'https://www.sogou.com/link?url=hedJjaC291MiQ8WHqtObSW0azamf3gBkW3AwgxXpsMG6RXux8BGC0A..'
      ),
      array(
          'url' => 'https://www.marksmile.com/co_442153.html',
          'referer' => 'https://www.sogou.com/link?url=hedJjaC291MiQ8WHqtObSW0azamf3gBk3Rl-Fad1sELrgR4zhcU7Na3mlRzfPLR2'
      ),
      array(
          'url' => 'https://www.marksmile.com/co_424367.html',
          'referer' => 'https://www.sogou.com/link?url=hedJjaC291MiQ8WHqtObSW0azamf3gBkPYnuTAdHvHsJ2Aykg_UU863mlRzfPLR2'
      ),
      array(
          'url' => 'https://www.marksmile.com/co_16628150.html',
          'referer' => 'https://www.sogou.com/link?url=hedJjaC291MiQ8WHqtObSW0azamf3gBk0gD4vmb_8Hp2BMgXNIQC-iHmfGkNvdZG'
      ),
      array(
          'url' => 'https://www.marksmile.com/co_1879795.html',
          'referer' => 'https://www.sogou.com/link?url=hedJjaC291MiQ8WHqtObSW0azamf3gBkJ5stkEwcshbqEAEOJ_nrzq4to0wa_Tif'
      )
    ];
    
    $proxy = [
      '111.230.221.205:80',
      '115.154.55.101:1080',
      '121.31.100.195:8123',
      '125.120.8.159:808',
      '115.198.36.76:6666',
      '125.118.72.188:808',
      '125.118.78.7:6666',
      '175.155.24.3:808',
      '36.33.25.225:808',
      '183.167.217.152:63000'
    ];
    
    $agent = [
      //PC端的UserAgent  
      "safari 5.1 – MAC"=>"Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11",  
      "safari 5.1 – Windows"=>"Mozilla/5.0 (Windows; U; Windows NT 6.1; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50",  
      "Firefox 38esr"=>"Mozilla/5.0 (Windows NT 10.0; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0",  
      "IE 11"=>"Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; .NET4.0C; .NET4.0E; .NET CLR 2.0.50727; .NET CLR 3.0.30729; .NET CLR 3.5.30729; InfoPath.3; rv:11.0) like Gecko",  
      "IE 9.0"=>"Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0",  
      "IE 8.0"=>"Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)",  
      "IE 7.0"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)",  
      "IE 6.0"=>"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)",  
      "Firefox 4.0.1 – MAC"=>"Mozilla/5.0 (Macintosh; Intel Mac OS X 10.6; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",  
      "Firefox 4.0.1 – Windows"=>"Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",  
      "Opera 11.11 – MAC"=>"Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; en) Presto/2.8.131 Version/11.11",  
      "Opera 11.11 – Windows"=>"Opera/9.80 (Windows NT 6.1; U; en) Presto/2.8.131 Version/11.11",  
      "Chrome 17.0 – MAC"=>"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_0) AppleWebKit/535.11 (KHTML, like Gecko) Chrome/17.0.963.56 Safari/535.11",  
      "Chrome 67.0 – Windows"=>"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36",  
      "Chrome 67.0 – Windows"=>"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36",  
      "Chrome 67.0 – Windows"=>"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36",  
      "Chrome 67.0 – Windows"=>"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36",  
      "Chrome 67.0 – Windows"=>"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36",  
      "Chrome 67.0 – Windows"=>"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.87 Safari/537.36",  
      "傲游（Maxthon）"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Maxthon 2.0)",  
      "腾讯TT"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; TencentTraveler 4.0)",  
      "世界之窗（The World） 2.x"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)",  
      "世界之窗（The World） 3.x"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; The World)",  
      "360浏览器"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; 360SE)",  
      "搜狗浏览器 1.x"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Trident/4.0; SE 2.X MetaSr 1.0; SE 2.X MetaSr 1.0; .NET CLR 2.0.50727; SE 2.X MetaSr 1.0)",  
      "Avant"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Avant Browser)",  
      "Green Browser"=>"Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)",  
      //移动端口  
      //"safari iOS 4.33 – iPhone"=>"Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5",  
      //"safari iOS 4.33 – iPod Touch"=>"Mozilla/5.0 (iPod; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5",  
      //"safari iOS 4.33 – iPad"=>"Mozilla/5.0 (iPad; U; CPU OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5",  
      //"Android N1"=>"Mozilla/5.0 (Linux; U; Android 2.3.7; en-us; Nexus One Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1",  
      //"Android QQ浏览器 For android"=>"MQQBrowser/26 Mozilla/5.0 (Linux; U; Android 2.3.7; zh-cn; MB200 Build/GRJ22; CyanogenMod-7) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1",  
      //"Android Opera Mobile"=>"Opera/9.80 (Android 2.3.4; Linux; Opera Mobi/build-1107180945; U; en-GB) Presto/2.8.149 Version/11.10",  
      //"Android Pad Moto Xoom"=>"Mozilla/5.0 (Linux; U; Android 3.0; en-us; Xoom Build/HRI39) AppleWebKit/534.13 (KHTML, like Gecko) Version/4.0 Safari/534.13",  
      //"BlackBerry"=>"Mozilla/5.0 (BlackBerry; U; BlackBerry 9800; en) AppleWebKit/534.1+ (KHTML, like Gecko) Version/6.0.0.337 Mobile Safari/534.1+",  
      //"WebOS HP Touchpad"=>"Mozilla/5.0 (hp-tablet; Linux; hpwOS/3.0.0; U; en-US) AppleWebKit/534.6 (KHTML, like Gecko) wOSBrowser/233.70 Safari/534.6 TouchPad/1.0",  
      //"UC标准"=>"NOKIA5700/ UCWEB7.0.2.37/28/999",  
      //"UCOpenwave"=>"Openwave/ UCWEB7.0.2.37/28/999",  
      //"UC Opera"=>"Mozilla/4.0 (compatible; MSIE 6.0; ) Opera/UCWEB7.0.2.37/28/999",  
      //"微信内置浏览器"=>"Mozilla/5.0 (Linux; Android 6.0; 1503-M02 Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/37.0.0.0 Mobile MQQBrowser/6.2 TBS/036558 Safari/537.36 MicroMessenger/6.3.25.861 NetType/WIFI Language/zh_CN"
    ];
    
    do{
        
        $stop = require 'SpiderVisit_stop.php';
        if($stop) die('process abort');
        
        $rad_request = $request[array_rand($request,1)];
        $rad_agent = $agent[array_rand($agent,1)];
        
        $rad_proxy = $proxy[array_rand($proxy,1)];
        
//      $url = $rad_request['url'];
        $url = 'https://www.marksmile.com/co_'.rand(1000000,5000000).'.html';
        $rad_proxy_arr = explode(':', $rad_proxy);
        
        echo $rad_proxy;
        curl_setopt($ch, CURLOPT_PROXY, $rad_proxy_arr[0]); //代理服务器地址   
        curl_setopt($ch, CURLOPT_PROXYPORT,$rad_proxy_arr[1]); //代理服务器端口
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_REFERER, $rad_request['referer']);
        curl_setopt ($ch, CURLOPT_USERAGENT, $rad_agent);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3+rand(0, 100)*0.01);
        //执行并获取HTML文档内容
        $html = curl_exec($ch);
        if($html){
          echo "ip有效".$url;
        }else{
          var_dump($html);
        }
        
        echo "<br/>";
        
    }while(true);
    
  }
}