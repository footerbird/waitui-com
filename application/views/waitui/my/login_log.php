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
                        <th align="center" width="25%">登录方式</th>
                        <th align="center" width="25%">登录IP</th>
                        <th align="center" width="30%" class="pr30">定位</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($login_list as $login){ ?>
                    <tr>
                        <td class="pl30"><?php echo $login->login_time; ?></td>
                        <td align="center"><?php echo $login->login_client; ?></td>
                        <td align="center"><?php echo $login->login_ip; ?></td>
                        <td align="center" class="pr30"><?php echo $login->login_city; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="route-pagination">
            <?php echo $this->pagination->create_links(); ?>
            <div class="total">共<font><?php echo $page_count; ?></font>条，每页显示<font><?php echo $page_size; ?></font>条</div>
            </div>
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
