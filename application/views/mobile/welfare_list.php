<!DOCTYPE html>
<html>

    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>

    <body>
    <div class="header"></div>
    <div class="container" style="padding-bottom: 50px;">
        <!--banner图轮播-->
        <div class="swiper-container welfare-banner" id="swiper-container-welfare">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="javascript:;">
                        <img src="<?php echo CDN_URL; ?>welfare/welfare_banner_1.jpg" />
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="javascript:;">
                        <img src="<?php echo CDN_URL; ?>welfare/welfare_banner_2.jpg" />
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="javascript:;">
                        <img src="<?php echo CDN_URL; ?>welfare/welfare_banner_3.jpg" />
                    </a>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
        
        <!--公告头条轮播-->
        <div class="welfare-announcement">
            <div class="swiper-container" id="swiper-container-announcement">
                <div class="swiper-wrapper">
                    <?php foreach ($article_list as $art_key => $art_val){ ?>
                        <?php if($art_key%2 == 0){ ?>
                        <div class="swiper-slide">
                            <a href="<?php echo base_url() ?>m/article_list.html" target="_parent">
                                <p><font><?php echo $art_val->article_tag; ?></font><?php echo $art_val->article_title; ?></p>
                        <?php }else{ ?>
                                <p><font><?php echo $art_val->article_tag; ?></font><?php echo $art_val->article_title; ?></p>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <!--专题版块-->
        <div class="welfare-subject">
            <div class="welfare-subject-grids">
                <a href="<?php echo base_url() ?>m/welfare_entry.html" target="_parent" class="item"><span style="padding-right: 15px;"><i class="user"></i>新户专享</span></a>
                <a href="<?php echo base_url() ?>m/welfare_entry.html" target="_parent" class="item mid"><span><i class="fire"></i>新品活动<i class="hot"></i></span></a>
                <a href="<?php echo base_url() ?>m/welfare_entry.html" target="_parent" class="item"><span style="padding-left: 15px;"><i class="crown"></i>大牌专区</span></a>
            </div>
            <div class="welfare-subject-topic">
                <a class="brand" href="https://www.marksmile.com/m" target="_parent">
                    <div class="title">品牌保护</div>
                    <h2>中国品牌的网络警卫</h2>
                    <h3>让品牌微笑</h3>
                </a>
                <div class="brand-flex">
                    <a class="domain" href="http://www.yumi.com/" target="_parent">
                        <div class="title">域名服务</div>
                        <h2>让网站更好记</h2>
                        <h3>品牌大数据，全网监控</h3>
                    </a>
                    <a class="mark" href="http://www.shangbiao.com/" target="_parent">
                        <div class="title">商标服务</div>
                        <h2>好产品的出路</h2>
                        <h3>一站式商标解决方案</h3>
                    </a>
                </div>
            </div>
        </div>
        
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
    <?php include_once('templete/tabbar.php') ?>
    
    <?php include_once('templete/pub_foot.php') ?>
    <script>
    window.onload = function(){
        
    }
    
    $(function(){
        var mySwiper_banner = new Swiper ('#swiper-container-welfare', {
            loop : true,
            autoplay: {
                delay: 8000,//8秒切换一次
            },
            pagination: {
                el: '.swiper-pagination',
            }
        })
        
        var mySwiper_announcement = new Swiper ('#swiper-container-announcement', {
            loop : true,
            autoplay: {
                delay: 10000,//10秒切换一次
            },
            direction: 'vertical'
        })
        
        //图片懒加载
        lazyLoading(5);
        $(".container").on("scroll",function(){
            lazyLoading(5);
        })
    })
    
    </script>
    </body>
</html>