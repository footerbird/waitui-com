<!DOCTYPE html>
<html>

    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>

    <body style="background-color: #1b1b1f;">
    <div class="header"></div>
    <div class="container" style="overflow: hidden;">
        <div class="swiper-container" id="swiper-container-v">

            <div class="swiper-wrapper">
                <?php foreach ($ad_list as $advertisement){ ?>
                <!-------------slide----------------->
                <section class="swiper-slide swiper-slide-v">
                    <?php if($advertisement->ad_type == 'image'){ ?>
                    <img class="banner" src="<?php echo $advertisement->ad_address; ?>" />
                    <?php }else if($advertisement->ad_type == 'iframe'){ ?>
                    <iframe src="<?php echo $advertisement->ad_address; ?>" frameborder="0" class="banner" width="100%" height="100%"></iframe>
                    <?php }else{ ?>
                    <video class="banner" src="<?php echo $advertisement->ad_address; ?>" poster="<?php echo $advertisement->video_poster; ?>" type="video/mp4" loop="loop" preload="load" muted webkit-playsinline="true" playsinline="true" x-webkit-airplay="true" x5-video-player-type="h5" x5-video-player-fullscreen="portraint">当前浏览器不支持</video>
                    <?php } ?>
                    <div class="swiper-mask">
                        <div class="author-info">
                            <font class="ad">广告</font>
                            <h4>@<?php echo $advertisement->author_name; ?></h4>
                            <p><?php echo $advertisement->ad_desc; ?></p>
                        </div>
                        <div class="side-bar">
                            <div class="figure">
                                <img src="<?php echo $advertisement->author_figure; ?>" class="ico-figure" />
                            </div>
                            <div class="heart">
                                <i data-adid="<?php echo $advertisement->ad_id; ?>" class="ico-heart <?php if(!empty($userinfo) && $advertisement->is_heart > 0){ echo 'heartAnimation'; } ?>" onclick="heartClick(this,<?php echo $advertisement->ad_id; ?>)"></i>
                                <p><?php echo $advertisement->heart_amount; ?></p>
                            </div>
                        </div>
                        <?php if($advertisement->ad_type == 'video'){ ?>
                        <div class="video-play"></div>
                        <?php } ?>
                    </div>
                    
                    <?php if(empty($userinfo)){ ?>
                        <?php if($advertisement->is_award == 1){ ?>
                        <div class="swiper-hongbao">
                            <img src="/htdocs/mobile/images/hongbao2.png" data-adid="<?php echo $advertisement->ad_id; ?>" onclick="linkTo(this,'<?php echo $advertisement->ad_link; ?>')" />
                        </div>
                        <?php } ?>
                    <?php }else{ ?>
                        <?php if($advertisement->is_pick == 0 && $advertisement->is_award == 1){ ?>
                        <div class="swiper-hongbao">
                            <img src="/htdocs/mobile/images/hongbao2.png" data-adid="<?php echo $advertisement->ad_id; ?>" onclick="linkTo(this,'<?php echo $advertisement->ad_link; ?>')" />
                        </div>
                        <?php } ?>
                    <?php } ?>
                    
                </section>
                <?php } ?>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <?php include_once('templete/tabbar.php') ?>
    
    <?php include_once('templete/pub_foot.php') ?>
    <script>
    window.onload = function(){
        
    }
    
    $(function(){
        var mySwiper = new Swiper ('#swiper-container-v', {
            effect: 'coverflow',
            speed: 500,
            direction: 'vertical',
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows : true
            }
        })
        mySwiper.on('slideNextTransitionStart',function(){//开始向下切换
            $.ajax({
                type:"post",
                url:"<?php echo base_url() ?>mobile/Index_controller/get_advertisementAjax_tpl",
                async:true,
                success:function(html){
                    mySwiper.appendSlide(html);
                }
            });
        })
        
        $(document).on("click",".swiper-mask",function(){
            var $mask = $(this);
            var $video_play = $mask.find(".video-play");
            if($video_play.length > 0){
                if($video_play.is(":hidden")){//如果是播放状态
                    $mask.siblings("video")[0].pause();
                    $mask.find(".video-play").show();
                }else{
                    //先把其他视频暂停
                    var $other_swiper = $mask.parent().siblings(".swiper-slide");
                    $other_swiper.each(function(){
                        var $this = $(this);
                        if($this.find(".video-play").length > 0){
                            $this.find("video")[0].pause();
                            $this.find(".video-play").show();
                        }
                    })
                    
                    $mask.siblings("video")[0].play();
                    $mask.find(".video-play").hide();
                }
            }
        })
        
    })
    
    function  linkTo(obj,link_address){
        if($("#pop_login").length > 0){//判断是否登录，如果未登录则弹出登录框
            $("#pop_login").popup();
            return;
        }
        var $this = $(obj);
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>mobile/Index_controller/get_randScoreAjax",
            async:true,
            data:{
                ad_id: $this.data("adid")
            },
            dataType:"json",
            success:function(data){
                if(data.state == 'success'){
                    $.alert('恭喜您，获得'+data.rand_score+'个W币',function(){
                        setTimeout(function(){//兼容微信中点击返回，确认弹窗不会关闭的问题
                            if(link_address && link_address != ''){
                                location.href=link_address;
                            }
                            $this.parent().remove();
                        },100)
                    });
                }else{
                    $this.parent().remove();
                    $.alert(data.msg);
                }
            }
        });
    }
    
    function  heartClick(obj,ad_id){
        //不要冒泡到swiper-mask上
        var eve = window.event;
        eve.stopPropagation();
        
        if($("#pop_login").length > 0){//判断是否登录，如果未登录则弹出登录框
            $("#pop_login").popup();
            return;
        }
        var $this = $(obj);
        var heart_num = 1;//默认点赞
        if($this.hasClass("heartAnimation")){
            heart_num = -1;//取消点赞
            $this.removeClass("heartAnimation");
            var count = $this.next().text();
            $this.next().text(parseInt(count) - 1);
        }else{
            $this.addClass("heartAnimation");
            var count = $this.next().text();
            $this.next().text(parseInt(count) + 1);
        }
        
        var adid_num = 0;//和当前点击赞相同的广告个数
        $(".ico-heart").each(function(){
            if($(this).data("adid") == ad_id){
                adid_num++;
            }
        })
        if(adid_num > 1){//如果有多个相同的广告，则要改成统一的点赞状态
            $(".ico-heart").each(function(){
                if($(this).data("adid") == ad_id){
                    $(this).attr("class",$this.attr("class"));
                    var count = $this.next().text();
                    $(this).next().text(count);
                }
            })
        }
        
        $.ajax({
            type:"post",
            url:"<?php echo base_url() ?>mobile/Index_controller/set_adHeartAjax",
            async:true,
            data:{
                ad_id: ad_id,
                heart_num: heart_num
            },
            dataType:"json",
            success:function(data){
                
            }
        });
    }
    
    </script>
    </body>
</html>