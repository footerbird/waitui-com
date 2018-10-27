<?php
class Captcha_controller extends CI_Controller {

  public function mark_regno_image($mark_regno) {//商标注册号生成图片
    $mark_regno = substr($mark_regno,6);//截掉前面的6位
    $mark_regno = base64_decode($mark_regno);
    $regno_length = strlen($mark_regno);
    //解密
    $im = imagecreate(10*$regno_length, 20);
    // 白色背景和黑色文本
    $bg = imagecolorallocate($im, 255, 255, 255);
    $textcolor = imagecolorallocate($im, 125, 125, 125);
    // 把字符串写在图像左上角
    imagestring($im, 5, 0, 1, $mark_regno, $textcolor);
    //输出图片
    header("Content-type: image/png");
    imagepng($im);
  }

}
?>