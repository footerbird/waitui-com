<!DOCTYPE html>
<html>

    <head>
    <?php include_once('templete/pub_head.php') ?>
    </head>

    <body style="background-color: #1b1b1f;">
    <div class="container" style="overflow: hidden;">
        <div class="swiper-container" id="swiper-container-v">

            <div class="swiper-wrapper">
                <!-------------slide----------------->
                <section class="swiper-slide swiper-slide-v">
                    <?php if($ad_info->ad_type == 'image'){ ?>
                    <img class="banner" src="<?php echo $ad_info->ad_address; ?>" />
                    <?php }else if($ad_info->ad_type == 'iframe'){ ?>
                    <iframe src="<?php echo $ad_info->ad_address; ?>" frameborder="0" class="banner" width="100%" height="100%"></iframe>
                    <?php }else{ ?>
                    <video class="banner" src="<?php echo $ad_info->ad_address; ?>" poster="<?php echo $ad_info->video_poster; ?>" type="video/mp4" loop="loop" preload="load" muted webkit-playsinline="true" playsinline="true" x-webkit-airplay="true" x5-video-player-type="h5" x5-video-player-fullscreen="portraint">当前浏览器不支持</video>
                    <?php } ?>
                    <div class="swiper-mask">
                        <div class="author-info">
                            <font class="ad">广告</font>
                            <h4>@<?php echo $ad_info->author_name; ?></h4>
                            <p><?php echo $ad_info->ad_desc; ?></p>
                        </div>
                        <?php if($ad_info->ad_type == 'video'){ ?>
                        <div class="video-play"></div>
                        <?php } ?>
                    </div>
                    <?php if($ad_info->is_award == 1){ ?>
                    <div class="swiper-hongbao">
                        <img src="/htdocs/mobile/images/hongbao2.png" data-adid="<?php echo $ad_info->ad_id; ?>" onclick="linkTo(this,'<?php echo $ad_info->ad_link; ?>')" />
                    </div>
                    <?php } ?>
                </section>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    
    </div>
    
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
    
    </script>
    </body>
</html>