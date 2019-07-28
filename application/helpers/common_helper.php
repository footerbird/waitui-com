<?php

//发送验证码
if( !function_exists('send_sms_api') )
{
    function send_sms_api($mobile,$code){
        $sdkappid = 1400090507;
        $appkey = 'eb16cd68e63d94e0d1467fd2d3ff7607';//App Key是用来校验短信发送请求合法性的密码，与SDK AppID对应，需要业务方高度保密，切勿把密码存储在客户端。
        $random = rand(pow(10, 5), (pow(10, 6)-1));//随机数
        $time = time();//当前时间
        
        $params = [(string)$code];
        $sig = hash('sha256', 'appkey='.$appkey.'&random='.$random.'&time='.$time.'&mobile='.$mobile);
        $tel = array(
                    'mobile'=>(string)$mobile,
                    'nationcode'=>'86'
                );
        $tpl_id = 117869;
        $url = 'https://yun.tim.qq.com/v5/tlssmssvr/sendsms?sdkappid='.$sdkappid.'&random='.$random;
        $post_data = array();
        $post_data['params'] = $params;
        $post_data['sig'] = $sig;
        $post_data['tel'] = $tel;
        $post_data['time'] = $time;
        $post_data['tpl_id'] = $tpl_id;
        
        //初始化
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        //执行并获取HTML文档内容
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}

//格式化资讯发布日期
if( !function_exists('format_article_time') )
{
    function format_article_time($fmt_time){
        if(!$fmt_time){
            return false;
        }
        $fmt_time = strtotime($fmt_time);
        $diff = time() - $fmt_time;
        if($diff < 60){//小于1分钟
            return '刚刚';
        }else if($diff < 60*60){//大于等于1分钟，小于1小时
            return floor($diff/60).'分钟前';
            
        }else if($diff < 60*60*24){//大于等于1小时，小于1天
            return floor($diff/3600).'小时前';
            
        }else if($diff < 60*60*24*4){//大于等于1天，小于4天
            return floor($diff/86400).'天前';
            
        }else{//大于等于4天，则用年月日表示
            return date('Y-m-d',$fmt_time);
        }
    }
}

//格式化域名距到期
if( !function_exists('format_domain_exptime') )
{
    function format_domain_exptime($fmt_time){
        if(!$fmt_time){
            return false;
        }
        $fmt_time = strtotime($fmt_time);
        $diff = $fmt_time - time();
        return floor($diff/86400);
    }
}

//格式化商标注册年限
if( !function_exists('format_markreg_year') )
{
    function format_markreg_year($fmt_time){
        if(!$fmt_time){
            return false;
        }
        $fmt_time = strtotime($fmt_time);
        $diff = time() - $fmt_time;
        return floor($diff/31536000).'年';//60*60*24*365
    }
}

//生成随机字符串，包括数字和字母
if( !function_exists('random_string_numlet') )
{
    function random_string_numlet($length){
        if(!$length){
            return false;
        }
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = "";
        for($i=0;$i<$length;$i++){
            $str .= $pattern{mt_rand(0,61)};//生成php随机数   
        } 
        return $str;
    }
}

//上传图片到临时目录
if( !function_exists('upload_images_temp') )
{
    function upload_images_temp($fileInfo,$uploadPath = 'uploads/images/temp',$flag=true,$allowExt=array('jpeg','jpg','gif','png','JPEG','JPG','GIF','PNG'),$maxSize = 10485760){
        // 判断错误号
        if ($fileInfo ['error'] > 0) {
            switch ($fileInfo ['error']) {
                case 1 :
                    $mes = '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
                    break;
                case 2 :
                    $mes = '超过了表单MAX_FILE_SIZE限制的大小';
                    break;
                case 3 :
                    $mes = '文件部分被上传';
                    break;
                case 4 :
                    $mes = '没有选择上传文件';
                    break;
                case 6 :
                    $mes = '没有找到临时目录';
                    break;
                case 7 :
                case 8 :
                    $mes = '系统错误';
                    break;
            }
            echo ( $mes );
            return false;
        }
        $ext = pathinfo ( $fileInfo ['name'], PATHINFO_EXTENSION );
        if(!is_array($allowExt)){
            exit('系统错误');
        }
        // 检测上传文件的类型
        if (! in_array ( $ext, $allowExt )) {
            exit ( '非法文件类型' );
        }
        // 检测上传文件大小是否符合规范
        if ($fileInfo ['size'] > $maxSize) {
            exit ( '上传文件过大' );
        }
        //检测图片是否为真实的图片类型
        //$flag=true;	
        if($flag){
            if(!getimagesize($fileInfo['tmp_name'])){
                exit('不是真实图片类型');
            }
        }
        // 检测文件是否是通过HTTP POST方式上传上来
        if (! is_uploaded_file ( $fileInfo ['tmp_name'] )) {
            exit ( '文件不是通过HTTP POST方式上传上来的' );
        }
        if (! file_exists ( $uploadPath )) {
            mkdir ( $uploadPath, 0777, true );
            chmod ( $uploadPath, 0777 );
        }
        $uniName = md5 ( uniqid ( microtime ( true ), true ) ) . '.' . $ext;
        $destination = $uploadPath . '/' . $uniName;
        
        //删除temp文件夹下的临时图片
        // $dir=opendir($uploadPath);
        // while ($item=readdir($dir)) {
        // 	if($item!= "." && $item != ".."){
        // 		$imagePath=$uploadPath."/".$item;
        // 		unlink($imagePath);
        // 	}
        // }
        
        if (! @move_uploaded_file ( $fileInfo ['tmp_name'], $destination )) {
            exit ( '文件移动失败' );
        }
        
        //echo '文件上传成功';
        return array(
            'state'=>'success',
            'url'=>$destination,
            'name'=>$fileInfo['name'],
            'size'=>$fileInfo['size']
        );
    }
}

//上传图片到临时目录
if( !function_exists('upload_files_temp') )
{
    function upload_files_temp($fileInfo,$uploadPath = 'uploads/files/temp',$maxSize = 10485760){
        // 判断错误号
        if ($fileInfo ['error'] > 0) {
            switch ($fileInfo ['error']) {
                case 1 :
                    $mes = '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
                    break;
                case 2 :
                    $mes = '超过了表单MAX_FILE_SIZE限制的大小';
                    break;
                case 3 :
                    $mes = '文件部分被上传';
                    break;
                case 4 :
                    $mes = '没有选择上传文件';
                    break;
                case 6 :
                    $mes = '没有找到临时目录';
                    break;
                case 7 :
                case 8 :
                    $mes = '系统错误';
                    break;
            }
            echo ( $mes );
            return false;
        }
        $ext = pathinfo ( $fileInfo ['name'], PATHINFO_EXTENSION );
        // 检测上传文件大小是否符合规范
        if ($fileInfo ['size'] > $maxSize) {
            exit ( '上传文件过大' );
        }
        // 检测文件是否是通过HTTP POST方式上传上来
        if (! is_uploaded_file ( $fileInfo ['tmp_name'] )) {
            exit ( '文件不是通过HTTP POST方式上传上来的' );
        }
        if (! file_exists ( $uploadPath )) {
            mkdir ( $uploadPath, 0777, true );
            chmod ( $uploadPath, 0777 );
        }
        $uniName = md5 ( uniqid ( microtime ( true ), true ) ) . '.' . $ext;
        $destination = $uploadPath . '/' . $uniName;
        
        //删除temp文件夹下的临时图片
        // $dir=opendir($uploadPath);
        // while ($item=readdir($dir)) {
        // 	if($item!= "." && $item != ".."){
        // 		$imagePath=$uploadPath."/".$item;
        // 		unlink($imagePath);
        // 	}
        // }
        
        if (! @move_uploaded_file ( $fileInfo ['tmp_name'], $destination )) {
            exit ( '文件移动失败' );
        }
        
        //echo '文件上传成功';
        return array(
            'state'=>'success',
            'url'=>$destination,
            'name'=>$fileInfo['name'],
            'size'=>$fileInfo['size']
        );
    }
}

?>