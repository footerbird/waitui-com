<!DOCTYPE html>
<html>

    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>

    <body>
    <div class="header"></div>
    <div class="container" id="article_container" style="padding-bottom: 50px; height: calc(100% + 50px);">
        
        <div class="weui-pull-to-refresh__layer">
            <div class='weui-pull-to-refresh__arrow'></div>
            <div class='weui-pull-to-refresh__preloader'></div>
            <div class="down">下拉刷新</div>
            <div class="up">释放刷新</div>
            <div class="refresh">正在刷新</div>
        </div>
        
        <input type="hidden" id="article_page" value="1" />
        
        <div class="weui-panel weui-panel_access article-list" style="margin-top: 0;">
            <div class="weui-panel__bd" id="article_html">
                <?php foreach ($article_list as $article){ ?>
                <a href="<?php echo base_url() ?>m/article_detail/<?php echo $article->article_id ?>.html" target="_parent" class="weui-media-box weui-media-box_appmsg">
                    <div class="weui-media-box__bd">
                        <h4 class="weui-media-box__title"><?php echo $article->article_title; ?></h4>
                        <p class="weui-media-box__desc"><?php echo $article->article_tag; ?>&nbsp;&nbsp;<?php echo $article->create_time; ?></p>
                    </div>
                    <div class="weui-media-box__hd">
                        <img class="weui-media-box__thumb" src="<?php echo $article->thumb_path; ?>">
                    </div>
                </a>
                <?php } ?>
            </div>
        </div>
        
        <div class="weui-loadmore" id="article_loading">
            <i class="weui-loading"></i>
            <span class="weui-loadmore__tips">正在加载</span>
        </div>
        <div class="weui-loadmore weui-loadmore_line" id="article_loadnone" style="display: none;">
            <span class="weui-loadmore__tips">喂喂，你触碰到我的底线了</span>
        </div>
        
    </div>
    <?php include_once('templete/tabbar.php') ?>
    
    <?php include_once('templete/pub_foot.php') ?>
    <script>
    window.onload = function(){
        
    }
    
    $(function(){
        $("#article_container").pullToRefresh(function() {
            $.ajax({
                type:"post",
                url:"<?php echo base_url() ?>mobile/Index_controller/get_articleAjax_tpl",
                async:true,
                data:{
                    page: 1
                },
                success:function(html){
                    $("#article_html").html(html);
                    $("#article_page").val(1);
                    $("#article_container").pullToRefreshDone();
                    $("#article_loading").show();
                    $("#article_loadnone").hide();
                }
            });
        });
        
        var article_loading = false;//状态标记
        $("#article_container").infinite().on("infinite", function() {
            if($("#article_loadnone").is(":visible")) return;
            if(article_loading) return;
            article_loading = true;
            var current_page = parseInt($("#article_page").val());
            $.ajax({
                type:"post",
                url:"<?php echo base_url() ?>mobile/Index_controller/get_articleAjax_tpl",
                async:true,
                data:{
                    page: current_page+1
                },
                success:function(html){
                    var $html = $(html.replace(/[\r\n]/g,""));
                    if($html.length < 10){
                        $("#article_loading").hide();
                        $("#article_loadnone").show();
                    }
                    $("#article_html").append(html);
                    $("#article_page").val(current_page+1);
                    article_loading = false;
                }
            });
        });
        
    })
    
    </script>
    </body>
</html>