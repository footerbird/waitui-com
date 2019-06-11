<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once(VIEWPATH.'waitui/templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_menubar.php') ?>
    
    <div class="my-container pt30">
        <?php include_once(VIEWPATH.'waitui/templete/my_leftmenu.php') ?>
        <div class="my-mainpanel">
            <div class="panel-title mb20">登录日志</div>
            <table class="my-table" width="100%">
                <thead>
                    <tr>
                        <th align="left" width="20%" class="pl30">登录时间</th>
                        <th align="center" width="20%">登录方式</th>
                        <th align="center" width="25%">定位</th>
                        <th align="left" width="35%" class="pr30">备注</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="pl30">2019-03-29 12:03:18</td>
                        <td align="center">移动端</td>
                        <td align="center">浙江省杭州市</td>
                        <td class="pr30">异常登录：非常用设备</td>
                    </tr>
                    <tr>
                        <td class="pl30">2019-03-29 12:03:18</td>
                        <td align="center">PC</td>
                        <td align="center">浙江省杭州市</td>
                        <td class="pr30">异常登录：非常用设备</td>
                    </tr>
                    <tr>
                        <td class="pl30">2019-03-29 12:03:18</td>
                        <td align="center">PC</td>
                        <td align="center">浙江省杭州市</td>
                        <td class="pr30">异常登录：非常用地区</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/my_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
    })
    </script>
    </body>
</html>
