<!DOCTYPE html>
<html>

    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>

    <body>
    <div class="header"></div>
    <div class="container">
        <!--活动列表-->
        <div class="welfare-list">
            <?php foreach ($welfare_list as $welfare){ ?>
            <a href="<?php echo $welfare->welfare_link; ?>" target="_blank" class="welfare-item">
                <img data-src="<?php echo $welfare->welfare_banner; ?>" />
                <div class="welfare-item-bottom">
                    <div class="welfare-item-title"><?php echo $welfare->welfare_title; ?></div>
                    <div class="welfare-item-time"><?php echo $welfare->create_time; ?></div>
                </div>
            </a>
            <?php } ?>
        </div>
        
        <div class="weui-loadmore weui-loadmore_line">
            <span class="weui-loadmore__tips">喂喂，你触碰到我的底线了</span>
        </div>
        
    </div>
    
    <?php include_once('templete/pub_foot.php') ?>
    <script>
    window.onload = function(){
        
    }
    
    $(function(){
        //图片懒加载
        lazyLoading(5);
        $(".container").on("scroll",function(){
            lazyLoading(5);
        })
    })
    
    </script>
    </body>
</html>