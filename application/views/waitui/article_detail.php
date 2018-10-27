<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once('templete/pub_head.php') ?>
    <script type="text/javascript">
    function loadHtmlImg(obj){}
    </script>
    </head>
    
    <body>
    
    <?php include_once('templete/menubar.php') ?>
    
    <div class="container after-cls pt30 pb30">
        <div class="article-left bg-white pl20 pr20">
            
            <article>
                <div class="title"><?php echo $article->article_title; ?></div>
                <div class="author">
                    <img class="figure" src="<?php echo $article->figure_path; ?>" />
                    <span class="name"><?php echo $article->author_name; ?></span><span class="time"><?php echo $article->create_time; ?></span><span class="read" style="display: none;">阅读：<?php echo $article->article_read; ?></span>
                </div>
                <div class="summary"><?php echo $article->article_lead; ?></div>
                <section>
                    <?php echo $article->article_content; ?>
                </section>
            </article>
            
        </div>
        <div class="article-right bg-white">
            
            <div class="recommend pl20 pr20" style="border-top: none;">
                <h4 class="title">相关阅读</h4>
                <?php $rela_count = 0; ?>
                <?php foreach ($article_relative as $relative){ ?>
                <?php 
                    $rela_count++;
                    if($rela_count > 3){ break; }
                ?>
                <div class="recommend-item">
                    <a href="<?php echo base_url() ?>article_detail/<?php echo $relative->article_id ?>.html" target="_blank"><?php echo $relative->article_title ?></a>
                </div>
                <?php } ?>
            </div>
            
            <div class="swiper-container swiper mt20" id="article_swiper">
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
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- 如果需要导航按钮 -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            
            <div class="flash mt20 pl20 pr20" style="border-top: none;">
                <h4 class="title">7×24h&nbsp;快讯</h4>
                <?php foreach ($flash_list as $flash){ ?>
                <div class="flash-item">
                    <a href="javascript:;"><?php echo $flash->flash_title; ?></a>
                    <div><?php echo $flash->flash_content; ?></div>
                    <p><?php echo $flash->create_time; ?></p>
                </div>
                <?php } ?>
            </div>
            
        </div>
    </div>
    
    <?php include_once('templete/pub_foot.php') ?>
    
    <script type="text/javascript">
    $(function(){
        
        scrollTop("ico_top");//返回顶部
        
        var mySwiper = new Swiper ('#article_swiper', {
            loop : true,
            autoplay: {
                delay: 8000,//8秒切换一次
            },
            pagination: {
                el: '.swiper-pagination',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        })
        
        $(".flash-item a").on("click",function(){
            $(this).parent().toggleClass("active");
            $(this).siblings("div").slideToggle();
        })
    })
    </script>
    </body>
</html>
