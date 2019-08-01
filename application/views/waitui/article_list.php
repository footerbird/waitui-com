<!DOCTYPE html>
<html>
    
    <head>
    <?php include_once(VIEWPATH.'waitui/templete/pub_head.php') ?>
    </head>
    
    <body>
    
    <?php include_once(VIEWPATH.'waitui/templete/menubar.php') ?>
    
    <div class="container after-cls pt30 pb30">
        <div class="article-left">
            <div class="hotwords">
                <font>热搜词：</font>
                <?php foreach ($article_hotword as $hotword){ ?>
                <a href="<?php echo base_url() ?>article_search/<?php echo $hotword->hotword_name; ?>" target="_blank"><?php echo $hotword->hotword_name; ?></a>
                <?php } ?>
            </div>
            
            <div class="article-table">
                <table width="100%">
                    <tr>
                        <td rowspan="2">
                            <a href="<?php echo base_url() ?>article_detail/<?php echo $article_first->article_id ?>.html" target="_blank" title="<?php echo $article_first->article_title; ?>">
                                <img class="big" src="<?php echo $article_first->thumb_path; ?>" alt="<?php echo $article_first->article_title; ?>" />
                                <div class="title ta-c"><?php echo $article_first->article_title; ?></div>
                            </a>
                        </td>
                        <td class="pr0" width="240">
                            <a href="<?php echo base_url() ?>article_detail/<?php echo $article_second->article_id ?>.html" target="_blank" title="<?php echo $article_second->article_title; ?>">
                                <img src="<?php echo $article_second->thumb_path; ?>" alt="<?php echo $article_second->article_title; ?>" />
                                <div class="title"><?php echo $article_second->article_title; ?></div>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="pr0" width="240">
                            <a href="<?php echo base_url() ?>article_detail/<?php echo $article_third->article_id ?>.html" target="_blank" title="<?php echo $article_third->article_title; ?>">
                                <img src="<?php echo $article_third->thumb_path; ?>" alt="<?php echo $article_third->article_title; ?>" />
                                <div class="title"><?php echo $article_third->article_title; ?></div>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="categorys">
                <a class="cur" href="javascript:;">最新文章</a>
                <?php foreach ($article_category as $category){ ?>
                <a href="javascript:;" data-category="<?php echo $category->category_type; ?>"><?php echo $category->category_name; ?></a>
                <?php } ?>
            </div>
            
            <input type="hidden" id="article_category" value="" />
            <input type="hidden" id="article_page" value="1" />
            
            <div class="article-list" id="article_list">
                <?php foreach ($article_list as $article){ ?>
                <a href="<?php echo base_url() ?>article_detail/<?php echo $article->article_id ?>.html" target="_blank" class="article-item">
                    <div class="thumb">
                        <img data-src="<?php echo $article->thumb_path; ?>" src="<?php echo CDN_URL; ?>favicon_220X140.png" alt="<?php echo $article->article_title; ?>" />
                    </div>
                    <div class="limit">
                        <h4 class="title"><?php echo $article->article_title; ?></h4>
                        <h5 class="summary"><?php echo $article->article_lead; ?></h5>
                    </div>
                    <p><span class="author"><?php echo $article->author_name; ?></span><span class="tag"><?php echo $article->article_tag; ?>&nbsp;&nbsp;<?php echo $article->create_time; ?></span></p>
                </a>
                <?php } ?>
            </div>
            
            <div class="article-loadmore" id="article_loading">加载中，请稍后...</div>
            <div class="article-loadmore" id="article_loadnone" style="display: none;">喂喂，你触碰到我的底线了</div>
            
        </div>
        <div class="article-right">
            <div class="search">
                <form id="search_form" action="" target="_blank" method="post"></form>
                <input type="text" placeholder="大家都在搜" id="keyword" onkeyup="keywordEnter()" />
                <input type="button" id="keywordBtn" onclick="keywordSearch()" />
            </div>
            
            <div class="flash">
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
                        <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=2165223868&amp;site=qq&amp;menu=yes" target="_blank">
                            <img src="/htdocs/waitui/images/ad/ad-domain-entrust.png" />
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="<?php echo base_url() ?>/domain_list.html" target="_blank">
                            <img src="/htdocs/waitui/images/ad/ad-domain-market.png" />
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
        $("#search_form").attr('action','<?php echo base_url() ?>article_search/'+$("#keyword").val());
        $("#search_form").submit();
    }
    
    $(function(){
        
        lazyLoading();//图片懒加载
        $(window).on("scroll",function(){
            lazyLoading();
        })
        
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
        
        var article_loading = false;//状态标记
        $(window).on("scroll",function(){
            if($("#article_loadnone").is(":visible")) return;
            if($(window).scrollTop() + $(window).height() + 100 < $(document).height()) return;
            if(article_loading) return;
            article_loading = true;
            var current_page = parseInt($("#article_page").val());
            $.ajax({
                type:"post",
                url:"<?php echo base_url() ?>waitui/Index_controller/get_articleListAjax_tpl",
                async:true,
                data:{
                    category:$("#article_category").val(),
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
        
        $(".categorys a").on("click",function(){
            $("#article_category").val($(this).data("category")?$(this).data("category"):"");
            $(this).addClass("cur").siblings().removeClass("cur");
            $("#article_list").empty();
            $("#article_page").val(0);
            $("#article_loading").show();
            $("#article_loadnone").hide();
            article_loading = true;
            var current_page = parseInt($("#article_page").val());
            var repeatArr = [<?php echo $article_first->article_id ?>,<?php echo $article_second->article_id ?>,<?php echo $article_third->article_id ?>];
            $.ajax({
                type:"post",
                url:"<?php echo base_url() ?>waitui/Index_controller/get_articleListAjax_tpl",
                async:true,
                data:{
                    category:$("#article_category").val(),
                    page: current_page+1,
                    repeat: repeatArr
                },
                success:function(html){
                    var $html = $(html.replace(/[\r\n]/g,""));
                    if($html.length < 10){
                        $("#article_loading").hide();
                        $("#article_loadnone").show();
                    }
                    $("#article_list").html(html);
                    $("#article_page").val(current_page+1);
                    article_loading = false;
                }
            });
        })
        
    })
    </script>
    </body>
</html>
