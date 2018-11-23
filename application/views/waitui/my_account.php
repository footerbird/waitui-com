<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once('templete/my_menubar.php') ?>
    
    <div class="my-container pt30">
        <?php include_once('templete/my_leftmenu.php') ?>
        <div class="my-mainpanel">
            <div class="f18">hello,<?php echo $userinfo->user_name; ?></div>
        </div>
    </div>
    
    <?php include_once('templete/my_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
    })
    </script>
    </body>
</html>
