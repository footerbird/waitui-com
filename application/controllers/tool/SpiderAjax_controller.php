<?php
require 'Guzzle/vendor/autoload.php';
class SpiderAjax_controller extends CI_Controller {
  
  public function index(){//获取麦知网商标数据ajax接口
    
    $client = new \GuzzleHttp\Client();
    header("Content-type: text/html; charset=utf-8");
    
        $url = 'http://www.maizhi.com/api/search/new_index';
        $param['headers'] = [
          'referer' => 'http://www.maizhi.com/',
          'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36'
        ];
        $param['verify'] = false;
        $param['query'] = [
          'curpage' => 1,
          '_' => time(),
        ];
        $response = $client->request('GET', $url, $param);
        $body = json_decode($response->getBody(true));
        var_dump($body);
        
  }
}