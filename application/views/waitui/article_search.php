<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once(VIEWPATH.'waitui/templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once(VIEWPATH.'waitui/templete/menubar.php') ?>
    
    <div class="container after-cls pt30 pb30">
        <div class="article-left">
            <div class="search">
                <input type="text" placeholder="大家都在搜" value="<?php echo $keyword; ?>" id="keyword" onkeyup="keywordEnter()" />
                <input type="button" value="搜索" id="keywordBtn" onclick="keywordSearch()" />
            </div>
            
            <div class="hotwords">
                <font>热搜词：</font>
                <?php foreach ($article_hotword as $hotword){ ?>
                <a href="<?php echo base_url() ?>article_search/<?php echo $hotword->hotword_name; ?>" target="_blank"><?php echo $hotword->hotword_name; ?></a>
                <?php } ?>
            </div>
            
            <input type="hidden" id="article_page" value="1" />
            
            <div class="article-list" id="article_list" style="border-top: 1px solid #e6e8eb;">
                <?php foreach ($article_list as $article){ ?>
                <a href="<?php echo base_url() ?>article_detail/<?php echo $article->article_id ?>.html" target="_blank" class="article-item">
                    <div class="thumb">
                        <img src="<?php echo $article->thumb_path; ?>" alt="<?php echo $article->article_title; ?>" />
                    </div>
                    <div class="limit">
                        <h4 class="title"><?php echo $article->article_title; ?></h4>
                        <h5 class="summary"><?php echo $article->article_lead; ?></h5>
                    </div>
                    <p><span class="author"><?php echo $article->author_name; ?></span><span class="tag"><?php echo $article->article_tag; ?>&nbsp;&nbsp;<?php echo $article->create_time; ?></span></p>
                </a>
                <?php } ?>
            </div>
            
            <?php if(count($article_list) == 10){ ?>
            <div class="article-loadmore" id="article_loading">加载中，请稍后...</div>
            <div class="article-loadmore" id="article_loadnone" style="display: none;">喂喂，你触碰到我的底线了</div>
            <?php }else{ ?>
            <div class="article-loadmore" id="mark_loading" style="display: none;">加载中，请稍后...</div>
            <div class="article-loadmore" id="mark_loadnone">喂喂，你触碰到我的底线了</div>
            <?php } ?>
        </div>
        <div class="article-right" style="padding-top: 55px;">
            
            <div class="flash" style="border-top: none;">
                <h4 class="title">7×24h&nbsp;快讯</h4>
                <?php foreach ($flash_list as $flash){ ?>
                <div class="flash-item">
                    <a href="javascript:;"><?php echo $flash->flash_title; ?></a>
                    <div><?php echo $flash->flash_content; ?></div>
                    <p><?php echo $flash->create_time; ?></p>
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
            
            <div class="recommend mt20" style="border-top: none;">
                <h4 class="title">推荐阅读</h4>
                <?php foreach ($article_recommend as $recommend){ ?>
                <div class="recommend-item">
                    <a href="<?php echo base_url() ?>article_detail/<?php echo $recommend->article_id ?>.html" target="_blank"><?php echo $recommend->article_title ?></a>
                </div>
                <?php } ?>
            </div>
            
        </div>
    </div>
    
    <?php include_once(VIEWPATH.'waitui/templete/pub_foot.php') ?>
    
    <script type="text/javascript">
    function keywordEnter(e){
        var eve = e || window.event;
        if(eve.keyCode == 13){
            keywordSearch();
        }
    }
    
    function keywordSearch(){
        if($.trim($("#keyword").val()) == ""){
            return;
        }
        location.href = '<?php echo base_url() ?>article_search/'+$("#keyword").val();
    }
    
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
        
        <?php if(count($article_list) == 10){ ?>
        var article_loading = false;//状态标记
        $(window).on("scroll",function(){
            if($("#article_loadnone").is(":visible")) return;
            if($(window).scrollTop() + $(window).height() + 100 < $(document).height()) return;
            if(article_loading) return;
            article_loading = true;
            var current_page = parseInt($("#article_page").val());
            $.ajax({
                type:"post",
                url:"<?php echo base_url() ?>waitui/Index_controller/get_articleSearchAjax_tpl",
                async:true,
                data:{
                    keyword:$("#keyword").val(),
                    page: current_page+1
                },
                success:function(html){
                    var $html = $(html.replace(/[\r\n]/g,""));
                    if($html.length < 10){
                        $("#article_loading").hide();
                        $("#article_loadnone").show();
                    }
                    $("#article_list").append(html);
                    $("#article_page").val(current_page+1);
                    article_loading = false;
                }
            });
        })
        <?php } ?>
        
    })
    </script>
    </body>
</html>
