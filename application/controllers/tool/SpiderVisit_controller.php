<?php
require 'Guzzle/vendor/autoload.php';
class SpiderVisit_controller extends CI_Controller {
  
  public function index(){//模拟搜狗搜索访问企业资产详情页面
    
    ignore_user_abort();
    
    $client = new \GuzzleHttp\Client();
    header("Content-type: text/html; charset=utf-8");
    
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
      '115.223.250.102:9000',
      '117.90.4.146:9000',
      '115.213.247.41:9000',
      '115.223.229.218:9000',
      '183.154.214.114:9000',
      '115.223.214.49:9000',
      '115.218.221.17:9000',
      '180.118.92.219:9000',
      '180.118.86.57:9000',
      '125.117.134.243:9000',
      '106.14.197.219:8118',
      '115.154.55.101:1080',
      '117.90.137.147:9000',
      '115.210.24.60:9000',
      '115.223.194.51:9000',
      '61.145.194.26:8080',
      '122.243.8.183:9000',
      '111.230.221.205:80',
      '183.158.204.168:9000',
      '115.223.196.148:9000',
      '115.218.211.39:9000',
      '220.184.38.141:9000',
      '121.69.70.182:8118',
      '115.210.27.8:9000',
      '115.223.231.137:9000',
      '114.234.83.208:9000',
      '115.223.207.198:9000',
      '171.92.35.234:9000',
      '118.24.78.241:8000',
      '117.90.2.128:9000',
      '122.234.205.227:9000',
      '119.136.145.159:808',
      '180.118.86.44:9000',
      '115.218.122.11:9000',
      '180.104.63.114:9000',
      '115.223.214.228:9000',
      '58.217.14.251:9000',
      '183.147.222.121:9000',
      '116.77.204.51:8118',
      '115.223.245.41:9000',
      '117.90.252.153:9000',
      '180.104.63.150:9000',
      '180.118.128.145:9000',
      '112.240.181.121:9000',
      '115.223.223.65:9000',
      '115.223.194.87:9000',
      '115.223.205.153:9000',
      '122.242.82.121:9000',
      '114.101.46.82:63909',
      '182.87.186.216:9000',
      '114.101.45.27:63909',
      '182.87.137.133:9000',
      '180.118.86.164:9000',
      '115.223.216.246:9000',
      '115.193.99.2:9000',
      '223.150.39.113:9000',
      '122.241.217.152:9000',
      '115.223.221.134:9000',
      '27.220.125.44:9000',
      '115.223.215.160:9000',
      '106.5.202.2:9000',
      '121.232.148.93:9000',
      '115.223.201.174:9000',
      '115.223.197.119:9000',
      '223.242.94.149:31773',
      '115.223.194.77:9000',
      '115.223.241.30:9000',
      '115.223.204.126:9000',
      '121.31.177.0:8123',
      '115.218.127.185:9000',
      '101.96.11.74:8090',
      '115.218.121.143:9000',
      '118.117.136.114:9000',
      '114.235.22.226:9000',
      '49.81.125.21:9000',
      '115.218.121.1:9000',
      '115.218.120.75:9000',
      '120.25.203.182:7777',
      '27.220.51.247:9000',
      '115.223.251.92:9000',
      '117.90.252.55:9000',
      '115.223.249.79:9000',
      '183.154.212.126:9000',
      '115.223.203.50:9000',
      '163.125.249.1:8118',
      '114.234.80.201:9000',
      '182.87.38.252:9000',
      '101.110.118.22:80',
      '115.223.229.116:9000',
      '117.87.177.197:9000',
      '60.18.0.245:80',
      '115.218.121.255:9000',
      '27.184.124.33:8118',
      '180.118.94.212:9000',
      '119.176.77.167:9000',
      '115.223.239.39:9000',
      '58.217.14.56:9000',
      '123.133.196.251:9000',
      '115.216.38.190:9000'
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
    
        $url = $rad_request['url'];
        $param['headers'] = [
          'referer' => $rad_request['referer'],
          'User-Agent' => $rad_agent
        ];
//      $param['proxy'] = [
//          'http'  => $rad_proxy, // Use this proxy with "http"
//      ];//代理ip
        $param['verify'] = false;
        $param['timeout'] = 3+rand(0, 100)*0.01;
        $response = $client->request('GET', $url, $param);
        echo $rad_proxy;
        var_dump($response);
        echo "<br>###############################################################################<br>";
        
//      sleep(rand(120,180));
        
    }while(true);
    
  }
}